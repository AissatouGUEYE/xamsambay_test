$(document).ready(function () {
    $("#banqueTable").DataTable({
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

    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1"),
    });

    var base_url = $('meta[name="url"]').attr("content");

    $("#formAddBanque").validate({
        rules: {
            nom_entite: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            nom_entite: {
                required: "Veuillez saisir le nom de la banque",
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

    $("#formAddBanquebtn").click(function (e) {
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter la banque ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                delete: "Oui",
            },
        }).then(function (willDelete) {
            if (willDelete) {
                $("#formAddBanque").submit();
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

    $("#formEditBanque").validate({
        rules: {
            nom_entite: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            nom_entite: {
                required: "Veuillez saisir le nom de la banque",
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

    $("#formEditBanquebtn").click(function (e) {
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
                $("#formEditBanque").submit();
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
