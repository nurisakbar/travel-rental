<div class='col-lg-12'>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top:0px">Sopir List</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <?php if ($this->session->userdata('status') == 'login') {
                echo anchor(site_url('sopir/create'), 'Create', 'class="btn btn-primary"');
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
                        <th>NAMA</th>
                        <th>TELPON</th>
                        <th>KTP</th>
                        <th>SIM</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($sopir_data as $sopir) {
                        ?>
                        <tr>
                            <td><?php echo++$start ?></td>
                            <td><?php echo $sopir->sopir_nama ?></td>
                            <td><?php echo $sopir->sopir_telpon ?></td>
                            <td><?php echo $sopir->sopir_ktp ?></td>
                            <td><?php echo $sopir->sopir_sim ?></td>
                            <td><?php echo $sopir->sopir_status ?></td>
                            <td style="text-align:center" width="180">
                                <?php
                                echo anchor(site_url('sopir/read/' . $sopir->sopir_id), 'Read', array('class' => 'btn btn-danger btn-sm'));
                                echo '  ';
                                if ($this->session->userdata('status') == 'login') {
                                    echo anchor(site_url('sopir/update/' . $sopir->sopir_id), 'Update', array('class' => 'btn btn-danger btn-sm'));
                                    echo '  ';
                                    echo anchor(site_url('sopir/delete/' . $sopir->sopir_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onClick' => "javasciprt: return confirm('Are You Sure ?')"));
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
    </div></div>