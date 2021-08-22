<?php
namespace Models;

use Database\PDOSQL;

class Schools
{
    const TABLE = 'schools';
    /**
     * Retorna todos os items
     * @return array
     * */
    static function get(){
        $queryStatement = 'SELECT * FROM ' . Schools::TABLE;
        $result = PDOSQL::query($queryStatement);
        return $result;
    }
    /**
     * Adiciona um item
     * @return number
     * */
    static function new($data){
        $queryStatement = 'INSERT INTO ' . Schools::TABLE;
        $queryStatement .= ' (name) VALUES (:name)';
        $bind = array(
            ':name' => $data['name']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
    /**
     * Edita um item
     * @return number
     * */
    static function edit($id, $data){
        $queryStatement = 'UPDATE ' . Schools::TABLE;
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
     * @return number
     * */
    static function del($id){
        $queryStatement = 'DELETE FROM ' . Schools::TABLE;
        $queryStatement .= ' WHERE id = :id;';
        $bind = array(
            ':id' => $id
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
}