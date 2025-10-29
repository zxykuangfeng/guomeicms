/**
* @example
upload = new P8_Upload({
	upload_url: 'upload_url',
	browse_url: 'browse_url',
	jsonp_url: 'jsonp_url',
	element: {
		src: $('#ele'),
		attribute: 'value'
	},
	param: {
		filter: {
			gif: 0,
			jpg: 1024,	//1K
			...
		},
		count: 2,	//max 2 files
		return_thumb: true,
		thumb_width: 0,
		thumb_height: 0,
		width: 500,
		height: 500,
	},
	callback: function(json){
		
	}
});
**/
function P8_Upload(options){
this.element = options.element || null;

this.callback = options.callback || null;

//upload url
this.upload_url = options.upload_url || P8CONFIG.URI['core']['uploader'].controller +'-upload';
//browse url
this.browse_url = options.browse_url || P8CONFIG.URI['core']['uploader'].controller +'-list';
//store url
this.store_url = options.browse_url || P8CONFIG.URI['core']['uploader'].controller +'-store';
this.delete_url = options.delete_url || P8CONFIG.URI['core']['uploader'].controller +'-delete';
//jsonp callback url
this.jsonp_url = options.jsonp_url || P8CONFIG.url +'/api/upload_jsonp.php';
this.width = options.param && options.param.width ? options.param.width : 800;
this.height = options.param && options.param.height ? options.param.height :600;
this.param = '';
this.dialog = new P8_Dialog({
	width: this.width,
	height: this.height,
	button: true,
	ok: function(){
		if(_this._cutting){
			this.content.empty().append(_this.iframe);
			_this._cutting = false;
		}
		_this.jsonp();
	},
	cancel: function(){
		if(_this._cutting){
			this.content.empty().append(_this.iframe);
			_this._cutting = false;
		}
	}
});
this.iframe = $('<div style="padding:0 16px;"><iframe src="about:blank" width="100%" height="435" frameborder="0" border="0" marginwidth="0" marginheight="0"></iframe></div>');
this.dialog.content.append(this.iframe);
this._cutting = false;

var param = options.param || {};


this.param += 'system='+ SYSTEM +'&module='+ MODULE;

this.param += ajax_parameters(param);



if(param.return_thumb !== undefined){
	this.param += '&thumb=1';
	this.return_thumb = true;
}

if(param.return_cthumb !== undefined){
	this.return_cthumb = true;
}

var _this = this;

this.set_element = function(json){
	if(json.attachments !== undefined){
		var ret;
		
		if(this.return_thumb && json.attachments[0].thumb > 0){
			ret = json.attachments[0].file +'.thumb.jpg';
		}else if(this.return_cthumb && json.attachments[0].thumb == 2){
			ret = json.attachments[0].file +'.cthumb.jpg';
		}else{
			ret = json.attachments[0].file;
			const millions = json.attachments[0].size / 1048576;
			if(millions>2.0){
				$('#frame_error').html('<label id="title-error" class="error" for="title" style="">'+P8LANG.thumb_oversize +':'+ millions.toFixed(2)+'M,'+P8LANG.thumb_oversize_note+'</label>');
			}else{
				$('#frame_error').html('');
			}
		}
		$(_this.element.src).attr(_this.element.attribute, ret);		
	}
};

this.browser = function(){
	this.dialog.set_title(P8LANG.browse);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.br').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.browse_url +'?'+ this.param);
	this.dialog.show();
};
this.common_attr = function(){
	this.dialog.set_title(P8LANG.common_attr);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.ca').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.store_url +'?type=common&'+ this.param);
	this.dialog.show();
};
this.index_banner = function(){
	this.dialog.set_title(P8LANG.index_banner);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.ib').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.store_url +'?type=index&'+ this.param);
	this.dialog.show();
};
this.category_banner = function(){
	this.dialog.set_title(P8LANG.category_banner);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.cb').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.store_url +'?type=category&'+ this.param);
	this.dialog.show();
};
this.sites_banner = function(){
	this.dialog.set_title(P8LANG.sites_banner);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.sb').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.store_url +'?type=sites&'+ this.param);
	this.dialog.show();
};
this.logo_store = function(){
	this.dialog.set_title(P8LANG.logo_store);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.ls').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.store_url +'?type=logo&'+ this.param);
	this.dialog.show();
};

this.uploader = function(){
	this.dialog.button_bar.hide();
	this.dialog.set_title(P8LANG.upload);
	if(this.chosebar){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.up').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.upload_url +'?'+ this.param);
	this.dialog.show();
};

this.capture = function(){
	this.dialog.set_title(P8LANG.capture);
	if(this.chosebar !== undefined){
		this.chosebar.find('input').removeClass('active');
		this.chosebar.find('.wb').addClass('active');
	}
	this.dialog.content.find('iframe').attr('src', this.upload_url +'?'+ this.param + '&only=capture');
	this.dialog.show();
};

this.add_param = function(obj){
	this.param += ajax_parameters(obj);
};

this.choseup = function(){
	this.dialog.element.css({
		width: '800px',
		height: '600px'
	});
	this.dialog.content.height(30);
	this.dialog.button_bar.hide();
	this.dialog.set_title(P8LANG.core.uploader.select);
	this.chosebar = $('<div class="chosebar">'+
		'<input type="button" value="'+ P8LANG.localup +'"  class="up">'+
		'<input type="button" value="'+ P8LANG.chosedone +'"  class="br">'+
		'<input type="button" value="'+ P8LANG.common_attr +'"  class="ca">'+
		'<input type="button" value="'+ P8LANG.index_banner +'"  class="ib">'+
		'<input type="button" value="'+ P8LANG.category_banner +'"  class="cb">'+
		'<input type="button" value="'+ P8LANG.sites_banner +'"  class="sb">'+
		'<input type="button" value="'+ P8LANG.logo_store +'"  class="ls">'+
		'<input type="button" value="'+ P8LANG.capture +'"  class="wb">'+
		'</div>');
	this.dialog.content.html(this.chosebar);
	this.dialog.show();
	//open up
	ajaxing({});
	_this.chose('uploader');
	ajaxing({action: 'hide'});
	//on up
	$('.up', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('uploader');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	
	//on br
	$('.br', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('browser');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	//on ca
	$('.ca', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('common_attr');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	$('.ib', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('index_banner');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	//on cb
	$('.cb', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('category_banner');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	//on sb
	$('.sb', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('sites_banner');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	//on ls
	$('.ls', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('logo_store');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
	//web
	$('.wb', this.chosebar).click(function(){
		ajaxing({});
		_this.chose('capture');
		ajaxing({action: 'hide'});
		$('.content_container .content').attr("style","height:auto");
	});
};


this.chose = function(b){
	this.dialog.content.append(this.iframe);
	this.dialog.element.css({
		width: '800px',
		height: '600px'
	});
	this.dialog.content.height(362);
	this.dialog.button_bar.show();
	if(b=='uploader')this.uploader();
	if(b=='uploader')this.dialog.button_bar.hide();
	if(b=='browser')this.browser();
	if(b=='common_attr')this.common_attr();
	if(b=='index_banner')this.index_banner();
	if(b=='category_banner')this.category_banner();
	if(b=='sites_banner')this.sites_banner();
	if(b=='logo_store')this.logo_store();
	if(b=='capture')this.capture();
};
this.image_cut = function(){
	
	var url = this.element.src.val();
	if(!url.length) return;
	url = url.replace(/\.thumb\.jpg/i, '');
	url = url.replace(/\.\./g, '');
    url = url.replace(/\.\//g, '');
	url = url.replace(/\/\.\//g, '/');
    url = url.replace(/\/\.\./g, '');
	if(this.param)
		var w = window.open(P8CONFIG.controller +'/core/uploader-image_cut?url='+ encodeURIComponent(url) +'&'+this.param+'&system=' + SYSTEM +'&module='+ MODULE);
	else
		var w = window.open(P8CONFIG.controller +'/core/uploader-image_cut?url='+ encodeURIComponent(url) +'&system=' + SYSTEM +'&module='+ MODULE);
	
	this._cutting = true;
	
	this.dialog.show();
	this.dialog.content.html(P8LANG.core.uploader.click_to_get_cut_image);
	this.dialog.button_bar.show();
	return;
};

this._callback = function(json){
	if(_this.element){
		_this.set_element(json);
	}
	
	if(_this.callback){
		_this.callback(clone(json));
	}
	
	P8_Upload.callback(json);
	
	setcookie('p8_upload_json', '', -1, '/', P8CONFIG.base_domain);
};

this.jsonp = function(){
	$.getJSON(this.jsonp_url +'?callback=?', this._callback);
};

}

P8_Upload.uploader_element = null;
P8_Upload.browser_element = null;

P8_Upload.callback = function(json){
	if(json.attachments !== undefined && json.attachments.length){
		
		if(MODULE && json.action == 'upload'){
			P8_Upload.queue(json.attachments);
		}
	}
};

//delete
P8_Upload.del = function(form_submit){
	var cookie = get_cookie('uploaded_attachments');
	
	if(cookie !== undefined){
		var att = cookie[attachment_hash];
		if(att !== undefined && !form_submit){
			set_cookie('uploaded_attachments['+ attachment_hash +']', '', -1, document.base_domain);
			
			att = att.split(',');
			
			var form = $('<form method="post" action="'+ P8CONFIG.URI['core']['uploader'].controller +'-delete" target="delete_attachment"></form>');
			var iframe = $('<iframe name="delete_attachment" style="display: none; height: 0px; width: 0px;"></iframe>');
			$(document.body).prepend(form).prepend(iframe);
			
			form.append($('<input type="hidden" name="system" value="'+ SYSTEM +'" />'));
			for(var i = 0; i < att.length; i++){
				form.append($('<input type="hidden" name="id[]" value="'+ att[i] +'" />'));
			}
			form.get(0).submit();
		}
	}
};

P8_Upload.queue = function(json){
	if(!attachment_hash) return;
	
	var cookie = get_cookie('uploaded_attachments') || {};
	var str = cookie[attachment_hash] || '';
	for(var i = 0; i < json.length; i++){
		str += json[i].id +',';
	}
	//cookie for php
	set_cookie('uploaded_attachments['+ attachment_hash +']', str, 0, document.base_domain);
};

P8_Upload.verify_ext = function(file, filter){
	var ext = file.substr(file.lastIndexOf('.') +1, file.length).toLowerCase();
	
	return filter[ext] != undefined ? ext : '';
};

P8_Upload.verify_size = function(file, ext, filter){
	var tmp_img = new Image();
	
	tmp_img.src = file;
	var max_size = parseInt(filter[ext]);
	if(max_size > 0 && tmp_img.fileSize > max_size){
		return false;
	}
	return true;
};

P8_Upload.verify = function(file, new_file, append_to){
	var filename = file.value;
	
	var ext = P8_Upload.verify_ext(filename, filter_json);
	
	if(!ext){
		alert(P8LANG.core.uploader.type_denied);
		
		++file_id;
		
		$(file).replaceWith(new_file);
		return '';
	}
	
	if(!P8_Upload.verify_size(filename, ext, filter_json)){
		alert(P8LANG.core.uploader.oversize);
		
		++file_id;
		
		$(file).replaceWith(new_file);
		return '';
	}
	
	if(++file_count < upload_count){
		$(append_to).append(new_file);
	}
	$('#upload_file_preview').show();		
	$('#upload_file_name').html(file.files[0].name);
	if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif'){		
		if(window.FileReader) {
			var reader = new FileReader();
				reader.onload = function(e) {
				var img = document.getElementById("preview_photo");
				img.src = e.target.result;
			};
			reader.readAsDataURL(file.files[0]);			
			$('#preview_photo').show();
			$('#fileNotice').hide();
			$('.uploder_form .uploder_file').css({
				"bottom": '12px',
				"top": 'auto'
			});
			$('#filePicker').css({
				"padding-top" : '0',
			});
        } else {
            alert(P8LANG.core.uploader.preview_denied);
        }
	}else{
		$('#upload_file_preview').hide();
		$('#fileNotice').show();
		$('.uploder_form .uploder_file').css({
			"top" : '65px',
		});
		$('#filePicker').css({
			"padding-top" : '30px',
		});
	}
};
