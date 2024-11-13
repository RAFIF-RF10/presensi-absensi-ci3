<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
</head>
<body>
    <h2>Login Siswa</h2>
    <?php if ($this->session->flashdata('error')) : ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <form action="<?= site_url('Login_controller_siswa/proses_login'); ?>" method="post">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required><br>

        <label for="pin">PIN:</label>
        <input type="password" name="pin" id="pin" required><br>

        <button type="submit">Login</button>
    </form>
    <a href="<?= site_url('Login_controller_siswa/kembali'); ?>">Kembali</a>
</body>
</html>
