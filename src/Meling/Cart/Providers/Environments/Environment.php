<?php
namespace Meling\Cart\Providers\Environments;

class Environment implements \Meling\Cart\Providers\Environment
{
    /**
     * @var \PHPixie\HTTP\Context\Session\SAPI
     */
    protected $session;

    /**
     * @var \PHPixie\ORM\Repositories
     */
    protected $repositories;

    /**
     * @var \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    protected $actions;

    /**
     * @var \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    protected $actionsAfter;

    /**
     * @var
     */
    protected $action;

    /**
     * Session constructor.
     * @param \PHPixie\HTTP\Context\Session\SAPI $session
     * @param \PHPixie\ORM\Repositories          $repositories
     */
    public function __construct($session, $repositories)
    {
        $this->session      = $session;
        $this->repositories = $repositories;
    }

    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    public function action()
    {
        if($this->action === null) {
            if($actionId = $this->session->get('actionId')) {
                $this->action = $this->repositories->get('action')->query()->in($actionId)->findOne();
            }
        }

        return $this->action;
    }

    /**
     * @param \DateTime $dateActual
     * @param \DateTime $dateBirthday
     * @param \DateTime $dateMarriage
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    public function actions($dateActual = null, $dateBirthday = null, $dateMarriage = null)
    {
        if($this->actions === null) {
            $this->actions = $this->getActions(false, $dateActual, $dateBirthday, $dateMarriage);
        }

        return $this->actions;
    }

    /**
     * @param \DateTime $dateActual
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    public function actionsAfter($dateActual = null)
    {
        if($this->actionsAfter === null) {
            $this->actionsAfter = $this->getActions(true, $dateActual);
        }

        return $this->actionsAfter;
    }

    /**
     * @param bool      $after
     * @param \DateTime $dateActual
     * @param \DateTime $dateBirthday
     * @param \DateTime $dateMarriage
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    protected function getActions($after = false, $dateActual = null, $dateBirthday = null, $dateMarriage = null)
    {
        /**
         * @var \PHPixie\ORM\Wrappers\Type\Database\Query $query
         */
        $query = $this->repositories->get('action')->query();
        $query->where('publish', 1);
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
        $query->orWhere('week', 'like', $week);
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

}
