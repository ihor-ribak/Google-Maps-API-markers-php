<?php

include 'connect_db.php';

// Create XML file and parent element
$doc = new DOMDocument('1.0', 'utf-8');
$node = $doc->createElement('markers');
$parnode = $doc->appendChild($node);

// Opening a connection to the MySQL server
$pdo = pdo_connect_mysql();

// Fetching all records from the markers table
$query = $pdo->query("SELECT * FROM markers WHERE 1");
if (!$query) {
    die('Неверный запрос: ' . mysqli_error());
}

header("Content-type: text/xml");

// Loop through all selected records; creating a node for each
while ($row = $query->fetch(PDO::FETCH_ASSOC)){
// Adding a new node to XML
    $node = $doc->createElement("marker");
    $newnode = $parnode->appendChild($node);

    $newnode->setAttribute("id", $row['id']);
    $newnode->setAttribute("name", $row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
}

$xmlfile = $doc->saveXML();
echo $xmlfile;



