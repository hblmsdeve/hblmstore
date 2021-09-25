<?php

    $order = new OrdersController();
    foreach($_SESSION as $name => $product){
        if(substr($name, 0, 8) == "product_"){
        $data = array(
            "fullname" => $_SESSION["fullname"],
            "product" => $product["title"],
            "qte" => $product["qte"],
            "price" => $product["price"],
            "total" => $product["total"]
        );
        $order->addOrder($data);
        }else{
            Redirect::to("home");
        }
    }

?>