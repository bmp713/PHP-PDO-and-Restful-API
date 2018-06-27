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
                <h1>PHP | PDO Restful API</h1>
                <h2>Useful MySQL Queries</h2><br><br>
                <h3>Log in to database</h3><br>
                <form action="index.php" method="POST" id="form_login">
                    User<br><input type="text" name="user" value="root" class="input-box"><br>
                    Password<br><input type="password" name="password" value="Welcome123" class="input-box"><br><br><br>

                    <h3>Enter user name,<br> 
                        create new or update existing</h3><br>
                    User Name<br><input type="text" name="uid" value="first" placeholder="User Name" class="input-box"><br>
                    First<br><input type="text" name="first" value="First" placeholder="First Name" class="input-box"><br>
                    Last<br><input type="text" name="last" value="Last" placeholder="Last Name" class="input-box"><br>
                    Age<br><input type="text" name="age" value="0" placeholder="Age" class="input-box"><br><br>
                    <button type="submit" class="main-button">Update</button>
                </form><br>
            </div>	
            <div id="output">
                <?php
                    $db_file = 'db.sql';                
                    $host = 'localhost';
                    $db_name = 'PDO_1';

                    $username = $_POST['user'];
                    $password = $_POST['password'];

                    $first = $_POST['first'];
                    $last = $_POST['last'];
                    $uid = $_POST['uid'];
                    $age = $_POST['age'];

                    // Create database from SQL file
                    if( file_exists( $db_file ) ){
                        $sql = file( $db_file );
                        foreach( $sql as $line ){
                            echo $line.'<br>';
                        }
                        $cmd = 'mysql -u'.$username.' -p'.$password.' <'.$db_file;
                        echo $cmd.'<br>';
                        echo exec( $cmd );
                    }

                    echo "<br>// Display POST data<br>";
                    foreach( $_POST as $post ){
                        echo 'POST = '.$post.'<br>';
                    }


                    
                    // CONNECTION
                    try{ 
                        echo "// Restful API CRUD operations with PDO<br><br>";

                        $conn = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password);
                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                        printf("<br><br>%s logged in with %s<br>", $username, $password);
                                 
                        
                        // CREATE
                        echo "<br>// CREATE<br>";

                        $sql = "INSERT INTO users_1 (first, last, uid, age) 
                            VALUES ('$first', '$last', '$uid', $age);";
                        
                        if( $conn->exec( $sql ) ){
                            foreach( $_POST as $post ){
                                echo 'POST = '.$post.'<br>';
                            }
                            echo "<br>//Record created successfully<br>";

                        }


                        // READ
                        echo '<br>// READ<br>';
                        
                        // Fetch PDO data with associative array
                        $result = $conn->query( "SELECT * FROM users_1" );
                        while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                            echo print_r($row).'<br>';
                        }


                        // UPDATE
                        echo "<br>// UPDATE<br>";

                        $query =  "UPDATE users_1 SET age=".$_POST['age']." WHERE uid='".$_POST['uid']."'";
                        echo "QUERY = $query<br>";
                        $result = $conn->query( $query );
                        
                        echo "<br>// Print updated results<br<br><br><br>";
                        $result = $conn->query( "SELECT * FROM users_1" );
                        while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                            echo print_r($row).'<br>';
                        }


                        // DELETE
                        echo "<br>// DELETE<br>";

                        $query =  "DELETE FROM users_1 WHERE uid='".$_POST['uid']."'"; 
                        echo "QUERY = $query<br>";
                        $result = $conn->query( $query );
                        
                        echo "<br>// Print updated results<br<br><br><br>";
                        $result = $conn->query( "SELECT * FROM users_1" );
                        while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                            echo print_r($row).'<br>';
                        }

                    }
                    catch( PDOException $error ){
                        echo 'Connection Error: ' . $error->getMessage();
                    }
                    $conn = null;
                                  
                ?>
            </div>
        </div>
    </div> <!-- END container -->
</body>
</html>



