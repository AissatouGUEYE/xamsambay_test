$(document).ready(function () {
    $(".select2insidemodal1").select2({
        dropdownParent: $("#modal1"),
    });

    $(".select2insidemodal2").select2({
        dropdownParent: $("#modal2"),
    });

    $(".select2insidemodal3").select2({
        dropdownParent: $("#modal3"),
    });

    $(".select2insidemodal4").select2({
        dropdownParent: $("#modal4"),
    });

    $("#regionTable").DataTable({
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
    $("#depTable").DataTable({
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
    $("#communeTable").DataTable({
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
    $("#localiteTable").DataTable({
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

    //REGION
    $("#add_region").validate({
        rules: {
            region: {
                required: true,
            },
            pays: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            region: {
                required: "Veuillez saisir le nom de la région",
            },
            pays: {
                required: "Veuillez saisir le nom du pays",
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

    $("#create_region").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter la région ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_region").submit();
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

    //DEPARTEMENT
    $("#add_dept").validate({
        rules: {
            region: {
                required: true,
            },
            departement: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            region: {
                required: "Veuillez saisir le nom de la région",
            },
            departement: {
                required: "Veuillez saisir le nom du département",
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

    $("#create_dept").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter le département ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_dept").submit();
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

    //COMMUNE
    $("#add_commune").validate({
        rules: {
            commune: {
                required: true,
            },
            departement: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            commune: {
                required: "Veuillez saisir le nom de la commune",
            },
            departement: {
                required: "Veuillez saisir le nom du département",
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

    $("#create_commune").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter la commune ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_commune").submit();
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

    //LOCALITE
    $("#add_localite").validate({
        rules: {
            commune: {
                required: true,
            },
            localite: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            commune: {
                required: "Veuillez saisir la commune",
            },
            localite: {
                required: "Veuillez saisir la localité",
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

    $("#create_localite").click(function (e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter la localité ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function (willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_localite").submit();
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
