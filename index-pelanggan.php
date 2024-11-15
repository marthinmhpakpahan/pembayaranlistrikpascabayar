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
        $data_penggunaan = get_all_penggunaan($db, $id_pelanggan);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
            <td>Bulan</td>
            <td>Tahun</td>
            <td>Meter Awal</td>
            <td>Meter Akhir</td>
            <td>#</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_penggunaan as $penggunaan) { ?>
        <tr>
            <td><?= $penggunaan["id_penggunaan"]; ?></td>
            <td><?= $penggunaan["bulan"]; ?></td>
            <td><?= $penggunaan["tahun"]; ?></td>
            <td><?= $penggunaan["meter_awal"]; ?></td>
            <td><?= $penggunaan["meter_akhir"]; ?></td>
            <td>
                <?php if(!isset($_SESSION["login_id_level"])) { ?>
                    <div data-id-penggunaan="<?= $penggunaan['id_penggunaan']; ?>" data-bulan="<?= $penggunaan['bulan']; ?>"
                        data-tahun="<?= $penggunaan['tahun']; ?>" data-meter-awal="<?= $penggunaan['meter_awal']; ?>"
                        data-meter-akhir="<?= $penggunaan['meter_akhir']; ?>"
                        class="btn btn-sm btn-primary btn-edit-penggunaan" data-bs-toggle="modal"
                        data-bs-target="#modalUpdatePenggunaan"><i class="fas fa-edit"></i></div>
                    <div data-id-penggunaan="<?= $penggunaan['id_penggunaan']; ?>" data-bulan="<?= $penggunaan['bulan']; ?>"
                        data-tahun="<?= $penggunaan['tahun']; ?>" data-meter-awal="<?= $penggunaan['meter_awal']; ?>"
                        data-meter-akhir="<?= $penggunaan['meter_akhir']; ?>"
                        class="btn btn-sm btn-danger btn-delete-penggunaan" data-bs-toggle="modal"
                        data-bs-target="#modalDeletePenggunaan"><i class="fas fa-trash"></i></div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<br /><br />
<h4>Daftar Tagihan Listrik</h4>
<?php
        $data_tagihan = get_all_tagihan($db, $id_pelanggan);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
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
            <td><?= $tagihan["bulan"]; ?></td>
            <td><?= $tagihan["tahun"]; ?></td>
            <td><?= $tagihan["daya"]; ?></td>
            <td><?= $tagihan["jumlah_meter"]; ?></td>
            <td><?= "Rp. " . number_format(($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]), 0); ?></td>
            <td><?= $tagihan["status"]; ?></td>
            <td>
            <?php if(!isset($_SESSION["login_id_level"]) && $tagihan['status'] == "Belum Dibayar") { ?>
                <div data-id-tagihan="<?= $tagihan['id_tagihan']; ?>" data-id-pelanggan="<?= $tagihan['id_pelanggan']; ?>" data-bulan="<?= $tagihan['bulan']; ?>" data-jumlah-meter="<?= $tagihan["jumlah_meter"]; ?>"
                        data-tahun="<?= $tagihan['tahun']; ?>" data-daya="<?= $tagihan["daya"]; ?>" 
                        data-total-biaya="Rp. <?= number_format(($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]), 0); ?>" data-total-biaya-number="<?= ($tagihan["jumlah_meter"] * $tagihan["tarifperkwh"]); ?>"
                        class="btn btn-sm btn-success btn-tandai-sudah-bayar-tagihan" data-bs-toggle="modal" data-bs-target="#modalConfirmPaidTagihan"><i class="far fa-check-circle"></i> Konfirmasi Pembayaran</div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<br /><br />
<h4>Daftar Pembayaran Tagihan Listrik</h4>
<?php
        $data_pembayaran = get_all_pembayaran($db, $id_pelanggan);
    ?>
<table class="table mt-4 text-center table-bordered align-middle table-hover">
    <thead>
        <tr class="fw-bold">
            <td>ID</td>
            <td>ID Tagihan</td>
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