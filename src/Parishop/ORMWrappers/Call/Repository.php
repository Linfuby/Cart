<?php
namespace Parishop\ORMWrappers\Call;

/**
 * Class Repository
 * @method Query query()
 * @method Entity create()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \Parishop\ORMWrappers\Repository
{
    public function countWork()
    {
        return $this->query()->published(0)->count();
    }

}
