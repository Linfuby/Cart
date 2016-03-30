<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'address',
    'items'        => 'cart',
    'ownerOptions' => array(
        'itemsProperty' => 'cart',
    ),
    'itemsOptions' => array(
        'ownerProperty' => 'address',
        'ownerKey'      => 'addressId',
        'onOwnerDelete' => 'delete',
    ),
);
