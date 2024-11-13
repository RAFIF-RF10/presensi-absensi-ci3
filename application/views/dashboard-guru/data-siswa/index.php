<h1>Seluruh Data Absensi Siswa</h1>

<!-- Tautan untuk kembali ke halaman dashboard guru -->
<a href="<?= site_url('dashboard_guru/list'); ?>">Kembali ke Dashboard</a>
<br>
<a href="<?= site_url('Login_controller_guru/logout'); ?>">Logout</a>
<br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status Absensi</th>
        <th>Tanggal</th>
    </tr>
    <?php if (!empty($absensi_siswa)): ?>
        <?php foreach ($absensi_siswa as $row): ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->kelas; ?></td>
                <td><?php echo $row->status; ?></td>
                <td><?php echo $row->tanggal; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Tidak ada data absensi siswa.</td>
        </tr>
    <?php endif; ?>
</table>
