<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
</head>
<body>

    <h2>Hasil Pencarian</h2>

    <?php
    // 1. Sertakan koneksi (path relatif ke index.php)
    include "unpam/koneksi.php";
    $nomor = 1;
    // 2. Ambil username dari URL dengan aman
    $username = $_GET['username'] ?? null;

    if ($username) {
        try {
            // 3. Siapkan query PDO yang aman untuk mencegah SQL Injection
            $sql = "SELECT * FROM register WHERE username LIKE ?";
            
            $stmt = $pdo->prepare($sql);
            
            // 4. Eksekusi query dengan menambahkan wildcard '%'
            $stmt->execute(["%" . $username . "%"]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error mengambil data: " . $e->getMessage());
        }
    } else {
        // Jika tidak ada username yang dicari, $results adalah array kosong
        $results = [];
    }
    ?>

    <table>
        <tr>
            <th>Id</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Username</th>
            <th>Usia</th>
            <th>JK</th>
            <th>TTL</th>
            <th>Email</th>
            <th>Notel</th>
            <th>Aksi</th>
        </tr>

        <?php
        // 6. Loop hasil pencarian
        if (count($results) > 0):
            foreach($results as $data):
        ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= htmlspecialchars($data['namadep']); ?></td>
            <td><?= htmlspecialchars($data['namabel']); ?></td>
            <td><?= htmlspecialchars($data['username']); ?></td>
            <td><?= htmlspecialchars($data['usia']); ?></td>
            <td><?= htmlspecialchars($data['jk']); ?></td>
            <td><?= htmlspecialchars($data['ttl']); ?></td>
            <td><?= htmlspecialchars($data['email']); ?></td>
            <td><?= htmlspecialchars($data['notel']); ?></td>
            <td>
                <a href="?module=edit&id=<?= htmlspecialchars($data['id']); ?>">Edit</a> | 
                <a href="?module=hapus&id=<?= htmlspecialchars($data['id']); ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php
            $nomor++;
            endforeach;
        else:
        ?>
            <tr>
                <td colspan="10" style="text-align: center;">
                    Data dengan username "<?= htmlspecialchars($username); ?>" tidak ditemukan.
                </td>
            </tr>
        <?php
        endif;
        ?>
    </table>
    <br>
    <a href="?module=lihat">Kembali ke Daftar Member &LeftArrow;</a>

</body>
</html>