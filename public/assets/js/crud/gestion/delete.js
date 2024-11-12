$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");

    $(".btn-delete-campagne").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la campagne",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/campagne/delete/" + id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-campagne-update").serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });
    // delete ferme
    $(".delete_ferme").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la ferme",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/deletent/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Ferme supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    // delete demande
    $(".delete_demande").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la demande",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme_administration/delete/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Demande supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    // delete tache
    $(".delete_tache").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la tache",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme/taches/delete/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Tache supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            }
        });
    });

    // delete rattachement
    $(".supprimer_rattachement").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer ce rattachement",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/fia_communes/delete/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Rattachement supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            }
        });
    });

    // delete rattachement_intrant
    $(".supprimer_rattachement_intrant").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer ce rattachement",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/fia_prod_intrant/delete/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },

                    success: (res) => {
                        console.log(res);
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Rattachement supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            }
        });
    });
    // delete cc
    $(".supprimer_cc").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer cette Commission",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/deletent/" + id,
                    method: "delete",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Commission supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: "Erreur lors de la suppression",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            }
        });
    });
    $(".btn-delete-reseau").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le réseau",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url:
                        "/information-climatique/parametrage/reseau-delete/" +
                        id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    // data: $('#form-campagne-update').serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });
    $(".btn-delete-gerant").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer les informations",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url:
                        "/information-climatique/parametrage/gerant/delete/" +
                        id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    // data: $('#form-campagne-update').serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".btn-delete-pluvio").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le pluvio",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url:
                        "/information-climatique/parametrage/pluvio/delete/" +
                        id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    // data: $('#form-campagne-update').serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });
    $(".btn-delete-collecte").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer la collecte",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/collecte/delete/" + id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    // data: $('#form-campagne-update').serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".btn-delete-producteur").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le producteur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "producteur/delete/" + id,
                    method: "delete",
                    headers: {
                        // 'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    // data: $('#form-campagne-update').serialize(),
                    // dataType:'JSON',
                    success: (res) => {
                        // alert(res)
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                    error: () => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la modification de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });
});
