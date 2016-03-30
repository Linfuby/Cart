<?php
return array(
    'type'         => 'manyToMany',
    'left'         => 'product',
    'right'        => 'option',
    'leftOptions'  => array(
        'property' => 'optionsRests',
    ),
    'rightOptions' => array(
        'property' => 'productsRests',
    ),
    'pivot'        => 'shopRests',
    'pivotOptions' => array(
        'leftKey'  => 'productId',
        'rightKey' => 'optionId',
    ),
);
