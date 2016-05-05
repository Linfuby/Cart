<?php
namespace Meling\Cart\Providers;

interface Repository
{
    public function create($data = array());

    public function deliveries();

    public function load($id);

    public function point();

    public function remove($id);

    public function shops();

}
