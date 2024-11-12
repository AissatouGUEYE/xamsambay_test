$(document).ready(function () {
    let root = $('meta[name="url"]').attr("content");
    let role = $('meta[name="role"]').attr("content");
    $("#form-alerte")[0].reset();
    // console.log(root);
    let sms = $("#texto").val();
    let smsError = $("#texto2").val();
    let nombre_by_sms = 0;
    let nombre_by_voice = 0;
    let nombre = 0;
    $(".producteurs").empty();
    let entite = $("#id_entite").val();
    if (role == "ADMIN" || role == "SUPERADMIN") {
        entite = "null";
    }
    let localiteType = "";
    let localiteId = null;
    let communeId = null;
    let regionId = null;
    let departementId = null;
    let paysId = null;
    let genreId = null;
    let langueId = null;

    let checkProducteur2 = function () {
        localiteId = communeId = regionId = null;
        departementId = paysId = langueId = genreId = null;

        if (typeof $(".pays").val() !== "undefined" && $(".pays").val()) {
            paysId = $(".pays").val();
            // console.log(paysId);
        }

        if (typeof $(".region").val() !== "undefined" && $(".region").val()) {
            regionId = $(".region").val();
            // console.log(regionId);
        }
        if (typeof $(".dept").val() !== "undefined" && $(".dept").val()) {
            departementId = $(".dept").val();
            // console.log(departementId);
        }
        if (typeof $(".commune").val() !== "undefined" && $(".commune").val()) {
            communeId = $(".commune").val();
            // console.log(communeId);
        }
        if (
            typeof $(".localite").val() !== "undefined" &&
            $(".localite").val()
        ) {
            localiteId = $(".localite").val();
            // console.log(localiteId);
        }
        if (typeof $(".langue").val() !== "undefined" && $(".langue").val()) {
            langueId = $(".langue").val();
            // console.log(langueId);
        }
        if (typeof $(".genre").val() !== "undefined" && $(".genre").val()) {
            genreId = $(".genre").val();
            // console.log(genreId);
        }
        let pays2 = $(".pays").val();
        let urlApi =
            root +
            "/nombre/" +
            entite +
            "/null/" +
            paysId +
            "/" +
            regionId +
            "/" +
            departementId +
            "/" +
            communeId +
            "/" +
            localiteId +
            "/" +
            langueId +
            "/" +
            genreId +
            "/null";
        // console.log("url Api checkProd2 " + urlApi);
        if (
            (pays2 == "null" || !$(".pays").val()) &&
            ($(".genre").val() == "null" || !$(".genre").val()) &&
            ($(".langue").val() == "null" || !$(".langue").val())
        ) {
            $(".producteurs").empty();
        } else {
            $.ajax({
                type: "GET",
                url: urlApi,
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " +
                        jQuery('meta[name="token"]').attr("content"),
                },
                success: function (resultat) {
                    $(".producteurs").empty();

                    if (resultat.length != 0) {
                        // console.log("Success result");
                        // console.log(resultat);
                        nombre = 0;
                        nombre = resultat[0].nombre;
                        nombre_by_sms = resultat[0].nombre_camp_sms;
                        nombre_by_voice = resultat[0].nombre_camp_voice;
                        if ($("#type_canal").val()) {
                            let canal = $("#type_canal").val();
                            if (canal == "alerte_sms") {
                                nombre = nombre_by_sms;
                            } else if (canal == "alerte_voice") {
                                nombre = nombre_by_voice;
                            }
                        }
                        messageProd = nombre + " producteur(s) pour cet entité";
                        $(".producteurs").append(messageProd);
                        $("#nombreProd").val(nombre);
                    } else {
                        console.log("erreur");
                    }
                },
                error: function () {
                    alert(
                        "Erreur, merci de contacter l'administrateur Check Prod 2"
                    );
                },
            });
        }
    };

    let checkProducteurbyZone = function () {
        localiteId = communeId = regionId = null;
        departementId = paysId = langueId = zoneId = genreId = null;
        let nombre = 0;
        // let entite = $("#id_entite").val();

        if (typeof $(".pays").val() !== "undefined" && $(".pays").val()) {
            paysId = $(".pays").val();
        }
        if (typeof $(".langue").val() !== "undefined" && $(".langue").val()) {
            langueId = $(".langue").val();
        }
        if (typeof $(".genre").val() !== "undefined" && $(".genre").val()) {
            genreId = $(".genre").val();
        }

        let pays2 = $(".pays").val();

        if (
            (pays2 == "null" || !$(".pays").val()) &&
            ($(".genre").val() == "null" || !$(".genre").val()) &&
            ($(".langue").val() == "null" || !$(".langue").val()) &&
            ($("#zone").val() == "null" || !$("#zone").val())
        ) {
            $(".producteurs").empty();
        } else {
            if (typeof $("#zone").val() !== "undefined" && $("#zone").val()) {
                zoneId = $("#zone").val();
                // console.log("zone Id: " + zoneId);
                if (pays2 == "null" || !$(".pays").val()) {
                    $(".producteurs").empty();
                    $(".producteurs").append("Selectionner un pays");
                } else {
                    // Recuperer les departements
                    let urlNombre =
                        root +
                        "/nombre/" +
                        entite +
                        "/" +
                        pays2 +
                        "/" +
                        zoneId +
                        "/" +
                        langueId +
                        "/" +
                        genreId;
                    // console.log("url nombre: " + urlNombre);
                    nombre = 0;
                    $.ajax({
                        type: "GET",
                        url: urlNombre,
                        dataType: "json",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        success: function (resultat) {
                            nombre = 0;
                            if (resultat.length != 0) {
                                console.log(resultat);
                                // console.log("Get nb success " + resultat);
                                nombre_by_sms = resultat[0].nbr_camp_sms;
                                nombre_by_voice = resultat[0].nbr_camp_voice;
                                nombre = resultat[0].nombre;
                                if ($("#type_canal").val()) {
                                    let canal = $("#type_canal").val();
                                    if (canal == "alerte_sms") {
                                        nombre = nombre_by_sms;
                                    } else if (canal == "alerte_voice") {
                                        nombre = nombre_by_voice;
                                    }
                                }
                                $(".producteurs").empty();
                                // console.log("Nombre de Prod: " + nombre);
                                messageProd =
                                    nombre + " producteur(s) pour cet entité";
                                $(".producteurs").append(messageProd);
                                $("#nombreProd").val(nombre);
                            } else {
                                $(".producteurs").empty();
                                messageProd =
                                    nombre + " producteur(s) pour cet entité";
                                $(".producteurs").append(messageProd);
                                $("#nombreProd").val(nombre);
                            }
                        },
                        error: function () {
                            alert(
                                "Erreur, merci de contacter l'administrateur Get Nb Prod."
                            );
                        },
                    });
                }
            }
        }
    };

    let loadZone = function () {
        let paysId = $(".pays").val();
        if (paysId == "null") {
            $("#zone").empty();
            $("#zone").append(
                "<option value=''> --Selectionner d'abord un pays-- </option>"
            );
        } else {
            $.ajax({
                type: "GET",
                url: root + "/zones/pays/" + paysId,
                // a revoir
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " +
                        jQuery('meta[name="token"]').attr("content"),
                },
                success: function (resultat) {
                    $("#zone").empty();
                    $("#zone").append(
                        "<option value='null'>Choisissez la zone </option>"
                    );
                    // console.log(resultat);
                    if (resultat.length != 0) {
                        $.each(resultat, function (i, val) {
                            $("#zone").append(
                                "<option value='" +
                                val.id_zone +
                                "'> ZONE " +
                                val.designation +
                                " </option>"
                            );
                        });
                    } else {
                        $("#zone").empty();
                        $("#zone").append(
                            "<option value=''> Pas de zone pour ce pays! </option>"
                        );
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    };

    if (sms) {
        swal({
            title: "Success",
            icon: "success",
            text: sms,
            timer: 5000,
            buttons: false,
        });
    }
    if (smsError) {
        swal({
            title: "Avertissemnet",
            icon: "warning",
            text: smsError,
            timer: 3500,
            buttons: false,
        });
    }
    $(".choixCampagne").hide();
    $(".localiteSection").hide();
    $(".insertFile").hide();
    $(".localiteChoixConfirme").hide();
    $(".zoneChoixConfirme").hide();
    $(".smsType").hide();
    $(".voiceType").hide();
    $(".genre_lang").hide();

    $("#campagne").change(() => {
        $(".producteurs").empty();
        campagneType = $("#campagne").val();
        // console.log('type de campagne: ' + campagneType);
        if (campagneType == "upload") {
            $(".choixCampagne").hide();
            $(".localiteSection").hide();
            $(".insertFile").show();
        } else {
            $(".insertFile").hide();
            $(".localiteSection").hide();
            // recuperer la liste des elemts correspondant o type de campagne
            // les afficher sur choixCampagne
            if (campagneType == "reseau") {
                $("#campagnetype").empty();
                // recuperer la liste des reseaux rattaches a l'entite
                let profil = $("#profil").val();
                let idEntite = $("#id_entite").val();
                let selectOpt2 = "";
                urlList = root + "/entite/groupements/" + idEntite;
                if (profil == "ADMIN" || profil == "SUPERADMIN") {
                    urlList = root + "/groupements";
                }
                // console.log(idEntite);
                // Recuperer la liste des groupement rattaches a l'entite
                $.ajax({
                    url: urlList,
                    method: "GET",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    dataType: "JSON",
                    success: (res) => {
                        var selectContent = "";
                        var selectOpt = "";
                        if (res.length >= 1) {
                            for (let index = 0; index < res.length; index++) {
                                // console.log(res[index].id_groupement);
                                // console.log(res[index].libelle);
                                opt =
                                    '<option value ="' +
                                    res[index].id_groupement +
                                    '" >' +
                                    res[index].libelle +
                                    "</option>";
                                selectOpt += opt;
                            }
                            // console.log(selectOpt);

                            if (profil != "ADMIN" && profil != "SUPERADMIN") {
                                selectOpt2 =
                                    '<option value="all" >Tous les reseaux</option>';
                            }
                            selectContent =
                                '<option value="Select" disabled selected>Choisissez le réseau de destination *</option>' +
                                selectOpt +
                                selectOpt2;
                            $("#campagnetype").append(selectContent);

                            $(".choixCampagne").show();
                        } else {
                            $(".choixCampagne").hide();
                            $(".producteurs").empty();
                            messageProd =
                                " Pas de groupement rattacés à la structure";
                            $(".producteurs").append(messageProd);
                            // $(".producteurs").show();
                        }
                    },
                });
            }
            if (campagneType == "diffusion") {
                $(".choixCampagne").hide();
                $(".insertFile").hide();
                $("#campagnetype").empty();
                let profil = $("#profil").val();
                let idEntite = $("#id_entite").val();
                let selectOpt2 = "";
                urlList = root + "/diffusions/entite/" + idEntite;
                if (profil == "ADMIN" || profil == "SUPERADMIN") {
                    urlList = root + "/diffusions";
                }
                // $('.choixCampagne').show();
                $.ajax({
                    url: urlList,
                    method: "GET",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    dataType: "JSON",
                    success: (res) => {
                        var selectContent = "";
                        var selectOpt = "";
                        if (res.length >= 1) {
                            // console.log(res);
                            for (let index = 0; index < res.length; index++) {
                                if (res[index].statut == 1) {
                                    opt =
                                        '<option value ="' +
                                        res[index].id +
                                        '" >' +
                                        res[index].nom +
                                        "</option>";
                                } else {
                                    opt =
                                        '<option disabled value ="' +
                                        res[index].id +
                                        '" >' +
                                        res[index].nom +
                                        "</option>";
                                }
                                selectOpt += opt;
                            }
                            // console.log(selectOpt);

                            selectContent =
                                '<option value="Select" disabled selected>Choisissez la liste de diffusion *</option>' +
                                selectOpt;
                            $("#campagnetype").append(selectContent);

                            $(".choixCampagne").show();
                        } else {
                            selectContent =
                                '<option value="Select" disabled selected>Pas de liste de diffusion pour ce profil *</option>' +
                                selectOpt;
                            $("#campagnetype").append(selectContent);

                            $(".choixCampagne").show();
                        }
                    },
                    error: () => {
                    },
                });
            }

            if (campagneType == "localite") {
                $(".choixCampagne").hide();
                $(".insertFile").hide();
                $(".zoneChoixConfirme").hide();
                $(".localiteChoixConfirme").show();
                $(".localiteSection").show();
                $(".pays").val("null");
            }
            if (campagneType == "zone") {
                $(".choixCampagne").hide();
                $(".insertFile").hide();
                $(".localiteChoixConfirme").hide();
                $(".zoneChoixConfirme").show();
                $(".localiteSection").show();
                $(".pays").val("null");
            }
        }
    });
    $(".pays").change(() => {
        if ($("#campagne").val() == "zone") {
            $("#zone").val([]);
            loadZone();
            // Recheck that to regular changes
            if ($("#zone").val()) {
                checkProducteurbyZone();
            } else {
                checkProducteur2();
            }
        } else if ($("#campagne").val() == "localite") {
            checkProducteur2();
        }
    });
    $(".region").change(() => {
        checkProducteur2();
    });
    $(".dept").change(() => {
        checkProducteur2();
    });
    $(".commune").change(() => {
        checkProducteur2();
    });
    $(".localite").change(() => {
        checkProducteur2();
    });
    $(".genre").change(() => {
        if ($("#campagne").val() === "zone") {
            if ($("#zone").val()) {
                checkProducteurbyZone();
            } else {
                checkProducteur2();
            }
        } else if ($("#campagne").val() == "localite") {
            checkProducteur2();
        }
    });
    $(".langue").change(() => {
        if ($("#campagne").val() == "zone") {
            if ($("#zone").val()) {
                checkProducteurbyZone();
            } else {
                checkProducteur2();
            }
        } else if ($("#campagne").val() == "localite") {
            checkProducteur2();
        }
    });
    $("#zone").change(() => {
        checkProducteurbyZone();
    });
    $("#type_canal").change(() => {
        let canal = $("#type_canal").val();
        // alert(canal);
        nombre_spam = 0;

        if (canal == "alerte_sms") {
            $(".langue").val([]);
            // alert("sms");
            nombre_spam = nombre_by_sms;
            $(".genre_lang").hide();
            $(".voiceType").hide();
            $(".smsType").show();
        } else if (canal == "alerte_voice") {
            // alert("voice");
            nombre_spam = nombre_by_voice;
            let typeCampagne = $("#campagne").val();
            $(".smsType").hide();
            $(".genre_lang").show();
            $(".voiceType").show();
        } else {
            nombre_spam = nombre;
        }
        if ($("#campagne").val() == "diffusion") {
            nombre_spam = nombre;
        }
        if ($("#campagne").val() !== "upload") {
            $(".producteurs").empty();
            messageProd = nombre_spam + " producteur(s) pour cet entité";
            $(".producteurs").append(messageProd);
            $("#nombreProd").val(nombre_spam);

            if (nombre_spam == 0) {
                $("#submitAlertes").attr("disabled", true);
            } else {
                $("#submitAlertes").removeAttr("disabled");
            }
        }
    });

    $("#submitAlertes").click((e) => {
        e.preventDefault();
        let nbSms = $("#nbSms").val();
        let canal = $("#audiofile").val();
        let messaDiffusion = $("#textarea1").val();
        let message = canal == "" && messaDiffusion == "" ? false : true;
        let campagneValidation = $("#campagne").val();
        // console.log(typeof messaDiffusion);
        // alert(typeof campagneValidation);
        // console.log(role);
        if (role != "ADMIN" && role != "SUPERADMIN") {
            if (nbSms == 0) {
                swal({
                    title: "Attention",
                    icon: "warning",
                    text: "Vous n'etes pas en mesure d'envoyer des alertes veuillez acheter un pack",
                    timer: 3500,
                    buttons: false,
                });
            } else {
                if (message == false || campagneValidation == null) {
                    swal({
                        title: "Attention",
                        icon: "warning",
                        text: "Remplir les champs vides",
                        timer: 3500,
                        buttons: false,
                    });
                } else {
                    $("#form-alerte").submit();
                    $("#submitAlertes").attr("disabled", true);
                }
            }
        } else {
            if (message == false || campagneValidation == null) {
                swal({
                    title: "Attention",
                    icon: "warning",
                    text: "Remplir les champs vides",
                    timer: 3500,
                    buttons: false,
                });
            } else {
                $("#form-alerte").submit();
                $("#submitAlertes").attr("disabled", true);
            }
        }
    });

    $("#campagnetype").change(() => {
        campagne = $("#campagne").val();
        campagneTypeVal = $("#campagnetype").val();
        if (campagne == "reseau") {
            if (campagneTypeVal != "Select") {
                let urlListReseau =
                    root +
                    "/nombre/group/" +
                    entite +
                    "/" +
                    campagneTypeVal +
                    "/null/null/null";
                // console.log(urlListReseau);
                $.ajax({
                    type: "GET",
                    url: urlListReseau,
                    dataType: "json",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: function (resultat) {
                        nombre = 0;
                        if (resultat.length != 0) {
                            // console.log(resultat);
                            nombre = resultat[0].nombre;
                            nombre_by_sms = resultat[0].nbr_camp_sms;
                            nombre_by_voice = resultat[0].nbr_camp_voice;
                            $(".producteurs").empty();
                            // console.log("Nombre de Prod: " + nombre);
                            messageProd =
                                nombre + " producteur(s) pour cet entité";
                            $(".producteurs").append(messageProd);
                            $("#nombreProd").val(nombre);
                        } else {
                            $(".producteurs").empty();
                            messageProd =
                                nombre + " producteur(s) pour cet entité";
                            $(".producteurs").append(messageProd);
                            $("#nombreProd").val(nombre);
                        }
                    },
                    error: function () {
                        alert("Erreur, merci de contacter l'administrateur.");
                    },
                });
            }
        }

        if (campagne == "diffusion") {
            let urlDiffusionListNombre =
                root + "/nombre/diffusion/" + campagneTypeVal;
            $.ajax({
                type: "GET",
                url: urlDiffusionListNombre,
                dataType: "json",
                headers: {
                    Authorization:
                        "Bearer " +
                        jQuery('meta[name="token"]').attr("content"),
                },
                success: function (resultat) {
                    nombre = 0;
                    if (resultat.length != 0) {
                        console.log(resultat);
                        nombre = resultat[0].nombre;
                        $(".producteurs").empty();
                        // console.log("Nombre de Prod: " + nombre);
                        messageProd = nombre + " producteur(s) pour cet entité";
                        $(".producteurs").append(messageProd);
                        $("#nombreProd").val(nombre);
                    } else {
                        $(".producteurs").empty();
                        messageProd = nombre + " producteur(s) pour cet entité";
                        $(".producteurs").append(messageProd);
                        $("#nombreProd").val(nombre);
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur.");
                },
            });
        }
    });

    // $("#type_alerte").change(() => {
    //     let typeAlerte = $("#type_alerte").val();
    //     if (typeAlerte == "prevision") {
    //         $('#campagne').empty();
    //     }
    //     if (typeAlerte == "diffusion") {
    //     }
    // });
});
