<?php

namespace Parishop\ORMWrappers\Customer;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   addressId
 * @property int                                                                   customerGroupId
 * @property string                                                                actionId
 * @property int                                                                   deliveryId
 * @property int                                                                   sexId
 * @property string                                                                facebookId
 * @property string                                                                vkId
 * @property string                                                                googleId
 * @property string                                                                twitterId
 * @property string                                                                firstname
 * @property string                                                                middlename
 * @property string                                                                lastname
 * @property string                                                                email
 * @property string                                                                password
 * @property string                                                                salt
 * @property int                                                                   phone
 * @property string                                                                wishlist
 * @property int                                                                   newsletter
 * @property int                                                                   publish
 * @property string                                                                created
 * @property string                                                                modified
 * @property string                                                                birthday
 * @property string                                                                birthday_edit
 * @property string                                                                birthday_use
 * @property string                                                                marriage
 * @property string                                                                marriage_edit
 * @property string                                                                marriage_use
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity        $customerClient
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customerGroup
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $address
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $articleComments
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $addresses
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $customerCards
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $customerRewards
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $cartOptions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $cartCertificates
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\ArticleComment\Entity[] articleComments()
 * @method \Parishop\ORMWrappers\Address\Entity address()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Address\Entity[] addresses()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\CustomerCard\Entity[] customerCards()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\CartCertificate\Entity[] cartCertificates()
 * @method \Parishop\ORMWrappers\CustomerClient\Entity customerClient()
 * @method \Parishop\ORMWrappers\CustomerGroup\Entity customerGroup()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Order\Entity[] orders()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\CustomerReward\Entity[] customerRewards()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\CartOption\Entity[] cartOptions()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \PHPixie\AuthORM\Repositories\Type\Login\User
{
    /**
     * @type \Parishop\ORMWrappers\CustomerCard\Entity
     */
    protected $card_priority;

    /**
     * @var \Parishop\App\Builder
     */
    private $builder;

    /**
     * @param                       $entity
     * @param \Parishop\App\Builder $builder
     */
    public function __construct($entity, $builder)
    {
        parent::__construct($entity);
        $this->builder = $builder;
    }

    public function addressId()
    {
        return $this->address() ? $this->address()->id() : '';
    }

    public function birthday()
    {
        /**
         * Если дта не указана
         */
        if(!$this->birthday || $this->birthday == '0000-00-00') {
            return null;
        }
        $dt = new \DateTime($this->birthday);

        return $dt->format('d.m.Y');
    }

    public function birthday_use()
    {
        /**
         * Если дта не указана
         */
        if(!$this->birthday_use || $this->birthday_use == '0000-00-00') {
            return null;
        }
        $dt = new \DateTime($this->birthday_use);

        return $dt->format('d.m.Y');
    }

    /**
     * @param \Parishop\ORMWrappers\Product\Option\Entity $option_entity
     * @return mixed
     */
    public function card_price($option_entity)
    {
        if(!$option_entity->special) {
            $card_discount = $this->priorityCard() ? $this->priorityCard()->discount : 0;
            $price         = round($option_entity->price / 100 * ($card_discount));

            return $option_entity->price - $price;
        }

        return $option_entity->price;
    }

    public function cartAdd($cart)
    {
        $cartEntity = $this->builder->components()->orm()->createEntity('cart');
        $cartEntity->setField('customerId', $this->id());
        $cartEntity->setField('optionId', $cart['optionId']);
        $cartEntity->setField('quantity', $cart['quantity']);
        $cartEntity->setField('shopId', $cart['shopId']);
        $cartEntity->setField('deliveryId', $cart['deliveryId']);
        $cartEntity->setField('addressId', $cart['addressId']);
        $cartEntity->setField('pvz', $cart['pvz']);
        $cartEntity->save();
    }

    public function cartClear()
    {
        $this->cart->query()->delete();
        $this->cart->removeAll();
    }

    public function cartRemove($id)
    {
        $this->builder->components()->orm()->query('cart')->in($id)->delete();
    }

    public function completeFields()
    {
        $fields   = array(
            'customerGroupId',
            'lastname',
            'firstname',
            'middlename',
            'email',
            'phone',
            'newsletter',
            'birthday',
            'marriage',
            'sexId',
            'vkId',
            'facebookId',
            'googleId',
            'twitterId',
            'addresses',
        );
        $complete = 0;
        foreach($fields as $field) {
            switch($field) {
                case 'addresses':
                    $complete += $this->addresses()->offsetExists(0) ? 1 : 0;
                    break;
                case 'birthday':
                case 'marriage':
                    $complete += ($this->{$field} && $this->{$field} != '0000-00-00') ? 1 : 0;
                    break;
                case 'sexId':
                    $complete += $this->sexId && in_array($this->sexId, array(3001, 3002)) ? 1 : 0;
                    break;
                default:
                    $complete += $this->{$field} ? 1 : 0;
                    break;
            }
        }

        return round($complete / count($fields) * 100);
    }

    public static function convertPhone($phone)
    {
        if($phone) {
            $resPhone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($resPhone) === 11) {
                $resPhone = preg_replace("/^7/", "+7", $resPhone);
                $resPhone = preg_replace("/^8/", "+7", $resPhone);
            }
            if(strlen($resPhone) === 10) {
                $resPhone = "+7" . $resPhone;
            }
            if(strlen($resPhone) > 12) {
                $resPhone = substr($resPhone, 0, 12);
            }
            if(strlen($resPhone) < 12) {
                return null;
            }

            return $resPhone;
        }

        return null;

    }

    public function dateBirthday()
    {
        $birthday = $this->birthday();
        if($birthday) {
            $birthday_use = $this->birthday_use();
            if($birthday_use) {
                if(date('Y') == date_create_from_format('d.m.Y', $birthday_use)->format('Y')) {
                    return null;
                }
            }
        }

        return $birthday;
    }

    public function dateMarriage()
    {
        $marriage = $this->marriage();
        if($marriage) {
            $marriage_use = $this->marriage_use();
            if($marriage_use) {
                if(date('Y') == date_create_from_format('d.m.Y', $marriage_use)->format('Y')) {
                    return null;
                }
            }
        }

        return $marriage;
    }

    public function fio()
    {
        return implode(' ', array_diff(array($this->lastname, $this->firstname, $this->middlename), array(null, '')));
    }

    /**
     * Вычисление Какую карту покупателя применить
     * TODO-Linfuby: Решить использовать ли несколько карт покупателя для определения скидки
     * @param \Parishop\ORMWrappers\Option\Entity $option_entity
     * @return mixed
     */
    public function getCardPrice($option_entity)
    {
        $cards = $this->customerCards();
        if(!$cards->asArray()) {
            return $option_entity->price;
        }
        $max_discount = 0;
        foreach($cards as $card) {
            $discount = $card->active && !$card->locked ? $card->discount : 0;
            if($discount > $max_discount) {
                $max_discount = $discount;
            }
        }
        if(!$max_discount) {
            return $option_entity->price;
        }

        return $option_entity->price - ($option_entity->price / 100 * $max_discount);
    }

    public function marriage()
    {
        /**
         * Если дта не указана
         */
        if(!$this->marriage || $this->marriage == '0000-00-00') {
            return null;
        }
        $dt = new \DateTime($this->marriage);

        return $dt->format('d.m.Y');
    }

    public function marriage_use()
    {
        if(!$this->marriage_use || $this->marriage_use == '0000-00-00') {
            return null;
        }
        $dt = new \DateTime($this->marriage_use);

        return $dt->format('d.m.Y');
    }

    public function name()
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    /**
     * @return mixed
     */
    public function passwordHash()
    {
        return $this->password;
    }

    public function rewardsBalance()
    {
        $rewards = 0;
        foreach($this->customerRewards() as $reward) {
            $rewards += $reward->rewards;
        }

        return $rewards;
    }

    /**
     * @param \PHPixie\Slice\Type\ArrayData $data
     */
    public function saveData($data)
    {
        $this->setField('newsletter', 0);
        foreach($data as $key => $value) {
            switch($key) {
                case 'bundle':
                case 'processor':
                case 'action':
                case 'search':
                case 'files':
                case 'file':
                case 'id':
                case 'birthday_use':
                case 'birthday_edit':
                case 'marriage_use':
                case 'marriage_edit':
                    continue;
                    break;
                case 'keywordGroupId':
                    $this->setField($key, $value ? $value : 1);
                    break;
                case 'publish':
                    $this->setField($key, $value);
                    break;
                case 'phone':
                    $this->setField($key, $this->convertPhone($value));
                    break;
                case 'newsletter':
                    $this->setField($key, 1);
                    break;
                case 'birthday':
                case 'marriage':
                    if($value) {
                        $value = date_create_from_format('d.m.Y', $value)->format('Y-m-d');
                        $this->setField($key, $value);
                    } else {
                        $this->setField($key, '0000-00-00');
                    }
                    break;
                default:
                    if($value && !is_array($value)) {
                        $this->setField($key, $value);
                    }
                    break;
            }
        }
        $this->save();
    }

    /**
     * @return \PHPixie\Slice\Type\ArrayData\Editable
     */
    public function wishlist()
    {
        $slice = new \PHPixie\Slice();

        return $slice->editableArrayData(unserialize($this->wishlist));
    }
}
