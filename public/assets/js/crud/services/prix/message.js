$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')

    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1")
    });


    $(".select2insidemodal2").select2({
        dropdownParent: $("#modal1")
    });

    $(".select2insidemodal3").select2({
        dropdownParent: $("#modal1")
    });


    $(".select2insidemodal4").select2({
        dropdownParent: $("#modal1")
    });

    $(".select2insidemodal5").select2({
        dropdownParent: $("#modal1")
    });



    $("#formAddPrix").validate({
        rules: {
            cat_produit: {
                required: true,
            },
            produit: {
                required: true,

            },
            // variete: {
            //     required: true,

            // },
            unite: {
                required: true,
            },
            // prix_unitaire: {
            //     required: true,

            // },
            // prix_en_gros: {
            //     required: true,
            // },
            date: {
                required: true,

            },
            market: {
                required: true,
            },
            // campagne: {
            //     required: true,

            // }

        },
        //For custom messages
        messages: {
            cat_produit: {
                required: "Veuillez saisir la catégorie",
            },
            produit: {
                required: "Veuillez saisir le produit",
            },
            // variete: {
            //     required: "Veuillez saisir la variété",
            // },
            unite: {
                required: "Veuillez saisir l'unité",
            },
            // prix_unitaire: {
            //     required: "Veuillez saisir le prix unitaire",
            // },
            // prix_en_gros: {
            //     required: "Veuillez saisir la prix en gros",
            // },
            date: {
                required: "Veuillez saisir la date",
            },
            market: {
                required: "Veuillez saisir le marché",
            }
            // campagne: {
            //     required: "Veuillez saisir la campagne",
            // }

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




    $('#formAddPrixbtn').click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter ce prix ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                add: 'Oui'
            }
        }).then(function(willAdd) {
            if (willAdd) {

                $('#formAddPrix').submit()

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


    $('#formEditPrixbtn').click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous modifier ce prix ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                add: 'Oui'
            }
        }).then(function(willAdd) {
            if (willAdd) {

                $('#formEditPrix').submit()

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

    $("#produit").on("change", function() {
        var produit = $(this).val();

        $.ajax({
            type: "GET",
            url: base_url + "/variete/produit/" + produit,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            success: function(resultat) {
                $("#varieties").empty();

                if (resultat.length !== 0) {
                    for (let i = 0; i < resultat.length; i++) {
                        appendVarietyInputs(resultat[i].id, resultat[i].variete);
                    }
                } else {
                    // If no variety, add directly two divs for Retail and Wholesale Prices
                    appendVarietyInputs(null, 'du produit');
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur.");
            }
        });
    });

    function appendVarietyInputs(varieteId, varieteLabel) {
        // Append Retail Price div
        $("#varieties").append(
            '<div class="input-field col s6">' +
            '<input id="prix_detaillant_' + varieteId + '" type="number" class="validate" name="prix_detaillant[]">' +
            '<label class="active" for="prix_detaillant_' + varieteId + '">Prix Detaillant ' + varieteLabel + '</label>' +
            '</div>'
        );

        // Append Wholesale Price div
        $("#varieties").append(
            '<div class="input-field col s6">' +
            '<input id="prix_en_gros_' + varieteId + '" type="number" class="validate" name="prix_en_gros[]">' +
            '<label class="active" for="prix_en_gros_' + varieteId + '">Prix En Gros ' + varieteLabel + '</label>' +
            '</div>'
        );

        // Include hidden fields for 'variete' with the value
        $("#varieties").append(
            '<input type="hidden" name="variete[]" value="' + varieteId + '">'
        );
    }


    // $("#produit").on("change", function() {
    //     var produit = $(this).val();

    //     $.ajax({
    //         type: "GET",
    //         url: base_url + "/variete/produit/" + produit,
    //         dataType: "json",
    //         headers: {
    //             Authorization: "Bearer " + $('meta[name="token"]').attr('content')
    //         },
    //         success: function(resultat) {

    //             if (resultat.length != 0) {

    //                 $("#varieties").empty();

    //                 for (let i = 0; i < resultat.length; i++) {

    //                     $("#varieties").append(
    //                         '<div class="input-field col s6">' +
    //                         '<input id="prix_detaillant_' + resultat[i].id + '" type="number" class="validate" name="prix_detaillant[]">' +
    //                         '<label class="active" for="prix_detaillant_' + resultat[i].id + '">Prix Detaillant ' + resultat[i].variete + '</label>' +
    //                         '</div>'
    //                     );

    //                     $("#varieties").append(
    //                         '<div class="input-field col s6">' +
    //                         '<input id="prix_en_gros_' + resultat[i].id + '" type="number" class="validate" name="prix_en_gros[]">' +
    //                         '<label class="active" for="prix_en_gros_' + resultat[i].id + '">Prix En Gros ' + resultat[i].variete + '</label>' +
    //                         '</div>'
    //                     );

    //                     $("#varieties").append(
    //                         '<input type="hidden" name="variete[]" value="' + resultat[i].id + '">'
    //                     );

    //                 }

    //             } else {

    //                 $("#varieties").empty();

    //             }
    //         },
    //         error: function() {
    //             alert("Erreur, merci de contacter l'administrateur .");
    //         }
    //     });
    // });

});