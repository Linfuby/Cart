<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'action',
    'right' => 'option',
    'pivot' => 'actionProducts',
);