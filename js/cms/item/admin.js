var verify_item_value = 1;
function delete_item(array, verified){
	var id = [];
	$.each(array, function(k, v){
		id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!id.length) {
		p8_window.alert(P8LANG.item_need_select);
		return false;
	}
	var confirm_info = P8LANG.confirm_to_delete;
	if(id.length == 1){
		var row = $('#list_'+id[0]);    
		var fullText = row.find('td:eq(2) a').first().text();
		
		var textLength = fullText.length;
		var maxLength = 30;
		var truncatedText = fullText;
		if (textLength > maxLength) {
			truncatedText = fullText.substring(0, maxLength);        
			//检查截断后的文本是否在字符中间截断
			var lastCompleteCharIndex = truncatedText.lastIndexOf(' ');
			if (lastCompleteCharIndex !== -1 && lastCompleteCharIndex < maxLength) {
				truncatedText = truncatedText.substring(0, lastCompleteCharIndex);
			}
		}
		confirm_info = P8LANG.confirm_to_delete+'<br><span style="color:blue;text-align:centet;">'+truncatedText+'(ID：'+id+')</span>'
	}
	p8_window.confirm(confirm_info, function (r) {
	   if(r){
			$.ajax({
				url: $this_router +'-delete',
				type: 'POST',
				dataType: 'json',
				data: ajax_parameters({id: id, verified: verified === undefined ? 1 : verified, delete_hook: 0}),
				cache: false,
				beforeSend: function(){
					ajaxing({});
				},
				success: function(json){
					ajaxing({action: 'hide'});
					
					for(var i in json){
						$('#delete_'+ json[i]).parent().parent().remove();
					}
					
					request_item(PAGE);
					$("#__reflash_index__").submit();
				}
			});
	   }else{
			return false;
	   }
	});
	return false;
}

function recycle_items(array, verified){
	if(verified == 88) {
		delete_item(array, verified);
	}else{
		var id = [];
		$.each(array, function(k, v){
			id.push(v.replace(/[^0-9]/g, ''));
		});
		
		if(!id.length) {
			p8_window.alert(P8LANG.item_need_select);
			return false;
		}
		var confirm_info = P8LANG.confirm_to_delete;
		if(id.length == 1){
			var row = $('#list_'+id[0]);    
			var fullText = row.find('td:eq(2) a').first().text();
			
			var textLength = fullText.length;
			var maxLength = 30;
			var truncatedText = fullText;
			if (textLength > maxLength) {
				truncatedText = fullText.substring(0, maxLength);        
				//检查截断后的文本是否在字符中间截断
				var lastCompleteCharIndex = truncatedText.lastIndexOf(' ');
				if (lastCompleteCharIndex !== -1 && lastCompleteCharIndex < maxLength) {
					truncatedText = truncatedText.substring(0, lastCompleteCharIndex);
				}
			}
			confirm_info = P8LANG.confirm_to_delete+'<br><span style="color:blue;text-align:centet;">'+truncatedText+'(ID：'+id+')</span>'
		}
		p8_window.confirm(confirm_info, function (r) {
		   if(r){
				$.ajax({
					url: $this_router +'-verify',
					type: 'POST',
					dataType: 'json',
					data: ajax_parameters({id: id, value: 88, verified: verified, push_back_reason: ''}),
					cache: false,
					beforeSend: function(){
						ajaxing({});
					},
					success: function(json){
						ajaxing({action: 'hide'});
						
						for(var i in json){
							$('#delete_'+ json[i]).parent().parent().remove();
						}
						
						request_item(PAGE);
						$("#__reflash_index__").submit();
					}
				});
		   }else{
				return false;
		   }
		});
		return false;
	}
}

function verify_item(array, value, verified){
	verify_item_value = value;
	verify_item_id = [];
	$.each(array, function(k, v){
		verify_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!verify_item_id.length) return false;
	verify_dialog.show();
	
}

function verify_first_item(array, value, verified){
	verify_item_id = [];
	$.each(array, function(k, v){
		verify_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!verify_item_id.length) return false;
	verify_first_dialog.show();
}

function score_item(array, value, verified){
	score_item_id = [];
	$.each(array, function(k, v){
		score_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!score_item_id.length) return false;
	score_dialog.show();
	
}

function set_level(array, value, verified,level_time){
    level_item_id = [];
    $.each(array, function(k, v){
    	level_item_id.push(v.replace(/[^0-9]/g, ''));
    });

    if(!level_item_id.length){
		p8_window.alert(P8LANG.item_need_select);
		return false;
	}

    $.ajax({
    	url: $this_router +'-level',
    	type: 'POST',
    	dataType: 'json',
    	data: ajax_parameters({id: level_item_id, level_time:level_time, value: value, verified: verified === undefined ? 1 : verified}),
    	cache: false,
    	beforeSend: function(){
    		ajaxing({});
    	},
    	success: function(json){
    		ajaxing({action: 'hide'});
			$('#view_to_html2').empty();
            p8_window.alert(lang_array(P8LANG.cms.item.set_level, [json.length]));
            for(var i = 0; i < json.length; i++){
                $('#item_level_'+ json[i]).html(value);
            }
			$('#view_to_html2').append($('<input type="hidden" name="id_range" value="'+ json.join(',') +'" />')).submit();
            request_item(PAGE);
    	}
    });
}

function list_order(array, time, verified){
	if(!verified) return;
	
	up_down_id = [];
	$.each(array, function(k, v){
		up_down_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!up_down_id.length) {
		p8_window.alert(P8LANG.item_need_select);
		return false;
	}
	
	up_down_dialog.show();
}

function move_item(array){
	move_item_id = [];
	$.each(array, function(k, v){
		move_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!move_item_id.length) {
		p8_window.alert(P8LANG.item_need_select);
		return false;
	}
	
	dialog.show();
}

function push_item(id, cid){
	
	$.ajax({
		url: $this_router +'-cluster_push',
		type: 'POST',
		dataType: 'json',
		data: ajax_parameters({id: id, cid: cid}),
		cache: false,
		beforeSend: function(){
			ajaxing({});
		},
		success: function(json){
			ajaxing({action: 'hide'});
			
			p8_window.alert(lang_array(P8LANG.cms.item.cluster_pushed, [json.length]));
		}
	});
}

function push_item_sites(id, cid, push_site, send_time_type, send_time){
	
	$.ajax({
		url: $this_router +'-sites_push',
		type: 'POST',
		dataType: 'json',
		data: ajax_parameters({id: id, cid: cid, push_site: push_site, send_time_type:send_time_type, send_time:send_time}),
		cache: false,
		beforeSend: function(){
			ajaxing({});
		},
		success: function(json){
			ajaxing({action: 'hide'});
			if(json.message){
				if(json.push) {
					p8_window.alert(json.message);
				}else{
					p8_window.confirm(json.message, function (r) {			
						if(r){
							$.ajax({
								url: $this_router +'-sites_push',
								type: 'POST',
								dataType: 'json',
								data: ajax_parameters({id: id, cid: cid, push_site: push_site, send_time_type:send_time_type, send_time:send_time,filter_word_enable:1}),
								cache: false,
								beforeSend: function(){
									ajaxing({});
								},
								success: function(json){
									ajaxing({action: 'hide'});
									if(json.message){
										p8_window.alert(json.message);
									}else{
										p8_window.alert(lang_array(P8LANG.cms.item.cluster_pushed, [json.length]));
									}
								}
							});
						}else{
							return false;
						}					
					});
				}
			}else{
				p8_window.alert(lang_array(P8LANG.cms.item.cluster_pushed, [json.length]));
			}
		}
	});
}

function cms_push_item_sites(id, cid, push_site, send_time_type, send_time){
	
	$.ajax({
		url: $this_router +'-cms_sites_push',
		type: 'POST',
		dataType: 'json',
		data: ajax_parameters({id: id, cid: cid, push_site: push_site, send_time_type:send_time_type, send_time:send_time}),
		cache: false,
		beforeSend: function(){
			ajaxing({});
		},
		success: function(json){
			ajaxing({action: 'hide'});
			if(json.message){
				if(json.push) {
					p8_window.alert(json.message);
				}else{
					p8_window.confirm(json.message, function (r) {
						if(r){
							$.ajax({
								url: $this_router +'-cms_sites_push',
								type: 'POST',
								dataType: 'json',
								data: ajax_parameters({id: id, cid: cid, push_site: push_site, send_time_type:send_time_type, send_time:send_time,filter_word_enable:1}),
								cache: false,
								beforeSend: function(){
									ajaxing({});
								},
								success: function(json){
									ajaxing({action: 'hide'});
									if(json.message){
										p8_window.alert(json.message);
									}else{
										p8_window.alert(lang_array(P8LANG.cms.item.cluster_pushed, [json.length]));
									}
								}
							});
						}else{
							return false;
						}	
					});
				}
			}else{
				p8_window.alert(lang_array(P8LANG.cms.item.cluster_pushed, [json.length]));
			}
		}
	});
}