<?php
namespace Meling\Cart\Providers;

/**
 * Class Models
 * @method Models\Option option()
 * @method Models\Certificate certificate()
 * @package Meling\Cart\Providers\Products
 */
class Models
{
    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    protected $models;

    /**
     * Models constructor.
     * @param \PHPixie\ORM $orm
     */
    public function __construct(\PHPixie\ORM $orm)
    {
        $this->orm = $orm;
    }

    /**
     * @param $name      string
     * @param $arguments array
     * @return Models\Model
     */
    function __call($name, $arguments)
    {
        return $this->get($name);
    }

    /**
     * @return Models\Model[]
     */
    public function asArray()
    {
        $this->requireModels();

        return $this->models;
    }

    /**
     * @param $modelName
     * @return Models\Model
     * @throws \Exception
     */
    public function get($modelName)
    {
        $this->requireModels();
        if(array_key_exists($modelName, $this->models)) {
            return $this->models[$modelName];
        }
        throw new \Exception('Model ' . $modelName . ' does not exist');
    }

    /**
     * @return \PHPixie\ORM
     */
    public function orm()
    {
        return $this->orm;
    }

    /**
     * @param string $modelName
     * @return string
     */
    public function plural($modelName)
    {
        return $this->orm->builder()->configs()->inflector()->plural($modelName);
    }

    protected function requireModels()
    {
        if($this->models !== null) {
            return;
        }
        $this->models = array(
            'option'      => new Models\Option($this),
            'certificate' => new Models\Certificate($this),
        );
    }

}

