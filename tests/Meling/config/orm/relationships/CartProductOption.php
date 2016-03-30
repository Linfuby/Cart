<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'option',
    'items'        => 'cart',
    'ownerOptions' => array(
        'itemsProperty' => 'cart',
    ),
    'itemsOptions' => array(
        'ownerProperty' => 'option',
        'ownerKey'      => 'optionId',
        'onOwnerDelete' => 'delete',
    ),
);
