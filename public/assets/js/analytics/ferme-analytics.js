$(document).ready(function () {

    let my_url = jQuery('meta[name="url"]').attr("content");
    let ferme = jQuery('meta[name="ferme"]').attr("content");
    // alert(ferme);
    
    //nb produits
    $.ajax({
        type: "GET",
        url: my_url +"/ferme/produits/nombre_produits/"+ ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat[0].nombre_produits);
            $("#nbProd").empty();
            $("#nbProd").append(resultat[0].nombre_produits);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur nb_prod_ferme .");
        },
    });

    //solde vente

    $.ajax({
        type: "GET",
        url: my_url +"/ferme/caisse/ferme_ventes/somme/"+ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#soldeVente").empty();
            $("#soldeVente").append(resultat);
            $("#soldeVente").append(" FCFA");
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 21 .");
        },
    });


    //solde banque 
    $.ajax({
        type: "GET",
        url: my_url +"/ferme/caisse/ferme_banque/somme/"+ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#soldeBanque").empty();
            $("#soldeBanque").append(resultat);
            $("#soldeBanque").append(" FCFA");
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 210 .");
        },
    });

    //solde decaissement

    $.ajax({
        type: "GET",
        url: my_url +"/ferme/caisse/ferme_decaissements/somme/"+ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#soldeDec").empty();
            $("#soldeDec").append(resultat);
            $("#soldeDec").append(" FCFA");
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 22 .");
        },
    });

    //nb besoins valides
    $.ajax({
        type: "GET",
        url: my_url +"/ferme/eb_validees/" + ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat);
            $("#nbBesoin").empty();
            $("#nbBesoin").append(resultat);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 23.");
        },
    });

    //top 5 produits

    $.ajax({
        type: "GET",
        url: my_url +"/ferme/vente/produits/ferme_top_five/2022/"+ ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            if (resultat.length > 0) {
                for (let index = 0; index < resultat.length; index++) {
                    let indice = index + 1;
                    $("#prod" + indice).empty();
                    $("#prod" + indice).append(resultat[index].produit);
                    $("#som" + indice).empty();
                    $("#som" + indice).append(resultat[index].total);
                }
            } else {
                for (let index = 0; index < 5; index++) {
                    let indice = index + 1;
                    $("#prod" + indice).empty();
                    $("#prod" + indice).append("-");
                    $("#som" + indice).empty();
                    $("#som" + indice).append("-");
                }
            }
            // alert(resultat[0].produit);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 24.");
        },
    });

    //diagramme vente/mois

    $.ajax({
        type: "GET",
        url:
            my_url +"/ferme/vente/get/ferme_total_vente_mois/" +ferme +"?annee=" +
            2022,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // resultat=JSON.stringify(resultat)

            var lineChartVenteCTX = $("#revenue-line-chart-vente");
            labels = [
                "Janvier",
                "Fevrier",
                "Mars",
                "Avril",
                "Mai",
                "Juin",
                "Juillet",
                "Aout",
                "Septembre",
                "Octobre",
                "Novembre",
                "Decembre",
            ];
            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "vente/mois",
                        data: [
                            resultat[1],
                            resultat[2],
                            resultat[3],
                            resultat[4],
                            resultat[5],
                            resultat[6],
                            resultat[7],
                            resultat[8],
                            resultat[9],
                            resultat[10],
                            resultat[11],
                            resultat[12],
                        ],
                        fill: false,
                        borderColor: "rgb(75, 192, 192)",
                        tension: 0.1,
                    },
                ],
            };
            venteConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartVenteCTX, venteConfig);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 25.");
        },
    });

    $("#year").on("change", function () {
        var annee = $(this).val();
        // alert(annee);
        $.ajax({
            type: "GET",
            url:
                my_url +"/ferme/vente/get/ferme_total_vente_mois/" +ferme +"?annee=" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // resultat=JSON.stringify(resultat)

                var lineChartVenteCTX = $("#revenue-line-chart-vente");
                labels = [
                    "Janvier",
                    "Fevrier",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Aout",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Decembre",
                ];
                dataLineV = {
                    labels: labels,
                    datasets: [
                        {
                            label: "vente/mois",
                            data: [
                                resultat[1],
                                resultat[2],
                                resultat[3],
                                resultat[4],
                                resultat[5],
                                resultat[6],
                                resultat[7],
                                resultat[8],
                                resultat[9],
                                resultat[10],
                                resultat[11],
                                resultat[12],
                            ],
                            fill: false,
                            borderColor: "rgb(75, 192, 192)",
                            tension: 0.1,
                        },
                    ],
                };
                venteConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartVenteCTX, venteConfig);
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur 26.");
            },
        });

        //pour les produits

        $.ajax({
            type: "GET",
            url:
                my_url +"/ferme/vente/produits/ferme_top_five/" +
                annee + "/"+ ferme,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                if (resultat.length > 0) {
                    for (let index = 0; index < resultat.length; index++) {
                        let indice = index + 1;
                        $("#prod" + indice).empty();
                        $("#prod" + indice).append(resultat[index].produit);
                        $("#som" + indice).empty();
                        $("#som" + indice).append(resultat[index].total);
                    }
                    
                } else {
                    for (let index = 0; index < 5; index++) {
                        let indice = index + 1;
                        $("#prod" + indice).empty();
                        $("#prod" + indice).append("-");
                        $("#som" + indice).empty();
                        $("#som" + indice).append("-");
                    }
                }
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur 27.");
            },
        });
    });

    //diag besoins traite /non traite

    $.ajax({
        type: "GET",
        url: my_url +"/ferme/stat_eb_actifs/"+ ferme,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            var pieChartBesoinCTX = $("#pie");
            const DATA_COUNT = 2;
            const dataBesoins = {
                labels: ["Traite", "Non traite"],
                datasets: [
                    {
                        label: "Dataset 1",
                        data: [resultat.payes, resultat.non_payes],
                        backgroundColor: ["green", "orange"],
                    },
                ],
            };
            const pieChartBesoinconfig = {
                type: "pie",
                data: dataBesoins,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        title: {
                            display: true,
                            text: "Chart.js Pie Chart",
                        },
                    },
                },
            };
            var piechart = new Chart(pieChartBesoinCTX, pieChartBesoinconfig);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 28 .");
        },
    });

    // barre decaissemnet
    // par defaut

    $.ajax({
        type: "GET",
        url:
            my_url +"/ferme/ferme_decaissements/get/total_decaissements_mois/" +ferme +"?annee="+
            2022,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // resultat=JSON.stringify(resultat)

            var barreChartBesoinCTX = $("#barre");
            const labelsDec = [
                "Janvier",
                "Fevrier",
                "Mars",
                "Avril",
                "Mai",
                "Juin",
                "Juillet",
                "Aout",
                "Septembre",
                "Octobre",
                "Novembre",
                "Decembre",
            ];
            const dataDec = {
                labels: labelsDec,
                datasets: [
                    {
                        label: "Decaissement/mois",
                        data: [
                            resultat[1],
                            resultat[2],
                            resultat[3],
                            resultat[4],
                            resultat[5],
                            resultat[6],
                            resultat[7],
                            resultat[8],
                            resultat[9],
                            resultat[10],
                            resultat[11],
                            resultat[12],
                        ],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 205, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 205, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                        ],
                        borderColor: [
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                            "rgb(153, 102, 255)",
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                            "rgb(75, 192, 192)",
                        ],
                        //   borderWidth: 1,
                    },
                ],
            };

            const configDec = {
                type: "bar",
                data: dataDec,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            };

            var barchart = new Chart(barreChartBesoinCTX, configDec);
        },
        error: function () {
            alert("Erreur, merci de contacter l'administrateur 29 .");
        },
    });

    // var my_year=$("#annee").val();
    // alert(my_year)

    $("#annee").on("change", function () {
        var annee = $(this).val();
        // alert(annee);
        $.ajax({
            type: "GET",
            url:
                my_url +"/ferme/ferme_decaissements/get/total_decaissements_mois/" +ferme +"?annee="+
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // resultat=JSON.stringify(resultat)

                var barreChartBesoinCTX = $("#barre");
                const labelsDec = [
                    "Janvier",
                    "Fevrier",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Aout",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Decembre",
                ];
                const dataDec = {
                    labels: labelsDec,
                    datasets: [
                        {
                            label: "Decaissement/mois",
                            data: [
                                resultat[1],
                                resultat[2],
                                resultat[3],
                                resultat[4],
                                resultat[5],
                                resultat[6],
                                resultat[7],
                                resultat[8],
                                resultat[9],
                                resultat[10],
                                resultat[11],
                                resultat[12],
                            ],
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(255, 159, 64, 0.2)",
                                "rgba(255, 205, 86, 0.2)",
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(54, 162, 235, 0.2)",
                                "rgba(153, 102, 255, 0.2)",
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(255, 159, 64, 0.2)",
                                "rgba(255, 205, 86, 0.2)",
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(54, 162, 235, 0.2)",
                                "rgba(255, 99, 132, 0.2)",
                            ],
                            borderColor: [
                                "rgb(255, 99, 132)",
                                "rgb(255, 159, 64)",
                                "rgb(255, 205, 86)",
                                "rgb(75, 192, 192)",
                                "rgb(54, 162, 235)",
                                "rgb(153, 102, 255)",
                                "rgb(255, 99, 132)",
                                "rgb(255, 159, 64)",
                                "rgb(255, 205, 86)",
                                "rgb(75, 192, 192)",
                                "rgb(54, 162, 235)",
                                "rgb(75, 192, 192)",
                            ],
                            //   borderWidth: 1,
                        },
                    ],
                };

                const configDec = {
                    type: "bar",
                    data: dataDec,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                };

                var barchart = new Chart(barreChartBesoinCTX, configDec);
            },
            error: function () {
                alert("Erreur, merci de contacter l'administrateur 30 .");
            },
        });
    });
});
