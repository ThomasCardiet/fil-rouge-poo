<?php

namespace App\Model;

use Core\Database;

class UserModel
    extends Database
{

    public function getUsersWhere($value)
    {
        return $this->prepare(
            "SELECT * FROM `users` WHERE `username` LIKE ? COLLATE `utf8mb4_unicode_ci`", [
                "%" . $value . "%",
            ]
        );
    }

    public function getUsers()
    {
        return $this->query("SELECT * FROM `users`");
    }

    public function getUserBy($type, $value)
    {
        return $this->prepare(
            "SELECT * FROM users where $type = ?", [
            $value,
        ], true
        );
    }

    public function getInfoUser($id, $type)
    {
        $value = $this->prepare(
            "SELECT $type FROM users WHERE id = ?", [
            $id,
        ], true
        );

        return $value[$type];
    }

    public function addUser($username, $email, $password, $admin = 0)
    {
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        return $this->prepare(
            "INSERT INTO `users`(`username`, `email`, `password`, `admin`) VALUES(?,?,?,?)", [
                $username,
                $email,
                $hashpass,
                $admin
            ]
        );
    }

    public function updateUser($id, $type, $value)
    {
        if ($type === "password") {
            $value = password_hash($value, PASSWORD_BCRYPT);
        }
        return $this->prepare(
            "UPDATE users SET $type = ? WHERE id = ?", [
                $value,
                $id,
            ]
        );
    }

    public function deleteUserBy($type, $value)
    {
        if (!empty($this->getUserBy($type, $value))) {
            return $this->prepare(
                "DELETE FROM `users` WHERE $type = ?", [
                    $value,
                ]
            );
        }

        return false;
    }

    public function existAdmin(){
        $r = $this->prepare("SELECT * FROM `users` WHERE admin = ?", [
            true
        ]);

        return !empty($r);
    }

    public function createAdminFixture(){
        $this->addUser("admin", "admin@gmail.com", "admin0000", 1);
    }
}