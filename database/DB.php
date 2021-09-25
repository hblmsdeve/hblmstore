<?php 

    class DB{

        static public function connect(){
            
            $dbname = 'hblmstore';
            $host = 'localhost';
            $user = "root";
            $password = "";

            $db = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
            $db->exec("set names utf8");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            return $db;
            
        }

    }

?>