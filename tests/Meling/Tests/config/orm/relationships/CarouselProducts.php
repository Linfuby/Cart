<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'carousel',
    'right' => 'product',
    'pivot' => 'carouselProducts',
);