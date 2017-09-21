<?php

namespace App;

use App\Library\Eeyes\Api\Permission;
use App\Library\Eeyes\Api\XjtuUserInfo;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CasUser implements Authenticatable, \Serializable
{
    protected $net_id = null;
    protected $name = '';
    protected $permissions = [];
    protected $permission_msg = '';

    public function __construct($net_id)
    {
        $this->net_id = $net_id;
        $this->updateSession();
    }

    public function can($permission)
    {
        if (!is_string($permission)) {
            throw new \Exception('$permission must be string.');
        }
        if (!isset($this->permissions[$permission])) {
            $this->permissions[$permission] = Permission::username($this->net_id, $permission);
            $this->updateSession();
        }
        $this->permission_msg = $this->permissions[$permission]['msg'];
        return $this->permissions[$permission]['can'];
    }

    public function getPermissionMsg()
    {
        return $this->permission_msg;
    }

    public function getName()
    {
        if (empty($this->name)) {
            $this->name = XjtuUserInfo::getByNetId($this->net_id)['username'];
            $this->updateSession();
        }
        return $this->name;
    }

    public function updateSession() {
        Session::put('cas_user', $this);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'net_id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->net_id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return '*';
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return Crypt::encrypt(serialize($this));
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'net_id';
    }

    /**
     * String representation of object
     *
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            'net_id' => $this->net_id,
            'permissions' => $this->permissions,
            'name' => $this->name,
        ]);
    }

    /**
     * Constructs the object
     *
     * @link http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $result = unserialize($serialized);
        $this->net_id = $result['net_id'];
        $this->permissions = $result['permissions'];
        $this->name = $result['name'];
    }
}
