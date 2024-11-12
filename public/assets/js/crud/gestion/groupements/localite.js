$(document).ready(function() {

    var base_url = $('meta[name="url"]').attr('content')


    $.ajax({
        type: "GET",
        url: base_url + "/pays",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            // $(".pays").append("<option value='"+resultat[0].id+"'>"+resultat[0].pays+"</option>");
            // alert(resultat[0].id)


            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#pays").append("<option value='" + resultat[i].id + "'> " + resultat[i].pays + " </option>");

                }
                // });
            } else {
                $("#pays").empty();
                $("#pays").append("<option value=''> Pas de pays </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#pays").on("change", function() {

        var pays = $(this).val();
        // alert(pays)
        $.ajax({
            type: "GET",
            url: base_url + "/showreg/" + pays,
            dataType: "json",
            success: function(resultat) {
                // alert(resultat.nom_dept)
                $("#region").empty();
                $("#region").append("<option value=''>Choisissez une region </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#region").append("<option value='" + val.id + "'> " + val.region + " </option>");
                    });
                } else {
                    $("#region").empty();
                    $("#region").append("<option value=''> Pas de département pour ce département </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#region").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        $.ajax({
            type: "GET",
            url: base_url + "/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept").empty();
                $("#dept").append("<option value=''> Choisissez le département </option>");

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
    });


    $("#dept").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune").empty();
                $("#commune").append("<option value=''> Choisissez une commune </option>");

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
    });

    $("#commune").on("change", function() {
        var commune = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showloc/" + commune,
            dataType: "json",
            success: function(resultat) {
                $("#localite").empty();
                $("#localite").append("<option value=''> Choisissez une localité </option>");

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
    });


















    //AUOP

    $.ajax({
        type: "GET",
        url: base_url + "/pays",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            // $(".pays").append("<option value='"+resultat[0].id+"'>"+resultat[0].pays+"</option>");
            // alert(resultat[0].id)


            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#pays1").append("<option value='" + resultat[i].id + "'> " + resultat[i].pays + " </option>");

                }
                // });
            } else {
                $("#pays1").empty();
                $("#pays1").append("<option value=''> Pas de pays </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#pays1").on("change", function() {

        var pays = $(this).val();
        // alert(pays)
        $.ajax({
            type: "GET",
            url: base_url + "/showreg/" + pays,
            dataType: "json",
            success: function(resultat) {
                // alert(resultat.nom_dept)
                $("#region1").empty();
                $("#region1").append("<option value=''>Choisissez une region </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#region1").append("<option value='" + val.id + "'> " + val.region + " </option>");
                    });
                } else {
                    $("#region1").empty();
                    $("#region1").append("<option value=''> Pas de département pour ce département </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#region1").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        $.ajax({
            type: "GET",
            url: base_url + "/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept1").empty();
                $("#dept1").append("<option value=''> Choisissez le département </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#dept1").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                    });
                } else {
                    $("#dept1").empty();
                    $("#dept1").append("<option value=''> Pas de département pour cette région </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


    $("#dept1").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune1").empty();
                $("#commune1").append("<option value=''> Choisissez une commune </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#commune1").append("<option value='" + val.id + "'> " + val.commune + " </option>");

                    });
                } else {
                    $("#commune1").empty();
                    $("#commune1").append("<option value=''> Pas de commune pour cette localité </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });

        $.ajax({
            type: "GET",
            url: base_url + "/mlpluvio/departement/" + dept,
            headers: {
                'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
            },
            dataType: "json",
            success: function(resultat) {

                $("#pluvio").empty();
                $("#pluvio").append("<option value=''> Choisissez Un Pluvio </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        // alert(val.id);
                        $("#pluvio").append("<option value='" + val.id + "'>" + val.localite + "</option>");

                    });
                } else {
                    $("#pluvio").empty();
                    $("#pluvio").append("<option value=''> Pas de Pluvio pour ce Département </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur d.");
            }
        });

    });

    $("#commune1").on("change", function() {
        var commune = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showloc/" + commune,
            dataType: "json",
            success: function(resultat) {
                $("#localite1").empty();
                $("#localite1").append("<option value=''> Choisissez une localité </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#localite1").append("<option value='" + val.id + "'>" + val.localite + "</option>");

                    });
                } else {
                    $("#localite1").empty();
                    $("#localite1").append("<option value=''> Pas de localité pour cette commune </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur d.");
            }
        });
    });


    // $("#dept1").on("change", function() {
    //     var dept = $(this).val();
    //     $.ajax({
    //         type: "GET",
    //         url: base_url + "/mlpluvio/departement/" + dept,
    //         dataType: "json",
    //         success: function(resultat) {
    //             if (resultat.length != 0) {
    //                 $.each(resultat, function(i, val) {
    //                     $("#pluvio").append("<option value='" + val.id + "'>" + val.localite + "</option>");

    //                 });
    //             } else {
    //                 $("#pluvio").empty();
    //                 $("#pluvio").append("<option value=''> Pas de pluvio pour ce département </option>");

    //             }
    //         },
    //         error: function() {
    //             alert("Erreur, merci de contacter l'administrateur d.");
    //         }
    //     });
    // });




    //UOP



    $.ajax({
        type: "GET",
        url: base_url + "/pays",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            // $(".pays").append("<option value='"+resultat[0].id+"'>"+resultat[0].pays+"</option>");
            // alert(resultat[0].id)


            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#pays2").append("<option value='" + resultat[i].id + "'> " + resultat[i].pays + " </option>");

                }
                // });
            } else {
                $("#pays2").empty();
                $("#pays2").append("<option value=''> Pas de pays </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#pays2").on("change", function() {

        var pays = $(this).val();
        // alert(pays)
        $.ajax({
            type: "GET",
            url: base_url + "/showreg/" + pays,
            dataType: "json",
            success: function(resultat) {
                // alert(resultat.nom_dept)
                $("#region2").empty();
                $("#region2").append("<option value=''>Choisissez une region </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#region2").append("<option value='" + val.id + "'> " + val.region + " </option>");
                    });
                } else {
                    $("#region2").empty();
                    $("#region2").append("<option value=''> Pas de département pour ce département </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#region2").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        $.ajax({
            type: "GET",
            url: base_url + "/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept2").empty();
                $("#dept2").append("<option value=''> Choisissez le département </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#dept2").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                    });
                } else {
                    $("#dept2").empty();
                    $("#dept2").append("<option value=''> Pas de département pour cette région </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


    $("#dept2").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune2").empty();
                $("#commune2").append("<option value=''> Choisissez une commune </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#commune2").append("<option value='" + val.id + "'> " + val.commune + " </option>");

                    });
                } else {
                    $("#commune2").empty();
                    $("#commune2").append("<option value=''> Pas de commune pour cette localité </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#commune2").on("change", function() {
        var commune = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showloc/" + commune,
            dataType: "json",
            success: function(resultat) {
                $("#localite2").empty();
                $("#localite2").append("<option value=''> Choisissez une localité </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#localite2").append("<option value='" + val.id + "'>" + val.localite + "</option>");

                    });
                } else {
                    $("#localite2").empty();
                    $("#localite2").append("<option value=''> Pas de localité pour cette commune </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur d.");
            }
        });
    });








    //OP



    $.ajax({
        type: "GET",
        url: base_url + "/pays",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            // $(".pays").append("<option value='"+resultat[0].id+"'>"+resultat[0].pays+"</option>");
            // alert(resultat[0].id)


            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#pays3").append("<option value='" + resultat[i].id + "'> " + resultat[i].pays + " </option>");

                }
                // });
            } else {
                $("#pays3").empty();
                $("#pays3").append("<option value=''> Pas de pays </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });

    $("#pays3").on("change", function() {

        var pays = $(this).val();
        // alert(pays)
        $.ajax({
            type: "GET",
            url: base_url + "/showreg/" + pays,
            dataType: "json",
            success: function(resultat) {
                // alert(resultat.nom_dept)
                $("#region3").empty();
                $("#region3").append("<option value=''>Choisissez une region </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#region3").append("<option value='" + val.id + "'> " + val.region + " </option>");
                    });
                } else {
                    $("#region3").empty();
                    $("#region3").append("<option value=''> Pas de département pour ce département </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#region3").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        $.ajax({
            type: "GET",
            url: base_url + "/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept3").empty();
                $("#dept3").append("<option value=''> Choisissez le département </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#dept3").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                    });
                } else {
                    $("#dept3").empty();
                    $("#dept3").append("<option value=''> Pas de département pour cette région </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


    $("#dept3").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune3").empty();
                $("#commune3").append("<option value=''> Choisissez une commune </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#commune3").append("<option value='" + val.id + "'> " + val.commune + " </option>");

                    });
                } else {
                    $("#commune3").empty();
                    $("#commune3").append("<option value=''> Pas de commune pour cette localité </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    $("#commune3").on("change", function() {
        var commune = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url + "/showloc/" + commune,
            dataType: "json",
            success: function(resultat) {
                $("#localite3").empty();
                $("#localite3").append("<option value=''> Choisissez une localité </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#localite3").append("<option value='" + val.id + "'>" + val.localite + "</option>");

                    });
                } else {
                    $("#localite3").empty();
                    $("#localite3").append("<option value=''> Pas de localité pour cette commune </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur d.");
            }
        });
    });



});
