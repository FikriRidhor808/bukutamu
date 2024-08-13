<?php include "header.php"; ?>

<!--awal row-->
<div class="row">
    <!--awal col-md-12-->
    <div class="col-md-12">
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
            </div>
            <div class="card-body">
                <form method="post" action="" class="text-center">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Dari Tanggal</label>
                                <input type="date" class="form-control" name="tanggal1" value="<?= isset($_POST['tanggal1']) ?
                                 $_POST['tanggal1'] : date('Y-m-d')?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="tanggal2" value="<?= isset($_POST['tanggal2']) ?
                                 $_POST['tanggal2'] : date('Y-m-d')?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <button class="btn btn-primary form-control" name="btampilkan" type="submit">
                                <i class="fa fa-search"></i> Tampilkan
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="admin.php" class="btn btn-danger form-control">
                                <i class="fa fa-backward"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>

                <?php 
                if (isset($_POST['btampilkan'])):
                    // Mengambil nilai dari input form
                    $tanggal1 = $_POST['tanggal1'];
                    $tanggal2 = $_POST['tanggal2'];

                    // Query untuk menampilkan data berdasarkan rentang tanggal
                    $query = "SELECT * FROM ttamu WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2' ORDER BY id DESC";
                    $tampil = mysqli_query($koneksi, $query);
                    if (!$tampil) {
                        echo "Error: " . mysqli_error($koneksi);
                    } else {
                ?>
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
                                <th>Action</th>
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
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><?= $data['tujuan'] ?></td>
                                <td><?= $data['nope'] ?></td>
                                <td>
                                    <form method="post" action="">
                                    <a href="edit_data.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_data.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <center>
                        <form method="POST" action="exportexcel.php">
                            <div class="col-md-4">
                            <input type="hidden" name="tanggala" value="<?= @$_POST['tanggal1']?>">
                            <input type="hidden" name="tanggalb" value="<?= @$_POST['tanggal2']?>">

                            <button class="btn btn-success form-control" name="bexport"><i class="fa fa-donwload"></i>Export Data Excel</button>
                            </div>
                        </form>
                    </center>

                </div>
                <?php
                    } // End if (!$tampil)
                endif; 
                ?>
            </div>
        </div>
    </div>
    <!--end col-md-12-->
</div>
<!--end row-->

<?php include "footer.php"; ?>
