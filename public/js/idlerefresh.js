
!function(n){"use strict";n.fn.idle=function(e){var t,i,o={idle:6e4,events:"mousemove keydown mousedown touchstart",onIdle:function(){},onActive:function(){},onHide:function(){},onShow:function(){},keepTracking:!0,startAtIdle:!1,recurIdleCall:!1},c=e.startAtIdle||!1,d=!e.startAtIdle||!0,l=n.extend({},o,e),u=null;return n(this).on("idle:stop",{},function(){n(this).off(l.events),l.keepTracking=!1,t(u,l)}),t=function(n,e){return c&&(e.onActive.call(),c=!1),clearTimeout(n),e.keepTracking?i(e):void 0},i=function(n){var e,t=n.recurIdleCall?setInterval:setTimeout;return e=t(function(){c=!0,n.onIdle.call()},n.idle)},this.each(function(){u=i(l),n(this).on(l.events,function(){u=t(u,l)}),(l.onShow||l.onHide)&&n(document).on("visibilitychange webkitvisibilitychange mozvisibilitychange msvisibilitychange",function(){document.hidden||document.webkitHidden||document.mozHidden||document.msHidden?d&&(d=!1,l.onHide.call()):d||(d=!0,l.onShow.call())})})}}(jQuery);


$(document).idle({
    onIdle: function(){
		location.reload();
    },
  idle: 3600000
});

 