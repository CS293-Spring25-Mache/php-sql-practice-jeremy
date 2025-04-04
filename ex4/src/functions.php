<?php

function dbConnect(){
    /*** connection credentials *******/
    $servername = "mysqlServer";
    $username = "fakeAirbnbUser";
    $password = "apples11Million!";
    $database = "fakeAirbnb";
    $dbport = 3306;
    /****** connect to database **************/

    try {
        $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4;port=$dbport", $username, $password);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $db;
}




/* query with no SQL arguments */
function getFiveHoods($db){
    try {
        $stmt = $db->prepare("select * from neighborhoods order by neighborhood asc limit 5");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    }
    catch (Exception $e) {
        echo $e;
    }
    
}

function getListingByNid($db, $id){
    // echo $num;
     try {
         $stmt = $db->prepare("select name, pictureUrl from listings where neighborhoodId= ? limit 1 ");   
         $data=array($id); //create an array of dynamic arguments, in the order they appear in the query
         $stmt->execute($data);
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     catch (Exception $e) {
         echo $e;
     }
     return $rows;
     
 }





?>