<?php require_once('db.php'); ?>
<?php

    $link = $db_con;

    if ($link === false) {
        die("shiieeet" . mysqli_connect_error());
    }


    if($_REQUEST['ID']) {
        
        $sql = "UPDATE companies SET name=?, rate=?, phone=?, email=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $name, $rate, $phone, $email, $ID);
            
            // Set parameters
            $ID = htmlspecialchars($_REQUEST['ID']);
            $name = htmlspecialchars($_REQUEST['name']);
            $rate = htmlspecialchars($_REQUEST['rate']);
            $phone = htmlspecialchars($_REQUEST['phone']);
            $email = htmlspecialchars($_REQUEST['email']);
        }            


    } else {
        // prep statement new record
        $sql = "INSERT INTO companies (name, rate, phone, email) VALUES (?, ?, ?, ?)";
    
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $name, $rate, $phone, $email);
            
            // Set parameters
            $name = htmlspecialchars($_REQUEST['name']);
            $rate = htmlspecialchars($_REQUEST['rate']);
            $phone = htmlspecialchars($_REQUEST['phone']);
            $email = htmlspecialchars($_REQUEST['email']);
        }   
    }

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header('Location: /companies.php');
        } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        
        
        // Close statement
        mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);


    

?>