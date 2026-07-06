(function($) {
$(document).ready(function() {
    var main = "sisacuti.data.php";
    $("#data-sisacuti").load(main);
    $(document).on("click", ".pagenya", function(e){
        e.preventDefault();
        $("#data-sisacuti").load(main + "?page=" + (this.id || 1));
    });
});
})(jQuery);
