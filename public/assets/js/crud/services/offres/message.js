$(document).ready(function () {
    // $(".select2insidemodal1").select2({
    //     dropdownParent: $("#modal1")
    // });

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

    $("#formAddOffre").validate({
        rules: {
            description: {
                required: true,
            },
            entite: {
                required: true,
            },
            plancher: {
                required: true,
            },
            plafond: {
                required: true,
            },
            unite: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            description: {
                required: "Veuillez saisir la description de l'offre",
            },
            entite: {
                required: "Veuillez choisir une banque SVP.",
            },
            unite: {
                required: "Veuillez saisir l'unité",
            },
            plancher: {
                required: "Veuillez saisir le montant plancher",
            },
            plafond: {
                required: "Veuillez saisir la montant plafond",
            },
            date: {
                required: "Veuillez saisir la date",
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

    $("#formAddOffrebtn").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter cette offre ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                $("#formAddOffre").submit();
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

    $("#formEditOffre").validate({
        rules: {
            description: {
                required: true,
            },
            entite: {
                required: true,
            },
            plancher: {
                required: true,
            },
            plafond: {
                required: true,
            },
            unite: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            description: {
                required: "Veuillez saisir la description de l'offre",
            },
            entite: {
                required: "Veuillez choisir une banque SVP.",
            },
            unite: {
                required: "Veuillez saisir l'unité",
            },
            plancher: {
                required: "Veuillez saisir le montant plancher",
            },
            plafond: {
                required: "Veuillez saisir la montant plafond",
            },
            date: {
                required: "Veuillez saisir la date",
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

    $("#formEditOffrebtn").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous modifier cette offre ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                $("#formEditOffre").submit();
            } else {
                alert("Modification annulée !");
            }
        });
    });
});
