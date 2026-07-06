(function($) {
$(document).ready(function() {
    var main = "proses.data.php";
    function loadData(page){ $("#data-proses").load(main + (page ? "?page=" + page : "")); }
    function showMsg(type, text) {
        var cls = type === 'success' ? 'alert-success' : 'alert-danger';
        $("#proses-alert").html('<div class="alert '+cls+'"><i class="fa-solid fa-circle-info"></i> '+text+'</div>');
    }
    loadData();

    $(document).on("click", ".aksi-proses", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        if (!confirm("Proses cuti " + id + " dan kurangi sisa cuti sesuai lama hari?")) return;
        $.post("proses.input.php", {id: id}, function(res){
            res = $.trim(res);
            if (res === "ok") { showMsg('success', 'Cuti berhasil diproses dan sisa cuti sudah diperbarui.'); loadData(); }
            else { showMsg('danger', res || 'Gagal memproses cuti.'); }
        });
    });

    $(document).on("click", ".pagenya", function(e){
        e.preventDefault();
        loadData(this.id || 1);
    });
});
})(jQuery);
