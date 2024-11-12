$(document).ready(() => {
    // alert('read mode')

    var base_url = $('meta[name="url"]').attr('content')

    deleteAUOP = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer l'AUOP ?",
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
                    url: base_url + "/auop/delete/" + id,
                    method: 'DELETE',
                    headers: {
                        'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: (res) => {
                        // alert('Successfully deleted')
                        swal("Suppression réussie !", {
                            title: 'Success',
                            icon: 'success',
                            timer: 2000,
                            buttons: false
                        });
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
                    // text: res.message,
                    timer: 2000,
                    buttons: false

                });
            }
        });

    }




    deleteUnion = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer l'Union de Groupement ?",
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
                    url: base_url + "/union_groupements/delete/" + id,
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



    deleteGrp = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le groupement ?",
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
                    url: base_url + "/groupements/delete/" + id,
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


    deleteMembre = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer ce producteur ?",
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
                    url: base_url + "/groupements/membres/retirer/" + id,
                    method: 'PUT',
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