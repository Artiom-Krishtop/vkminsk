/*
 * jQuery liMarquee v 3.4
 *
 * Copyright 2013, Linnik Yura | LI MASS CODE | http://masscode.ru
 * http://masscode.ru/index.php/k2/item/44-limarquee
 * Free to use
 * 
 * 07.09.2013
 */
(function($){
	$.fn.liMarquee = function(params){
		var p = $.extend({
			direction: 'left',	//РЈРєР°Р·С‹РІР°РµС‚ РЅР°РїСЂР°РІР»РµРЅРёРµ РґРІРёР¶РµРЅРёСЏ СЃРѕРґРµСЂР¶РёРјРѕРіРѕ РєРѕРЅС‚РµР№РЅРµСЂР° (left | right | up | down)
                        strMoveWidth: 0,   //РЁРёСЂРёРЅР° РєРѕРЅС‚РµР№РЅРµСЂР° РґР»СЏ РіРѕСЂРёР·РѕРЅС‚Р°Р»СЊРЅРѕР№ РїСЂРѕРєСЂСѓС‚РєРё
			loop:-1,			//Р—Р°РґР°РµС‚, СЃРєРѕР»СЊРєРѕ СЂР°Р· Р±СѓРґРµС‚ РїСЂРѕРєСЂСѓС‡РёРІР°С‚СЊСЃСЏ СЃРѕРґРµСЂР¶РёРјРѕРµ. "-1" РґР»СЏ Р±РµСЃРєРѕРЅРµС‡РЅРѕРіРѕ РІРѕСЃРїСЂРѕРёР·РІРµРґРµРЅРёСЏ РґРІРёР¶РµРЅРёСЏ
			scrolldelay: 0,		//Р’РµР»РёС‡РёРЅР° Р·Р°РґРµСЂР¶РєРё РІ РјРёР»Р»РёСЃРµРєСѓРЅРґР°С… РјРµР¶РґСѓ РґРІРёР¶РµРЅРёСЏРјРё
			scrollamount:50,	//РЎРєРѕСЂРѕСЃС‚СЊ РґРІРёР¶РµРЅРёСЏ РєРѕРЅС‚РµРЅС‚Р° (px/sec)
			circular: true,		//Р•СЃР»Рё "true" - СЃС‚СЂРѕРєР° РЅРµРїСЂРµСЂС‹РІРЅР°СЏ 
			drag: true,			//Р•СЃР»Рё "true" - РІРєР»СЋС‡РµРЅРѕ РїРµСЂРµС‚Р°СЃРєРёРІР°РЅРёРµ СЃС‚СЂРѕРєРё
			runshort:true,		//Р•СЃР»Рё "true" - РєРѕСЂРѕС‚РєР°СЏ СЃС‚СЂРѕРєР° С‚РѕР¶Рµ "Р±РµРіР°РµС‚", "false" - СЃС‚РѕРёС‚ РЅР° РјРµСЃС‚Рµ
			xml:false			//РџСѓС‚СЊ Рє xml С„Р°Р№Р»Сѓ СЃ РЅСѓР¶РЅС‹Рј С‚РµРєСЃС‚РѕРј
		}, params);
		return this.each(function(){
			var 
			loop = p.loop,
			strWrap = $(this).addClass('str_wrap'),
			fMove = false;
			var code = function(){
				strWrap.wrapInner($('<div>').addClass('str_move'));
				var 
				strMove = $('.str_move',strWrap).addClass('str_origin'),
				strMoveClone = strMove.clone().removeClass('str_origin').addClass('str_move_clone'),
				time = 0;
				if(p.direction == 'left'){			
					var 
					strWrapWidth = strWrap.width(),
					strMoveWidth = p.strMoveWidth;
					strWrap.height(strMove.outerHeight())
					if(strMoveWidth > strWrapWidth){
						var leftPos = -strMoveWidth;
						if(p.circular){
							strMoveClone.clone().css({right:-strMoveWidth, width:strMoveWidth}).appendTo(strMove);
							strMoveClone.css({left:-strMoveWidth, width:strMoveWidth}).appendTo(strMove);
							leftPos = -(strMoveWidth + (strMoveWidth - strWrapWidth));
						}
						var 
						strMoveLeft = strWrapWidth,
						k1 = 0,
						timeFunc1 = function(){		
							var 
							fullS = Math.abs(leftPos),
							time = (fullS / p.scrollamount) * 1000;
							if(parseFloat(strMove.css('left')) != 0){
								fullS = (fullS + strWrapWidth);	
								time = (fullS - (strWrapWidth - parseFloat(strMove.css('left')))) / p.scrollamount * 1000;
							}
							return time;
						}, 
						moveFuncId1 = false,
						moveFunc1 = function(){
							if(loop != 0){
								strMove.stop(true).animate({left:leftPos},timeFunc1(),'linear',function(){
									$(this).css({left:strWrapWidth});
									if(loop == -1){
										moveFuncId1 = setTimeout(moveFunc1,p.scrolldelay);
									}else{
										loop--;
										moveFuncId1 = setTimeout(moveFunc1,p.scrolldelay);
									}
								});
							}
						};
						moveFunc1();	
						strWrap.on('mouseenter',function(){
							$(this).addClass('str_active');
							clearTimeout(moveFuncId1);
							strMove.stop(true);
						}).on('mouseleave',function(){
							$(this).removeClass('str_active');
							$(this).off('mousemove');
							moveFunc1();
						});
						if(p.drag){	
							strWrap.on('mousedown',function(e){
								strMoveLeft = strMove.position().left;
								k1 = strMoveLeft - (e.clientX - strWrap.offset().left);
								$(this).on('mousemove',function(e){
									fMove = true;
									strMove.stop(true).css({left:k1 + (e.clientX - strWrap.offset().left)});
								}).on('mouseup',function(){
									$(this).off('mousemove');
									setTimeout(function(){
										fMove = false
									},50)
								}).on('click',function(){
									if(fMove){
										return false
									}
								});
								return false;
							});
						}else{					
							strWrap.addClass('no_drag');
						};
					}else{
						if(p.runshort){
							var 
							strMoveLeft = strWrapWidth,
							k1 = 0,
							timeFunc = function(){		
								time = (strMoveWidth + strMove.position().left) / p.scrollamount * 1000;
								return time;
							};
							var moveFunc = function(){
								var leftPos = -strMoveWidth;
								strMove.animate({left:leftPos},timeFunc(),'linear',function(){
									$(this).css({left:strWrapWidth});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									}
								});
							};
							moveFunc();	
							strWrap.on('mouseenter',function(){
								$(this).addClass('str_active');
								strMove.stop(true);
							}).on('mouseleave',function(){
								$(this).removeClass('str_active');
								$(this).off('mousemove');
								moveFunc();
							});
							if(p.drag){	
								strWrap.on('mousedown',function(e){
									strMoveLeft = strMove.position().left;
									k1 = strMoveLeft - (e.clientX - strWrap.offset().left);
									$(this).on('mousemove',function(e){
										strMove.stop(true).css({left:k1 + (e.clientX - strWrap.offset().left)});
									}).on('mouseup',function(){
										$(this).off('mousemove');
									});
									return false;
								});
							}else{
								strWrap.addClass('no_drag');
							};
						}else{
							strWrap.addClass('str_static');	
						}
					};
				};
				if(p.direction == 'right'){
					
					strWrap.addClass('str_right');
					var 
					strWrapWidth = strWrap.width(),
					strMoveWidth = p.strMoveWidth;
					strWrap.height(strMove.outerHeight())
					
					
					strMove.css({left:-strMoveWidth, right:'auto'})
					if(strMoveWidth > strWrapWidth){
						var leftPos = strWrapWidth;
						if(p.circular){
							strMoveClone.clone().css({right:'100%', left:'auto', width:strMoveWidth}).appendTo(strMove);
							strMoveClone.css({left:'100%', right:'auto', height:strMoveWidth}).appendTo(strMove);
							//РћРїСЂРµРґРµР»СЏРµРј РєСЂР°Р№РЅСЋСЋ С‚РѕС‡РєСѓ
							leftPos = strMoveWidth;						
						}
						var 
						k2 = 0;
						timeFunc = function(){		
							var 
							fullS = strWrapWidth, //РєСЂР°Р№РЅСЏСЏ С‚РѕС‡РєР°
							time = (fullS / p.scrollamount) * 1000; //РІСЂРµРјСЏ
							if(parseFloat(strMove.css('left')) != 0){
								fullS = (strMoveWidth + strWrapWidth);	
								time = (fullS - (strMoveWidth + parseFloat(strMove.css('left')))) / p.scrollamount * 1000;
							}
							return time;
						};
						var moveFunc = function(){
							
							if(loop != 0){
								strMove.animate({left:leftPos},timeFunc(),'linear',function(){
									$(this).css({left:-strMoveWidth});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
						};
						moveFunc();	
						strWrap.on('mouseenter',function(){
							$(this).addClass('str_active');
							strMove.stop(true);
						}).on('mouseleave',function(){
							$(this).removeClass('str_active');
							$(this).off('mousemove');
							moveFunc();
						});
						if(p.drag){	
							strWrap.on('mousedown',function(e){
								strMoveLeft = strMove.position().left;
								k2 = strMoveLeft - (e.clientX - strWrap.offset().left);
								$(this).on('mousemove',function(e){
									strMove.stop(true).css({left:k2 + e.clientX - strWrap.offset().left});
								});
								return false;
							}).on('mouseup',function(){
								$(this).off('mousemove');
							});
						}else{
							strWrap.addClass('no_drag');
						};
					}else{
						if(p.runshort){
							var k2 = 0;
							var timeFunc = function(){		
								time = (strWrapWidth - strMove.position().left) / p.scrollamount * 1000;
								return time;
							};
							var moveFunc = function(){
								var leftPos = strWrapWidth;
								strMove.animate({left:leftPos},timeFunc(),'linear',function(){
									$(this).css({left:-strMoveWidth});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
							moveFunc();	
							strWrap.on('mouseenter',function(){
								$(this).addClass('str_active');
								strMove.stop(true);
							}).on('mouseleave',function(){
								$(this).removeClass('str_active');
								$(this).off('mousemove');
								moveFunc();
							});
							if(p.drag){	
								strWrap.on('mousedown',function(e){
									strMoveLeft = strMove.position().left;
									k2 = strMoveLeft - (e.clientX - strWrap.offset().left);
									$(this).on('mousemove',function(e){
										strMove.stop(true).css({left:k2 + e.clientX - strWrap.offset().left});
									});
									return false;
								}).on('mouseup',function(){
									$(this).off('mousemove');
								});
							}else{
								strWrap.addClass('no_drag');
							};
						}else{
							strWrap.addClass('str_static');	
						}
					};
				};
				if(p.direction == 'up'){
					strWrap.addClass('str_vertical');
					var 
					strWrapHeight = strWrap.height(),
					strMoveHeight = strMove.height();
					if(strMoveHeight > strWrapHeight){
						var topPos = -strMoveHeight;
						if(p.circular){
							strMoveClone.clone().css({bottom:-strMoveHeight, height:strMoveHeight}).appendTo(strMove);
							strMoveClone.css({top:-strMoveHeight, height:strMoveHeight}).appendTo(strMove);
							topPos = -(strMoveHeight + (strMoveHeight - strWrapHeight));						
						}
						var 
						k2 = 0;
						timeFunc = function(){		
							var 
							fullS = Math.abs(topPos),
							time = (fullS / p.scrollamount) * 1000;
							if(parseFloat(strMove.css('top')) != 0){
								fullS = (fullS + strWrapHeight);	
								time = (fullS - (strWrapHeight - parseFloat(strMove.css('top')))) / p.scrollamount * 1000;
							}
							return time;
						};
						var moveFunc = function(){
							if(loop != 0){
									strMove.animate({top:topPos},timeFunc(),'linear',function(){
									$(this).css({top:strWrapHeight});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
						};
						moveFunc();	
						strWrap.on('mouseenter',function(){
							$(this).addClass('str_active');
							strMove.stop(true);
						}).on('mouseleave',function(){
							$(this).removeClass('str_active');
							$(this).off('mousemove');
							moveFunc();
						});
						if(p.drag){	
							strWrap.on('mousedown',function(e){
								strMoveTop = strMove.position().top;
								k2 = strMoveTop - (e.clientY - strWrap.offset().top);
								$(this).on('mousemove',function(e){
									strMove.stop(true).css({top:k2 + e.clientY - strWrap.offset().top});
								});
								return false;
							}).on('mouseup',function(){
								$(this).off('mousemove');
							});
						}else{
							strWrap.addClass('no_drag');
						};
					}else{
						if(p.runshort){
							var k2 = 0;
							var timeFunc = function(){		
								time = (strMoveHeight + strMove.position().top) / p.scrollamount * 1000;
								return time;
							};
							var moveFunc = function(){
								var topPos = -strMoveHeight;
								strMove.animate({top:topPos},timeFunc(),'linear',function(){
									$(this).css({top:strWrapHeight});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
							moveFunc();	
							strWrap.on('mouseenter',function(){
								$(this).addClass('str_active');
								strMove.stop(true);
							}).on('mouseleave',function(){
								$(this).removeClass('str_active');
								$(this).off('mousemove');
								moveFunc();
							});
							if(p.drag){	
								strWrap.on('mousedown',function(e){
									strMoveTop = strMove.position().top;
									k2 = strMoveTop - (e.clientY - strWrap.offset().top);
									$(this).on('mousemove',function(e){
										strMove.stop(true).css({top:k2 + e.clientY - strWrap.offset().top});
									});
									return false;
								}).on('mouseup',function(){
									$(this).off('mousemove');
								});
							}else{
								strWrap.addClass('no_drag');
							};
						}else{
							strWrap.addClass('str_static');	
						}
					};
				};
				if(p.direction == 'down'){
					
					strWrap.addClass('str_vertical').addClass('str_down');
					var 
					strWrapHeight = strWrap.height(),
					strMoveHeight = strMove.height();
					strMove.css({top:-strMoveHeight, bottom:'auto'})
					if(strMoveHeight > strWrapHeight){
						var topPos = strWrapHeight;
						if(p.circular){
							//РЎРѕР·РґР°РµРј РєР»РѕРЅ СЃРІРµСЂС…Сѓ
							strMoveClone.clone().css({bottom:'100%', top:'auto', height:strMoveHeight}).appendTo(strMove);
							//РЎРѕР·РґР°РµРј РєР»РѕРЅ СЃРЅРёР·Сѓ
							
							strMoveClone.css({top:'100%', bottom:'auto', height:strMoveHeight}).appendTo(strMove);
							//РћРїСЂРµРґРµР»СЏРµРј РєСЂР°Р№РЅСЋСЋ С‚РѕС‡РєСѓ
							topPos = strMoveHeight;						
						}
						var 
						k2 = 0;
						timeFunc = function(){		
							var 
							fullS = strWrapHeight, //РєСЂР°Р№РЅСЏСЏ С‚РѕС‡РєР°
							time = (fullS / p.scrollamount) * 1000; //РІСЂРµРјСЏ
							if(parseFloat(strMove.css('top')) != 0){
								fullS = (strMoveHeight + strWrapHeight);	
								time = (fullS - (strMoveHeight + parseFloat(strMove.css('top')))) / p.scrollamount * 1000;
							}
							return time;
						};
						var moveFunc = function(){
							
							if(loop != 0){
								strMove.animate({top:topPos},timeFunc(),'linear',function(){
									$(this).css({top:-strMoveHeight});
									if(loop == -1){
										
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
						};
						moveFunc();	
						strWrap.on('mouseenter',function(){
							$(this).addClass('str_active');
							strMove.stop(true);
						}).on('mouseleave',function(){
							$(this).removeClass('str_active');
							$(this).off('mousemove');
							moveFunc();
						});
						if(p.drag){	
							strWrap.on('mousedown',function(e){
								strMoveTop = strMove.position().top;
								k2 = strMoveTop - (e.clientY - strWrap.offset().top);
								$(this).on('mousemove',function(e){
									strMove.stop(true).css({top:k2 + e.clientY - strWrap.offset().top});
								});
								return false;
							}).on('mouseup',function(){
								$(this).off('mousemove');
							});
						}else{
							strWrap.addClass('no_drag');
						};
					}else{
						if(p.runshort){
							var k2 = 0;
							var timeFunc = function(){		
								time = (strWrapHeight - strMove.position().top) / p.scrollamount * 1000;
								return time;
							};
							var moveFunc = function(){
								var topPos = strWrapHeight;
								strMove.animate({top:topPos},timeFunc(),'linear',function(){
									$(this).css({top:-strMoveHeight});
									if(loop == -1){
										setTimeout(moveFunc,p.scrolldelay);
									}else{
										loop--;
										setTimeout(moveFunc,p.scrolldelay);
									};
								});
							};
							moveFunc();	
							strWrap.on('mouseenter',function(){
								$(this).addClass('str_active');
								strMove.stop(true);
							}).on('mouseleave',function(){
								$(this).removeClass('str_active');
								$(this).off('mousemove');
								moveFunc();
							});
							if(p.drag){	
								strWrap.on('mousedown',function(e){
									strMoveTop = strMove.position().top;
									k2 = strMoveTop - (e.clientY - strWrap.offset().top);
									$(this).on('mousemove',function(e){
										strMove.stop(true).css({top:k2 + e.clientY - strWrap.offset().top});
									});
									return false;
								}).on('mouseup',function(){
									$(this).off('mousemove');
								});
							}else{
								strWrap.addClass('no_drag');
							};
						}else{
							strWrap.addClass('str_static');	
						}
					};
				};
			}
			if(p.xml){
				$.ajax({
					url: p.xml,					
					dataType: "xml",			
					success: function(xml) {
						strWrap.text($(xml).find('text').text())
						code();
					}
				});
			}else{
				code()	;
			}
		});
	};
})(jQuery);