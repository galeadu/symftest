<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.10.18
 * Time: 10:29
 */

namespace App\Components\Model\Mapper\Input\Comments;

use App\Components\Model\Mapper\Input\AbstractInputMapper;
use App\Components\Model\IO\Input\Comments\GetInput;
use Symfony\Component\HttpFoundation\Request;


class GetInputMapper extends AbstractInputMapper
{
    /**
     * @return GetInput
     */
    protected function getInputObject()
    {
        return new GetInput();
    }


    /**
     * @param $object
     * @param Request $request
     */
    protected function fillObject($object, Request $request)
    {
        $object->setId($request->get('id'));
    }


    protected function validateRequest()
    {
      //  $id = (int)  $this->getRequest()->get('id');

    }

}