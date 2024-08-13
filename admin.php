<!--panggil file header-->
<?php include "header.php";?>

<?php 

//Uji jika tombol diklik
if(isset($_POST['bsimpan'])){
    $tgl = date('Y-m-d');
//htmlspecialchars agar lebih aman injection
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);
//simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUE ('','$tgl','$nama','$alamat','$tujuan','$nope')");

    //uji jika berhasil
    if ($simpan){
        echo"<script>alert('Simpan Data Berhasil, Terima kasih');
        document.location='?'</script>";
    } else {
        echo"<script>alert('Simpan Data Gagal, Terima kasih');
        document.location='?'</script>";
    }
}
?>

       <!--head-->
        <div class="head text-center">
            <img src="assets/img/logo.png" alt="" width="400">
            <h2 class="text-white">Sistem Informasi Buku Tamu <br> ID.cooperation</h2>
        </div>
        <!--end head-->

        <!--row-->
        <div class="row mt-2">
            <!-- col-lg-7 -->
            <div class="col-lg-7 mb-3">
                <div class="card shadow bg-gradient-light">
                    <!-- card body-->
                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengguna</h1>
                            </div>
                            <form class="user" method="POST" action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="alamat" placeholder="Alamat Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="nope" placeholder="No.hp">
                                </div>
                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">By. ID.cooperation | 2021 - <?=date('Y') ?></a>
                            </div>
                    </div>
                    <!-- end card body-->
                </div>
            </div>
        <!-- end col-lg-7 -->

        <!-- col-lg-5 -->
        <div class="col-lg-5 mb-3">
                <!-- card -->
                <div class="card shadow">
                    <!-- card body-->
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                        </div>
                        <?php
                            //deklarasi tanggal

                            //menampilkan tanggal sekarang
                            $tgl_sekarang = date('Y-m-d');

                            //menampilkan tanggal kemarin
                            $kemarin = date('Y-m-d', strtotime('-1 day',strtotime(date('Y-m-d'))));

                            //mendapatkan 6 hari sebelum tanggal sekarang
                            $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime(date($tgl_sekarang))));

                            $sekarang = date('Y-m-d h:i:s');

                            //persiapan query data pengunjung

                            $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu Where tanggal like '%$tgl_sekarang%'"));

                            $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu Where tanggal like '%$kemarin%'"));

                            $seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu Where tanggal BETWEEN '$seminggu' and '$sekarang'"));

                            $bulan_ini = date('m');

                            $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu Where month(tanggal) = '$bulan_ini'"));

                            $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu "));
                        ?>
                        <table class="table table-bordered">
                                <tr>
                                    <td>Hari ini</td>
                                    <td>: <?=$tgl_sekarang[0] ?></td>
                                </tr>
                                <tr>
                                    <td>Kemarin</td>
                                    <td>: <?=$kemarin[0] ?></td>
                                </tr>
                                <tr>
                                    <td>Minggu ini</td>
                                    <td>: <?=$seminggu[0] ?></td>
                                </tr>
                                <tr>
                                    <td>Bulan ini</td>
                                    <td>: <?=$sebulan[0] ?></td>
                                </tr>
                                <tr>
                                    <td>Keseluruhan</td>
                                    <td>: <?=$keseluruhan[0] ?></td>
                                </tr>
                            </table>
                    </div>
                    <!-- end card body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-lg-5 -->

        </div>
        <!--end row-->
        
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?=date('d-m-Y')?>]</h6>
                        </div>
                        <div class="card-body">

                            <a href="rekapitulasi.php" class=" btn btn-success mb-3">
                                <i class="fa fa-table"></i> Rekapitulasi Pengunjung</a>
                            <a href="logout.php" class=" btn btn-danger mb-3">
                                <i class="fa fa-sign-out-alt"></i> Log out</a>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>No.Hp</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>No.Hp</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $tgl = date('Y-m-d');
                                            $tampil = mysqli_query($koneksi,"SELECT * FROM ttamu where tanggal like '%$tgl%' order by id desc"); 
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
                            </div>
                        </div>
                    </div>
<!--panggil file footer-->
<?php include "footer.php";?>
    