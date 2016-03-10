<?php
namespace Meling\Cart\Providers\Subjects;

/**
 * Class Session
 * @package Meling\Cart\Providers\Subjects
 */
class Session extends \Meling\Cart\Providers\Subject
{
    /**
     * @var \PHPixie\ORM\Repositories
     */
    protected $repositories;

    /**
     * @var \PHPixie\HTTP\Context\Session\SAPI
     */
    protected $subject;

    /**
     * Customer constructor.
     * @param \PHPixie\HTTP\Context\Session\SAPI $subject
     */
    public function __construct($subject)
    {
        parent::__construct($subject, null);
    }

    /**
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Editable
     */
    public function cards()
    {
        return array();
    }


    /**
     * @return \Meling\Cart\Providers\Objects
     */
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = new \Meling\Cart\Providers\Objects\Session($this->subject, 'certificates');
        }

        return $this->certificates;
    }

    /**
     * @return \DateTime
     */
    public function dateActual()
    {
        return new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function dateBirthday()
    {
        return null;
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        return null;
    }

    /**
     * @return \Meling\Cart\Providers\Objects
     */
    public function products()
    {
        if($this->products === null) {
            $this->products = new \Meling\Cart\Providers\Objects\Session($this->subject, 'products');
        }

        return $this->products;
    }


}
