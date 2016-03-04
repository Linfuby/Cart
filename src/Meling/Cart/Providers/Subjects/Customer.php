<?php
namespace Meling\Cart\Providers\Subjects;

class Customer implements \Meling\Cart\Providers\Subject
{
    /**
     * @return array
     */
    public function cards()
    {
        return array(
            (object)array(
                'id'       => 1,
                'number'   => '10',
                'discount' => 5,
                'rewards'  => 500,
            ),
            (object)array(
                'id'       => 2,
                'number'   => '20',
                'discount' => 15,
                'rewards'  => 1500,
            ),
        );
    }

    /**
     * @return \DateTime
     */
    public function dateActual()
    {
        // TODO: Implement dateActual() method.
    }

    /**
     * @return \DateTime
     */
    public function dateBirthday()
    {
        // TODO: Implement dateBirthday() method.
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        // TODO: Implement dateMarriage() method.
    }

}
