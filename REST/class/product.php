<?php
class Product{
    
    // Connection
    private $conn;
    
    // Table
    private $db_table = "tbl_product";
    
    // Columns
    public $id;
    public $name;
    public $image;
    public $price;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // GET
    public function getProducts(){
        $sqlQuery = "SELECT id, name, image, price FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = $row;
        }
        
        return $data;        
    }
    
    // ADD
    public function addProduct(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name,
                        image = :image,
                        price = :price";
        
        $stmt = $this->conn->prepare($sqlQuery);
        
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->price=htmlspecialchars(strip_tags($this->price));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":price", $this->price);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    
    // UPDATE
    public function updateProduct(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name,
                        image = :image,
                        price = :price
                    WHERE
                        id = :id";
        
        $stmt = $this->conn->prepare($sqlQuery);
        
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    // DELETE
    function deleteProduct(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
}
?>