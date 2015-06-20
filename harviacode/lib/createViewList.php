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

$string = "
                    <div class='col-lg-12'>
                    <h1 class='page-header'>".ucfirst($table)." List</h1>
                </div><div class='col-lg-12'>
        <h2 style=\"margin-top:0px\">".ucfirst($table)." List</h2>
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-4\">
                <?php echo anchor(site_url('".$controller."/create'),'Create', 'class=\"btn btn-primary\"'); ?>
            </div>
            <div class=\"col-md-4 text-center\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-4 text-right\">
                <form action=\"<?php echo site_url('$controller/search'); ?>\" class=\"form-inline\" method=\"post\">
                    <input name=\"keyword\" class=\"form-control\" value=\"<?php echo \$keyword; ?>\" />
                    <?php 
                    if (\$keyword <> '')
                    {
                        ?>
                        <a href=\"<?php echo site_url('$controller'); ?>\" class=\"btn btn-default\">Reset</a>
                        <?php
                    }
                    ?>
                    <input type=\"submit\" value=\"Search\" class=\"btn btn-primary\" />
                </form>
            </div>
        </div>
        <table class=\"table table-bordered\" style=\"margin-bottom: 10px\">
            <tr>
                <th>No</th>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t<th>" . $row1['COLUMN_NAME'] . "</th>";
    }
}
$string .= "\n\t\t<th>Action</th>
            </tr>";
$string .= "<?php
            foreach ($" . $controller . "_data as \$$controller)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td><?php echo ++\$start ?></td>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t\t<td><?php echo $" . $controller ."->". $row1['COLUMN_NAME'] . " ?></td>";
    }
}

$string .= "\n\t\t\t<td style=\"text-align:center\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$controller."/read/'.$".$controller."->".$primary."),'Read'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$controller."/update/'.$".$controller."->".$primary."),'Update'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$controller."/delete/'.$".$controller."->".$primary."),'Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <ul class=\"pagination\" style=\"margin-top: 0px\">
                    <li class=\"active\"><a href=\"#\">Total Record : <?php echo \$total_rows ?></a></li>
                </ul>
            </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
    </div>";


fwrite($createList, $string);
fclose($createList);

$list_res = "<p>" . $path . "</p>";
?>