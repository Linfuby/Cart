<?php
namespace Meling\Tests;

class ORMStub extends \PHPixie\ORM
{
    public function __construct()
    {
        $slice    = new \PHPixie\Slice;
        $database = new \PHPixie\Database(
            $slice->arraySlice(
                [
                    'default' => [
                        'driver'     => 'pdo',
                        'connection' => 'mysql:host=localhost;dbname=parishop_pixie',
                        'database'   => 'parishop_pixie',
                        'user'       => 'parishop',
                        'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                    ],
                ]
            )
        );
        $wrappers = new WrappersStub();
        parent::__construct(
            $database, $slice->arrayData(
            [
                'relationships' => array(
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'customer',
                        'items' => 'cartOption',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'option',
                        'items' => 'cartOption',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'customer',
                        'items' => 'cartCertificate',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'certificate',
                        'items' => 'cartCertificate',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'order',
                        'items' => 'orderOption',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'option',
                        'items' => 'orderOption',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'certificate',
                        'items' => 'orderCertificate',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'order',
                        'items' => 'orderCertificate',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'customer',
                        'items' => 'address',
                    ),
                    array(
                        'type'         => 'oneToOne',
                        'owner'        => 'address',
                        'item'         => 'customer',
                        'ownerOptions' => array(
                            'itemProperty' => 'customers',
                        ),
                        'itemOptions'  => array(
                            'ownerProperty' => 'address',
                            'ownerKey'      => 'addressId',
                        ),
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'customer',
                        'items' => 'customerCard',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'customer',
                        'items' => 'order',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'city',
                        'items' => 'order',
                    ),
                    array(
                        'type'  => 'oneToMany',
                        'owner' => 'actionType',
                        'items' => 'action',
                    ),
                ),
            ]
        ), $wrappers
        );
    }

}
