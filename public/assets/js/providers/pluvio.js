$(document).ready(function() {
    var base_url  = jQuery('meta[name="url"]').attr('content');
    $('#reseau-gerant').change(function (e) {
        e.preventDefault();
    var id = $(this).val();
    // alert(id)
    $.ajax({
        type: "GET",
        url: base_url+"/mlpluvio/reseau/"+id,
        dataType: "json",
        headers: {
            Authorization:
                "Bearer " + jQuery('meta[name="token"]').attr("content"),
        },
        success: function(resultat) {
            // alert('Cool')
        // alert(resultat.length);
            $("#pluvio").empty();

            if (resultat.length != 0) {
                $.each(resultat, function(i, val) {
                    if (val.id_profil == null) {
                        $("#pluvio").append("<option value='" + val.id + "'> " + val.localite + " </option>");

                    }
                    else{
                        // $("#pluvio").append("<option value=''> Pluvio inexistant </option>");

                    }
                    // console.log(val.nom_typentite)
                    // $("#pluvio").append("<option value=''> Pluvio inexistant </option>");

                });
            }
            else{
                    $("#pluvio").append("<option value=''> Pluvio inexistant </option>");
            }

        },
        error: function() {
            alert("Erreur, merci de contacter l'administrateur.");
        }
    });
})
});
