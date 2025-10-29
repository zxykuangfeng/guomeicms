function datt(nian,yue,ri,url){

//    计算本月1号是周几；
    var week=new Date(nian+'-'+yue+'-1').getDay();

//计算本月有多少天；
    var days=new Date(nian,yue,0).getDate();
//计算上月有多少天；
    var dayw=new Date(nian,yue-1,0).getDate();

//将日历填回页面；拿出节假日
    var html='';
    for(var i=1;i<=days;i++){
        var time=new Date(nian,yue,i).getTime();
		var mon = yue<=9 ? '0'+yue:yue;
		var day = i<=9 ? '0'+i:i;
        html+="<li data-jr="+yue+"-"+ i +" data-id="+time+" data-date="+ nian+"-"+mon+"-"+day+"><span class=\"fc-date fc-gary\">"+i+"</span></li>"
    }
    $('.date ul').html(html);

//获取当前日期的时间戳；
    var ym=nian;
    var mm=yue;
    var dm=ri;
    var td_time=new Date(ym,mm,dm).getTime();
	var mon_list;
	
	$.ajax({
		url: url,
		type:'POST',
		data: 'date='+ym+'-'+mm+'-'+dm,
		dataType: 'json',
		cache: false,
		success: function(json){
			mon_list = json.mon_list;
			// 日历里面时间戳跟当前时间戳比较；大于等于 可点击；小于不可点击；日期默认单选
			for(var k=0;k<days+dayw;k++){
				var tt_time=$('.date ul li').eq(k).attr('data-id');
				var tt_day=$('.date ul li').eq(k).attr('data-date');
				var num=0;
				//判断是否是周六或周日；添加特殊样式
				var wk=new Date($('.date ul li').eq(k).attr('data-date')).getDay();
				if(wk==6||wk==0){
					$('.date ul li').eq(k).addClass('act_wk')
				}
				if(typeof(tt_day)!='undefined' && tt_day != ''){
					for(var m in mon_list){
						if(tt_day == m){
							$('.date ul li').eq(k).append('<i>'+mon_list[m].length+'场</i>');
							var ihtml = '<div class="bubble">';
							for(var ih in mon_list[m]){
								var iurl = mon_list[m][ih].url;		
								iurl = iurl && typeof(iurl)!='undefined' && iurl!='' ? iurl : '';
								if(iurl)
									ihtml += '<div class="bubblebd"><a href="'+iurl+'" target="_blank">'+mon_list[m][ih].name+'</a>'+(mon_list[m][ih].event ? '<br/>'+mon_list[m][ih].event:'')+'</div>';
								else
									ihtml += '<div class="bubblebd">'+mon_list[m][ih].name+'</div>';
							}							
							ihtml += '</div>';
							$('.date ul li').eq(k).append(ihtml);
						}
					}
				}
				var this_date = new Date();				
				if(yue == this_date.getMonth()+1 && tt_time < td_time){
					$('.date ul li').eq(k).addClass('before_date');
				}
				if(yue == this_date.getMonth()+1 && tt_time > td_time){
					$('.date ul li').eq(k).addClass('after_date');
				}
				if(yue == this_date.getMonth()+1 && tt_time == td_time){
					$('.date ul li').eq(k).addClass('act_date');
					$('.date ul li').eq(k).click(function(){
						var _this=$(this);
						_this.addClass('act_date');
						_this.siblings('li').removeClass('act_date');
					});
				}else{
					$('.date ul li').eq(k).click(function(){
						var _this=$(this);
						_this.addClass('act_date');     //选择开始日期
						_this.siblings('li').removeClass('act_date');
					});
				}
			}
			
		}
	});
	//切换
	$('.date ul li').mousemove(function(){
		var _this=$(this);
		_this.addClass('active_date');
		
	});
	$('.date ul li').mouseout(function(){
		var _this=$(this);
		_this.removeClass('active_date');
		
	});
	//切换
	$('.date ul li').click(function(){
		var _this=$(this);	
		var dr=_this.attr('data-date');
		$("#employment_today").html(dr);
		$.ajax({
			url: url,
			type:'POST',
			data: 'date='+dr,
			dataType: 'json',
			cache: false,
			beforeSend: function(){
				ajaxing({});
			},
			success: function(json){
				$('#employment_list').empty();	
				if(json.list.length<1){
					$('#employment_list').html('暂无安排');
				}else{
					for(var i in json.list){					
						_list_item(json.list[i]);
					}
				}
				ajaxing({action: 'hide'});						
				window.scrollTo(0, 0);						
			}
		});
	});
	/*
	$(".bubble").slide({
		mainCell: ".bubblebd",
		autoPlay: true,
		effect: "topMarquee",
		vis: 4,
		interTime: 100,
		trigger: "click"
	});
	*/

//计算前面空格键；
    var html2='';
    for(var j=dayw-week+1;j<=dayw;j++){
        html2+="<li class='no_date'></li>";
    }
	$('.date ul li').eq(0).before(html2);

//计算后面空格键；
    var html3='';
    for(var x=1;x<43-days-week;x++){
        html3+="<li class='no_date'></li>";
    }
	$('.date ul li').eq(days+week-1).after(html3);
}

function _list_item(jsons){
	var html = '';
	var items = '';
	for(var i = 0; i < jsons.length; i++){		
		var url = jsons[i].url;		
			url = url && typeof(url)!='undefined' && url!='' ? url : '';
		var devent = jsons[i].event;
			devent = devent && typeof(devent)!='undefined' && devent!=0 ? '<li>'+devent+'</li>' : '';	
		items += '<div class="details"><div class="dboxs"><ul>';
		if(url){
			items += '<li><a href="'+url+'" target="_blank">'+jsons[i].name+'</a></li>';
			items += '<li><a href="'+url+'" target="_blank">'+url+'</a></li>';
			items += devent;
		}else{
			items += '<li>'+jsons[i].name+'</li>'+devent;
		}
		
		items += '</ul></div></div>';
	}
	html += items +'</div>';
	$('#employment_list').append($(html));
}
//下一月；
function next(url){
    var y=$('.year').text();
    var m=$('.month').text();
	var d=$('.day').text();
    if(m==12){
        y++;
        m=1;
    }else{
        m++;
    }
    $('.year').text(y);
    $('.month').text(m);
	$('.day').text(d);
    datt(y,m,d,url)
}
//上一月；
function prev(url){
    var y=$('.year').text();
    var m=$('.month').text();
	var d=$('.day').text();
    if(m==1){
        y--;
        m=12;
    }else{
        m--;
    }
    $('.year').text(y);
    $('.month').text(m);
	$('.day').text(d);
    datt(y,m,d,url)
}