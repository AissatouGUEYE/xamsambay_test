$(document).ready(function() {
    let my_url = jQuery('meta[name="url"]').attr("content");
    // alert(my_url)
    id = $("#id_user").val();
    id_entite = $("#id_entite").val();
    id_profil = $("#id_profil").val();
    id_groupement = $("#id_groupement").val();
    role = jQuery('meta[name="role"]').attr("content");
    // alert(role);

    // Prévisions

    // var yearPrevision = $("#yearPrevision").val();

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/prevision/stats/2023",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            dataUsers = [];
            for (const key in resultat) {
                dataUsers.push(resultat[key]);
            }
            var lineChartUsersCTX = $("#users");
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
                datasets: [{
                    label: "Prévisions/Mois",
                    data: dataUsers,
                    fill: false,
                    borderColor: "cyan",
                    tension: 0.1,
                }, ],
            };
            UsersConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartUsersCTX, UsersConfig);
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 10");
                location.reload();
            }
        },
    });


    $("#yearPrevision").on("change", function() {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/prevision/stats/" + annee,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                dataUsers = [];
                for (const key in resultat) {
                    dataUsers.push(resultat[key]);
                }
                var lineChartUsersCTX = $("#users");
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
                    datasets: [{
                        label: "Prévisions/Mois",
                        data: dataUsers,
                        fill: false,
                        borderColor: "cyan",
                        tension: 0.1,
                    }, ],
                };
                UsersConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartUsersCTX, UsersConfig);
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 10");
                    location.reload();
                }
            },
        });
        // collecte
    });


    //productions

    if (role === "OP" || role === "UOP" || role === "AUOP") {
        url_prod =
            my_url + "/production/stats/entite/reseau/null/" + id_groupement;
    } else {
        if (role === "ONG") {
            url_prod =
                my_url +
                "/production/stats/entite/reseau/" +
                id_entite +
                "/null";
        }
    }
    // /production/stats/entite/reseau/1/null
    if (role === "OP" || role === "UOP" || role === "AUOP" || role === "ONG") {
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: url_prod,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                labels = [];
                dataProd = [];
                // resultat=resultat[0];
                // alert(resultat.length)
                for (let index = 0; index < resultat.length; index++) {
                    // alert(resultat[index].quantite_totale);
                    labels.push(resultat[index].produit);
                    dataProd.push(resultat[index].quantite_totale);
                }
                // alert(labels);

                var lineChartProductionCTX = $(
                    "#revenue-line-chart-production"
                );
                dataLineV = {
                    labels: labels,
                    datasets: [{
                        label: "Stock/produit",
                        data: dataProd,
                        fill: false,
                        backgroundColor: [
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
                        ],
                    }, ],
                };
                ProductionConfig = {
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
                    lineChartProductionCTX,
                    ProductionConfig
                );
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                }
            },
        });
    }



    // var anneeCollecte = $("#yearCollecte").val();
    // alert(anneeCollecte);
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/mlcollecte/stat/2023",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {

            labels_prod = [];
            dataProd = [];

            for (const key in resultat) {
                labels_prod.push(key);
                dataProd.push(resultat[key]);
                // console.log(key + " => " + resultat[key]);
            }

            // alert(labels);

            var lineChartProductionCTX = $(
                "#revenue-line-chart-production-admin"
            );
            dataLineV = {
                labels: labels_prod,
                datasets: [{
                    label: "Cumul/Région",
                    data: dataProd,
                    fill: false,
                    backgroundColor: [
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
                    ],
                }, ],
            };
            ProductionConfig = {
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
                lineChartProductionCTX,
                ProductionConfig
            );
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 7");
            }
        },
    });

    $("#yearCollecte").on("change", function() {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/mlcollecte/stat/" + annee,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {

                labels_prod = [];
                dataProd = [];

                for (const key in resultat) {
                    labels_prod.push(key);
                    dataProd.push(resultat[key]);
                    // console.log(key + " => " + resultat[key]);
                }

                // alert(labels);

                var lineChartProductionCTX = $(
                    "#revenue-line-chart-production-admin"
                );
                dataLineV = {
                    labels: labels_prod,
                    datasets: [{
                        label: "Cumul/Région",
                        data: dataProd,
                        fill: false,
                        backgroundColor: [
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
                        ],
                    }, ],
                };
                ProductionConfig = {
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
                    lineChartProductionCTX,
                    ProductionConfig
                );
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                }
            },
        });

    });

    // //production/ong
    $("#list_ong").on("change", function() {
        var ong = $(this).val();
        //    alert(ong);
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/production/stats/entite/reseau/" + ong + "/null",
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                labels = [];
                dataProd = [];
                // resultat=resultat[0];
                // alert(resultat.length)
                for (let index = 0; index < resultat.length; index++) {
                    // alert(resultat[index].quantite_totale);
                    labels.push(resultat[index].produit);
                    dataProd.push(resultat[index].quantite_totale);
                }
                // alert(labels);

                var lineChartProductionCTX = $(
                    "#revenue-line-chart-production-admin"
                );
                dataLineV = {
                    labels: labels,
                    datasets: [{
                        label: "Stock/produit",
                        data: dataProd,
                        fill: false,
                        backgroundColor: [
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
                        ],
                    }, ],
                };
                ProductionConfig = {
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
                    lineChartProductionCTX,
                    ProductionConfig
                );
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                }
            },
        });
    });

    $("yearU").on("change", function() {
        var annee = $(this).val();
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/users/inscription/stats/" + annee,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                dataUsers = [];
                for (const key in resultat) {
                    dataUsers.push(resultat[key]);
                }
                var lineChartUsersCTX = $("#users");
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
                    datasets: [{
                        label: "Inscription/mois",
                        data: dataUsers,
                        fill: false,
                        borderColor: "cyan",
                        tension: 0.1,
                    }, ],
                };
                UsersConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartUsersCTX, UsersConfig);
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 26");
                }
            },
        });
    });

    // alertes  pour l'annee en cours

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/sms/month_stat_data/2/null/" + id_entite + "/2022",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            var lineChartAlerteAdminCTX = $("#revenue-line-chart-alerte");
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
                datasets: [{
                    label: "alerte/mois",
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
                }, ],
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
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 100");
            }
        },
    });

    //voice sms

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/envoi/stat_data/2/" + id + "/" + id_entite,
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            // alert(resultat[0].nombre_voice)

            $("#nb_voice").empty();
            $("#nb_voice").append(resultat[0].nombre_voice);

            $("#nb_sms").empty();
            $("#nb_sms").append(resultat[0].nombre_sms);
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 27");
            }
        },
    });

    //collecte

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
        url: my_url + "/sms/month_stat_data/4/null/" + id_entite + "/" + 2022,
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            // alert(resultat[1])
            var lineChartCollecteCTX = $("#revenue-line-chart-collecte-admin");
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
                datasets: [{
                    label: "collecte/mois",
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
                    borderColor: "orange",
                    tension: 1,
                }, ],
            };
            CollecteConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartCollecteCTX, CollecteConfig);
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 29");
            }
        },
    });

    //prevision

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/sms/month_stat_data/3/null/" + id_entite + "/" + 2022,
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            var lineChartPrevisionCTX = $(
                "#revenue-line-chart-prevision-admin"
            );
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
                datasets: [{
                    label: "prevision/mois",
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
                    borderColor: "orange",
                    tension: 1,
                }, ],
            };
            PrevisionConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartPrevisionCTX, PrevisionConfig);
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 29");
            }
        },
    });

    // alert selon  l'annee renseigne

    $("#yearAA").on("change", function() {
        var annee = $(this).val();
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url +
                "/sms/month_stat_data/2/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                var lineChartAlerteAdminCTX = $("#revenue-line-chart-alerte");
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
                    datasets: [{
                        label: "alerte/mois",
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
                    }, ],
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
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 30");
                }
            },
        });
    });

    //info climatik selon l'annee

    $("#yearCA").on("change", function() {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
            url: my_url +
                "/sms/month_stat_data/4/null/" +
                id_entite +
                "/" +
                2022,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                // alert(resultat[1])
                var lineChartCollecteCTX = $(
                    "#revenue-line-chart-collecte_admin"
                );
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
                    datasets: [{
                        label: "collecte/mois",
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
                        borderColor: "orange",
                        tension: 1,
                    }, ],
                };
                CollecteConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(
                    lineChartCollecteCTX,
                    CollecteConfig
                );
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 31");
                }
            },
        });

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url +
                "/sms/month_stat_data/3/null/" +
                id_entite +
                "/" +
                2022,
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function(resultat) {
                var lineChartPrevisionCTX = $(
                    "#revenue-line-chart-prevision_admin"
                );
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
                    datasets: [{
                        label: "prevision/mois",
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
                        borderColor: "orange",
                        tension: 1,
                    }, ],
                };
                PrevisionConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(
                    lineChartPrevisionCTX,
                    PrevisionConfig
                );
            },
            error: function() {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 32");
                }
            },
        });
    });

    //eb
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/eb/stats/null",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            // alert(resultat[0].nb_eb_valides)
            var pieChartBesoinAdminCTX = $("#pie-besoin-admin");

            const dataBesoinsAdmin = {
                labels: ["Valide", "Non Valide"],
                datasets: [{
                    label: "Dataset 1",
                    data: [
                        resultat[0].nb_eb_valides,
                        resultat[0].nb_eb_non_valides,
                    ],
                    backgroundColor: ["green", "orange"],
                }, ],
            };
            const pieChartBesoinAdminConfig = {
                type: "pie",
                data: dataBesoinsAdmin,
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
            var piechart = new Chart(
                pieChartBesoinAdminCTX,
                pieChartBesoinAdminConfig
            );
        },
    });

    //TRANSPORT
    var lineChartTransportCTX = $("#revenue-line-chart-transport");
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
        datasets: [{
            label: "Transport/mois",
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            fill: false,
            borderColor: "orange",
            tension: 1,
        }, ],
    };
    TransportConfig = {
        type: "line",
        data: dataLineV,
    };

    var linechartV = new Chart(lineChartTransportCTX, TransportConfig);

    //transport/regions

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",

        url: my_url + "/regions",
        headers: {
            Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function(resultat) {
            // alert(resultat);
            labels = [];
            $.each(resultat, function(i, val) {
                // alert(val.region)
                labels.push(val.region);
            });

            var lineChartTransLocCTX = $("#transport-by-localite");
            dataLineV = {
                labels: labels,
                datasets: [{
                    label: "transport/regions",
                    data: [10, 0, 60, 0, 20, 0, 0, 0, 90, 0, 0, 0],
                    fill: false,
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
                }, ],
            };
            TransByLocConfig = {
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

            var linechartV = new Chart(lineChartTransLocCTX, TransByLocConfig);
        },
        error: function() {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 33");
            }
        },
    });

    //producteurs/organisation
    var lineChartProducteurOrgCTX = $(".prod-by-organisation");
    dataLineV = {
        labels: ["meda", "takalei", "org1", "org2", "org3"],
        datasets: [{
            label: "prod/org",
            data: [10, 9, 30, 90, 200],
            fill: false,
            backgroundColor: [
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
            ],
        }, ],
    };
    ProducteurOrgConfig = {
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

    var linechartV = new Chart(lineChartProducteurOrgCTX, ProducteurOrgConfig);

    //offre de credit

    var lineChartAgenceCTX = $("#agences_banques");
    dataLineAgence = {
        labels: [
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
        ],
        datasets: [{
            label: "credit/mois",
            data: [7, 9, 10, 9, 5, 11, 12, 12, 9, 16, 10, 11],
            fill: false,
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
        }, ],
    };
    AgenceConfig = {
        type: "bar",
        data: dataLineAgence,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    var linechartV = new Chart(lineChartAgenceCTX, AgenceConfig);

    //declaration sinistre

    var lineChartSinistreCTX = $("#dec-by-sinistres");
    dataLineSinistre = {
        labels: [
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
        ],
        datasets: [{
            label: "declaration/mois",
            data: [7, 9, 10, 9, 5, 11, 12, 12, 9, 16, 10, 11],
            fill: false,
            borderColor: "cyan",
            tension: 0.1,
        }, ],
    };
    SinistreConfig = {
        type: "line",
        data: dataLineSinistre,
    };

    var linechartV = new Chart(lineChartSinistreCTX, SinistreConfig);
});