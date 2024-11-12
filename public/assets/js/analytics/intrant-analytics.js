$(document).ready(function () {
    $("#profil_ferme_div").hide();
    let my_url = jQuery('meta[name="url"]').attr("content");
    let id_profil = jQuery('meta[name="id_profil"]').attr("content");

    var entite = -1;
    var tab_fia = [];
    var tab_fia_count = [];

    var tab_fia_dist = [];
    var tab_fia_dist_count = [];

    var tab_cc = [];
    var tab_cc_count = [];

    var tab_cc_dist=[];
    var tab_cc_dist_count=[]

    $.ajax({
        type: "GET",
        url: my_url + "/fia_communes_list",
        dataType: "json",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },

        success: function (resultat) {
            $.each(resultat, function (i, val) {
                tab_fia.push(val.nom_fia);
                tab_fia_count.push(val.nombre_communes);
            });
            var lineChartAlerteAdminCTX = $(".fia-by-commune");
            labels = tab_fia;
            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "FIA/communes",
                        data: tab_fia_count,
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
                    },
                ],
            };
            AlerteAdminConfig = {
                type: "bar",
                data: dataLineV,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            };

            var linechartV = new Chart(
                lineChartAlerteAdminCTX,
                AlerteAdminConfig
            );
        },
        error: function () {},
    });

    $.ajax({
        type: "GET",
        url: my_url + "/fia_dist_list",
        dataType: "json",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },

        success: function (resultat) {
            $.each(resultat, function (i, val) {
                tab_fia_dist.push(val.nom_fia);
                tab_fia_dist_count.push(val.nombre_dist);
            });
            var lineChartAlerteAdminCTX = $(".fia-by-distribution");
            labels = tab_fia_dist;
            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "FIA/distribution",
                        data: tab_fia_dist_count,
                        backgroundColor: [
                          
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 205, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 205, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                        ],
                        borderColor: [
                          
                            "rgb(153, 102, 255)",
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                            "rgb(75, 192, 192)",
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                        ],
                    },
                ],
            };
            AlerteAdminConfig = {
                type: "bar",
                data: dataLineV,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            };

            var linechartV = new Chart(
                lineChartAlerteAdminCTX,
                AlerteAdminConfig
            );
        },
        error: function () {},
    });

    $.ajax({
        type: "GET",
        url: my_url + "/commission_dist_list",
        dataType: "json",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },

        success: function (resultat) {
            $.each(resultat, function (i, val) {
                tab_cc.push(val.nom_entite);
                tab_cc_count.push(val.nombre_dist);
            });
            var lineChartAlerteAdminCTX = $(".cc-by-distribution");
            labels = tab_cc;
            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "Point de chute/distribution",
                        data: tab_cc_count,
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
                    },
                ],
            };
            AlerteAdminConfig = {
                type: "bar",
                data: dataLineV,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            };

            var linechartV = new Chart(
                lineChartAlerteAdminCTX,
                AlerteAdminConfig
            );
        },
        error: function () {},
    });

    $.ajax({
        type: "GET",
        url: my_url + "/distributions/cc/stat/"+id_profil,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {

            // console.log(Object.values(resultat));
            // resultat=JSON.stringify(resultat)

            var lineChartVenteCTX = $("#stat-distribution-cc");
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
                        label: "quantite_reception/mois",
                        data:Object.values(resultat),
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
            // alert("Erreur, merci de contacter l'administrateur 25.");
        },
    });

    $.ajax({
        type: "GET",
        url: my_url + "/receptions/cc/stat/"+id_profil,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {

            // console.log(Object.values(resultat));
            // resultat=JSON.stringify(resultat)

            var lineChartVenteCTX = $("#stat-reception-cc");
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
                        label: "quantite_distribuee/mois",
                        data:Object.values(resultat),
                        fill: false,
                        borderColor: "rgba(255, 159, 64)",
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
            // alert("Erreur, merci de contacter l'administrateur 25.");
        },
    });

    $.ajax({
        type: "GET",
        url: my_url + "/receptions/op/stat/"+id_profil,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {

            // console.log(Object.values(resultat));
            // resultat=JSON.stringify(resultat)

            var lineChartVenteCTX = $("#stat-reception-op");
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
                        label: "quantite_distribuee/mois",
                        data:Object.values(resultat),
                        fill: false,
                        borderColor: "rgba(255, 159, 64)",
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
            // alert("Erreur, merci de contacter l'administrateur 25.");
        },
    });
});
