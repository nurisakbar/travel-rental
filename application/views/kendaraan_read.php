<div class='col-lg-12'>
        <h2 style="margin-top:0px">DETAIL KENDARAAN</h2>
        <table class="table table-bordered">
            <tr><td width="200">PLAT NOMOR</td><td><?php echo $kendaraan_platnomor; ?></td><td rowspan="8"><img src="<?php echo base_url().'assets/images/'.$kendaraan_foto?>"></td></tr>
	    <tr><td>MERK</td><td><?php echo $kendaraan_merk; ?></td></tr>
	    <tr><td>TIPE</td><td><?php echo $kendaraan_tipe; ?></td></tr>
	    <tr><td>TAHUN RAKIT</td><td><?php echo $kendaraan_tahunrakit; ?></td></tr>
	    <tr><td>SEAT</td><td><?php echo $kendaraan_seat; ?></td></tr>
	    <tr><td>FOTO</td><td><?php echo $kendaraan_foto; ?></td></tr>
	    <tr><td>FASILITAS</td><td><?php echo $kendaraan_fasilitas; ?></td></tr>
	    <tr><td>STATUS</td><td><?php echo $kendaraan_status; ?></td></tr>
            <tr><td></td><td colspan="2"><a href="<?php echo site_url('kendaraan') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </div>