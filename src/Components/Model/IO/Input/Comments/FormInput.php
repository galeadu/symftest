<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 2.10.18
 * Time: 15:53
 */

namespace App\Components\Model\IO\Input\Comments;

use Symfony\Component\Validator\Constraints as Assert;



class FormInput
{
    /**
     * var $string
     * @Assert\NotBlank(message="Anotation string must be set")
     * @Assert\Type(type="string", message="Anotation string must be set")
     */
    protected $shortdescription;

    /**
     * var $string
     * @Assert\NotBlank(message="Description string must be set")
     * @Assert\Type(type="string", message="Description string must be set")
     */
    protected $description;

    /**
     * @return mixed
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
    }

    /**
     * @param mixed $shortdescription
     */
    public function setShortdescription($shortdescription): void
    {
        $this->shortdescription = $shortdescription;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


}