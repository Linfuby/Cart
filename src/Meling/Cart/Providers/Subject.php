<?php
namespace Meling\Cart\Providers;

abstract class Subject
{
    /**
     * @var mixed
     */
    protected $subject;

    /**
     * @var mixed
     */
    protected $repositories;

    /**
     * @var Objects
     */
    protected $products;

    /**
     * @var Objects
     */
    protected $certificates;

    /**
     * Subject constructor.
     * @param mixed $subject
     * @param mixed $repositories
     */
    public function __construct($subject, $repositories)
    {
        $this->subject      = $subject;
        $this->repositories = $repositories;
    }

    /**
     * @return array
     */
    public abstract function cards();

    /**
     * @return Objects
     */
    public abstract function certificates();

    /**
     * @return \DateTime
     */
    public abstract function dateActual();

    /**
     * @return \DateTime
     */
    public abstract function dateBirthday();

    /**
     * @return \DateTime
     */
    public abstract function dateMarriage();

    /**
     * @return Objects
     */
    public abstract function products();
}
