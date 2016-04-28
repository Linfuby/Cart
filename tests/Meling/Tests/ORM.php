<?php
namespace Meling\Tests;

/**
 * Class Session
 * @package Meling\Tests
 */
class ORM extends \PHPixie\ORM
{
    public function __construct()
    {
        $slice    = new \PHPixie\Slice();
        $config   = $slice->arrayData(
            array(
                'default' => array(
                    'driver'     => 'pdo',
                    'connection' => 'mysql:host=localhost;dbname=parishop_pixie_new',
                    'user'       => 'parishop',
                    'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                    'database'   => 'parishop_pixie_new',
                ),
            )
        );
        $database = new \PHPixie\Database($config);
        $config   = new \PHPixie\Config($slice);
        $configORM =  $config->directory(__DIR__, 'config')->arraySlice('orm');
        $ORMWrappers = new ORMWrappers();
        parent::__construct($database, $configORM, $ORMWrappers);
    }

    public function disconnect()
    {
        $this->builder->database()->connection('default')->disconnect();
    }

}
