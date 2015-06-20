<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = "../application/views/" . $form_file;

$createForm = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<div class='col-lg-12'>
        <h2 style=\"margin-top:0px\">".ucfirst($table)." <?php echo \$button ?></h2>
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
$result2 = mysql_query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        if ($row1["DATA_TYPE"] == 'text')
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row1["COLUMN_NAME"]."\">".$row1["COLUMN_NAME"]." <?php echo form_error('".$row1["COLUMN_NAME"]."') ?></label>
                <textarea class=\"form-control\" rows=\"3\" name=\"".$row1["COLUMN_NAME"]."\" id=\"".$row1["COLUMN_NAME"]."\" placeholder=\"".$row1["COLUMN_NAME"]."\"><?php echo $".$row1["COLUMN_NAME"]."; ?></textarea>
            </div>";
        } else
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row1["DATA_TYPE"]."\">".$row1["COLUMN_NAME"]." <?php echo form_error('".$row1["COLUMN_NAME"]."') ?></label>
                <input type=\"text\" class=\"form-control\" name=\"".$row1["COLUMN_NAME"]."\" id=\"".$row1["COLUMN_NAME"]."\" placeholder=\"".$row1["COLUMN_NAME"]."\" value=\"<?php echo $".$row1["COLUMN_NAME"]."; ?>\" />
            </div>";
        }
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$primary."\" value=\"<?php echo $".$primary."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$controller."') ?>\" class=\"btn btn-default\">Cancel</button>";
$string .= "\n\t</form>
    </div>";


fwrite($createForm, $string);
fclose($createForm);

$form_res = "<p>" . $path . "</p>";
?>