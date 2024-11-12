$(document).ready(function() {

    var base_url = jQuery('meta[name="url"]').attr('content');

    $("#union").on("change", function() {

        var union = $(this).val();
        // alert(union)
        $.ajax({
            type: "GET",
            url: base_url + "/union/groupements/" + union,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#groupement").empty();
                $("#groupement").append("<option value=''> Choisissez le groupement </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].libelle)
                        $("#groupement").append("<option value='" + resultat[i].id_groupement + "'> " + resultat[i].libelle + " </option>");

                    }
                    // });
                } else {
                    $("#groupement").empty();
                    $("#groupement").append("<option value=''> Pas de groupement pour cette union</option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#groupement").on("change", function() {
        var groupement = $(this).val();
        //        alert(produit);

        $.ajax({
            type: "GET",
            url: base_url + "/groupements/membres/" + groupement,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#membre").empty();
                $("#membre").append("<option value=''> Choisissez le producteur </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].prenom)
                        $("#membre").append("<option value='" + resultat[i].id + "'> " + resultat[i].prenom + "" + resultat[i].nom + " </option>");

                    }
                    // });
                } else {
                    $("#membre").empty();
                    $("#membre").append("<option value=''> Pas de producteur pour ce groupement </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


    $("#groupement_uop").on("change", function() {
        var groupement = $(this).val();
        //        alert(produit);

        $.ajax({
            type: "GET",
            url: base_url + "/groupements/membres/" + groupement,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#membre").empty();
                $("#membre").append("<option value=''> Choisissez le producteur </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].prenom)
                        $("#membre").append("<option value='" + resultat[i].id + "'> " + resultat[i].prenom + "" + resultat[i].nom + " </option>");

                    }
                    // });
                } else {
                    $("#membre").empty();
                    $("#membre").append("<option value=''> Pas de producteur pour ce groupement </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

});