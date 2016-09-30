<?php
/**
 * InClass06
 * Group3_InClass06.zip
 * Dallas Sanchez
 * Matthew Higgins
 */
require_once('database.php');

//$name = filter_input(INPUT_POST, "instrumentName");
//$price = filter_input(INPUT_POST, "price");


$instrumentID = filter_input(INPUT_POST, "ID");

$queryInital = "SELECT categoryID FROM Instruments WHERE instrumentID = :instrumentID";
$statement1 = $db->prepare($queryInital);
$statement1->bindParam(':instrumentID', $instrumentID);

$statement1->execute();
$initalInstrumentArray = $statement1->fetchAll();
$initalInstrument = $initalInstrumentArray[0];
$statement1->closeCursor();

$categoryID = $initalInstrument[0][0];


//
//"UPDATE MyGuests SET lastname='Doe', name= WHERE id=2"
// Get all categories
$deleteInstrument = "DELETE FROM Instruments WHERE instrumentID = :instrumentID";

$statement2 = $db->prepare($deleteInstrument);

$statement2->bindParam(':instrumentID', $instrumentID);
$statement2->execute();
$statement2->closeCursor();

//DELETE Instruments WHERE instrumentID =


$queryProducts = "SELECT * FROM Instruments
              WHERE categoryID = :categoryID
              ORDER BY instrumentID";

$statement3 = $db->prepare($queryProducts);

$statement3->bindParam(':categoryID', $categoryID);

$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();

?>


<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="../main.css"/>
</head>

<!-- the body section -->
<body>
<h1>1 records UPDATED successfully</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th class="right">Price</th>
    </tr>

    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo $product['instrumentID'];?></td>
            <td><?php echo $product['instrumentName']; ?></td>
            <td class="right"><?php echo $product['listPrice']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>