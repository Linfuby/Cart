<?php
namespace Meling\Cart;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions
{
    /**
     * @var Providers\Environment
     */
    protected $environment;

    /**
     * @var Providers\Subject
     */
    protected $subject;

    /**
     * @var Totals
     */
    protected $totals;

    /**
     * Products constructor.
     * @param Providers\Environment $environment
     * @param Providers\Subject     $subject
     * @param Totals                $totals
     */
    public function __construct(Providers\Environment $environment, Providers\Subject $subject, Totals $totals)
    {
        $this->environment = $environment;
        $this->subject     = $subject;
        $this->totals      = $totals;
    }

    public function asArray()
    {
        return $this->environment->actions(
            $this->subject->dateActual(), $this->subject->dateBirthday(), $this->subject->dateMarriage()
        );
    }

    public function get()
    {
        try {
            if($action = $this->environment->action()
            ) {
                return new Actions\Action($this->totals, $action);
            }
        } catch(\Exception $e) {
            return new Actions\Action($this->totals);
        }

        return new Actions\Action($this->totals);
    }
}
