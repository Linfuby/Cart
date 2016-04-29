<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'shop',
    'right' => 'option',
    'pivot' => 'restOptions',
);
