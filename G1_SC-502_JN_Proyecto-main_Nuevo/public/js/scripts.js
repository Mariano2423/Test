$(document).ready(function () {


    $("#show-register").click(function () {
        $("#register-modal").modal("show");
    });

    $("#modify-form").submit(function (event) {
        event.preventDefault();
        alert("Información actualizada correctamente.");
        $("#modifyModal").modal("hide");
    });
    
});

document.getElementById("btn-mostrar").addEventListener("click", function() {
    document.querySelectorAll(".extra-curso").forEach(el => el.classList.remove("d-none"));
    this.style.display = "none";
});


