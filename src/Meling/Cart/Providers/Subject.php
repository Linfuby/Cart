<?php
namespace Meling\Cart\Providers;

interface Subject
{
    /**
     * @return mixed
     */
    public function cards();

    /**
     * @return \DateTime
     */
    public function dateActual();

    /**
     * @return \DateTime
     */
    public function dateBirthday();

    /**
     * @return \DateTime
     */
    public function dateMarriage();

}
