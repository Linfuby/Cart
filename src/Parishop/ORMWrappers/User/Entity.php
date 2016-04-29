<?php

namespace Parishop\ORMWrappers\User;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   userGroupId
 * @property string                                                                vendorId
 * @property int                                                                   publish
 * @property string                                                                username
 * @property string                                                                firstname
 * @property string                                                                middlename
 * @property string                                                                lastname
 * @property string                                                                email
 * @property string                                                                phone
 * @property string                                                                password
 * @property string                                                                salt
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $articles
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $calls
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $order_history
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $group
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable actions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable articles()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable calls()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orderHistories()
 * @method \Parishop\ORMWrappers\UserGroup\Entity userGroup()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \PHPixie\AuthORM\Repositories\Type\Login\User
{
    public function name()
    {
        $middlename = $this->middlename ? ' ' . $this->middlename : '';

        return $this->lastname . ' ' . $this->firstname . $middlename;
    }

    /**
     * @return mixed
     */
    public function passwordHash()
    {
        return $this->password;
    }

    public function saveData($data)
    {
        foreach($data as $key => $value) {
            switch($key) {
                case 'bundle':
                case 'processor':
                case 'action':
                case 'search':
                case 'files':
                case 'file':
                case 'id':
                case 'parentId':
                    continue;
                    break;
                default:
                    if($value){
                        $this->setField($key, $value);
                    }
                    break;
            }
        }
        $this->save();
    }
}
