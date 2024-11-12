addMarketDayInput= ()=>{
    var days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"]
    var content = "<div class='input-field col s12 l6 m6' id='days-container'>"+
    "<select class='browser-default' id='market_day' name='market_day'></select>"+
    "<label for='type_market' class='active'>Type de marché</label></div>"
    $("#market-type-containers").after(content);
    for (let index = 0; index < days.length; index++) {
        $("#market_day").append("<option value='" + days[index] + "'  >" + days[index] + "</option>");
    }
    $("#localite-container").addClass("l12 m12");
}
removeMarketDayInput=()=>{
    $("#days-container").remove();
    $("#localite-container").removeClass("l12 m12").addClass("l6 m6");
}
$(document).ready(function () {
    // e.preventDefault();
    // alert($("#type_market").val()   )
    if ($("#type_market").val() == 2) {
        addMarketDayInput();

        $("#type_market").change(function (e) {
            e.preventDefault();
            if ($(this).val() == 2) {
                addMarketDayInput();
            } else if ($(this).val() == 1) {
                removeMarketDayInput();
            }
        });
    }
    else {
        $("#type_market").change(function (e) {
            e.preventDefault();
            if ($(this).val() == 2) {
                addMarketDayInput();
            } else if ($(this).val() == 1) {
                removeMarketDayInput();
            }
        });
    }
});

