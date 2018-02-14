<?php

namespace App\Models;

use App\Libs\Database;

class Role {

    protected $permissions;
    public $db;

    protected function __construct()
    {
        $this->permissions = array();
        $this->db = Database::getInstance();
    }

    private function __clone() { }

    // return a role object with associated permissions
    public static function getRolePerms($role_id)
    {
        $db = Database::getInstance();
        $role = new Role();

        $stm = $db->select("SELECT t2.perm_desc FROM role_perms as t1 JOIN permissions as t2 ON t1.perm_id = t2.perm_id WHERE t1.role_id = :role_id", ["role_id" => $role_id]);

        foreach ($stm as $stm) {
            $role->permissions[$stm->perm_desc] = true;
        }
        return $role;
    }

    // check if a permission is set
    public function hasPerm($permission)
    {
        return isset($this->permissions[$permission]);
    }

    // insert a new role
    public static function insertRole($role_name)
    {
        $db = Database::getInstance();

        $sql = $db->insert('roles', [
            'role_name' => $role_name
        ]);
        return $sql;
    }

    // insert array of roles for specified user id
    public static function insertUserRoles($userid, $roles)
    {
        $db = Database::getInstance();

        foreach ($roles as $role_id) {
            $sql = $db->insert('user_roles', [
                'user_id' => $userid,
                'role_id' => $role_id
            ]);
        }

        return $sql;
    }

    // delete array of roles, and all associations
    public static function deleteRoles($roles)
    {
        $db = Database::getInstance();

        $sql = "DELETE t1, t2, t3 FROM roles as t1
            JOIN user_roles as t2 on t1.role_id = t2.role_id
            JOIN role_perms as t3 on t1.role_id = t3.role_id
            WHERE t1.role_id = :role_id";

        $sth = $db->prepare($sql);
        $sth->bindParam(":role_id", $role_id, \PDO::PARAM_INT);
        foreach ($roles as $role_id) {
            $sth->execute();
        }
        return true;
    }

    public static function deleteUsersRoles($userid)
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM user_roles WHERE user_id = :user_id";
        $sth = $db->prepare($sql);
        return $sth->execute([":user_id" => $userid]);
    }
}
