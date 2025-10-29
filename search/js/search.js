var UA = navigator.userAgent.toLowerCase();
var isIE = (document.all && window.ActiveXObject && !window.opera) ? true : false;
if(isIE) try {document.execCommand("BackgroundImageCache", false, true);} catch(e) {}
function Dd(i) {return document.getElementById(i);}
function Ds(i) {Dd(i).style.display = '';}
function Dh(i) {Dd(i).style.display = 'none';}
function Dsh(i) {Dd(i).style.display = Dd(i).style.display == 'none' ? '' : 'none';}
function Df(i) {Dd(i).focus();}
function setModule(i, n) {Dd('site').value = i;searchid = i;Dd('p8_select').value = n;$('#search_module').fadeOut('fast');Dd('p8_kw').focus();}
var tip_word = '';
function STip(w) {
	if(w.length < 2) {Dd('search' +
		'_tips').innerHTML = ''; Dh('search_tips'); return;}
	if(w == tip_word) {return;} else {tip_word = w;}
	$.post(AJPath, 'action=tipword&mid='+searchid+'&word='+w, function(data) {
		if(data) {
			Ds('search_tips'); Dd('search_tips').innerHTML = data + '<label onclick="Dh(\'search_tips\');">'+L['search_tips_close']+'&nbsp;&nbsp;</label>';
		} else {
			Dd('search_tips').innerHTML = ''; Dh('search_tips');
		}
	});
}