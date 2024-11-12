$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    //create boutique

    $("#formAddShop").submit(function (e) {
        e.preventDefault();
        $("#ajaxloader").show();
        let formData = new FormData($("#formAddShop")[0]);
        $.ajax({
            url: "/louma/create_shop",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: formData,
            contentType: false,
            // cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                $("#ajaxloader").hide();
                $(".formmessage")
                    .html(response)
                    .show()
                    .delay(20000)
                    .fadeOut("slow");
            },
            error: function (e) {
                $("#ajaxloader").hide();
                $(".formmessage")
                    .html(e.responseText)
                    .show()
                    .delay(20000)
                    .fadeOut("slow");
            },
        });
    });

    function modal() {
        $(".details").click(function () {
            var id_prod = $(this).attr("id");
            var id = id_prod.split(" ");

            var id_boutique_produit = id[1];
            //details  produit

            $.ajax({
                type: "GET",
                url: my_url + "/boutique/produits/show/" + id_boutique_produit,
                dataType: "json",
                success: function (resultat) {
                    $(".modal-title").empty();
                    $(".modal-title").text(resultat[0].produit);

                    $(".prix_prod").empty();
                    $(".prix_prod").text(
                        resultat[0].prix + " FCFA/" + resultat[0].unite_stock
                    );

                    $(".cat_prod").empty();
                    $(".cat_prod").text(resultat[0].cat_produit);

                    $(".shop_prod").empty();
                    $(".shop_prod").text(resultat[0].boutique);

                    $(".variete_prod").empty();
                    $(".variete_prod").text(resultat[0].variete);

                    $(".loc_prod").empty();
                    $(".loc_prod").text(resultat[0].localite);

                    if (!resultat[0].image_produit) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (resultat[0].image_produit.startsWith("https"))
                            image = resultat[0].image_produit;
                        else image = "../storage/" + resultat[0].image_produit;
                    }

                    // var image = "../storage/" + resultat[0].image_produit;
                    var url_add = "/addProdPanier/" + resultat[0].id_boutique;

                    // alert(url_image)

                    $(".description_img").attr("src", image);
                    $(".add_p").attr("href", url_add);
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur .");
                },
            });

            //   var src_image=$(".image_src").attr('src');
            //   var nom_prod=$("#nom_prod").text();
            //   alert(nom_prod);
            //   $(".modal-title").text(nom_prod);
            //   $(".decription_img").attr("src", src_image);
            //   alert(src_image);
        });
    }

    modal();
    //temoignage
    $(".formmessage").hide();

    $("#commentform").submit(function (event) {
        // alert();
        $("#ajaxloader").show();
        $("#commentform").hide();
        $("#commentform").submit();
        $.ajax({
            success: function (response) {
                $("#ajaxloader").hide();
                $("#commentform").show();

                $(".formmessage")
                    .html(response)
                    .show()
                    .delay(20000)
                    .fadeOut("slow");
            },
        });
        event.preventDefault();
    });

    const generateRandomString = (num) => {
        const characters =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let result1 = " ";
        const charactersLength = characters.length;
        for (let i = 0; i < num; i++) {
            result1 += characters.charAt(
                Math.floor(Math.random() * charactersLength)
            );
        }

        return result1;
    };

    // Vérifie si l'identifiant unique existe déjà dans localStorage
    if (!localStorage.getItem("visitor_id")) {
        // Génère un nouvel identifiant unique
        const uniqueId = generateRandomString(9);

        // Stocke l'identifiant unique dans localStorage
        localStorage.setItem("visitor_id", uniqueId);
    }

    // Récupère l'identifiant unique depuis localStorage
    const visitorId = localStorage.getItem("visitor_id");
    // alert(visitorId);

    $.ajax({
        type: "post",
        url: "/visiteur",
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
        data: { visitorId: visitorId },
        success: function (response) {
            // console.log(response);
        },
    });

    //pagination
    var items_per_page = 6; // Nombre d'éléments par page
    var current_page = 1; // Page actuelle
    var url = "";
    var active = 1;

    //categorie + nbre de produits
    $.ajax({
        url: "/getCategorie",
        type: "GET",
        // data: { page: page, items_per_page: items_per_page },
        success: function (data) {
            cat = "";
            for (let i = 0; i < data.length; i++) {
                cat =
                    cat +
                    "<li class='list-group-item w-100 d-flex justify-content-between align-items-center'>" +
                    data[i].cat_produit +
                    "<span class='badge badge-primary badge-pill'>" +
                    data[i].nombre_produit +
                    "</span>" +
                    "</li>";
            }
            $(".categorie").replaceWith(
                '<ul class="categorie list-group list-group-horizontal-md">' +
                    cat +
                    "</ul>"
            );
        },
    });

    //pagination shop landing
    function getPaginatedDataBoutique(page) {
        $(".ajaxloader").show();
        $(".box-container").hide();
        $(".pagination").hide();
        $.ajax({
            url: url,
            type: "GET",
            // data: { page: page, items_per_page: items_per_page },
            success: function (data) {
                current_page = page;
                prod = "";
                var image = "";
                for (let i = 0; i < data.length; i++) {
                    if (!data[i].logo) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].logo.startsWith("https"))
                            image = data[i].logo;
                        else image = "../storage/" + data[i].logo;
                    }
                    prod =
                        prod +
                        "<div class='card col-sm-4' style='width: 18rem; margin-top:5px; margin-right:2px'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;margin-top:10px'>" +
                        "<img class='card-img-top' src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='card-body'>" +
                        "<h5 class='card-title' style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;'>" +
                        data[i].nom +
                        "</h5>" +
                        "<a href='/prod_by_shop/" +
                        data[i].id +
                        "' class='px-1 btn btn-light mt-3'style='color:#a2673b ; display:block' >" +
                        "<i class='fa fe-eye'> Visiter" +
                        "</i>" +
                        "</a>" +
                        "</div>" +
                        "</div>";
                }

                $("#card-shop").replaceWith(
                    "<div class='box-container row' id='card-shop' style='margin-top: 20px; margin-bottom:20px'>" +
                        prod +
                        "</div>"
                );
                $(".ajaxloader").hide();
                $(".box-container").show();
                $(".pagination").show();
            },
        });
    }

    // Fonction pour récupérer les données à paginer
    function getPaginatedData(page) {
        $(".ajaxloader-prod").show();
        $(".card_prod").hide();
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
                    if (!data[i].image_produit) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].image_produit.startsWith("https"))
                            image = data[i].image_produit;
                        else image = "../storage/" + data[i].image_produit;
                    }

                    prod =
                        prod +
                        "<div class='card col-sm-4' style='width: 18rem; margin-top:5px; margin-right:2px'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;margin-top:10px'>" +
                        "<img class='card-img-top' src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='card-body'>" +
                        "<h4 class='card-title' style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;color:#a2673b'>" +
                        data[i].produit +
                        "</h4>" +
                        "<h5 style='margin-top: 10px; text-align:center'>" +
                        "<span class='price'>" +
                        data[i].prix +
                        "</span><span class='sup'><small>" +
                        data[i].unite_prix +
                        "/" +
                        data[i].unite_stock +
                        "</small></span></h5>" +
                        "<a href='/addProdPanier/" +
                        data[i].id_boutique_produit +
                        "'class='btn m-2 add'  title='ajouter au panier' >" +
                        "<span><i class='fa fa-plus '> </i> </span>Panier" +
                        "</a>" +
                        "<a href='#" +
                        "' class='btn details'  data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='details'id='#modalDetailsProduit " +
                        data[i].id_boutique_produit +
                        "'><span><i class='fa fa-eye'></i> </span>Details" +
                        "</a>" +
                        "</div>" +
                        "</div>";
                }

                $(".card_prod").replaceWith(
                    "<div class='row  card_prod' style='margin-top: 20px; margin-bottom:20px'>" +
                        prod +
                        "</div>"
                );
                modal();
                $(".ajaxloader-prod").hide();
                $(".card_prod").show();
                $(".pagination").show();
            },
        });
    }
    // getPaginatedData(1);

    // Événement click pour le bouton de la page suivante

    $(".go_page").click(function () {
        let id = $(this).attr("id");
        let val = id.split("_");
        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];
        let page = parseInt(val[1]);
        url = "prod/paginate/" + page + "/8";

        getPaginatedData(page);
    });
    $(".go-page-boutique").click(function () {
        let id = $(this).attr("id");
        let val = id.split("_");

        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];

        let page = parseInt(val[1]);
        url = "/shop/paginate/" + page + "/8";

        getPaginatedDataBoutique(page);
    });

    //pagination boutique

    $(".go_page_b").click(function () {
        let boutique = $("#shop_b").val();

        let id = $(this).attr("id");
        let val = id.split("_");
        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];
        let page = parseInt(val[1]);
        url = "paginate_shop_by_prod/" + page + "/8/" + boutique;

        getPaginatedData(page);
    });

    //pagination categorie

    $(".go_page_c").click(function () {
        let categorie = $("#cat_c").val();
        let id = $(this).attr("id");
        let val = id.split("_");
        $("#li_" + active).removeClass("list_active");
        $(this).addClass("list_active");
        active = val[1];
        let page = parseInt(val[1]);
        url =
            "/paginate_shop_by_cat/" +
            page +
            "/" +
            items_per_page +
            "/" +
            categorie;

        getPaginatedData(page);
    });

    //livraison
    $("#lieu").hide();
    $("#tel").hide();

    if ($("#totale").val() == 0) {
        $("#livraison").hide();
        $(".valider_btn").prop("disabled", true);
    }

    $("#yes").on("click", function () {
        $("#lieu").show();
        $("#tel").show();
    });

    $("#no").on("click", function () {
        $("#lieu").hide();
        $("#tel").show();
    });

    //liste boutiques
    $.ajax({
        type: "GET",
        url: my_url + "/boutique",
        dataType: "json",
        success: function (resultat) {
            if (resultat.length != 0) {
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].cat_produit)
                    $("#boutique").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].nom +
                            " </option>"
                    );
                }
                // });
            } else {
                $("#boutique").empty();
                $("#boutique").append(
                    "<option value=''> Pas de boutiques </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur .");
        },
    });

    // flitre product by shop
    $("#product-by-shop").on("change", function () {
        var shop = $(this).val();
        let boutique = $("#shop_b").val();
        // alert(shop);
        if (shop == "null") {
            let page = 1;
            url = "paginate_shop_by_prod/" + page + "/8/" + boutique;
            getPaginatedData(page);
        } else {
            $(".ajaxloader").show();
            $.ajax({
                type: "GET",
                url: my_url + "/boutique/produits/show/" + shop,
                dataType: "json",
                success: function (data) {
                    prod = "";
                    var image = "";
                    var i = 0;

                    if (!data[i].image_produit) {
                        image = "../storage/produits/new.jpg";
                    } else {
                        if (data[i].image_produit.startsWith("https"))
                            image = data[i].image_produit;
                        else image = "../storage/" + data[i].image_produit;
                    }
                    prod =
                        prod +
                        "<div class='card col-sm-4' style='width: 18rem; margin-top:5px; margin-right:2px'>" +
                        "<div class='image' style='display: flex;justify-content: center;align-items: center;margin-top:10px'>" +
                        "<img class='card-img-top' src='" +
                        image +
                        "' style='height:150px; width:180px' alt=''>" +
                        "</div>" +
                        "<div class='card-body'>" +
                        "<h4 class='card-title' style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;color:#a2673b'>" +
                        data[i].produit +
                        "</h4>" +
                        "<h5 style='margin-top: 10px; text-align:center'>" +
                        "<span class='price'>" +
                        data[i].prix +
                        "</span><span class='sup'><small>" +
                        data[i].unite_prix +
                        "/" +
                        data[i].unite_stock +
                        "</small></span></h5>" +
                        "<a href='/addProdPanier/" +
                        data[i].id_boutique_produit +
                        "'class='btn m-2 add'  title='ajouter au panier' >" +
                        "<span><i class='fa fa-plus '> </i> </span>Panier" +
                        "</a>" +
                        "<a href='#" +
                        "' class='btn details'  data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='details'id='#modalDetailsProduit " +
                        data[i].id_boutique_produit +
                        "'><span><i class='fa fa-eye'></i> </span>Details" +
                        "</a>" +
                        "</div>" +
                        "</div>";

                    $(".card_prod").replaceWith(
                        "<div class='row  card_prod' style='margin-top: 20px; margin-bottom:20px'>" +
                            prod +
                            "</div>"
                    );
                    modal();
                    $(".ajaxloader-prod").hide();
                    $(".card_prod").show();
                    $(".pagination").show();
                },
            });
        }
    });

    // filtre categorie

    // filtre product
    $("#catInput").on("input", function () {
        const selectedOptionValue = $(this).val();
        const selectedOption = $(
            "#cats option[value='" + selectedOptionValue + "']"
        );
        if (selectedOption.length) {
            const selectedOptionId = selectedOption.attr("id");

            let page = 1;
            if (selectedOptionId == "null") {
                url = "prod/paginate/" + page + "/8";
            } else {
                url = "/paginate_shop_by_cat/" + page + "/8/" + selectedOption;
            }
            getPaginatedData(page);
        }
    });

    $("#productInput").on("input", function () {
        const selectedOptionValue = $(this).val();
        const selectedOption = $(
            "#products option[value='" + selectedOptionValue + "']"
        );

        if (selectedOption.length) {
            const selectedOptionId = selectedOption.attr("id");

            if (selectedOptionId == "null") {
                let page = 1;
                url = "prod/paginate/" + page + "/8";

                getPaginatedData(page);
            } else {
                $(".ajaxloader").show();
                $.ajax({
                    type: "GET",
                    url: my_url + "/boutique/produits/show/" + selectedOptionId,
                    dataType: "json",
                    success: function (data) {
                        prod = "";
                        var image = "";
                        var i = 0;

                        if (!data[i].image_produit) {
                            image = "../storage/produits/new.jpg";
                        } else {
                            if (data[i].image_produit.startsWith("https"))
                                image = data[i].image_produit;
                            else image = "../storage/" + data[i].image_produit;
                        }
                        prod =
                            prod +
                            "<div class='card col-sm-4' style='width: 18rem; margin-top:5px; margin-right:2px'>" +
                            "<div class='image' style='display: flex;justify-content: center;align-items: center;margin-top:10px'>" +
                            "<img class='card-img-top' src='" +
                            image +
                            "' style='height:150px; width:180px' alt=''>" +
                            "</div>" +
                            "<div class='card-body'>" +
                            "<h4 class='card-title' style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;color:#a2673b'>" +
                            data[i].produit +
                            "</h4>" +
                            "<h5 style='margin-top: 10px; text-align:center'>" +
                            "<span class='price'>" +
                            data[i].prix +
                            "</span><span class='sup'><small>" +
                            data[i].unite_prix +
                            "/" +
                            data[i].unite_stock +
                            "</small></span></h5>" +
                            "<a href='/addProdPanier/" +
                            data[i].id_boutique_produit +
                            "'class='btn m-2 add'  title='ajouter au panier' >" +
                            "<span><i class='fa fa-plus '> </i> </span>Panier" +
                            "</a>" +
                            "<a href='#" +
                            "' class='btn details'  data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='details'id='#modalDetailsProduit " +
                            data[i].id_boutique_produit +
                            "'><span><i class='fa fa-eye'></i> </span>Details" +
                            "</a>" +
                            "</div>" +
                            "</div>";

                        $(".card_prod").replaceWith(
                            "<div class='row  card_prod' style='margin-top: 20px; margin-bottom:20px'>" +
                                prod +
                                "</div>"
                        );
                        modal();
                        $(".ajaxloader-prod").hide();
                        $(".card_prod").show();
                        $(".pagination").show();
                    },
                });
            }
        }
    });
    // filtre boutique
    $("#shopInput").on("input", function () {
        const selectedOptionValue = $(this).val();
        const selectedOption = $(
            "#shops option[value='" + selectedOptionValue + "']"
        );

        if (selectedOption.length) {
            const selectedOptionId = selectedOption.attr("id");

            if (selectedOptionId == "null") {
                let page = 1;
                url = "/shop/paginate/" + page + "/8";
                getPaginatedDataBoutique(page);
            } else {
                $(".ajaxloader").show();
                $.ajax({
                    type: "GET",
                    url: my_url + "/boutique/" + selectedOptionId,
                    dataType: "json",
                    success: function (data) {
                        prod = "";
                        var image = "";
                        var i = 0;
                        if (!data[i].logo) {
                            image = "../storage/produits/new.jpg";
                        } else {
                            if (data[i].logo.startsWith("https"))
                                image = data[i].logo;
                            else image = "../storage/" + data[i].logo;
                        }
                        prod =
                            prod +
                            "<div class='card col-sm-4' style='width: 18rem; margin-top:5px; margin-right:2px'>" +
                            "<div class='image' style='display: flex;justify-content: center;align-items: center;margin-top:10px'>" +
                            "<img src='" +
                            image +
                            "' style='height:150px; width:180px' alt=''>" +
                            "</div>" +
                            "<div class='card-body'>" +
                            "<h5 class='card-title' style='max-width: 140px; white-space: nowrap;  text-align:center; margin:0 auto;overflow: hidden;text-overflow: ellipsis;'>" +
                            data[i].nom +
                            "</h5>" +
                            "<a href='/prod_by_shop/" +
                            data[i].id +
                            "' class='px-1 btn btn-light mt-3'style='color:#a2673b ; display:block' >" +
                            "<i class='fa fe-eye'> Visiter" +
                            "</i>" +
                            "</a>" +
                            "</div>" +
                            "</div>";

                        $("#card-shop").replaceWith(
                            "<div class='box-container row' id='card-shop' style='margin-top: 20px; margin-bottom:20px'>" +
                                prod +
                                "</div>"
                        );
                        $(".ajaxloader").hide();
                        $(".box-container").show();
                        $(".pagination").hide();
                    },
                });
            }
        }
    });
    var prod = null;
    var cat = null;
    var loc = null;
    // flitre boutique selon produit
    // $("#prod").on("change", function () {
    //      prod = $(this).val();

    //     url =my_url+ "/boutique/filtre/" + cat +"/" + prod+ "/"+ loc;

    //     getPaginatedDataBoutique(1);
    // });
    // filtre boutique selon categorie
    // $("#cat").on("change", function () {
    //     cat = $(this).val();
    //     url = my_url+"/boutique/filtre/" + cat +"/" + prod+ "/"+ loc;
    //     getPaginatedDataBoutique(1);
    // });
    // filtre boutique selon localite
    // $("#loc").on("change", function () {
    //     loc = $(this).val();
    //     url = my_url+"/boutique/filtre/" + cat +"/" + prod+ "/"+ loc;
    //     getPaginatedDataBoutique(1);
    // });

    //boutique change
    $("#boutique").on("change", function () {
        prod = $(this).val();
        window.location.replace("/prod_by_shop/" + prod);
    });
    boutons = document.getElementsByClassName("plus");

    $(".plus").click(function (e) {
        let id = $(this).attr("id");
        let val = id.split("_");
        let identifiant = "qtite_" + val[0];
        // alert(identifiant);
        var qtite = document.getElementById(identifiant).textContent;
        // alert(qtite);
        document.getElementById(identifiant).textContent = parseInt(qtite) + 1;

        let prix_unitaire = $("#prices_" + val[0]).attr("class");
        document.getElementById("prices_" + val[0]).textContent =
            parseInt(prix_unitaire) * (parseInt(qtite) + 1);

        let total = document.getElementById("total").textContent;
        // alert(total);
        document.getElementById("total").textContent =
            parseInt(total) + parseInt(prix_unitaire);
        let montant = document.getElementById("total").textContent;
        $(".input_total").val(montant);

        //update
        let boutique_produit = val[1];
        let commande = val[2];
        let panier = val[0];
        var panier_form = new FormData();
        panier_form.append("qtite", parseInt(qtite) + 1);

        panier_form.append("boutique_produit", boutique_produit);
        panier_form.append("commande", commande);
        panier_form.append("panier", panier);

        $.ajax({
            type: "POST",
            url: "/panier/update",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: panier_form,
            dataType: "json",
            contentType: false,
            // cache: false,
            processData: false,
            success: function (response) {},
            error: () => {
                alert();
            },
        });
    });
    $(".moins").click(function () {
        let id = $(this).attr("id");
        let val = id.split("_");
        let identifiant = "qtite_" + val[0];
        var qtite = document.getElementById(identifiant).textContent;
        if (parseInt(qtite) == 1) {
            document.getElementById(identifiant).textContent = 1;
        } else {
            document.getElementById(identifiant).textContent =
                parseInt(qtite) - 1;
            let prix_unitaire = $("#prices_" + val[0]).attr("class");
            document.getElementById("prices_" + val[0]).textContent =
                parseInt(prix_unitaire) * (parseInt(qtite) - 1);

            let total = document.getElementById("total").textContent;
            document.getElementById("total").textContent =
                parseInt(total) - parseInt(prix_unitaire);

            //update
            let boutique_produit = val[1];
            let commande = val[2];
            let panier = val[0];

            var panier_form = new FormData();
            panier_form.append("qtite", parseInt(qtite) - 1);
            panier_form.append("boutique_produit", boutique_produit);
            panier_form.append("commande", commande);
            panier_form.append("panier", panier);

            $(".input_total").val(document.getElementById("total").textContent);

            $.ajax({
                type: "POST",
                url: "/panier/update",
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: panier_form,
                dataType: "json",
                contentType: false,
                // cache: false,
                processData: false,
                success: function (response) {},
                error: () => {
                    alert();
                },
            });
        }
    });

    //update panier
    $(".panier_refresh").click(function (e) {
        e.preventDefault();
        swal({
            title: "Modification !",
            text: "Veuillez attendre!",
            icon: "warning",
        });
        let id = $(this).attr("id");
        // alert(id);

        let val = id.split("_");

        let identifiant = "qtite_" + val[0];
        // alert(val[0]);
        let boutique_produit = val[1];
        let commande = val[2];
        let panier = val[0];

        var qtite = document.getElementById(identifiant).textContent;
        var panier_form = new FormData();
        panier_form.append("qtite", qtite);
        panier_form.append("boutique_produit", boutique_produit);
        panier_form.append("commande", commande);
        panier_form.append("panier", panier);

        $("#load").append(
            "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
        );
        $.ajax({
            type: "POST",
            url: "/panier/update",
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: panier_form,
            dataType: "json",
            contentType: false,
            // cache: false,
            processData: false,
            success: function (response) {
                $("#loadbar").remove();
                var swal_title = "Success";
                var swal_icon = "success";
                if (response.status == 200) {
                    swal_title = "Success";
                    swal_icon = "success";
                } else {
                    swal_title = "Erreur";
                    swal_icon = "error";
                }
                swal({
                    title: swal_title,
                    icon: swal_icon,
                    text: response.message,
                    timer: 5000,
                    buttons: false,
                });
                location.reload();
            },
            error: () => {
                alert();
            },
        });
    });

    //supprimer un produit d'un panier

    $(".delete_panier").click(function (e) {
        e.preventDefault();
        let command_id = $("#command_id").val();
        // alert(token);
        let id = $(this).attr("id");
        // alert(id)
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
                    url: my_url + "/panier/delete/" + id,
                    method: "DELETE",

                    dataType: "JSON",
                    success: (res) => {
                        console.log(res);
                        swal({
                            title: "Success",
                            icon: "success",
                            text: "produit supprimé avec succés",
                            timer: 2000,
                            buttons: false,
                        });
                        window.location = "/monPanier/produits";
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
            }
        });
    });
});
