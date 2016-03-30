<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'articleComment',
    'items'        => 'articleComment',
    'ownerOptions' => array(
        'itemsProperty' => 'children',
    ),
    'itemsOptions' => array(
        'ownerProperty' => 'parent',
    ),
);
