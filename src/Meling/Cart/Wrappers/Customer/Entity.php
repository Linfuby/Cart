<?php
namespace Meling\Cart\Wrappers\Customer;

/**
 * Class Entity
 * @property mixed  id
 * @property string lastname
 * @property string firstname
 * @property string middlename
 * @property string email
 * @property string phone
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\CartCertificate\Entity[] cartCertificates()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\CartProduct\Entity[] cartProducts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\CustomerCard\Entity[] customerCards()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\CustomerReward\Entity[] customerRewards()
 * @package Meling\Cart\Wrappers\Customer
 */
class Entity extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{
    protected $rewards;

    public function rewards()
    {
        if($this->rewards === null) {
            $this->rewards = 0;
            foreach($this->customerRewards() as $customerReward) {
                $this->rewards += $customerReward->rewards;
            }
        }

        return $this->rewards;
    }
}