</div>
<div class="card-footer bg-success text-white text-center"><marquee><i class="fas fa-copyright"></i> Created by Yohana Rosalinda Situmorang</marquee></div>
</div>
</div>
<div class="col-md-1"></div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        console.log("HOMEPAGE READY!");
        $(".btn-edit-penggunaan").on("click", function() {
            var data_id_penggunaan = $(this).data("id-penggunaan");
            $(".input-edit-id-penggunaan").val(data_id_penggunaan);
            var data_bulan = $(this).data("bulan");
            $(".input-edit-bulan").val(data_bulan);
            var data_tahun = $(this).data("tahun");
            $(".input-edit-tahun").val(data_tahun);
            var data_meter_awal = $(this).data("meter-awal");
            $(".input-edit-meter-awal").val(data_meter_awal);
            var data_meter_akhir = $(this).data("meter-akhir");
            $(".input-edit-meter-akhir").val(data_meter_akhir);
        });
        $(".btn-delete-penggunaan").on("click", function() {
            var data_id_penggunaan = $(this).data("id-penggunaan");
            $(".td-delete-id-penggunaan").text(data_id_penggunaan);
            $(".input-delete-id-penggunaan").val(data_id_penggunaan);
            var data_bulan = $(this).data("bulan");
            $(".td-delete-bulan").text(data_bulan);
            var data_tahun = $(this).data("tahun");
            $(".td-delete-tahun").text(data_tahun);
            var data_meter_awal = $(this).data("meter-awal");
            $(".td-delete-meter-awal").text(data_meter_awal);
            var data_meter_akhir = $(this).data("meter-akhir");
            $(".td-delete-meter-akhir").text(data_meter_akhir);
        });
        $(".btn-tandai-sudah-bayar-tagihan").on("click", function() {
            var data_id_tagihan = $(this).data("id-tagihan");
            $(".td-paid-id-tagihan").text(data_id_tagihan);
            $(".input-paid-id-tagihan").val(data_id_tagihan);
            var data_id_pelanggan = $(this).data("id-pelanggan");
            $(".input-paid-id-pelanggan").val(data_id_pelanggan);
            var data_bulan = $(this).data("bulan");
            $(".td-paid-bulan").text(data_bulan);
            var data_tahun = $(this).data("tahun");
            $(".td-paid-tahun").text(data_tahun);
            var data_jumlah_meter = $(this).data("jumlah-meter");
            $(".td-paid-jumlah-meter").text(data_jumlah_meter);
            var data_nama_pelanggan = $(this).data("nama-pelanggan");
            $(".td-paid-nama-pelanggan").text(data_nama_pelanggan);
            var data_total_biaya = $(this).data("total-biaya");
            var data_total_biaya_number = $(this).data("total-biaya-number");
            $(".td-paid-total-biaya").text(data_total_biaya);
            $(".input-paid-total-biaya").val(data_total_biaya_number);
        });
    });
</script>
</body>

</html>