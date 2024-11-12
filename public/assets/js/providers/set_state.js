$(document).ready(function () {
   
    var base_url = jQuery('meta[name="url"]').attr("content");
    $(".active-user").click(function (e) {
        e.preventDefault();
        // alert();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer l'utilisateur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/actif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: "JSON",
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Utilisateur activé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'activation de l'utilisateur",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de l'activation de l'utilisateur",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
    $(".deactive-user").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver l'utilisateur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: "JSON",
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Utilisateur désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation de l'utilisateur",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la désactivation de  l'utilisateur",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    $(".fermer_commande").click(function (e) {
      
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous cloturer la commande",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/commande/admin/fermer/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    // data:$('#formAddUser').serialize(),
                    dataType: "JSON",
                    success: (res) => {
                        // alert(res);
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Commande cloturé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la fermeture de la commande",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            }
        });
    });

    $(".activate_campagne").click(function (e) {
        e.preventDefault();
        let id = $(".activate_campagne:focus").attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer la campagne",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/mlcampagne/actif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        // alert('Utilisateur active avec succes')
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Campagne activée avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'activation de la campagne",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".deactivate_campagne").click(function (e) {
        e.preventDefault();
        let id = $(".deactivate_campagne:focus").attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver la campagne",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/mlcampagne/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Campagne désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation de la campagne",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la désactivation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".activate_reseau").click(function (e) {
        e.preventDefault();
        let id = $(".activate_reseau:focus").attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer la réseau",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/mlreseau/actif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        // alert('Utilisateur active avec succes')
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Réseau activée avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du réseau",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".deactivate_reseau").click(function (e) {
        e.preventDefault();
        let id = $(".deactivate_reseau:focus").attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver le réseau",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/mlreseau/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "réseau désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du réseau",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la désactivation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    // });

    $(".active-transversal").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id)
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer ce transversal",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/transversal/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        // alert('Utilisateur active avec succes')
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "transversal désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du transversal",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                //         // swal({
                //         //     title: 'Cancelled',
                //         //     icon: "error",
                //         //     text: "Erreur lors de l'activation de la campagne",
                //         //     timer: 2000,
                //         //     buttons: false
                //         // });
            }
        });
    });

    $(".inactive-transversal").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // alert('id='+id)
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer ce transversal",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/transversal/actif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        // alert('Utilisateur active avec succes')
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Transversal activé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'activation du  transversal",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".activate_producteur").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer le producteur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/campagne/producteur/actif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        // alert('Utilisateur active avec succes')
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Producteur activé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'activation du producteur",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".deactivate_producteur").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver le producteur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/campagne/producteur/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Producteur désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du producteur",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la désactivation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".deactivate_producteur").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver le producteur",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/campagne/producteur/inactif/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Producteur désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du producteur",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                // swal({
                //     title: 'Cancelled',
                //     icon: "error",
                //     text: "Erreur lors de la désactivation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".set-price-state").click(function (e) {
        // alert("12");
        e.preventDefault();
        let id = $(this).attr("id");
        // alert(id);
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer le prix",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: base_url + "/prix/valide/" + id,
                    method: "PUT",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Prix activé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation du prix",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
                swal({
                    title: "Cancelled",
                    icon: "error",
                    text: "Erreur lors de la désactivation de la campagne",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
});
