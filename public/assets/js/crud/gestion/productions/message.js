$(document).ready(function() {


    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1")
    });


    $("#formAddProduction").validate({
        rules: {

            profil: {
                required: true,
            },
            sol: {
                required: true,
            },
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
            quantite: {
                required: true,
            },
            campagne: {
                required: true,

            }

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
            profil: {
                required: "Veuillez choisir un producteur",
            },
            sol: {
                required: "Veuillez choisir le sol",
            },
            quantite: {
                required: "Veuillez saisir la quantité",
            },
            campagne: {
                required: "Veuillez saisir la campagne",
            }

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




    $('#formAddProductionbtn').click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter cette production ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                add: 'Oui'
            }
        }).then(function(willAdd) {
            if (willAdd) {

                $('#formAddProduction').submit()

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


    $('#formEditProductionbtn').click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous modifier cette production ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                add: 'Oui'
            }
        }).then(function(willAdd) {
            if (willAdd) {

                $('#formEditProduction').submit()

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