<?php
include "unpam/koneksi.php";

$id = $_POST['id']; 
$namadep = $_POST['namadep'];
$namabel = $_POST['namabel'];
$username = $_POST['username'];
$password_plain = $_POST['password']; 
$usia = $_POST['usia'];
$jk = $_POST['jk'];
$ttl = $_POST['ttl'];
$email = $_POST['email'];
$notel = $_POST['notel'];

$params = [
    $namadep,
    $namabel,
    $username,
    $usia,
    $jk,
    $ttl,
    $email,
    $notel
];

if (!empty($password_plain)) {
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);
    
    $sql = "UPDATE register SET 
                namadep = ?, namabel = ?, username = ?, 
                password = ?, 
                usia = ?, jk = ?, ttl = ?, email = ?, notel = ? 
            WHERE id = ?"; 
    
    array_splice($params, 3, 0, [$password_hash]); 
    
} else {
    $sql = "UPDATE register SET 
                namadep = ?, namabel = ?, username = ?,
                usia = ?, jk = ?, ttl = ?, email = ?, notel = ? 
            WHERE id = ?"; 
}

$params[] = $id;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    echo "<script>alert('Data Berhasil di Edit');window.location.href='index.php?module=lihat';</script>";

} catch (PDOException $e) {
    die("Error saat mengedit data: " . $e->getMessage());
}
?>