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
                    User<br><input type="text" name="user" value="root" class="input-box"><br>
                    Password<br><input type="password" name="password" value="Welcome123" class="input-box"><br><br>

                    First<br><input type="text" name="first" value="First" class="input-box"><br>
                    Last<br><input type="text" name="last" value="Last" class="input-box"><br>
                    User Name<br><input type="text" name="uid" value="User" class="input-box"><br>
                    Age<br><input type="text" name="age" value="35" class="input-box"><br><br>
                    <button type="submit" class="main-button">Log In</button>
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

                    foreach( $_POST as $post ){
                        echo 'POST = '.$post.'<br>';
                    }
                    // Create database from SQL file
                    /*if( file_exists( $db_file ) ){
                        $sql = file( $db_file );
                        foreach( $sql as $line ){
                            echo $line.'<br>';
                        }
                        $cmd = 'mysql -u'.$db_user.' -p'.$db_password.' <'.$db_file;
                        echo '<br>'.$cmd.'<br><br>';
                        echo exec( $cmd );
                    }*/

                    // CONNECTION
                    try{ 
                        $conn = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        printf("<br>%s logged in with %s<br>", $username, $password);
                    }
                    catch( PDOException $error ){
                        echo 'Connection Error: ' . $error->getMessage();
                    }
                    $conn = null;

                    // CREATE RECORD
                    try{ 
                        $conn = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        printf("<br>%s logged in with %s<br>", $username, $password);

                        $query = "INSERT INTO users_1 (first, last, uid, age) 
                            VALUES ('$first', '$last', '$uid', $age);";
                        
                        $conn->exec( $query );
                        echo "Record created successfully";
                    }
                    catch(PDOException $error){
                        echo $sql . "<br>" . $error->getMessage();
                    }
                    $conn = null;
                                  
                ?>
            </div>
            
        </div>
        
    </div> <!-- END container -->
</body>
</html>



