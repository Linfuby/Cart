<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'product',
    'right' => 'size',
    'pivot' => 'productOptions',
);
