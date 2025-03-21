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
function getTwentyListings($db){
    try {
        $stmt = $db->prepare("select * from listings limit 20");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    }
    catch (Exception $e) {
        echo $e;
    }
    
}


/* query with one SQL argument */
function getListingsBelowPrice($db, $price){
    echo $num;
    try {
        $stmt = $db->prepare("select * from listings where price < ? order by price desc limit 20");   
        $data=array($price); //create an array of dynamic arguments, in the order they appear in the query
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        echo $e;
    }
    return $rows;
    
}

/* query with two SQL arguments */
function getListingsByNeighborhoodIdAndMaxPrice($db, $price, $neighborhoodId){
    try {
        $stmt = $db->prepare("select * from listings
        join neighborhoods  on neighborhoods.id=listings.neighborhoodId 
        where listings.price <= ? and neighborhoods.id = ? 
        order by listings.price desc  
        limit 5");
        $data=array($price, $neighborhoodId); //array of arguments, in order  
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    
    }
    catch (Exception $e) {
        echo $e;
    }
    return $rows;
    
}
?>
<pre>
    <code> <!-- this makes var_dump() easier to read-->

<?php
//get database connection
$db=dbConnect();

# 1. 
//get 20 entries from listings table
//$rows=getTwentyListings($db);
//var_dump($rows);

# 2. 
// get twenty entries from listings table below $price
//$price=150;
//$rows=getListingsBelowPrice($db, $price);
//var_dump($rows);

// get listings from neighborhood (given id) and max price (given price)
$neighborhoodId=22; //Eastmoreland
$price=100;
//$rows=getListingsByNeighborhoodIdAndMaxPrice($db, $neighborhoodId, $price);
        /** see the resulting array **/
/*        
var_dump($rows);

 //loop through the rows: 
foreach ($rows as $row){
    $id=$row["id"];
    $name=$row["name"];
    $price=$row["price"];

    echo "<p>id: $id, name: $name, price: $price</p>";
}
*/

?>
    </code>
</pre>