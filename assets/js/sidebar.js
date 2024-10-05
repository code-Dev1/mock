let  toggle = false;
$(document).ready(function () {
    setWindowSize();
    $("#sidebar li").click(function () {
        if(!$(this).hasClass("active")) {
            $(".child-menu").slideUp(500);
            $(".child-menu", this).slideDown(500);
            $(".fa-angle-left").removeClass("fa-angle-down");
            $(".fa-angle-left", this).addClass("fa-angle-down");
            $("#sidebar li").removeClass("active");
            $(this).addClass("active");
        }else {
            $(".child-menu").slideUp(500);
            $(".fa-angle-left").removeClass("fa-angle-down");
            $("#sidebar li").removeClass("active");
        }
    });
    $("#sidebarToggle").click(function () {
        if($(".page-sidebar").hasClass("toggled")){
            toggle = false;
            $(".page-sidebar").removeClass("toggled");
            $(".page-sidebar").find(".active .child-menu").show();
            $(".content").css("margin-right","260px");
            $(".top-nav").css("margin-right","238px");
        }
        else {
            toggle = true;
            $(".page-sidebar").addClass("toggled");
            $(".child-menu").hide();
            $(".content").css("margin-right","60px");
            $(".top-nav").css("margin-right","50.5px");
        }
    });
    $(window).resize(function () {
        setWindowSize();
    });
});
const setWindowSize = () => {
    const width = document.body.offsetWidth;
    if(width<850){
        $(".page-sidebar").addClass("toggled");
        $(".child-menu").hide();
        $(".content").css("margin-right","60px");
        $(".top-nav").css("margin-right","50.5px");
    }else {
        if(toggle == false){
            $(".page-sidebar").removeClass("toggled");
            $(".page-sidebar").find(".active .child-menu").show();
            $(".content").css("margin-right","260px");
            $(".top-nav").css("margin-right","238px")
        }
    }
}