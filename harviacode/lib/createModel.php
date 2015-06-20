<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = "../application/models/" . $model_file;
        
$createModel = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . ucfirst($model) . " extends CI_Model
{

    public \$table = '$table';
    public \$id = '$primary';
    public \$order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        \$this->db->order_by(\$this->id, \$this->order);
        return \$this->db->get(\$this->table)->result();
    }

    // get data by id
    function get_by_id(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        return \$this->db->get(\$this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        \$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get data with limit
    function index_limit(\$limit, \$start = 0) {
        \$this->db->order_by(\$this->id, \$this->order);
        \$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }
    
    // get search total rows
    function search_total_rows(\$keyword = NULL) {
        \$this->db->like('$primary', \$keyword);";

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\$this->db->or_like('" . $row2['COLUMN_NAME'] ."', \$keyword);";
    }
}

$string .= "\n\t\$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit(\$limit, \$start = 0, \$keyword = NULL) {
        \$this->db->order_by(\$this->id, \$this->order);
        \$this->db->like('$primary', \$keyword);";

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\$this->db->or_like('" . $row2['COLUMN_NAME'] ."', \$keyword);";
    }
}

$string .= "\n\t\$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }

    // insert data
    function insert(\$data)
    {
        \$this->db->insert(\$this->table, \$data);
    }

    // update data
    function update(\$id, \$data)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->update(\$this->table, \$data);
    }

    // delete data
    function delete(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->delete(\$this->table);
    }

}

/* End of file $model_file */
/* Location: ./application/models/$model_file */";


fwrite($createModel, $string);
fclose($createModel);

$model_res = "<p>" . $path . "</p>";
?>