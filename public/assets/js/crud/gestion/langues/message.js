$(document).ready(function () {
    $("#myTable").DataTable({
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

    $("#formAddLangue").validate({
        rules: {
            langue: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            langue: {
                required: "Veuillez saisir le nom de la langue",
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

    $("#formAddLanguebtn").click(function (e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter la langue",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#formAddLangue").submit();
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

    $("#formEditLangue").validate({
        rules: {
            langue: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            langue: {
                required: "Veuillez saisir le nom de la langue",
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

    $("#formEditLanguebtn").click(function (e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous enrégistrer ces modifications ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#formEditLangue").submit();
            } else {
                swal("Modification annulée !", {
                    title: "Cancelled",
                    icon: "error",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
});
