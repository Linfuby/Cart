<?php
return array(
    'type'         => 'oneToMany',
    'owner'        => 'option',
    'items'        => 'cartProduct',
    'ownerOptions' => array(
        'itemsProperty' => 'cartProduct',
    ),
    'itemsOptions' => array(
        'ownerProperty' => 'option',
        'ownerKey'      => 'optionId',
        'onOwnerDelete' => 'delete',
    ),
);
