<?php
namespace Parishop\ORMWrappers\UserGroup;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property int                                                                   userDepartmentId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $userDepartment
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $users
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity userDepartment()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable users()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
