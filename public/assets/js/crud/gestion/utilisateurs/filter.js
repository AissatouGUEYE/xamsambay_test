$(document).ready(() => {
    let my_url = jQuery('meta[name="url"]').attr("content");

    $("#filter").on("click", function(e) {
        e.preventDefault();
        var sexe = $("#users-list-verified").val();
        var entite = $("#users-list-role").val();
        var statut = $("#users-list-status").val();
        $("#user-list").empty();

        $.ajax({
            url: my_url+"/search/" +
                sexe +
                "/" +
                entite +
                "/" +
                statut, // changer url
            method: "GET",
            headers: {
                Authorization: "Bearer " + jQuery('meta[name="token"]').attr("content"),
            },
            data: $("#formAddUser").serialize(),
            dataType: "JSON",
            success: (res) => {
                // JSON(res)
                if (res.User.length > 0) {
                    $("#user-list").empty();
                    for (let index = 0; index < res.User.length; index++) {
                        if (res.User[index].actif == 1) {
                            var dat =
                                res.User[index].dt_naiss != null ?
                                res.User[index].dt_naiss :
                                "";
                            var func =
                                res.User[index].fonction != null ?
                                res.User[index].fonction :
                                "";
                            $("#user-list").append(
                                "<tr>" +
                                "<td hidden>" +
                                res.User[index].id +
                                "</td>" +
                                "<td><a href='page-users-view.html'>" +
                                res.User[index].prenom +
                                "</a></td>" +
                                "<td>" +
                                res.User[index].nom +
                                "</td>" +
                                "<td>" +
                                dat +
                                "</td>" +
                                "<td>" +
                                res.User[index].sexe +
                                "</td>" +
                                "<td>" +
                                func +
                                "</td>" +
                                "<td>" +
                                res.User[index].nom_entite +
                                "</td>" +
                                "<td><a onclick='deactivate(" +
                                res.User[index].utilisateur +
                                ")' href='#' class='inactif' ><span class='chip green lighten-5'><span class='green-text'>Actif</span></span></a></td>" +
                                "<td><a  id='editUser'  href='/admin/profil/edit/" +
                                res.User[index].utilisateur +
                                "' ><i class='material-icons'>edit</i></a></td>" +
                                "</tr>"
                            );
                        } else if (res.User[index].actif == 0) {
                            $("#user-list").append(
                                "<tr>" +
                                "<td hidden>" +
                                res.User[index].id +
                                "</td>" +
                                "<td><a href='page-users-view.html'>" +
                                res.User[index].prenom +
                                "</a></td>" +
                                "<td>" +
                                res.User[index].nom +
                                "</td>" +
                                "<td>" +
                                dat +
                                "</td>" +
                                "<td>" +
                                res.User[index].sexe +
                                "</td>" +
                                "<td>" +
                                res.User[index].nom_entite +
                                "</td>" +
                                "<td>" +
                                func +
                                "</td>" +
                                "<td><a onclick='activate(" +
                                res.User[index].utilisateur +
                                ")' href='#' class='inactif'><span class='chip red lighten-5'><span class='red-text'>Inactif</span></span></a></td>" +
                                "<td><a  id='editUser' data-id='' href='/admin/profil/edit/" +
                                res.User[index].utilisateur +
                                "' ><i class='material-icons'>edit</i></a></td>" +
                                "</tr>"
                            );
                        }
                    }
                } else {
                    $("#user-list").empty();
                    $("#user-list").append(
                        "<tr ><td colspan='8' class='valign center'> Lingay weur nekkoufii ! Tanatal yeinene melo wala nga xolatt linga bind</td></tr>"
                    );
                    // Pas d'élément retrouvé pour cette recherche
                }
            },
            error: () => {
                $("#loadbar").remove();
                $("load").append(
                    "<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>"
                );
            },
        });
    });
});
