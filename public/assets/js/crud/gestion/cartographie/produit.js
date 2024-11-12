$(document).ready(function() {
    var base_url = jQuery('meta[name="url"]').attr('content');

    // alert('jndhbcgwehfhgew');

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
                    $("#cat_prod").append("<option value='" + resultat[i].id + "'> " + resultat[i].cat_produit + " </option>");

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

        if (cat_produit !== 'all') {

            $.ajax({
                type: "GET",
                url: base_url + "/produit/categorie/" + cat_produit,
                dataType: "json",
                headers: {
                    Authorization: "Bearer " + $('meta[name="token"]').attr('content')
                },
                success: function(resultat) {

                    $("#prod").empty();
                    $("#prod").append("<option value='' selected > Choisissez le produit </option>");
                    $("#prod").append("<option value='all' > Tous les Produits </option>");

                    if (resultat.length != 0) {

                        for (let i = 0; i < resultat.length; i++) {
                            // alert(resultat[i].cat_produit)
                            $("#prod").append("<option value='" + resultat[i].id + "'> " + resultat[i].produit + " </option>");

                        }
                        // });
                    } else {
                        $("#prod").empty();
                        $("#prod").append("<option value=''> Pas de produit pour cette catégorie</option>");
                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });

            $("#var").empty();

        } else {
            $("#prod").empty();
            $("#var").empty();
        }

    });

    $("#prod").on("change", function() {
        var produit = $(this).val();

        if (produit !== 'all') {
            $.ajax({
                type: "GET",
                url: base_url + "/variete/produit/" + produit,
                dataType: "json",
                headers: {
                    Authorization: "Bearer " + $('meta[name="token"]').attr('content')
                },
                success: function(resultat) {

                    $("#var").empty();
                    $("#var").append("<option value=''> Choisissez la Variété </option>");
                    $("#var").append("<option value='all'> Toutes les Variétés </option>");

                    if (resultat.length != 0) {

                        for (let i = 0; i < resultat.length; i++) {
                            // alert(resultat[i].cat_produit)
                            $("#var").append("<option value='" + resultat[i].id + "'> " + resultat[i].variete + " </option>");

                        }
                        // });
                    } else {
                        $("#var").empty();
                        $("#var").append("<option value=''> Pas de variété pour ce produit </option>");
                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });
        } else {
            $("#var").empty();
        }
    });

});