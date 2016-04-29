<?php
return array(
    'type'  => 'manyToMany',
    'left'  => 'shop',
    'right' => 'certificate',
    'pivot' => 'restCertificates',
);
