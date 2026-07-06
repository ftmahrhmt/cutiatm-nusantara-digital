(function($) {
$(document).ready(function() {
    var main = "jadwalcuti.data.php";
    $("#data-jadwalcuti").load(main);
    $(document).on("click", ".pagenya", function(e){
        e.preventDefault();
        $("#data-jadwalcuti").load(main + "?page=" + (this.id || 1));
    });
});
})(jQuery);
