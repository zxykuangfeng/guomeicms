(function ($) {
    $.fn.extend({
        tab: function (options) {
            var defaults = {         //默认参数
                ev: 'mouseover',    //默认事件'mouseover','click'
                delay: 100,         //延迟时间
                auto: true,         //是否自动切换 true,false
                speed: 2000,        //自动切换间隔时间(毫秒)
                more: false         //是否有more,false,true
            };
            var options = $.extend(defaults, options);  //用户设置参数覆盖默认参数
            return this.each(function () {
                var o = options;
                var obj = $(this);
                var oTil = obj.find('.tabs-li');
                var oBoxs = obj.find('.tabList')
                var oBox = oBoxs.find('.tabListBox');
                var oMore = null;
                var iNum = 0;
                var iLen = oTil.length;
                obj.find('.tabs-li').eq(0).addClass('on')
                oBoxs.each(function () {
                    $(this).find('.tabListBox').eq(0).css('display', 'block')
                })

                obj.find('.more_tab').eq(0).css('display', 'block')
                //鼠标事件绑定
                oTil.bind(o.ev, function () {
                    var _this = this;
                    if (o.ev == 'mouseover' && o.delay) {
                        _this.timer = setTimeout(function () {
                            change(_this);
                        }, o.delay);
                    } else {
                        change(_this);
                    };
                })

                oTil.bind('mouseout', function () {
                    var _this = this;
                    clearTimeout(_this.timer);
                });

                //自动切换效果
                (function autoPlay() {
                    var timer2 = null;
                    if (o.auto) {
                        function play() {
                            iNum++;
                            if (iNum >= iLen) {
                                iNum = 0;
                            };
                            change(oTil.eq(iNum));
                        };
                        timer2 = setInterval(play, o.speed);
                        obj.on('mouseover', function () {
                            clearInterval(timer2);
                        })
                        obj.on('mouseout', function () {
                            timer2 = setInterval(play, o.speed);
                        })
                    };
                })();

                function change(box) {
                    iNum = $(box).index();
                    oTil.removeClass('on');
                    oBoxs.each(function () {
                        $(this).find('.tabListBox').css('display', 'none')
                    })
                    if (o.more) {
                        oMore = obj.find('.more_tab');
                        oMore.css('display', 'none');
                        oMore.eq(iNum).css('display', 'block');
                    };
                    oTil.eq(iNum).addClass('on');
                    oBoxs.each(function () {
                        $(this).find('.tabListBox').eq(iNum).css('display', 'block')
                    })
                }
            });
        },
        tab2: function (options){
            var defaults = {         //默认参数
                ev : 'mouseover',    //默认事件'mouseover','click'
                delay : 200,         //延迟时间
                auto : true,         //是否自动切换 true,false
                speed : 2000,        //自动切换间隔时间(毫秒)
                more : false         //是否有more,false,true
            };
            var options = $.extend(defaults, options);  //用户设置参数覆盖默认参数
            return this.each(function (){
                var o = options;
                var obj = $(this);
                var oTil = obj.find('.tabs-li');
                var oBox = obj.find('.tabListBox');
                var oMore = null;
                var iNum = 0;
                var iLen = oTil.length;
                obj.find('.tabs-li').eq(0).addClass('on')
                obj.find('.tabListBox').eq(0).addClass('show')
                obj.find('.more_tab').eq(0).css('display','block')
                //鼠标事件绑定
                oTil.bind(o.ev , function (){
                    var _this = this;
                    if(o.ev == 'mouseover' && o.delay){
                        _this.timer = setTimeout(function (){
                            change(_this);
                        },o.delay);
                    }else{
                        change(_this);
                    }; 
                })
        
                oTil.bind('mouseout',function (){
                    var _this = this;
                    clearTimeout(_this.timer);
                });
        
                //自动切换效果
                (function autoPlay(){
                    var timer2 = null;
                    if(o.auto){
                        function play(){
                            iNum++;
                            if(iNum >= iLen){
                                iNum =0;
                            };
                            change(oTil.eq(iNum));
                        };
                        timer2 = setInterval(play,o.speed);
        
                        obj.on('mouseover',function (){
                            clearInterval(timer2);
                        })
        
                        obj.on('mouseout',function (){
                            timer2 = setInterval(play,o.speed);
                        })
                    };
                })();
        
                function change(box){
                    iNum = $(box).index();
                    oTil.removeClass('on');
                    oBox.addClass('hide').removeClass('show')
                    if(o.more){
                        oMore = obj.find('.more_tab');
                        oMore.css('display','none');
                        oMore.eq(iNum).css('display','block');
                    };
                    oTil.eq(iNum).addClass('on');
                    oBox.eq(iNum).addClass('show').removeClass('hide')
                                // $('.tabList4').find('.slick-slider').eq(iNum).slick('slickNext',1)
                }
            });
        }
    })
})(jQuery);