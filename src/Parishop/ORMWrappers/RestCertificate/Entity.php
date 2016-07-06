<?php
namespace Parishop\ORMWrappers\RestCertificate;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   shopId
 * @property int                                                                   certificateId
 * @property int                                                                   quantity
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $certificate
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @method \Parishop\ORMWrappers\Certificate\Entity certificate()
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
