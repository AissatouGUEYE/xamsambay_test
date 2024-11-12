$(document).ready(function () {
    // var base_url = jQuery('meta[name="url"]').attr('content');

    // $.ajax({
    //     type: "GET",
    //     url: base_url + "/market",
    //     dataType: "json",
    //     headers: {
    //         Authorization: "Bearer " + $('meta[name="token"]').attr('content')
    //     },
    //     success: function(resultat) {

    //         if (resultat.length != 0) {

    //             var coord = { lat: 37.7749, lng: -122.4194 };

    //             var map = new google.maps.Map(
    //                 document.getElementById('map'), {
    //                     zoom: 10,
    //                     center: coord
    //                 }
    //             );

    //             for (let i = 0; i < resultat.length; i++) {
    //                 // alert(resultat[i].cat_produit)
    //                 // $("#cat_produit").append("<option value='" + resultat[i].id + "'> " + resultat[i].cat_produit + " </option>");

    //                 new google.maps.Marker({
    //                     position: { lat: resultat[i].latitude, lng: resultat[i].longitude },
    //                     map: map,
    //                     title: resultat[i].market
    //                 });

    //             }

    // new google.maps.Marker({
    //     position: { lat: -34.397, lng: 150.644 },
    //     map: map
    // });
    // new google.maps.Marker({
    //     position: { lat: 37.7749, lng: -122.4194 },
    //     map: map
    // });
    // new google.maps.Marker({
    //     position: { lat: 37.789889, lng: -122.397447 },
    //     map: map
    // });
    // new google.maps.Marker({
    //     position: { lat: 37.783584, lng: -122.431573 },
    //     map: map
    // });
    // new google.maps.Marker({
    //     position: { lat: 37.791004, lng: -122.412027 },
    //     map: map
    // });

    // google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
    //     for (let i = 0; i < resultat.length; i++) {
    //         new google.maps.Marker({
    //             position: { lat: resultat[i].latitude, lng: resultat[i].longitude },
    //             map: map
    //         });

    //         // alert(resultat[i].latitude);
    //     }
    // });

    //         }
    //     },
    //     error: function() {
    //         alert("Erreur, merci de contacter l'administrateur .");
    //     }
    // });

    // function showMap(lat, long) {
    //     // alert('Okkk');
    //     var coord = { lat: lat, lng: long };

    //     var map = new google.maps.Map(
    //         document.getElementById('map'), {
    //             zoom: 10,
    //             center: coord
    //         }
    //     );

    //     new google.maps.Marker({
    //         position: coord,
    //         map: map
    //     });
    // }

    // $('#trr').click(function(e) {

    //     // initMap(13, 14);
    //     alert('Okkk');

    // });

    // showMap(-34.397, 150.644);

    $("#myTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        buttons: true,
        language: {
            decimal: "",
            emptyTable: "Pas de données trouvées",
            info: "_START_ à _END_ sur _TOTAL_ entrees",
            infoEmpty: "0 sur 0 entrees",
            infoFiltered: "(filtered from _MAX_ total entries)",
            infoPostFix: "",
            thousands: ",",
            // lengthMenu: "liste _MENU_ entrees",
            loadingRecords: "Chargement...",
            processing: "",
            search: "Recherche:",
            zeroRecords: "No matching records found",
            paginate: {
                first: "Premier",
                last: "Dernier",
                next: "Suivant",
                previous: "Précédent",
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending",
            },
        },
    });

    $("#formAddMarket").validate({
        rules: {
            market: {
                required: true,
            },
            localite: {
                required: true,
            },
            type_market: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            market: {
                required: "Veuillez saisir le nom du marché",
            },
            localite: {
                required: "Veuillez saisir la localité",
            },
            type_market: {
                required: "Veuillez saisir le type du marché",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#formAddMarketbtn").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter ce marché",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#formAddMarket").submit();
            } else {
                swal("Ajout annulé !", {
                    title: "Cancelled",
                    icon: "error",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
});
