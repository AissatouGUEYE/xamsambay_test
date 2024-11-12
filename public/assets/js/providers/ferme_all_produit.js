$(document).ready(function() {
    let my_url = jQuery('meta[name="url"]').attr("content");
    var ferme=jQuery('meta[name="ferme"]').attr("content");
    $.ajax({
        type: "GET",
        url: my_url + "/ferme/produits/ferme_produits/"+ ferme,
        headers: {
            'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
        },
        dataType: "json",
        success: function(resultat) {        
            $("#produit").empty();
            if (resultat.length != 0) {               
                $.each(resultat, function(i, val) {
                    
                    $("#produit").append("<option value='" + val.id + "'> " + val.produit+ " </option>");
                });
                               
            } else {
                $("#produit").empty();
                $("#produit").append("<option value=''> Pas de produit pour cette ferme  </option>");

            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur 90 d.");
        }
    });
    
//   
}


);
