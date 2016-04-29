<?php
namespace Meling\Tests\ORMWrappers\Entities;

/**
 * Class Option
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Tests\ORMWrappers\Entities\Shop[] shops()
 * @package Meling\Tests\ORMWrappers\Entities
 */
class Option extends \Meling\Tests\ORMWrappers\Entity
{
    /**
     * @param int $flag
     * @return bool
     */
    public function priceFlag($flag)
    {
        switch($flag) {
            case 0:
                return $this->getRequiredField('special') ? false : true;
                break;
            case 1:
                return true;
                break;
            case 2:
                return $this->getRequiredField('special') ? true : false;
                break;
        }

        return false;
    }
}