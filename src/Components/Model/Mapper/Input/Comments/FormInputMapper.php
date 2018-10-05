<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 3.10.18
 * Time: 15:10
 */

namespace App\Components\Model\Mapper\Input\Comments;

use App\Components\Model\Mapper\Input\AbstractInputMapper;
use App\Components\Model\IO\Input\Comments\FormInput;
use Symfony\Component\HttpFoundation\Request;




/**
 * Class FormInputMapper
 * @package App\Components\Model\Mapper\Input\Comments
 */
class FormInputMapper extends AbstractInputMapper
{
    /**
     * @return FormInput
     */
    protected function getInputObject()
    {
        return new FormInput();
    }


    /**
     * @param $object
     * @param Request $request
     */
    protected function fillObject($object, Request $request)
    {
        $object->setShortdescription((string) $request->request->get('form')['shortdescription']);
        $object->setDescription((string) $request->request->get('form')['description']);
    }


}