<?php

namespace Parishop\ORMWrappers\Call;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property int                                                                   phone
 * @property string                                                                created
 * @property string                                                                modified
 * @property int                                                                   publish
 * @property string                                                                link
 * @property int                                                                   userId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $user
 * @method \Parishop\ORMWrappers\User\Entity user()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function done()
    {
        $dt = new \DateTime();
        if($this->publish) {
            $this->publish = 0;
        } else {
            $this->publish = 1;
        }
        $this->modified = $dt->format(DATE_W3C);
        $this->save();
        $this->user->set($this->builder->components()->auth()->domain()->user());
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return parent::url(
            array(
                'processor' => 'calls',
                'action'    => 'done',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }
}
