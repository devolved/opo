
<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>

<h1>Log (html)</h1>
<!-- works off timestamps so not affected by tab swaps -->


<div class="fwrap">
    <div>
        <h2>Add log to costs</h2>
        <form method="post" action="./inc/add_cost.php" name="logForm">
        <ul>
            <li><input type="hidden" name="type" id="type" value="work">
                <label for="amount">Amount</label> <input name="amount" type="text" id="amount" value=""></li>                
            <li><label for="project">Project:</label>
                <select name="project" id="project" value="">
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
            <li><input type="submit" name="submit" value="submit"></li>
        </ul>
        </form>
    </div>



    <div>
        <h2>New log</h2>
        <button id="toggle">start</button> 
        <div id="counter">0</div>
        <div class="add-to">
            <label for="rate">at </label>
            <select name ="rate" id="rate">
                <option value="10">£10 per hour</option>
                <option value="20">£20 per hour</option>
                <option value="30">£30 per hour</option>
                <option value="40">£40 per hour</option>
            </select>  
            <button id="add">add to costs form</button> <button id="cheat">Add 1/2hr for demo</button>
        </div>

    </div>
</div>

<?php require_once('./inc/footer.php'); ?>

