$(document).ready(function () {
    var base_url = jQuery('meta[name="url"]').attr("content");

    $.ajax({
        type: "GET",
        url: base_url + "/gettypent",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // $("#type_entite").empty();
            $("#type_entite").append(
                "<option value=''>--Choisissez la nature de l'entité--</option>"
            );
            // console.log(resultat);
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $("#type_entite").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.nom_typentite +
                            " </option>"
                    );
                });
            } else {
                $("#type_entite").empty();
                $("#type_entite").append(
                    "<option value=''> Pas d'entite existante </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur d.");
        },
    });
});
