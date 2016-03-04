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
        if($actionId = $this->session->get('actionId')) {
            return $this->repositories->get('action')->query()->in($actionId)->findOne();
        }

        return null;
    }

    /**
     * @param \DateTime $dateActual
     * @param \DateTime $dateBirthday
     * @param \DateTime $dateMarriage
     * @return \Meling\Cart\Actions\Action[]
     */
    public function actions($dateActual = null, $dateBirthday = null, $dateMarriage = null)
    {
        // TODO: Implement actions() method.
    }

    /**
     * @param \DateTime $dateActual
     * @return \Meling\Cart\Actions\Action[]
     */
    public function actionsAfter($dateActual = null)
    {
        // TODO: Implement actionsAfter() method.
    }


}
