<h1>Tambah Siswa</h1>
<form action="<?= site_url('list_controller/simpan'); ?>" method="post">
    <label>Nama</label><br>
    <input type="text" name="nama" require><br>
    <label>Kelas</label><br>
    <input type="text" name="kelas" require><br>
    <button type="submit">Simpan</button>
</form>
