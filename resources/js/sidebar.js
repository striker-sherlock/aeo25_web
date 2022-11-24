$(document).ready(function () {
    if ($(window).width() > 1200) {
        var trigger = $(".page-content");

        trigger.click(function () {
            $("#show-sidebar").show();
            $("#page-toggled").removeClass("toggled");
            $("#footer-toggled").removeClass("toggled");
        });
    } else {
        $("#page-toggled").addClass("toggled");
        $("#footer-toggled").addClass("toggled");
    }

    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
        $(".footer-wrapper").removeClass("toggled");
        $("#show-sidebar").show();
        $("#sidebar").hide();
    });
    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
        $(".footer-wrapper").addClass("toggled");
        $("#show-sidebar").hide();
        $("#sidebar").show();
    });

    $(".sidebar-dropdown > a").click(function () {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });
});
