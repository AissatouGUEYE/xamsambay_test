$(document).ready(() => {

    var base_url = $('meta[name="url"]').attr('content')

    deleteMarket = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer ce marché ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {


                $.ajax({
                    url: base_url + "/market/delete/" + id,
                    method: 'DELETE',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: (res) => {
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