$(document).ready(function () {
    $("#profil_ferme_div").hide();
    let my_url = jQuery('meta[name="url"]').attr("content");
    var role = jQuery('meta[name="role"]').attr("content");

    $.ajax({
        type: "GET",
        url: my_url + "/ferme/roles",
        dataType: "json",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },

        success: function (resultat) {
            $("#entite_f").empty();

            $("#entite_f").append(
                "<option value=''>Choisissez un profil * </option>"
            );
            if (resultat.length != 0) {
                if (role == "ADMIN" || role == "FERME AGRICOLE") {
                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].pays)
                        // alert(resultat[i].role)
                        $("#entite_f").append(
                            "<option value='" +
                                resultat[i].id +
                                "'> " +
                                resultat[i].role +
                                " </option>"
                        );
                    }
                }
            } else {
                $(".entite_f").empty();
                $(".entite_f").append(
                    "<option value=''> Pas de profils pour cette ferme  </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur d.");
        },
    });
    //ferme agricole
    // alert()
    $("#entite").on("change", function () {
        var entite = $(this).val();
        var profil_ferme = "";
        // alert(entite);
        $.ajax({
            type: "GET",
            url: my_url + "/getentity/" + entite,
            dataType: "json",
            success: function (resultat) {
                $.each(resultat, function (i, val) {
                    // alert(val.nom_type_entite)
                    profil_ferme = val.nom_type_entite;
                });

                if (profil_ferme == "FERME AGRICOLE") {
                    $("#profil_ferme_div").show();
                } else {
                    $("#profil_ferme_div").hide();
                }
            },
        });
    });

    $("#formAddRolebtn").on("click", function () {
        $("#formAddRole").on("submit", function (e) {
            e.preventDefault();
            $("#formAddRole").validate({
                rules: {
                    nomRole: {
                        required: true,
                    },
                },
                //For custom messages
                messages: {
                    nomRole: {
                        required: "Veuillez saisir le rôle",
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
                    $("#load").append(
                        "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                    );
                    $.ajax({
                        url: "/ferme/create_role",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": jQuery(
                                'meta[name="csrf-token"]'
                            ).attr("content"),
                        },
                        data: $("#formAddRole").serialize(),
                        dataType: "JSON",
                        success: (res) => {
                            //   alert('Ok')
                            // alert(res.message)
                            $("#loadbar").remove();
                            $("#load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Role ajoute avec succes</p></div></div>"
                            );
                            location.reload();

                            // if(res.status == true){
                            //     alertdiv.append("<div class='col-md-12'><div class='alert alert-success alert-dismissible fade show mt-5' role='alert'><div class='row'><div class='d-inline col-md-6'><strong>"+res.message+"</strong></div><div class='col-md-6 d-inline-flex justify-content-end'><button type='button' class='btn-close close' data-dismiss='alert' aria-label='Close'></button></div></div></div></div>");
                            //     // alertdiv.attr({class : 'alert alert-secondary'});
                            //     location.reload();
                            //     window.close();
                            //    else{
                            //       alert('error1')
                            //    //  alertdiv.append("<div class='col-md-12'><div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'><div class='row'><div class='d-inline col-md-6'><strong>"+res.message+"</strong></div><div class='col-md-6 d-inline-flex justify-content-end'><button type='button' class='btn-close close' data-dismiss='alert' aria-label='Close'></button></div></div></div></div>");
                            // }
                        },
                        error: () => {
                            $("#loadbar").remove();
                            $("load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                            );
                        },
                    });
                },
            });
        });
    });

    // create tache
    $("#formAddTacheBtn").on("click", function (e) {
        e.preventDefault();
        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/tache/create",
            method: "post",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formAddtache").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout de la tache avec succes</p></div></div>"
                );
                location.reload();
            },
            error: () => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de la tache</p></div></div>"
                );
            },
        });
    });

    $("#formAddProdBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/produits/create",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formAddprod").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout du produit avec succes</p></div></div>"
                );

                if (role == "ADMIN") {
                    location.reload();
                } else {
                    window.location = "/ferme/production";
                }
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du produit</p></div></div>"
                );
            },
        });
    });
    $("#formAddFermeUserbtn").on("click", function () {
        $("#formAddFermeUser").on("submit", function (e) {
            e.preventDefault();
            $("#formAddFermeUser").validate({
                rules: {
                    prenom: {
                        required: true,
                    },
                    nom: {
                        required: true,
                    },
                    email: {
                        email: true,
                        // pattern: "*@*.*"
                    },

                    telephone: {
                        required: true,
                        //pattern: "^2217[5-8]{1}\d{7}$"
                    },
                    password: {
                        required: true,
                        minlength: 6,
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
                    $("#load").append(
                        "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                    );
                    $.ajax({
                        url: "/ferme/create_user",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": jQuery(
                                'meta[name="csrf-token"]'
                            ).attr("content"),
                        },
                        data: $("#formAddFermeUser").serialize(),
                        dataType: "JSON",
                        success: (res) => {
                            //   alert('Ok')
                            // alert(res.message)
                            $("#loadbar").remove();
                            $("#load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Utilisateur ajoute avec succes</p></div></div>"
                            );
                            location.reload();
                        },
                        error: () => {
                            $("#loadbar").remove();
                            $("load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                            );
                        },
                    });
                },
            });
        });
    });

    $("#edit-user-ferme").on("click", function () {
        var id = $("#editUserAccountForm").attr("data-id");
        // alert(id);
        $("#editUserAccountForm, #userEditInfotabForm").on(
            "submit",
            function (e) {
                e.preventDefault();
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
                            $(".load").append(
                                "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                            );
                            $.ajax({
                                url: "/ferme/edit_user" + id,
                                method: "GET",
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
                                    //  alert('Ok')
                                    //   alert(res.message)

                                    $("#loadbar").remove();
                                    $(".load").append(
                                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Utilisateur modifie avec succes</p></div></div>"
                                    );
                                    window.location =
                                        "/admin/profil/edit/" + id;
                                },
                                error: () => {
                                    $("#loadbar").remove();
                                    $("load").append(
                                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                                    );
                                },
                            });
                        },
                    });
                }
            }
        );
    });

    //ajout ferme by admin

    $("#formAddFermeBtn").on("click", function () {
        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );

        $("#formAddferme").submit();
        // $("#load").remove();

        $.ajax({
            success: (res) => {
                // alert(res)
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Ferme  ajouté avec succès",
                    timer: 2000,
                    buttons: false,
                });
                window.location = "/listeferme";
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                location.reload();
            },
        });
    });

    // ajout ferme par liste

    $("#formAddFermeListBtn").on("click", function () {
        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );

        $("#formAddfermeList").submit();
        $(".load").remove();

        $.ajax({
            success: (res) => {
                console.log(res);
                swal({
                    title: "Success",
                    icon: "success",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                window.location = "/listeferme";
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                location.reload();
            },
        });
        $("#load").remove();
    });

    //ajout user by admin on ferme

    $("#formAddFermeUserbtnA").on("click", function () {
        $("#formAddFermeUserA").on("submit", function (e) {
            e.preventDefault();
            $("#formAddFermeUserA").validate({
                rules: {
                    prenom: {
                        required: true,
                    },
                    nom: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        // pattern: "*@*.*"
                    },

                    telephone: {
                        required: true,
                        //pattern: "^2217[5-8]{1}\d{7}$"
                    },
                    password: {
                        required: true,
                        minlength: 6,
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
                    $("#load").append(
                        "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                    );
                    $.ajax({
                        url: "/ferme/create_user_by_admin",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": jQuery(
                                'meta[name="csrf-token"]'
                            ).attr("content"),
                        },
                        data: $("#formAddFermeUserA").serialize(),
                        dataType: "JSON",
                        success: (res) => {
                            //   alert('Ok')
                            // alert(res.message)
                            $("#loadbar").remove();
                            $("#load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Utilisateur ajoute avec succes</p></div></div>"
                            );
                            location.reload();
                        },
                        error: () => {
                            $("#loadbar").remove();
                            $("load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                            );
                        },
                    });
                },
            });
        });
    });

    $("#formAddEbBtn").on("click", function () {
        $("#formAddEb").on("submit", function (e) {
            e.preventDefault();
            $("#formAddEb").validate({
                rules: {
                    activite: {
                        required: true,
                    },
                    produit: {
                        required: true,
                    },
                    intitule: {
                        required: true,
                        minlength: 6,
                    },
                },
                //For custom messages
                messages: {
                    activite: {
                        required: "Veuillez choisir le type d'activite",
                    },
                    produit: {
                        required: "Veuillez choisir le produit",
                    },
                    intitule: {
                        required: "Veuillez saisir une description",
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
                    $("#load").append(
                        "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                    );
                    $.ajax({
                        url: "/ferme/eb/create_eb",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": jQuery(
                                'meta[name="csrf-token"]'
                            ).attr("content"),
                        },
                        data: $("#formAddEb").serialize(),
                        dataType: "JSON",
                        success: (res) => {
                            $("#loadbar").remove();
                            $("#load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout avec succes</p></div></div>"
                            );
                            location.reload();
                        },
                        error: () => {
                            $("#loadbar").remove();
                            $("load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout </p></div></div>"
                            );
                        },
                    });
                },
            });
        });
    });
    // add demande admin ferme
    $("#formAddDemandeBtn").on("click", function () {
        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#formAddDemande").submit();
        $(".load").remove();

        $.ajax({
            success: (res) => {
                // alert(res)
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Demande  ajouté avec succès",
                    timer: 2000,
                    buttons: false,
                });
                window.location = "/ferme/administration";
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de l'ajout",
                    timer: 2000,
                    buttons: false,
                });
                location.reload();
            },
        });
    });

    $("#venteBtn").click(() => {
        let qtite = parseInt($("#quantite").val());

        let file = $(".filename").val();

        let pv = parseInt($("#prix_vente").val());
        // alert(pv)
        let prix = qtite * pv;

        let quantite = parseInt($("#quantite").val());
        let qtite_stock = parseInt($("#qtite_stock").val());

        if (quantite > qtite_stock || quantite <= 0) {
            swal({
                title: "Erreur",
                icon: "error",
                text: "Quantite superieure au stock",
                timer: 2000,
                dangerMode: true,
                buttons: false,
            });
            location.reload();
        } else if (pv <= 1) {
            alert("Prix  invalide");
            location.reload();
        } else if (file == "") {
            swal({
                title: "Erreur",
                icon: "error",
                text: "Fichier non-joint",
                timer: 2000,
                dangerMode: true,
                buttons: false,
            });
            // window.location="/ferme/finance/caisse"
        } else {
            swal({
                title: "Payement",
                text: "Montant à payer: " + prix + " FCFA",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    delete: "Oui",
                    cancel: "Annuler",
                },
            }).then(function (willDelete) {
                if (willDelete) {
                    $("#formAddVente").submit();
                    $.ajax({
                        success: (res) => {
                            // alert(res)
                            swal({
                                title: "Success",
                                icon: "success",
                                text: "Vente ajoutée avec succès",
                                timer: 2000,
                                buttons: false,
                            });
                            window.location = "/ferme/finance/vente";
                        },
                        error: () => {
                            swal({
                                title: "Erreur",
                                icon: "error",
                                text: res.message,
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                    });
                } else {
                }
            });
        }
    });

    $(".ebBtn").on("click", function () {
        // alert()
        // e.preventDefault();
        // $("#load").append(
        //     "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        // );

        $("#ebForm").submit();

        $.ajax({
            success: (res) => {
                // alert(res)
                swal({
                    title: "Success",
                    icon: "success",
                    text: "expression de besoin ajouté avec succès",
                    timer: 2000,
                    buttons: false,
                });
                window.location = "/ferme/eb";
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                location.reload();
            },
        });
    });

    $(".caisseBtn").on("click", function () {
        let montant = parseInt($("#montant").val());
        let file = $(".filename").val();

        if (montant > 1 && file != "") {
            $("#caisseForm").submit();

            $.ajax({
                success: (res) => {
                    // alert(res)
                    swal({
                        title: "Success",
                        icon: "success",
                        text: "Montant ajouté avec succès",
                        timer: 2000,
                        buttons: false,
                    });
                    window.location = "/ferme/finance/caisse";
                },
                error: () => {
                    swal({
                        title: "Erreur",
                        icon: "error",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                    location.reload();
                },
            });
        } else {
            swal({
                title: "Erreur",
                icon: "error",
                text: "Montant invalide ou fichier non-joint",
                timer: 2000,
                dangerMode: true,
                buttons: false,
            });
            // window.location="/ferme/finance/caisse"
        }
    });

    $(".banqueBtn").on("click", function () {
        let montant = parseInt($("#montant").val());
        let file = $(".filename").val();

        if (montant > 1 && file != "") {
            $("#banqueForm").submit();

            $.ajax({
                success: (res) => {
                    // alert(res)
                    swal({
                        title: "Success",
                        icon: "success",
                        text: "Montant debité avec succès",
                        timer: 2000,
                        buttons: false,
                    });
                    window.location = "/ferme/finance/banque";
                },
                error: () => {
                    swal({
                        title: "Erreur",
                        icon: "error",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                    location.reload();
                },
            });
        } else {
            swal({
                title: "Erreur",
                icon: "error",
                text: "Montant invalide ou fichier non-joint",
                timer: 2000,
                dangerMode: true,
                buttons: false,
            });
            // window.location="/ferme/finance/caisse"
        }
    });

    $("#decBtn").on("click", function () {
        let solde = parseInt($("#solde").val());
        let montant = parseInt($("#montant").val());
        if (montant <= solde) {
            $("#decForm").submit();
            $.ajax({
                success: (res) => {
                    // alert(res)
                    swal({
                        title: "Success",
                        icon: "success",
                        text: "Decaissement effectué avec succès",
                        timer: 2000,
                        buttons: false,
                    });
                    window.location = "/ferme/finance/decaissement";
                },
                error: () => {
                    swal({
                        title: "Erreur",
                        icon: "error",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                    location.reload();
                },
            });
        } else {
            swal({
                title: "Erreur",
                icon: "error",
                text: "Montant superieur à la caisse",
                timer: 2000,
                dangerMode: true,
                buttons: false,
            });
            // window.location="/ferme/finance/caisse"
        }
    });

    $("#stockBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/stock/create",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formAddStock").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout du stock avec succes</p></div></div>"
                );
                if (role == "ADMIN") {
                    location.reload();
                } else {
                    window.location = "/ferme/stock";
                }
            },
            error: () => {
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du stock</p></div></div>"
                );
            },
        });
    });

    $(".stock-edit").on("click", function () {
        swal({
            title: "Modification",
            text: "Voulez-vous modifier le stock",
            icon: "warning",
            dangerMode: true,
            buttons: {
                delete: "Oui",
                cancel: "Annuler",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#formEditStock").submit();
                $.ajax({
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });

                        if (role == "ADMIN") {
                            window.location = "/listeferme";
                        } else {
                            window.location = "/ferme/stock";
                        }
                        //
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Stock modifié avec succès",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
            }
        });
    });
    /*
     * DataTables - Tables
     */

    /* Ajout de reseau **/

    $("#btn-reseau-create").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer le réseau",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/parametrage/reseau-create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-reseau-create").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la modification de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    /* Ajout de gerant **/

    $("#btn-gerant-create").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer le gérant",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/parametrage/gerant-create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-gerant-create").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la modification de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    /* Ajout de gerant par liste **/

    $("#new-gerant-list").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer le réseau",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                let formData = new FormData($("#form-create-gerant-list")[0]);
                $.ajax({
                    url: "/information-climatique/parametrage/gerant-list-create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    // cache: false,
                    processData: false,
                    success: (res) => {
                        // alert(res)
                        if (res.status === "Ok") {
                            swal({
                                title: "Success",
                                icon: "success",
                                text: res.message,
                                timer: 3000,
                                buttons: false,
                            });
                        } else {
                            swal({
                                title: "Erreur",
                                icon: "error",
                                text: res.message,
                                timer: 3000,
                                buttons: false,
                            });
                        }

                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la modification de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    /* Ajout de pluvio **/

    $("#btn-pluvio-create").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer le pluvio",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/parametrage/pluvio/create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-pluvio-create").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la modification de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    /* Ajout de transversal **/

    $("#btn-create-transversal").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer le producteur en tant que transversal",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/parametrage/transversal/create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-create-transversal").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    /* Ajout de transversal par liste **/
    $("#new-transversal-list").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les tranverseaux",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                let formData = new FormData(
                    $("#form-create-transversal-list")[0]
                );
                $.ajax({
                    url: "/information-climatique/parametrage/transversal-list-create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    // cache: false,
                    processData: false,
                    success: (res) => {
                        // alert(res)
                        if (res.status === "Ok") {
                            swal({
                                title: "Success",
                                icon: "success",
                                text: res.message,
                                timer: 3000,
                                buttons: false,
                            });
                        } else {
                            swal({
                                title: "Erreur",
                                icon: "error",
                                text: res.message,
                                timer: 3000,
                                buttons: false,
                            });
                        }

                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la modification de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    /* Ajout de collecte **/

    $("#btn-create-collecte").click(function (e) {
        e.preventDefault();
        collecte_data = new FormData($("#form-create-collecte")[0]);
        phenom = $(`.pheno[value=${collecte_data.get("phenomene")}]`);

        swal({
            title: "Etes-vous sure",
            text: `Quantité: ${collecte_data.get(
                "qte"
            )} ; Date: ${collecte_data.get("date")} ; Phénomène: ${
                phenom[0].innerText
            }`,
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/collecte/create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-create-collecte").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.res,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-create-localite-prevision-sms").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/prevision/localite",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-create-prevision-localite-sms").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.messsage,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    /* Envoi de prevision sms par zone **/

    $("#btn-create-zone-prevision-sms").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/prevision/zone",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-create-prevision-zone-sms").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.messsage,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-create-producteur").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations de collecte",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/producteurs/create",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-producteurs-create").serialize(),
                    dataType: "JSON",
                    processData: true,

                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    /* Ajout de producteur **/

    $("#new-producteur-list").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#form-producteur-list")
                    .append(` <div id="pld" class="row mt-2">
                <div class="col s12 m6 l12">
                    <div class="preloader-wrapper small active right">
                        <div class="spinner-layer spinner-white-only">
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                        </div>

                        </div>
                    </div>
                </div>

            </div>`);
                $.ajax({
                    url: "/producteurs/create-list",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: new FormData($("#form-producteur-list")[0]),
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        $("#pld").remove();
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.res,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    /* Ajout de producteur par liste **/

    $("#new-producteur-list-prix").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/producteurs/create-list/prix",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: new FormData($("#form-producteur-list-prix")[0]),
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text:
                                res.message +
                                ": " +
                                res.nl +
                                " trouvées; " +
                                res.li +
                                " inserées",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    /* Ajout de terre **/

    $("#btn-terre-declaration").click(function (e) {
        e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                var options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0,
                };

                function error(err) {
                    console.warn(`ERREUR (${err.code}): ${err.message}`);
                }

                function success(pos) {
                    var crd = pos.coords;
                    lat = crd.latitude;
                    lon = crd.longitude;
                    var terr_form = new FormData(
                        $("#form-terre-declaration")[0]
                    );
                    terr_form.append("lat", lat);
                    terr_form.append("lon", lon);
                    // console.log(terr_form.forEach((value)=>{
                    //     console.log(value)
                    // }))
                    $.ajax({
                        url: "/terre/create",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": jQuery(
                                'meta[name="csrf-token"]'
                            ).attr("content"),
                        },
                        data: terr_form,
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        success: (res) => {
                            // alert(res.data)
                            swal({
                                title: "Success",
                                icon: "success",
                                text: res.message,
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                        error: () => {
                            swal({
                                title: "Erreur",
                                icon: "error",
                                text: res.message,
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                    });
                }
                navigator.geolocation.getCurrentPosition(
                    success,
                    error,
                    options
                );
            } else {
                location.reload();
            }
        });
    });
});
