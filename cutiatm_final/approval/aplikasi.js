(function($) {
$(document).ready(function() {
    var main = "approval.data.php";
    function loadData(page) {
        $("#data-approval").load(main + (page ? "?page=" + page : ""));
    }
    function showMsg(type, text) {
        var cls = type === 'success' ? 'alert-success' : 'alert-danger';
        $("#approval-alert").html('<div class="alert '+cls+'"><i class="fa-solid fa-circle-info"></i> '+text+'</div>');
    }
    loadData();

    $(document).on("click", ".aksi-approve", function(e){
    e.preventDefault();

    var id = $(this).data("id");

    if(confirm("Approve pengajuan ini?")){
        $.post("approval.input.php", {approve: id}, function(res){

            if(res.trim() == "ok"){
                alert("✅ Berhasil di approve");
                $("#data-approval").load("approval.data.php");
            } else {
                alert("❌ Gagal approve");
            }

        });
    }
});

    $(document).on("click", ".aksi-tolak", function(e){
    e.preventDefault();

    var id = $(this).data("id");

    if(confirm("Reject pengajuan ini?")){
        $.post("approval.input.php", {reject: id}, function(res){

            if(res.trim() == "ok"){
                alert("❌ Berhasil di reject");
                $("#data-approval").load("approval.data.php");
            } else {
                alert("❌ Gagal reject");
            }

        });
    }
});
});
})(jQuery);
