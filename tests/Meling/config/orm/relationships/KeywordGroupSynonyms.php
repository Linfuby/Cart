<?php
return array(
    'type'         => 'manyToMany',
    'left'         => 'keywordGroup',
    'right'        => 'keywordGroup',
    'leftOptions'  => array(
        'property' => 'synonyms',
    ),
    'rightOptions' => array(
        'property' => 'groups',
    ),
    'pivot'        => 'keywordGroupsSynonyms',
    'pivotOptions' => array(
        'leftKey'  => 'keywordGroupId',
        'rightKey' => 'synonymId',
    ),
);
