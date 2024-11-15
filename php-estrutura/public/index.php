<?php

use PhpParser\Node\Stmt\TryCatch;

require("../vendor/autoload.php");
require("bootstrap.php");


try {

} catch (Exception $e) {
    var_dump($e->getMessage());
        
}

//echo TESTE;
router();