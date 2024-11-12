$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    let role = jQuery('meta[name="role"]').attr("content");
    let idEntitesP = jQuery('meta[name="ferme"]').attr("content");

    $("#reseauDivPar").hide();
    $("#pluvioDiv").hide();
    $("#roleDivPar").hide();

    $("#entite").change(() => {
        if (role == "ADMIN" || role == "SUPERADMIN") {
            let entiteVal = $("#entite option:selected").text();
            let entiteText = entiteVal.split("(")[1];
            entiteText = entiteText.replace(")", "");
            // alert(entiteText);
            if (entiteText != "FERME AGRICOLE") {
                if (entiteText == "GERANT" || entiteText == "SUPERVISEUR") {
                    $("#roleDivPar").hide();
                    $.ajax({
                        type: "GET",
                        url: my_url + "/roles/type_entite/" + entiteText,
                        // a revoir
                        dataType: "json",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        success: function (resultat) {
                            $("#role2").empty();
                            $("#role2").append(
                                "<option value='null' disabled selected>Choisissez le role</option>"
                            );
                            // console.log(resultat);
                            if (resultat.length != 0) {
                                $.each(resultat, function (i, val) {
                                    $("#role2").append(
                                        "<option value='" +
                                            val.id +
                                            "'>" +
                                            val.role +
                                            " </option>"
                                    );
                                });
                                $("#roleDiv").show();
                            } else {
                                $("#roleDivPar").hide();
                                $("#role2").empty();
                                $("#role2").append(
                                    "<option value=''> Pas de role pour cet entite! </option>"
                                );
                            }
                        },
                        error: function () {
                            alert(
                                "Erreur, merci de contacter l'administrateur ."
                            );
                        },
                    });
                    $.ajax({
                        type: "GET",
                        url: my_url + "/nom_groupement/OP",
                        // a revoir // au lieu dentiteText
                        dataType: "json",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        success: function (resultat) {
                            $("#groupement2").empty();
                            $("#groupement2").append(
                                "<option value='' selected>Choisissez le reseau</option>"
                            );
                            // console.log(resultat);
                            if (resultat.length != 0) {
                                $.each(resultat, function (i, val) {
                                    $("#groupement2").append(
                                        "<option value='" +
                                            val.id +
                                            "'>" +
                                            val.libelle +
                                            " </option>"
                                    );
                                });
                                $("#gptDiv").show();
                            } else {
                                $("#gptDiv").hide();
                                $("#groupement2").empty();
                                $("#groupement2").append(
                                    "<option value=''> Pas de role pour cet entite! </option>"
                                );
                            }
                        },
                        error: function () {
                            alert(
                                "Erreur, merci de contacter l'administrateur 1."
                            );
                        },
                    });
                    $("#reseauDivPar").show();
                } else {
                    $("#reseauDivPar").hide();
                    if (entiteText == "ADMIN") {
                        $("#gptDiv").hide();
                    } else {
                        $("#gptDiv").show();
                    }
                    $("#roleDivPar").show();

                    if (
                        entiteText == "OP" ||
                        entiteText == "UOP" ||
                        entiteText == "AUOP"
                    ) {
                        $.ajax({
                            type: "GET",
                            url: my_url + "/nom_groupement/OP",
                            // a revoir // au lieu dentiteText
                            dataType: "json",
                            headers: {
                                Authorization:
                                    "Bearer " +
                                    jQuery('meta[name="token"]').attr(
                                        "content"
                                    ),
                            },
                            success: function (resultat) {
                                $("#groupement").empty();
                                $("#groupement").append(
                                    "<option value='' disabled selected>Choisissez le groupement</option>"
                                );
                                // console.log(resultat);
                                if (resultat.length != 0) {
                                    $.each(resultat, function (i, val) {
                                        $("#groupement").append(
                                            "<option value='" +
                                                val.id +
                                                "'>" +
                                                val.libelle +
                                                " </option>"
                                        );
                                    });
                                    $("#gptDiv").show();
                                } else {
                                    $("#gptDiv").hide();
                                    $("#groupement").empty();
                                    $("#groupement").append(
                                        "<option value=''> Pas de role pour cet entite! </option>"
                                    );
                                }
                            },
                            error: function () {
                                alert(
                                    "Erreur, merci de contacter l'administrateur 1."
                                );
                            },
                        });
                    }
                    $.ajax({
                        type: "GET",
                        url: my_url + "/roles/type_entite/" + entiteText,
                        // a revoir
                        dataType: "json",
                        headers: {
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        success: function (resultat) {
                            $("#role").empty();
                            $("#role").append(
                                "<option value='null' disabled selected>Choisissez le role</option>"
                            );
                            // console.log(resultat);
                            if (resultat.length != 0) {
                                $.each(resultat, function (i, val) {
                                    $("#role").append(
                                        "<option value='" +
                                            val.id +
                                            "'>" +
                                            val.role +
                                            " </option>"
                                    );
                                });
                                $("#roleDiv").show();
                            } else {
                                $("#roleDivPar").hide();
                                $("#role").empty();
                                $("#role").append(
                                    "<option value=''> Pas de role pour cet entite! </option>"
                                );
                            }
                        },
                        error: function () {
                            alert(
                                "Erreur, merci de contacter l'administrateur ."
                            );
                        },
                    });
                }
            } else {
                $("#roleDivPar").hide();
            }
        }
    });

    $("#role2").change(() => {
        let entiteVal = $("#entite option:selected").text();
        let entiteText = entiteVal.split("(")[1];
        entiteText = entiteText.replace(")", "");
        if (entiteText == "SUPERVISEUR") {
            let roleSuperviseur = $("#role2 option:selected").text();
            roleSuperviseur = roleSuperviseur.split(" ").join("");
            // console.log(roleSuperviseur + '"');
            if (roleSuperviseur == "SUPERVISEUR") {
                $("#gptDiv2").hide();
                $("#pluvioDiv").hide();
            }
            if (roleSuperviseur == "SUPERVISEURRESEAU") {
                $("#pluvioDiv").hide();
                $("#gptDiv2").show();
            }
            if (
                roleSuperviseur == "SUPERVISEURPLUVIO" ||
                roleSuperviseur == "GERANTPLUVIO"
            ) {
                $("#gptDiv2").show();
                $("#pluvio").empty();
                $("#pluvio").append(
                    "<option value='null' selected>Choisissez un Reseau</option>"
                );
                $("#pluvioDiv").show();
                // let gptSup = $("#groupement2").val();
                // alert(gptSup);
            }

            // Checker si val == General ou pluvio ou reseau
            // si General ne rien afficher // cacher le groupement
            // Si reseau afficher le groupement
            // Si pluvio afficher le groupement et preciser le pluvio a partir du groupement
        }
    });
    $("#groupement2").change(() => {
        let roleProfil = $("#role2 option:selected").text();
        if (roleProfil.split(" ").join("") == "SUPERVISEURPLUVIO") {
            gptSuperviseur = $("#groupement2").val();
            if (gptSuperviseur != "null") {
                // recuperer les pluvios
                // alert("recup pluvios");
                $.ajax({
                    type: "GET",
                    url: my_url + "/mlpluvio/reseau/" + gptSuperviseur,
                    // a revoir // au lieu dentiteText
                    dataType: "json",
                    headers: {
                        Authorization:
                            "Bearer " +
                            jQuery('meta[name="token"]').attr("content"),
                    },
                    success: function (resultat) {
                        $("#pluvio").empty();
                        $("#pluvio").append(
                            "<option value='null' selected>Choisissez le pluvio</option>"
                        );
                        // console.log(resultat);
                        if (resultat.length != 0) {
                            $.each(resultat, function (i, val) {
                                $("#pluvio").append(
                                    "<option value='" +
                                        val.id +
                                        "'>Pluvio " +
                                        val.pluvio +
                                        " </option>"
                                );
                            });
                        } else {
                            $("#pluvio").empty();
                            $("#pluvio").append(
                                "<option value=''> Pas de pluvio pour ce reseau! </option>"
                            );
                        }
                    },
                    error: function () {
                        alert("Erreur, merci de contacter l'administrateur 1.");
                    },
                });
            } else {
                $("#pluvio").empty();
                $("#pluvio").append(
                    "<option value='null' selected>Choisissez d'abord un Reseau</option>"
                );
            }
        }
    });
    if (role == "ONG") {
        urlRequest2 = my_url + "/entite/get/groupements/" + idEntitesP;
        $.ajax({
            url: urlRequest2,
            method: "GET",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // console.log(resultat);
                $("#groupement").empty();
                $("#groupement").append(
                    "<option value=''>Groupement de Base</option>"
                );
                if (resultat.length != 0) {
                    let data = resultat[0];
                    // console.log(data);
                    for (const entitii in data) {
                        let key = entitii;
                        let list = data[entitii];
                        // console.log(list);

                        $.each(list, function (i, val) {
                            // if (key == "UOP") {
                            //     $("#groupement").append(
                            //         "<option value='" +
                            //         val.id_union_groupement +
                            //         "'>" +
                            //         val.libelle_union_groupement +
                            //         " (" +
                            //         key +
                            //         ")</option>"
                            //     );
                            // }
                            // if (key == "AUOP") {
                            //     $("#groupement").append(
                            //         "<option value='" +
                            //         val.id_assoc_union_grpt +
                            //         "'>" +
                            //         val.libelle_assoc_union_grpt +
                            //         " (" +
                            //         key +
                            //         ")</option>"
                            //     );
                            // }
                            if (key == "OP") {
                                // id_groupement
                                // libelle_groupement
                                $("#groupement").append(
                                    "<option value='" +
                                        val.id_groupement +
                                        "'>" +
                                        val.libelle_groupement +
                                        " (" +
                                        key +
                                        ")</option>"
                                );
                            }
                        });
                    }
                    // }
                } else {
                    $("#groupement").empty();
                    $("#groupement").append(
                        "<option value=''> Pas de Groupement de Base pour cet entite</option>"
                    );
                }
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur d.");
            },
        });

        $.ajax({
            type: "GET",
            // url: my_url + "/roles/type_entite/" + entiteText,
            url: my_url + "/roles",
            // a revoir
            dataType: "json",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            success: function (resultat) {
                $("#role").empty();
                $("#role").append(
                    "<option value='null' disabled selected>Choisissez le role</option>"
                );
                if (resultat.length != 0) {
                    let reacine = "RESPONSABLE ";
                    $.each(resultat, function (i, val) {
                        roleValue = val.role.split(" ")[1];
                        if (
                            roleValue == "OP" ||
                            roleValue == "UOP" ||
                            roleValue == "AUOP"
                        ) {
                            $("#role").append(
                                "<option value='" +
                                    val.id +
                                    "'>" +
                                    val.role +
                                    " </option>"
                            );
                        }
                    });
                } else {
                    $("#role").empty();
                    $("#role").append(
                        "<option value=''> Pas de role pour cet entite! </option>"
                    );
                }
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur .");
            },
        });
    }
});
