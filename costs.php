<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>

<h1>Costs (working)</h1>

<div class="fwrap">
    <div>
        <h2>Add cost</h2>
        <form method="post" action="./inc/add_cost.php" name="costForm">
            <ul>
                <li><label for="type">Type:</label> 
                    <select name="type" id="type">
                        <option value="work">Work</option>
                        <option value="hosting">Hosting</option>
                        <option value="domain">Domain name</option>
                        <option value="other">Other</option>
                    </select></li>
                <li><label for="amount">Amount:</label> <input name="amount" type="text"></li>                
                <li><label for="project">Project:</label>
                    <select name="project" id="project">
                        <?php 
                            $coQuery = $db_con;
                
                            $coRes = $coQuery->query("SELECT name, ID FROM projects ORDER BY id ASC");

                            for ($row_no = $coRes->num_rows - 1; $row_no >= 0; $row_no--) {
                                $coRes->data_seek($row_no);
                                $row = $coRes->fetch_assoc();
                                echo '<option value="' . $row['ID'] . '">' . $row['name'] . '</option>';
                            }                   
                        ?>
                    </select></li>               
                <li><label for="notes">Notes:</label> <textarea name="notes" value=""></textarea></li>
                <li><label for="paid">Paid?</label> <input type="checkbox" name="paid" <?php echo $isPaid ?>>
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

                $res = $mysqli->query("SELECT * FROM costs WHERE paid!='on' ORDER BY id ASC");

                echo '<table><tr><th>Date</th><th>Type</th><th>Amount</th><th>Project</th><th>Notes</th></tr>';
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    echo '<tr><td>' . $row['date'] . '</td><td>' . $row['type'] . '</td><td>' . $row['amount'] . '</td><td>' . $row['project'] . '</td><td>'. $row['notes'] . '</td></tr>';
                }
                echo '</table>';
            }
        ?>

    </div>
</div>

<?php require_once('./inc/footer.php'); ?>