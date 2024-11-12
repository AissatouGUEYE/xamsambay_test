$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    let role = jQuery('meta[name="role"]').attr("content");
    let idEntites = jQuery('meta[name="ferme"]').attr("content");
    let urlRequest = my_url + "/getentity";

    $.ajax({
        url: urlRequest,
        method: "GET",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#entite").empty();
            $("#entite").append("<option value=''>Entité</option>");
            if (resultat.length != 0) {
                if (role === "ADMIN" || role === "SUPERADMIN") {
                    $.each(resultat, function (i, val) {
                        if (val.nom_typentite != "PRODUCTEUR") {
                            $("#entite").append(
                                "<option value='" +
                                    val.id +
                                    "'>" +
                                    val.nom_entite +
                                    " (" +
                                    val.nom_typentite +
                                    ")</option>"
                            );
                        }
                    });
                } else if (role === "ONG") {
                    $.each(resultat, function (i, val) {
                        if (val.id == idEntites) {
                            $("#entite").append(
                                "<option value='" +
                                    val.id +
                                    "' selected>" +
                                    val.nom_entite +
                                    " (" +
                                    val.nom_typentite +
                                    ")</option>"
                            );
                        }
                    });
                }
            } else {
                $("#entite").empty();
                $("#entite").append(
                    "<option value=''> Pas d'entite pour ce profil </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur d.");
        },
    });
    $.ajax({
        type: "GET",
        // url: my_url + "/roles/type_entite/" + entiteText,
        url: my_url + "/roles",
        // a revoir
        dataType: "json",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        success: function (resultat) {
            $("#role").empty();
            $("#role").append(
                "<option value='null' disabled selected>Choisissez le role</option>"
            );
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    roleValue = val.role.split(" ")[1];
    
                    $("#role").append(
                        "<option value='" + val.id + "'>" + val.role + " </option>"
                    );
                });
            } else {
                $("#role").empty();
                $("#role").append(
                    "<option value=''> Pas de role pour cet entite! </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur .");
        },
    });
});


