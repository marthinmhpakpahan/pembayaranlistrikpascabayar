<h5 class="text-end">Welcome <b class="text-success"><?php echo $_SESSION["login_nama"]; ?></b> <a href="">
        <a href="<?php echo MAIN_URL; ?>/api/user.php?action=logout" alt="">
            <div class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</div>
        </a>
    </a></h5>

<br /><br />
<h4>Daftar Penggunaan Listrik</h4>
<?php if(!isset($_SESSION["login_id_level"])) { ?>
<p>
    <div class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalPenggunaanBaru"><i
            class="fas fa-plus-square"></i> Penggunaan Baru</div>
</p>
<?php } ?>
<?php
        $id_pelanggan = $_SESSION["login_id_user"];
        $data_penggunaan = get_all_penggunaan($db);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
            <td>Nama Pelanggan</td>
            <td>Nomor KWH</td>
            <td>Bulan</td>
            <td>Tahun</td>
            <td>Meter Awal</td>
            <td>Meter Akhir</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_penggunaan as $penggunaan) { ?>
        <tr>
            <td><?= $penggunaan["id_penggunaan"]; ?></td>
            <td><?= $penggunaan["nama_pelanggan"]; ?></td>
            <td><?= $penggunaan["nomor_kwh"]; ?></td>
            <td><?= $penggunaan["bulan"]; ?></td>
            <td><?= $penggunaan["tahun"]; ?></td>
            <td><?= $penggunaan["meter_awal"]; ?></td>
            <td><?= $penggunaan["meter_akhir"]; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<br /><br />
<h4>Daftar Tagihan Listrik</h4>
<?php
        $data_tagihan = get_all_tagihan($db);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
            <td>ID Penggunaan</td>
            <td>Nama Pelanggan</td>
            <td>Bulan</td>
            <td>Tahun</td>
            <td>Daya</td>
            <td>Jumlah Meter</td>
            <td>Total Biaya</td>
            <td>Status</td>
            <td>#</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_tagihan as $tagihan) { ?>
        <tr>
            <td><?= $tagihan["id_tagihan"]; ?></td>
            <td><?= $tagihan["id_penggunaan"]; ?></td>
            <td><?= $tagihan["nama_pelanggan"]; ?></td>
            <td><?= $tagihan["bulan"]; ?></td>
            <td><?= $tagihan["tahun"]; ?></td>
            <td><?= $tagihan["daya"]; ?></td>
            <td><?= $tagihan["jumlah_meter"]; ?></td>
            <td><?= "Rp. " . number_format(($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]), 0); ?></td>
            <td><?= $tagihan["status"]; ?></td>
            <td>
                <?php if($tagihan["status"] != "Sudah Dibayar") { ?>
                    <div data-id-tagihan="<?= $tagihan['id_tagihan']; ?>" data-id-pelanggan="<?= $tagihan['id_pelanggan']; ?>" data-bulan="<?= $tagihan['bulan']; ?>" data-jumlah-meter="<?= $tagihan["jumlah_meter"]; ?>"
                        data-tahun="<?= $tagihan['tahun']; ?>" data-nama-pelanggan="<?= $tagihan["nama_pelanggan"]; ?>" data-daya="<?= $tagihan["daya"]; ?>"
                        data-total-biaya="Rp. <?= number_format(($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]), 0); ?>" data-total-biaya-number="<?= ($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]); ?>"
                        class="btn btn-sm btn-success btn-tandai-sudah-bayar-tagihan" data-bs-toggle="modal"
                        data-bs-target="#modalPaidTagihan"><i class="far fa-check-circle"></i> Tandai Sudah Dibayar</div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<br /><br />
<h4>Daftar Pembayaran Tagihan Listrik</h4>
<?php
        $data_pembayaran = get_all_pembayaran($db);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
            <td>ID Tagihan</td>
            <td>Nama Pelanggan</td>
            <td>Jumlah Meter</td>
            <td>Total Biaya</td>
            <td>Biaya Admin</td>
            <td>Total Bayar</td>
            <td>Tanggal Pembayaran</td>
            <td>Admin</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_pembayaran as $pembayaran) { ?>
        <tr>
            <td><?= $pembayaran["id_pembayaran"]; ?></td>
            <td><?= $pembayaran["id_tagihan"]; ?></td>
            <td><?= $pembayaran["nama_pelanggan"]; ?></td>
            <td><?= $pembayaran["jumlah_meter"]; ?></td>
            <td><?= "Rp. " . number_format(($pembayaran["jumlah_meter"] * $pembayaran["tarifperkwh"]), 0); ?></td>
            <td><?= "Rp. " . number_format($pembayaran["biaya_admin"]); ?></td>
            <td><?= "Rp. " . number_format($pembayaran["total_bayar"]); ?></td>
            <td><?= $pembayaran["tanggal_pembayaran"]; ?></td>
            <td><?= $pembayaran["nama_admin"]; ?></td>
            <td><?= $pembayaran["status"]; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>