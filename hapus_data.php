<?php
include "koneksi.php";

// Mengecek apakah ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk menghapus data berdasarkan ID
    $delete_query = "DELETE FROM ttamu WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $delete_query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}

header("Location: rekapitulasi.php"); // Redirect ke halaman admin setelah menghapus data
exit;
?>
