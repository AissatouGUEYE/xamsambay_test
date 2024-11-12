$(document).ready(function() {

    // alert("OK");

    var base_url =  $('meta[name="url"]').attr('content')

    $.ajax({
        type: "GET",
        url: base_url+"/catproduit",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            if (resultat.length != 0) {

                for (let i = 0; i < resultat.length; i++) {

                    

                    $("#cat_prod").append("<option value='" + resultat[i].id + "'> " + resultat[i].cat_produit + " </option>");

                    // alert(resultat[i].cat_produit)
                }
                // });
            } else {
                $("#cat_prod").empty();
                $("#cat_prod").append("<option value=''> Pas de catégorie </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#cat_prod").on("change", function() {

        var cat_produit = $(this).val();
        // alert(cat_produit)
        $.ajax({
            type: "GET",
            url: base_url+"/produit/categorie/" + cat_produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#prod").empty();
                $("#prod").append("<option value=''> Choisissez le produit </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {

                        // alert(resultat[i].produit)
                        
                        $("#prod").append("<option value='" + resultat[i].id + "'> " + resultat[i].produit + " </option>");

                    }
                    // });
                } else {
                    $("#prod").empty();
                    $("#prod").append("<option value=''> Pas de produit pour cette catégorie</option>");
                }
            },
            error: function() {
                alert("Erreur Produit, merci de contacter l'administrateur .");
            }
        });
    });

    $("#prod").on("change", function() {
        var produit = $(this).val();
        //        alert(produit);

        $.ajax({
            type: "GET",
            url: base_url+"/variete/produit/" + produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#variet").empty();
                $("#variet").append("<option value=''> Choisissez la variété </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].cat_produit)
                        $("#variet").append("<option value='" + resultat[i].id + "'> " + resultat[i].variete + " </option>");

                    }
                    // });
                } else {
                    $("#variet").empty();
                    $("#variet").append("<option value=''> Pas de variété pour ce produit </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

});