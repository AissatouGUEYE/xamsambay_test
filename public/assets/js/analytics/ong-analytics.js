$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    // alert(my_url)
    id = $("#id_user").val();
    id_entite = $("#id_entite").val();
    id_profil = $("#id_profil").val();
    id_groupement = $("#id_groupement").val();
    role = jQuery('meta[name="role"]').attr("content");
    currentYear = new Date().getFullYear();z
    // alert(currentYear);
    // alert(role);
    // alert(id_entite)

    //stat users
    //nb boutique
    //requetes ADMIN

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/boutiques/nombre",
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         $("#nb_boutique").empty();
    //         $("#nb_boutique").append(resultat);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             location.reload();
    //             // alert("merci de contacter l'administrateur bt");
    //         }
    //     },
    // });

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/stat/entite",
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         for (let key in resultat) {
    //             res = resultat[key];
    //             for (let index in res) {
    //                 // console.log(res[index]);
    //                 $("#" + index).empty();
    //                 $("#" + index).append(res[index]);
    //             }
    //         }
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 01");
    //             location.reload();
    //         }
    //     },
    // });

    // if (
    //     role === "MLOUMER" ||
    //     role === "SERVICE_TRANSPORT" ||
    //     role === "INDIVIDUEL" ||
    //     role === "FOURNISSEUR_INTRANT" ||
    //     role === "GERANT"
    // ) {
    //     url_packs = my_url + "/pack/get_stat/null/" + id_profil;
    // } else {
    //     url_packs = my_url + "/pack/get_stat/" + id_entite + "/null";
    // }

    // //nb packs souscripts
    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: url_packs,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         var nb_packs;
    //         nb_packs = 0;

    //         if (resultat.confort) {
    //             // alert(resultat.confort);
    //             $("#confort").empty();
    //             $("#confort").append(resultat.confort);
    //         }

    //         if (resultat.kheweul) {
    //             // alert(resultat.confort);
    //             $("#xeweul").empty();
    //             $("#xeweul").append(resultat.kheweul);
    //             $("#confort").empty();
    //             $("#confort").append(resultat.confort);
    //             nb_packs = resultat.kheweul + resultat.confort;
    //         }

    //         if (resultat.prestige) {
    //             // alert(resultat.prestige);
    //             $("#prestige").empty();
    //             $("#prestige").append(resultat.prestige);
    //             nb_packs = nb_packs + resultat.prestige;
    //         }

    //         $("#nbPacks").empty();

    //         $("#nbPacks").append(nb_packs);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 2");
    //             location.reload();
    //         }
    //     },
    // });

    //nbre de marche du mloumer
    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/prix/profil/nb_market/" + id_profil,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         if (resultat.length != 0) {
    //             // alert(resultat)
    //             $("marche_mloumer").empty();
    //             $("marche_mloumer").append(resultat[0]);
    //         }
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 3");
    //             location.reload();
    //         }
    //     },
    // });

    //nbre de prix renseigne mloumer
    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/prix/profil/nb_prix/" + id_profil,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         if (resultat.length != 0) {
    //             // alert(resultat)
    //             $("nbPrixRens").empty();
    //             $("nbPrixRens").append(resultat[0]);
    //         }
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 4");
    //             location.reload();
    //         }
    //     },
    // });

    //nbPluvio

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/nombre_pluvios/" + id_entite,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },
    //     dataType: "json",
    //     success: function (resultat) {
    //         $("#nbPluvio").empty();
    //         $("#nbPluvio").append(resultat[0].nombre_pluvio);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 05");
    //             location.reload();
    //         }
    //     },
    // });

    //voice/sms
    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/envoi/stat_data/2/null/" + id_entite,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },
    //     dataType: "json",
    //     success: function (resultat) {
    //         // alert(resultat[0].nombre_voice)

    //         $("#nb_voice_ong").empty();
    //         $("#nb_voice_ong").append(resultat[0].nombre_voice);

    //         $("#nb_sms_ong").empty();
    //         $("#nb_sms_ong").append(resultat[0].nombre_sms);

    //         var total;
    //         total = resultat[0].nombre_voice + resultat[0].nombre_sms;
    //         $("#nbAlerte").empty();

    //         $("#nbAlerte").append(total);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 6");
    //             location.reload();
    //         }
    //     },
    // });

    //nbReseaux

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/entite/nombre_grp/" + id_entite,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },
    //     dataType: "json",
    //     success: function (resultat) {
    //         // JSON.stringify(resultat)
    //         //  alert(resultat[0].nombre)
    //         // alert(resultat[0].nombre_sms);
    //         $("#nbReseaux").empty();

    //         $("#nbReseaux").append(resultat[0].nombre);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 7");
    //             location.reload();
    //         }
    //     },
    // });

    //nb cours

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/cours/nombre",
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         $("#nbCours").empty();
    //         $("#nbCours").append(resultat);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 7");
    //             location.reload();
    //         }
    //     },
    // });

    // statistik packs

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/pack/get/stat/montant",
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },
    //     dataType: "json",
    //     success: function (resultat) {
    //         if (resultat.kheweul) {
    //             $("#nbXeweul").empty();
    //             $("#nbXeweul").append(resultat.kheweul);
    //         }

    //         if (resultat.confort) {
    //             $("#nbConfort").empty();
    //             $("#nbConfort").append(resultat.confort);
    //         }
    //         if (resultat.prestige) {
    //             $("#nbPrestige").empty();
    //             $("#nbPrestige").append(resultat.prestige);
    //         }
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur 9");
    //             location.reload();
    //         }
    //     },
    // });

    //users
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/users/inscription/stats/" + currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
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
                datasets: [
                    {
                        label: "Inscription/mois",
                        data: dataUsers,
                        fill: false,
                        borderColor: "cyan",
                        tension: 0.1,
                    },
                ],
            };
            UsersConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartUsersCTX, UsersConfig);
        },
        error: function () {
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
    //nbr prod by entitite

    // $.ajax({
    //     try_count: 0,
    //     retry: 5,
    //     type: "GET",
    //     url: my_url + "/nombre/" + id_entite,
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },

    //     dataType: "json",
    //     success: function (resultat) {
    //         $("#nbProdu").empty();
    //         $("#nbProdu").append(resultat[0].nombre);
    //     },
    //     error: function () {
    //         //
    //         this.try_count++;
    //         if (this.retry >= this.try_count) {
    //             $.ajax(this);
    //             return;
    //         } else {
    //             // alert("merci de contacter l'administrateur prod");
    //             location.reload();
    //         }
    //     },
    // });

    //prod/sexe
    var nb_h, nb_f;
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url:
            my_url +
            "/nombre/" +
            id_entite +
            "/null/null/null/null/null/null/null/m/null",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            nb_h = resultat[0].nombre;
            // alert(nb_h)
            $.ajax({
                type: "GET",
                url:
                    my_url +
                    "/nombre/" +
                    id_entite +
                    "/null/null/null/null/null/null/null/f/null",
                headers: {
                    Authorization:
                        "Bearer " +
                        jQuery('meta[name="token"]').attr("content"),
                },
                dataType: "json",
                success: function (resultat) {
                    nb_f = resultat[0].nombre;
                    var pieChartProdSexeCTX = $(".prod-by-sexe");
                    const dataProdSex = {
                        labels: ["Homme", "Femme"],
                        datasets: [
                            {
                                label: "Dataset 1",
                                data: [nb_h, nb_f],
                                backgroundColor: ["cyan", "orange"],
                            },
                        ],
                    };
                    const pieChartProdSexeconfig = {
                        type: "pie",
                        data: dataProdSex,
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
                        pieChartProdSexeCTX,
                        pieChartProdSexeconfig
                    );
                },
                error: function () {
                    //
                    this.try_count++;
                    if (this.retry >= this.try_count) {
                        $.ajax(this);
                        return;
                    } else {
                        // alert("merci de contacter l'administrateur 009");
                        location.reload();
                    }
                },
            });
        },
    });

    //prod by speculation

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/stat/speculations/" + id_entite,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            labels = [];
            dataSpec = [];
            for (const key in resultat) {
                labels.push(key);
                dataSpec.push(resultat[key]);
                // console.log(key + " => " + resultat[key]);
            }
            var lineChartProdSpecCTX = $("#prod-by-speculation");
            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "Prod/speculation",
                        data: dataSpec,
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
                    },
                ],
            };
            ProdBySpecConfig = {
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

            var linechartV = new Chart(lineChartProdSpecCTX, ProdBySpecConfig);
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 12");
                location.reload();
            }
        },
    });

    //prod by langue

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/nombre_user/langue/" + id_entite,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            labels = [];
            dataLangue = [];
            for (let key in resultat) {
                labels.push(key);
                dataLangue.push(resultat[key]);
                // console.log(key + " => " + resultat[key]);
            }

            var lineChartProdLangueCTX = $("#prod-by-langue");

            dataLineV = {
                labels: labels,
                datasets: [
                    {
                        label: "Prod/langue",
                        data: dataLangue,
                        fill: false,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(255, 205, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                        ],
                        borderColor: [
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                        ],
                    },
                ],
            };
            ProdByLangueConfig = {
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
                lineChartProdLangueCTX,
                ProdByLangueConfig
            );
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 13");
                location.reload();
            }
        },
    });
    //alertes
    // pour l'annee en cours

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url:
            my_url +
            "/sms/month_stat_data/2/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            var lineChartAlerteCTX = $(".revenue-line-chart-alerte_ong");
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
                        fill: false,
                        borderColor: "rgb(75, 192, 192)",
                        tension: 1,
                    },
                ],
            };
            AlerteConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartAlerteCTX, AlerteConfig);
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 15");
                location.reload();
            }
        },
    });
    // collecte

    //produits

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/produit",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $(".prod").empty();
            $(".prod").append("<option value=''>--Produit-- </option>");
            //   alert(resultat[0])
            if (resultat.length != 0) {
                $(".prod").append(
                    "<option selected value='" +
                        resultat[0].id +
                        "'> " +
                        resultat[0].produit +
                        " </option>"
                );
                for (let i = 1; i < resultat.length; i++) {
                    // alert(resultat[i].produit)
                    $(".prod").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].produit +
                            " </option>"
                    );
                }
            } else {
                $(".prod").empty();
                $(".prod").append(
                    "<option value=''> Pas de produit .....  </option>"
                );
            }
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("merci de contacter l'administrateur 16");
                location.reload();
            }
        },
    });

    //marche

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/market",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#marche").empty();
            $("#marche").append("<option value=''>--Marche-- </option>");
            //   alert(resultat[0])
            if (resultat.length != 0) {
                $("#marche").append(
                    "<option selected value='" +
                        resultat[0].id +
                        "'> " +
                        resultat[0].market +
                        " </option>"
                );
                for (let i = 1; i < resultat.length; i++) {
                    // alert(resultat[i].produit)
                    $("#marche").append(
                        "<option value='" +
                            resultat[i].id +
                            "'> " +
                            resultat[i].market +
                            " </option>"
                    );
                }
            } else {
                $("#marche").empty();
                $("#marche").append(
                    "<option value=''> Pas de marche .....  </option>"
                );
            }
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("merci de contacter l'administrateur 17");
                location.reload();
            }
        },
    });

    //evolution produit selon une annee
    $("#yearProd").on("change", function () {
        var annee = $(this).val();
        var produit = $("#prod").val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/prix/evolution/" + produit + "/" + annee + "/null",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                var lineChartProdCTX = $("#revenue-line-chart-produit");
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
                            label: "prix/mois",
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
                ProdConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartProdCTX, ProdConfig);
            },
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    alert("merci de contacter l'administrateur 7");
                    location.reload();
                }
            },
        });
        // collecte
    });

    //selon le produit
    $("#prod").on("change", function () {
        var produit = $(this).val();
        // alert(produit)
        var annee = $("#yearProd").val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/prix/evolution/" + produit + "/" + annee + "/null",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                var lineChartProdCTX = $("#revenue-line-chart-produit");
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
                            label: "prix/mois",
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
                ProdConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartProdCTX, ProdConfig);
            },
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    alert("merci de contacter l'administrateur 9");
                    location.reload();
                }
            },
        });
        // collecte
    });

    //par defaut

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/prix/evolution/1/" + currentYear + "/null",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            var lineChartProdCTX = $("#revenue-line-chart-produit");
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
                        label: "prix/mois",
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
            ProdConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartProdCTX, ProdConfig);
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                alert("merci de contacter l'administrateur 7");
                location.reload();
            }
        },
    });

    //prix du marche
    //selon le marche
    $("#marche").on("change", function () {
        var market = $(this).val();
        var produit = $(".prod").val();
        var annee = $("#yearPrixMarche").val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/prix/evolution/" +
                produit +
                "/" +
                annee +
                "/" +
                market,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // console.log(resultat);
                var lineChartProdCTX = $("#revenue-line-chart-prix-marche");
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
                            label: "prix_du_marche/mois",
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
                ProdConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartProdCTX, ProdConfig);
            },
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                    location.reload();
                }
            },
        });
    });

    //selon le produit
    $(".prod").on("change", function () {
        var produit = $(this).val();
        var market = $("#marche").val();
        var annee = $("#yearPrixMarche").val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/prix/evolution/" +
                produit +
                "/" +
                annee +
                "/" +
                market,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // console.log(resultat);
                var lineChartProdCTX = $("#revenue-line-chart-prix-marche");
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
                            label: "prix_du_marche/mois",
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
                ProdConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartProdCTX, ProdConfig);
            },
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                    location.reload();
                }
            },
        });
    });

    //selon l'annee
    $("#yearPrixMarche").on("change", function () {
        var produit = $(".prod").val();
        var market = $("#marche").val();
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/prix/evolution/" +
                produit +
                "/" +
                annee +
                "/" +
                market,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // console.log(resultat);
                var lineChartProdCTX = $("#revenue-line-chart-prix-marche");
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
                            label: "prix_du_marche/mois",
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
                ProdConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartProdCTX, ProdConfig);
            },
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 7");
                    location.reload();
                }
            },
        });
    });

    //par defaut
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/prix/evolution/1/" + currentYear + "/1",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // console.log(resultat);
            var lineChartProdCTX = $("#revenue-line-chart-prix-marche");
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
                        label: "prix_du_marche/mois",
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
            ProdConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartProdCTX, ProdConfig);
        },
        error: function () {
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

    // //nbre producteurs
    // $.ajax({
    //     type: "GET",
    //     url: my_url + "/nombre/group/" + id_entite + "/null/null/null/null",
    //     headers: {
    //         Authorization:
    //             "Bearer " + jQuery('meta[name="token"]').attr("content"),
    //     },
    //     dataType: "json",
    //     success: function (resultat) {
    //         $("#nbProdu").empty();
    //         $("#nbProdu").append(resultat[0].nombre);
    //     },
    //     error: function () {
    //         alert("Erreur, merci de contacter l'administrateur 3.");
    //     },
    // });

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
        url:
            my_url +
            "/sms/month_stat_data/4/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat[1])
            var lineChartCollecteCTX = $("#revenue-line-chart-collecte_ong");
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
                    },
                ],
            };
            CollecteConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartCollecteCTX, CollecteConfig);
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 21");
            }
        },
    });

    //prevision
    // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url:
            my_url +
            "/sms/month_stat_data/3/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            var lineChartPrevisionCTX = $("#revenue-line-chart-prevision_ong");
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
                    },
                ],
            };
            PrevisionConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartPrevisionCTX, PrevisionConfig);
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 22");
            }
        },
    });

    //selon l'annee
    $("#yearA").on("change", function () {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/sms/month_stat_data/2/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                var lineChartAlerteCTX = $(".revenue-line-chart-alerte_ong");
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
                            fill: false,
                            borderColor: "rgb(75, 192, 192)",
                            tension: 0.1,
                        },
                    ],
                };
                AlerteConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartAlerteCTX, AlerteConfig);
            },
            error: function () {
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
        // collecte
    });

    $("#yearC").on("change", function () {
        var annee = $(this).val();
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
            url:
                my_url +
                "/sms/month_stat_data/4/null/" +
                +id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                var lineChartCollecteCTX = $(
                    "#revenue-line-chart-collecte_ong"
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 23");
                }
            },
        });

        //prevision

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/sms/month_stat_data/3/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                var lineChartPrevisionCTX = $(
                    "#revenue-line-chart-prevision_ong"
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
                //
                this.try_count++;
                if (this.retry >= this.try_count) {
                    $.ajax(this);
                    return;
                } else {
                    // alert("merci de contacter l'administrateur 24");
                }
            },
        });
    });

    //eb

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/eb/stats/" + id_entite,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            var nb_eb =
                resultat[0].nb_eb_valides + resultat[0].nb_eb_non_valides;
            $("#eb").empty();

            $("#eb").append(nb_eb);
            var pieChartBesoinCTX = $("#pie-besoin");
            const DATA_COUNT = 2;
            const dataBesoins = {
                labels: ["Valide", "Non Valide"],
                datasets: [
                    {
                        label: "Dataset 1",
                        data: [
                            resultat[0].nb_eb_valides,
                            resultat[0].nb_eb_non_valides,
                        ],
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
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
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

    //liste ong

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/entitetype/1",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            $("#list_ong").empty();
            $("#list_ong").append("<option value=''>--ONG-- </option>");
            //   alert(resultat[0])
            if (resultat.length != 0) {
                $("#list_ong").append(
                    "<option selected value='" +
                        resultat[0].id_entite +
                        "'> " +
                        resultat[0].nom_entite +
                        " </option>"
                );
                for (let i = 1; i < resultat.length; i++) {
                    // alert(resultat[i].produit)
                    $("#list_ong").append(
                        "<option value='" +
                            resultat[i].id_entite +
                            "'> " +
                            resultat[i].nom_entite +
                            " </option>"
                    );
                }
            } else {
                $("#list_ong").empty();
                $("#list_ong").append(
                    "<option value=''> Pas de Ong .....  </option>"
                );
            }
        },
        error: function () {
            //
            this.try_count++;
            if (this.retry >= this.try_count) {
                $.ajax(this);
                return;
            } else {
                // alert("merci de contacter l'administrateur 25");
            }
        },
    });

    //production/entite default

    $.ajax({
        try_count: 0,
        retry: 5,
        type: "GET",
        url: my_url + "/production/stats/entite/reseau/1/null",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            labels_prod = [];
            dataProd = [];
            // resultat=resultat[0];
            // alert(resultat.length)
            for (let index = 0; index < resultat.length; index++) {
                // alert(resultat[index].quantite_totale);
                labels_prod.push(resultat[index].produit);
                dataProd.push(resultat[index].quantite_totale);
            }
            // alert(labels);

            var lineChartProductionCTX = $(
                "#revenue-line-chart-production-admin"
            );
            dataLineV = {
                labels: labels_prod,
                datasets: [
                    {
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
                    },
                ],
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
        error: function () {
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

    // //production/ong
    $("#list_ong").on("change", function () {
        var ong = $(this).val();
        //    alert(ong);
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/production/stats/entite/reseau/" + ong + "/null",
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
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

    $("#yearU").on("change", function () {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url: my_url + "/users/inscription/stats/" + annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
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
                    datasets: [
                        {
                            label: "Inscription/mois",
                            data: dataUsers,
                            fill: false,
                            borderColor: "cyan",
                            tension: 0.1,
                        },
                    ],
                };
                UsersConfig = {
                    type: "line",
                    data: dataLineV,
                };

                var linechartV = new Chart(lineChartUsersCTX, UsersConfig);
            },
            error: function () {
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
        url:
            my_url +
            "/sms/month_stat_data/2/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
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
                datasets: [
                    {
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
        error: function () {
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
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat[0].nombre_voice)

            $("#nb_voice").empty();
            $("#nb_voice").append(resultat[0].nombre_voice);

            $("#nb_sms").empty();
            $("#nb_sms").append(resultat[0].nombre_sms);
        },
        error: function () {
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
        url:
            my_url +
            "/sms/month_stat_data/4/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
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
                datasets: [
                    {
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
                    },
                ],
            };
            CollecteConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartCollecteCTX, CollecteConfig);
        },
        error: function () {
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
        url:
            my_url +
            "/sms/month_stat_data/3/null/" +
            id_entite +
            "/" +
            currentYear,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
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
                datasets: [
                    {
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
                    },
                ],
            };
            PrevisionConfig = {
                type: "line",
                data: dataLineV,
            };

            var linechartV = new Chart(lineChartPrevisionCTX, PrevisionConfig);
        },
        error: function () {
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

    $("#yearAA").on("change", function () {
        var annee = $(this).val();
        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            url:
                my_url +
                "/sms/month_stat_data/2/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
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
                    datasets: [
                        {
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
            error: function () {
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

    $("#yearCA").on("change", function () {
        var annee = $(this).val();

        $.ajax({
            try_count: 0,
            retry: 5,
            type: "GET",
            // https://api.mlouma.org/api/sms/month_stat_data/{id_type_sms}/{id_utilisateur}/{id_entite}/{annee}
            url:
                my_url +
                "/sms/month_stat_data/4/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
                // console.log(resultat);
                var lineChartCollecteCTX = $(
                    "#revenue-line-chart-collecte-admin"
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
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
            url:
                my_url +
                "/sms/month_stat_data/3/null/" +
                id_entite +
                "/" +
                annee,
            headers: {
                Authorization:
                    "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            dataType: "json",
            success: function (resultat) {
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
                    datasets: [
                        {
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
                        },
                    ],
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
            error: function () {
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
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat[0].nb_eb_valides)
            var pieChartBesoinAdminCTX = $("#pie-besoin-admin");

            const dataBesoinsAdmin = {
                labels: ["Valide", "Non Valide"],
                datasets: [
                    {
                        label: "Dataset 1",
                        data: [
                            resultat[0].nb_eb_valides,
                            resultat[0].nb_eb_non_valides,
                        ],
                        backgroundColor: ["green", "orange"],
                    },
                ],
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
        datasets: [
            {
                label: "Transport/mois",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                fill: false,
                borderColor: "orange",
                tension: 1,
            },
        ],
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
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {
            // alert(resultat);
            labels = [];
            $.each(resultat, function (i, val) {
                // alert(val.region)
                labels.push(val.region);
            });

            var lineChartTransLocCTX = $("#transport-by-localite");
            dataLineV = {
                labels: labels,
                datasets: [
                    {
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
                    },
                ],
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
        error: function () {
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
        datasets: [
            {
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
            },
        ],
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
        datasets: [
            {
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
            },
        ],
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
        datasets: [
            {
                label: "declaration/mois",
                data: [7, 9, 10, 9, 5, 11, 12, 12, 9, 16, 10, 11],
                fill: false,
                borderColor: "cyan",
                tension: 0.1,
            },
        ],
    };
    SinistreConfig = {
        type: "line",
        data: dataLineSinistre,
    };

    var linechartV = new Chart(lineChartSinistreCTX, SinistreConfig);
});
