<h2>LAPORAN TRANSAKSI</h2>
<hr>
<table border="1">
    <tr><th>NO</th><th>TANGGAL TRANSAKSI</th><th>SELESAI</th><th>SOPIR</th><th>MOBIL</th><th>PELANGGAN</th><th>TOTAL</th></tr>
    <?PHP
    $no=1;
    foreach ($transaksi as $t)
    {
        echo "<tr><td>$no</td>
            <td>".  tgl_indo($t->transaksi_tglmulai)."</td>
            <td>".  tgl_indo($t->transaksi_tglselesai)."</td>
            <td>$t->sopir_nama</td>
            <td>$t->kendaraan_platnomor</td>
            <td>$t->pelanggan_nama</td>
            <td>$t->transaksi_total</td>
            </tr>";
        $no++;
    }
    ?>
</table>