<?php
class Model{
    protected $table;
    protected static $pdo = null;

    function __construct() {
        if (self::$pdo === null) {
            $pdo = new PDO('mysql:dbname=bet;host=localhost','axel','AQWzsx1654');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$pdo = $pdo;
        }
    }

    function exists($query, $params){
        $query = $this::$pdo->prepare($query);
        $query->execute($params);
        $result = $query->fetch();
        if(is_object($result)){
            return true;
        }
        else{
            return false;
        }
    }

    function getAll($table){
        $query = $this::$pdo->prepare('SELECT * FROM ' . $table);
        $query->execute();
        if(is_object($query)){
            while($row = $query->fetch()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
?>
