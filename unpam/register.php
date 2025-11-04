<?php
include "koneksi.php";


$namadep = $_POST['namadep'];
$namabel = $_POST['namabel'];
$username = $_POST['username'];
$password_plain = $_POST['password']; 
$usia = $_POST['usia'];
$jk = $_POST['jk'];
$ttl = $_POST['ttl'];
$email = $_POST['email'];
$notel = $_POST['notel'];

$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);


$sql = "INSERT INTO register (namadep, namabel, username, password, usia, jk, ttl, email, notel) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


try {

    $stmt = $pdo->prepare($sql);
 
    $stmt->execute([
        $namadep,
        $namabel,
        $username,
        $password_hash, 
        $usia,
        $jk,
        $ttl,
        $email,
        $notel
    ]);

    echo"<script>alert('Selamat, anda telah terdaftar di sistem pakar');window.location.href='../index.php';</script>";

} catch (PDOException $e) {
    die("Error saat mendaftar: " . $e->getMessage());
}

?>