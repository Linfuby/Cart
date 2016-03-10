<?php
namespace Meling\Cart\Providers;

interface Environment
{
    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    public function action();

    /**
     * @param \DateTime $dateActual
     * @param \DateTime $dateBirthday
     * @param \DateTime $dateMarriage
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    public function actions($dateActual = null, $dateBirthday = null, $dateMarriage = null);

    /**
     * @param \DateTime $dateActual
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    public function actionsAfter($dateActual = null);

}
