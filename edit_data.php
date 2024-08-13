<?php
include "header.php";
include "koneksi.php";

// Mengecek apakah ID ada dalam URL dan apakah data form telah di-submit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM ttamu WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    
    // Mengecek apakah data ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Mengecek apakah form telah disubmit untuk mengedit data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tujuan = $_POST['tujuan'];
    $nope = $_POST['nope'];
    
    // Query untuk mengupdate data
    $update_query = "UPDATE ttamu SET nama = '$nama', alamat = '$alamat', tujuan = '$tujuan', nope = '$nope' WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $update_query)) {
        echo "Data berhasil diupdate.";
        header("Location: rekapitulasi.php"); // Redirect ke halaman admin setelah update
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<div class="container">
    <h2 style="color: black;">Edit Data Pengunjung</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nama" style="color: black;">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat" style="color: black;">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>" required>
        </div>
        <div class="form-group">
            <label for="tujuan" style="color: black;">Tujuan:</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= $data['tujuan'] ?>" required>
        </div>
        <div class="form-group">
            <label for="nope" style="color: black;">No. Hp:</label>
            <input type="text" class="form-control" id="nope" name="nope" value="<?= $data['nope'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success" name="update">Update</button>
        <a href="admin.php" class="btn btn-light">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
