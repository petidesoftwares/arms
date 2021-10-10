<?php
//    $algorithm = "sha512";
//    echo hash($algorithm, "UG/21/0003");
$name = "Peter";
header("Location: ../views/testview.php/?name=$name");
?>