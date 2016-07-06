<?php
namespace Parishop\ORMWrappers;

/**
 * Class Query
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Caching|Entity[] find($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \PHPixie\ORM\Wrappers\Type\Database\Query
{
    /**
     * @type \Parishop\App\Builder
     */
    protected $appBuilder;

    /**
     * @type array
     */
    protected $entities = array();

    protected $error    = 'Запись %s в %s не найдена';

    /**
     * @type \PHPixie\ORM\Drivers\Driver\PDO\Query
     */
    protected $query;

    protected $table;

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Query $query
     * @param \Parishop\App\Builder                 $appBuilder
     */
    public function __construct($query, $appBuilder)
    {
        parent::__construct($query);
        $this->appBuilder = $appBuilder;
        $this->table      = $this->appBuilder->components()->orm()->repository($this->modelName())->config()->get(
            'table'
        );
    }

    public function alias($alias)
    {
        if(!$entity = $this->where('alias', $alias)->findOne()) {
            throw new \Exception(sprintf($this->error, $alias, $this->table));
        }

        return $entity;
    }

    /**
     * @param array $preload
     * @return Entity
     */
    public function findOnePreload($preload = array())
    {
        $preload = $this->preload($preload);

        return parent::findOne($preload);
    }

    /**
     * @param array $preload
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching|Entity[]
     */
    public function findPreload($preload = array())
    {
        $preload = $this->preload($preload);

        return parent::find($preload);
    }

    public function getFields()
    {
        $table  = $this->appBuilder->components()->orm()->repository($this->modelName())->config()->get('table');
        $result = $this->appBuilder->components()->database()->get()->execute(
            'SHOW FULL COLUMNS FROM `' . $table . '`'
        );
        $fields = array();
        foreach($result as $field) {
            $fields[$field->Field] = $field;
        }

        return $fields;
    }

    /**
     * @param mixed $id
     * @param bool  $preload
     * @return Entity
     * @throws \Exception
     */
    public function load($id, $preload = true)
    {
        if(is_array($id)) {
            foreach($id as $key => $value) {
                $this->where($key, $value);
            }
            if($preload) {
                $entity = $this->findOnePreload();
            } else {
                $entity = $this->findOne();
            }
            if(!$entity) {
                throw new \Exception(
                    sprintf(
                        $this->error, $value,
                        $this->appBuilder->components()->orm()->repository($this->modelName())->config()->get('table')
                    )
                );
            }
        } else {
            if($preload) {
                $entity = $this->in($id)->findOnePreload();
            } else {
                $entity = $this->in($id)->findOne();
            }
            if(!$entity) {
                throw new \Exception(
                    sprintf(
                        $this->error, $id,
                        $this->appBuilder->components()->orm()->repository($this->modelName())->config()->get('table')
                    )
                );
            }
        }

        return $entity;
    }

    /**
     * Сортировка. По умолчанию: По имени По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'name', $orderDir = 'asc')
    {
        if(strtoupper($orderDir) === 'DESC') {
            $this->query->orderDescendingBy($ordering);
        } else {
            $this->query->orderAscendingBy($ordering);
        }

        return $this;
    }

    /**
     * @param $preload
     * @return array
     */
    public function preload($preload = array())
    {
        return $preload;
    }

    /**
     * Опубликованные
     * @param int $publish
     * @return $this
     */
    public function published($publish = 1)
    {
        $this->query->where('publish', $publish);

        return $this;
    }

    public function repository()
    {
        return $this->appBuilder->components()->orm()->repository($this->modelName());
    }

    /**
     * @return \PHPixie\Database\Type\SQL\Expression
     */
    public function sql()
    {
        return $this->query->planFind()->queryStep()->query()->parse();
    }

    protected function table($modelName)
    {
        return $this->appBuilder->components()->orm()->repository($modelName)->config()->get('table');
    }

}
