<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = "../application/controllers/" . $controller_file;

$createController = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . ucfirst($controller) . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$model');
        \$this->load->library('form_validation');
    }";

if ($jenistabel == 'regtable') {
    
$string .= "\n\n    public function index()
    {
        \$keyword = '';
        \$this->load->library('pagination');

        \$config['base_url'] = base_url() . '$controller/index/';
        \$config['total_rows'] = \$this->" . $model . "->total_rows();
        \$config['per_page'] = 10;
        \$config['uri_segment'] = 3;
        \$config['suffix'] = '.html';
        \$config['first_url'] = base_url() . '$controller.html';
        \$this->pagination->initialize(\$config);

        \$start = \$this->uri->segment(3, 0);
        \$$controller = \$this->" . $model . "->index_limit(\$config['per_page'], \$start);

        \$data = array(
            '" . $controller . "_data' => \$$controller,
            'keyword' => \$keyword,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );

        \$this->template->load('adminTemplate','$list', \$data);
    }
    
    public function search() 
    {
        \$keyword = \$this->uri->segment(3, \$this->input->post('keyword', TRUE));
        \$this->load->library('pagination');
        
        if (\$this->uri->segment(2)=='search') {
            \$config['base_url'] = base_url() . '$controller/search/' . \$keyword;
        } else {
            \$config['base_url'] = base_url() . '$controller/index/';
        }

        \$config['total_rows'] = \$this->" . $model . "->search_total_rows(\$keyword);
        \$config['per_page'] = 10;
        \$config['uri_segment'] = 4;
        \$config['suffix'] = '.html';
        \$config['first_url'] = base_url() . '$controller/search/'.\$keyword.'.html';
        \$this->pagination->initialize(\$config);

        \$start = \$this->uri->segment(4, 0);
        \$$controller = \$this->" . $model . "->search_index_limit(\$config['per_page'], \$start, \$keyword);

        \$data = array(
            '" . $controller . "_data' => \$$controller,
            'keyword' => \$keyword,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->template->load('adminTemplate','$list', \$data);
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$$controller = \$this->" . $model . "->get_all();

        \$data = array(
            '" . $controller . "_data' => \$$controller
        );

        \$this->template->load('adminTemplate','$list', \$data);
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $model . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row1['COLUMN_NAME'] . "' => \$row->" . $row1['COLUMN_NAME'] . ",";
    }
}

$string .= "\n\t    );
            \$this->template->load('adminTemplate','$read', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller'));
        }
    }
    
    public function create() 
    {
        \$data = array(
            'button' => 'Create',
            'action' => site_url('$controller/create_action'),";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t    '" . $row2['COLUMN_NAME'] . "' => set_value('" . $row2['COLUMN_NAME'] . "'),";
    }
}
$string .= "\n\t);
        \$this->template->load('adminTemplate','$form', \$data);
    }
    
    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => \$this->input->post('" . $row2['COLUMN_NAME'] . "',TRUE),";
    }
}
$string .= "\n\t    );

            \$this->".$model."->insert(\$data);
            \$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('$controller'));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$model."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url('$controller/update_action'),";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => set_value('" . $row2['COLUMN_NAME'] . "', \$row->". $row2['COLUMN_NAME']."),";
    }
}
$string .= "\n\t    );
            \$this->template->load('adminTemplate','$form', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller'));
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$primary', TRUE));
        } else {
            \$data = array(";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => \$this->input->post('" . $row2['COLUMN_NAME'] . "',TRUE),";
    }
}
$string .= "\n\t    );

            \$this->".$model."->update(\$this->input->post('$primary', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('$controller'));
        }
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$model."->get_by_id(\$id);

        if (\$row) {
            \$this->".$model."->delete(\$id);
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('$controller'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller'));
        }
    }

    function _rules() 
    {";

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row3 = mysql_fetch_assoc($result2))
    {
        $int = $row3['DATA_TYPE'] == 'int' || $row3['DATA_TYPE'] == 'double' || $row3['DATA_TYPE'] == 'decimal' ? '|numeric' : '';
        $string .= "\n\t\$this->form_validation->set_rules('".$row3['COLUMN_NAME']."', ' ', 'trim|required$int');";
    }
}
$string .= "\n\n\t\$this->form_validation->set_rules('$primary', '$primary', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }
}

/* End of file $controller_file */
/* Location: ./application/controllers/$controller_file */";


fwrite($createController, $string);
fclose($createController);

$controller_res = "<p>" . $path . "</p>";
?>