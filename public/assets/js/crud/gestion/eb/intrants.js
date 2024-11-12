$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')
        // alert("OK");

    $("#type_intrant").on("change", function() {

        var type_intrant = $(this).val();
        // alert(type_eb)

        switch (type_intrant) {

            case "1": //Engrais

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();
                $("#type_engrais_div").show();
                $("#cat_produit_engrais_div").show();
                $("#produit_engrais_div").show();
                $("#variete_engrais_div").show();
                $("#formule_engrais_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;

            case "2": //Semence

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#type_semence_div").show();

                $("#cat_produit_div").show();
                $("#produit_div").show();
                $("#variete_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_assurance_div").hide();
                break;

            case "3": //Produit Phytosanitaire

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;

            case "4": //Amendement organique

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;


            case "5": // Biostimulant

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;


            case "6": //Produits Phytosanitaires

                $("#type_intrant_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#montant_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;


            default:
                $("#type_eb_div").show();

                $("#unite_monnaie_div").hide();
                $("#formation_div").hide();
                $("#description_div").hide();
                $("#montant_div").hide();
                $("#unite_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#qte_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#type_intrant_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();

        }

    });




    // $.ajax({
    //     type: "GET",
    //     url: base_url"+/engrais/types",
    //     dataType: "json",
    //     headers: {
    //         Authorization: "Bearer " + $('meta[name="token"]').attr('content')
    //     },
    //     success: function(resultat) {

    //         if (resultat.length != 0) {

    //             for (let i = 0; i < resultat.length; i++) {



    //                 $("#type_engrais").append("<option value='" + resultat[i].id + "'> " + resultat[i].type_engrais + " </option>");

    //                 alert(resultat[i].type_engrais)
    //             }
    //             // });
    //         } else {
    //             $("#type_engrais").empty();
    //             $("#type_engrais").append("<option value=''> Pas de type d'engrais disponible </option>");
    //         }
    //     },
    //     error: function() {
    //         alert("Erreur, merci de contacter l'administrateur .");
    //     }
    // });


    // $("#type_engrais").on("change", function() {
    //     var type_engrais = $(this).val();
    //         //    alert(type_engrais);



    //     $("#prod").on("change", function() {
    //         var produit = $(this).val();
    //         alert(produit);

    //         $.ajax({
    //             type: "GET",
    //             url: "/engrais/formules/null/" + produit + "/" + type_engrais,
    //             dataType: "json",
    //             headers: {
    //                 Authorization: "Bearer " + $('meta[name="token"]').attr('content')
    //             },
    //             success: function(resultat) {

    //                 $("#formule").empty();
    //                 $("#formule").append("<option value=''> Choisissez la formule </option>");

    //                 if (resultat.length != 0) {

    //                     for (let i = 0; i < resultat.length; i++) {
    //                         alert(resultat[i].formule)
    //                         $("#formule").append("<option value='" + resultat[i].id + "'> " + resultat[i].formule + " </option>");

    //                     }
    //                     // });
    //                 } else {
    //                     $("#formule").empty();
    //                     $("#formule").append("<option value=''> Pas de formule pour ce produit </option>");
    //                 }
    //             },
    //             error: function() {
    //                 alert("Erreur, merci de contacter l'administrateur .");
    //             }
    //         });

    //     });



    //     $("#variet").on("change", function() {
    //         var variete = $(this).val();


    //         $.ajax({
    //             type: "GET",
    //             url: "/engrais/formules/" + variete + "/null/" + type_engrais,
    //             dataType: "json",
    //             headers: {
    //                 Authorization: "Bearer " + $('meta[name="token"]').attr('content')
    //             },
    //             success: function(resultat) {

    //                 $("#formule").empty();
    //                 $("#formule").append("<option value=''> Choisissez la formule </option>");

    //                 if (resultat.length != 0) {

    //                     for (let i = 0; i < resultat.length; i++) {
    //                         // alert(resultat[i].cat_produit)
    //                         $("#formule").append("<option value='" + resultat[i].id + "'> " + resultat[i].formule + " </option>");

    //                     }
    //                     // });
    //                 } else {
    //                     $("#formule").empty();
    //                     $("#formule").append("<option value=''> Pas de formule pour cette variété </option>");
    //                 }
    //             },
    //             error: function() {
    //                 alert("Erreur, merci de contacter l'administrateur .");
    //             }
    //         });

    //     });




    // });


});