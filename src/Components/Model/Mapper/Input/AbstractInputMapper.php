<?php
/**
 * Created by PhpStorm.
 * User: repad
 * Date: 30.7.18
 * Time: 10:46
 */

namespace App\Components\Model\Mapper\Input;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

abstract class AbstractInputMapper
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        RequestStack $requestStack,
        ValidatorInterface $validator,
        LoggerInterface $logger
    )
    {
        $this->requestStack = $requestStack;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * @return mixed
     * @throws ValidatorException
     */
    public function getInput() {
        $this->validateRequest();
        $class = $this->getFilledInputObject($this->getRequest());
        $validationResult = $this->validator->validate($class);
        if ($validationResult->count() == 0) {
            return $class;
        } else {
            $error = [];
            foreach($validationResult as $validationError) {
                /** @var ConstraintViolationInterface $validationError */
                $error[] = $validationError->getMessage();
            }
            throw new ValidatorException(implode(',',$error));
        }
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getFilledInputObject(Request $request) {
        $object = $this->getInputObject();
        $this->fillObject($object, $request);
        return $object;
    }

    /**
     * @param mixed $object
     * @param Request $request
     */
    protected abstract function fillObject($object, Request $request);

    /**
     * @return mixed
     */
    protected abstract function getInputObject();

    protected function validateRequest()
    {
    }
}
