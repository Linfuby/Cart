<?php
namespace Meling\Cart\Actions;

/**
 * Interface Implementation
 * @package Meling\Cart\Actions
 */
interface Implementation
{
    public function id();

    public function name();

    public function useCard();

    public function useSpecial();

}