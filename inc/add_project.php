<?php require_once('db.php'); ?>
<?php

    $link = $db_con;

    if ($link === false) {
        die("shiieeet" . mysqli_connect_error());
    }


    if($_REQUEST['ID']) {
        
        $sql = "UPDATE projects SET name=?, type=?, url=?, budget=?, hosting=?, notes=?, live=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $type, $url, $budget, $hosting, $notes, $live, $ID);
            
            // Set parameters
            $ID = htmlspecialchars($_REQUEST['ID']);
            $name = htmlspecialchars($_REQUEST['name']);
            $type = htmlspecialchars($_REQUEST['type']);
            $url = htmlspecialchars($_REQUEST['url']);
            $budget = htmlspecialchars($_REQUEST['budget']);
            $hosting = htmlspecialchars($_REQUEST['hosting']);
            $notes = htmlspecialchars($_REQUEST['notes']);
            $live = htmlspecialchars($_REQUEST['live']);
        }            


    } else {
        // prep statement new record
        $sql = "INSERT INTO projects (name, company, type, url, budget, hosting, notes, live) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $company, $type, $url, $budget, $hosting, $notes, $live);
            
            // Set parameters
            $name = htmlspecialchars($_REQUEST['name']);
            $company = htmlspecialchars($_REQUEST['company']);
            $type = htmlspecialchars($_REQUEST['type']);
            $url = htmlspecialchars($_REQUEST['url']);
            $budget = htmlspecialchars($_REQUEST['budget']);
            $hosting = htmlspecialchars($_REQUEST['hosting']);
            $notes = htmlspecialchars($_REQUEST['notes']);
            $live = htmlspecialchars($_REQUEST['live']);            
        }   
    }

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header('Location: /projects.php');
        } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        
        
        // Close statement
        mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);


    

?>