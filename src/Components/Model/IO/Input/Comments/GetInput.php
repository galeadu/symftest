<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.10.18
 * Time: 10:31
 */

namespace App\Components\Model\IO\Input\Comments;

use Symfony\Component\Validator\Constraints as Assert;


class GetInput
{

    /**
     * var $string
     * @Assert\NotBlank(message="Description string must be set")
     * @Assert\Type(type="numeric", message="ID must be a number")
     */
    protected $id;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}