<?php
namespace Meling\Cart\Providers;

/**
 * Class Provider
 * @package Meling\Cart\Providers
 */
abstract class Provider
{
    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var \PHPixie\HTTP\Context
     */
    protected $context;

    /**
     * @var \Meling\Cart\Actions
     */
    protected $actions;

    /**
     * @var \Meling\Cart\Actions
     */
    protected $actionsAfter;

    /**
     * @var \Meling\Cart\Addresses
     */
    protected $addresses;

    /**
     * @var \Meling\Cart\Cards
     */
    protected $cards;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        $this->orm     = $orm;
        $this->context = $context;
    }

    /**
     * @return \Meling\Cart\Actions
     */
    public function actions()
    {
        if($this->actions === null) {
            /** @var \Parishop\ORMWrappers\Action\Query $actions */
            $allowActions = $this->orm->query('allowAction');
            $allowActions->where('after', 0);
            $allowActions->whereNot('actionTypeId', 53001);
            $actions = array();
            /** @var \Parishop\ORMWrappers\Action\Entity $action */
            foreach($allowActions->find() as $action) {
                $actions[(string)$action->id()] = new \Meling\Cart\Actions\Action($action);
            }
            $this->actions = new \Meling\Cart\Actions($actions, $this->actionId());
        }

        return $this->actions;
    }

    /**
     * @return \Meling\Cart\Actions
     */
    public function actionsAfter()
    {
        if($this->actionsAfter === null) {
            $allowActions = $this->orm->query('allowAction');
            $allowActions->where('after', 1);
            $actions = array();
            /** @var \Parishop\ORMWrappers\Action\Entity $action */
            foreach($allowActions->find() as $action) {
                $actions[(string)$action->id()] = new \Meling\Cart\Actions\Action($action);
            }
            $this->actionsAfter = new \Meling\Cart\Actions($actions);
        }

        return $this->actionsAfter;
    }

    public function buildCertificate($certificate, $points)
    {
        $entity = $this->loadCertificate($certificate->certificateId);
        $city   = null;
        if($certificate->cityId) {
            $city = $this->city($certificate->cityId);
        }

        return new \Meling\Cart\Products\Certificate($entity->id(), $entity, $certificate->quantity, $certificate->price, $points, $certificate->pointId, $certificate->shopId, $certificate->shopTariffId, $city, $certificate->cityId, $certificate->addressId, $certificate->pvz);
    }

    public function buildOption($option, $points)
    {
        $entity = $this->loadOption($option->optionId);
        $city   = null;
        if($option->cityId) {
            $city = $this->city($option->cityId);
        }

        return new \Meling\Cart\Products\Option($entity->id(), $entity, $option->quantity, $option->price, $points, $option->pointId, $option->shopId, $option->shopTariffId, $city, $option->cityId, $option->addressId, $option->pvz);
    }

    /**
     * @param null $cityId
     * @return \Parishop\ORMWrappers\City\Entity
     */
    public function city($cityId = null)
    {
        if($cityId === null) {
            $cityId = $this->context->cookies()->get('city_default_id', -6081056);
        }

        return $this->orm->query('city')->in($cityId)->findOne();
    }

    /**
     * @param $certificateId
     * @return \Parishop\ORMWrappers\Certificate\Entity
     * @throws \Exception
     */
    public function loadCertificate($certificateId)
    {
        $certificate = $this->orm->query('certificate')->in($certificateId)->findOne();
        if($certificate === null) {
            throw new \Exception('Certificate ' . $certificateId . ' does not exist');
        }

        return $certificate;
    }

    /**
     * @param $optionId
     * @return \Parishop\ORMWrappers\Option\Entity
     * @throws \Exception
     */
    public function loadOption($optionId)
    {
        $option = $this->orm->query('option')->in($optionId)->findOne(
            array(
                'restOptions.shop.shopTariffs.delivery',
            )
        );
        if($option === null) {
            throw new \Exception('Option ' . $optionId . ' does not exist');
        }

        return $option;
    }

    protected function actionId()
    {
        return $this->context->session()->get('actionId');
    }

    /**
     * @return \DateTime
     */
    public abstract function actionsBirthday();

    /**
     * @return \DateTime
     */
    public abstract function actionsDate();

    /**
     * @return \DateTime
     */
    public abstract function actionsMarriage();

    /**
     * @return \Meling\Cart\Addresses
     */
    public abstract function addresses();

    /**
     * @return \Meling\Cart\Cards
     */
    public abstract function cards();

    /**
     * @return \Parishop\ORMWrappers\Customer\Entity
     */
    public abstract function customer();

    /**
     * @return string
     */
    public abstract function email();

    /**
     * @return string
     */
    public abstract function firstname();

    /**
     * @return string
     */
    public abstract function id();

    /**
     * @return string
     */
    public abstract function lastname();

    /**
     * @return string
     */
    public abstract function middlename();

    /**
     * @return string
     */
    public abstract function phone();

}
