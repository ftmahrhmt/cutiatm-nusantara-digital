document.addEventListener("DOMContentLoaded", function(){

    console.log("JS NYALA");

    var form = document.getElementById("form-pengajuancuti");
    var tombol = document.getElementById("form-pengajuancuti-submit");
    var selectCuti = document.getElementById("idcuti");
    var hiddenCuti = document.getElementById("hididecuti");
    var statusBox = document.querySelector(".statusMsg");

    console.log("TOMBOL:", tombol);

    function setHiddenCuti(){
        if (selectCuti && hiddenCuti) hiddenCuti.value = selectCuti.value;
    }

    setHiddenCuti();

    if (selectCuti) {
        selectCuti.addEventListener("change", setHiddenCuti);
    }

    if(tombol && form){
        tombol.addEventListener("click", function(){

            console.log("DIKLIK");

            setHiddenCuti();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            tombol.disabled = true;
            tombol.innerHTML = 'Loading...';

            fetch("pengajuancuti.input.php", {
                method:"POST",
                body:new FormData(form)
            })
            .then(res => res.text())
            .then(result => {
                console.log("RESULT:", result);

                if(result.trim() === "sukses"){
                    statusBox.innerHTML = "Berhasil!";
                } else {
                    statusBox.innerHTML = result;
                }
            })
            .catch(err => {
                console.log(err);
                statusBox.innerHTML = "Error koneksi";
            })
            .finally(() => {
    tombol.disabled = true;
    tombol.innerHTML = "✔ Pengajuan Terkirim";
    tombol.classList.remove("btn-primary");
    tombol.classList.add("btn-success");
});
        });
    } else {
        console.log("TOMBOL ATAU FORM GA KETEMU 💀");
    }

});