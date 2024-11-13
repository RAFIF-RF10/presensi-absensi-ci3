<h1>Edit Siswa</h1>
<form action="<?= site_url('list_controller/update/' . $siswa->id); ?>" method="post">
    <label>Nama</label><br>
    <input type="text" name="nama" value="<?= $siswa->nama; ?>"><br>
    <label>Kelas</label><br>
    <input type="text" name="kelas" value="<?= $siswa->kelas; ?>"><br>
    <button type="submit">Update</button>
</form>
