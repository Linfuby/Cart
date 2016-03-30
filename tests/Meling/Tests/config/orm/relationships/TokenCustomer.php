<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'customer',
    'items'        => 'token',
    'itemsOptions' => array(
        'ownerKey' => 'userId',
    ),
);