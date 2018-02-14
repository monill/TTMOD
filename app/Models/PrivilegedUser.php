<?php

namespace App\Models;

use App\Libs\Database;

class PrivilegedUser extends User
{
    private $roles;
    public $db;

    public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    //override user method
    public static function getByUsername($username)
    {
        $db = Database::getInstance();

        $stm = $db->select1("SELECT * FROM users WHERE username = :username", ["username" => $username]);

        if (!empty($stm))
        {
            $privUser = new PrivilegedUser();
            $privUser->user_id = $stm->id;
            $privUser->username = $username;
            $privUser->initRoles();

            return $privUser;
        } else {
            return false;
        }
    }

    // populate roles with their associated permissions
    protected function initRoles()
    {
        $this->roles = array();

        $sth = $this->db->select("SELECT t1.role_id, t2.role_name FROM user_roles as t1 JOIN roles as t2 ON t1.role_id = t2.role_id WHERE t1.user_id = :user_id", ["user_id" => $this->user_id]);

        foreach ($sth as $sth) {
            $this->roles[$sth->role_name] = Role::getRolePerms($sth->role_id);
        }
    }

    //check if user has a specific privilage
    public function hasPrivilege($perm)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }

    // check if a user has a specific role
    public function hasRole($role_name)
    {
        return isset($this->roles[$role_name]);
    }

    // insert a new role permission association
    public static function insertPerm($role_id, $perm_id)
    {
        $db = Database::getInstance();
        $sth = $db->insert("role_perms", [
            'role_id' => $role_id,
            'perm_id' => $perm_id
        ]);
        return $sth;
    }

    // delete ALL role permissions
    public static function deletePerms()
    {
        $db = Database::getInstance();
        $sth = $db->prepare("TRUNCATE role_perms");
        return $sth->execute();
    }
}
