<div class='col-lg-12'>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top:0px">Transaksi List</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <?php if ($this->session->userdata('status') == 'login') {
                echo anchor(site_url('transaksi/create'), 'Create', 'class="btn btn-primary"');
            }
            ?>
<?php if ($this->session->userdata('status') == 'login') {
    echo anchor(site_url('transaksi/print'), 'Cetak', 'class="btn btn-primary"');
}
?>
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
                        <th>PELANGGAN</th>
                        <th>SOPIR</th>
                        <th>KENDARAAN</th>
                        <th>MULAI</th>
                        <th>SELESAI</th>
                        <th>TOTAL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
$start = 0;
foreach ($transaksi_data as $transaksi) {
    ?>
                        <tr>
                            <td><?php echo++$start ?></td>
                            <td><?php echo $transaksi->pelanggan_nama ?></td>
                            <td><?php echo $transaksi->sopir_nama ?></td>
                            <td><?php echo $transaksi->kendaraan_platnomor ?></td>
                            <td><?php echo $transaksi->transaksi_tglmulai ?></td>
                            <td><?php echo $transaksi->transaksi_tglselesai ?></td>

                            <td><?php echo $transaksi->transaksi_total ?></td>

                            <td style="text-align:center">
                                <?php
                                echo anchor('transaksi/selesai/' . $transaksi->transaksi_id, 'Selesai', array('class' => 'btn btn-danger btn-sm')) . ' ';
                                echo anchor(site_url('transaksi/read/' . $transaksi->transaksi_id), 'Detail', array('class' => 'btn btn-danger btn-sm'));
                                echo '  ';
                                if ($this->session->userdata('status') == 'login') {
                                    echo anchor(site_url('transaksi/update/' . $transaksi->transaksi_id), 'Update', array('class' => 'btn btn-danger btn-sm'));
                                    echo '  ';
                                    echo anchor(site_url('transaksi/delete/' . $transaksi->transaksi_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onClick' => "javasciprt: return confirm('Are You Sure ?')"));
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