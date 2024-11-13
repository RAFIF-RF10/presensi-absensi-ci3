<h1>Data Siswa</h1>
<a href="<?php echo site_url('list_controller/tambah'); ?>">Tambah Siswa</a>
<br>
<a href="<?= site_url('Login_controller_guru/logout'); ?>">Logout</a>
<br>
<a href="<?= site_url('dashboard_guru/persetujuan'); ?>">Verifikasi Absen</a>
<a href="<?= site_url('dashboard-guru/data-siswa'); ?>">Absensi Siswa</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>PIN</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($siswa)): ?>
        <?php foreach ($siswa as $row): ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->kelas; ?></td>
                <td><?php echo $row->pin; ?></td>
                <td>
                    <a href="<?php echo site_url('list_controller/edit/'.$row->id); ?>">Edit</a>
                    <a href="<?php echo site_url('list_controller/hapus/'.$row->id); ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Tidak ada data siswa.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Tabel Absensi yang Sudah Disetujui Hari Ini -->
<h2>Absensi Hari Ini yang Sudah Disetujui</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status</th>
    </tr>

    <?php if (!empty($absensi_today)) : ?>
        <?php foreach ($absensi_today as $absensi) : ?>
            <tr>
                <td><?= $absensi->id; ?></td>
                <td><?= $absensi->tanggal; ?></td>
                <td><?= $absensi->nama; ?></td>
                <td><?= $absensi->kelas; ?></td>
                <td><?= $absensi->status; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="5">Tidak ada absensi yang disetujui hari ini.</td>
        </tr>
    <?php endif; ?>
</table>
