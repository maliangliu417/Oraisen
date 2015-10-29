/*
 * alexDialog plugin for jQuery v1.11.2
 * A plugin to support a dialog frame for your page
 *
 * Copyright (c) 2015 Alexandra Wang (alex1128@yeah.net)
 * Written Time: 2015-04-16, 11:45
 * Latest modified: 2015-04-17, 14:35
 *
 */

;window.alexDialog = function( options ){

	// default options:
	var defaults = {
		"width": 400,
		"title": "alexDialog Title",
		"descr": "Warning! You are about to run an forbidden program! This may cause extreme danger to your system! Do you still want to run it?",
		"btns": [
			{
				"text": "CONFIRM",
				"handler": "",
				"background": "#28d",
				"fontColor": "#fff",
				"backgroundHover": "#059",
				"fontColorHover": "#eee"
			},{
				"text": "CANCEL",
				"handler": "",
				"background": "#999",
				"fontColor": "#fff",
				"backgroundHover": "#666",
				"fontColorHover": "#eee"
			}
				],
		"toTop": 150,
		"borderRadius": 4,
		"backgroundColor": "#fff",
		"borderColor": "#ccc",
		"titleColor": "#fff",
		"titleFontSize": 14,
		"titleBackgroundColor": "#28d",
		"titleBorderColor": "#059",
		"descColor": "#4e4444",
		"descSize": 14,
		"descLineHeight": 1.5
	};
	var options = $.extend( defaults, options );

	// storage of all the values:
	var _width = options.width,
		_title = options.title,
		_descr = options.descr,
		_btn1 = options.btns[0],
		_btn2 = options.btns[1], // the second button may not exist
		_top = options.toTop,
		_borderRadius = options.borderRadius,
		_backgroundColor = options.backgroundColor,
		_borderColor = options.borderColor,
		_titleColor = options.titleColor,
		_titleFontSize = options.titleFontSize,
		_titleBackgroundColor = options.titleBackgroundColor,
		_titleBorderColor = options.titleBorderColor,
		_descColor = options.descColor,
		_descSize = options.descSize,
		_descLineHeight = options.descLineHeight,
		_marginLeft = ( options.width/2 );

	// verify the validity of user inputs:
	// haven't had a good thought about it...

	// styles:
	var dialogStyle = "position:fixed!important;z-index:10001;top:" + _top + "px;left:50%;width:" + _width + "px;margin-left:-" + _marginLeft + "px;background:" + _backgroundColor + ";border-radius:" + _borderRadius + "px;border:1px solid " + _borderColor + ";overflow:hidden;";
	var titleStyle = "padding:12px 20px 8px 20px;font-size:" + _titleFontSize + "px;color:" + _titleColor + ";background:" + _titleBackgroundColor + ";border-bottom:1px solid " + _titleBorderColor + ";line-height:1em;";
	var contStyle = "padding:20px;overflow:hidden;zoom:1;";
	var descrStyle = "clear:both;margin-bottom:10px;font-size:" + _descSize + "px;color:" + _descColor + ";line-height:" + _descLineHeight + ";";
	var btnsStyle = "display:block;float:right;padding:5px 15px;margin:15px 0 0 10px;font-size:12px;border-radius:" + _borderRadius + "px;";
	var btn1Style = "background:" + _btn1.background + ";color:" + _btn1.fontColor + ";";
	if( _btn2 ){
		_btn2.background = ( _btn2.background )?( _btn2.background ):("#666");
		_btn2.fontColor = ( _btn2.fontColor )?( _btn2.fontColor ):("#f0f0f0");
		var btn2Style = "background:" + _btn2.background + ";color:" + _btn2.fontColor + ";";
	}

	// the template of btns:
	var btnTmpl_1 = '<a id="btn1" href="javascript:void(0);" style="' + btnsStyle + btn1Style + '">' + _btn1.text + '</a>';
	var btnTmpl_2 = (_btn2)?('<a id="btn2" href="javascript:void(0);" style="' + btnsStyle + btn2Style + '">' + _btn2.text + '</a>'):('');
	var btnTmpl = btnTmpl_1 + btnTmpl_2;

	// the template of dialog:
	var Tmpl = '<div id="alexDialog" style="' + dialogStyle + '">\
					<h1 style="' + titleStyle + '">' + _title + '</h1>\
					<div style="' + contStyle + '"><p style="' + descrStyle + '">' + _descr + '</p>' + btnTmpl + '</div>\
				</div>';

	// prepend dialog to body:
	$(Tmpl).prependTo("body");
	var dialog = $("#alexDialog");

	// since all the elements of the dialog have been rendered in page,
	// we can get them using $ and define every event we need:
	// get confirm button and its clicking event:
	var confirmBtn = $("#btn1");
	confirmBtn.click(function(){
		options.btns[0].handler();
		dialog.remove();
	});
	if( _btn2 ){
		var cancelBtn = $("#btn2");
		cancelBtn.click(function(){
			options.btns[1].handler();
			dialog.remove();
		});
	};

	// there are still some other functions to be written...
	// to be continued...

};
