<?php
//ini_set('display_errors', 'on');
include ("boxing.class.php");

$lockers = array( array( "id" => 1, "dimensions" => array ( "x" => 10, "y"=>15, "z" => 3 ) ), array( "id" => 2, "dimensions" => array ( "x" => 5, "y"=>6, "z" => 3 )) );
$products = array( array( "id" => 11, "dimensions" => array ( "x" => 10, "y"=>15, "z" => 3 ) ), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )), array( "id" => 53, "dimensions" => array ( "x" => 5, "y"=>4, "z" => 1 )) );

//$lockers2 = array( array( "id" => 1, "dimensions" => array ( "x" => 10, "y"=>15, "z" => 3 ) ), array( "id" => 2, "dimensions" => array ( "x" => 5, "y"=>6, "z" => 3 )), array( "id" => 2, "dimensions" => array ( "x" => 5, "y"=>6, "z" => 3 )) );
//$products2 = array( array( "id" => 11, "dimensions" => array ( "x" => 10, "y"=>15, "z" => 3 ) ) );

function fitsIn($lockers, $products) {
    // item counter which counts where we are at the moment in the array
    $itemCounter = 0;
    $occupiedLockers = array();

    // initialize boxing element
    $b = new boxing();

    for($i = 0; $i < count($lockers); $i++) {
        //if it is occupied, this value is bigger than 1
        $isOccupied = 0;
        //print "Locker: $i<br/>";
        // first we create outer box
        $b->add_outer_box($lockers[$i]["dimensions"]["x"],$lockers[$i]["dimensions"]["y"],$lockers[$i]["dimensions"]["z"]);
        while($b->fits() && $itemCounter<= count($products) ) {
            //print "Product $itemCounter<br/>";
            $b->add_inner_box($products[$itemCounter]["dimensions"]["x"], $products[$itemCounter]["dimensions"]["y"], $products[$itemCounter]["dimensions"]["z"]);
            $itemCounter++;
            $isOccupied++;
        }
        // we pop last element, after we added, because we added one too much in the last while iteration loop
        $lastPop = array_pop($b->inner_boxes);
        $itemCounter--;

        // add occupied, if value bigger than 1
        if($isOccupied>1) {
            array_push($occupiedLockers, $lockers[$i]);
        }
    }

    $productsLeft =  array_slice($products, $itemCounter);
    //var_dump($prodcutsLeft);


    // array of occupied lockers
    //print count($occupiedLockers);
    //var_dump($occupiedLockers);

    return [ $productsLeft, $occupiedLockers ];
}

fitsIn($lockers, $products);
//fitsIn($lockers2, $products2);


?>

