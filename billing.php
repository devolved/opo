<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>


<?php
    $link = $db_con;

    if ($link === false) {
        die("shiieeet" . mysqli_connect_error());
    }


    if($_REQUEST['project']) {

        $project = $_REQUEST['project'];

        $pres = $link->query("SELECT name FROM projects WHERE ID='$project'");
        $pData = $pres->fetch_assoc();        
        echo '<h1>Generate bill for ' . $pData['name'] . '</h1>';    
        echo '<div class="fwrap"><div>';

        $res = $link->query("SELECT ID, notes, type, date, amount FROM costs WHERE project='$project' AND paid!='on'");
        $total = 0;

        echo '<table><tr><th>Description</th><th>Type</th><th>Date</th><th>Amount</th></tr>';
        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
            $res->data_seek($row_no);
            $row = $res->fetch_assoc();
            echo '<tr><td>' . $row['notes'] . '</td><td>' . $row['type'] . '</td><td>' . $row['date'] . '</td><td>' . $row['amount'] . '</td></tr>';
            $total += $row['amount'];
        }
        echo '<tr><td></td><td></td><td></td><td class="total">£' . $total . '</td></tr>';
        echo '</table>';



    }

?>
</div></div>



<p><button id="generate">Generate PDF bill</button></p>
<div id="confirm">&nbsp;</div>

<?php require_once('./inc/footer.php'); ?>

