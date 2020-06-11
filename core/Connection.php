<?php

class Connection {
    public static function dbconn(){
        try{
            return new PDO('mysql:host=localhost;dbname=nextadmin', 'root', 'password');
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}