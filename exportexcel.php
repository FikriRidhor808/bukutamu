<?php
include "koneksi.php";

//persipan excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export Excel Data Pengunjung.xls");
header("Pragma: no-cache");
header("Expires:0")
?>

<table border=1>
    <thead>
        <tr>
            <th colspan="6"> Rekapitulasi Data Pengunjung</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama Pengunjung</th>
            <th>Alamat</th>
            <th>Tujuan</th>
            <th>No.Hp</th>
            </tr>
    </thead>
        <tbody>
            <?php
                    $tanggal1 = $_POST['tanggala'];
                    $tanggal2 = $_POST['tanggalb'];


                $tgl = date('Y-m-d');
                $query = "SELECT * FROM ttamu WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2' ORDER BY tanggal asc";
                    $tampil = mysqli_query($koneksi, $query);
                $no=1;

                while($data = mysqli_fetch_array($tampil)){

            ?>
                <tr>
                <td><?= $no++?></td>
                <td><?= $data['tanggal'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['tujuan'] ?></td>
                <td><?= $data['nope'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>