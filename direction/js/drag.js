
(function(a){a.jqx.jqxWidget("jqxDragDrop","",{});a.extend(a.jqx._jqxDragDrop.prototype,{defineInstance:function(){this.restricter="document";this.handle=false;this.feedback="clone";this.opacity=0.6;this.revert=false;this.revertDuration=400;this.distance=5;this.disabled=false;this.tolerance="intersect";this.data=null;this.dropAction="default";this.dragZIndex=99999;this.appendTo="parent";this.onDragEnd=null;this.onDrag=null;this.onDragStart=null;this.onTargetDrop=null;this.onDropTargetEnter=null;this.onDropTargetLeave=null;this.initFeedback=null;this._touchEvents={mousedown:"touchstart",click:"touchstart",mouseup:"touchend",mousemove:"touchmove",mouseenter:"mouseenter",mouseleave:"mouseleave"};this._restricter=null;this._zIndexBackup=0;this._targetEnterFired=false;this._oldOpacity=1;this._feedbackType;this._isTouchDevice=false;this._events=["dragStart","dragEnd","dragging","dropTargetEnter","dropTargetLeave"]},createInstance:function(){var c=a.data(document.body,"jqx-draggables")||1;this.appendTo=this._getParent();this._isTouchDevice=a.jqx.mobile.isTouchDevice();if((/(static|relative)/).test(this.host.css("position"))){if(!this.feedback||this.feedback==="original"){var d=this._getRelativeOffset(this.host);var b=this.appendTo.offset();if(this.appendTo.css("position")!="static"){b={left:0,top:0}}this.element.style.position="absolute";this.element.style.left=b.left+d.left+"px";this.element.style.top=b.top+d.top+"px"}}this._validateProperties();this._idHandler(c);if(this.disabled){this.disable()}if(typeof this.dropTarget==="string"){this.dropTarget=a(this.dropTarget)}this._refresh();c+=1;a.data(document.body,"jqx-draggables",c);this.host.addClass("jqx-draggable")},_getParent:function(){var b=this.appendTo;if(typeof this.appendTo==="string"){switch(this.appendTo){case"parent":b=this.host.parent();break;case"document":b=a(document);break;case"body":b=a(document.body);break;default:b=a(this.appendTo);break}}return b},_idHandler:function(b){if(!this.element.id){var c="jqx-draggable-"+b;this.element.id=c}},_refresh:function(){this._removeEventHandlers();this._addEventHandlers()},_getEvent:function(b){if(this._isTouchDevice){return this._touchEvents[b]}else{return b}},_validateProperties:function(){if(this.feedback==="clone"){this._feedbackType="clone"}else{this._feedbackType="original"}if(this.dropAction!=="default"){this.dropAction="nothing"}},_removeEventHandlers:function(){this.removeHandler(this.host,"dragstart");this.removeHandler(this.host,this._getEvent("mousedown")+".draggable."+this.element.id,this._mouseDown);this.removeHandler(a(document),this._getEvent("mousemove")+".draggable."+this.element.id,this._mouseMove);this.removeHandler(a(document),this._getEvent("mouseup")+".draggable."+this.element.id,this._mouseUp)},_addEventHandlers:function(){var b=this;this.addHandler(this.host,"dragstart",function(d){d.preventDefault();return false});this.addHandler(this.host,this._getEvent("mousedown")+".draggable."+this.element.id,this._mouseDown,{self:this});this.addHandler(a(document),this._getEvent("mousemove")+".draggable."+this.element.id,this._mouseMove,{self:this});this.addHandler(a(document),this._getEvent("mouseup")+".draggable."+this.element.id,this._mouseUp,{self:this});if(window.frameElement){if(window.top!=null){var c=function(d){b._mouseUp(b)};if(window.top.document.addEventListener){window.top.document.addEventListener("mouseup",c,false)}else{if(window.top.document.attachEvent){window.top.document.attachEvent("onmouseup",c)}}}}},_mouseDown:function(e){var b=e.data.self,d=b._getMouseCoordinates(e),c=b._mouseCapture(e);b._originalPageX=d.left;b._originalPageY=d.top;if(!b._mouseStarted){b._mouseUp(e)}if(c){b._mouseDownEvent=e}if(e.which!==1||!c){return true}e.preventDefault()},_mouseMove:function(c){var b=c.data.self;if(b._mouseStarted){b._mouseDrag(c);return c.preventDefault()}if(b._mouseDownEvent&&b._isMovedDistance(c)){if(b._mouseStart(b._mouseDownEvent,c)){b._mouseStarted=true}else{b._mouseStarted=false}if(b._mouseStarted){b._mouseDrag(c)}else{b._mouseUp(c)}}return !b._mouseStarted},_mouseUp:function(c){var b;if(c.data&&c.data.self){b=c.data.self}else{b=this}b._mouseDownEvent=false;b._movedDistance=false;if(b._mouseStarted){b._mouseStarted=false;b._mouseStop(c)}if(b.feedback&&b.feedback[0]&&b._feedbackType!=="original"&&typeof b.feedback.remove==="function"&&!b.revert){b.feedback.remove()}return false},_isMovedDistance:function(b){var c=this._getMouseCoordinates(b);if(this._movedDistance){return true}if(c.left>=this._originalPageX+this.distance||c.left<=this._originalPageX-this.distance||c.top>=this._originalPageY+this.distance||c.top<=this._originalPageY-this.distance){this._movedDistance=true;return true}return false},_getMouseCoordinates:function(b){if(this._isTouchDevice){return{left:b.originalEvent.touches[0].pageX,top:b.originalEvent.touches[0].pageY}}else{return{left:b.pageX,top:b.pageY}}},destroy:function(){if(!this.host.data("draggable")){return}this.host.removeData("draggable").unbind(".draggable").removeClass("jqx-draggable jqx-draggable-dragging jqx-draggable-disabled");this._mouseDestroy();return this},_disableSelection:function(b){b.each(function(){a(this).attr("unselectable","on").css({"-ms-user-select":"none","-moz-user-select":"none","-webkit-user-select":"none","user-select":"none"}).each(function(){this.onselectstart=function(){return false}})})},_enableSelection:function(b){b.each(function(){a(this).attr("unselectable","off").css({"-ms-user-select":"text","-moz-user-select":"text","-webkit-user-select":"text","user-select":"text"}).each(function(){this.onselectstart=null})})},_mouseCapture:function(b){if(this.disabled){return false}if(!this._getHandle(b)){return false}this._disableSelection(this.host);return true},_getScrollParent:function(b){var c;if((a.browser.msie&&(/(static|relative)/).test(b.css("position")))||(/absolute/).test(b.css("position"))){c=b.parents().filter(function(){return(/(relative|absolute|fixed)/).test(a.curCSS(this,"position",1))&&(/(auto|scroll)/).test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0)}else{c=b.parents().filter(function(){return(/(auto|scroll)/).test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0)}return(/fixed/).test(b.css("position"))||!c.length?a(document):c},_mouseStart:function(d){var c=this._getMouseCoordinates(d),b=this._getParentOffset(this.host);this.feedback=this._createFeedback(d);this._zIndexBackup=this.feedback.css("z-index");this.feedback[0].style.zIndex=this.dragZIndex;this._backupFeedbackProportions();this._backupeMargins();this._positionType=this.feedback.css("position");this._scrollParent=this._getScrollParent(this.feedback);this._offset=this.positionAbs=this.host.offset();this._offset={top:this._offset.top-this.margins.top,left:this._offset.left-this.margins.left};a.extend(this._offset,{click:{left:c.left-this._offset.left,top:c.top-this._offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset(),hostRelative:this._getRelativeOffset(this.host)});this.position=this._generatePosition(d);this.originalPosition=this._fixPosition();if(this.restricter){this._setRestricter()}this.feedback.addClass(this.toThemeProperty("jqx-draggable-dragging"));this._raiseEvent(0,d);if(this.onDragStart&&typeof this.onDragStart==="function"){this.onDragStart(this.position)}this._mouseDrag(d,true);return true},_fixPosition:function(){var c=this._getRelativeOffset(this.host),b=this.position;b={left:this.position.left+c.left,top:this.position.top+c.top};return b},_mouseDrag:function(b,c){this.position=this._generatePosition(b);this.positionAbs=this._convertPositionTo("absolute");this.feedback[0].style.left=this.position.left+"px";this.feedback[0].style.top=this.position.top+"px";this._raiseEvent(2);if(this.onDrag&&typeof this.onDrag==="function"){this.onDrag(this.data,this.position)}this._handleTarget();return false},_over:function(b,d,e){if(this.dropTarget){var f=false,c=this;a.each(this.dropTarget,function(g,h){f=c._overItem(h,b,d,e);if(f.over){return false}})}return f},_overItem:function(i,c,e,g){i=a(i);var b=i.offset(),f=i.outerHeight(),d=i.outerWidth(),h;if(!i||i[0]===this.element){return}switch(this.tolerance){case"intersect":if(c.left+e>b.left&&c.left<b.left+d&&c.top+g>b.top&&c.top<b.top+f){h=true}break;case"fit":if(e+c.left<=b.left+d&&c.left>=b.left&&g+c.top<=b.top+f&&c.top>=b.top){h=true}break}return{over:h,target:i}},_handleTarget:function(){if(this.dropTarget){var b=this.feedback.offset(),c=this.feedback.outerWidth(),d=this.feedback.outerWidth(),e=this._over(b,c,d);if(e.over){if(!this._targetEnterFired){this._targetEnterFired=true;this._raiseEvent(3,{target:e.target});if(this.onDropTargetEnter&&typeof this.onDropTargetEnter==="function"){this.onDropTargetEnter()}}}else{if(this._targetEnterFired){this._targetEnterFired=false;this._raiseEvent(4,{target:e.target});if(this.onDropTargetLeave&&typeof this.onDropTargetLeave==="function"){this.onDropTargetLeave()}}}}},_mouseStop:function(d){var e=false,b=this._fixPosition(),c={width:this.host.outerWidth(),height:this.host.outerHeight()};this.feedback[0].style.opacity=this._oldOpacity;if(!this.revert){this.feedback[0].style.zIndex=this._zIndexBackup}this._enableSelection(this.host);if(this.dropped){e=this.dropped;this.dropped=false}if((!this.element||!this.element.parentNode)&&this.feedback==="original"){return false}this._dropElement(b);this.feedback.removeClass(this.toThemeProperty("jqx-draggable-dragging"));this._raiseEvent(1,d);if(this.onDragEnd&&typeof this.onDragEnd==="function"){this.onDragEnd(this.data)}if(this.onTargetDrop&&typeof this.onTargetDrop==="function"&&this._over(b,c.width,c.height).over){this.onTargetDrop(this.data)}this._revertHandler();return false},_dropElement:function(b){if(this.dropAction==="default"&&this.feedback&&this.feedback[0]!==this.element&&this.feedback!=="original"){if(!this.revert){if(!(/(fixed|absolute)/).test(this.host.css("position"))){this.host.css("position","relative");var c=this._getRelativeOffset(this.host);b=this.position;b.left-=c.left;b.top-=c.top;this.element.style.left=b.left+"px";this.element.style.top=b.top+"px"}}}},_revertHandler:function(){if(this.revert||(a.isFunction(this.revert)&&this.revert())){var b=this;if(this._feedbackType!="original"){if(this.feedback!=null){if(this.dropAction!="none"){a(this.feedback).animate({left:b.originalPosition.left-b._offset.hostRelative.left,top:b.originalPosition.top-b._offset.hostRelative.top},parseInt(this.revertDuration,10),function(){if(b.feedback&&b.feedback[0]&&b._feedbackType!=="original"&&typeof b.feedback.remove==="function"){b.feedback.remove()}})}else{if(b.feedback&&b.feedback[0]&&b._feedbackType!=="original"&&typeof b.feedback.remove==="function"){b.feedback.remove()}}}}else{this.element.style.zIndex=this.dragZIndex;a(this.host).animate({left:b.originalPosition.left-b._offset.hostRelative.left,top:b.originalPosition.top-b._offset.hostRelative.top},parseInt(this.revertDuration,10),function(){b.element.style.zIndex=b._zIndexBackup})}}},_getHandle:function(b){var c;if(!this.handle){c=true}else{a(this.handle,this.host).find("*").andSelf().each(function(){if(this==b.target){c=true}})}return c},_createFeedback:function(c){var b;if(typeof this._feedbackType==="function"){b=this._feedbackType()}else{if(this._feedbackType==="clone"){b=this.host.clone().removeAttr("id")}else{b=this.host}}if(!(/(absolute|fixed)/).test(b.css("position"))){b.css("position","absolute")}if(this.appendTo[0]!==this.host.parent()[0]||b[0]!==this.element){var d={};b.css({left:this.host.offset().left-this._getParentOffset(this.host).left+this._getParentOffset(b).left,top:this.host.offset().top-this._getParentOffset(this.host).top+this._getParentOffset(b).top});b.appendTo(this.appendTo)}if(typeof this.initFeedback==="function"){this.initFeedback(b)}return b},_getParentOffset:function(c){var c=c||this.feedback;this._offsetParent=c.offsetParent();var b=this._offsetParent.offset();if(this._positionType=="absolute"&&this._scrollParent[0]!==document&&a.contains(this._scrollParent[0],this._offsetParent[0])){b.left+=this._scrollParent.scrollLeft();b.top+=this._scrollParent.scrollTop()}if((this._offsetParent[0]==document.body)||(this._offsetParent[0].tagName&&this._offsetParent[0].tagName.toLowerCase()=="html"&&a.browser.msie)){b={top:0,left:0}}return{top:b.top+(parseInt(this._offsetParent.css("border-top-width"),10)||0),left:b.left+(parseInt(this._offsetParent.css("border-left-width"),10)||0)}},_getRelativeOffset:function(c){var d=this._scrollParent||c.parent();c=c||this.feedback;if(c.css("position")==="relative"){var b=this.host.position();return{top:b.top-(parseInt(c.css("top"),10)||0)+d.scrollTop(),left:b.left-(parseInt(c.css("left"),10)||0)+d.scrollLeft()}}else{return{top:0,left:0}}},_backupeMargins:function(){this.margins={left:(parseInt(this.host.css("margin-left"),10)||0),top:(parseInt(this.host.css("margin-top"),10)||0),right:(parseInt(this.host.css("margin-right"),10)||0),bottom:(parseInt(this.host.css("margin-bottom"),10)||0)}},_backupFeedbackProportions:function(){this.feedback[0].style.opacity=this.opacity;this._feedbackProportions={width:this.feedback.outerWidth(),height:this.feedback.outerHeight()}},_setRestricter:function(){if(this.restricter=="parent"){this.restricter=this.feedback[0].parentNode}if(this.restricter=="document"||this.restricter=="window"){this._handleNativeRestricter()}if(typeof this.restricter.left!=="undefined"&&typeof this.restricter.top!=="undefined"&&typeof this.restricter.height!=="undefined"&&typeof this.restricter.width!=="undefined"){this._restricter=[this.restricter.left,this.restricter.top,this.restricter.width,this.restricter.height]}else{if(!(/^(document|window|parent)$/).test(this.restricter)&&this.restricter.constructor!=Array){this._handleDOMParentRestricter()}else{if(this.restricter.constructor==Array){this._restricter=this.restricter}}}},_handleNativeRestricter:function(){this._restricter=[this.restricter==="document"?0:a(window).scrollLeft()-this._offset.relative.left-this._offset.parent.left,this.restricter==="document"?0:a(window).scrollTop()-this._offset.relative.top-this._offset.parent.top,(this.restricter==="document"?0:a(window).scrollLeft())+a(this.restricter==="document"?document:window).width()-this._feedbackProportions.width-this.margins.left,(this.restricter==="document"?0:a(window).scrollTop())+(a(this.restricter==="document"?document:window).height()||document.body.parentNode.scrollHeight)-this._feedbackProportions.height-this.margins.top]},_handleDOMParentRestricter:function(){var d=a(this.restricter),b=d[0];if(!b){return}var c=(a(b).css("overflow")!=="hidden");this._restricter=[(parseInt(a(b).css("borderLeftWidth"),10)||0)+(parseInt(a(b).css("paddingLeft"),10)||0),(parseInt(a(b).css("borderTopWidth"),10)||0)+(parseInt(a(b).css("paddingTop"),10)||0),(c?Math.max(b.scrollWidth,b.offsetWidth):b.offsetWidth)-(parseInt(a(b).css("borderLeftWidth"),10)||0)-(parseInt(a(b).css("paddingRight"),10)||0)-this._feedbackProportions.width-this.margins.left-this.margins.right,(c?Math.max(b.scrollHeight,b.offsetHeight):b.offsetHeight)-(parseInt(a(b).css("borderTopWidth"),10)||0)-(parseInt(a(b).css("paddingBottom"),10)||0)-this._feedbackProportions.height-this.margins.top-this.margins.bottom];this._restrictiveContainer=d},_convertPositionTo:function(f,c){if(!c){c=this.position}var e,b,g;if(f==="absolute"){e=1}else{e=-1}if(this._positionType==="absolute"&&!(this._scrollParent[0]!=document&&a.contains(this._scrollParent[0],this._offsetParent[0]))){b=this._offsetParent}else{b=this._scrollParent}g=(/(html|body)/i).test(b[0].tagName);return this._getPosition(c,e,g,b)},_getPosition:function(c,d,e,b){return{top:(c.top+this._offset.relative.top*d+this._offset.parent.top*d-(a.browser.safari&&a.browser.version<526&&this._positionType=="fixed"?0:(this._positionType=="fixed"?-this._scrollParent.scrollTop():(e?0:b.scrollTop()))*d)),left:(c.left+this._offset.relative.left*d+this._offset.parent.left*d-(a.browser.safari&&a.browser.version<526&&this._positionType=="fixed"?0:(this._positionType=="fixed"?-this._scrollParent.scrollLeft():e?0:b.scrollLeft())*d))}},_generatePosition:function(f){var b=this._positionType=="absolute"&&!(this._scrollParent[0]!=document&&a.contains(this._scrollParent[0],this._offsetParent[0]))?this._offsetParent:this._scrollParent,i=(/(html|body)/i).test(b[0].tagName);var e=this._getMouseCoordinates(f),d=e.left,c=e.top;if(this.originalPosition){var h;if(this.restricter){if(this._restrictiveContainer){var g=this._restrictiveContainer.offset();h=[this._restricter[0]+g.left,this._restricter[1]+g.top,this._restricter[2]+g.left,this._restricter[3]+g.top]}else{h=this._restricter}if(e.left-this._offset.click.left<h[0]){d=h[0]+this._offset.click.left}if(e.top-this._offset.click.top<h[1]){c=h[1]+this._offset.click.top}if(e.left-this._offset.click.left>h[2]){d=h[2]+this._offset.click.left}if(e.top-this._offset.click.top>h[3]){c=h[3]+this._offset.click.top}}}return{top:(c-this._offset.click.top-this._offset.relative.top-this._offset.parent.top+(a.browser.safari&&a.browser.version<526&&this._positionType=="fixed"?0:(this._positionType=="fixed"?-this._scrollParent.scrollTop():(i?0:b.scrollTop())))),left:(d-this._offset.click.left-this._offset.relative.left-this._offset.parent.left+(a.browser.safari&&a.browser.version<526&&this._positionType=="fixed"?0:(this._positionType=="fixed"?-this._scrollParent.scrollLeft():i?0:b.scrollLeft())))}},_raiseEvent:function(c,e){var b=this._events[c],d=a.Event(b),e=e||{};e.position=this.position;this.data=this.data;a.extend(e,this.data);d.args=e;return this.host.trigger(d)},disable:function(){this.disabled=true;this.host.addClass(this.toThemeProperty("jqx-draggable-disabled"))},enable:function(){this.disabled=false;this.host.removeClass(this.toThemeProperty("jqx-draggable-disabled"))},propertyChangedHandler:function(b,c,e,d){if(c==="dropTarget"){if(typeof d==="string"){this.dropTarget=a(d)}}}})})(jQuery);

Hide details

Change log
r598 by hrishi2323 on May 20, 2012   Diff

Party Manager - Address Tab.
jqxwidgets added.

Go to: 	
Project members, sign in to write a code review

Older revisions
All revisions of this file

File info
Size: 18114 bytes, 7 lines
View raw file
