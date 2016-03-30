<?php
return array(
    'type'         => 'oneToOne',
    'owner'        => 'address',
    'item'         => 'customer',
    'ownerOptions' => array(
        'itemProperty' => 'customers',
    ),
    'itemOptions'  => array(
        'ownerProperty' => 'address',
        'ownerKey'      => 'addressId',
    ),
);
