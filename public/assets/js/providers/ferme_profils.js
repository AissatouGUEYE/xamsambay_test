$(document).ready(function() {
  
    let my_url = jQuery('meta[name="url"]').attr("content");
    var role = jQuery('meta[name="role"]').attr("content")
   
 
    $.ajax({
        type: "GET",
        url: my_url + "/ferme/roles",
        dataType: "json",
        headers: {
            'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
        },

        success: function(resultat) {

            $("#entite").empty();
           
            $("#entite").append("<option value=''>Choisissez un profil * </option>");
            if (resultat.length != 0) {
                
                if ( role == "ADMIN" || role == "FERME AGRICOLE" ) {
                    for (let i = 0; i < resultat.length; i++) {
                        // alert(resultat[i].pays)
                        $("#entite").append("<option value='" + resultat[i].id + "'> " + resultat[i].role + " </option>");

                    }
                   
                }
            } else {
                    $(".entite").empty();
                    $(".entite").append("<option value=''> Pas de profils pour cette ferme  </option>");
            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur d.");
        }
    });
});
