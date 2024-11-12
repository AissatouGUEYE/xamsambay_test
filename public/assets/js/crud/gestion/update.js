$(document).ready(function () {
    let root = $('meta[name="url"]').attr("content");

    $("#btn-update-campagne").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
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
                    url: "/information-climatique/campagne/update/" + id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#campagne-update").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "Campagne modifiée avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: (e) => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: e.error,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });
    $("#btn-update-reseau").click(function (e) {
        e.preventDefault();

        let id = $(this).attr("data-id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications",
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
                        "/information-climatique/parametrage/reseau-update/" +
                        id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-reseau-update").serialize(),
                    dataType: "JSON",
                    success: (res) => {
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
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-gerant-update").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications",
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
                        "/information-climatique/parametrage/gerant-update/" +
                        id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-gerant-update").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: (e) => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: e.error,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });
    $("#btn-pluvio-update").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications",
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
                        "/information-climatique/parametrage/pluvio/update/" +
                        id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-pluvio-update").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: (e) => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: e.error,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-update-transversal").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications",
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
                        "/information-climatique/parametrage/transversal/update/" +
                        id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-update-transversal").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        // location.reload()
                    },
                    error: (e) => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: e.error,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-update-collecte").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: "/information-climatique/collecte/update/" + id,
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: $("#form-update-collecte").serialize(),
                    success: (res) => {
                        swal({
                            title: "Success",
                            icon: "success",
                            text: res.message,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload()
                    },
                    error: (e) => {
                        swal({
                            title: "Erreur",
                            icon: "error",
                            text: e.error,
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                });
            } else {
                location.reload();
            }
        });
    });

    $("#btn-update-producteur").click(function (e) {
        e.preventDefault();

        let id = $("#utilisateur").val();
        let urlUpdateProd = root + "/producteurs/update/" + id;
        let pays = $("#pays").val();
        let localite = $("#localite").val();

        if (pays != "null" && localite != "null") {
            e.preventDefault();
            swal({
                title: "Etes-vous sure",
                text: "Voulez-vous enregistrer les informations du producteur",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Annuler",
                    delete: "Oui",
                },
            }).then(function (willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: urlUpdateProd,
                        method: "PUT",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        data: $("#form-producteurs-update").serialize(),
                        dataType: "JSON",

                        success: (res) => {
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
                                title: "Attention!",
                                icon: "warning",
                                text: res.message,
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                    });
                } else {
                    location.reload();
                }
            });
        } else {
            swal({
                title: "Required",
                text: "Veuillez remplir les informations sur la localité",
                icon: "info",
                timer: 4000,
                buttons: false,
            });
        }
    });





    $("#btn-terre-declaration-update").click(function (e) {
        e.preventDefault();

        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enregistrer les modifications de collecte",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                var terr_form =  new FormData($("#form-terre-declaration-update")[0])

                $.ajax({
                url: `/terre/update/${terr_form.get("profil")}`,
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
                },
                data: terr_form,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: (res) => {
                    swal({
                        title: "Success",
                        icon: "success",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                },
                error: () => {
                    swal({
                        title: "Erreur",
                        icon: "error",
                        text: res.message,
                        timer: 2000,
                        buttons: false,
                    });
                    location.reload()
                    },
                });
            } else {
                location.reload();
            }
        });
    });
});
