<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'shop',
    'right' => 'product',
    'pivot' => 'shopRests',
);
