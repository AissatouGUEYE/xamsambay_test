$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content');

    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1")
    });

    $("#zone-list").on("change", function() {

        var zone = $(this).val();

        if (zone != null && zone != "null") {

            $.ajax({
                type: "GET",
                url: base_url + "/zones/departements/" + zone,
                dataType: "json",
                headers: {
                    Authorization: "Bearer " + $('meta[name="token"]').attr('content')
                },
                success: function(resultat) {
                    $("#dept-list").empty();
                    $("#dept-list").append("<option value='null'> Choisissez un Département </option>");

                    if (resultat.length != 0) {
                        $.each(resultat, function(i, val) {
                            // alert(val.id_departement)
                            $("#dept-list").append("<option value='" + val.id_departement + "'> " + val.departement + " </option>");

                        });
                    } else {
                        $("#dept-list").empty();
                        $("#dept-list").append("<option value='null'> Pas de Département pour cette Zone </option>");

                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: base_url + "/departements",
                dataType: "json",
                headers: {
                    Authorization: "Bearer " + $('meta[name="token"]').attr('content')
                },
                success: function(resultat) {
                    $("#dept-list").empty();
                    $("#dept-list").append("<option value='null'> Pas de filtre </option>");

                    if (resultat.length != 0) {
                        $.each(resultat, function(i, val) {
                            // alert(val.id)
                            $("#dept-list").append("<option value='" + val.id + "'> " + val.departement + " </option>");

                        });
                    } else {
                        $("#dept-list").empty();
                        $("#dept-list").append("<option value='null'> Pas de Département</option>");

                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });
        }
    });


    $("#type_eb").on("change", function() {

        var type_eb = $(this).val();
        // alert(type_eb)

        switch (type_eb) {
            case "1": //produit

                $("#cat_produit_div").show();
                $("#produit_div").show();
                $("#variete_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();

                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#type_intrant_div").hide();
                $("#formation_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#montant_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                $("#unite_monnaie_div").hide();
                break;


            case "2": //Offre bancaire

                // $("#date_div").show();
                $("#offre_div").show();
                $("#description_div").show();
                $("#montant_div").show();
                $("#unite_monnaie_div").show();

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
                $("#formation_div").hide();
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

            case "3": //Achat / Vente Intrant

                $("#type_intrant_div").show();

                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();


                $("#unite_monnaie_div").hide();
                $("#cat_produit_div").hide();
                $("#produit_div").hide();
                $("#variete_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#formation_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#montant_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                $("#type_assurance_div").hide();
                break;

            case "4": //Assurance

                $("#description_div").show();
                $("#type_assurance_div").show();


                $("#unite_monnaie_div").hide();
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
                $("#formation_div").hide();
                $("#offre_div").hide();
                $("#region_pro_div").hide();
                $("#dept_pro_div").hide();
                $("#commune_pro_div").hide();
                $("#region_dest_div").hide();
                $("#dept_dest_div").hide();
                $("#commune_dest_div").hide();
                $("#type_engrais_div").hide();
                $("#type_semence_div").hide();
                break;

                // case "5": //Engrais


                //     break;

                // case "6": //Semence


                //     break;

                // case "7": //Produit phytosanitaire


                //     break;

                // case "8": //Amendement organique


                //     break;

                // case "9": //Biostimulant


                //     break;

                // case "10": //Correcteur de carrence



                //     break;


            case "11": //Formation

                $("#formation_div").show();
                $("#description_div").show();

                $("#unite_monnaie_div").hide();
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

                break;

            case "12": //Transport

                $("#cat_produit_div").show();
                $("#produit_div").show();
                $("#variete_div").show();
                $("#description_div").show();
                $("#qte_div").show();
                $("#unite_div").show();
                $("#region_pro_div").show();
                $("#dept_pro_div").show();
                $("#commune_pro_div").show();
                $("#region_dest_div").show();
                $("#dept_dest_div").show();
                $("#commune_dest_div").show();

                $("#unite_monnaie_div").hide();
                $("#montant_div").hide();
                $("#formule_engrais_div").hide();
                $("#cat_produit_engrais_div").hide();
                $("#produit_engrais_div").hide();
                $("#variete_engrais_div").hide();
                $("#type_intrant_div").hide();
                $("#formation_div").hide();
                $("#offre_div").hide();
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


    $("#formAddLangue").validate({
        rules: {
            langue: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            langue: {
                required: "Veuillez saisir le nom de la langue",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },

    });


    $('#formAddEBbtn').click(function(e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter l'Expression de Besoin",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $('#formAddEB').submit()

            } else {
                swal("Ajout annulé !", {
                    title: 'Cancelled',
                    icon: "error",
                    timer: 2000,
                    buttons: false

                });
            }
        });

    });



    $("#formEditLangue").validate({
        rules: {
            langue: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            langue: {
                required: "Veuillez saisir le nom de la langue",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },

    });


    $('#formEditLanguebtn').click(function(e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enrégistrer ces modifications ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $('#formEditLangue').submit()

            } else {
                swal("Modification annulée !", {
                    title: 'Cancelled',
                    icon: "error",
                    timer: 2000,
                    buttons: false

                });
            }
        });

    });

});