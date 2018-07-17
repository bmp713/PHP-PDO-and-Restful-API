<!DOCTYPE html>
<html>
<head>
<title> PHP | Object Oriented PDO</title>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css' rel='stylesheet'>
</head>
<body>
    <div id="container">

        <h1>PDO | PDO Object Oriented</h1>
 
        <?php
        echo "Hello world";

        class connectPDO{
            private $host;
            private $db;
            private $user;
            private $password;
            // Public access to PDO connection
            public $pdo;

            __construct($host, $db, $user, $password){
                $this->host = $host;
                $this->db = $db;
                $this->user = $user;
                $this->password = $password;

                echo $this->host = $host;
                echo $this->db = $db;
                echo $this->user = $user;
                echo $this->password = $password;

                try{
                    $this->pdo = new PDO("msyql:host=$this->host;dbname=$this->db", $this->user, $this->password); 
                    echo $this->PDO;

                }catch( PDOException error ){
                    echo 'Connection Error: ' . $error->getMessage();
                }
            }            
        }

        $host = 'localhost';
        $db = 'PDO_1';
        $user = 'root';
        $password = 'Welcome123';

        // Read SQL file into mysql to create database
        $cmd = "mysql -u$username -p$password < db_default.sql";
        echo exec( $cmd );

        // Create new connectPDO object for connection to database
        if ( $conn = new connectPDO($host, $db, $user, $password) ){
            echo "Connected successfully to $db";
        }
        
        // Read all entries from user table in associative array
        $result = $conn->pdo->query( "SELECT * FROM users_1" );

        while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
            print_r($row).'<br>';
        }


        ?>


    </div> <!-- End container -->
<body>
</html>



