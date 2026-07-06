var cssId = 'myCss';
if (!document.getElementById(cssId)){
    var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');
    link.id   = cssId;
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = '../css/style.css';
    link.media = 'all';
    head.appendChild(link);
}

(function($){

$(document).ready(function(){

    var main = "gantipassword.data.php";
    var maincari = "gantipassword.datacari.php";

    $("#data-gantipassword").load(main);
    $("#caridata-gantipassword").load(maincari);

    // =========================
    // SIMPAN PASSWORD (FIXED)
    // =========================
    $("#simpan-gantipassword").click(function(){

    let tombol = this;

    var url = "gantipassword.input.php";

    var v_passwordlama = $('input[name=passwordlama]').val();
    var v_passwordbaru = $('input[name=passwordbaru]').val();
    var v_konfirmasi   = $('input[name=konfirmasipassword]').val();

    if(v_passwordlama == '' || v_passwordbaru == '' || v_konfirmasi == ''){
        alert("Semua field wajib diisi!");
        return;
    }

    if(v_passwordbaru !== v_konfirmasi){
        alert("Password tidak sama!");
        return;
    }

    tombol.disabled = true;
    tombol.innerHTML = "Menyimpan...";

    $.post(url, {
        passwordlama: v_passwordlama,
        passwordbaru: v_passwordbaru,
        konfirmasipassword: v_konfirmasi
    }, function(response){

        if(response.trim() === "sukses"){

            // ✅ NOTIF BESAR
            alert("✅ Password berhasil diubah!");

            // ✅ TEXT DI HALAMAN
            $('.statusMsg').html(
                '<div style="color:green; font-weight:bold;">✔ Password berhasil diubah</div>'
            );

            // ✅ TOMBOL BERUBAH
            tombol.innerHTML = "✔ Tersimpan";
            tombol.classList.remove("btn-primary");
            tombol.classList.add("btn-success");

        } else {

            alert("❌ Gagal: " + response);

            tombol.disabled = false;
            tombol.innerHTML = "Simpan";
        }

    });

});
    // =========================
    // PAGINATION
    // =========================
    $(document).on("click", ".pagenya", function(){
        var pagenya = this.id;
        var main = "gantipassword.data.php?pagination=true&page=" + pagenya;
        $("#data-gantipassword").load(main);
    });

    // =========================
    // SEARCH
    // =========================
    $("#btn-search").click(function(){

        $(this).text("SEARCHING...").attr("disabled", true);

        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: {keyword: $("#keyword").val()},
            dataType: "json",
            success: function(response){
                $("#btn-search").text("SEARCH").removeAttr("disabled");
                $("#view").html(response.hasil);
            },
            error: function (xhr){
                alert(xhr.responseText);
            }
        });

    });

});

})(jQuery);