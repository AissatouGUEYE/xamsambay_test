$(document).ready(function() {

    var base_url =  $('meta[name="url"]').attr('content')

//FROM
    $.ajax({
        type: "GET",
        url: base_url+"/regions",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {
    
            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#region_pro").append("<option value='" + resultat[i].id + "'> " + resultat[i].region + " </option>");
    
                }
                // });
            } else {
                $("#region_pro").empty();
                $("#region_pro").append("<option value=''> Pas de région </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });
    
    
    $("#region_pro").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);
    
        $.ajax({
            type: "GET",
            url: base_url+"/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept_pro").empty();
                $("#dept_pro").append("<option value=''> Choisissez le département </option>");
    
                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#dept_pro").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                    });
                } else {
                    $("#dept_pro").empty();
                    $("#dept_pro").append("<option value=''> Pas de département pour cette région </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });
    
    
    $("#dept_pro").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url+"/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune_pro").empty();
                $("#commune_pro").append("<option value=''> Choisissez une commune </option>");
    
                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#commune_pro").append("<option value='" + val.id + "'> " + val.commune + " </option>");
    
                    });
                } else {
                    $("#commune_pro").empty();
                    $("#commune_pro").append("<option value=''> Pas de commune pour cette localité </option>");
    
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });
    
    
    
    //TO
    $.ajax({
        type: "GET",
        url: base_url+"/regions",
        dataType: "json",
        headers: {
            Authorization: "Bearer " + $('meta[name="token"]').attr('content')
        },
        success: function(resultat) {

            if (resultat.length != 0) {
                // $("#pays").append("<select id='icon_prefix13' name='region'></select>");
                // $.each(resultat, function(i, val){
                for (let i = 0; i < resultat.length; i++) {
                    // alert(resultat[i].pays)
                    $("#region_dest").append("<option value='" + resultat[i].id + "'> " + resultat[i].region + " </option>");

                }
                // });
            } else {
                $("#region_dest").empty();
                $("#region_dest").append("<option value=''> Pas de région </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur .");
        }
    });


    $("#region_dest").on("change", function() {
        var reg = $(this).val();
        //        alert(dept);

        $.ajax({
            type: "GET",
            url: base_url+"/showdep/" + reg,
            dataType: "json",
            success: function(resultat) {
                $("#dept_dest").empty();
                $("#dept_dest").append("<option value=''> Choisissez le département </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#dept_dest").append("<option value='" + val.id + "'> " + val.departement + " </option>");
                    });
                } else {
                    $("#dept_dest").empty();
                    $("#dept_dest").append("<option value=''> Pas de département pour cette région </option>");
                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


    $("#dept_dest").on("change", function() {
        var dept = $(this).val();
        //        alert(comm);
        $.ajax({
            type: "GET",
            url: base_url+"/showcom/" + dept,
            dataType: "json",
            success: function(resultat) {
                $("#commune_dest").empty();
                $("#commune_dest").append("<option value=''> Choisissez une commune </option>");

                if (resultat.length != 0) {
                    $.each(resultat, function(i, val) {
                        $("#commune_dest").append("<option value='" + val.id + "'> " + val.commune + " </option>");

                    });
                } else {
                    $("#commune_dest").empty();
                    $("#commune_dest").append("<option value=''> Pas de commune pour cette localité </option>");

                }
            },
            error: function() {
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });


});