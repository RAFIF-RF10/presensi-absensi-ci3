<h1>Rekap Absensi Siswa</h1>

<form method="GET" action="<?= site_url('list_controller/rekap_absensi'); ?>">
    <label for="bulan">Pilih Bulan:</label>
    <select name="bulan" id="bulan">
        <option value="">Semua Bulan</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
    
    <label for="kelas">Pilih Kelas:</label>
    <select name="kelas" id="kelas">
        <option value="">Semua Kelas</option>
        <option value="XII RPL 1">XII RPL 1</option>
        <option value="XII RPL 2">XII RPL 2</option>
        <option value="XI RPL 1">XI RPL 1</option>
        <option value="XI RPL 2">XI RPL 2</option>
        <option value="X RPL 1">X RPL 1</option>
        <option value="X RPL 2">X RPL 2</option>
        <option value="XII TKJ 1">XII TKJ 1</option>
        <option value="XII TKJ 2">XII TKJ 2</option>
        <option value="XI TKJ 1">XI TKJ 1</option>
        <option value="XI TKJ 2">XI TKJ 2</option>
        <option value="X TKJ 1">X TKJ 1</option>
        <option value="X TKJ 2">X TKJ 2</option>
        <option value="XII DKV 1">XII DKV 1</option>
        <option value="XII DKV 2">XII DKV 2</option>
        <option value="XI DKV 1">XI DKV 1</option>
        <option value="XI DKV 2">XI DKV 2</option>
        <option value="X DKV 1">X DKV 1</option>
        <option value="X DKV 2">X DKV 2</option>
        <option value="XII TBSM 1">XII TBSM 1</option>
        <option value="XII TBSM 2">XII TBSM 2</option>
        <option value="XII TBSM 3">XII TBSM 3</option>
        <option value="XI TBSM 1">XI TBSM 1</option>
        <option value="XI TBSM 2">XI TBSM 2</option>
        <option value="XI TBSM 3">XI TBSM 3</option>
        <option value="X TBSM 1">XTBSM 1</option>
        <option value="X TBSM 2">X TBSM 2</option>
        <option value="X TBSM 3">X TBSM 3</option>
        <option value="XII TKRO 1">XII TKRO 1</option>
        <option value="XII TKRO 2">XII TKRO 2</option>
        <option value="XII TKRO 3">XII TKRO 3</option>
        <option value="XI TKRO 1">XI TKRO 1</option>
        <option value="XI TKRO 2">XI TKRO 2</option>
        <option value="XI TKRO 3">XI TKRO 3</option>
        <option value="X TKRO 1">X TKRO 1</option>
        <option value="X TKRO 2">X TKRO 2</option>
        <option value="X TKRO 3">X TKRO 3</option>
        <option value="XII ATPH 1">XII ATPH 1</option>
        <option value="XII ATPH 2">XII ATPH 2</option>
        <option value="XI ATPH 1">XI ATPH 1</option>
        <option value="XI ATPH 2">XI ATPH 2</option>
        <option value="X ATPH 1">X ATPH 1</option>
        <option value="X ATPH 2">X ATPH 2</option>
        <option value="XII APT 1">XII APT 1</option>
        <option value="XII APT 2">XII APT 2</option>
        <option value="XI APT 1">XI APT 1</option>
        <option value="XI APT 2">XI APT 2</option>
        <option value="X APT 1">X APT 1</option>
        <option value="X APT 2">XAPT 2</option>
    </select>
    
    <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="5" cellspacing="0" style="margin-top: 20px;">
    <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    <?php if (!empty($rekap_absensi)) : ?>
        <?php foreach ($rekap_absensi as $absensi) : ?>
            <tr>
                <td><?= $absensi->nama; ?></td>
                <td><?= $absensi->kelas; ?></td>
                <td><?= $absensi->status; ?></td>
                <td><?= date('d-m-Y', strtotime($absensi->tanggal)); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="4">Tidak ada data absensi untuk kriteria yang dipilih.</td>
        </tr>
    <?php endif; ?>
</table>
<br>
<a href="<?= site_url('dashboard_guru/list'); ?>">
    <button>Kembali ke Dashboard</button>
</a>
