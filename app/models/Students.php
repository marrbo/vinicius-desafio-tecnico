<?php
namespace Models;

use Database\PDOSQL;

class Students
{
    const TABLE = 'students';
    /**
     * Retorna todos os items
     * @return array
     * */
    static function get(){
        $queryStatement = 'SELECT * FROM ' . Students::TABLE;
        $result = PDOSQL::query($queryStatement);
        return $result;
    }
    /**
     * Adiciona um item
     * @return number
     * */
    static function new($data){
        $queryStatement = 'INSERT INTO ' . Students::TABLE;
        $queryStatement .= ' (name, team_id) VALUES (:name, :team_id)';
        $bind = array(
            ':name' => $data['name'],
            ':team_id' => $data['team_id']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
    /**
     * Edita um item
     * @return number
     * */
    static function edit($id, $data){
        $queryStatement = 'UPDATE ' . Students::TABLE;
        $queryStatement .= ' SET name = :name ';
        $queryStatement .= ', team_id = :team_id ';
        $queryStatement .= 'WHERE id = :id;';
        $bind = array(
            ':id' => $id,
            ':name' => $data['name'],
            ':team_id' => $data['team_id']
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
    /**
     * Deleta um item
     * @return number - qtd de linhas afetadas
     * */
    static function del($id){
        $queryStatement = 'DELETE FROM ' . Students::TABLE;
        $queryStatement .= ' WHERE id = :id;';
        $bind = array(
            ':id' => $id
        );
        $result = PDOSQL::query($queryStatement, $bind);
        return $result;
    }
}