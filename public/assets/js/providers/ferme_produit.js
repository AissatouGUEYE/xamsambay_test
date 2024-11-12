$(document).ready(function() {
    let my_url = jQuery('meta[name="url"]').attr("content");
    $("#activite").on("change", function() {
        var prod = $(this).val();
        // console.log(prod);
                // alert(prod);
   
    $.ajax({
        type: "GET",
        url: my_url + "/ferme/activites/produits/"+ prod ,
        headers: {
            'Authorization': "Bearer " + jQuery('meta[name="token"]').attr('content')
        },
        dataType: "json",
        success: function(resultat) {
                  
            $("#produit").empty();
            if (resultat.length != 0) {               
                $.each(resultat, function(i, val) {
                    //console.log(val);
                    $("#produit").append("<option value='" + val.id_produit + "'> " + val.produit+ " </option>");
                });
                               
            } else {
                $("#produit").empty();
                $("#produit").append("<option value=''> Pas de produit pour cette activite  </option>");

            }
        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur d 50.");
        }
    });
});
});
