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
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\Cart\Entity[] carts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable customerCards()
 * @package Meling\Cart\Wrappers\Customer
 */
class Entity extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{

}