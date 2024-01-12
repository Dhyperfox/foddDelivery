function displayNotify(type, message) {
    switch (type) {
        case "success" :
            $(document.body).append('<div class="container d-flex justify-content-center" id="notification" style="position: absolute;z-index: 2;top: 0px;left: 50%;transform: translateX(-50%);display: none;">');
            $("#notification").html('<div id="notify" class="col-9 alert alert-success" onclick="dontdisplayNotify()" role="alert">' +
                message +
                "</div>");
            $("body > *:not(#notification)").css({
                "animation": "blurIn 1s ease-in-out",
                "animation-fill-mode": "forwards",
                "animation-direction": "normal"
            });
            $("#notification").animate({top: '-120px'});
            $("#notification").animate({top: '300px',}, 800);
            break;
        case "error" :
            $(document.body).append('<div class="container d-flex justify-content-center" id="notification" style="position: absolute;z-index: 2;top: 0px;left: 50%;transform: translateX(-50%);display: none;">');
            $("#notification").html('<div id="notify" class="col-9 alert alert-danger" onclick="dontdisplayNotify()" role="alert">' +
                message +
                "</div>");
            $("body > *:not(#notification)").css({
                "animation": "blurIn 1s ease-in-out",
                "animation-fill-mode": "forwards",
                "animation-direction": "normal"
            });
            $("#notification").animate({top: '-120px'});
            $("#notification").animate({top: '300px',}, 800);
            break;
        case "loginsucc" :
            $(document.body).append('<div class="notification" style="width: 600px;height: fit-content;position: absolute;z-index: 2;top: 300px;left: 50%;transform: translateX(-50%);display: none;">');
            $(".notification").html('<div id="notify" onclick="dontdisplayNotify()" class="alert alert-success" role="alert">' +
                "    Logged in! " +
                "</div>");
            $(".notification").fadeIn(1000);
            $(".notification").slideDown(1000);
            $(".notification").show();
            $("body > *:not(.notification)").css({
                "animation": "blurIn 1s ease-in-out",
                "animation-fill-mode": "forwards",
                "animation-direction": "normal"
            });
            break;
        case "logfirst" :
            $(document.body).append('<div class="notification" style="width: 600px;height: fit-content;position: absolute;z-index: 2;top: 300px;left: 50%;transform: translateX(-50%);display: none;">');
            $(".notification").html('<div id="notify" onclick="dontdisplayNotify()" class="alert alert-danger" role="alert">' +
                "    You have to log in first! " +
                "</div>");
            $(".notification").fadeIn(1000);
            $(".notification").slideDown(1000);
            $(".notification").show();
            $("body > *:not(.notification)").css({
                "animation": "blurIn 1s ease-in-out",
                "animation-fill-mode": "forwards",
                "animation-direction": "normal"
            });
            break;

    }


}

function dontdisplayNotify() {
    $("body > *:not(.notify)").css({
        "animation": "blurOut 1s ease-in-out",
        "animation-fill-mode": "forwards",
        "animation-direction": "normal"
    });
    $("#notification").animate({top: '300px'});
    $("#notification").animate({top: '0px',}, 400);
    $("#notification").delay(800);
    $("#notification").hide();
    setTimeout(function () {
        $('#notification').remove();
    }, 800);

}