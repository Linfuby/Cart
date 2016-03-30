<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'product',
    'right' => 'girth',
    'pivot' => 'productOptions',
);
