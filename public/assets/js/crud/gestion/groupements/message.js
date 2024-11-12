$(document).ready(function() {
    // $(".select2insidemodal1").select2({
    //     dropdownParent: $("#modal1")
    // });

    // $(".select2insidemodal2").select2({
    //     dropdownParent: $("#modal2")
    // });

    // $(".select2insidemodal3").select2({
    //     dropdownParent: $("#modal3")
    // });

    // $(".select2insideprod").select2({
    //     dropdownParent: $("#prod")
    // });

    var base_url = jQuery('meta[name="url"]').attr("content");

    $("#opTable").DataTable({
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        buttons: true,
        language: {
            decimal: "",
            emptyTable: "Pas de données trouvées",
            info: "_START_ à _END_ sur _TOTAL_ entries",
            infoEmpty: "0 sur 0 entries",
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
    $("#grpTable").DataTable({
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        buttons: true,
        language: {
            decimal: "",
            emptyTable: "Pas de données trouvées",
            info: "_START_ à _END_ sur _TOTAL_ entries",
            infoEmpty: "0 sur 0 entries",
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
    $("#union_grp_Table").DataTable({
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        buttons: true,
        language: {
            decimal: "",
            emptyTable: "Pas de données trouvées",
            info: "_START_ à _END_ sur _TOTAL_ entries",
            infoEmpty: "0 sur 0 entries",
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

    $('#mailTable').DataTable({
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

    $('#phoneTable').DataTable({
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

    $("#membreTable").DataTable({
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

    $("#add_op").validate({
        rules: {
            libelle1: {
                required: true,
            },
            // date_creation1: {
            //     required: true,
            // },
            localite1: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            libelle1: {
                required: "Veuillez saisir le libellé",
            },
            // date_creation1: {
            //     required: "Veuillez saisir la date",
            // },
            localite1: {
                required: "Veuillez saisir la localité",
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#create_op").click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter l'AUOP ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_op").submit();
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

    $("#add_union_grp").validate({
        rules: {
            libelle2: {
                required: true,
            },
            // date_creation2: {
            //     required: true,
            // },
            localite2: {
                required: true,
            },
            // OP2: {
            //     required: true,
            // },
        },
        //For custom messages
        messages: {
            libelle2: {
                required: "Veuillez saisir le libellé",
            },
            // date_creation2: {
            //     required: "Veuillez saisir la date",
            // },
            localite2: {
                required: "Veuillez saisir la localité",
            },
            // OP2: {
            //     required: "Veuillez saisir l'OP",
            // },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#create_union_grp").click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter l'Union de Groupement ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_union_grp").submit();
            } else {
                swal("Enrégistrement annulé !", {
                    title: "Cancelled",
                    icon: "error",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    $("#add_grp").validate({
        rules: {
            libelle3: {
                required: true,
            },
            // date_creation3: {
            //     required: true,
            // },
            localite3: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            libelle3: {
                required: "Veuillez saisir le libellé",
            },
            // date_creation3: {
            //     required: "Veuillez saisir la date",
            // },
            localite3: {
                required: "Veuillez saisir la localité",
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#create_grp").click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter le groupement ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_grp").submit();
            } else {
                swal("Ajout annulé!", {
                    title: "Cancelled",
                    icon: "error",
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });

    $("#add_membre").validate({
        rules: {
            producteur: {
                required: true,
            },
        },
        //For custom messages
        messages: {
            producteur: {
                required: "Veuillez choisir un producteur",
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("#ajouter_membre").click(function(e) {
        // e.preventDefault();
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter ce producteur ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {
                // alert('OUI Alert')
                $("#add_membre").submit();
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

    $("#form-producteur-list").validate({
        rules: {

            localite: {
                required: true,
            },
            plist: {
                required: true,
            },
        },
        //For custom messages
        messages: {

            localite: {
                required: "Veuillez saisir la localité",
            },
            plist: {
                required: "Veuillez joindre un fichier SVP",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },

    });


    $("#ajouter_list_membre").click(function(e) {
        // alert('OK');
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous ajouter cette liste?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {

                $("#form-producteur-list").append(`
                <div id="pld" class="row mt-2">
                    <div class="col s12 m6 l12">
                        <div class="preloader-wrapper small active right">
                            <div class="spinner-layer spinner-white-only">
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                            </div>

                            </div>
                        </div>
                    </div>

                </div>`)

                $("#form-producteur-list").submit();
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


    $("#form-migrer-phone").validate({
        rules: {

            phonelist: {
                required: true,
            },
        },
        //For custom messages
        messages: {

            phonelist: {
                required: "Veuillez joindre un fichier SVP",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },

    });

    $("#ajouter_list_phone").click(function(e) {
        // alert('OK');
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous Migrer ces Producteurs ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {

                $("#form-migrer-phone").append(`
                <div id="pld" class="row mt-2">
                    <div class="col s12 m6 l12">
                        <div class="preloader-wrapper small active right">
                            <div class="spinner-layer spinner-white-only">
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                            </div>

                            </div>
                        </div>
                    </div>

                </div>`)

                $("#form-migrer-phone").submit();
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


    $("#form-migrer-mail").validate({
        rules: {

            maillist: {
                required: true,
            },
        },
        //For custom messages
        messages: {

            maillist: {
                required: "Veuillez joindre un fichier SVP",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },

    });

    $("#ajouter_list_mail").click(function(e) {
        // alert('OK');
        swal({
            title: "Etes-vous sure",
            text: "Voulez-vous Migrer ces Producteurs ?",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Annuler",
                add: "Oui",
            },
        }).then(function(willAdd) {
            if (willAdd) {

                $("#form-migrer-mail").append(`
                <div id="pld" class="row mt-2">
                    <div class="col s12 m6 l12">
                        <div class="preloader-wrapper small active right">
                            <div class="spinner-layer spinner-white-only">
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                            </div>

                            </div>
                        </div>
                    </div>

                </div>`)

                $("#form-migrer-mail").submit();
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
