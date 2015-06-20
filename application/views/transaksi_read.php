<div class='col-lg-12'>
        <h2 style="margin-top:0px">DETAIL TRANSAKSI</h2>
        <table class="table table-bordered">
	    <tr><td width="200">PELANGGAN</td><td><?php echo $pelanggan_id; ?></td></tr>
	    <tr><td>SOPIR</td><td><?php echo $sopir_id; ?></td></tr>
	    <tr><td>PLAT NOMOR</td><td><?php echo $kendaraan_id; ?></td></tr>
            <tr><td>MULAI</td><td><?php echo tgl_indo($transaksi_tglmulai); ?></td></tr>
	    <tr><td>SELESAI</td><td><?php echo $transaksi_tglselesai; ?></td></tr>
	    <tr><td>JUMLAH HARI</td><td><?php echo $transaksi_hari; ?></td></tr>
	    <tr><td>TANGGAL OVERTIME</td><td><?php echo $transaksi_tglovertime; ?></td></tr>
	    <tr><td>JML HARI OVERTIME</td><td><?php echo $transaksi_hariovertime; ?></td></tr>
	    <tr><td>TOTAL</td><td><?php echo $transaksi_total; ?></td></tr>
	    <tr><td>STATUS</td><td><?php echo $transaksi_status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </div>