<?php require_once('./inc/db.php'); ?>
<?php require_once('./inc/header.php'); ?>

<h1>Projects (working)</h1>



<div class="fwrap">
    <div>

        <?php

            if (($_GET["id"])) {
                $cID = htmlspecialchars($_GET["id"]);
            
                $formQuery = $db_con;
                $formRes = $formQuery->query("SELECT * FROM projects WHERE ID=$cID");  
                $fData = $formRes->fetch_assoc();
                $isLive = '';

                if ( $fData['live'] ) {
                    $isLive = 'checked';
                }

                echo '<h2>Edit: ' . $fData['project'] . '</h2>';

            } else {
                echo '<h2>Add project</h2>';
            }
        ?>


        <form method="post" action="./inc/add_project.php" name="projectForm">
        <ul>
            <li><input type="hidden" name="ID" value="<?php echo $cID ?>">
                <label for="name">Name:</label> <input name="name"  type="text" value="<?php echo $fData['name'] ?>"></li>
            <li><label for="company">Company:</label>
            <?php if (($_GET["id"])) {
                    $cID = htmlspecialchars($_GET["id"]);
                    echo $fData['company'];
                } else {
                    echo '<select name="company" id="company">';
                
                    $coQuery = $db_con;
        
                    $coRes = $coQuery->query("SELECT name, id FROM companies ORDER BY id ASC");

                    for ($row_no = $coRes->num_rows - 1; $row_no >= 0; $row_no--) {
                        $coRes->data_seek($row_no);
                        $row = $coRes->fetch_assoc();
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    
                    echo '</select>';
                }
            ?>
            </li>           
            <li><label for="type">Type:</label> 
                <select name="type" id="type" value="<?php echo $fData['type'] ?>">
                    <option value="website">Website</option>
                    <option value="psd">Design > html</option>
                    <option value="seo">SEO</option>
                    <option value="contract">Contract</option>
                    <option value="misc">Misc</option>
                </select></li>
            <li><label for="url">URL:</label> <input name="url" type="text" value="<?php echo $fData['url'] ?>"></li>
            <li><label for="budget">Budget:</label> <input name="budget" type="text" value="<?php echo $fData['budget'] ?>"></li>
            <li><label for="hosting">Hosting:</label> 
                <select name="hosting" id="hosting" value="<?php echo $fData['hosting'] ?>">
                    <option value="none">None</option>
                    <option value="shared">Shared</option>
                    <option value="fast">Fast</option>
                    <option value="wordpress">Wordpress</option>
                    <option value="custom">Custom</option>
                </select></li>
            <li><label for="notes">Notes:</label> <textarea name="notes" value=""><?php echo $fData['notes'] ?></textarea></li>
            <li><label for="live">Live?</label> <input type="checkbox" name="live" <?php echo $isLive ?>>
            <li><input type="submit" name="submit" value="submit"></li>
        </ul>
        </form>
    </div>



    <div>
        <?php


            $mysqli = $db_con;
            if (!$mysqli) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            } else {

                $res = $mysqli->query("SELECT name, company, id FROM projects ORDER BY id ASC");

                    echo '<table><tr><th>Project</th><th>Company</th><th></th></tr>';
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    echo '<tr><td>' . $row['name'] . '</td><td>' . $row['company'] . '</td><td><a href="projects.php?id=' . $row['id'] . '" class="edit-link">edit</a></td></tr>';
                }
                    echo '</table>';
            }
        ?>

    </div>
</div>

<?php require_once('./inc/footer.php'); ?>

