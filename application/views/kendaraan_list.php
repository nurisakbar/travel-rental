<div class='col-lg-12'>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Kendaraan List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                
                <?php      if($this->session->userdata('status')=='login')
                        { echo anchor(site_url('kendaraan/create'), 'Create', 'class="btn btn-primary"');} ?>
            </div>
        </div>
    <div class="panel panel-default">
          <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>PLAT NOMOR</th>
		    <th>MERK</th>
		    <th>TIPE</th>
		    
		    <th>SEAT</th>
		    <th>FOTO</th>
		    <th>STATUS</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($kendaraan_data as $kendaraan)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $kendaraan->kendaraan_platnomor ?></td>
		    <td><?php echo $kendaraan->kendaraan_merk ?></td>
		    <td><?php echo $kendaraan->kendaraan_tipe ?></td>
		   
		    <td><?php echo $kendaraan->kendaraan_seat ?></td>
		    <td><?php echo $kendaraan->kendaraan_foto ?></td>
		    <td><?php echo $kendaraan->kendaraan_status ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('kendaraan/read/'.$kendaraan->kendaraan_id),'Read',array('class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
                        if($this->session->userdata('status')=='login')
                        {
                            echo anchor(site_url('kendaraan/update/'.$kendaraan->kendaraan_id),'Update',array('class'=>'btn btn-danger btn-sm')); 
                            echo '  '; 
                            echo anchor(site_url('kendaraan/delete/'.$kendaraan->kendaraan_id),'Delete',array('class'=>'btn btn-danger btn-sm','onClick'=>"javasciprt: return confirm('Are You Sure ?')")); 
                        }
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                        </div>
    </div>
        </div>