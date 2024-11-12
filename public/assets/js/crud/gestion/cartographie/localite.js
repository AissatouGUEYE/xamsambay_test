$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')
        // alert('OKOKOK');

    $.ajax({
        type: "GET",
        url: base_url + "/regions",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            if (resultat.length != 0) {

                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].region)
                    $("#reg").append("<option value='" + resultat[i].id + "'> " + resultat[i].region + " </option>");

                }
                // });
            } else {
                $("#reg").empty();
                $("#reg").append("<option value=''> Pas de Région </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#reg").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        if (reg !== 'all') {

            $.ajax({
                type: "GET",
                url: base_url + "/showdep/" + reg,
                dataType: "json",
                success: function(resultat) {

                    $("#dept").empty();
                    $("#commune").empty();
                    $("#localite").empty();
                    $("#dept").append("<option value=''> Choisissez le département </option>");
                    $("#dept").append("<option value='all' > Tous les Départements </option>");

                    if (resultat.length != 0) {
                        $.each(resultat, function(i, val) {
                            $("#dept").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                        });
                    } else {
                        $("#dept").empty();
                        $("#dept").append("<option value=''> Pas de département pour cette région </option>");
                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });

        } else {
            $("#dept").empty();
            $("#commune").empty();
            $("#localite").empty();
        }

    });


    $("#dept").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);

        if (dept !== 'all') {
            $.ajax({
                type: "GET",
                url: base_url + "/showcom/" + dept,
                dataType: "json",
                success: function(resultat) {
                    $("#commune").empty();
                    $("#localite").empty();
                    $("#commune").append("<option value=''> Choisissez une commune </option>");
                    $("#commune").append("<option value='all' > Toutes les Communes </option>");

                    if (resultat.length != 0) {
                        $.each(resultat, function(i, val) {
                            $("#commune").append("<option value='" + val.id + "'> " + val.commune + " </option>");

                        });
                    } else {
                        $("#commune").empty();
                        $("#commune").append("<option value=''> Pas de commune pour cette localité </option>");

                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur .");
                }
            });
        } else {
            $("#commune").empty();
            $("#localite").empty();
        }
    });

    $("#commune").on("change", function() {
        var commune = $(this).val();
        //        alert(comm);

        if (commune !== 'all') {

            $.ajax({
                type: "GET",
                url: base_url + "/showloc/" + commune,
                dataType: "json",
                success: function(resultat) {

                    $("#localite").empty();
                    $("#localite").append("<option value=''> Choisissez une localité </option>");
                    $("#localite").append("<option value='all' > Toutes les Localités </option>");

                    if (resultat.length != 0) {
                        $.each(resultat, function(i, val) {
                            $("#localite").append("<option value='" + val.id + "'>" + val.localite + "</option>");

                        });
                    } else {
                        $("#localite").empty();
                        $("#localite").append("<option value=''> Pas de localité pour cette commune </option>");

                    }
                },
                error: function() {
                    alert("Erreur, merci de contacter l'administrateur d.");
                }
            });

        } else {
            $("#localite").empty();
        }

    });



});