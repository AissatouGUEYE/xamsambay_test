/*
 * DataTables - Tables
 */

$(function () {
    $(".data-table").DataTable({
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        buttons: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
    });

    $("#data-table-prime").DataTable({
        responsive: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
    });

    // Simple Data Table

    $("#data-table-simple").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        autoFill: true,
        paging: true,
        autoWidth: true,
        buttons: true,
        filter: true,
        // processing:true,

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

    // });

    // Row Grouping Table

    var table = $("#data-table-row-grouping").DataTable({
        responsive: true,
        columnDefs: [
            {
                visible: false,
                targets: 2,
            },
        ],
        order: [[2, "asc"]],
        displayLength: 25,
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api
                .rows({
                    page: "current",
                })
                .nodes();
            var last = null;

            api.column(2, {
                page: "current",
            })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="5">' +
                                    group +
                                    "</td></tr>"
                            );

                        last = group;
                    }
                });
        },
    });

    // Page Length Option Table

    $("#page-length-option").DataTable({
        responsive: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
    });

    // Dynmaic Scroll table

    $("#scroll-dynamic").DataTable({
        responsive: true,
        scrollY: "50vh",
        scrollCollapse: true,
        paging: false,
    });

    // Horizontal And Vertical Scroll Table

    $("#scroll-vert-hor").DataTable({
        scrollY: 200,
        scrollX: true,
    });

    // Multi Select Table

    $("#multi-select").DataTable({
        responsive: false,
        paging: true,
        ordering: false,
        info: false,
        columnDefs: [
            {
                visible: false,
                targets: 2,
            },
        ],
    });
});

// Datatable click on select issue fix
$(window).on("load", function () {
    $(".dropdown-content.select-dropdown li").on("click", function () {
        var that = this;
        setTimeout(function () {
            if (
                $(that)
                    .parent()
                    .parent()
                    .find(".select-dropdown")
                    .hasClass("active")
            ) {
                // $(that).parent().removeClass('active');
                $(that)
                    .parent()
                    .parent()
                    .find(".select-dropdown")
                    .removeClass("active");
                $(that).parent().hide();
            }
        }, 100);
    });
});

var checkbox = $("#multi-select tbody tr th input");
var selectAll = $("#multi-select .select-all");

// Select A Row Function

$(document).ready(function () {
    checkbox.on("click", function () {
        $(this).parent().parent().parent().toggleClass("selected");
    });

    checkbox.on("click", function () {
        if ($(this).attr("checked")) {
            $(this).attr("checked", false);
        } else {
            $(this).attr("checked", true);
        }
    });

    // Select Every Row

    selectAll.on("click", function () {
        $(this).toggleClass("clicked");
        if (selectAll.hasClass("clicked")) {
            $("#multi-select tbody tr").addClass("selected");
        } else {
            $("#multi-select tbody tr").removeClass("selected");
        }

        if ($("#multi-select tbody tr").hasClass("selected")) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });
});
$(document).ready(function () {
    $(".mmtable tfoot th").each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
    });

    var table = $(".mmtable").DataTable({
        responsive: true,
        // responsive: {
        //     details: {
        //         display: $.fn.dataTable.Responsive.display.childRowImmediate
        //     }
        // },
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        autoFill: true,
        paging: true,
        lengthMenu: true,
        lengthChange: true,
        autoWidth: true,
        buttons: true,
        filter: true,
        language: {
            decimal: "",
            emptyTable: "Pas de données trouvées",
            info: "_START_ à _END_ sur _TOTAL_ entries",
            infoEmpty: "0 sur 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Show _MENU_ entries",
            loadingRecords: "Loading...",
            processing: "",
            search: "Recherche:",
            zeroRecords: "No matching records found",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous",
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending",
            },
        },

        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });

            var r = $(".mmtable tfoot tr");
            r.find("th").each(function () {
                $(this).css("padding", 8);
            });
            $(".mmtable thead").append(r);
            $("#search_0").css("text-align", "center");
        },
    });
    // $.fn.dataTable.Buttons( table, {
    //     buttons: [
    //         'copy', 'excel', 'pdf'
    //     ]
    // } );
    // table.buttons().container()
    // .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) )
});
$(document).ready(() => {
    // alert('work');
    $("#statsTable tfoot th").each(function () {
        var title = $(this).text();
        $(this).html(
            '<input type="text" placeholder="Search ' + title + '" />'
        );
    });

    var table = $("#statsTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: ["colvis", "excel", "print"],
        stateSave: true,
        autoFill: true,
        paging: true,
        autoWidth: true,
        buttons: true,
        filter: true,
        // processing:true,

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
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });

            var r = $("#statsTable tfoot tr");
            r.find("th").each(function () {
                $(this).css("padding", 8);
            });
            $("#statsTable thead").append(r);
            $("#search_0").css("text-align", "center");
        },
    });
});
