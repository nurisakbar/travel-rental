<?php


function isLogin($level=null){
    $CI =& get_instance();
    if($CI->session->userdata('status')=='')
    {
        //redirect('users/login');
    }
}

function text($name,$placeholder,$class,$value=null,$tags=null)
{
    return "<div class='col-lg-$class'>
        <input type='text' name='$name' class='form-control' value='$value' placeholder='$placeholder' $tags />
            </div>";
}

function password($name,$placeholder,$class){
    return "<input type='password' name='$name' class='span$class' placeholder='$placeholder'/>";
}
function email($name,$placeholder,$class){
    return "<input type='email' name='$name' class='span$class' placeholder='$placeholder'/>";
}

function buttonIcon($value,$name,$icon,$class){
    return "<button type='submit' name='$name' class='$class'><i class='$icon'></i> $value</button>";
}

function dropdown($name,$table,$field,$pk,$class,$kondisi=null,$selected=null,$data=null,$tags=null)
{
    $CI =& get_instance();
   echo"
       <select name='".$name."' class='form-control' $tags>";
        if($data!='')
        {
            foreach ($data as $data_value => $id)
            {
                echo "<option value='$id'>$data_value</option>";
            }
        }
        if(empty($kondisi))
        {
            $CI->db->order_by($field,'ASC');
            $record=$CI->db->get($table)->result();
        }
        else
        {
            $CI->db->order_by($field,'ASC');
            $record=$CI->db->get_where($table,$kondisi)->result();
        }
        foreach ($record as $r)
        {
            echo " <option value='".$r->$pk."' ";
            echo $r->$pk==$selected?'selected':'';
            echo ">".strtoupper($r->$field)."</option>";
        }
            echo"</select>";
}


       function rp($x)
       {
           return number_format($x,0,",",".");
       }
       
       function waktu()
       {
           date_default_timezone_set('Asia/Jakarta');
           return date("Y-m-d H:i:s");
       }
              
       function tgl_indo($tgl)
       {
            return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4);
       }
    
    function tgl_indojam($tgl,$pemisah)
    {
        return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4).' '.$pemisah.' '.  substr($tgl, 11,8);
    }
    
    
    function getbln($bln)
    {
        switch ($bln) 
        {
            
            case 1:
                return "Januari";
            break;
        
            case 2:
                return "Februari";
            break;
        
            case 3:
                return "Maret";
            break;
        
            case 4:
                return "April";
            break;
        
            case 5:
                return "Mei";
            break;
        
            case 6:
                return "Juni";
            break;
        
            case 7:
                return "Juli";
            break;
        
            case 8:
                return "Agustus";
            break;
        
            case 9:
                return "September";
            break;
        
             case 10:
                return "Oktober";
            break;
        
            case 11:
                return "November";
            break;
        
            case 12:
                return "Desember";
            break;
        }
        
    }


function pendidikGetName($id){
     $CI =& get_instance();
     $pendidik=$CI->db->get_where('tabel_pendidik',array('pendidik_id'=>$id));
     if($pendidik->num_rows()>0)
     {
         $pendidik=$pendidik->row_array();
         return $pendidik['nama_lengkap'];
     }
}