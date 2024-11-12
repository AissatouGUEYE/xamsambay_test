$(document).ready(function() {

    $('#editUserFermebtn').click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enrégistrer ces informations ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                add: 'Oui'
            }
        }).then(function(willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $('#editUserFerme').submit()

            } else {
                alert('Enrégistrement annulé !')
                    // swal("Your imaginary file is safe", {
                    //     title: 'Cancelled',
                    //     icon: "error",
                    // });
            }
        });

    });

});