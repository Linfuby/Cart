<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'shop',
    'items'        => 'cart',
    'ownerOptions' => array(
        'itemsProperty' => 'cart',
    ),
    'itemsOptions' => array(
        'ownerProperty' => 'shop',
        'ownerKey'      => 'shopId',
        'onOwnerDelete' => 'delete',
    ),
);
