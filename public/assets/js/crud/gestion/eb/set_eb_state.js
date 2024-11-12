$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')

    $('.statut-eb').click(function(e) {
        e.preventDefault();
        // alert();
        let id = $(this).attr('id')
        swal({
            title: "Etes-vous sure",
            text: "Voulez-Vous Accepter ou Rejeter cette Expression de Besoin",
            icon: 'warning',
            dangerMode: true,
            // cancelButtonColor: "#DD6B55",
            // confirmButtonColor: "#55DDB4",
            buttons: {
                cancel: 'Annuler',
                accepter: {
                    text: 'Accepter',
                    value: 'accepter',

                },
                rejeter: {
                    text: 'Rejeter',
                    value: 'rejeter',
                },
            }

        }).then(function(value) {
            if (value === 'accepter') {
                $.ajax({
                    url: base_url + "/eb/accepter/" + id,
                    method: 'PUT',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: (res) => {
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: "Expression de Besoin Acceptée Avec Succés",
                            timer: 2000,
                            buttons: false
                        });
                        location.reload()
                    },
                    error: () => {
                        swal({
                            title: 'Cancelled',
                            icon: "error",
                            text: "Erreur lors de la modification du statut !",
                            timer: 2000,
                            buttons: false

                        });
                        // location.reload()
                    }
                })

            } else if (value === 'rejeter') {
                // Perform the other action using a different API link
                $.ajax({
                    url: base_url + "/eb/rejeter/" + id,
                    method: 'PUT',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: (res) => {
                        // Handle the success of the other action
                    },
                    error: () => {
                        // Handle the error of the other action
                    }
                });
            } else {

                swal({
                    title: 'Cancelled',
                    icon: "error",
                    text: "Modification Annulée !",
                    timer: 2000,
                    buttons: false
                });
            }
        });
    });

    $('.traiter-eb').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('id')
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous Changer l'État de l'Expression de Besoin ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/eb/traiter/" + id,
                    method: 'PUT',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: 'JSON',
                    success: (res) => {
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: "Expression de Besoin Traitée avec Succés",
                            timer: 2000,
                            buttons: false
                        });
                        location.reload()

                    },
                    error: () => {
                        swal({
                            title: 'Cancelled',
                            icon: "error",
                            text: "Erreur lors de la Désactivation de l'Expression de Besoin",
                            timer: 2000,
                            buttons: false
                        });
                        // location.reload()
                    }
                })

            } else {
                swal({
                    title: 'Cancelled',
                    icon: "error",
                    text: "Modification Annulée !",
                    timer: 2000,
                    buttons: false
                });

            }
        });

    });

    $('.non_traiter-eb').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('id')
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous Changer l'État de l'Expression de Besoin ?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Annuler',
                delete: 'Oui'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/eb/non_traiter/" + id,
                    method: 'PUT',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: 'JSON',
                    success: (res) => {
                        swal({
                            title: 'Success',
                            icon: 'success',
                            text: "Changement d'État Réussi !",
                            timer: 2000,
                            buttons: false
                        });
                        location.reload()

                    },
                    error: () => {
                        swal({
                            title: 'Cancelled',
                            icon: "error",
                            text: "Erreur lors du Changement de l'État de l'Expression de Besoin",
                            timer: 2000,
                            buttons: false
                        });
                        // location.reload()
                    }
                })

            } else {
                swal({
                    title: 'Cancelled',
                    icon: "error",
                    text: "Modification Annulée !",
                    timer: 2000,
                    buttons: false
                });

            }
        });

    });




});