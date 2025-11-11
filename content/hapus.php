<?php
// 1. Validasi ID dari URL
// Kita ambil ID dari $_GET, sama seperti di edit.php
$id = $_GET['id'] ?? null;

if (!$id) {
    // Jika tidak ada ID di URL, hentikan proses
    die("Error: ID tidak ditemukan. Proses hapus dibatalkan.");
}

// 2. Sertakan koneksi database
// Path ini relatif terhadap index.php (karena file ini di-include oleh index.php)
include "unpam/koneksi.php"; 

// 3. Siapkan dan jalankan query DELETE
try {
    // Gunakan prepared statement untuk keamanan (mencegah SQL Injection)
    $sql = "DELETE FROM register WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    
    // Eksekusi query dengan ID yang didapat dari URL
    $stmt->execute([$id]);

    // 4. Jika berhasil, beri pesan dan redirect kembali ke halaman 'lihat'
    echo "<script>
            alert('Data berhasil dihapus.');
            window.location.href = 'index.php?module=lihat';
          </script>";
    
    // Hentikan eksekusi script setelah redirect
    exit;

} catch (PDOException $e) {
    // 5. Jika query gagal, tampilkan pesan error
    die("Error saat menghapus data: " . $e->getMessage());
}
?>