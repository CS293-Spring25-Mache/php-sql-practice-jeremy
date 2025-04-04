<?php

include("functions.php");

$db=dbConnect();

$id=$_GET["neighborhoodId"];
$listing=getListingByNid($db, $id);

echo json_encode($listing);






?>