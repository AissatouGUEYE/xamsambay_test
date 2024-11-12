$(document).ready(() => {
    // alert('read mode')

    var base_url = $('meta[name="url"]').attr('content')

    deletePrix = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer les prix ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                // alert('OUI Alert')
                // $('#add_op').submit()


                $.ajax({
                    url: base_url + "/prix/delete/" + id,
                    method: 'DELETE',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: (res) => {
                        // alert('Successfully deleted')
                        location.reload();
                    },
                    error: () => {
                        alert('error')
                    }


                })


            } else {
                // alert('Suppression annulée !')
                swal("Suppression annulée !", {
                    title: 'Cancelled',
                    icon: "error",
                    timer: 2000,
                    buttons: false

                });
            }
        });

    }


});