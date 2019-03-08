<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>

<h1>Companies (working)</h1>



<div class="fwrap">
    <div>

        <?php

            if (($_GET["id"])) {
                $cID = htmlspecialchars($_GET["id"]);
            
                $formQuery = $db_con;
                $formRes = $formQuery->query("SELECT name, rate, phone, email FROM companies WHERE ID=$cID");  
                $fData = $formRes->fetch_assoc();

                echo '<h2>Edit: ' . $fData['name'] . '</h2>';

            } else {
                echo '<h2>Add new company</h2>';
            }
        ?>


        <form method="post" action="./inc/add_company.php" name="companyForm">
            <ul>
                <li><input type="hidden" name="ID" value="<?php echo $cID ?>">
                <label for="name">Name:</label> <input name="name" type="text" value="<?php echo $fData['name'] ?>"></li>
                <li><label for="rate">Rate:</label> <input name="rate" type="text" value="<?php echo $fData['rate'] ?>"></li>
                <li><label for="phone">Phone:</label> <input name="phone" type="text" value="<?php echo $fData['phone'] ?>"></li>
                <li><label for="email">Email:</label> <input name="email" type="text" value="<?php echo $fData['email'] ?>"></li>
                <li><input type="submit" name="submit" value="submit"></li>
            </ul>
        </form>
    </div>



    <div class="f2">
        <?php


            $mysqli = $db_con;
            if (!$mysqli) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            } else {

                $res = $mysqli->query("SELECT name, id FROM companies ORDER BY id ASC");

                    echo '<ul>';
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    echo '<li>' . $row['name'] . ' :: <a href="companies.php?id=' . $row['id'] . '" class="edit-link">edit</a></li>';
                }
                    echo '</ul>';
            }
        ?>

    </div>
</div>

<?php require_once('./inc/footer.php'); ?>

