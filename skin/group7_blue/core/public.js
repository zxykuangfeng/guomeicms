$(function () {
    $(document).ready(function(){
        //**show_edit**//                      
        init_labelshows('header_t');
        //**menu**//
        $('.subnav li a').each(function(){  
            if($($(this))[0].href==String(window.location)){  
                $(this).parent().addClass('active');  
            }     
        }); 
        $(".subnav li").mouseenter(function () {
            $(this).find(".subdown").stop().slideDown();
        })
        $(".subnav li").mouseleave(function () {
            $(this).find(".subdown").stop().slideUp();
        })
        $('.topsub .dropdown').hover(function(){
            $(this).addClass('s'); 
            $(this).find('ul.list').slideDown(180);
        },function(){
            $(this).removeClass('s');
            $(this).find('ul.list').slideUp(80);
        })
    });
});