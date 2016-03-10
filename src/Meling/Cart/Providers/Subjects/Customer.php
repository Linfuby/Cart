<?php
namespace Meling\Cart\Providers\Subjects;

/**
 * Class Customer
 * @package Meling\Cart\Providers\Subjects
 */
class Customer extends \Meling\Cart\Providers\Subject
{
    /**
     * @var \PHPixie\ORM\Repositories
     */
    protected $repositories;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $subject;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $subject
     * @param \PHPixie\ORM\Repositories              $repositories
     */
    public function __construct(\PHPixie\ORM\Drivers\Driver\PDO\Entity $subject, $repositories)
    {
        parent::__construct($subject, $repositories);
    }

    /**
     * @return array
     */
    public function cards()
    {
        return $this->subject->customerCards();
    }

    /**
     * @return \Meling\Cart\Providers\Objects
     */
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = new \Meling\Cart\Providers\Objects\Repository(
                $this->repositories->get('cartCertificate'), 'customerId', $this->subject->id()
            );
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
        $birthday = $this->subject->getField('birthday');
        if($birthday && $birthday != '0000-00-00') {
            $birthday_use = $this->subject->getField('birthday_use');
            if($birthday_use && $birthday_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $birthday_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($birthday);
        }

        return null;
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        $marriage = $this->subject->getField('marriage');
        if($marriage && $marriage != '0000-00-00') {
            $marriage_use = $this->subject->getField('marriage_use');
            if($marriage_use && $marriage_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $marriage_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($marriage);
        }

        return null;
    }

    /**
     * @return \Meling\Cart\Providers\Objects
     */
    public function products()
    {
        if($this->products === null) {
            $this->products = new \Meling\Cart\Providers\Objects\Repository(
                $this->repositories->get('cart'), 'customerId', $this->subject->id()
            );
        }

        return $this->products;

    }

}
