$(document).ready(() => {
    let my_url = jQuery('meta[name="url"]').attr("content");

    $("#formAddEntitybtn").on("click", function () {
        $("#formAddEntity").on("submit", function (e) {
            e.preventDefault();
            $("#formAddEntity").validate({
                rules: {
                    nom_entite: {
                        required: true,
                    },
                    type_entite: {
                        required: true,
                    },
                },
                //For custom messages
                messages: {
                    prenom: {
                        required: "Veuillez saisir le nom de la structure",
                    },
                    nom: {
                        required: "Veuillez choisir le type de la structure",
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
                submitHandler: function () {
                    e.preventDefault();
                    $("#load").append(
                        "<div class='progress' id='loadbar'><div class='indeterminate'></div></div>"
                    );
                    $.ajax({
                        url: my_url + "/entite/create",
                        method: "POST",
                        headers: {
                            // 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
                            Authorization:
                                "Bearer " +
                                jQuery('meta[name="token"]').attr("content"),
                        },
                        data: $("#formAddEntity").serialize(),
                        dataType: "JSON",
                        success: (res) => {
                            $("#loadbar").remove();
                            $("#load").append(
                                "<div class='card-alert card green lighten-5'><div class='card-content purple-text'><p>Utilisateur ajoute avec succes</p></div></div>"
                            );
                            location.reload();
                        },
                        error: () => {
                            $("#loadbar").remove();
                            $("load").append(
                                "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                            );
                        },
                    });
                },
            });
        });
    });
});
