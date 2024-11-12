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

                    

                    $("#cat_prod_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].cat_produit + " </option>");

                    // alert(resultat[i].cat_produit)
                }
                // });
            } else {
                $("#cat_prod_engrais").empty();
                $("#cat_prod_engrais").append("<option value=''> Pas de catégorie </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#cat_prod_engrais").on("change", function() {

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

                $("#prod_engrais").empty();
                $("#prod_engrais").append("<option value=''> Choisissez le produit </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {

                        // alert(resultat[i].produit)
                        
                        $("#prod_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].produit + " </option>");

                    }
                    // });
                } else {
                    $("#prod_engrais").empty();
                    $("#prod_engrais").append("<option value=''> Pas de produit pour cette catégorie</option>");
                }
            },
            error: function() {
                alert("Erreur Produit, merci de contacter l'administrateur .");
            }
        });
    });

    $("#prod_engrais").on("change", function() {
        var produit = $(this).val();
        //        alert(produit);
        var type_engrais = $("#type_engrais").val();

        $.ajax({
            type: "GET",
            url: base_url+"/variete/produit/" + produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#variet_engrais").empty();
                $("#variet_engrais").append("<option value=''> Choisissez la variété </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].variete);
                        $("#variet_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].variete + " </option>");

                    }
                    // });
                } else {
                    $("#variet_engrais").empty();
                    $("#variet_engrais").append("<option value=''> Pas de variété pour ce produit </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });


        $.ajax({
            type: "GET",
            url: base_url+"/engrais/formules/null/" + produit + "/" + type_engrais,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#formule_engrais").empty();
                $("#formule_engrais").append("<option value=''> Choisissez la formule </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        
                        $("#formule_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].formule + " </option>");
                        // alert(resultat[i].formule);

                    }
                    // });
                } else {
                    $("#formule_engrais").empty();
                    $("#formule_engrais").append("<option value=''> Pas de formule pour ce produit </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });



    $("#variet_engrais").on("change", function() {

        var variete = $(this).val();
        
        var type_engrais = $("#type_engrais").val();

        // alert(variete);

        $.ajax({
            type: "GET",
            url: base_url+"/engrais/formules/" + variete + "/null/" + type_engrais,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {

                $("#formule_engrais").empty();
                $("#formule_engrais").append("<option value=''> Choisissez la formule </option>");

                if (resultat.length != 0) {

                    for (let i = 0; i < resultat.length; i++) {
                        
                        $("#formule_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].formule + " </option>");
                        // alert(resultat[i].formule);

                    }
                    // });
                } else {
                    $("#formule_engrais").empty();
                    $("#formule_engrais").append("<option value=''> Pas de formule pour ce produit </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

});