<?php
namespace Models;

use Database\PDOSQL;

class Users
{
    const TABLE = 'users';
    /**
     * verify if users exists and password is correct
     * @return array|false false if pass is incorrect
     * */
    static function auth($email, $password){
        // 'SELECT * FROM users where email == "email" and password =="password"';
        $queryStatement = 'SELECT * FROM ' . Users::TABLE;
        $queryStatement .= ' WHERE email = :email;';
        $bind = array(':email' => $email);
        $result = PDOSQL::query($queryStatement, $bind);
        if ($result){
            return password_verify($password, $result[0]['password']) ? $result[0] : false;
        }
        return false;
    }
    /**
     * verify if users send by token exists an is correct
     * @return bool true if is correct
     * */
    static function isUserAuthorized($json){
        $data = json_decode($json, true);
        $queryStatement = 'SELECT * FROM ' . Users::TABLE;
        $queryStatement .= ' WHERE id = :id AND';
        $queryStatement .= ' email = :email;';
        $bind = array(
            ':id' => $data['id'],
            ':email' => $data['email']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result ? $result : false;
    }
}