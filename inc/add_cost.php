<?php require_once('db.php'); ?>
<?php

    $link = $db_con;

    if ($link === false) {
        die("shiieeet" . mysqli_connect_error());
    }

        // prep statement new record
        $sql = "INSERT INTO costs (type, amount, project, notes, paid) VALUES (?, ?, ?, ?, ?)";
    
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $type, $amount, $project, $notes, $paid);
            
            // Set parameters
            $type = htmlspecialchars($_REQUEST['type']);
            $amount = htmlspecialchars($_REQUEST['amount']);
            $project = htmlspecialchars($_REQUEST['project']);
            $notes = htmlspecialchars($_REQUEST['notes']);
            $paid = htmlspecialchars($_REQUEST['paid']);
        }   


        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header('Location: /costs.php');
        } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        
        
        // Close statement
        mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);


    

?>