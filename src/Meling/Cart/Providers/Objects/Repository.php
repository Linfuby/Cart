<?php
namespace Meling\Cart\Providers\Objects;

class Repository extends \Meling\Cart\Providers\Objects
{
    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Repository
     */
    protected $provider;

    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var int
     */
    protected $id;

    /**
     * Objects constructor.
     * @param \PHPixie\ORM\Models\Type\Database\Repository $provider
     * @param string                                       $fieldName
     * @param int                                          $id
     */
    public function __construct($provider, $fieldName, $id)
    {
        parent::__construct($provider);
        $this->id        = $id;
        $this->fieldName = $fieldName;
    }

    /**
     * @param array $data
     * @return int
     */
    public function add($data = array())
    {
        $entity = $this->provider->create((array)$data);
        $entity->setField($this->fieldName, $this->id);
        $entity->save();

        return $entity->id();
    }

    /**
     * @return array
     */
    public function clear()
    {
        $this->provider->query()->where($this->fieldName, $this->id)->delete();

        return $this->objects();
    }

    /**
     * @return array
     */
    public function objects()
    {
        return $this->provider->query()->where($this->fieldName, $this->id)->find()->asArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function remove($id)
    {
        $this->provider->query()->in($id)->delete();

        return $this->objects();
    }

}
