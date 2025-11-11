<?php
include "unpam/koneksi.php"; 
$user_id = $_GET['id'] ?? null;
if (!$user_id) {
    die("Error: ID User tidak ditemukan.");
}

// 2. Ambil HANYA SATU data user berdasarkan ID
try {
    $stmt = $pdo->prepare("SELECT * FROM register WHERE id = ?");
    $stmt->execute([$user_id]);
    
    // 3. Gunakan fetch() (bukan fetchAll) dan simpan di $data (bukan $all_users)
    $data = $stmt->fetch(PDO::FETCH_ASSOC); 

    // Cek jika user tidak ada
    if (!$data) {
        die("Error: User dengan ID $user_id tidak ditemukan.");
    }

} catch (PDOException $e) {
    die("Error mengambil data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>

    <h2>Edit Data: <?= htmlspecialchars($data['username']); ?></h2>

    <form action="index.php?module=edit2" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
        
        <table>
            <tr>
                <td width="163">Nama depan :</td>
                <td width="317"><input type="text" name="namadep" value="<?= htmlspecialchars($data['namadep']); ?>"/></td>
            </tr>
            <tr>
                <td>Nama Belakang :</td>
                <td><input type="text" name="namabel" value="<?= htmlspecialchars($data['namabel']); ?>"/></td>
            </tr>
            <tr>
                <td>Username :</td>
                <td><input type="text" name="username" value="<?= htmlspecialchars($data['username']); ?>"/></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti" /></td>
            </tr>
            <tr>
                <td>Usia :</td>
                <td><input type="text" name="usia" value="<?= htmlspecialchars($data['usia']); ?>"/></td>
            </tr>
            <tr>
                <td>Jenis Kelamin :</td>
                <td><input type="text" name="jk" value="<?= htmlspecialchars($data['jk']); ?>"/></td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir :</td>
                <td><input type="text" name="ttl" value="<?= htmlspecialchars($data['ttl']); ?>"/></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="email" value="<?= htmlspecialchars($data['email']); ?>"/></td>
            </tr>
            <tr>
                <td>Nomor Telepon :</td>
                <td><input type="text" name="notel" value="<?= htmlspecialchars($data['notel']); ?>"/></td>
            </tr>
            <tr>
                <td><input type="reset" value="Reset" /></td>
                <td><input type="submit" value="Update Data" /></td>
            </tr>
        </table>
    </form>
    
</body>
</html>