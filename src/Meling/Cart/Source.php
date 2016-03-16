<?php
namespace Meling\Cart;

class Source
{
    /**
     * @var \PHPixie\HTTP\Context\Session
     */
    protected $session;

    /**
     * @var \PHPixie\ORM\Repositories
     */
    protected $repositories;

    /**
     * Source constructor.
     * @param \PHPixie\HTTP\Context\Session $session
     * @param \PHPixie\ORM\Repositories     $repositories
     */
    public function __construct(\PHPixie\HTTP\Context\Session $session, \PHPixie\ORM\Repositories $repositories)
    {
        $this->session      = $session;
        $this->repositories = $repositories;
    }

    /**
     * @return \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    public function action()
    {
        if($actionId = $this->session->get('actionId')) {
            return $this->repositories->get('action')->query()->in($actionId)->findOne();
        }

        return null;
    }

    /**
     * @param bool      $after
     * @param \DateTime $dateActual
     * @param \DateTime $dateBirthday
     * @param \DateTime $dateMarriage
     * @return mixed
     */
    public function getActions($after = false, $dateActual = null, $dateBirthday = null, $dateMarriage = null)
    {
        /**
         * @var \PHPixie\ORM\Wrappers\Type\Database\Query $query
         */
        $query = $this->repositories->get('action')->query();
        $query->where('publish', 1);
        $query->whereNot('actionTypeId', 53001);
        $query->where('after', (int)$after);
        // Диапазон дат
        if($dateActual instanceof \DateTime) {
            $week       = $dateActual->format('N');
            $dateActual = $dateActual->format('Y-m-d H:i:s');
        } else {
            $week       = date('N');
            $dateActual = new \PHPixie\Database\Type\SQL\Expression('NOW()');
        }
        if($dateBirthday === null) {
            $query->notRelatedTo('actionType', 53006);
        }
        if($dateMarriage === null) {
            $query->notRelatedTo('actionType', 53007);
        }

        $query->startAndGroup();
        $query->orWhere('week', null);
        $query->orWhere('week', 'like', '%' . $week . '%');
        $query->endGroup();

        $query->startAndGroup();
        $query->where('date_start', '<=', $dateActual);
        $query->where('date_end', '>=', $dateActual);
        $query->orWhere(
            function (\PHPixie\ORM\Conditions\Builder\Container $query) {
                $query->orWhere('date_end', '0000-00-00 00:00:00');
                $query->orWhere('date_end', null);
            }
        );
        $query->endGroup();

        return $query->find();
    }

    public function query($modelName)
    {
        return $this->repositories->get($modelName)->query();
    }

    public function repository($modelName)
    {
        return $this->repositories->get($modelName);
    }

    public function session()
    {
        return $this->session;
    }
}
