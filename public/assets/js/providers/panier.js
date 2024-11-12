$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    var role = jQuery('meta[name="role"]').attr("content");


    var items_per_page = 6; // Nombre d'éléments par page
    var current_page = 1; // Page actuelle
    var url = ""; //url
    var active = "1";

    // activer shop
    $(".active-shop").click(function (e) {
        e.preventDefault();
        // alert();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous activer la boutique",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/boutique/status/" + id,
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
                            text: "Boutique activée avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de l'activation de la boutique",
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
                    text: "Activation Annulé",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
    $(".desactive-shop").click(function (e) {
        e.preventDefault();
        // alert();
        let id = $(this).attr("id");
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous desactiver la boutique",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: my_url + "/boutique/status/" + id,
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
                            text: "Boutique desactivée avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        location.reload();
                    },
                    error: () => {
                        swal({
                            title: "Cancelled",
                            icon: "error",
                            text: "Erreur lors de la desactivation de la boutique",
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
                    text: "Desactivation Annulé",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    //pagination
    // Fonction pour récupérer les données à paginer des produits
    function getPaginatedData(page) {
        $(".ajaxloader").show();
        $(".box-container").hide();
        $(".pagination").hide();
        $.ajax({
            url: url,
            type: "GET",
            // data: { page: page, items_per_page: items_per_page },
            success: function (data) {
                // console.log(data);
                current_page = page;
                prod = "";
                var image = "";
                for (let i = 0; i < data.length; i++) {
                    if (!data[i].image) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].image.startsWith("https"))
                            image = data[i].image;
                        else image = "../storage/" + data[i].image;
                    }
                    prod =
                        prod +
                        "<div class='box'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;'>" +
                        "<img src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='content'>" +
                        "<div >" +
                        "<span class='price right'> " +
                        "<a title='modifier' style='display:block' class='px-1 btn yellow '" +
                        "href='/louma-mbay/produits/modifier/" +
                        data[i].id +
                        "'>" +
                        "<i class='material-icons orange-text '>edit</i>" +
                        "</a>" +
                        "<a href='#' id='" +
                        data[i].id +
                        "' class='px-1 delete_prod btn red mb-10'>" +
                        "<i class='material-icons white-text '>delete</i>" +
                        "</a>" +
                        "</span>" +
                        "<h5 style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;'>" +
                        data[i].produit +
                        "</h5>" +
                        "<h6>" +
                        data[i].cat_produit +
                        "</h6>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                }
                // console.log(prod);
                $("#card-prod").replaceWith(
                    "<div class='box-container' id='card-prod'>" +
                        prod +
                        "</div>"
                );
                // Après chaque opération de pagination, appelez cette fonction pour mettre à jour le contenu de #card-prod
                updateCardProdContent(prod);
            },
        });
    }

    //pagination shop
    function getPaginatedDataShop(page) {
        $(".ajaxloader").show();
        $(".box-container").hide();
        $(".pagination").hide();
        $.ajax({
            url: url,
            type: "GET",
            // data: { page: page, items_per_page: items_per_page },
            success: function (data) {
                role = jQuery('meta[name="role"]').attr("content");
                current_page = page;
                prod = "";
                activate_desactivate = "";
                var image = "";
                for (let i = 0; i < data.length; i++) {
                    if (!data[i].logo) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].logo.startsWith("https"))
                            image = data[i].logo;
                        else image = "../storage/" + data[i].logo;
                    }
                    if (data[i].status == 0) {
                        activate_desactivate =
                           
                            "<a href='#' id='" +
                            data[i].id +
                            "'class='active-shop'>" +
                            "<span class='chip green lighten-5'>" +
                            "<span class='green-text'>Activer</span>" +
                            "</span></a>";
                    } else {
                        activate_desactivate =
                           
                            "<a href='#' id='" +
                            data[i].id +
                            "'class='desactive-shop'>" +
                            "<span class='chip green lighten-5'>" +
                            "<span class='green-text'>Activer</span>" +
                            "</span></a>";
                    }
                    if (role === "ADMIN" || role === "SUPERADMIN") {
                        chaine =
                            "<span class='price right'> " +
                            "<a title='ajouter' class='px-1 btn white' style='color:white; display:block' href='/louma-mbay/boutiques/addProduit/" +
                            data[i].id +
                            "'> <i class='material-icons green-text'>add</i>" +
                            "</a>" +
                            "<a title='modifier' class='px-1 btn white' style='color:white; display:block;'" +
                            "href='/boutique/edit/" +
                            data[i].id +
                            "'>" +
                            "<i class='material-icons orange-text '>edit</i>" +
                            "</a>" +
                            "<a href='#' id='" +
                            data[i].id +
                            "' class='px-1 btn white mb-10 delete_shop'>" +
                            "<i class='material-icons red-text '>delete</i>" +
                            "</a>" +
                            "</span>";
                    } else {
                        chaine = "";
                    }
                    chaine =
                        chaine +
                        "<h4 style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;'>" +
                        data[i].nom +
                        "</h4>" +
                        "<p>" +
                        data[i].description +
                        "</p>" +
                        "<div>" +
                        activate_desactivate +
                        "</div>";
                    prod =
                        prod +
                        "<div class='box col-3'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;'>" +
                        "<img src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "<a href='/louma-mbay/boutiques/listeProduits/" +
                        data[i].id +
                        "' class='fas fa-eye' >" +
                        "</a>" +
                        "</div>" +
                        "<div class='content'>" +
                        "<div class='stars' >" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star-half-alt' >" +
                        "</i>" +
                        "</div>" +
                        chaine +
                        "</div>" +
                        "</div>";
                }

                updateCardShopContent(prod);
                // Après chaque opération de pagination, appelez cette fonction pour mettre à jour le contenu de #card-prod
                // updateCardProdContent(prod);
            },
        });
    }

    //pagination prod by shop getPaginatedDataShopProd
    function getPaginatedDataShopProd(page) {
        $(".ajaxloader").show();
        $(".box-container").hide();
        $(".pagination").hide();
        $.ajax({
            url: url,
            type: "GET",
            // data: { page: page, items_per_page: items_per_page },
            success: function (data) {
                role = jQuery('meta[name="role"]').attr("content");
                current_page = page;
                prod = "";
                var image = "";
                for (let i = 0; i < data.length; i++) {
                    if (!data[i].image_produit) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].image_produit.startsWith("https"))
                            image = data[i].image_produit;
                        else image = "../storage/" + data[i].image_produit;
                    }
                    if (role === "ADMIN" || role === "SUPERADMIN") {
                        chaine =
                            "<span class='price right'> " +
                            "<a title='modifier' class='px-1 btn yellow ' style='color:white; display:block'" +
                            "href='/louma-mbay/boutiques/produit_to_shop/edit/" +
                            data[i].id_boutique_produit +
                            "'>" +
                            "<i class='material-icons orange-text '>edit</i>" +
                            "</a>" +
                            "<a href='#' id='" +
                            data[i].id +
                            "' class='px-1 delete_prod_shop btn red'>" +
                            "<i class='material-icons white-text '>delete</i>" +
                            "</a>" +
                            "</span>";
                    } else {
                        chaine = "";
                    }
                    chaine =
                        chaine +
                        "<h5 style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;'>" +
                        data[i].produit +
                        "</h5>" +
                        "<h6>" +
                        data[i].prix +
                        " FCFA/";
                    data[i].unite_stock +
                        "</h6>" +
                        "<h6>" +
                        data[i].cat_produit +
                        "</h6>" +
                        "<h6>" +
                        "Stock:" +
                        data[i].stock +
                        data[i].unite_stock +
                        "</h6>";
                    prod =
                        prod +
                        "<div class='box col-3'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;' >" +
                        "<img src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='content'>" +
                        chaine +
                        "</div>" +
                        "</div>";
                }

                updateCardProdShopContent(prod);
                // Après chaque opération de pagination, appelez cette fonction pour mettre à jour le contenu de #card-prod
                // updateCardProdContent(prod);
            },
        });
    }

    // getPaginatedData(1);

    // Fonction pour attacher les gestionnaires d'événements aux boutons de suppression
    function attachDeleteEventHandlers() {
        $("#card-prod .delete_prod").click(function (event) {
            event.preventDefault(); // Pour empêcher le lien de rediriger
            var productId = $(this).attr("id");
            swal({
                title: "Etes-vous sure",
                text: "Voulez-vous supprimer le produit ",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Annuler",
                    delete: "Oui",
                },
            }).then(function (willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: my_url + "/produit/delete/" + productId,
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
                                text: "Produit supprimé avec succés",
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                        error: () => {
                            swal({
                                title: "Cancelled",
                                icon: "error",
                                text: "Erreur lors de la suppression de la boutique",
                                timer: 2000,
                                buttons: false,
                            });
                            // location.reload()
                        },
                    });
                } else {
                }
            });
            // Effectuez la suppression du produit avec l'ID productId ici
        });
    }
    function attachDeleteEventShopHandlers() {
        $("#card-shop .delete_shop").click(function (event) {
            event.preventDefault(); // Pour empêcher le lien de rediriger
            let id = $(this).attr("id");
            swal({
                title: "Etes-vous sure",
                text: "Voulez-vous supprimer la boutique ",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Annuler",
                    delete: "Oui",
                },
            }).then(function (willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: my_url + "/boutique/delete/" + id,
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
                                text: "Boutique supprimé avec succés",
                                timer: 2000,
                                buttons: false,
                            });
                            location.reload();
                        },
                        error: () => {
                            swal({
                                title: "Cancelled",
                                icon: "error",
                                text: "Erreur lors de la suppression de la boutique",
                                timer: 2000,
                                buttons: false,
                            });
                            // location.reload()
                        },
                    });
                } else {
                }
            });
            // Effectuez la suppression du produit avec l'ID productId ici
        });
    }
    function attachDeleteEventProdShopHandlers() {
        $("#card-shop-prod .delete_prod_shop").click(function (event) {
            event.preventDefault(); // Pour empêcher le lien de rediriger
            let id = $(this).attr("id");
            // alert(id);
            swal({
                title: "Etes-vous sure",
                text: "Voulez-vous supprimer le produit de la boutique ",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Annuler",
                    delete: "Oui",
                },
            }).then(function (willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: my_url + "/boutique/produits/delete/" + id,
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
                                text: "Produit supprimé avec succés",

                                buttons: false,
                            });
                            location.reload();
                        },
                        error: () => {
                            swal({
                                title: "Cancelled",
                                icon: "error",
                                text: "Erreur lors de la suppression du produit",

                                buttons: false,
                            });
                            // location.reload()
                        },
                    });
                } else {
                }
            });

            // Effectuez la suppression du produit avec l'ID productId ici
        });
    }
    // Fonction pour mettre à jour le contenu de #card-shop
    function updateCardShopContent(prod) {
        $("#card-shop").replaceWith(
            "<div class='box-container row' id='card-shop'>" + prod + "</div>"
        );
        // Réattachez les gestionnaires d'événements aux nouveaux boutons de suppression
        attachDeleteEventShopHandlers();
        $(".ajaxloader").hide();
        $(".box-container").show();
        $(".pagination").show();
    }

    // Fonction pour mettre à jour le contenu de #card-prod
    function updateCardProdContent(prod) {
        $("#card-prod").replaceWith(
            "<div class='box-container' id='card-prod'>" + prod + "</div>"
        );
        // Réattachez les gestionnaires d'événements aux nouveaux boutons de suppression
        attachDeleteEventHandlers();
        $(".ajaxloader").hide();
        $(".box-container").show();
        $(".pagination").show();
        // $("#loading-spinner").hide();
    }

    // Fonction pour mettre à jour le contenu de #card-prod
    function updateCardProdShopContent(prod) {
        $("#card-shop-prod").replaceWith(
            "<div class='box-container row' id='card-shop-prod'>" +
                prod +
                "</div>"
        );
        // Réattachez les gestionnaires d'événements aux nouveaux boutons de suppression
        attachDeleteEventProdShopHandlers();
        $(".ajaxloader").hide();
        $(".box-container").show();
        $(".pagination").show();
    }

    // Au chargement initial de la page, attachez les gestionnaires d'événements
    attachDeleteEventHandlers();
    attachDeleteEventShopHandlers();
    attachDeleteEventProdShopHandlers();

    $(".go-page").click(function () {
        let id = $(this).attr("id");
        let val = id.split("_");

        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];

        let page = parseInt(val[1]);
        url = "/produit/paginate/" + page + "/" + items_per_page;

        getPaginatedData(page);
    });

    $(".go-page-shop").click(function () {
        let id = $(this).attr("id");
        let val = id.split("_");
        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];

        let page = parseInt(val[1]);
        url = "/shop/paginate/" + page + "/" + items_per_page;
        $(".ajaxloader").show();
        getPaginatedDataShop(page);
    });
    $(".go-page-shop-prod").click(function () {
        let id = $(this).attr("id");
        let shop = $(".shop_id").val();
        let val = id.split("_");

        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];

        let page = parseInt(val[1]);
        url = "/shop/prod/paginate/" + page + "/" + items_per_page + "/" + shop;
        getPaginatedDataShopProd(page);
    });

    if ($("#produit").val() == null) {
        $(".clear-button").prop("disabled", true);
    }
    if ($("#shop").val() == null) {
        $(".clear-button-shop").prop("disabled", true);
    }

    $("#boutique").on("change", function () {
        alert();
        var prod = $(this).val();
        $.ajax({
            type: "GET",
            url: "/prod_by_shop/" + prod,
            dataType: "json",
        });
    });

    //search produit
    $("#product").on("change", function () {
        var prod = $(this).val();
        if (prod == "null") {
            url = "/produit/paginate/1/" + items_per_page;
            getPaginatedData(1);
        } else {
            $.ajax({
                type: "GET",
                url: my_url + "/produit/" + prod,
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " + $('meta[name="token"]').attr("content"),
                },
                success: function (data) {
                    $(".pagination").hide();
                    $(".clear-button").prop("disabled", false);
                    prod = "";
                    var image = "";

                    if (!data[0].image) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[0].image.startsWith("https"))
                            image = data[0].image;
                        else image = "../storage/" + data[0].image;
                    }
                    prod =
                        prod +
                        "<div class='box'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;'>" +
                        "<img src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='content'>" +
                        "<div >" +
                        "<span class='price right'> " +
                        "<a title='modifier' style='display:block' class='px-1 btn yellow '" +
                        "href='/louma-mbay/produits/modifier/" +
                        data[0].id +
                        "'>" +
                        "<i class='material-icons orange-text '>edit</i>" +
                        "</a>" +
                        "<a href='#' id='" +
                        data[0].id +
                        "' class='px-1 delete_prod btn red mb-10'>" +
                        "<i class='material-icons white-text '>delete</i>" +
                        "</a>" +
                        "</span>" +
                        "<h5>" +
                        data[0].produit +
                        "</h5>" +
                        "<h6>" +
                        data[0].cat_produit +
                        "</h6>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                    $("#card-prod").replaceWith(
                        "<div class='box-container' id='card-prod'>" +
                            prod +
                            "</div>"
                    );
                    attachDeleteEventHandlers();
                },
                error: function () {
                    // alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    });

    //liste des shop
    $.ajax({
        type: "GET",
        url: my_url + "/boutique",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr("content"),
        },
        success: function (resultat) {
            if (resultat.length != 0) {
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].cat_produit)
                    $("#shop").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].nom +
                            " </option>"
                    );
                }
                // });
            } else {
                $("#shop").empty();
                $("#shop").append(
                    "<option value=''> Pas de boutique </option>"
                );
            }
        },
        error: function () {
            // alert("Erreur, merci de contacter l'administrateur .");
        },
    });

    //search shop
    $("#shop").on("change", function () {
        var shop = $(this).val();

        if (shop == "null") {
            let page = 1;
            url = "/shop/paginate/" + page + "/" + items_per_page;
            getPaginatedDataShop(page);
        } else {
            $.ajax({
                type: "GET",
                url: my_url + "/boutique/" + shop,
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " + $('meta[name="token"]').attr("content"),
                },
                success: function (data) {
                    $(".pagination").hide();
                    $(".clear-button-shop").prop("disabled", false);
                    prod = "";
                    var image = "";

                    prod = "";
                    var image = "";

                    if (!data[0].logo) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[0].logo.startsWith("https"))
                            image = data[0].logo;
                        else image = "../storage/" + data[0].logo;
                    }
                    if (role === "ADMIN" || role === "SUPERADMIN") {
                        chaine =
                            "<span class='price right'> " +
                            "<a title='ajouter' class='px-1 btn white' style='color:white; display:block' href='/louma-mbay/boutiques/addProduit/" +
                            data[0].id +
                            "'> <i class='material-icons green-text'>add</i>" +
                            "</a>" +
                            "<a title='modifier' class='px-1 btn white' style='color:white; display:block;'" +
                            "href='/boutique/edit/" +
                            data[0].id +
                            "'>" +
                            "<i class='material-icons orange-text '>edit</i>" +
                            "</a>" +
                            "<a href='#' id='" +
                            data[0].id +
                            "' class='px-1 btn white mb-10 delete_shop'>" +
                            "<i class='material-icons red-text '>delete</i>" +
                            "</a>" +
                            "</span>";
                    } else {
                        chaine = "";
                    }
                    chaine =
                        chaine +
                        "<h4>" +
                        data[0].nom +
                        "                            </h4>" +
                        "<p>" +
                        data[0].description +
                        "</p>";
                    prod =
                        prod +
                        "<div class='box col-3'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;'>" +
                        "<img src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "<a href='/louma-mbay/boutiques/listeProduits/" +
                        data[0].id +
                        "' class='fas fa-eye' >" +
                        "</a>" +
                        "</div>" +
                        "<div class='content'>" +
                        "<div class='stars' >" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star' >" +
                        "</i>" +
                        "<i class='fas fa-star-half-alt' >" +
                        "</i>" +
                        "</div>" +
                        chaine +
                        "</div>" +
                        "</div>";

                    $("#card-shop").replaceWith(
                        "<div class='box-container' id='card-shop'>" +
                            prod +
                            "</div>"
                    );
                    attachDeleteEventShopHandlers();
                },
                error: function () {
                    // alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    });

    //liste des produits
    $.ajax({
        type: "GET",
        url: my_url + "/produit",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr("content"),
        },
        success: function (resultat) {
            if (resultat.length != 0) {
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].cat_produit)
                    $("#produit").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].produit +
                            " </option>"
                    );
                }
                // });
            } else {
                $("#produit").empty();
                $("#produit").append(
                    "<option value=''> Pas de produits </option>"
                );
            }
        },
        error: function () {
            // alert("Erreur, merci de contacter l'administrateur .");
        },
    });

    //variete produit
    $("#produit").on("change", function () {
        var prod = $(this).val();
        // alert(prod);
        $.ajax({
            type: "GET",
            url: my_url + "/variete/produit/" + prod,
            dataType: "json",
            headers: {
                Authorization:
                    "Bearer " + $('meta[name="token"]').attr("content"),
            },
            success: function (resultat) {
                if (resultat.length != 0) {
                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].cat_produit)
                        $("#variete").append(
                            "<option value='" +
                                resultat[i].id +
                                "'> " +
                                resultat[i].produit +
                                " </option>"
                        );
                    }
                    // });
                } else {
                    $("#variete").empty();
                    $("#variete").append(
                        "<option value=''> Pas de variete pour cette produit </option>"
                    );
                }
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur .");
            },
        });
    });

    //create boutique
    $("#createBoutBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#formAddShop").submit();
        $.ajax({
            success: (res) => {
                $("#loadbar").remove();
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Boutique ajoute avec succes",

                    buttons: false,
                });

                location.reload();
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de l'ajout",

                    buttons: false,
                });
                location.reload();
            },
        });
    });

    // //supprimer un shop

    // $(".delete_shop").click(function (e) {
    //     e.preventDefault();
    //     let id = $(this).attr("id");
    //     swal({
    //         title: "Etes-vous sure",
    //         text: "Voulez-vous supprimer la boutique ",
    //         icon: "warning",
    //         dangerMode: true,
    //         buttons: {
    //             cancel: "Annuler",
    //             delete: "Oui",
    //         },
    //     }).then(function (willDelete) {
    //         if (willDelete) {
    //             $.ajax({
    //                 url: my_url + "/boutique/delete/" + id,
    //                 method: "DELETE",
    //                 headers: {
    //                     Authorization:
    //                         "Bearer " +
    //                         jQuery('meta[name="token"]').attr("content"),
    //                 },
    //                 // data:$('#formAddUser').serialize(),
    //                 dataType: "JSON",
    //                 success: (res) => {
    //                     swal({
    //                         title: "Success",
    //                         icon: "success",
    //                         text: "Boutique supprimé avec succés",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     location.reload();
    //                 },
    //                 error: () => {
    //                     swal({
    //                         title: "Cancelled",
    //                         icon: "error",
    //                         text: "Erreur lors de la suppression de la boutique",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     // location.reload()
    //                 },
    //             });
    //         } else {
    //         }
    //     });
    // });

    //modifier shop
    $("#formModShopBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#formModshop").submit();
        $.ajax({
            success: (res) => {
                $("#loadbar").remove();
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Boutique modifiee avec succes",

                    buttons: false,
                });
                
                    window.location = "/louma-mbay/boutiques";

                

            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de la modification",

                    buttons: false,
                });
                location.reload();
            },
        });
    });

    //modifier shop ferme
    $("#formModShopFermeBtn").on("click", function (e) {
        e.preventDefault();

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#formModShopFerme").submit();
        $.ajax({
            success: (res) => {
                $("#loadbar").remove();
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Boutique modifiee avec succes",

                    buttons: false,
                });
                
                    window.location = "/ferme/shop";

                

            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de la modification",

                    buttons: false,
                });
                location.reload();
            },
        });
    });



    //ajouter produit
    $("#createProdByadminBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#formAddProdByadmin").submit();
        $.ajax({
            success: (res) => {
                $("#loadbar").remove();
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Produit ajoute avec succes",

                    buttons: false,
                });

                location.reload();
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de l'ajout",

                    buttons: false,
                });
                location.reload();
            },
        });
        // $.ajax({
        //     url: "/produit/create",
        //     method: "POST",
        //     headers: {
        //         "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
        //             "content"
        //         ),
        //     },
        //     data: $("#formAddProdByadmin").serialize(),

        //     // dataType: 'JSON',
        //     success: (res) => {
        //         //   alert('Ok')
        //         // alert(res.message)
        //         $("#loadbar").remove();
        //         $(".load").append(
        //             "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Produit ajoutee avec succes</p></div></div>"
        //         );
        //         location.reload();
        //     },
        //     error: () => {
        //         $("#loadbar").remove();
        //         $(".load").append(
        //             "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du produit</p></div></div>"
        //         );
        //     },
        // });
    });

    //edit produit
    $("#editProduit").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $("#FormEditProd").submit();
        $.ajax({
            success: (res) => {
                $("#loadbar").remove();
                swal({
                    title: "Success",
                    icon: "success",
                    text: "Produit modifie avec succes",

                    buttons: false,
                });

                window.location = "/louma-mbay/produits";
            },
            error: () => {
                swal({
                    title: "Erreur",
                    icon: "error",
                    text: "Erreur lors de la modification",

                    buttons: false,
                });
                location.reload();
            },
        });
    });

    //supprimer produit
    // $(".delete_prod").click(function (e) {
    //     e.preventDefault();
    //     let id = $(this).attr("id");
    //     swal({
    //         title: "Etes-vous sure",
    //         text: "Voulez-vous supprimer le produit ",
    //         icon: "warning",
    //         dangerMode: true,
    //         buttons: {
    //             cancel: "Annuler",
    //             delete: "Oui",
    //         },
    //     }).then(function (willDelete) {
    //         if (willDelete) {
    //             $.ajax({
    //                 url: my_url + "/produit/delete/" + id,
    //                 method: "DELETE",
    //                 headers: {
    //                     Authorization:
    //                         "Bearer " +
    //                         jQuery('meta[name="token"]').attr("content"),
    //                 },
    //                 // data:$('#formAddUser').serialize(),
    //                 dataType: "JSON",
    //                 success: (res) => {
    //                     swal({
    //                         title: "Success",
    //                         icon: "success",
    //                         text: "Produit supprimé avec succés",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     location.reload();
    //                 },
    //                 error: () => {
    //                     swal({
    //                         title: "Cancelled",
    //                         icon: "error",
    //                         text: "Erreur lors de la suppression de la boutique",
    //                         timer: 2000,
    //                         buttons: false,
    //                     });
    //                     // location.reload()
    //                 },
    //             });
    //         } else {
    //         }
    //     });
    // });

    //unite
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
            $(".unite").empty();
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $(".unite").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.unite +
                            " </option>"
                    );
                });
            } else {
                $(".unite").empty();
                $(".unite").append("<option value=''> Pas d'unite  </option>");
            }
        },
        error: function () {
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("Erreur, merci de contacter l'administrateur d 10.");
            }
        },
    });
    //ajouter produit a une boutique
    $("#addProductToShopBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/produit_to_shop/add",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#add_produit_to_shop").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Produit ajoutee avec succes</p></div></div>"
                );
                // location.reload();
                window.location = "/louma-mbay/boutiques";
            },
            error: () => {
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du produit</p></div></div>"
                );
            },
        });
    });

       //ajouter produit a une fermeshop
       $("#addProductToFermeShopBtn").on("click", function (e) {
        e.preventDefault();

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/produit_to_shop_ferme/add",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#add_produit_to_shop_ferme").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Produit ajoutee avec succes</p></div></div>"
                );
                window.location = "/ferme/shop";
              
            },
            error: () => {
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout du produit</p></div></div>"
                );
            },
        });
    });

    $(".editProductToShopFermeBtn").on("click", function (e) {
        e.preventDefault();
        let id = $(this).attr("id");

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/ferme/shop/produit/edit",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#edit_produit_to_shop_ferme").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Produit modifee avec succes</p></div></div>"
                );
                // location.reload();
                window.location = "/ferme/shop/listeProduits/" + id;
            },
            error: () => {
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification du produit</p></div></div>"
                );
            },
        });
    });

    //modifier un produit de la boutique
    $(".editProductToShopBtn").on("click", function (e) {
        e.preventDefault();
        let id = $(this).attr("id");

        $(".load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            url: "/produit_to_shop/edit",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: $("#edit_produit_to_shop").serialize(),

            // dataType: 'JSON',
            success: (res) => {
                //   alert('Ok')
                // alert(res.message)
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Produit modifee avec succes</p></div></div>"
                );
                // location.reload();
                window.location = "/louma-mbay/boutiques/listeProduits/" + id;
            },
            error: () => {
                $("#loadbar").remove();
                $(".load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de la modification du produit</p></div></div>"
                );
            },
        });
    });
    // var radios = document.getElementsByName("livraison");
    // var valeur;
    // for (var i = 0; i < radios.length; i++) {
    //     if (radios[i].checked) {
    //         valeur = radios[i].value;
    //     }
    // }
    // alert(valeur);
});
