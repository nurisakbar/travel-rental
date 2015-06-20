<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = "../application/views/" . $read_file;

$createRead = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<div class='col-lg-12'>
        <h2 style=\"margin-top:0px\">".ucfirst($table)." Read</h2>
        <table class=\"table\">";
$result2 = mysql_query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t    <tr><td>".$row1["COLUMN_NAME"]."</td><td><?php echo $".$row1["COLUMN_NAME"]."; ?></td></tr>";
    }
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$controller."') ?>\" class=\"btn btn-default\">Cancel</button></td></tr>";
$string .= "\n\t</table>
    </div>";


fwrite($createRead, $string);
fclose($createRead);

$read_res = "<p>" . $path . "</p>";
?>