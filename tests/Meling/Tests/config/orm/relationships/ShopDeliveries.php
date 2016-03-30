<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'shop',
    'right' => 'delivery',
    'pivot' => 'shopTariffs',
);
