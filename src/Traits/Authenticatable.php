<?php
namespace Arrounded\Traits;

use Hash;
use Illuminate\Auth\Authenticatable as CoreAuthenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

/**
 * A model with Auth capabilities.
 */
trait Authenticatable
{
    use CoreAuthenticatable;
    use CanResetPassword;

    /**
     * Hash password before save.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
