$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    let role = jQuery('meta[name="role"]').attr("content");
    let today = new Date();
    let day = today.getDate();
    let months = today.getMonth();
    let year = today.getFullYear();
    let yearFixed = year - 15;
    // alert(yearFixed);

    $("#icon_prefix4").datepicker({
        maxDate: new Date(yearFixed, months, day),
    });
    // $("#dt_naiss").datepicker("setDate", new Date(yearFixed, months, day));

    // alert(role);

    var id = $("#editUserAccountForm").attr("data-id");

    var location = "/admin/utilisateurs/edit/" + id;
    if (role == "ONG") {
        location = "/ong/utilisateurs/edit/" + id;
    }
    $("#editUserAccountForm, #userEditInfotabForm").on("submit", function (e) {
        e.preventDefault();

        // data = $(".user-edit").serialize();
        // console.log(data);
        // alert(data);

        if ($(".users-edit").length > 0) {
            $("#editUserAccountForm, #userEditInfotabForm").validate({
                rules: {
                    login: {
                        required: true,
                        // minlength:
                    },
                    prenom: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    dt_naiss: {
                        required: true,
                    },
                    // localite: {
                    //     required: true
                    // }
                },
                errorElement: "div",
            });
            $("#userEditInfotabForm").validate({
                rules: {
                    dt_naiss: {
                        required: true,
                    },
                    localite: {
                        required: true,
                    },
                },
                errorElement: "div",
                submitHandler: function () {
                    // e.preventDefault();
                    // $(".load").append("<div class='progress' id='loadbar'><div class='indeterminate'></div></div>");
                    swal({
                        title: "Etes-vous sure",
                        text: "Voulez-vous enregistrer les informations de l'utilisateur",
                        icon: "warning",
                        dangerMode: true,
                        buttons: {
                            cancel: "Annuler",
                            delete: "Oui",
                        },
                    }).then(function (willDelete) {
                        if (willDelete) {
                            if (
                                $("#pluvio").val() &&
                                $("#pluvio").val() != "null"
                            ) {
                                // pluvio != null
                                // alert("update pluvio");
                                $.ajax({
                                    url: my_url + "/register/gerant",
                                    method: "POST",
                                    headers: {
                                        Authorization:
                                            "Bearer " +
                                            jQuery('meta[name="token"]').attr(
                                                "content"
                                            ),
                                    },
                                    data: $(".user-edit").serialize(),
                                    dataType: "JSON",
                                    success: (res) => {
                                        swal({
                                            title: "Success",
                                            icon: "success",
                                            text: res.message,
                                            timer: 2000,
                                            buttons: false,
                                        });
                                        window.location = location;
                                    },
                                    error: (res) => {
                                        swal({
                                            title: "Erreur",
                                            icon: "error",
                                            text: res.message,
                                            timer: 2000,
                                            buttons: false,
                                        });
                                    },
                                });
                            } else {
                                // alert("update user");

                                $.ajax({
                                    url: my_url + "/edituser/" + id,
                                    method: "PUT",
                                    headers: {
                                        Authorization:
                                            "Bearer " +
                                            jQuery('meta[name="token"]').attr(
                                                "content"
                                            ),
                                    },
                                    data: $(".user-edit").serialize(),
                                    dataType: "JSON",
                                    success: (res) => {
                                        swal({
                                            title: "Success",
                                            icon: "success",
                                            text: res.message,
                                            timer: 2000,
                                            buttons: false,
                                        });
                                        window.location = location;
                                    },
                                    error: (res) => {
                                        swal({
                                            title: "Erreur",
                                            icon: "error",
                                            text: res.message,
                                            timer: 2000,
                                            buttons: false,
                                        });
                                    },
                                });
                            }
                        } else {
                            location.reload();
                        }
                    });
                },
            });
        }
    });

    $(".formmessage").hide();

    // update FIA
    $("#formModDistributionBtn").click(function (e) {
        e.preventDefault();
        $("#ajaxloader").show();

        let formData = new FormData($("#formModDistribution")[0]);
        // console.log(formData);
        // $("#formModDistribution").submit();

        $.ajax({

            url: "/distributions/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: formData,
            contentType: false,
            // cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                $("#ajaxloader").hide();
                console.log(response);
                swal({
                    title: "Success",
                    icon: "success",
                    text: response,
                    timer: 5000,
                    buttons: false,
                });
                window.location.href = "/distributions";
            },
            error: function (e) {
                $("#ajaxloader").hide();
                console.log(e);
                swal({
                    title: "Warning",
                    icon: "warning",
                    text: e.responseText,
                    timer: 500000000,
                    buttons: false,
                });
            },
        });

        // swal({
        //     title: "Etes-vous sure",
        //     text: "Voulez-vous valider la reception de cet intrant",
        //     icon: "warning",
        //     dangerMode: true,
        //     buttons: {
        //         cancel: "Annuler",
        //         delete: "Oui",
        //     },
        // }).then(function (willDelete) {
        //     if (willDelete) {
        //         $("#ajaxloader").show();
        //         let formData = new FormData($("#formModDistribution")[0]);
        //         $.ajax({
        //             url: "/distributions/update",
        //             method: "POST",
        //             headers: {
        //                 "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
        //                     "content"
        //                 ),
        //             },
        //             data: formData,
        //             contentType: false,
        //             // cache: false,
        //             processData: false,
        //             dataType: "JSON",
        //             success: function (response) {
        //                 $("#ajaxloader").hide();
        //                 swal({
        //                     title: "Success",
        //                     icon: "success",
        //                     text: response,
        //                     timer: 5000,
        //                     buttons: false,
        //                 });
        //                 window.location.href = "/distributions";
        //             },
        //             error: function (e) {
        //                 $("#ajaxloader").hide();
        //                 console.log(e);
        //                 swal({
        //                     title: "Warning",
        //                     icon: "warning",
        //                     text: e.responseText,
        //                     timer: 5000,
        //                     buttons: false,
        //                 });
        //             },
        //         });
        //     } else {
        //     }
        // });
    });
});
