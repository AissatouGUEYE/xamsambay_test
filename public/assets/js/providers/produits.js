$(document).ready(function() {
    var base_url = jQuery('meta[name="url"]').attr('content');

    $.ajax({
        type: "GET",
        url: base_url + "/catproduit",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            if (resultat.length != 0) {

                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].cat_produit)
                    $("#cat_produit").append("<option value='" + resultat[i].id + "'> " + resultat[i].cat_produit + " </option>");

                }
                // });
            } else {
                $("#cat_produit").empty();
                $("#cat_produit").append("<option value=''> Pas de catégorie </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#cat_produit").on("change", function() {

        var cat_produit = $(this).val();
        // alert(cat_produit)
        $.ajax({
            type: "GET",
            url: base_url + "/produit/categorie/" + cat_produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#produit").empty();
                $("#produit").append("<option value=''> Choisissez le produit </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].cat_produit)
                        $("#produit").append("<option value='" + resultat[i].id + "'> " + resultat[i].produit + " </option>");

                    }
                    // });
                } else {
                    $("#produit").empty();
                    $("#produit").append("<option value=''> Pas de produit pour cette catégorie</option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#produit").on("change", function() {
        var produit = $(this).val();
        //        alert(produit);

        $.ajax({
            type: "GET",
            url: base_url + "/variete/produit/" + produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#variete").empty();
                $("#variete").append("<option value=''> Choisissez la variété </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].cat_produit)
                        $("#variete").append("<option value='" + resultat[i].id + "'> " + resultat[i].variete + " </option>");

                    }
                    // });
                } else {
                    $("#variete").empty();
                    $("#variete").append("<option value=''> Pas de variété pour ce produit </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

});