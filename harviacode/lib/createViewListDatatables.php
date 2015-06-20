<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = "../application/views/" . $list_file;
        
$createList = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<div class='col-lg-12'>
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-4\">
                <h2 style=\"margin-top:0px\">".ucfirst($table)." List</h2>
            </div>
            <div class=\"col-md-4 text-center\">
                <div style=\"margin-top: 4px\"  id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-4 text-right\">
                <?php echo anchor(site_url('".$controller."/create'), 'Create', 'class=\"btn btn-primary\"'); ?>
            </div>
        </div>
        <table class=\"table table-bordered table-striped\" id=\"mytable\">
            <thead>
                <tr>
                    <th>No</th>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t    <th>" . $row1['COLUMN_NAME'] . "</th>";
    }
}
$string .= "\n\t\t    <th>Action</th>
                </tr>
            </thead>";
$string .= "\n\t    <tbody>
            <?php
            \$start = 0;
            foreach ($" . $controller . "_data as \$$controller)
            {
                ?>
                <tr>";

$string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t    <td><?php echo $" . $controller ."->". $row1['COLUMN_NAME'] . " ?></td>";
    }
}

$string .= "\n\t\t    <td style=\"text-align:center\">"
        . "\n\t\t\t<?php "
        . "\n\t\t\techo anchor(site_url('".$controller."/read/'.$".$controller."->".$primary."),'Read',array('class'=>'btn btn-danger btn-sm')); "
        . "\n\t\t\techo '  '; "
        . "\n\t\t\techo anchor(site_url('".$controller."/update/'.$".$controller."->".$primary."),'Update',array('class'=>'btn btn-danger btn-sm')); "
        . "\n\t\t\techo '  '; "
        . "\n\t\t\techo anchor(site_url('".$controller."/delete/'.$".$controller."->".$primary."),'Delete',array('class'=>'btn btn-danger btn-sm','onClick'=>'javasciprt: return confirm('Are You Sure ?')')); "
        . "\n\t\t\t?>"
        . "\n\t\t    </td>";

$string .=  "\n\t        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>";


fwrite($createList, $string);
fclose($createList);

$list_res = "<p>" . $path . "</p>";
?>