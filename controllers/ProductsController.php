<?php

    class ProductsController{

        public function getAllProducts(){
            $products = Product::getAll();
            return $products;
        }
        public function getProductsByCategory($id){
            if(isset($id)){
                $data = array('id' => $id);
                $products = Product::getProductByCat($data);
                return $products;
            }
        }
        public function getProduct(){
            if(isset($_POST["product_id"])){
                $data = array('id' => $_POST["product_id"]);
                $product = Product::getProductById($data);
                return $product;
            }
        }
        public function emptyCart($id, $price){
            unset($_SESSION["product_" .$id]);
            $_SESSION["count"] -= 1;
            $_SESSION["totaux"] -= $price;
            Redirect::to("cart");
        }

        public function newProduct(){
            if(isset($_POST["submit"])){
                $data = array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "quantity" => $_POST["quantity"],
                    "short_descr" => $_POST["short_descr"],
                    "image" => $this->uploadPhoto(),
                    "old_price" => $_POST["old_price"],
                    "price" => $_POST["price"],
                    "cat_id" => $_POST["cat_id"],
                );
                $result = Product::addProduct($data);
                if($result === "ok"){
                    Session::set("success", "Produit ajouté");
                    Redirect::to("products");
                }else{
                    echo $result;
                }
            }
        }

        public function updateProduct(){
            if(isset($_POST["submit"])){
                $oldImage = $_POST["product_current_image"];
                $data = array(
                    "id" => $_POST["id"],
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "quantity" => $_POST["quantity"],
                    "short_descr" => $_POST["short_descr"],
                    "image" => $this->uploadPhoto($oldImage),
                    "old_price" => $_POST["old_price"],
                    "price" => $_POST["price"],
                    "cat_id" => $_POST["cat_id"],
                );
                $result = Product::editProduct($data);
                if($result === "ok"){
                    Session::set("success", "Produit modifié");
                    Redirect::to("products");
                }else{
                    echo $result;
                }
            }
        }
        
        public function uploadPhoto($oldImage = null){
            $dir = "public/uploads";
            $time = time();
            $name = str_replace(' ','-',strtolower($_FILES["image"]["name"]));
            $type = $_FILES["image"]["type"];
            $ext = substr($name,strpos($name,'.'));
            $ext = str_replace('.','',$ext);
            $name = preg_replace("/\.[^.\s]{3,4}$/", "",$name);
            $imageName = $name.'-'.$time.'.'.$ext;
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$dir."/".$imageName)){
                return $imageName; 
            }
            return $oldImage;
        }

        public function removeProduct(){
            if(isset($_POST['id'])){
                $data['id'] = $_POST['id'];
                $result = Product::deleteProduct($data);
                if($result === 'ok'){
                    Session::set('success', 'Produit Supprimé');
                    Redirect::to('products');
                }else{
                    echo $result;
                }
            }
        }
    }

?>