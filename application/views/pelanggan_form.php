<div class='col-lg-12'>
    <h2 style="margin-top:0px">Pelanggan <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">NAMA LENGKAP<?php echo form_error('pelanggan_nama') ?></label>
            <input type="text" class="form-control" name="pelanggan_nama" id="pelanggan_nama" placeholder="NAMA LENGKAP" value="<?php echo $pelanggan_nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">NO TELPON <?php echo form_error('pelanggan_telpon') ?></label>
            <input type="text" class="form-control" name="pelanggan_telpon" id="pelanggan_telpon" placeholder="NO TELPON" value="<?php echo $pelanggan_telpon; ?>" />
        </div>
        <div class="form-group">
            <label for="pelanggan_alamat">ALAMAT LENGKAP<?php echo form_error('pelanggan_alamat') ?></label>
            <textarea class="form-control" rows="3" name="pelanggan_alamat" id="pelanggan_alamat" placeholder="ALAMAT"><?php echo $pelanggan_alamat; ?></textarea>
        </div>
        <input type="hidden" name="pelanggan_id" value="<?php echo $pelanggan_id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pelanggan') ?>" class="btn btn-default">Cancel</button>
    </form>
</div>