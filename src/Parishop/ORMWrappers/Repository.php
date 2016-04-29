<?php

namespace Parishop\ORMWrappers;

/**
 * Class Repository
 * @method Query query()
 * @method \PHPixie\Slice\Type\ArrayData config()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \PHPixie\ORM\Wrappers\Type\Database\Repository
{
    /**
     * @type \Parishop\App\Builder
     */
    protected $builder;

    protected $errorNotFound = 'Запись не найдена';

    /**
     * @param                       $repository
     * @param \Parishop\App\Builder $builder
     */
    public function __construct($repository, $builder)
    {
        parent::__construct($repository);
        $this->builder = $builder;
    }

    /**
     * Удаление записи из таблицы
     * @param int $id Идентификатор записи
     * @throws \Exception
     */
    public function delete($id)
    {
        $entity = $this->query()->in($id)->findOne();
        if(!$entity) {
            throw new \Exception($this->errorNotFound);
        }
        parent::delete($entity);
    }

    /**
     * Список полей текущей таблицы
     * @return array
     */
    public function listColumns()
    {
        return $this->connection()->listColumns($this->config()->get('table'));
    }

    /**
     * Список полей (полные данные) текущей таблицы
     * @return \PHPixie\Slice\Type\ArrayData\Editable
     * @throws \PHPixie\Slice\Exception
     */
    public function listColumnsFull()
    {
        $columns = $this->connection()->execute('SHOW FULL COLUMNS FROM `' . $this->config()->get('table') . '`');
        $slice   = $this->builder->components()->slice();
        $result  = $slice->editableArrayData();
        foreach($columns as $column) {
            $result->set($column->Field, (array)$column);
        }

        return $result;
    }

    /**
     * Имя текущей таблицы
     * @return string
     */
    public function tableName()
    {
        return $this->config()->get('table');
    }

    /**
     * @param Entity                                 $entity
     * @param \PHPixie\Slice\Type\ArrayData\Editable $data
     */
    public function update($entity, $data = null)
    {
    }

}
