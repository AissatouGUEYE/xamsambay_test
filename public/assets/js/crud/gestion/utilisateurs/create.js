$(document).ready(() => {
    let my_url = jQuery('meta[name="url"]').attr("content");
    let role = jQuery('meta[name="role"]').attr("content");
    let today = new Date();
    let day = today.getDate();
    let months = today.getMonth();
    let year = today.getFullYear();
    let yearFixed = year - 15;
    // alert(day);
    $("#dt_naiss").datepicker({
        maxDate: new Date(yearFixed, months, day),
        changeYear: true,
    });
    $("#dt_naiss").datepicker("setDate", new Date(yearFixed - 10, months, day));
    // $("#dt_naiss").datepicker($.datepicker.regional["fr"]);
    // $("#dt_naiss").datepicker({
    //     altField: "#dt_naiss",
    //     closeText: "Fermer",
    //     prevText: "Précédent",
    //     nextText: "Suivant",
    //     currentText: "Aujourd'hui",
    //     monthNames: [
    //         "Janvier",
    //         "Février",
    //         "Mars",
    //         "Avril",
    //         "Mai",
    //         "Juin",
    //         "Juillet",
    //         "Août",
    //         "Septembre",
    //         "Octobre",
    //         "Novembre",
    //         "Décembre",
    //     ],
    //     monthNamesShort: [
    //         "Janv.",
    //         "Févr.",
    //         "Mars",
    //         "Avril",
    //         "Mai",
    //         "Juin",
    //         "Juil.",
    //         "Août",
    //         "Sept.",
    //         "Oct.",
    //         "Nov.",
    //         "Déc.",
    //     ],
    //     dayNames: [
    //         "Dimanche",
    //         "Lundi",
    //         "Mardi",
    //         "Mercredi",
    //         "Jeudi",
    //         "Vendredi",
    //         "Samedi",
    //     ],
    //     dayNamesShort: ["Dim.", "Lun.", "Mar.", "Mer.", "Jeu.", "Ven.", "Sam."],
    //     dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
    //     weekHeader: "Sem.",
    //     dateFormat: "yy-mm-dd",
    // });
    $("#formAddUserbtn").on("click", function () {
        let urlReplace = $("#urlRootReplace").val();
        // alert(urlReplace);
        $("#formAddUser").on("submit", function (e) {
            e.preventDefault();
            // data = $("#formAddUser").serialize();
            $("#formAddUser").validate({
                rules: {
                    prenom: {
                        required: true,
                    },
                    nom: {
                        required: true,
                    },
                    dt_naiss: {
                        required: true,
                    },
                    sit_matrimonial_id: {
                        required: false,
                        // url: true
                    },
                    telephone: {
                        required: true,
                        //pattern: "^2217[5-8]{1}\d{7}$"
                    },

                    email: {
                        required: true,
                        email: true,
                        // pattern: "*@*.*"
                    },

                    password: {
                        required: true,
                        minlength: 8,
                    },
                    cmdp: {
                        required: true,
                        equalTo: "#password",
                    },
                },
                //For custom messages
                messages: {
                    prenom: {
                        required: "Veuillez saisir votre prenom",
                    },
                    nom: {
                        required: "Veuillez saisir votre nom",
                    },
                    email: {
                        required: "Veuillez saisir votre nom",
                        maxlength: "Veuillez saisir un e-mail valide",
                    },
                    password: {
                        required: "Veuillez saisir votre mot de passe",
                        maxlength:
                            "Veuillez saisir un mot de passe >= 8 caracteres",
                    },
                    cmdp: {
                        required: "Confirmer le mot de passe",
                        equalTo: "Veuillez saisir le meme mot de passe",
                    },
                    localite: {
                        required: "Choississez une localité",
                    },
                },
                errorElement: "div",
                errorPlacement: function (error, element) {
                    var placement = $(element).data("error");
                    if (placement) {
                        $(placement).append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function () {
                    e.preventDefault();
                    // $("#load").append("<div class='progress' id='loadbar'><div class='indeterminate'></div></div>");
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
                            if ($("#entite_f").val() != "") {
                                create_url = "/ferme/create_user_by_admin";
                            } else {
                                create_url = my_url + "/register";
                                // console.log(typeof $("#pluvio").val());
                                if (
                                    $("#pluvio").val() &&
                                    $("#pluvio").val() != "null"
                                ) {
                                    create_url = my_url + "/register/gerant";
                                }
                            }
                            // alert(create_url);
                            $.ajax({
                                url: create_url,
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": jQuery(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                data: $("#formAddUser").serialize(),
                                dataType: "JSON",
                                success: (res) => {
                                    swal({
                                        title: "Success",
                                        icon: "success",
                                        text: "Utilisateur créé avec succés",
                                        timer: 2000,
                                        buttons: false,
                                    });
                                    location.replace(urlReplace);
                                },
                                error: () => {
                                    swal({
                                        title: "Erreur",
                                        icon: "error",
                                        text: "Erreur lors de la création de l'utilisateur",
                                        timer: 2000,
                                        buttons: false,
                                    });
                                },
                            });
                        } else {
                            location.reload();
                        }
                    });
                },
            });
        });
    });

    $(".formmessage").hide();

    // create FIA
    $("#formAddFia").submit(function (e) {
        e.preventDefault();
        $("#ajaxloader").show();
        let formData = new FormData($("#formAddFia")[0]);
        $.ajax({
            url: "/entite/fia/store",
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
                swal({
                    title: "Success",
                    icon: "success",
                    text: response,
                    timer: 5000,
                    buttons: false,
                });
                location.reload();
            },
            error: function (e) {
                $("#ajaxloader").hide();
                swal({
                    title: "Warning",
                    icon: "warning",
                    text: e.responseText,
                    timer: 5000,
                    buttons: false,
                });
            },
        });
    });

    // create cc
    $("#formAddCc").submit(function (e) {
        e.preventDefault();
        $("#ajaxloader").show();
        let formData = new FormData($("#formAddCc")[0]);
        $.ajax({
            url: "/entite/cc/store",
            method: "POST",
            data: formData,
            contentType: false,
            // cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                $("#ajaxloader").hide();
                // alert()

                swal({
                    title: "Success",
                    icon: "success",
                    text: response,
                    timer: 5000,
                    buttons: false,
                });
                location.reload();
                // window.location.href = '{{ route("get.cc") }}';

                // $(".formmessage")
                //     .html(response)
                //     .show()
                //     .delay(20000)
                //     .fadeOut("slow");
            },
            error: function (e) {
                $("#ajaxloader").hide();

                swal({
                    title: "Warning",
                    icon: "warning",
                    text: e.responseText,
                    timer: 5000,
                    buttons: false,
                });
            },
        });
    });

    // add membre on CC
    // $("#formAddMembre").submit(function (e) {
    //     e.preventDefault();
    //     $("#ajaxloader").show();
    //     let formData = new FormData($("#formAddMembre")[0]);
    //     $.ajax({
    //         url: "/entite/cc/membre/store",
    //         method: "POST",
    //         headers: {
    //             "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
    //                 "content"
    //             ),
    //         },
    //         data: formData,
    //         contentType: false,
    //         // cache: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function (response) {
    //             $("#ajaxloader").hide();
    //             swal({
    //                 title: "Success",
    //                 icon: "success",
    //                 text: response,
    //                 timer: 5000,
    //                 buttons: false,
    //             });
    //             location.reload();
    //         },
    //         error: function (e) {
    //             $("#ajaxloader").hide();
    //             swal({
    //                 title: "Warning",
    //                 icon: "warning",
    //                 text: e.responseText,
    //                 timer: 5000,
    //                 buttons: false,
    //             });
    //         },
    //     });
    // });
    // create rattachment

    // $("#formAddRattachement").submit(function (e) {
    //     e.preventDefault();
    //     $("#ajaxloader").show();
    //     let formData = new FormData($("#formAddRattachement")[0]);
    //     $.ajax({
    //         url: "/entite/fia/rattachement/store",
    //         method: "POST",
    //         headers: {
    //             "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
    //                 "content"
    //             ),
    //         },
    //         data: formData,
    //         contentType: false,
    //         // cache: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function (response) {
    //             $("#ajaxloader").hide();
    //             swal({
    //                 title: "Success",
    //                 icon: "success",
    //                 text: response,
    //                 timer: 5000,
    //                 buttons: false,
    //             });
    //             location.reload();
    //         },
    //         error: function (e) {
    //             $("#ajaxloader").hide();
    //             swal({
    //                 title: "Warning",
    //                 icon: "warning",
    //                 text: e.responseText,
    //                 timer: 5000,
    //                 buttons: false,
    //             });
    //         },
    //     });
    // });

    // $("#formAddRattachementIntrant").submit(function (e) {
    //     e.preventDefault();
    //     $("#ajaxloader").show();
    //     let formData = new FormData($("#formAddRattachementIntrant")[0]);
    //     $.ajax({
    //         url: "/entite/fia/rattachement_intrants/store",
    //         method: "POST",
    //         headers: {
    //             "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
    //                 "content"
    //             ),
    //         },
    //         data: formData,
    //         contentType: false,
    //         // cache: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function (response) {
    //             $("#ajaxloader").hide();
    //         },
    //         error: function (e) {
    //             $("#ajaxloader").hide();
    //         },
    //     });
    // });
});
