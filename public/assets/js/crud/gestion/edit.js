// const { values } = require("lodash");

$(document).ready(function () {
    role = jQuery('meta[name="role"]').attr("content");
    let my_url = jQuery('meta[name="url"]').attr("content");
    //ferme agricole

    $("#formModProdBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/produits/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModprod").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                alert(res.message);
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>produit modifie avec succes</p></div></div>"
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
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification du produit</p></div></div>"
                );
            },
        });
    });

    // modif tache
    $("#formModTacheBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/tache/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModtache").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Tâche modifiee avec succes</p></div></div>"
                );
                window.location = "/ferme/tache";

               
            },
            error: () => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de la tâche</p></div></div>"
                );
            },
        });
    });

    // modif demande
    $("#formModDemandeBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/demande/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModDemande").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Demande modifiee avec succes</p></div></div>"
                );
                window.location = "/ferme/administration";

               
            },
            error: () => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de la demande</p></div></div>"
                );
            },
        });
    });

    // comment demande
    $("#formCommentDemandeBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/administration/demande/comment",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formCommentDemande").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Commmentaire ajoute avec succes</p></div></div>"
                );
                window.location = "/ferme/administration";

               
            },
            error: () => {
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du commentaire'</p></div></div>"
                );
            },
        });
    });

    $("#formModFermeBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/listeferme/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModFerme").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
              
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ferme modifié avec succes</p></div></div>"
                );

                window.location = "/listeferme";
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de la ferme</p></div></div>"
                );
            },
        });
    });

    $("#formModEbBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/eb/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModeb").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Besoin modifie avec succes</p></div></div>"
                );
                // location.reload();
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de l'expression de besoin </p></div></div>"
                );
            },
        });
    });

    $("#formModEbCommentPBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/eb/updateP",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModeb").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>commentairte  ajoute avec succes</p></div></div>"
                );
                // location.reload();
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de l'eb </p></div></div>"
                );
            },
        });
    });

    $("#formModEbCommentMBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/eb/updateM",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModeb").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>commentaire  ajoute avec succes</p></div></div>"
                );
                // location.reload();
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de l'eb </p></div></div>"
                );
            },
        });
    });

    $("#formModActiviteBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/activite/update",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModprod").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>activite modifie avec succes</p></div></div>"
                );
                window.location = "/ferme/activite";
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de l'activite</p></div></div>"
                );
            },
        });
    });

    //edit by admin

    $("#formModActiviteByAdminBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/activite/update_by_admin",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#formModprod").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $("#load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>activite modifie avec succes</p></div></div>"
                );
                // window.location = "/listeferme";
                location.reload();
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification de l'activite</p></div></div>"
                );
            },
        });
    });

    $(".edit-reseau").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        $.ajax({
            url: "/information-climatique/parametrage/reseau-edit/" + id,
            method: "GET",
            headers: {
                // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            // data: $('#form-campagne-update').serialize(),
            // dataType:'JSON',
            success: (res) => {
                // $("#mod").modal('show');
                $("#code").empty();
                $("#intitule").empty();
                $("#etat").empty();
                $("label").attr({ class: "active" });
                $("#code").attr("value", res.code);
                $("#intitule").attr("value", res.nom);
                $("#btn-update-reseau").attr("data-id", res.id);
                if (res.actif == 1) {
                    $("#actif").attr({ value: 1, selected: true });
                } else {
                    $("#inactif").attr({ value: 0, selected: true });
                }

                // alert(res.code)
                // swal({
                //     title: 'Success',
                //     icon: 'success',
                //     text: res.message,
                //     timer: 2000,
                //     buttons: false
                // });
                // location.reload()
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                // location.reload()
            },
        });
    });
    $(".edit-campagne").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        $.ajax({
            url: "/information-climatique/campagne/edit/" + id,
            method: "GET",
            headers: {
                // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            // data: $('#form-campagne-update').serialize(),
            // dataType:'JSON',
            success: (res) => {
                // $("#camapagne-edit").modal('show');
                $("#debut").empty();
                $("#fin").empty();
                // $('#etat').empty();
                $("label").attr({ class: "active" });
                $("#debut").attr({ value: res.debut });
                $("#fin").attr("value", res.fin);
                $("#btn-update-campagne").attr("data-id", res.id);
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
                // location.reload()
            },
        });
    });

    $(".edit-gerant").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        $.ajax({
            url: "/information-climatique/parametrage/gerant/edit/" + id,
            method: "GET",
            headers: {
                // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: (res) => {
                $("label").attr({ class: "active" });
                $("#profil-gerant").append(
                    "<option  selected value='" +
                        res.id_profil +
                        "'>" +
                        res.prenom +
                        " " +
                        res.nom +
                        "</option>"
                );
                $("#gerant-reseau").append(
                    "<option selected value='" +
                        res.id_reseau +
                        "'>" +
                        res.nom_reseau +
                        "</option>"
                );
                $(".localite").append(
                    "<option selected value='" +
                        res.id_localite +
                        "'>" +
                        res.localite +
                        "</option>"
                );

                $("#btn-gerant-update").attr("data-id", res.id);
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
            },
        });
    });

    $(".edit-pluvio").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: "/information-climatique/parametrage/pluvio/edit/" + id,
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: (res) => {
                $("label").attr({ class: "active" });
                $("#region-pluvio").append(
                    "<option  selected value='" +
                        res.id_region +
                        "'>" +
                        res.region +
                        "</option>"
                );

                $("#dept-pluvio").append(
                    "<option  selected value='" +
                        res.id_departement +
                        "'>" +
                        res.departement +
                        "</option>"
                );
                $("#commune-pluvio").append(
                    "<option  selected value='" +
                        res.id_commune +
                        "'>" +
                        res.commune +
                        "</option>"
                );
                $("#gerant-profil").append(
                    "<option  selected value='" +
                        res.id_profil +
                        "'>" +
                        res.prenom +
                        " " +
                        res.nom +
                        "</option>"
                );
                $(".localite").append(
                    "<option selected value='" +
                        res.id_localite +
                        "'>" +
                        res.localite +
                        "</option>"
                );
                $("#reseau-pluvio").append(
                    "<option selected value='" +
                        res.id_groupement +
                        "'>" +
                        res.libelle +
                        "</option>"
                );

                $(".latitude").attr("value", res.latitude);
                $(".longitude").attr("value", res.longitude);
                $("#btn-pluvio-update").attr("data-id", res.id);
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
            },
        });
    });

    $(".edit-transversal").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        $.ajax({
            url: "/information-climatique/parametrage/transversal/edit/" + id,
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: (res) => {
                $("label").attr({ class: "active" });
                $("#transversal-profil").append(
                    "<option  selected value='" +
                        res.id_profil +
                        "'>" +
                        res.prenom +
                        " " +
                        res.nom +
                        "</option>"
                );
                $("#transversal-pluvio").append(
                    "<option selected value='" +
                        res.pluvio +
                        "'>" +
                        res.localite +
                        "</option>"
                );
                $("#btn-update-transversal").attr("data-id", res.id);
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: res.message,
                    timer: 2000,
                    buttons: false,
                });
            },
        });
    });
    $(".edit-collecte").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: "/information-climatique/collecte/edit/" + id,
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            success: (res) => {
                $("label").attr({ class: "active" });
                $("#transversal-profil").append(
                    "<option  selected value='" +
                        res.id_profil +
                        "'>" +
                        res.prenom +
                        " " +
                        res.nom +
                        "</option>"
                );
                $("#transversal-pluvio").append(
                    "<option selected value='" +
                        res.pluvio +
                        "'>" +
                        res.localite +
                        "</option>"
                );
                $("#btn-update-transversal").attr("data-id", res.id);
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
    $(".edit-eb").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        let url = $("#root").val();
        urlShow = url + "/show/" + id;
        $.ajax({
            url: urlShow,
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },

            success: (res) => {
                alert(res);
                $("#produit").html(res.produit);

                $("#description").html(res.description);
                $("#date").html(res.date);
                $("#date_modif").html(res.date_modif);
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

    $("#formAddActiviteBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        if (role == "ADMIN") {
            var url = new URL(window.location.href);
            var ferme = url.pathname.split("/")[3];
            ferme = parseInt(ferme);
            var activite = $(".activites").val();
            var create_form = new FormData();
            create_form.append("libelle", activite);
            create_form.append("ferme", ferme);

            $.ajax({
                type: "POST",
                url: "/ferme/activite/create",

                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: create_form,
                dataType: "json",
                contentType: false,
                processData: false,
                success: (res) => {
                    $("#loadbar").remove();
                    $(".load").append(
                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout de l'activite avec succes</p></div></div>"
                    );
                    location.reload();
                },
                error: () => {
                    $("#loadbar").remove();
                    $(".load").append(
                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'activite</p></div></div>"
                    );
                },
            });
        } else {
            $.ajax({
                url: "/ferme/activite/create",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: $("#formAddactivite").serialize(),
                success: (res) => {
                    $("#loadbar").remove();
                    $(".load").append(
                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>ajout de l'activite avec succes</p></div></div>"
                    );
                    location.reload();
                },
                error: () => {
                    $("#loadbar").remove();
                    $(".load").append(
                        "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'activite</p></div></div>"
                    );
                },
            });
        }
    });
});
