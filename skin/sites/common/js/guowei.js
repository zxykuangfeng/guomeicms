/**/
var deviceType = /iPad/.test(navigator.userAgent) ? 't' : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent) ? 'm' : 'p',ucBro=/UC/.test(navigator.userAgent);
/*
 * deviceType       //设备判断（p：PC,t：平板，m：手机）
 */
$(document).ready(function() {
	Breakpoints();
    /*导航处理*/
    if (deviceType != 'p') {
        $('.main-nav .nav>li>.dropdown-menu .visible-xs').removeClass('visible-xs');
    }
    $('.main-nav .dropdown a.link').click(function() {
        if (deviceType == 'p' && !Breakpoints.is('xs') && $(this).data("hover")) window.location.href = $(this).attr('href');
    });
    /*下拉菜单动画修复*/
    $(".navlist .dropdown-submenu").hover(
        function() {
            $(this).parent('.dropdown-menu').addClass('overflow-visible');
        },
        function() {
            $(this).parent('.dropdown-menu').removeClass('overflow-visible');
        }
    );
	var nav_li=$(".navlist .dropdown");
	(function($){
		$.fn.hoverDelay = function(options){
		    var defaults = {
		        // 鼠标经过的延时时间
		        hoverDuring: 200,
		        // 鼠标移出的延时时间
		        outDuring: 0,
		        // 鼠标经过执行的方法
		        hoverEvent: function(){
		            // 设置为空函数，绑定的时候由使用者定义
		         	$.noop();
		        },
		        // 鼠标移出执行的方法
		        outEvent: function(){
		            $.noop();    
		    	}
		    };
		    var sets = $.extend(defaults,options || {});
		    var hoverTimer, outTimer;
		    return $(this).each(function(){
		    // 保存当前上下文的this对象
		    var $this = $(this)
		    $this.hover(function(){
		        clearTimeout(outTimer);
		        hoverTimer = setTimeout(function () {
		            // 调用替换
		            sets.hoverEvent.apply($this);
		        }, sets.hoverDuring);
		        }, function(){
		            clearTimeout(hoverTimer);
		            outTimer = setTimeout(function () {
		                sets.outEvent.apply($this);
		            }, sets.outDuring);
		        });
		    });
		}
	})(jQuery);
	// 具体使用，给id为“#test”的元素添加hoverEvent事件
	nav_li.hoverDelay({
	// 自定义，outEvent同
		hoverEvent: function(){
		    $(this).addClass('open');
		},
		outEvent: function(){
		    $(this).removeClass('open');
		}
	});
});