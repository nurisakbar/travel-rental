<div class='col-lg-12'>
    <h2 style="margin-top:0px">Transaksi <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">PELANGGAN <?php echo form_error('pelanggan_id') ?></label>
            <?php
            echo dropdown('pelanggan_id', 'pelanggan', 'pelanggan_nama', 'pelanggan_id', 4, '', $pelanggan_id);
            ?>
        </div>
        <div class="form-group">
            <label for="int">SUPIR <?php echo form_error('sopir_id') ?></label>
            <?php echo dropdown('sopir_id', 'sopir', 'sopir_nama', 'sopir_id', 4,'', $sopir_id) ?>
        </div>
        <div class="form-group">
            <label for="int">PILIH KENDARAAN <?php echo form_error('kendaraan_id') ?></label>
            <?php
            echo dropdown('kendaraan_id', 'kendaraan', 'kendaraan_platnomor', 'kendaraan_id', 5,'',$kendaraan_id);
            ?>
            </div>
    <!--    <div class="form-group">
            <label for="date">TANGGAL MULAI <?php echo form_error('transaksi_tglmulai') ?></label>
            <input type="text" class="form-control" name="transaksi_tglmulai" id="transaksi_tglmulai" placeholder="transaksi_tglmulai" value="<?php echo $transaksi_tglmulai; ?>" />
        </div> -->
        <div class="form-group">
            <label for="date">TANGGAL SELESAI <?php echo form_error('transaksi_tglselesai') ?></label>
            <input type="text" class="form-control" name="transaksi_tglselesai" id="transaksi_tglselesai" placeholder="TANGGAL SELESAI" value="<?php echo $transaksi_tglselesai; ?>" />
        </div>
    <!--
        <div class="form-group">
            <label for="varchar">TRANSAKSI HARI <?php echo form_error('transaksi_hari') ?></label>
            <input type="text" class="form-control" name="transaksi_hari" id="transaksi_hari" placeholder="transaksi_hari" value="<?php echo $transaksi_hari; ?>" />
        </div>
        <div class="form-group">
            <label for="date">transaksi_tglovertime <?php echo form_error('transaksi_tglovertime') ?></label>
            <input type="text" class="form-control" name="transaksi_tglovertime" id="transaksi_tglovertime" placeholder="transaksi_tglovertime" value="<?php echo $transaksi_tglovertime; ?>" />
        </div>
        <div class="form-group">
            <label for="int">transaksi_hariovertime <?php echo form_error('transaksi_hariovertime') ?></label>
            <input type="text" class="form-control" name="transaksi_hariovertime" id="transaksi_hariovertime" placeholder="transaksi_hariovertime" value="<?php echo $transaksi_hariovertime; ?>" />
        </div>
        <div class="form-group">
            <label for="int">transaksi_total <?php echo form_error('transaksi_total') ?></label>
            <input type="text" class="form-control" name="transaksi_total" id="transaksi_total" placeholder="transaksi_total" value="<?php echo $transaksi_total; ?>" />
        </div>
        <div class="form-group">
            <label for="enum">transaksi_status <?php echo form_error('transaksi_status') ?></label>
            <input type="text" class="form-control" name="transaksi_status" id="transaksi_status" placeholder="transaksi_status" value="<?php echo $transaksi_status; ?>" />
        </div>-->
        <input type="hidden" name="transaksi_id" value="<?php echo $transaksi_id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</button>
    </form>
</div>