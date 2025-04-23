$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault();
        $("#login-container").hide();
        $("#main-content").show();
    });

    $("#show-register").click(function () {
        $("#register-modal").modal("show");
    });

    $("#modify-form").submit(function (event) {
        event.preventDefault();
        alert("Información actualizada correctamente.");
        $("#modifyModal").modal("hide");
    });
});

