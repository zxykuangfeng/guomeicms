function datt(nian,yue,ri,url,date_time,department){

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
        html+="<li data-jr="+yue+"-"+ i +" data-id="+time+" data-date="+ nian+"-"+yue+"-"+i+"><span>"+i+"</span></li>"
    }
    $('.date ul').html(html);

//获取当前日期的时间戳；
    var ym=nian;
    var mm=yue;
    var dm=ri;
    var td_time=new Date(ym,mm,dm).getTime();

// 日历里面时间戳跟当前时间戳比较；大于等于 可点击；小于不可点击；日期默认单选
    for(var k=0;k<days;k++){
        var tt_time=$('.date ul li').eq(k).attr('data-id');
        var num=0;
        //判断是否是周六或周日；添加特殊样式
        var wk=new Date($('.date ul li').eq(k).attr('data-date')).getDay();
        if(wk==6||wk==0){
            $('.date ul li').eq(k).addClass('act_wk')
        }
        if(tt_time == td_time){
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
	//切换
	$('.date ul li').click(function(){
		var _this=$(this);	
		var dr=_this.attr('data-date');
		$("#schedul_today").html(dr);
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
				$('#schedul_list').empty();	
				if(json.length<1){
					$('#schedul_list').html('暂无安排');
				}else{
					for(var i in json){					
						_list_item(json[i],date_time,department);
					}
				}
				ajaxing({action: 'hide'});						
				window.scrollTo(0, 0);						
			}
		});
	});

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

function _list_item(jsons,date_time,department){
	var dep_name = department[jsons[0].dcode];	
	dep_name = dep_name && typeof(dep_name)!='undefined' && dep_name!=0 ? dep_name : '';
	var html = '';
	var html = '<div class="details"><div class="dname">'+dep_name+'</div>';
	var items = '';
	for(var i = 0; i < jsons.length; i++){		
		var date_name = date_time[jsons[i].date_time];
			date_name = date_name && typeof(date_name)!='undefined' && date_name!=0 ? date_name : '';		
		var level = jsons[i].level;		
			level = level && typeof(level)!='undefined' && level!=0 ? '（'+level+'）' : '';
		var phone = jsons[i].phone;
			phone = phone && typeof(phone)!='undefined' && phone!=0 ? '<li>'+phone+'</li>' : '';
		var devent = jsons[i].event;
			devent = devent && typeof(devent)!='undefined' && devent!=0 ? '<li>'+devent+'</li>' : '';	
		items += '<div class="dboxs">' +
		'<ul>' +
		'<li>'+jsons[i].name+level+'<span class="fr">'+date_name+'</span></li>'+phone+devent+
		'</ul>' +
		'</div>';
	}
	html += items +'</div>';
	$('#schedul_list').append($(html));
}
//下一月；
function next(){
    var y=$('.year').text();
    var m=$('.month').text();
    if(m==12){
        y++;
        m=1;
    }else{
        m++;
    }
    $('.year').text(y);
    $('.month').text(m);
    datt(y,m,'','','','')
}
//上一月；
function prev(){
    var y=$('.year').text();
    var m=$('.month').text();
    if(m==1){
        y--;
        m=12;
    }else{
        m--;
    }
    $('.year').text(y);
    $('.month').text(m);
    datt(y,m,'','','','')
}