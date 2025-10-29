function delete_item(array, verified,iscore = 0){
	var id = [];
	$.each(array, function(k, v){
		id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!id.length) return false;
	
	//if(!confirm(P8LANG.confirm_to_delete)) return;	
	//var delete_hook = confirm(P8LANG.retain_hook_module_data) ? 0 : 1;
	p8_window.confirm(P8LANG.confirm_to_delete, function (r) {
		if(r){
			var action_url = iscore ? $this_router +'/item-delete' : $this_router +'-delete';
			$.ajax({
				url: action_url,
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
				}
			});
		}else{
			return false;
		}
	});
	return false;
}

function score_item(array, value, verified){
	score_item_id = [];
	$.each(array, function(k, v){
		score_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!score_item_id.length) return false;
	score_dialog.show();
	
}

function verify_item(array, value, verified){
	verify_item_id = [];
	$.each(array, function(k, v){
		verify_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!verify_item_id.length) return false;
	verify_dialog.show();
	
}

function set_level(array, value, verified,level_time){
    level_item_id = [];
    $.each(array, function(k, v){
    	level_item_id.push(v.replace(/[^0-9]/g, ''));
    });

    if(!level_item_id.length) return false;

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
            p8_window.alert(lang_array(P8LANG.sites.item.set_level, [json.length]));
            for(var i = 0; i < json.length; i++){
                $('#item_level_'+ json[i]).html(value);
            }
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
	
	if(!up_down_id.length) return false;
	
	up_down_dialog.show();
}

function move_item(array){
	move_item_id = [];
	$.each(array, function(k, v){
		move_item_id.push(v.replace(/[^0-9]/g, ''));
	});
	
	if(!move_item_id.length) return false;
	
	dialog.show();
}

function push_item(id, cid, send_time_type, send_time){
	
	$.ajax({
		url: $item_router +'-cluster_push',
		type: 'POST',
		dataType: 'json',
		data: ajax_parameters({id: id, cid: cid, send_time_type:send_time_type, send_time:send_time}),
		cache: false,
		beforeSend: function(){
			ajaxing({});
		},
		success: function(json){
			ajaxing({action: 'hide'});			
			if(json.message){
				//if(!confirm(json.message)) return;
				p8_window.confirm(json.message, function (r) {
					if(r){
						$.ajax({
							url: $item_router +'-cluster_push',
							type: 'POST',
							dataType: 'json',
							data: ajax_parameters({id: id, cid: cid, send_time_type:send_time_type, send_time:send_time,filter_word_enable:1}),
							cache: false,
							beforeSend: function(){
								ajaxing({});
							},
							success: function(json){
								ajaxing({action: 'hide'});						
								p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));								
							}
						});
					}else{
						return false;
					}
				});
			}else{
				p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));				
			}
		}
	});
}

function push_item_sites(id, cid, push_site, send_time_type, send_time){
	
	$.ajax({
		url: $item_router +'-sites_push',
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
				//if(!confirm(json.message)) return;
				p8_window.confirm(json.message, function (r) {
					if(r){
						$.ajax({
							url: $item_router +'-sites_push',
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
									p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));
								}			
							}
						});
				}else{
					return false;
				}
			});
			}else{
				p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));
			}			
		}
	});
}

function sites_push_sites(id, cid, push_site, send_time_type, send_time){
	
	$.ajax({
		url: $item_router +'-sites_push_sites',
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
				//if(!confirm(json.message)) return;
				p8_window.confirm(json.message, function (r) {
					if(r){
						$.ajax({
							url: $item_router +'-sites_push_sites',
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
									p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));
								}			
							}
						});
					}else{
						return false;
					}
				});
			}else{
				p8_window.alert(lang_array(P8LANG.sites.item.cluster_pushed, [json.length]));
			}			
		}
	});
}