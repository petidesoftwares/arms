<?php
    $value = "0c4988e81c221b3cc98b1f9f8fb709d151c87a24b26706bf5009d39a7ea5b4b67a9e918e66aabfc212da9132751b67e13b7bff914254870f6a67d1fbb13e0529";
    $algorithm = "sha512";
    $res = hash($algorithm, "petide123");
    echo $value. "<br>".$res;
    
?>