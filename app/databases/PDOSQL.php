<?php
namespace Database;

use \PDO;

/**
 * Conexão com o bd mysql
 */
class PDOSQL
{
    /**
     * Execute query and bind
     * @param string $query - the query
     * @param array $bind - bind the paras with this key => values
     * @return array array com os valores em caso de select, num de rows caso adicione, edite, delete
     */
    static function query(string $query, $bind = []){
        // conexão
        try{
            $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            print "Erro!: " . $e->getMessage() . "<br/>";
            die();
        }
        // query
        $stmt = $conn->prepare($query);
        foreach ($bind as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // desconexão
        $conn = null;
        // retorna
        return $result ? $result : $stmt->rowCount();
    }
}