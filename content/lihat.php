<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data</title>
</head>
<body>

    <h2>Cari Member</h2>
    <form action="index.php" method="get">
        <input type="hidden" name="module" value="cari">
        <label for="username">Ketikkan username:</label>
        <input type="text" name="username" id="username" placeholder="Ketikkan username">
        <input type="submit" value="Cari">
    </form>

    <h2>Daftar Member</h2>
    </form>


    <?php
    // 2. KONEKSI (path relatif ke index.php)
    include "unpam/koneksi.php";

    // 3. LOGIKA PHP UNTUK PENCARIAN
    $search_term = $_GET['search'] ?? null; // Ambil kata kunci dari URL
    $params = []; // Siapkan array parameter untuk PDO

    try {
        if ($search_term) {
            // JIKA ADA PENCARIAN: Buat query dengan LIKE
            $sql = "SELECT * FROM register WHERE username LIKE ?";
            $params[] = "%" . $search_term . "%"; // Tambahkan wildcard
        } else {
            // JIKA TIDAK ADA PENCARIAN (default): Tampilkan semua
            $sql = "SELECT * FROM register";
        }
        
        // 4. EKSEKUSI QUERY
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params); // Jalankan query
        
        $all_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error mengambil data: " . $e->getMessage());
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
        // 6. Tampilkan data (atau pesan jika kosong)
        $nomor = 1;
        if (count($all_users) > 0):
            foreach($all_users as $data): 
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
                <td colspan="10" style="text-align: center;">Data tidak ditemukan.</td>
            </tr>
        <?php
        endif; 
        ?>
    </table>
    <br>
    <a href="?module=home">Kembali ke home &LeftArrow;</a>
</body>
</html>