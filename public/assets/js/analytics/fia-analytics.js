$(document).ready(function () {
    let my_url = jQuery('meta[name="url"]').attr("content");
    let id_profil = jQuery('meta[name="id_profil"]').attr("content");
    // alert(id_profil);
    $.ajax({
        type: "GET",
        url: my_url + "/distributions/stat/"+id_profil,
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        dataType: "json",
        success: function (resultat) {

            // console.log(Object.values(resultat));
            // resultat=JSON.stringify(resultat)

            var lineChartVenteCTX = $("#stat-distribution");
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
                        label: "distribution/mois",
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

    
});
