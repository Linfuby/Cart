<?php
namespace Meling\Cart\Cards;

/**
 * Interface Implementation
 * @package Meling\Cart\Cards
 */
interface Implementation
{
    public function discount();

    public function id();

    public function name();

    public function rewards();

}