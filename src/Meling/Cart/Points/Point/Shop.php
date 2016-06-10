<?php
namespace Meling\Cart\Points\Point;

class Shop extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $work_times;

    /**
     * @var string
     */
    protected $street;

    /**
     * Implementation constructor.
     * @param string                            $id
     * @param string                            $name
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @param string                            $phone
     * @param string                            $street
     * @param string                            $work_times
     * @param string                            $cityId
     */
    public function __construct($id, $name, $city, $phone, $street, $work_times, $cityId = null)
    {
        parent::__construct($id, $name, $cityId);
        $this->city       = $city;
        $this->phone      = $phone;
        $this->street     = $street;
        $this->work_times = $work_times;
    }

    public function city()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function phone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function street()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function work_times()
    {
        return $this->work_times;
    }


}
