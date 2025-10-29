document.write('<div id="flying_10" style="width:199px;height:254px;position: absolute;overflow:hidden;z-index:9999"><a href="https://www.ycsyy.com/html/858/" target="_blank"><img width="199" height="123" src="/attachment/core/46/2024_12/10_12/7ac65a30c937bbca.png" title="人才招聘" alt="人才招聘" border="0" /></a><div style="height:8px;clear:both;"></div><a href="https://www.ycsyy.com/html/859/" target="_blank"><img width="199" height="123" src="/attachment/core/46/2024_12/10_12/305da52c2f3dfeee.png" title="招标公告" alt="招标公告" border="0" /></a><div style="height:8px;clear:both;"></div><span style="top:2px;right:2px;cursor:pointer;position: absolute;width: 18px; height: 18px; background: url(/images/close.gif) no-repeat 0 -18px;" onclick="$(\'#flying_10\').hide();"></span></div>'); 
(function(){
	var height_10 = $(window).height(); 
	var width_10 = $(window).width();
	var randheight = Math.random() < 0.5 ? -30*Math.ceil(Math.random()*10) : 30*Math.ceil(Math.random()*10);
	var Hoffset_10 = $('#flying_10').height(); 
	var Woffset_10 = $('#flying_10').width(); 
	var xPos_10 = (width_10-Woffset_10)/2 + randheight; 
	var yPos_10 = (height_10-Hoffset_10)/2 - randheight; 
	var step_10 = 1; 
	var delay_10 = Math.ceil(25+Math.random()*10*(Math.random() < 0.5?-1:1));
	var yon_10 = 0;
	var xon_10 = 0;
	var pause_10 = true; 
	var interval_10; 
	var interval_10 = setInterval(changePos_10, delay_10);
	$('#flying_10').hover(function(){ clearInterval(interval_10); },function(){ interval_10 = setInterval(changePos_10, delay_10);});
	function changePos_10() {
		$('#flying_10').css({left:xPos_10+$(window).scrollLeft(),top:yPos_10+$(window).scrollTop()});																																																								
		if (yon_10) {yPos_10 = yPos_10 + step_10; } 
		else {yPos_10 = yPos_10 - step_10; } 
		if (yPos_10 < 0) { yon_10 = 1;yPos_10 = 0; } 
		if (yPos_10 >= (height_10 - Hoffset_10)) { yon_10 = 0;yPos_10 = (height_10 - Hoffset_10);}																																																																	
		if (xon_10) {xPos_10 = xPos_10 + step_10; } 
		else {xPos_10 = xPos_10 - step_10; } 
		if (xPos_10 < 0) { xon_10 = 1;xPos_10 = 0; } 
		if (xPos_10 >= (width_10 - Woffset_10-20)) { xon_10 = 0;xPos_10 = (width_10 - Woffset_10-20); }
	}
})()
