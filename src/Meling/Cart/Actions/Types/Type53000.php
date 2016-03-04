<?php
namespace Meling\Cart\Actions\Types;

/**
 * Информационная акция
 * Class Type53000
 * @package Meling\Cart\Actions\Types
 */
class Type53000 extends Type
{
    public function name()
    {
        if($this->action) {
            return $this->action->name;
        }

        return 'Без Акции';
    }

    /**
     * @return int
     */
    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}