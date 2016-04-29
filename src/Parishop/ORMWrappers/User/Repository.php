<?php

namespace Parishop\ORMWrappers\User;

/**
 * Class Repository
 * @method Entity getByLogin($login)
 * @method Query query()
 * @method Entity create()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \PHPixie\AuthORM\Repositories\Type\Login
{
    public function getByFacebook($field, $userId)
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Query $query
         */
        $query = $this->query();
        $query->where($field, $userId);

        return $query->findOne();
    }

    public function getFields()
    {
        return $this->connection()->execute('SHOW FULL COLUMNS FROM `' . $this->config()->get('table') . '`');
    }

    public function listColumns()
    {
        return $this->connection()->listColumns($this->config()->get('table'));
    }

    protected function loginFields()
    {
        return array('username');
    }
}
