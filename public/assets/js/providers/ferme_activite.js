$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");

    var profil = jQuery('meta[name="profil"]').attr("content");

    var ferme = jQuery('meta[name="ferme"]').attr("content");

    var urlPresi = "";

    // detail eb

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/ferme/activites_ferme/" + ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#activite").empty();

            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $("#activite").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.libelle +
                            " </option>"
                    );
                });
            } else {
                $("#activite").empty();
                $("#activite").append(
                    "<option value=''> Pas d'activite' pour cette ferme  </option>"
                );
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("Erreur, merci de contacter l'administrateur d 8.");
            }
        },
    });

    // liste type de demande
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/ferme_demande/type",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#type_demande").empty();

            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $("#type_demande").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.nom +
                            " </option>"
                    );
                });
            } else {
                $("#type_demande").empty();
                $("#type_demande").append(
                    "<option value=''> Pas de type de demande pour cette ferme  </option>"
                );
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("Erreur, merci de contacter l'administrateur d 8.");
            }
        },
    });

    //liste type de paiement
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/ferme/paiements",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#operation").empty();
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $("#operation").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.paiement +
                            " </option>"
                    );
                });
            } else {
                $("#operation").empty();
                $("#operation").append(
                    "<option value=''> Pas d'operation .....  </option>"
                );
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("Erreur, merci de contacter l'administrateur d 9.");
            }
        },
    });

    // details eb
    $(".detail_eb").click(function () {
        var id_eb = $(this).attr("id");

        $.ajax({
            type: "GET",
            url: my_url + "/ferme/eb/" + id_eb,
            dataType: "json",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            success: function (resultat) {
                $(".prod-eb").empty();
                $(".prod-eb").text(resultat[0].produit);

                $(".besoin-eb").empty();
                $(".besoin-eb").text(resultat[0].description);
                if (resultat[0].actif_p == 2 && resultat[0].actif_m == 2) {
                    $(".status-eb").empty();
                    $(".status-eb").html(
                        '<span style="color:green;"> Validé </span>'
                    );
                } else {
                    if (resultat[0].actif_p == 1 || resultat[0].actif_m == 1) {
                        $(".status-eb").empty();
                        $(".status-eb").html(
                            '<span style="color:yellow;"> En cours </span>'
                        );
                    } else {
                        $(".status-eb").empty();
                        $(".status-eb").html(
                            '<span style="color:red;"> Rejeté</span>'
                        );
                    }
                }

                $(".date-eb").empty();
                $(".date-eb").text(resultat[0].created_at);

                $(".comment-presi").empty();
                $(".comment-presi").text(resultat[0].commentaire_p);

                $(".comment-man").empty();
                $(".comment-man").text(resultat[0].commentaire_m);

                if (resultat[0].actif_p == 2 && resultat[0].actif_m == 2) {
                    $(".status-presi").empty();
                    $(".status-presi").html(
                        '<span style="color:green;">Validé </span>'
                    );

                    $(".status-man").empty();
                    $(".status-man").html(
                        '<span style="color:green;"> Validé </span>'
                    );
                } else {
                    if (resultat[0].actif_p == 1 && resultat[0].actif_m == 1) {
                        $(".status-presi").empty();
                        $(".status-presi").html(
                            '<span style="color:yellow;"> En cours </span>'
                        );

                        $(".status-man").empty();
                        $(".status-man").html(
                            '<span style="color:yellow;"> En cours </span>'
                        );
                    } else {
                        $(".status-presi").empty();
                        $(".status-presi").html(
                            '<span style="color:red;"> Rejeté </span>'
                        );

                        $(".status-man").empty();
                        $(".status-man").html(
                            '<span style="color:red;"> Rejeté </span>'
                        );
                    }
                }

                $(".status-man").empty();
                $(".status-man").text(resultat[0].variete);
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur .");
            },
        });
    });

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/unite",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#unite").empty();
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $("#unite").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.unite +
                            " </option>"
                    );
                });
            } else {
                $("#unite").empty();
                $("#unite").append("<option value=''> Pas d'unite  </option>");
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("Erreur, merci de contacter l'administrateur d 10.");
            }
        },
    });
    // alert();
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/ferme/produits/ferme_produits/" + ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $(".produit").empty();
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $(".produit").append(
                        "<option value='" +
                            val.id_produit +
                            "'> " +
                            val.produit +
                            " </option>"
                    );
                });
            } else {
                $(".produit").empty();
                $(".produit").append(
                    "<option value=''> Pas de produits pour cette ferme  </option>"
                );
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("Erreur, merci de contacter l'administrateur d 11.");
            }
        },
    });

    // valider demande
    $(".valider_demande").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous valider cette demande",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme_administration/valider/" + id,
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
                            text: "Demande validé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la validation de la demande",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
            }
        });
    });

    // rejeter demande
    $(".rejeter_demande").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous rejeter la demande",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme_administration/rejeter/" + id,
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
                            text: "Demande rejeté avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors du rejet de la demande",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
            }
        });
    });

    ///////////////////////////////////////
    $(".activate_eb").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous valider l'expression de besoin",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                if (profil == "PRESIDENT") {
                    urlPresi = my_url + "/ferme/eb/activer/president/";
                } else {
                    urlPresi = my_url + "/ferme/eb/activer/manager/";
                }
                $.ajax({
                    url: urlPresi + id,
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
                            text: "Besoin validé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la validation de l'eb",
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
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".desactivate_eb").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous désactiver l'expression de besoin",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                if (profil == "PRESIDENT") {
                    urlPresi = my_url + "/ferme/eb/inactiver/president/";
                } else {
                    urlPresi = my_url + "/ferme/eb/inactiver/manager/";
                }
                $.ajax({
                    url: urlPresi + id,
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
                            text: "Besoin désactivé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la désactivation de l'eb",
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
                //     text: "Erreur lors de la désactivation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".supprimer_eb").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer l'expression de besoin",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme/eb/delete/" + id,
                    method: "DELETE",
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
                            text: "Besoin supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la suppression de l'eb",
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
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".supprimer_produit").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le produit",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme/produits/delete/" + id,
                    method: "DELETE",
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
                            text: "produit supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la suppression du produit",
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
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    $(".supprimer_activite").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer l'activite ",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme/activites/delete/" + id,
                    method: "DELETE",
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
                            text: "activite supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la suppression de l'activite",
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
                //     text: "Erreur lors de l'activation de la campagne",
                //     timer: 2000,
                //     buttons: false
                // });
            }
        });
    });

    //supprimer stock

    $(".suprrimer_stock").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous supprimer le stock ",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/ferme/stocks/delete/" + id,
                    method: "DELETE",
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
                            text: "stock supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la suppression du stock",
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                });
            } else {
            }
        });
    });

    // $('.edit-stock').click(function(e){
    //     e.preventDefault();
    //     let id = $(this).attr("id");
    //     alert(id)
    //     $.ajax({
    //         type: "GET",
    //         url: "/ferme/stock/"+id,
    //         error: function () {
    //             alert("Erreur, merci de contacter l'administrateur d.");
    //         },
    //     });

    // })
});
