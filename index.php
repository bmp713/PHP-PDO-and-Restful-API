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
                <h1>PDO | Restful API</h1>
                <h5>(Under construction...)</h5>
                <form action="index.php" method="POST" id="form_login">
                    <h5>Enter user name, create, read, update, or delete existing account</h5><br>
                    User Name<br><input type="text" name="uid" value="first" placeholder="User Name" class="input-box"><br>
                    First Name<br><input type="text" name="first" value="First" placeholder="First Name" class="input-box"><br>
                    Last Name<br><input type="text" name="last" value="Last" placeholder="Last Name" class="input-box"><br>
                    Age<br><input type="text" name="age" value="0" placeholder="Age" class="input-box"><br><br><br>
                    <button type="submit" name="Create" class="main-button">Create</button>
                    <button type="submit" name="Read" class="main-button">Read</button>
                    <button type="submit" name="Update" class="main-button">Update</button>
                    <button type="submit" name="Delete" class="main-button">Delete</button><br><br>
                    Clear to default users<br>
                    <button type="submit" name="Reset" class="main-button">Reset</button>
                </form><br>
            </div>	
            <div id="output">
                <?php
                    $db_file = 'db_default.sql';                
                    $host = 'localhost';
                    $db_name = 'PDO_1';

                    //$username = $_POST['user'];
                    //$password = $_POST['password'];
                    $username = 'root';
                    $password = 'Welcome123';

                    $first = $_POST['first'];
                    $last = $_POST['last'];
                    $uid = $_POST['uid'];
                    $age = $_POST['age'];

                    // Create database from SQL file if reset button clicked
                    if( isset($_POST['Reset']) )

                        if( file_exists( $db_file ) ){
                            $sql = file( $db_file );
                            foreach( $sql as $line ){
                                //echo $line.'<br>';
                            }
                            $cmd = 'mysql -u'.$username.' -p'.$password.' <'.$db_file;
                            echo $cmd.'<br>';
                            echo exec( $cmd );
                        }

                    echo "<br><br>// Display POST data<br>";
                    foreach( $_POST as $post ){
                        echo 'POST = '.$post.'<br>';
                    }

                    
                    // CONNECTION
                    try{ 
                        // Restful API CRUD operations with PDO

                        $conn = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password);
                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                        printf("<br><br>%s logged in with %s<br>", $username, $password);

                        // CREATE
                        if( isset($_POST['Create']) ){

                            echo "<br>// CREATE<br>";

                            $sql = "INSERT INTO users_1 (first, last, uid, age) 
                                VALUES ('$first', '$last', '$uid', $age);";

                            if( $conn->exec( $sql ) ){
                                echo "<br>//Record created successfully<br>";
                            }

                            echo "<br>// Print updated results<br<br><br>";
                            $result = $conn->query( "SELECT * FROM users_1" );
                            while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                                echo print_r($row).'<br>';
                            }

                        }

                        // READ
                        if( isset($_POST['Read']) ){

                            echo '<br>// READ<br>';

                            // Fetch PDO data with associative array
                            $result = $conn->query( "SELECT * FROM users_1" );
                            while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                                echo print_r($row).'<br>';
                            }
                        }

                        // UPDATE
                        if( isset($_POST['Update']) ){

                            echo "<br>// UPDATE<br>";

                            foreach ( $_POST as $key => $value ){
                                if( $value ){
                                    $query =  "UPDATE users_1 SET ".$key."='".$value."' WHERE uid='".$_POST['uid']."'";
                                    echo "QUERY = $query<br>";
                                    $result = $conn->query( $query );
                                }
                            }

                            
                            echo "<br>// Print updated results<br<br><br>";
                            $result = $conn->query( "SELECT * FROM users_1" );
                            while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                                echo print_r($row).'<br>';
                            }
                        }

                        // DELETE
                        if( isset($_POST['Delete']) ){
                            // Reset delete flag to false;
                            $_POST['Delete'] = 0;

                            echo "<br>// DELETE<br>";

                            $query =  "DELETE FROM users_1 WHERE uid='".$_POST['uid']."'"; 
                            echo "QUERY = $query<br>";
                            $result = $conn->query( $query );
                            
                            echo "<br>// Print updated results<br<br><br>";
                            $result = $conn->query( "SELECT * FROM users_1" );
                            while( $row = $result->fetch( PDO::FETCH_ASSOC ) ){
                                echo print_r($row).'<br>';
                            }
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



