<?php

namespace App\Ldap;

use LdapRecord\Models\Model;

class User extends Model
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = [];

    protected $guidKey = 'uuid';

    public function guardName()
    {
        return 'web';
    }
}
