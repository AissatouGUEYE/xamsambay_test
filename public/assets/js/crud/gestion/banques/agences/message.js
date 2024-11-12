$(document).ready(function() {

    $('#agenceTable').DataTable();

    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1")
    });

    var base_url = $('meta[name="url"]').attr('content')

    $("#formAddAgence").validate({
        rules: {

            localite: {
                required: true,
            },
        },
        //For custom messages
        messages: {

            localite: {
                required: "Veuillez saisir la localité",
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


    $('#formAddAgencebtn').click(function(e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter cette agence ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $('#formAddAgence').submit()

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



    $("#formEditAgence").validate({
        rules: {

            localite: {
                required: true,
            },
        },
        //For custom messages
        messages: {

            localite: {
                required: "Veuillez saisir la localité",
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


    $('#formEditAgencebtn').click(function(e) {
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
                $('#formEditAgence').submit()

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