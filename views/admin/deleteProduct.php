<?php

    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
        $deleteproduct = new ProductsController();
        $deleteproduct->removeProduct();
    }else{
        Redirect::to("home");
    }

?>