<?php
namespace Parishop\ORMWrappers\OrderHistory;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   orderId
 * @property int                                                                   userId
 * @property string                                                                name
 * @property int                                                                   value_old
 * @property string                                                                value_new
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $order
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $user
 * @method \Parishop\ORMWrappers\Order\Entity order()
 * @method \Parishop\ORMWrappers\User\Entity user()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function fieldName()
    {
        switch($this->name) {
            case 'customerId':
                return 'Покупатель';
                break;
            case 'customerGroupId':
                return 'Группа покупателя';
                break;
            case 'orderStatusId':
            case 'status':
                return 'Статус';
                break;
            case 'firstname':
                return 'Имя покупателя';
                break;
            case 'middlename':
                return 'Отчество покупателя';
                break;
            case 'lastname':
                return 'Фамилия покупателя';
                break;
            case 'phone':
                return 'Телефон';
                break;
            case 'shipping_code':
                return 'Способ доставки';
                break;
            case 'payment_code':
                return 'Способ оплаты';
                break;
            case 'addressId':
                return 'Адрес';
                break;
            case 'zip':
                return 'Индекс';
                break;
            case 'countryId':
                return 'Страна';
                break;
            case 'regionId':
                return 'Область/Регион';
                break;
            case 'cityId':
                return 'Город';
                break;
            case 'address':
                return 'Адрес';
                break;
            case 'shopId':
                return 'Магазин "Парижанка"';
                break;
            case 'pvz':
                return 'Пункт выдачи заказов';
                break;
            case 'comment':
                return 'Комментарий';
                break;
            case 'card_id':
                return 'Клубная карта';
                break;
            case 'actionId':
                return 'Акция';
                break;
            case 'total_amount':
                return 'Сумма заказа';
                break;
            case 'total_shipping':
                return 'Стоимость доставки';
                break;
            case 'total_card':
                return 'Скидка по Клубной карте';
                break;
            case 'total_action':
                return 'Скидка по Акции';
                break;
            case 'total_total':
                return 'Итого';
                break;
            default:
                return $this->name;
                break;
        }
    }

    public function userName()
    {
        return $this->userId ? $this->user()->name() : null;
    }
}
