<?php
function getPDOType($type){
        if ($type == "s") {
            return PDO::PARAM_STR;
        } else if($type == "i"){
            return PDO::PARAM_INT;
        }
    }
    function selectDB($sql, $types, $keys = [], $param = []){
        global $db;
        $conn = $db->prepare($sql);
        for ($i=0; $i <count($param) ; $i++) { 
            $pdoStatement = getPDOType($types[$i]);
            $conn->bindParam(":".$keys[$i], $param[$i], $pdoStatement);
        }
        $conn->execute();
        $data = $conn->fetchAll(PDO::FETCH_ASSOC);
        return $data;   
    }
    function insertDB($sql, $types, $keys = [], $param = []){
        global $db;
        $conn = $db->prepare($sql);
        for ($i=0; $i <count($param) ; $i++) { 
            $pdoStatement = getPDOType($types[$i]);
            $conn->bindParam(":".$keys[$i], $param[$i], $pdoStatement);
        }
        return $conn->execute();
    }
    function updateDB($sql, $types, $keys = [], $param = []){
        global $db;
        $conn = $db->prepare($sql);
        for ($i=0; $i <count($param) ; $i++) { 
            $pdoStatement = getPDOType($types[$i]);
            $conn->bindParam(":".$keys[$i], $param[$i], $pdoStatement);
        }
        return $conn->execute();
    }
?>
