<?php
namespace Models;

use Database\PDOSQL;

class Teams
{
    const TABLE = 'teams';
    /**
     * Retorna todos os items
     * @return array
     * */
    static function get(){
        $queryStatement = 'SELECT * FROM ' . Teams::TABLE;
        $result = PDOSQL::query($queryStatement);
        return $result;
    }
    /**
     * Adiciona um item
     * @return number
     * */
    static function new($data){
        $queryStatement = 'INSERT INTO ' . Teams::TABLE;
        $queryStatement .= ' (name, school_id) VALUES (:name, :school_id)';
        $bind = array(
            ':name' => $data['name'],
            ':school_id' => $data['school_id']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
    /**
     * Edita um item
     * @return number
     * */
    static function edit($id, $data){
        $queryStatement = 'UPDATE ' . Teams::TABLE;
        $queryStatement .= ' SET name = :name ';
        $queryStatement .= 'WHERE id = :id;';
        $bind = array(
            ':id' => $id,
            ':name' => $data['name']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
    /**
     * Deleta um item
     * @return number - qtd de linhas afetadas
     * */
    static function del($id){
        $queryStatement = 'DELETE FROM ' . Teams::TABLE;
        $queryStatement .= ' WHERE id = :id;';
        $bind = array(
            ':id' => $id
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
}