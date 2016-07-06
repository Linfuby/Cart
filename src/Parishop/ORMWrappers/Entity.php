<?php
namespace Parishop\ORMWrappers;

/**
 * Class Entity
 * @property int    id
 * @property string name
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{
    /**
     * @type \Parishop\App\Builder
     */
    protected $builder;

    /**
     * @type \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $entity;

    /**
     * @param                       $entity
     * @param \Parishop\App\Builder $builder
     */
    public function __construct($entity, $builder)
    {
        parent::__construct($entity);
        $this->builder = $builder;
    }

    public function frequenciesLastMonth()
    {
        /**
         * @var \Parishop\ORMWrappers\KeywordFrequency\Entity $frequency
         */
        $frequencies = 0;
        foreach($this->builder->components()->orm()->keywordFrequency->where(
            'created', '>=',
            date('Y-m') . '-01'
        )->relatedTo('keyword', $this->keywords()->asArray())->find() as $frequency) {
            $frequencies += (int)$frequency->frequency_2;
        }

        return $frequencies;
    }

    public function name()
    {
        return $this->name;
    }

    public function save()
    {
        if(isset($this->modified)) {
            $this->modified = date(DATE_W3C);
        }

        return parent::save();
    }

    /**
     * @param \PHPixie\Slice\Type\ArrayData $data
     */
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
                case 'keywordGroupId':
                    $this->setField($key, $value ? $value : 1);
                    break;
                case 'publish':
                    $this->setField($key, $value);
                    break;
                default:
                    $this->setIsNull($key, $value);
                    break;
            }
        }
        $this->save();
    }

    public function setData($data = array())
    {
        foreach($data as $key => $value) {
            $this->setField($key, $value);
        }
    }

    /**
     * @param string $field
     * @param mixed  $value
     * @param null   $default
     */
    public function setIsNull($field, $value, $default = null)
    {
        $this->setField($field, $value !== '' ? $value : $default);
    }

    public function setSeason($season, $season_start, $season_end)
    {
        $this->setField('season', (int)$season);
        if($season) {
            $this->setField(
                'season_start',
                $season_start ? date('Y-m-d', date_create($season_start)->getTimestamp()) : null
            );
            $this->setField('season_end', $season_end ? date('Y-m-d', date_create($season_end)->getTimestamp()) : null);
        } else {
            $this->setField('season_start', null);
            $this->setField('season_end', null);
        }
    }

    public function table()
    {
        return $this->builder->components()->orm()->repository($this->modelName())->config()->get('table');
    }

    /**
     * @param array|string $url
     * @param array        $query
     * @param string       $resolverPath
     * @return \PHPixie\HTTP\Messages\URI|\Psr\Http\Message\UriInterface
     */
    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return $this->builder->components()->url()->url($url, $query, $resolverPath);
    }
}
