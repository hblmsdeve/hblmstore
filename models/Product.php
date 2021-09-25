<?php

    class product{
        static public function getAll(){
            $stmt = DB::connect()->prepare('SELECT * FROM products');
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt = null;
        }
        static public function getProductByCat($data){
            $id = $data['id'];
            try{
                $stmt = DB::connect()->prepare('SELECT * FROM products WHERE cat_id = :id');
                $stmt->execute(array(":id" => $id));
                return $stmt->fetchAll();
                $stmt->close();
                $stmt = null;
            }catch(PDOException $ex){
                echo "erreur" .$ex->getMessage();
            }
        }
        static public function getProductById($data){
            $id = $data['id'];
            try{
                $stmt = DB::connect()->prepare('SELECT * FROM products WHERE id = :id');
                $stmt->execute(array(":id" => $id));
                $product = $stmt->fetch(PDO::FETCH_OBJ);
                return $product;
                $stmt->close();
                $stmt = null;
            }catch(PDOException $ex){
                echo "erreur" .$ex->getMessage();
            }
        }

        static public function addProduct($data){
            $stmt = DB::connect()->prepare('INSERT INTO products (title, cat_id, price, old_price, quantity, description, short_descr,image) 
            VALUES (:title, :cat_id, :price, :old_price, :quantity, :description, :short_descr, :image)');
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':cat_id', $data['cat_id']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':old_price', $data['old_price']);
            $stmt->bindParam(':quantity', $data['quantity']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':short_descr', $data['short_descr']);
            $stmt->bindParam(':image', $data['image']);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
            $stmt->close();
            $stmt = null;
        }

        static public function editProduct($data){
            $stmt = DB::connect()->prepare('UPDATE products SET title = :title, cat_id = :cat_id, price = :price, old_price = :old_price,
            quantity = :quantity, description = :description, short_descr = :short_descr,image = :image WHERE id = :id');
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':cat_id', $data['cat_id']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':old_price', $data['old_price']);
            $stmt->bindParam(':quantity', $data['quantity']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':short_descr', $data['short_descr']);
            $stmt->bindParam(':image', $data['image']);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
            $stmt->close();
            $stmt = null;
        }

        static public function deleteProduct($data){
            $id = $data['id'];
            try{
                $query = 'DELETE FROM products WHERE id = :id';
                $stmt = DB::connect()->prepare($query);
                $stmt->execute(array(":id" => $id));
                if($stmt->execute()){
                    return 'ok';
                }
            }catch(PDOException $ex){
                echo 'erreur' . $ex->getMessage();
            }
        }
    }

?>