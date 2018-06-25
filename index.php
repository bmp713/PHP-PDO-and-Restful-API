<!DOCTYPE html>
<html>
<head>
<title> PHP | PDO</title>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css' rel='stylesheet'>
</head>
<body>
    <div id="container">

        <div id="navbar">
            <a href="index.php">Home</a>
            <a href="index.php">Login</a></li>
            <a href="index.php">New Account</a>
        </div>

        <div id="content">
            
            <div id="content_1">
                <h1>PHP | PDO and Restful API</h1><br>
                <h3>Log in to database</h3><br><br>
                <form action="index.php" method="POST" id="form_login">

                    User<br><br><input type="text" name="user" placeholder="User Name" value="root" class="input-box"><br><br>
                    Password<br><input type="password" name="password" placeholder="Password" value="Welcome123" class="input-box"><br><br><br>
                    First<br><input name"first" placeholder="First Name" class="input-box"><br><br>
                    Last<br><input name"last" placeholder="Last Name" class="input-box"><br><br>
                    User Name<br><input name"uid" placeholder="User Name" class="input-box"><br><br>
                    Age<br><input name"age" placeholder="First Name" class="input-box"><br><br>

                    <button type="submit" class="main-button">Log In</button>
   				</form><br>
                
            </div>	
            <div id="output">
                <?php
                    if( $_POST['user'] ){
                        $db_file = 'db.sql';                
                        $db_user = $_POST['user'];
                        $db_password = $_POST['password'];
                        
                        $host = 'localhost';
                        $db_name = 'PDO_1';
                        $username = $_POST['user'];
                        $password = $_POST['password'];

                        // Dump $_POST array
                        foreach( $_POST as $post ){
                            echo '$_POST = '.$post.'<br>';
                        }

                        try{ 
                            $conn = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        }
                        catch( PDOException $error ){
                            echo 'Connection Error: ' . $error->getMessage();
                        }
                        printf("<br>%s logged in with %s<br>", $username, $password);


                        // Create database from SQL file
                        if( file_exists( $db_file ) ){
                            $sql = file( $db_file );
                            foreach( $sql as $line ){
                                echo $line.'<br>';
                            }
                            $cmd = 'mysql -u'.$db_user.' -p'.$db_password.' <'.$db_file;
                            echo '<br>'.$cmd.'<br><br>';
                            echo exec( $cmd );
                        }


                        // CREATE new user record from POST request
                        // Create query
                                       
                        $first = $_POST['first'];
                        $last = $_POST['last'];
                        $uid = $_POST['uid'];
                        $age = $_POST['age'];

                        $query = "INSERT INTO users_1 (first, last, uid, age) 
                                  VALUES ($first, $last, $uid, $age);";

                        // Prepare statement
                        $stmt = $conn->prepare( $query );

                        // Bind data
                        $stmt->bindParam(':title', $this->title);
                        $stmt->bindParam(':body', $this->body);
                        $stmt->bindParam(':author', $this->author);
                        $stmt->bindParam(':category_id', $this->category_id);
                        // Execute query
                        if($stmt->execute()) {
                            return true;
                        }
                        
                        

                    }
                ?>
            </div>
            
        </div>
        
    </div> <!-- END container -->
</body>
</html>



