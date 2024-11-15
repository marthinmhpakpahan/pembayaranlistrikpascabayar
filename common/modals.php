<!-- Modal Penggunaan Baru -->
<div class="modal fade" id="modalPenggunaanBaru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalPenggunaanBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="modalPenggunaanBaruLabel">Tambahkan Penggunaan Listrik Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-create-penggunaan" method="POST"
                action="<?php echo MAIN_URL; ?>/api/penggunaan.php?action=create">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Bulan</label>
                            <select class="form-select" name="bulan" aria-label="Default select example">
                                <option selected>Pilih Bulan</option>
                                <?php
                                    $list_bulan = [
                                        "1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni",
                                        "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
                                    ];
                                    foreach($list_bulan as $bulanAngka => $bulanText) {
                                ?>
                                <option value="<?= $bulanAngka; ?>"><?= $bulanText; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Tahun</label>
                            <select class="form-select" name="tahun" aria-label="Default select example">
                                <option selected>Pilih Tahun</option>
                                <?php
                                    $current_year = date("Y");
                                    $start_year = $current_year - 10;
                                    for($start_year; $start_year<=$current_year; $start_year++) {
                                ?>
                                <option value="<?= $start_year; ?>"><?= $start_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Meter Awal</label>
                            <input type="number" class="form-control" name="meter_awal">
                        </div>
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Meter Akhir</label>
                            <input type="number" class="form-control" name="meter_akhir">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Penggunaan -->
<div class="modal fade" id="modalUpdatePenggunaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalUpdatePenggunaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="modalUpdatePenggunaanLabel">Ubah Penggunaan Listrik Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update-penggunaan" method="POST"
                action="<?php echo MAIN_URL; ?>/api/penggunaan.php?action=update">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Bulan</label>
                            <input class="input-edit-id-penggunaan form-control" type="hidden" name="id_penggunaan">
                        </div>
                        <div class="col mt-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Bulan</label>
                            <input class="input-edit-bulan form-control" type="number" name="bulan">
                        </div>
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Tahun</label>
                            <input class="input-edit-tahun form-control" type="number" name="tahun">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Meter Awal</label>
                            <input class="input-edit-meter-awal form-control" type="number" name="meter_awal">
                        </div>
                        <div class="col mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Meter Akhir</label>
                            <input class="input-edit-meter-akhir form-control" type="number" name="meter_akhir">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete Penggunaan -->
<div class="modal fade" id="modalDeletePenggunaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalDeletePenggunaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="modalDeletePenggunaanLabel">Hapus Penggunaan Listrik</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-delete-penggunaan" method="POST"
                action="<?php echo MAIN_URL; ?>/api/penggunaan.php?action=delete">
                <input type="hidden" class="input-delete-id-penggunaan" name="id_penggunaan" value="">
                <div class="modal-body">
                    <h4>Apakah anda yakin mau menghapus data penggunaan ini?</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Penggunaan</td>
                            <td>:</td>
                            <td class="td-delete-id-penggunaan"></td>
                        </tr>
                        <tr>
                            <td>Bulan</td>
                            <td>:</td>
                            <td class="td-delete-bulan"></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>:</td>
                            <td class="td-delete-tahun"></td>
                        </tr>
                        <tr>
                            <td>Meter Awal</td>
                            <td>:</td>
                            <td class="td-delete-meter-awal"></td>
                        </tr>
                        <tr>
                            <td>Meter Akhir</td>
                            <td>:</td>
                            <td class="td-delete-meter-akhir"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tandai Tagihan Sudah Dibayar -->
<div class="modal fade" id="modalPaidTagihan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalPaidTagihanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="modalPaidTagihanLabel">Tandai Tagihan Sudah Dibayar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-paid-tagihan" method="POST"
                action="<?php echo MAIN_URL; ?>/api/tagihan.php?action=paid">
                <input type="hidden" class="input-paid-id-tagihan" name="id_tagihan" value="">
                <input type="hidden" class="input-paid-id-pelanggan" name="id_pelanggan" value="">
                <input type="hidden" class="input-paid-total-biaya" name="total_biaya" value="">
                <div class="modal-body">
                    <h4>Apakah anda yakin mengubah status data ini menjadi "Sudah Dibayar"?</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Tagihan</td>
                            <td>:</td>
                            <td class="td-paid-id-tagihan"></td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>:</td>
                            <td class="td-paid-nama-pelanggan"></td>
                        </tr>
                        <tr>
                            <td>Bulan</td>
                            <td>:</td>
                            <td class="td-paid-bulan"></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>:</td>
                            <td class="td-paid-tahun"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Meter</td>
                            <td>:</td>
                            <td class="td-paid-jumlah-meter"></td>
                        </tr>
                        <tr>
                            <td>Total Biaya</td>
                            <td>:</td>
                            <td class="td-paid-total-biaya"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tandai Tagihan Sudah Dibayar -->
<div class="modal fade" id="modalConfirmPaidTagihan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalConfirmPaidTagihanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="modalConfirmPaidTagihanLabel">Tandai Tagihan Sudah Dibayar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-paid-tagihan" method="POST"
                action="<?php echo MAIN_URL; ?>/api/tagihan.php?action=confirm">
                <input type="hidden" class="input-paid-id-tagihan" name="id_tagihan" value="">
                <input type="hidden" class="input-paid-id-pelanggan" name="id_pelanggan" value="">
                <input type="hidden" class="input-paid-total-biaya" name="total_biaya" value="">
                <div class="modal-body">
                    <h4>Apakah anda yakin ingin mengkonfirmasi sudah membayar tagihan ini?</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Tagihan</td>
                            <td>:</td>
                            <td class="td-paid-id-tagihan"></td>
                        </tr>
                        <tr>
                            <td>Bulan</td>
                            <td>:</td>
                            <td class="td-paid-bulan"></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>:</td>
                            <td class="td-paid-tahun"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Meter</td>
                            <td>:</td>
                            <td class="td-paid-jumlah-meter"></td>
                        </tr>
                        <tr>
                            <td>Total Biaya</td>
                            <td>:</td>
                            <td class="td-paid-total-biaya"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>