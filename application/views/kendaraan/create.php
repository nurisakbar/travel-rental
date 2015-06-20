<div class="col-lg-12">
    <table class="table table-bordered">
        <tr><td width="200">No Plat</td><td><?php echo text('plat', 'NO PLAT', 12)?></td><td>Merk</td><td> <?php echo text('merk', 'MERK', 12)?></td></tr>
        <tr><td width="200">Type</td><td><?php echo text('plat', 'NO PLAT', 12)?> <td>Tahun Rakit</td><td><?php echo text('merk', 'MERK', 12)?></td></tr>
        <tr><td width="200">Jumlah Seat</td><td><?php echo text('plat', 'NO PLAT', 12)?> <td>Status</td><td><?php echo text('merk', 'MERK', 12)?></td></tr>
        <tr><td colspan="4"><button type="submit" name="submit" class="btn btn-danger">Simpan</button>
            <?php
            echo anchor($this->uri->segment(1),'Kembali',array('class'=>'btn btn-danger'))
            ?>
            </td></tr>
    </table>
</div>