var UA = navigator.userAgent.toLowerCase();
var isIE = (document.all && window.ActiveXObject && !window.opera) ? true : false;
if(isIE) try {document.execCommand("BackgroundImageCache", false, true);} catch(e) {}
function Dd(i) {return document.getElementById(i);}
function setModule(i, n) {Dd('site').value = i;searchid = i;Dd('p8_select').value = n;$('#search_module').fadeOut('fast');Dd('p8_kw').focus();}
$('.searchbtn').click(function(){
	$('.searchlevel').show({height:'toggle'},500);
});
var PAGE;
function request_item(page){	
	$.ajax({
		url: './search.php',
		data: $('#request').serialize() +'&page='+ (page === undefined ? 1 : page),
		dataType: 'json',
		cache: false,
		beforeSend: function(){
			ajaxing({});
		},
		success: function(json){
			PAGE = page;
			$('#list').empty();
			for(var i in json.list){
				_list_item(json.list[i]);
			}			
			$('#pages').html(json.pages);
			ajaxing({action: 'hide'});		
			window.scrollTo(0, 0);
			$('#search_info').html('<span class="nums_text">为您找到相关结果约'+json.count+'个</span> 用时 <strong style="color:#FF0000">'+json.time+'</strong> 秒</span>');
			init_tr($('#form'));			
			var keywords = $.trim($('#request input[name=keyword]').val());
			if(!keywords.length) return;			
			var keywords = keywords.replace(/[\+\-\*\|\!]/g, '').split(/\s+/);			
			$('.list_item').each(function(){
				for(var i = 0; i < keywords.length; i++){
					var html = $(this).find('.item_title').get(0).innerHTML;
					$(this).find('.item_title').get(0).innerHTML = html.replace(keywords[i], '<font color="red">'+ keywords[i] +'</font>', 'ig');
				}
			});
			
		}
	});
}

function _list_item(json){
	
	var props = ['title', 'timestamp', 'views', 'summary','category_name'];
	
	for(var i = 0; i < props.length; i++){
		if(json[props[i]] === undefined) json[props[i]] = '';
	}
		
	var eachli = '<li class="search_result">'+
		'<div class="title">'+
			'<a href="'+ json.url +'" target="_blank" class="item_title">'+ json.title +'</a>'+
		'</div>'+
		'<div class="item_summary">'+ json.summary +'</div>'+
		'<div class="suctime">'+
			'<div class="time">'+ date('Y-m-d H:i', json.timestamp) +'</div>'+
			'<div class="tags">'+ json.category_name +'</div>'+
			'<div class="actions">阅读('+ json.views +')</div>'+
		'</div>'+
	'</li>';	
	$('#list').append($(eachli));
}

function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return decodeURIComponent(pair[1]);}
       }
       return(false);
}
function init_tr(context){
	
	$('.hover_table tr', context === undefined ? null : $(context)).
	off('mouseover', init_tr.over).on('mouseover', init_tr.over).
	off('mouseout', init_tr.out).on('mouseout', init_tr.out).
	off('mousedown', init_tr.down).on('mousedown', init_tr.down).
	find('td:first:not(.title) input[type=checkbox]').each(function(){
		
		if(this.checked){
			$(this).parent().parent().addClass('clicked');
		}else{
			$(this).parent().parent().removeClass('clicked');
		}
		
		$(this).off('click', init_tr.check).on('click', init_tr.check);
	}).
	find('td input[type=text]').each(function(){ addClass('txt'); });
}

init_tr.over = function(){
	if($(this).hasClass('title')) return;
	
	$(this).addClass('hover_tr');
}
init_tr.out = function(){
	if($(this).hasClass('title')) return;
	
	$(this).removeClass('hover_tr');
}
init_tr.down = function(){
	if($(this).hasClass('title')) return;
	
	if($(this).parent().hasClass('click_changeable') || $(this).parent().parent().hasClass('click_changeable')){
		
		if(!$(this).hasClass('clicked')){
			$(this).addClass('clicked');
		}else{
			$(this).removeClass('clicked');
		}
	}
	
	$('td:first:not(.title) input[type=checkbox]', this).prop('checked', function(){return !this.checked;}).click();
}
init_tr.check = function(e){
	$(this).prop('checked', !this.checked);//alert(this.checked);
	//return false;
}
$('#search_module').hide();