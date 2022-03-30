<?php 
class Consultation {
    //DB stuff
    private $conn;
    private $table = 'consultations';

    // Consultation Properties
    public $id;
    public $country_id;
    public $country_name;
    public $city;
    public $institution;
    public $date;
    public $timespan;
    public $address;
    public $phone;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get consultations
    public function read() {
        $query = 'SELECT 
                    c.name as country_name,
                    p.id,
                    p.country_id,
                    p.city,
                    p.institution,
                    p.date,
                    p.timespan,
                    p.address,
                    p.phone,
                    p.created_at
                FROM 
                    ' . $this->table . ' p 
                LEFT JOIN 
                    country c ON p.country_id = c.id 
                ORDER BY 
                    p.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Post
    public function read_single() {
        $query = 'SELECT 
                    c.name as country_name,
                    p.id,
                    p.country_id,
                    p.city,
                    p.institution,
                    p.date,
                    p.timespan,
                    p.address,
                    p.phone,
                    p.created_at
                FROM 
                    ' . $this->table . ' p 
                LEFT JOIN 
                    country c ON p.country_id = c.id 
                WHERE
                    p.id = ?
                LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->city = $row['city'];
        $this->institution = $row['institution'];
        $this->date = $row['date'];
        $this->timespan = $row['timespan'];
        $this->address = $row['address'];
        $this->phone = $row['phone'];
        $this->country_id = $row['country_id'];
        $this->country_name = $row['country_name'];
    }


    // Create post
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . 
                $this->table . '
            SET
                city = :city,
                institution = :institution,
                date = :date,
                timespan = :timespan,
                address = :address,
                phone = :phone,
                country_id = :country_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->institution = htmlspecialchars(strip_tags($this->institution));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->timespan = htmlspecialchars(strip_tags($this->timespan));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->country_id = htmlspecialchars(strip_tags($this->country_id));

        // Bind data
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':institution', $this->institution);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':timespan', $this->timespan);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':country_id', $this->country_id);

        //Execute query
        if($stmt->execute()) {
            return true;
        } 

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    // Update post
    public function update() {
        // Create query
        $query = 'UPDATE ' . 
                $this->table . '
            SET
                city = :city,
                institution = :institution,
                date = :date,
                timespan = :timespan,
                address = :address,
                phone = :phone,
                country_id = :country_id
            WHERE
                id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->institution = htmlspecialchars(strip_tags($this->institution));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->timespan = htmlspecialchars(strip_tags($this->timespan));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->country_id = htmlspecialchars(strip_tags($this->country_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':institution', $this->institution);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':timespan', $this->timespan);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':country_id', $this->country_id);
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if($stmt->execute()) {
            return true;
        } 

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    //Delete Post
    public function delete() {
        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);

                //Execute query
                if($stmt->execute()) {
                    return true;
                } 
        
                // Print error if something goes wrong
                printf("Error: %s.\n", $stmt->error);
        
                return false;
    }

} ?>