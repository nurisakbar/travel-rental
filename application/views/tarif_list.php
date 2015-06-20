<div class='col-lg-12'>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top:0px">Tarif List</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <?php      if($this->session->userdata('status')=='login')
                        {echo anchor(site_url('tarif/create'), 'Create', 'class="btn btn-primary"');} ?>
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
                        <th>KENDARAAN</th>
                        <th>TARIF PERHARI</th>
                        <th>TARIF OVERTIME</th>
                        <th widh="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($tarif_data as $tarif) {
                        ?>
                        <tr>
                            <td><?php echo++$start ?></td>
                            <td><?php echo $tarif->kendaraan_platnomor ?></td>
                            <td><?php echo $tarif->tarif_perhari ?></td>
                            <td><?php echo $tarif->tarif_overtime ?></td>
                            <td style="text-align:center">
                                <?php
                                echo anchor(site_url('tarif/read/' . $tarif->tarif_id), 'Read', array('class' => 'btn btn-danger btn-sm'));
                                echo '  ';
                                if ($this->session->userdata('status') == 'login') {
                                    echo anchor(site_url('tarif/update/' . $tarif->tarif_id), 'Update', array('class' => 'btn btn-danger btn-sm'));
                                    echo '  ';
                                    echo anchor(site_url('tarif/delete/' . $tarif->tarif_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onClick' => "javasciprt: return confirm('Are You Sure ?')"));
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