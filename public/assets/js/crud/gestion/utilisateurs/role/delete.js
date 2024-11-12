$(document).ready(() => {
    // alert('read mode')
    let my_url = jQuery('meta[name="url"]').attr("content");

    deleteEntity = (id) => {
        $.ajax({
            url: my_url+"/deletent/" + id,
            method: 'DELETE',
            headers: {
                'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
            },
            // data:$('#formAddUser').serialize(),
            dataType: 'JSON',
            success: (res) => {
                //  $("#icon_telephone8").attr('value', res[0].login);
                alert('Successfully deleted')
                location.reload();
                //  window.location = "/admin/profil/edit/"+res[0].id
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


});
