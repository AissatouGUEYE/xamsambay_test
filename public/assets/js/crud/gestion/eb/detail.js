$(document).ready(function() {


    $('#btnOffre').click(function(e) {

        $('#cardOffre').show();

        var type_eb = $('#my-element').data('id-type-eb');

        // alert(type_eb);
        if (type_eb === 1) {
            $("#description_div").show();
            $("#qte_div").show();
            $("#unite_div").show();
            $("#Offre_btn_div").show();
        } else if (type_eb === 2) {
            $("#description_div").show();
            $("#montant_div").show();
            $("#unite_monnaie_div").show();
            $("#Offre_btn_div").show();
        } else if (type_eb === 3) {
            $("#description_div").show();
            $("#qte_div").show();
            $("#unite_div").show();
            $("#Offre_btn_div").show();
        } else if (type_eb === 4) {
            $("#description_div").show();
            $("#Offre_btn_div").show();
        } else if (type_eb === 11) {
            $("#description_div").show();
            $("#Offre_btn_div").show();
        } else if (type_eb === 12) {
            $("#description_div").show();
            $("#prix_div").show();
            $("#unite_prix_div").show();
            $("#Offre_btn_div").show();
        }

    });


    $('#btnSoumettreOffre').click(function(e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous soumettre cette Offre",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $('#formSoumettreOffre').submit()

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

    var message = $('#my-element').data('message');

    // alert(message);

    if (message != null && message != 'null') {
        swal({
            title: "Enrégistrement Réussi !",
            text: message,
            icon: 'success'
        })
    }

});