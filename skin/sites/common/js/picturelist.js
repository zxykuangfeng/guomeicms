$(function(){
    //棣栭〉鍜屽唴椤靛浘鐗囧垪琛
    var block_w = [];
    for(var i=0;i<$('.imglists li').length;i++){
      block_w[i] = $('.imglists li').eq(i).width(); //姹傚嚭鏈€澶у?楂
    };
    var maxWidth = Math.max.apply(null, block_w) ;// 鍥剧墖鏈€澶у?搴
    var maxHeight = parseInt(maxWidth / 1.4);聽聽聽 // 鍥剧墖瀹介珮姣斾緥涓?.4

    //璁剧疆鍥剧墖瀹介珮
    for(var i=0;i<$('.imglists li').length;i++){
        var width = $('.imglists li img').eq(i).width();聽 // 鍥剧墖瀹為檯瀹藉害
        var height = $('.imglists li img').eq(i).height();聽 // 鍥剧墖瀹為檯楂樺害
        $('.imglists li').eq(i).css("height", maxHeight+ 'px');聽聽 // 璁惧畾瀹為檯鏄剧ず楂樺害

        if(height < maxHeight){// 妫€鏌ュ浘鐗囬珮搴︽槸鍚﹀皬浜庢?甯搁珮搴
            var ratio = maxHeight / height; // 璁＄畻缂╂斁姣斾緥
            $('.imglists li img').eq(i).css("height", maxHeight + 'px');聽聽 // 璁惧畾瀹為檯鏄剧ず楂樺害
        }else if(height > maxHeight){ // 妫€鏌ュ浘鐗囨槸鍚﹁秴楂樺害
            var ratio = maxHeight / height; // 璁＄畻缂╂斁姣斾緥
            $('.imglists li img').eq(i).css("position", "absolute");
            $('.imglists li img').eq(i).css("width", maxWidth + 'px');聽聽 // 璁惧畾瀹為檯鏄剧ず瀹藉害
            $('.imglists li img').eq(i).css("margin-top", "-"+(height * ratio)/2+'px');聽聽 //
        }
    }

  });