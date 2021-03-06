/* jquery.browser.js */
(function(c){var a,b=navigator.userAgent||"";c.uaMatch=function(e){e=e.toLowerCase();var d=/(chrome)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version)?[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||e.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+))?/.exec(e)||[];return{browser:d[1]||"",version:d[2]||"0"}};a=c.uaMatch(b);c.browser={};if(a.browser){c.browser[a.browser]=true;c.browser.version=a.version}if(c.browser.webkit){c.browser.safari=true}}(jQuery));

/* iframe autoheight jQuery Plugin. Version: 1.9.5 */
!function(e){e.fn.iframeAutoHeight=function(t){function i(e){h.debug&&h.debug===!0&&window.console&&console.log(e)}function n(t,n){i("Diagnostics from '"+n+"'");try{i("  "+e(t,window.top.document).contents().find("body")[0].scrollHeight+" for ...find('body')[0].scrollHeight"),i("  "+e(t.contentWindow.document).height()+" for ...contentWindow.document).height()"),i("  "+e(t.contentWindow.document.body).height()+" for ...contentWindow.document.body).height()")}catch(r){i("  unable to check in this state")}i("End diagnostics -> results vary by browser and when diagnostics are requested")}var r;if(e.browser===r){var o=[];return o.push("WARNING: you appear to be using a newer version of jquery which does not support the $.browser variable."),o.push("The jQuery iframe auto height plugin relies heavly on the $.browser features."),o.push("Install jquery-browser: https://raw.github.com/house9/jquery-iframe-auto-height/master/release/jquery.browser.js"),alert(o.join("\n")),e}var h=e.extend({heightOffset:0,minHeight:0,maxHeight:0,callback:function(){},animate:!1,debug:!1,diagnostics:!1,resetToMinHeight:!1,triggerFunctions:[],heightCalculationOverrides:[]},t);return i(h),this.each(function(){function t(e){var t=null;return jQuery.each(o,function(i,n){return e[n]?(t=s[n],!1):void 0}),null===t&&(t=s["default"]),t}function r(r){h.diagnostics&&n(r,"resizeHeight"),h.resetToMinHeight&&h.resetToMinHeight===!0&&(r.style.height=h.minHeight+"px");var o=e(r,window.top.document).contents().find("body"),s=t(e.browser),a=s(r,o,h,e.browser);i(a),a<h.minHeight&&(i("new height is less than minHeight"),a=h.minHeight),h.maxHeight>0&&a>h.maxHeight&&(i("new height is greater than maxHeight"),a=h.maxHeight),a+=h.heightOffset,i("New Height: "+a),h.animate?e(r).animate({height:a+"px"},{duration:500}):r.style.height=a+"px",h.callback.apply(e(r),[{newFrameHeight:a}])}var o=["webkit","mozilla","msie","opera"],s={};s["default"]=function(e,t,i){return t[0].scrollHeight+i.heightOffset},jQuery.each(o,function(e,t){s[t]=s["default"]}),jQuery.each(h.heightCalculationOverrides,function(e,t){s[t.browser]=t.calculation});var a=0,c=this.contentDocument||this.contentWindow.document;if(i(this),h.diagnostics&&n(this,"each iframe"),h.triggerFunctions.length>0){i(h.triggerFunctions.length+" trigger Functions");for(var u=0;u<h.triggerFunctions.length;u++)h.triggerFunctions[u](r,this)}if(e.browser.webkit||e.browser.opera||e.browser.chrome){i("browser is webkit or opera"),e(this).load(function(){var e=0,t=this,n=function(){r(t)};0===a?e=500:t.style.height=h.minHeight+"px",i("load delay: "+e),setTimeout(n,e),a++});var g=e(this).attr("src");e(this).attr("src",""),e(this).attr("src",g)}else"complete"===c.readyState?r(this):e(this).load(function(){r(this)})})}}(jQuery);; 

jQuery( document ).ready(function( $ ) {
	var $iframe = $('#install-wizard');

	$('.oneandone-loading').appendTo('body');
	$iframe.ready(function () {
		$('#install-loading').css('display', 'block');
	});
	$iframe.load(function () {
		$('#install-loading').fadeOut('slow');
	});

	$iframe.css({ 'opacity' : 0 });
	$iframe.iframeAutoHeight({
		heightOffset: 20,
		callback: function(callbackObject) {
			$iframe.animate({opacity: 1 }, 'slow');
		}
	});
});

jQuery(document).ready(function(){
	// Select and loop the container element of the elements you want to equalise
	jQuery('.oneandone-plugin-browser').each(function(){
		// Cache the highest
		var highestBox = 0;
		// Select and loop the elements you want to equalise
		jQuery('.plugin-card .plugin-card-top', this).each(function(){
			// If this box is higher than the cached highest then store it
			if(jQuery(this).height() > highestBox) {
				highestBox = jQuery(this).height();
			}

		});
		// Set the height of all those children to whichever was highest
		jQuery('.plugin-card-top',this).height(highestBox);
	});

});