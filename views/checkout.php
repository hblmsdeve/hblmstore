<?php
ob_start();
    if(isset($_POST["product_id"])){
        $id = $_POST["product_id"];
        $data = new ProductsController();
        $product = $data->getProduct();
    
        if($_SESSION["product_".$id]["title"] == $_POST["product_title"]){
            Session::set("info","Vous avez déja ajouté ce produit au panier");
            Redirect::to("cart");
        }else{
            if($product->quantity < $_POST["product_qte"]){
                Session::set("info", "La quantité disponible est : $product->quantity");
                Redirect::to("cart");
            }else{
                $_SESSION["product_".$product->id] = array(
                    "id" => $product->id,
                    "title" => $product->title,
                    "price" => $product->price,
                    "qte" => $_POST["product_qte"],
                    "total" => $product->price * $_POST["product_qte"],
                );
                $_SESSION["totaux"] += $_SESSION["product_".$product->id]["total"];
                $_SESSION["count"] += 1;
                Redirect::to("cart");
            }
        }
    }else{
        Redirect::to("cart");
    }
ob_end_clean();
?>