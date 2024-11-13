<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
</head>
<body>
    <h2>Selamat datang, <?= $this->session->userdata('siswa_nama'); ?></h2>
    <p>Ini adalah dashboard siswa.</p>
    <p>Masukkan absensi anda hari ini.</p>
    <form action="<?= site_url('Ijin_controller/set_status'); ?>" method="POST">
        <button type="submit" name="status" value="masuk">Masuk</button>
        <button type="submit" name="status" value="izin">Izin</button>
        <button type="submit" name="status" value="sakit">Sakit</button>
        <button type="submit" name="status" value="dispen">Dispen</button> <!-- Perbaiki value -->
    </form>

    <a href="<?= site_url('Login_controller_siswa/logout'); ?>">Logout</a>
</body>
</html>
