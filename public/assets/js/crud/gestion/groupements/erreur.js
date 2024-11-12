$(document).ready(function() {

    var base_url = jQuery('meta[name="url"]').attr("content");

    $("#phoneTable tbody tr").each(function() {
        var phoneNumber = $(this).find("td:eq(5)").text().trim();

        // alert(phoneNumber);
        $.ajax({
            url: base_url + "/utilisateur/telephone/221" + phoneNumber,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            type: 'GET',
            data: { phoneNumber: phoneNumber },
            success: function(response) {

                // alert(response);
                $(this).find(".phone_groupement-cell").text(response[0].nom_groupement);
            }.bind(this),
            error: function() {
                console.error('Error fetching groupement');
            }
        });
    });


    $("#mailTable tbody tr").each(function() {
        var mail = $(this).find("td:eq(5)").text().trim();

        // alert(mail);
        $.ajax({
            url: base_url + "/utilisateur/email/" + mail,
            dataType: "json",
            headers: {
                Authorization: "Bearer " + $('meta[name="token"]').attr('content')
            },
            type: 'GET',
            data: { mail: mail },
            success: function(response) {

                // alert(response);
                $(this).find(".mail_groupement-cell").text(response[0].nom_groupement);
            }.bind(this),
            error: function() {
                console.error('Error fetching groupement');
            }
        });
    });

});
