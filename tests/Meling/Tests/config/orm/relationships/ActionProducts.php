<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'action',
    'right' => 'product',
    'pivot' => 'actionProducts',
);