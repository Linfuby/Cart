<?php

namespace Parishop\ORMWrappers\Banner;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property int                                                                   publish
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $bannerImages
 * @method \Parishop\ORMWrappers\BannerImage\Entity[] bannerImages()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
