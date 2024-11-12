$(document).ready(() => {
    let my_url = jQuery('meta[name="url"]').attr("content");

    edit = (id) => {
            $.ajax({
                url: my_url+"/showuser/" + id,
                method: 'GET',
                headers: {
                    'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
                },
                // data:$('#formAddUser').serialize(),
                dataType: 'JSON',
                success: (res) => {
                    $("#icon_telephone8").attr('value', res[0].login);
                    // alert()
                    window.location = "/admin/profil/edit/" + res[0].id
                        // window.location = "/admin/profil/edit/"+id+"?id="+res[0].utilisateur+"&prenom="+res[0].prenom+"&nom="+res[0].nom+"&dt_naiss="+res[0].dt_naiss+"&fonction="+
                        // res[0].fonction+"&sexe="+res[0].sexe+"&telephone="+res[0].telephone+"&email="+res[0].email+"&login="+res[0].login+"&sit_mat_id="+res[0].sit_matrimonial_id+
                        // "&sit_mat="+res[0].sit_matrimonial+"&entite="+res[0].entite+"&type_entite="+res[0].type_entite+"&localite="+res[0].localite+"&nom_entite="+res[0].nom_entite+"&etat="+res[0].actif+"&description="+res[0].description+"&departement="+res[0].departement+
                        // "&id_commune="+res[0].id_commune+"&commune="+res[0].commune+"&region="+res[0].region+"&pays="+res[0].pays+"&nom_typentite="+res[0].nom_typentite
                },
                error: () => {
                    alert('error')
                }


            })

        }
        // alert($(".editUser"))

    // $(".editUser").click(function (e) {
    //     e.preventDefault();

    //     alert()

    // });
    // alert(this.href.substring(this.href.lastIndexOf('/') + 1))
    // alert(this.href.substring(this.href.lastIndexOf('/') + 1))
    // $.ajax({
    //     url : my_url+"/showuser/",
    //     method: 'GET',
    //     headers: {
    //         'Authorization': "Bearer "+jQuery('meta[name="token"]').attr('content')
    //     },
    //     data:$('#formAddUser').serialize(),
    //     dataType:'JSON',
    //     success :  (res) => {
    //         // JSON(res)
    //         if(res.User.length > 0){
    //             $("#user-list").empty();
    //             for (let index = 0; index < res.User.length; index++) {
    //                 $("#user-list").append("<tr>"+
    //                 "<td hidden>"+res.User[index].id+"</td>"+
    //                 "<td><a href='page-users-view.html'>"+res.User[index].prenom+"</a></td>"+
    //                 "<td>"+res.User[index].nom+"</td>"+
    //                 "<td>"+res.User[index].dt_naiss+"</td>"+
    //                 "<td>"+res.User[index].sexe+"</td>"+
    //                 "<td>"+res.User[index].fonction+"</td>"+
    //                 "<td><span class='chip green lighten-5'><span class='green-text'>Active</span></span></td>"+
    //                 "<td><button class='editUser'><i class='material-icons'>edit</i></button></td>"+
    //                 "<td><a href='page-users-view.html'><i class='material-icons'>remove_red_eye</i></a></td>"+
    //                 "</tr>");

    //             }


    //         }
    //         else{
    //             alert('sheet')
    //         }

    //         },
    //     error:() =>{
    //      $("#loadbar").remove();
    //      $("load").append("<div class='card-alert card purple lighten-5'><div class='card-content purple-text'><p>Erreur lors de l'ajout de l'utilisateur</p></div></div>");
    //   }
    // });


});
