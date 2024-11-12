var base_url = jQuery('meta[name="url"]').attr("content");

const generateRandomString = (num) => {
    const characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let result1 = " ";
    const charactersLength = characters.length;
    for (let i = 0; i < num; i++) {
        result1 += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }

    return result1;
};

if (!localStorage.getItem("visitor_id")) {
    // Génère un nouvel identifiant unique
    const uniqueId = generateRandomString(9);

    // Stocke l'identifiant unique dans localStorage
    localStorage.setItem("visitor_id", uniqueId);
}

// Récupère l'identifiant unique depuis localStorage
const visitorId = localStorage.getItem("visitor_id");
// nbre de produit dans le panier de l'utilisateur

if (visitorId.length == 10) {
    //    alert(visitorId.slice(1));
    id_visitor = visitorId.slice(1);
}

$.ajax({
    type: "GET",
    url: base_url + "/panier/showbymac/" + id_visitor,
    dateType: "json",
    success: function (resultat) {
        // alert(resultat.length);
        if (resultat.length ==0) {
            $(".badge").empty();
        } else {
            $(".badge").empty();
            $(".badge").append(resultat.length);
        }
      
    },
    error: function () {
        alert("Erreur , merci de contacter l'administrateur .");
    },
});

$("#payer_commande").on("click", function () {
    swal({
        title: "Payement",
        text: "Votre commande sera cloturé si le payement n'est pas effectif",
        icon: "warning",
        dangerMode: true,
        buttons: {
            delete: "Oui",
            cancel: "Annuler",
        },
    }).then(function (willDelete) {
        if (willDelete) {
            $("#formPayer").submit();
        }
    });
});

//nbre produit du panier de l'utilisateur
// alert($("#nb_prod").val());
