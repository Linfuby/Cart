<?php
namespace Parishop\ORMWrappers\BannerImage;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   bannerId
 * @property int                                                                   actionId
 * @property int                                                                   publish
 * @property string                                                                created
 * @property string                                                                modified
 * @property string                                                                link
 * @property string                                                                name
 * @property string                                                                image
 * @property string                                                                description
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $action
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $banner
 * @method \Parishop\ORMWrappers\Action\Entity action()
 * @method \Parishop\ORMWrappers\Banner\Entity banner()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
