<div class='col-lg-12'>
    <h2 style="margin-top:0px">Sopir <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">NAMA LENGKAP <?php echo form_error('sopir_nama') ?></label>
            <input type="text" class="form-control" name="sopir_nama" id="sopir_nama" placeholder="NAMA LENGKAP" value="<?php echo $sopir_nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">NO TELPON <?php echo form_error('sopir_telpon') ?></label>
            <input type="text" class="form-control" name="sopir_telpon" id="sopir_telpon" placeholder="NO TELPON" value="<?php echo $sopir_telpon; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">NO KTP <?php echo form_error('sopir_ktp') ?></label>
            <input type="text" class="form-control" name="sopir_ktp" id="sopir_ktp" placeholder="NO KTP" value="<?php echo $sopir_ktp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">NO SIM <?php echo form_error('sopir_sim') ?></label>
            <input type="text" class="form-control" name="sopir_sim" id="sopir_sim" placeholder="NO SIM" value="<?php echo $sopir_sim; ?>" />
        </div>
        <div class="form-group">
            <label for="enum">STATUS <?php echo form_error('sopir_status') ?></label>
            <?php
            echo form_dropdown('sopir_status',array('bebas'=>'BEBAS','jalan'=>'JALAN'),$sopir_status,"class='form-control'");
            ?>
        </div>
        <div class="form-group">
            <label for="sopir_alamat">ALAMAT <?php echo form_error('sopir_alamat') ?></label>
            <textarea class="form-control" rows="3" name="sopir_alamat" id="sopir_alamat" placeholder="ALAMAT"><?php echo $sopir_alamat; ?></textarea>
        </div>
        <input type="hidden" name="sopir_id" value="<?php echo $sopir_id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('sopir') ?>" class="btn btn-default">Cancel</button>
    </form>
</div>