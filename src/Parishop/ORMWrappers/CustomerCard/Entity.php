<?php
namespace Parishop\ORMWrappers\CustomerCard;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   name
 * @property int                                                                   discount
 * @property int                                                                   rewards
 * @property int                                                                   active
 * @property int                                                                   locked
 * @property string                                                                code
 * @property string                                                                code_created
 * @property string                                                                customerId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity        $client
 * @method \Parishop\Admin\HTTPProcessors\Home customer()
 * @method \Parishop\Admin\HTTPProcessors\Home client()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function discount($price_flag = 1, $special = 1)
    {
        if(!$special && (!$price_flag || $price_flag == 2)) {
            return $this->discount;
        }

        return 0;
    }
}
