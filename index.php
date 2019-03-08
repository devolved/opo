<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>
<div class="fwrap">
    <div>
        <h1>Overly pretty organiser</h1>
        <p>First crack at a solo php project</p>
        <p>Usual fair, nowt special &hellip; it's just easier to make something</p>
        <p>Is for php practice so not tested outside of Chrome on Mac</p>
    </div>



    <div>

        <h2>Generate bill</h2>

        <form method="post" action="billing.php" name="billingForm">

            <label for="project">Project:</label>
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
            </select>
            <input type="submit" name="submit" value="Go">
        </form>
    </div>
</div>
<?php require_once('./inc/footer.php'); ?>

