(function($) {
$(document).ready(function() {
    var main = "cekpengajuancuti.data.php";
    $("#data-cekpengajuancuti").load(main);
    $(document).on("click", ".pagenya", function(e) {
        e.preventDefault();
        var p = this.id || 1;
        $("#data-cekpengajuancuti").load(main + "?page=" + p);
    });
});
})(jQuery);
