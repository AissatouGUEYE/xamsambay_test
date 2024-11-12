$(document).ready(function () {
    // let my_url = jQuery('meta[name="url"]').attr("content");
    $("#pays").empty();
    var base_url = jQuery('meta[name="url"]').attr("content");

    $.ajax({
        type: "GET",
        url: base_url + "/pays",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr("content"),
        },
        success: function (resultat) {
            // $(".pays").append("<option value='"+resultat[0].id+"'>"+resultat[0].pays+"</option>");
            // alert(resultat[0].id)

            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                $(".pays").empty();
                $(".pays").append(
                    "<option value='null' selected> Choisissez un pays </option>"
                );
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#pays").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].pays +
                            " </option>"
                    );
                }
                // });
            } else {
                $(".pays").empty();
                $(".pays").append("<option value=''> Pas de pays </option>");
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur .");
        },
    });

    $("#pays").on("change", function () {
        var pays = $(this).val();

        if (pays == "null") {
            $(".region").empty();
            $(".dept").empty();
            $(".commune").empty();
            $(".localite").empty();
        } else {
            // alert(pays)
            $.ajax({
                type: "GET",
                url: base_url + "/showreg/" + pays,
                dataType: "json",
                success: function (resultat) {
                    // alert(resultat.nom_dept)
                    $("#region").empty();
                    $("#region").append(
                        "<option value='null'>Choisissez une region </option>"
                    );

                    if (resultat.length != 0) {
                        // $("#region").empty();
                        $.each(resultat, function (i, val) {
                            $(".region").append(
                                "<option value='" +
                                    val.id +
                                    "'> " +
                                    val.region +
                                    " </option>"
                            );
                        });
                    } else {
                        $(".region").empty();
                        $(".region").append(
                            "<option value=''> Pas de region pour ce pays! </option>"
                        );
                    }
                },
                error: function () {
                    alert(
                        "Erreur, merci de contacter l'administrateur. Liste Region"
                    );
                },
            });
        }
    });

    $(".region").on("change", function () {
        var reg = $(this).val();
        //        alert(dept);
        if (reg == "null") {
            $(".dept").empty();
            $(".commune").empty();
            $(".localite").empty();
        } else {
            $.ajax({
                type: "GET",
                url: base_url + "/showdep/" + reg,
                dataType: "json",
                success: function (resultat) {
                    $(".dept").empty();
                    $(".dept").append(
                        "<option value='null'> Choisissez le département </option>"
                    );

                    if (resultat.length != 0) {
                        $.each(resultat, function (i, val) {
                            $(".dept").append(
                                "<option value='" +
                                    val.id +
                                    "'> " +
                                    val.departement +
                                    " </option>"
                            );
                        });
                    } else {
                        $(".dept").empty();
                        $(".dept").append(
                            "<option value=''> Pas de département pour cette région </option>"
                        );
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    });

    //input aavec enter

    $(".dept").on("change", function () {
        var dept = $(this).val();
        //        alert(comm);
        if (dept == "null") {
            $(".commune").empty();
            $(".localite").empty();
        } else {
            $.ajax({
                type: "GET",
                url: base_url + "/showcom/" + dept,
                dataType: "json",
                success: function (resultat) {
                    $(".commune").empty();
                    $(".commune").append(
                        "<option value='null'> Choisissez une commune </option>"
                    );

                    if (resultat.length != 0) {
                        $.each(resultat, function (i, val) {
                            $(".commune").append(
                                "<option value='" +
                                    val.id +
                                    "'> " +
                                    val.commune +
                                    " </option>"
                            );
                        });
                    } else {
                        $(".commune").empty();
                        $(".commune").append(
                            "<option value=''> Pas de commune pour ce département </option>"
                        );
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    });

    $(".commune").on("change", function () {
        var commune = $(this).val();
        //        alert(comm);
        if (commune == "null") {
            $(".localite").empty();
        } else {
            $.ajax({
                type: "GET",
                url: base_url + "/showloc/" + commune,
                dataType: "json",
                success: function (resultat) {
                    $(".localite").empty();
                    $(".localite").append(
                        "<option value=''> Choisissez une localité </option>"
                    );

                    if (resultat.length != 0) {
                        $.each(resultat, function (i, val) {
                            $(".localite").append(
                                "<option value='" +
                                    val.id +
                                    "'>" +
                                    val.localite +
                                    "</option>"
                            );
                        });
                    } else {
                        $(".localite").empty();
                        $(".localite").append(
                            "<option value=''> Pas de localité pour cette commune </option>"
                        );
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur d.");
                },
            });
        }
    });

    $(".dept").on("change", function () {
        var dept = $(this).val();
        //        alert(comm);
        if (dept == "null") {
            $(".commune_choice").empty();
            $(".localite").empty();
        } else {
            $.ajax({
                type: "GET",
                url: base_url + "/showcom/" + dept,
                dataType: "json",
                success: function (resultat) {
                    $(".commune_choice").empty();
                    $(".commune_choice").append(
                        "<option value='null'> Choisissez une commune </option>"
                    );
                    if (resultat.length != 0) {
                        $.each(resultat, function (i, val) {
                            $(".commune_choice").append(
                                "<option value='" +
                                    val.id +
                                    "'> " +
                                    val.commune +
                                    " </option>"
                            );
                        });
                    } else {
                        $(".commune_choice").empty();
                        $(".commune_choice").append(
                            "<option value=''> Pas de commune pour ce département </option>"
                        );
                    }
                },
                error: function () {
                    alert("Erreur, merci de contacter l'administrateur .");
                },
            });
        }
    });

    $("#type_intrant").on("change", function () {
        var type_intrant = $(this).val();
        switch (type_intrant) {
            case "1": //engrais
                $("#prod_div").show();
                break;

            case "2": //semence
                $("#prod_div").show();
                break
            default:
                $("#prod_div").hide();


                break;
        }
    });

    $.ajax({
        type: "GET",
        url: base_url + "/produit",
        dataType: "json",
        success: function (resultat) {
            $(".produit_choice").empty();
            $(".produit_choice").append(
                "<option value='null'> Choisissez un produit </option>"
            );
            if (resultat.length != 0) {
                $.each(resultat, function (i, val) {
                    $(".produit_choice").append(
                        "<option value='" +
                            val.id +
                            "'> " +
                            val.produit +
                            " </option>"
                    );
                });
            } else {
                $(".produit_choice").empty();
                $(".produit_choice").append(
                    "<option value=''> Pas de produits </option>"
                );
            }
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur .");
        },
    });

    return false;
});
