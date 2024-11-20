<h1>Daftar Absensi Siswa yang Menunggu Persetujuan</h1>


<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($pending_list)) : ?>
        <?php foreach ($pending_list as $pending) : ?>
            <tr>
                <td><?= $pending->id; ?></td>
                <td><?= $pending->tanggal; ?></td>
                <td><?= $pending->nama; ?></td>
                <td><?= $pending->kelas; ?></td>
                <td><?= $pending->status; ?></td>

                <td>
				<a href="<?= site_url('dashboard_guru/setuju/' . $pending->id); ?>">Setuju</a> |
<a href="<?= site_url('dashboard_guru/tolak/' . $pending->id); ?>">Tolak</a>

                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">Tidak ada data persetujuan.</td>
        </tr>
    <?php endif; ?>
</table>


<!-- Tombol Kembali ke Dashboard Guru -->
<br>
<a href="<?= site_url('dashboard_guru/list'); ?>">
    <button>Kembali ke Dashboard</button>
</a>
<?php if ($this->session->flashdata('message')): ?>
    <script>
        alert("<?= $this->session->flashdata('message'); ?>");
    </script>
<?php endif; ?>
