$(document).ready(() => {
    // alert('read mode')

    var base_url = $('meta[name="url"]').attr('content')

    deleteRegion = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la région ?",
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
                    url: base_url + "/regions/delete/" + id,
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




    deleteDept = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le département?",
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
                    url: base_url + "/departements/delete/" + id,
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



    deleteCommune = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la commune ?",
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
                    url: base_url + "/communes/delete/" + id,
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




    deleteLocalite = (id) => {


        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la localité ?",
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
                    url: base_url + "/localites/delete/" + id,
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