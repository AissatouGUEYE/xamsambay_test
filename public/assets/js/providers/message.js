$(document).ready(function () {
    var base_url  = jQuery('meta[name="url"]').attr('content');
    var items = [produit = $('#produits'),region = $('#region')];
    items.map((val,i) =>{
        $(val).change(function (e) {
            e.preventDefault();
            // alert()
            let id_produit = items[0].val()
            let id_region = items[1].val()

            if (id_produit != null && id_region != null) {
                $.ajax({
                    url: base_url+"/prix/search/"+id_produit+"/"+id_region,
                    method: 'GET',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: 'JSON',
                    success: (res) => {
                        if (res.length > 0) {



                            swal({
                                title: 'Success',
                                icon: 'success',
                                text: res.length,
                                // timer: 2000,
                                buttons: true
                            });
                        }else{
                            swal({
                                title: 'Success',
                                icon: 'success',
                                text: "Pas de prix disponible",
                                // timer: 2000,
                                buttons: true
                            });
                        }

                        // location.reload()
                    },
                    error: () => {
                        swal({
                            title: 'Cancelled',
                            icon: "error",
                            text: "Erreur lors de l'activation de l'utilisateur",
                            timer: 2000,
                            buttons: false

                        });
                        // location.reload()
                    }
                })
            }else{
                // code
            }

        });
    })
    // alert(items)

    // $('#produits').change(function (e) {
    //     e.preventDefault();
    //     alert()
    // });
});
