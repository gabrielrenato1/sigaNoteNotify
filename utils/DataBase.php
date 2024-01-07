<?php

namespace utils;

use PDO;

class DataBase
{

    public PDO $connection;

    public function __construct()
    {

        $pdo = new PDO(
            'mysql:host=localhost;dbname=INFORMATION_SCHEMA',
            'root',
            'rootpassword'
        );

        $query = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'db_siga_notes'");

        if($query->fetch(PDO::FETCH_OBJ) === false){
            die("Database schema not setted. Please, run the following command: php TomatePelado.php");
        }

        $pdo->exec("USE db_siga_notes");

        $this->connection = $pdo;

    }

    public function createDatabase(){

//        create schema db_siga_notes;
//
//        create table notes
//                (
//                    id            int auto_increment,
//            class_code    varchar(10)  not null,
//            class_name    varchar(191) null,
//            class_period  int          null,
//            is_approved   int          null,
//            average       float        null,
//            absence       int          null,
//            observation   varchar(225) null,
//            constraint notes_pk
//                primary key (id)
//        )
//            collate = utf8mb3_bin;

    }

    public function insert($table, $data):void{

        $keyBinds = implode(',', array_fill(0,count($data),"?"));
        $columns = implode(',',array_keys($data));
        $query = "INSERT INTO ". $table . " (" . $columns . ") VALUES(" . $keyBinds . ")";

        $stmt = $this->connection->prepare($query);

        for($i = 1; $i <= count($data); $i++){
            $stmt->bindParam($i, array_values($data)[$i-1]);
        }

        $stmt->execute();

        if($stmt->errorInfo()[0] !== "00000"){
            die($stmt->errorInfo()[2]);
        }

    }

    public function list($table, $arrSelect = "*"):array{

        $select = is_array($arrSelect) && !empty($arrSelect) ? implode(",", $arrSelect) : "*";
        $stmt = $this->connection->query("SELECT " . $select . " FROM ". $table);

        $response = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $response[] = $row;
        }

        return $response;

    }

}
