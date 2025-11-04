<html>
<head>
    <title>mywebsite</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <div id="container">
        <div id="header">
            <img class="logo" src="img/logouin.gif" alt="logo UIN">
            <h1>Sistem Pakar</h1>
            <img class="logo" src="img/logo.gif" alt="logo Nama">
        </div>

        <div id="sidebar">
            <h3>Navigasi</h3>
            <ul id="navmenu">
                <li><a href="index.php" style="background-color: rgb(43, 81, 130); text-align:right; color:white;">Profil</a></li>
                <li><a href="?module=gallery">Galeri</a></li>
                <li><a href="?module=jadwal">Jadwal</a></li>
                <li><a href="?module=insert">Insert</a></li>
            </ul>
        </div>

        
        <div id="page">
            <?php
                $post = $_GET['module'] ?? 'home';
                include "content/$post.php";
            ?>
        </div>

        <div id="clear"></div>
        <div id="footer">
            <p>&copy; 2010</p>
        </div>


    </div>
    
</body>
</html>