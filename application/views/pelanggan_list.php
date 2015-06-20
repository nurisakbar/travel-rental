<div class='col-lg-12'>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top:0px">Pelanggan List</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <?php if ($this->session->userdata('status') == 'login') {
                echo anchor(site_url('pelanggan/create'), 'Create', 'class="btn btn-primary"');
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
                        <th>NAMA LENGKAP</th>
                        <th>ALAMAT</th>
                        <th>NO TELPON</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($pelanggan_data as $pelanggan) {
                        ?>
                        <tr>
                            <td><?php echo++$start ?></td>
                            <td><?php echo $pelanggan->pelanggan_nama ?></td>
                            <td><?php echo $pelanggan->pelanggan_alamat ?></td>
                            <td><?php echo $pelanggan->pelanggan_telpon ?></td>
                            <td style="text-align:center">
                                <?php
                                echo anchor(site_url('pelanggan/read/' . $pelanggan->pelanggan_id), 'Read', array('class' => 'btn btn-danger btn-sm'));
                                echo '  ';
                                if ($this->session->userdata('status') == 'login') {
                                    echo anchor(site_url('pelanggan/update/' . $pelanggan->pelanggan_id), 'Update', array('class' => 'btn btn-danger btn-sm'));
                                    echo '  ';
                                    echo anchor(site_url('pelanggan/delete/' . $pelanggan->pelanggan_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onClick' => "javasciprt: return confirm('Are You Sure ?')"));
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