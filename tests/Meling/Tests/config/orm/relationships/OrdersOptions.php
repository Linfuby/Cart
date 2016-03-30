<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'order',
    'right' => 'option',
    'pivot' => 'orderProducts',
);