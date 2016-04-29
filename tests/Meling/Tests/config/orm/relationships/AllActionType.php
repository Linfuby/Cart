<?php
return array(
    'type'  => 'oneToMany',
    'owner' => 'actionType',
    'items' => 'allAction',
    'ownerOptions' => array(
        'property' => 'actions'
    )
);