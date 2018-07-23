! ( function( $){
'use strict';
function tbbs_makeRemoveClassHandler( regex){
return function (index, classes){
return classes.split(/\s+/).filter(function (el){return regex.test(el);}).join(' ');
}}
var tbbsMasonry=function(){
this.init();
}
tbbsMasonry.prototype={
init:function(){
this.applyMasonry();
},
options:function( opts){
return $.extend( {
itemSelector:'.grid-item',
percentPosition:true,
masonry:{
columnWidth:'.grid-sizer',
gutter:'.gutter-sizer'
},
tbbsGridData:{},
tbbsPadding:0,
tbbsHeight:180,
tbbsResizable:false,
tbbsSave:false,
}, opts);
},
applyMasonry:function(){
var self=this;
$( '[data-bs-masonry]').each( function(){
var $this=$( this),
options=self.options( $this.data( 'bs-masonry'));
self.setStyleItem( $this.find( '.grid-item'), options);
var $grid=$this.isotope( options);
$this.data('grid', $grid);
self.applyFilter( $this, $grid);
self.loadMoreHandle( $this, $grid);
if(options.tbbsResizable==true) self.resizableHandle( $this, $grid, options);
if(options.tbbsSave==true) self.saveHandle( $this);
$( window).load( function(){ $grid.isotope('layout'); })
})
},
applyFilter:function( $el, $grid){
var self=this;
$el.parents( '.bs-masonry').on( 'click', 'a[data-titlefilter]', function( e){
e.preventDefault();
var $this=$( this),
filterValue=$this.data( 'titlefilter');
$grid.isotope( { 
itemSelector:'.grid-item',
filter:filterValue 
});
$this
.parent()
.addClass( 'tbbs-filter-current')
.siblings()
.removeClass( 'tbbs-filter-current');
})
$el.parents( '.bs-masonry').on( 'click', '.tbbs-filter-select-wrap', function( e){
e.preventDefault();
$( this).toggleClass( 'tbbs-select-active');
$( this)
.off( 'click.item', 'a[data-title]')
.on( 'click.item', 'a[data-title]', function( e){
$( this)
.parents( '.tbbs-filter-select-wrap')
.find( '.tbbs-filter-value span')
.html( $( this).data( 'title'));
})
})
},
loadMoreHandle:function( $el, $gridEl){
var self=this,
ajax_type=$el.data( 'bs-ajaxloadmore');
if(ajax_type=='') return;
this.loadMoreHandle.ajaxLoadMoreItems=function( $el, $gridEl, atts, paged, callback){
var masonry_opts=$el.data( 'bs-masonry');
$.ajax( {
type:'POST',
url:tbbsMasonryObj.ajax_url,
data:{ action:'tbbs_MasonryAjaxLoadmoreItems', atts:atts, paged:paged },
success:function( result){
var  $wrap=$( '<div>', { html:result });
self.setStyleItem( $wrap.find( '.grid-item'), masonry_opts);
$gridEl.isotope( 'insert', $( $wrap.html()));
callback.call( this, result);
}})
}
$el.on( 'scrollLoadmore', function( e, $gridEl){
var $this=$( this);
$this.atts=$this.data( 'bs-atts');
$this.paged=2;
$this.do_ajax=true;
$( window).on( 'scroll.masonryLoadMore_'+$this.atts.element_id, function( e){
var elInfo={ h:$this.height(), t:$this.offset().top },
$window=$( this);
if(( $( this).scrollTop() + $( this).height()) >=( elInfo.t + elInfo.h + 100) 
&& ( $( this).scrollTop() + $( this).height()) <=( elInfo.t + elInfo.h + $( this).height()) 
&& $this.do_ajax==true){
$this.do_ajax=false;
self.loadMoreHandle.ajaxLoadMoreItems( $this, $gridEl, $this.atts, $this.paged, function( result){ 
if(result==''){
$this.off( 'scrollLoadmore');
$window.off( 'scroll.masonryLoadMore_'+$this.atts.element_id);
} 
$this.do_ajax=true;
$this.paged +=1;
})
}})
})
$el.on( 'clickButtonLoadmore', function(){
var $this=$( this),
$btn=$this.parents( '.bs-masonry').find( '[data-masonryloadmorebtn]'),
$contentBtn=$btn.html();
$this.atts=$this.data( 'bs-atts');
$this.paged=2;
$this.do_ajax=true;
$btn.on( 'click', function( e){
e.preventDefault();
$btn.addClass( 'tbbs-ajax-handle').html( 'Loadmore...');
self.loadMoreHandle.ajaxLoadMoreItems( $this, $gridEl, $this.atts, $this.paged, function( result){
if(result==''){
$btn.fadeOut( 'slow', function(){ $( this).remove() })
}
$btn.removeClass( 'tbbs-ajax-handle').html( $contentBtn);
$this.paged +=1;
})
})
})
switch( ajax_type){
case 'scroll':$el.trigger( 'scrollLoadmore', [$gridEl]); break;
case 'click_button':$el.trigger( 'clickButtonLoadmore', [$gridEl]); break;
}},
setStyleItem:function( $items, options){
$items.each( function( index){
if(options.tbbsGridData && Object.keys( options.tbbsGridData).length > 0){
var _size=( options.tbbsGridData[index]) ? options.tbbsGridData[index].size:'',
_offsetHeight=( options.tbbsGridData[index]) ? parseFloat( options.tbbsGridData[index].offsetHeight):1;
$( this).data( 'size', _size);
$( this).data( 'offset-height', _offsetHeight);
}
$( this).css( {
height:options.tbbsHeight * parseFloat( $( this).data( 'offset-height')),
padding:options.tbbsPadding,
})
if($( this).data( 'size')!='')
$( this).addClass( 'grid-item--'+$( this).data( 'size'));
})
},
resizableHandle:function( $el, $gridEl, options){
var widthContent=$el.width(),
step=options.tbbsHeight / 2,
sizeData={};
$( window).resize( function(){
widthContent=$el.width();
sizeData={
width3:widthContent / 3,
width2:widthContent / 2,
width75:( widthContent / 4) * 3,
width1:widthContent,
};}).trigger( 'resize');
$el.find( '.tbbs-grid-item')
.resizable( {
handles:'se',
resize:function( event, ui){
var oHeight=( parseInt( ui.size.height / step) > 0) ? parseInt( ui.size.height / step) / 2:0.5;
if(oHeight!=ui.element.data( 'offset-height')){
ui.element.data( 'offset-height',  oHeight);
$gridEl.isotope('layout');
}
if(ui.size.width >=sizeData.width75 + 30) sizeClass='width1';
else if(ui.size.width >=sizeData.width2 + 30) sizeClass='width75';
else if(ui.size.width >=sizeData.width3 + 30) sizeClass='width2';
else sizeClass='width4';
ui.element.data( 'size',sizeClass);
var sizeClass='grid-item--'+sizeClass;
if(! ui.element.hasClass( sizeClass)){
ui.element
.removeClass( tbbs_makeRemoveClassHandler(/^grid-item--/))
.addClass( sizeClass);
$gridEl.isotope('layout');
}},
stop:function( event, ui){
ui.element.css( {
width:"",
height:options.tbbsHeight * $( this).data( 'offset-height'),
})
$gridEl.isotope('layout');
}});
},
renderData:function( $items){
var data=[];
$items.each( function(){
data.push( { 
size:$( this).data( 'size'),
offsetHeight:$( this).data( 'offset-height'),
})
})
return data;
},
saveHandle:function( $el){
var self=this,
elementID=$el.parent( '.bs-masonry').data( 'elementid'),
$save=$( '<a href="#" class="tbbs-masonry-save-btn">Save</a>');
$el.parent().append( $save);
$save.on( 'click', function( e){
e.preventDefault();
$save.addClass( 'tbbs-ajax-handle').html( 'Saving...');
var gridData=self.renderData( $el.find( '.tbbs-grid-item'));
console.log( gridData);
$.ajax( {
type:'POST',
url:tbbsMasonryObj.ajax_url,
data:{ 
action:'tbbs_ShortcodeMasonrySaveDataGrid', 
elementid:elementID, 
grid:gridData },
success:function( result){
$save.removeClass( 'tbbs-ajax-handle').html( 'Save');
}})
})
},
}
$( function(){
new tbbsMasonry();
})
})( jQuery);
!function(r){"use strict";function t(t,e,n,o){function i(r,t){return r-=o,t-=o,0>r||r>=u||0>t||t>=u?!1:a.isDark(r,t)}var a=r(n,e);a.addData(t),a.make(),o=o||0;var u=a.getModuleCount(),f=a.getModuleCount()+2*o,c=function(r,t,e,n){var o=this.isDark,i=1/f;this.isDark=function(a,u){var f=u*i,c=a*i,l=f+i,g=c+i;return o(a,u)&&(r>l||f>e||t>g||c>n)}};this.text=t,this.level=e,this.version=n,this.moduleCount=f,this.isDark=i,this.addBlank=c}function e(r,e,n,o,i){n=Math.max(1,n||1),o=Math.min(40,o||40);for(var a=n;o>=a;a+=1)try{return new t(r,e,a,i)}catch(u){}}function n(r,t,e){var n=e.size,o="bold "+e.mSize*n+"px "+e.fontname,i=w("<canvas/>")[0].getContext("2d");i.font=o;var a=i.measureText(e.label).width,u=e.mSize,f=a/n,c=(1-f)*e.mPosX,l=(1-u)*e.mPosY,g=c+f,s=l+u,h=.01;1===e.mode?r.addBlank(0,l-h,n,s+h):r.addBlank(c-h,l-h,g+h,s+h),t.fillStyle=e.fontcolor,t.font=o,t.fillText(e.label,c*n,l*n+.75*e.mSize*n)}function o(r,t,e){var n=e.size,o=e.image.naturalWidth||1,i=e.image.naturalHeight||1,a=e.mSize,u=a*o/i,f=(1-u)*e.mPosX,c=(1-a)*e.mPosY,l=f+u,g=c+a,s=.01;3===e.mode?r.addBlank(0,c-s,n,g+s):r.addBlank(f-s,c-s,l+s,g+s),t.drawImage(e.image,f*n,c*n,u*n,a*n)}function i(r,t,e){w(e.background).is("img")?t.drawImage(e.background,0,0,e.size,e.size):e.background&&(t.fillStyle=e.background,t.fillRect(e.left,e.top,e.size,e.size));var i=e.mode;1===i||2===i?n(r,t,e):(3===i||4===i)&&o(r,t,e)}function a(r,t,e,n,o,i,a,u){r.isDark(a,u)&&t.rect(n,o,i,i)}function u(r,t,e,n,o,i,a,u,f,c){a?r.moveTo(t+i,e):r.moveTo(t,e),u?(r.lineTo(n-i,e),r.arcTo(n,e,n,o,i)):r.lineTo(n,e),f?(r.lineTo(n,o-i),r.arcTo(n,o,t,o,i)):r.lineTo(n,o),c?(r.lineTo(t+i,o),r.arcTo(t,o,t,e,i)):r.lineTo(t,o),a?(r.lineTo(t,e+i),r.arcTo(t,e,n,e,i)):r.lineTo(t,e)}function f(r,t,e,n,o,i,a,u,f,c){a&&(r.moveTo(t+i,e),r.lineTo(t,e),r.lineTo(t,e+i),r.arcTo(t,e,t+i,e,i)),u&&(r.moveTo(n-i,e),r.lineTo(n,e),r.lineTo(n,e+i),r.arcTo(n,e,n-i,e,i)),f&&(r.moveTo(n-i,o),r.lineTo(n,o),r.lineTo(n,o-i),r.arcTo(n,o,n-i,o,i)),c&&(r.moveTo(t+i,o),r.lineTo(t,o),r.lineTo(t,o-i),r.arcTo(t,o,t+i,o,i))}function c(r,t,e,n,o,i,a,c){var l=r.isDark,g=n+i,s=o+i,h=e.radius*i,v=a-1,d=a+1,w=c-1,m=c+1,p=l(a,c),y=l(v,w),T=l(v,c),B=l(v,m),A=l(a,m),E=l(d,m),k=l(d,c),M=l(d,w),C=l(a,w);p?u(t,n,o,g,s,h,!T&&!C,!T&&!A,!k&&!A,!k&&!C):f(t,n,o,g,s,h,T&&C&&y,T&&A&&B,k&&A&&E,k&&C&&M)}function l(r,t,e){var n,o,i=r.moduleCount,u=e.size/i,f=a;for(p&&e.radius>0&&e.radius<=.5&&(f=c),t.beginPath(),n=0;i>n;n+=1)for(o=0;i>o;o+=1){var l=e.left+o*u,g=e.top+n*u,s=u;f(r,t,e,l,g,s,n,o)}if(w(e.fill).is("img")){t.strokeStyle="rgba(0,0,0,0.5)",t.lineWidth=2,t.stroke();var h=t.globalCompositeOperation;t.globalCompositeOperation="destination-out",t.fill(),t.globalCompositeOperation=h,t.clip(),t.drawImage(e.fill,0,0,e.size,e.size),t.restore()}else t.fillStyle=e.fill,t.fill()}function g(r,t){var n=e(t.text,t.ecLevel,t.minVersion,t.maxVersion,t.quiet);if(!n)return null;var o=w(r).data("qrcode",n),a=o[0].getContext("2d");return i(n,a,t),l(n,a,t),o}function s(r){var t=w("<canvas/>").attr("width",r.size).attr("height",r.size);return g(t,r)}function h(r){return w("<img/>").attr("src",s(r)[0].toDataURL("image/png"))}function v(r){var t=e(r.text,r.ecLevel,r.minVersion,r.maxVersion,r.quiet);if(!t)return null;var n,o,i=r.size,a=r.background,u=Math.floor,f=t.moduleCount,c=u(i/f),l=u(.5*(i-c*f)),g={position:"relative",left:0,top:0,padding:0,margin:0,width:i,height:i},s={position:"absolute",padding:0,margin:0,width:c,height:c,"background-color":r.fill},h=w("<div/>").data("qrcode",t).css(g);for(a&&h.css("background-color",a),n=0;f>n;n+=1)for(o=0;f>o;o+=1)t.isDark(n,o)&&w("<div/>").css(s).css({left:l+o*c,top:l+n*c}).appendTo(h);return h}function d(r){return m&&"canvas"===r.render?s(r):m&&"image"===r.render?h(r):v(r)}var w=jQuery,m=function(){var r=document.createElement("canvas");return Boolean(r.getContext&&r.getContext("2d"))}(),p="[object Opera]"!==Object.prototype.toString.call(window.opera),y={render:"canvas",minVersion:1,maxVersion:40,ecLevel:"L",left:0,top:0,size:200,fill:"#000",background:null,text:"no text",radius:0,quiet:0,mode:0,mSize:.1,mPosX:.5,mPosY:.5,label:"no label",fontname:"sans",fontcolor:"#000",image:null};w.fn.qrcode=function(r){var t=w.extend({},y,r);return this.each(function(){"canvas"===this.nodeName.toLowerCase()?g(this,t):w(this).append(d(t))})}}(function(){var r=function(){function r(t,e){if("undefined"==typeof t.length)throw new Error(t.length+"/"+e);var n=function(){for(var r=0;r<t.length&&0==t[r];)r+=1;for(var n=new Array(t.length-r+e),o=0;o<t.length-r;o+=1)n[o]=t[o+r];return n}(),o={};return o.getAt=function(r){return n[r]},o.getLength=function(){return n.length},o.multiply=function(t){for(var e=new Array(o.getLength()+t.getLength()-1),n=0;n<o.getLength();n+=1)for(var i=0;i<t.getLength();i+=1)e[n+i]^=a.gexp(a.glog(o.getAt(n))+a.glog(t.getAt(i)));return r(e,0)},o.mod=function(t){if(o.getLength()-t.getLength()<0)return o;for(var e=a.glog(o.getAt(0))-a.glog(t.getAt(0)),n=new Array(o.getLength()),i=0;i<o.getLength();i+=1)n[i]=o.getAt(i);for(var i=0;i<t.getLength();i+=1)n[i]^=a.gexp(a.glog(t.getAt(i))+e);return r(n,0).mod(t)},o}var t=function(t,e){var o=236,a=17,l=t,g=n[e],s=null,h=0,d=null,w=new Array,m={},p=function(r,t){h=4*l+17,s=function(r){for(var t=new Array(r),e=0;r>e;e+=1){t[e]=new Array(r);for(var n=0;r>n;n+=1)t[e][n]=null}return t}(h),y(0,0),y(h-7,0),y(0,h-7),A(),B(),k(r,t),l>=7&&E(r),null==d&&(d=D(l,g,w)),M(d,t)},y=function(r,t){for(var e=-1;7>=e;e+=1)if(!(-1>=r+e||r+e>=h))for(var n=-1;7>=n;n+=1)-1>=t+n||t+n>=h||(e>=0&&6>=e&&(0==n||6==n)||n>=0&&6>=n&&(0==e||6==e)||e>=2&&4>=e&&n>=2&&4>=n?s[r+e][t+n]=!0:s[r+e][t+n]=!1)},T=function(){for(var r=0,t=0,e=0;8>e;e+=1){p(!0,e);var n=i.getLostPoint(m);(0==e||r>n)&&(r=n,t=e)}return t},B=function(){for(var r=8;h-8>r;r+=1)null==s[r][6]&&(s[r][6]=r%2==0);for(var t=8;h-8>t;t+=1)null==s[6][t]&&(s[6][t]=t%2==0)},A=function(){for(var r=i.getPatternPosition(l),t=0;t<r.length;t+=1)for(var e=0;e<r.length;e+=1){var n=r[t],o=r[e];if(null==s[n][o])for(var a=-2;2>=a;a+=1)for(var u=-2;2>=u;u+=1)-2==a||2==a||-2==u||2==u||0==a&&0==u?s[n+a][o+u]=!0:s[n+a][o+u]=!1}},E=function(r){for(var t=i.getBCHTypeNumber(l),e=0;18>e;e+=1){var n=!r&&1==(t>>e&1);s[Math.floor(e/3)][e%3+h-8-3]=n}for(var e=0;18>e;e+=1){var n=!r&&1==(t>>e&1);s[e%3+h-8-3][Math.floor(e/3)]=n}},k=function(r,t){for(var e=g<<3|t,n=i.getBCHTypeInfo(e),o=0;15>o;o+=1){var a=!r&&1==(n>>o&1);6>o?s[o][8]=a:8>o?s[o+1][8]=a:s[h-15+o][8]=a}for(var o=0;15>o;o+=1){var a=!r&&1==(n>>o&1);8>o?s[8][h-o-1]=a:9>o?s[8][15-o-1+1]=a:s[8][15-o-1]=a}s[h-8][8]=!r},M=function(r,t){for(var e=-1,n=h-1,o=7,a=0,u=i.getMaskFunction(t),f=h-1;f>0;f-=2)for(6==f&&(f-=1);;){for(var c=0;2>c;c+=1)if(null==s[n][f-c]){var l=!1;a<r.length&&(l=1==(r[a]>>>o&1));var g=u(n,f-c);g&&(l=!l),s[n][f-c]=l,o-=1,-1==o&&(a+=1,o=7)}if(n+=e,0>n||n>=h){n-=e,e=-e;break}}},C=function(t,e){for(var n=0,o=0,a=0,u=new Array(e.length),f=new Array(e.length),c=0;c<e.length;c+=1){var l=e[c].dataCount,g=e[c].totalCount-l;o=Math.max(o,l),a=Math.max(a,g),u[c]=new Array(l);for(var s=0;s<u[c].length;s+=1)u[c][s]=255&t.getBuffer()[s+n];n+=l;var h=i.getErrorCorrectPolynomial(g),v=r(u[c],h.getLength()-1),d=v.mod(h);f[c]=new Array(h.getLength()-1);for(var s=0;s<f[c].length;s+=1){var w=s+d.getLength()-f[c].length;f[c][s]=w>=0?d.getAt(w):0}}for(var m=0,s=0;s<e.length;s+=1)m+=e[s].totalCount;for(var p=new Array(m),y=0,s=0;o>s;s+=1)for(var c=0;c<e.length;c+=1)s<u[c].length&&(p[y]=u[c][s],y+=1);for(var s=0;a>s;s+=1)for(var c=0;c<e.length;c+=1)s<f[c].length&&(p[y]=f[c][s],y+=1);return p},D=function(r,t,e){for(var n=u.getRSBlocks(r,t),c=f(),l=0;l<e.length;l+=1){var g=e[l];c.put(g.getMode(),4),c.put(g.getLength(),i.getLengthInBits(g.getMode(),r)),g.write(c)}for(var s=0,l=0;l<n.length;l+=1)s+=n[l].dataCount;if(c.getLengthInBits()>8*s)throw new Error("code length overflow. ("+c.getLengthInBits()+">"+8*s+")");for(c.getLengthInBits()+4<=8*s&&c.put(0,4);c.getLengthInBits()%8!=0;)c.putBit(!1);for(;;){if(c.getLengthInBits()>=8*s)break;if(c.put(o,8),c.getLengthInBits()>=8*s)break;c.put(a,8)}return C(c,n)};return m.addData=function(r){var t=c(r);w.push(t),d=null},m.isDark=function(r,t){if(0>r||r>=h||0>t||t>=h)throw new Error(r+","+t);return s[r][t]},m.getModuleCount=function(){return h},m.make=function(){p(!1,T())},m.createTableTag=function(r,t){r=r||2,t="undefined"==typeof t?4*r:t;var e="";e+='<table style="',e+=" border-width:0px; border-style:none;",e+=" border-collapse:collapse;",e+=" padding:0px; margin:"+t+"px;",e+='">',e+="<tbody>";for(var n=0;n<m.getModuleCount();n+=1){e+="<tr>";for(var o=0;o<m.getModuleCount();o+=1)e+='<td style="',e+=" border-width:0px; border-style:none;",e+=" border-collapse:collapse;",e+=" padding:0px; margin:0px;",e+=" width:"+r+"px;",e+=" height:"+r+"px;",e+=" background-color:",e+=m.isDark(n,o)?"#000000":"#ffffff",e+=";",e+='"/>';e+="</tr>"}return e+="</tbody>",e+="</table>"},m.createImgTag=function(r,t){r=r||2,t="undefined"==typeof t?4*r:t;var e=m.getModuleCount()*r+2*t,n=t,o=e-t;return v(e,e,function(t,e){if(t>=n&&o>t&&e>=n&&o>e){var i=Math.floor((t-n)/r),a=Math.floor((e-n)/r);return m.isDark(a,i)?0:1}return 1})},m};t.stringToBytes=function(r){for(var t=new Array,e=0;e<r.length;e+=1){var n=r.charCodeAt(e);t.push(255&n)}return t},t.createStringToBytes=function(r,t){var e=function(){for(var e=s(r),n=function(){var r=e.read();if(-1==r)throw new Error;return r},o=0,i={};;){var a=e.read();if(-1==a)break;var u=n(),f=n(),c=n(),l=String.fromCharCode(a<<8|u),g=f<<8|c;i[l]=g,o+=1}if(o!=t)throw new Error(o+"!="+t);return i}(),n="?".charCodeAt(0);return function(r){for(var t=new Array,o=0;o<r.length;o+=1){var i=r.charCodeAt(o);if(128>i)t.push(i);else{var a=e[r.charAt(o)];"number"==typeof a?(255&a)==a?t.push(a):(t.push(a>>>8),t.push(255&a)):t.push(n)}}return t}};var e={MODE_NUMBER:1,MODE_ALPHA_NUM:2,MODE_8BIT_BYTE:4,MODE_KANJI:8},n={L:1,M:0,Q:3,H:2},o={PATTERN000:0,PATTERN001:1,PATTERN010:2,PATTERN011:3,PATTERN100:4,PATTERN101:5,PATTERN110:6,PATTERN111:7},i=function(){var t=[[],[6,18],[6,22],[6,26],[6,30],[6,34],[6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],[6,32,58],[6,34,62],[6,26,46,66],[6,26,48,70],[6,26,50,74],[6,30,54,78],[6,30,56,82],[6,30,58,86],[6,34,62,90],[6,28,50,72,94],[6,26,50,74,98],[6,30,54,78,102],[6,28,54,80,106],[6,32,58,84,110],[6,30,58,86,114],[6,34,62,90,118],[6,26,50,74,98,122],[6,30,54,78,102,126],[6,26,52,78,104,130],[6,30,56,82,108,134],[6,34,60,86,112,138],[6,30,58,86,114,142],[6,34,62,90,118,146],[6,30,54,78,102,126,150],[6,24,50,76,102,128,154],[6,28,54,80,106,132,158],[6,32,58,84,110,136,162],[6,26,54,82,110,138,166],[6,30,58,86,114,142,170]],n=1335,i=7973,u=21522,f={},c=function(r){for(var t=0;0!=r;)t+=1,r>>>=1;return t};return f.getBCHTypeInfo=function(r){for(var t=r<<10;c(t)-c(n)>=0;)t^=n<<c(t)-c(n);return(r<<10|t)^u},f.getBCHTypeNumber=function(r){for(var t=r<<12;c(t)-c(i)>=0;)t^=i<<c(t)-c(i);return r<<12|t},f.getPatternPosition=function(r){return t[r-1]},f.getMaskFunction=function(r){switch(r){case o.PATTERN000:return function(r,t){return(r+t)%2==0};case o.PATTERN001:return function(r,t){return r%2==0};case o.PATTERN010:return function(r,t){return t%3==0};case o.PATTERN011:return function(r,t){return(r+t)%3==0};case o.PATTERN100:return function(r,t){return(Math.floor(r/2)+Math.floor(t/3))%2==0};case o.PATTERN101:return function(r,t){return r*t%2+r*t%3==0};case o.PATTERN110:return function(r,t){return(r*t%2+r*t%3)%2==0};case o.PATTERN111:return function(r,t){return(r*t%3+(r+t)%2)%2==0};default:throw new Error("bad maskPattern:"+r)}},f.getErrorCorrectPolynomial=function(t){for(var e=r([1],0),n=0;t>n;n+=1)e=e.multiply(r([1,a.gexp(n)],0));return e},f.getLengthInBits=function(r,t){if(t>=1&&10>t)switch(r){case e.MODE_NUMBER:return 10;case e.MODE_ALPHA_NUM:return 9;case e.MODE_8BIT_BYTE:return 8;case e.MODE_KANJI:return 8;default:throw new Error("mode:"+r)}else if(27>t)switch(r){case e.MODE_NUMBER:return 12;case e.MODE_ALPHA_NUM:return 11;case e.MODE_8BIT_BYTE:return 16;case e.MODE_KANJI:return 10;default:throw new Error("mode:"+r)}else{if(!(41>t))throw new Error("type:"+t);switch(r){case e.MODE_NUMBER:return 14;case e.MODE_ALPHA_NUM:return 13;case e.MODE_8BIT_BYTE:return 16;case e.MODE_KANJI:return 12;default:throw new Error("mode:"+r)}}},f.getLostPoint=function(r){for(var t=r.getModuleCount(),e=0,n=0;t>n;n+=1)for(var o=0;t>o;o+=1){for(var i=0,a=r.isDark(n,o),u=-1;1>=u;u+=1)if(!(0>n+u||n+u>=t))for(var f=-1;1>=f;f+=1)0>o+f||o+f>=t||(0!=u||0!=f)&&a==r.isDark(n+u,o+f)&&(i+=1);i>5&&(e+=3+i-5)}for(var n=0;t-1>n;n+=1)for(var o=0;t-1>o;o+=1){var c=0;r.isDark(n,o)&&(c+=1),r.isDark(n+1,o)&&(c+=1),r.isDark(n,o+1)&&(c+=1),r.isDark(n+1,o+1)&&(c+=1),(0==c||4==c)&&(e+=3)}for(var n=0;t>n;n+=1)for(var o=0;t-6>o;o+=1)r.isDark(n,o)&&!r.isDark(n,o+1)&&r.isDark(n,o+2)&&r.isDark(n,o+3)&&r.isDark(n,o+4)&&!r.isDark(n,o+5)&&r.isDark(n,o+6)&&(e+=40);for(var o=0;t>o;o+=1)for(var n=0;t-6>n;n+=1)r.isDark(n,o)&&!r.isDark(n+1,o)&&r.isDark(n+2,o)&&r.isDark(n+3,o)&&r.isDark(n+4,o)&&!r.isDark(n+5,o)&&r.isDark(n+6,o)&&(e+=40);for(var l=0,o=0;t>o;o+=1)for(var n=0;t>n;n+=1)r.isDark(n,o)&&(l+=1);var g=Math.abs(100*l/t/t-50)/5;return e+=10*g},f}(),a=function(){for(var r=new Array(256),t=new Array(256),e=0;8>e;e+=1)r[e]=1<<e;for(var e=8;256>e;e+=1)r[e]=r[e-4]^r[e-5]^r[e-6]^r[e-8];for(var e=0;255>e;e+=1)t[r[e]]=e;var n={};return n.glog=function(r){if(1>r)throw new Error("glog("+r+")");return t[r]},n.gexp=function(t){for(;0>t;)t+=255;for(;t>=256;)t-=255;return r[t]},n}(),u=function(){var r=[[1,26,19],[1,26,16],[1,26,13],[1,26,9],[1,44,34],[1,44,28],[1,44,22],[1,44,16],[1,70,55],[1,70,44],[2,35,17],[2,35,13],[1,100,80],[2,50,32],[2,50,24],[4,25,9],[1,134,108],[2,67,43],[2,33,15,2,34,16],[2,33,11,2,34,12],[2,86,68],[4,43,27],[4,43,19],[4,43,15],[2,98,78],[4,49,31],[2,32,14,4,33,15],[4,39,13,1,40,14],[2,121,97],[2,60,38,2,61,39],[4,40,18,2,41,19],[4,40,14,2,41,15],[2,146,116],[3,58,36,2,59,37],[4,36,16,4,37,17],[4,36,12,4,37,13],[2,86,68,2,87,69],[4,69,43,1,70,44],[6,43,19,2,44,20],[6,43,15,2,44,16],[4,101,81],[1,80,50,4,81,51],[4,50,22,4,51,23],[3,36,12,8,37,13],[2,116,92,2,117,93],[6,58,36,2,59,37],[4,46,20,6,47,21],[7,42,14,4,43,15],[4,133,107],[8,59,37,1,60,38],[8,44,20,4,45,21],[12,33,11,4,34,12],[3,145,115,1,146,116],[4,64,40,5,65,41],[11,36,16,5,37,17],[11,36,12,5,37,13],[5,109,87,1,110,88],[5,65,41,5,66,42],[5,54,24,7,55,25],[11,36,12,7,37,13],[5,122,98,1,123,99],[7,73,45,3,74,46],[15,43,19,2,44,20],[3,45,15,13,46,16],[1,135,107,5,136,108],[10,74,46,1,75,47],[1,50,22,15,51,23],[2,42,14,17,43,15],[5,150,120,1,151,121],[9,69,43,4,70,44],[17,50,22,1,51,23],[2,42,14,19,43,15],[3,141,113,4,142,114],[3,70,44,11,71,45],[17,47,21,4,48,22],[9,39,13,16,40,14],[3,135,107,5,136,108],[3,67,41,13,68,42],[15,54,24,5,55,25],[15,43,15,10,44,16],[4,144,116,4,145,117],[17,68,42],[17,50,22,6,51,23],[19,46,16,6,47,17],[2,139,111,7,140,112],[17,74,46],[7,54,24,16,55,25],[34,37,13],[4,151,121,5,152,122],[4,75,47,14,76,48],[11,54,24,14,55,25],[16,45,15,14,46,16],[6,147,117,4,148,118],[6,73,45,14,74,46],[11,54,24,16,55,25],[30,46,16,2,47,17],[8,132,106,4,133,107],[8,75,47,13,76,48],[7,54,24,22,55,25],[22,45,15,13,46,16],[10,142,114,2,143,115],[19,74,46,4,75,47],[28,50,22,6,51,23],[33,46,16,4,47,17],[8,152,122,4,153,123],[22,73,45,3,74,46],[8,53,23,26,54,24],[12,45,15,28,46,16],[3,147,117,10,148,118],[3,73,45,23,74,46],[4,54,24,31,55,25],[11,45,15,31,46,16],[7,146,116,7,147,117],[21,73,45,7,74,46],[1,53,23,37,54,24],[19,45,15,26,46,16],[5,145,115,10,146,116],[19,75,47,10,76,48],[15,54,24,25,55,25],[23,45,15,25,46,16],[13,145,115,3,146,116],[2,74,46,29,75,47],[42,54,24,1,55,25],[23,45,15,28,46,16],[17,145,115],[10,74,46,23,75,47],[10,54,24,35,55,25],[19,45,15,35,46,16],[17,145,115,1,146,116],[14,74,46,21,75,47],[29,54,24,19,55,25],[11,45,15,46,46,16],[13,145,115,6,146,116],[14,74,46,23,75,47],[44,54,24,7,55,25],[59,46,16,1,47,17],[12,151,121,7,152,122],[12,75,47,26,76,48],[39,54,24,14,55,25],[22,45,15,41,46,16],[6,151,121,14,152,122],[6,75,47,34,76,48],[46,54,24,10,55,25],[2,45,15,64,46,16],[17,152,122,4,153,123],[29,74,46,14,75,47],[49,54,24,10,55,25],[24,45,15,46,46,16],[4,152,122,18,153,123],[13,74,46,32,75,47],[48,54,24,14,55,25],[42,45,15,32,46,16],[20,147,117,4,148,118],[40,75,47,7,76,48],[43,54,24,22,55,25],[10,45,15,67,46,16],[19,148,118,6,149,119],[18,75,47,31,76,48],[34,54,24,34,55,25],[20,45,15,61,46,16]],t=function(r,t){var e={};return e.totalCount=r,e.dataCount=t,e},e={},o=function(t,e){switch(e){case n.L:return r[4*(t-1)+0];case n.M:return r[4*(t-1)+1];case n.Q:return r[4*(t-1)+2];case n.H:return r[4*(t-1)+3];default:return void 0}};return e.getRSBlocks=function(r,e){var n=o(r,e);if("undefined"==typeof n)throw new Error("bad rs block @ typeNumber:"+r+"/errorCorrectLevel:"+e);for(var i=n.length/3,a=new Array,u=0;i>u;u+=1)for(var f=n[3*u+0],c=n[3*u+1],l=n[3*u+2],g=0;f>g;g+=1)a.push(t(c,l));return a},e}(),f=function(){var r=new Array,t=0,e={};return e.getBuffer=function(){return r},e.getAt=function(t){var e=Math.floor(t/8);return 1==(r[e]>>>7-t%8&1)},e.put=function(r,t){for(var n=0;t>n;n+=1)e.putBit(1==(r>>>t-n-1&1))},e.getLengthInBits=function(){return t},e.putBit=function(e){var n=Math.floor(t/8);r.length<=n&&r.push(0),e&&(r[n]|=128>>>t%8),t+=1},e},c=function(r){var n=e.MODE_8BIT_BYTE,o=t.stringToBytes(r),i={};return i.getMode=function(){return n},i.getLength=function(r){return o.length},i.write=function(r){for(var t=0;t<o.length;t+=1)r.put(o[t],8)},i},l=function(){var r=new Array,t={};return t.writeByte=function(t){r.push(255&t)},t.writeShort=function(r){t.writeByte(r),t.writeByte(r>>>8)},t.writeBytes=function(r,e,n){e=e||0,n=n||r.length;for(var o=0;n>o;o+=1)t.writeByte(r[o+e])},t.writeString=function(r){for(var e=0;e<r.length;e+=1)t.writeByte(r.charCodeAt(e))},t.toByteArray=function(){return r},t.toString=function(){var t="";t+="[";for(var e=0;e<r.length;e+=1)e>0&&(t+=","),t+=r[e];return t+="]"},t},g=function(){var r=0,t=0,e=0,n="",o={},i=function(r){n+=String.fromCharCode(a(63&r))},a=function(r){if(0>r);else{if(26>r)return 65+r;if(52>r)return 97+(r-26);if(62>r)return 48+(r-52);if(62==r)return 43;if(63==r)return 47}throw new Error("n:"+r)};return o.writeByte=function(n){for(r=r<<8|255&n,t+=8,e+=1;t>=6;)i(r>>>t-6),t-=6},o.flush=function(){if(t>0&&(i(r<<6-t),r=0,t=0),e%3!=0)for(var o=3-e%3,a=0;o>a;a+=1)n+="="},o.toString=function(){return n},o},s=function(r){var t=r,e=0,n=0,o=0,i={};i.read=function(){for(;8>o;){if(e>=t.length){if(0==o)return-1;throw new Error("unexpected end of file./"+o)}var r=t.charAt(e);if(e+=1,"="==r)return o=0,-1;r.match(/^\s$/)||(n=n<<6|a(r.charCodeAt(0)),o+=6)}var i=n>>>o-8&255;return o-=8,i};var a=function(r){if(r>=65&&90>=r)return r-65;if(r>=97&&122>=r)return r-97+26;if(r>=48&&57>=r)return r-48+52;if(43==r)return 62;if(47==r)return 63;throw new Error("c:"+r)};return i},h=function(r,t){var e=r,n=t,o=new Array(r*t),i={};i.setPixel=function(r,t,n){o[t*e+r]=n},i.write=function(r){r.writeString("GIF87a"),r.writeShort(e),r.writeShort(n),r.writeByte(128),r.writeByte(0),r.writeByte(0),r.writeByte(0),r.writeByte(0),r.writeByte(0),r.writeByte(255),r.writeByte(255),r.writeByte(255),r.writeString(","),r.writeShort(0),r.writeShort(0),r.writeShort(e),r.writeShort(n),r.writeByte(0);var t=2,o=u(t);r.writeByte(t);for(var i=0;o.length-i>255;)r.writeByte(255),r.writeBytes(o,i,255),i+=255;r.writeByte(o.length-i),r.writeBytes(o,i,o.length-i),r.writeByte(0),r.writeString(";")};var a=function(r){var t=r,e=0,n=0,o={};return o.write=function(r,o){if(r>>>o!=0)throw new Error("length over");for(;e+o>=8;)t.writeByte(255&(r<<e|n)),o-=8-e,r>>>=8-e,n=0,e=0;n=r<<e|n,e+=o},o.flush=function(){e>0&&t.writeByte(n)},o},u=function(r){for(var t=1<<r,e=(1<<r)+1,n=r+1,i=f(),u=0;t>u;u+=1)i.add(String.fromCharCode(u));i.add(String.fromCharCode(t)),i.add(String.fromCharCode(e));var c=l(),g=a(c);g.write(t,n);var s=0,h=String.fromCharCode(o[s]);for(s+=1;s<o.length;){var v=String.fromCharCode(o[s]);s+=1,i.contains(h+v)?h+=v:(g.write(i.indexOf(h),n),i.size()<4095&&(i.size()==1<<n&&(n+=1),i.add(h+v)),h=v)}return g.write(i.indexOf(h),n),g.write(e,n),g.flush(),c.toByteArray()},f=function(){var r={},t=0,e={};return e.add=function(n){if(e.contains(n))throw new Error("dup key:"+n);r[n]=t,t+=1},e.size=function(){return t},e.indexOf=function(t){return r[t]},e.contains=function(t){return"undefined"!=typeof r[t]},e};return i},v=function(r,t,e,n){for(var o=h(r,t),i=0;t>i;i+=1)for(var a=0;r>a;a+=1)o.setPixel(a,i,e(a,i));var u=l();o.write(u);for(var f=g(),c=u.toByteArray(),s=0;s<c.length;s+=1)f.writeByte(c[s]);f.flush();var v="";return v+="<img",v+=' src="',v+="data:image/gif;base64,",v+=f,v+='"',v+=' width="',v+=r,v+='"',v+=' height="',v+=t,v+='"',n&&(v+=' alt="',v+=n,v+='"'),v+="/>"};return t}();return function(r){"function"==typeof define&&define.amd?define([],r):"object"==typeof exports&&(module.exports=r())}(function(){return r}),!function(r){r.stringToBytes=function(r){function t(r){for(var t=[],e=0;e<r.length;e++){var n=r.charCodeAt(e);128>n?t.push(n):2048>n?t.push(192|n>>6,128|63&n):55296>n||n>=57344?t.push(224|n>>12,128|n>>6&63,128|63&n):(e++,n=65536+((1023&n)<<10|1023&r.charCodeAt(e)),t.push(240|n>>18,128|n>>12&63,128|n>>6&63,128|63&n))}return t}return t(r)}}(r),r}());
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):"undefined"!=typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){"use strict";var b=window.Slick||{};b=function(){function c(c,d){var f,e=this;e.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:a(c),appendDots:a(c),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',nextArrow:'<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(a,b){return'<button type="button" data-role="none" role="button" aria-required="false" tabindex="0">'+(b+1)+"</button>"},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",edgeFriction:.35,fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",mobileFirst:!1,pauseOnHover:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rows:1,rtl:!1,slide:"",slidesPerRow:1,slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,useTransform:!0,variableWidth:!1,vertical:!1,verticalSwiping:!1,waitForAnimate:!0,zIndex:1e3},e.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1,unslicked:!1},a.extend(e,e.initials),e.activeBreakpoint=null,e.animType=null,e.animProp=null,e.breakpoints=[],e.breakpointSettings=[],e.cssTransitions=!1,e.hidden="hidden",e.paused=!1,e.positionProp=null,e.respondTo=null,e.rowCount=1,e.shouldClick=!0,e.$slider=a(c),e.$slidesCache=null,e.transformType=null,e.transitionType=null,e.visibilityChange="visibilitychange",e.windowWidth=0,e.windowTimer=null,f=a(c).data("slick")||{},e.options=a.extend({},e.defaults,f,d),e.currentSlide=e.options.initialSlide,e.originalSettings=e.options,"undefined"!=typeof document.mozHidden?(e.hidden="mozHidden",e.visibilityChange="mozvisibilitychange"):"undefined"!=typeof document.webkitHidden&&(e.hidden="webkitHidden",e.visibilityChange="webkitvisibilitychange"),e.autoPlay=a.proxy(e.autoPlay,e),e.autoPlayClear=a.proxy(e.autoPlayClear,e),e.changeSlide=a.proxy(e.changeSlide,e),e.clickHandler=a.proxy(e.clickHandler,e),e.selectHandler=a.proxy(e.selectHandler,e),e.setPosition=a.proxy(e.setPosition,e),e.swipeHandler=a.proxy(e.swipeHandler,e),e.dragHandler=a.proxy(e.dragHandler,e),e.keyHandler=a.proxy(e.keyHandler,e),e.autoPlayIterator=a.proxy(e.autoPlayIterator,e),e.instanceUid=b++,e.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,e.registerBreakpoints(),e.init(!0),e.checkResponsive(!0)}var b=0;return c}(),b.prototype.addSlide=b.prototype.slickAdd=function(b,c,d){var e=this;if("boolean"==typeof c)d=c,c=null;else if(0>c||c>=e.slideCount)return!1;e.unload(),"number"==typeof c?0===c&&0===e.$slides.length?a(b).appendTo(e.$slideTrack):d?a(b).insertBefore(e.$slides.eq(c)):a(b).insertAfter(e.$slides.eq(c)):d===!0?a(b).prependTo(e.$slideTrack):a(b).appendTo(e.$slideTrack),e.$slides=e.$slideTrack.children(this.options.slide),e.$slideTrack.children(this.options.slide).detach(),e.$slideTrack.append(e.$slides),e.$slides.each(function(b,c){a(c).attr("data-slick-index",b)}),e.$slidesCache=e.$slides,e.reinit()},b.prototype.animateHeight=function(){var a=this;if(1===a.options.slidesToShow&&a.options.adaptiveHeight===!0&&a.options.vertical===!1){var b=a.$slides.eq(a.currentSlide).outerHeight(!0);a.$list.animate({height:b},a.options.speed)}},b.prototype.animateSlide=function(b,c){var d={},e=this;e.animateHeight(),e.options.rtl===!0&&e.options.vertical===!1&&(b=-b),e.transformsEnabled===!1?e.options.vertical===!1?e.$slideTrack.animate({left:b},e.options.speed,e.options.easing,c):e.$slideTrack.animate({top:b},e.options.speed,e.options.easing,c):e.cssTransitions===!1?(e.options.rtl===!0&&(e.currentLeft=-e.currentLeft),a({animStart:e.currentLeft}).animate({animStart:b},{duration:e.options.speed,easing:e.options.easing,step:function(a){a=Math.ceil(a),e.options.vertical===!1?(d[e.animType]="translate("+a+"px, 0px)",e.$slideTrack.css(d)):(d[e.animType]="translate(0px,"+a+"px)",e.$slideTrack.css(d))},complete:function(){c&&c.call()}})):(e.applyTransition(),b=Math.ceil(b),e.options.vertical===!1?d[e.animType]="translate3d("+b+"px, 0px, 0px)":d[e.animType]="translate3d(0px,"+b+"px, 0px)",e.$slideTrack.css(d),c&&setTimeout(function(){e.disableTransition(),c.call()},e.options.speed))},b.prototype.asNavFor=function(b){var c=this,d=c.options.asNavFor;d&&null!==d&&(d=a(d).not(c.$slider)),null!==d&&"object"==typeof d&&d.each(function(){var c=a(this).slick("getSlick");c.unslicked||c.slideHandler(b,!0)})},b.prototype.applyTransition=function(a){var b=this,c={};b.options.fade===!1?c[b.transitionType]=b.transformType+" "+b.options.speed+"ms "+b.options.cssEase:c[b.transitionType]="opacity "+b.options.speed+"ms "+b.options.cssEase,b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.autoPlay=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer),a.slideCount>a.options.slidesToShow&&a.paused!==!0&&(a.autoPlayTimer=setInterval(a.autoPlayIterator,a.options.autoplaySpeed))},b.prototype.autoPlayClear=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer)},b.prototype.autoPlayIterator=function(){var a=this;a.options.infinite===!1?1===a.direction?(a.currentSlide+1===a.slideCount-1&&(a.direction=0),a.slideHandler(a.currentSlide+a.options.slidesToScroll)):(a.currentSlide-1===0&&(a.direction=1),a.slideHandler(a.currentSlide-a.options.slidesToScroll)):a.slideHandler(a.currentSlide+a.options.slidesToScroll)},b.prototype.buildArrows=function(){var b=this;b.options.arrows===!0&&(b.$prevArrow=a(b.options.prevArrow).addClass("slick-arrow"),b.$nextArrow=a(b.options.nextArrow).addClass("slick-arrow"),b.slideCount>b.options.slidesToShow?(b.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),b.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.prependTo(b.options.appendArrows),b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.appendTo(b.options.appendArrows),b.options.infinite!==!0&&b.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true")):b.$prevArrow.add(b.$nextArrow).addClass("slick-hidden").attr({"aria-disabled":"true",tabindex:"-1"}))},b.prototype.buildDots=function(){var c,d,b=this;if(b.options.dots===!0&&b.slideCount>b.options.slidesToShow){for(d='<ul class="'+b.options.dotsClass+'">',c=0;c<=b.getDotCount();c+=1)d+="<li>"+b.options.customPaging.call(this,b,c)+"</li>";d+="</ul>",b.$dots=a(d).appendTo(b.options.appendDots),b.$dots.find("li").first().addClass("slick-active").attr("aria-hidden","false")}},b.prototype.buildOut=function(){var b=this;b.$slides=b.$slider.children(b.options.slide+":not(.slick-cloned)").addClass("slick-slide"),b.slideCount=b.$slides.length,b.$slides.each(function(b,c){a(c).attr("data-slick-index",b).data("originalStyling",a(c).attr("style")||"")}),b.$slider.addClass("slick-slider"),b.$slideTrack=0===b.slideCount?a('<div class="slick-track"/>').appendTo(b.$slider):b.$slides.wrapAll('<div class="slick-track"/>').parent(),b.$list=b.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(),b.$slideTrack.css("opacity",0),(b.options.centerMode===!0||b.options.swipeToSlide===!0)&&(b.options.slidesToScroll=1),a("img[data-lazy]",b.$slider).not("[src]").addClass("slick-loading"),b.setupInfinite(),b.buildArrows(),b.buildDots(),b.updateDots(),b.setSlideClasses("number"==typeof b.currentSlide?b.currentSlide:0),b.options.draggable===!0&&b.$list.addClass("draggable")},b.prototype.buildRows=function(){var b,c,d,e,f,g,h,a=this;if(e=document.createDocumentFragment(),g=a.$slider.children(),a.options.rows>1){for(h=a.options.slidesPerRow*a.options.rows,f=Math.ceil(g.length/h),b=0;f>b;b++){var i=document.createElement("div");for(c=0;c<a.options.rows;c++){var j=document.createElement("div");for(d=0;d<a.options.slidesPerRow;d++){var k=b*h+(c*a.options.slidesPerRow+d);g.get(k)&&j.appendChild(g.get(k))}i.appendChild(j)}e.appendChild(i)}a.$slider.html(e),a.$slider.children().children().children().css({width:100/a.options.slidesPerRow+"%",display:"inline-block"})}},b.prototype.checkResponsive=function(b,c){var e,f,g,d=this,h=!1,i=d.$slider.width(),j=window.innerWidth||a(window).width();if("window"===d.respondTo?g=j:"slider"===d.respondTo?g=i:"min"===d.respondTo&&(g=Math.min(j,i)),d.options.responsive&&d.options.responsive.length&&null!==d.options.responsive){f=null;for(e in d.breakpoints)d.breakpoints.hasOwnProperty(e)&&(d.originalSettings.mobileFirst===!1?g<d.breakpoints[e]&&(f=d.breakpoints[e]):g>d.breakpoints[e]&&(f=d.breakpoints[e]));null!==f?null!==d.activeBreakpoint?(f!==d.activeBreakpoint||c)&&(d.activeBreakpoint=f,"unslick"===d.breakpointSettings[f]?d.unslick(f):(d.options=a.extend({},d.originalSettings,d.breakpointSettings[f]),b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b)),h=f):(d.activeBreakpoint=f,"unslick"===d.breakpointSettings[f]?d.unslick(f):(d.options=a.extend({},d.originalSettings,d.breakpointSettings[f]),b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b)),h=f):null!==d.activeBreakpoint&&(d.activeBreakpoint=null,d.options=d.originalSettings,b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b),h=f),b||h===!1||d.$slider.trigger("breakpoint",[d,h])}},b.prototype.changeSlide=function(b,c){var f,g,h,d=this,e=a(b.target);switch(e.is("a")&&b.preventDefault(),e.is("li")||(e=e.closest("li")),h=d.slideCount%d.options.slidesToScroll!==0,f=h?0:(d.slideCount-d.currentSlide)%d.options.slidesToScroll,b.data.message){case"previous":g=0===f?d.options.slidesToScroll:d.options.slidesToShow-f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide-g,!1,c);break;case"next":g=0===f?d.options.slidesToScroll:f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide+g,!1,c);break;case"index":var i=0===b.data.index?0:b.data.index||e.index()*d.options.slidesToScroll;d.slideHandler(d.checkNavigable(i),!1,c),e.children().trigger("focus");break;default:return}},b.prototype.checkNavigable=function(a){var c,d,b=this;if(c=b.getNavigableIndexes(),d=0,a>c[c.length-1])a=c[c.length-1];else for(var e in c){if(a<c[e]){a=d;break}d=c[e]}return a},b.prototype.cleanUpEvents=function(){var b=this;b.options.dots&&null!==b.$dots&&(a("li",b.$dots).off("click.slick",b.changeSlide),b.options.pauseOnDotsHover===!0&&b.options.autoplay===!0&&a("li",b.$dots).off("mouseenter.slick",a.proxy(b.setPaused,b,!0)).off("mouseleave.slick",a.proxy(b.setPaused,b,!1))),b.options.arrows===!0&&b.slideCount>b.options.slidesToShow&&(b.$prevArrow&&b.$prevArrow.off("click.slick",b.changeSlide),b.$nextArrow&&b.$nextArrow.off("click.slick",b.changeSlide)),b.$list.off("touchstart.slick mousedown.slick",b.swipeHandler),b.$list.off("touchmove.slick mousemove.slick",b.swipeHandler),b.$list.off("touchend.slick mouseup.slick",b.swipeHandler),b.$list.off("touchcancel.slick mouseleave.slick",b.swipeHandler),b.$list.off("click.slick",b.clickHandler),a(document).off(b.visibilityChange,b.visibility),b.$list.off("mouseenter.slick",a.proxy(b.setPaused,b,!0)),b.$list.off("mouseleave.slick",a.proxy(b.setPaused,b,!1)),b.options.accessibility===!0&&b.$list.off("keydown.slick",b.keyHandler),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().off("click.slick",b.selectHandler),a(window).off("orientationchange.slick.slick-"+b.instanceUid,b.orientationChange),a(window).off("resize.slick.slick-"+b.instanceUid,b.resize),a("[draggable!=true]",b.$slideTrack).off("dragstart",b.preventDefault),a(window).off("load.slick.slick-"+b.instanceUid,b.setPosition),a(document).off("ready.slick.slick-"+b.instanceUid,b.setPosition)},b.prototype.cleanUpRows=function(){var b,a=this;a.options.rows>1&&(b=a.$slides.children().children(),b.removeAttr("style"),a.$slider.html(b))},b.prototype.clickHandler=function(a){var b=this;b.shouldClick===!1&&(a.stopImmediatePropagation(),a.stopPropagation(),a.preventDefault())},b.prototype.destroy=function(b){var c=this;c.autoPlayClear(),c.touchObject={},c.cleanUpEvents(),a(".slick-cloned",c.$slider).detach(),c.$dots&&c.$dots.remove(),c.$prevArrow&&c.$prevArrow.length&&(c.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),c.htmlExpr.test(c.options.prevArrow)&&c.$prevArrow.remove()),c.$nextArrow&&c.$nextArrow.length&&(c.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),c.htmlExpr.test(c.options.nextArrow)&&c.$nextArrow.remove()),c.$slides&&(c.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function(){a(this).attr("style",a(this).data("originalStyling"))}),c.$slideTrack.children(this.options.slide).detach(),c.$slideTrack.detach(),c.$list.detach(),c.$slider.append(c.$slides)),c.cleanUpRows(),c.$slider.removeClass("slick-slider"),c.$slider.removeClass("slick-initialized"),c.unslicked=!0,b||c.$slider.trigger("destroy",[c])},b.prototype.disableTransition=function(a){var b=this,c={};c[b.transitionType]="",b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.fadeSlide=function(a,b){var c=this;c.cssTransitions===!1?(c.$slides.eq(a).css({zIndex:c.options.zIndex}),c.$slides.eq(a).animate({opacity:1},c.options.speed,c.options.easing,b)):(c.applyTransition(a),c.$slides.eq(a).css({opacity:1,zIndex:c.options.zIndex}),b&&setTimeout(function(){c.disableTransition(a),b.call()},c.options.speed))},b.prototype.fadeSlideOut=function(a){var b=this;b.cssTransitions===!1?b.$slides.eq(a).animate({opacity:0,zIndex:b.options.zIndex-2},b.options.speed,b.options.easing):(b.applyTransition(a),b.$slides.eq(a).css({opacity:0,zIndex:b.options.zIndex-2}))},b.prototype.filterSlides=b.prototype.slickFilter=function(a){var b=this;null!==a&&(b.$slidesCache=b.$slides,b.unload(),b.$slideTrack.children(this.options.slide).detach(),b.$slidesCache.filter(a).appendTo(b.$slideTrack),b.reinit())},b.prototype.getCurrent=b.prototype.slickCurrentSlide=function(){var a=this;return a.currentSlide},b.prototype.getDotCount=function(){var a=this,b=0,c=0,d=0;if(a.options.infinite===!0)for(;b<a.slideCount;)++d,b=c+a.options.slidesToScroll,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;else if(a.options.centerMode===!0)d=a.slideCount;else for(;b<a.slideCount;)++d,b=c+a.options.slidesToScroll,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d-1},b.prototype.getLeft=function(a){var c,d,f,b=this,e=0;return b.slideOffset=0,d=b.$slides.first().outerHeight(!0),b.options.infinite===!0?(b.slideCount>b.options.slidesToShow&&(b.slideOffset=b.slideWidth*b.options.slidesToShow*-1,e=d*b.options.slidesToShow*-1),b.slideCount%b.options.slidesToScroll!==0&&a+b.options.slidesToScroll>b.slideCount&&b.slideCount>b.options.slidesToShow&&(a>b.slideCount?(b.slideOffset=(b.options.slidesToShow-(a-b.slideCount))*b.slideWidth*-1,e=(b.options.slidesToShow-(a-b.slideCount))*d*-1):(b.slideOffset=b.slideCount%b.options.slidesToScroll*b.slideWidth*-1,e=b.slideCount%b.options.slidesToScroll*d*-1))):a+b.options.slidesToShow>b.slideCount&&(b.slideOffset=(a+b.options.slidesToShow-b.slideCount)*b.slideWidth,e=(a+b.options.slidesToShow-b.slideCount)*d),b.slideCount<=b.options.slidesToShow&&(b.slideOffset=0,e=0),b.options.centerMode===!0&&b.options.infinite===!0?b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)-b.slideWidth:b.options.centerMode===!0&&(b.slideOffset=0,b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)),c=b.options.vertical===!1?a*b.slideWidth*-1+b.slideOffset:a*d*-1+e,b.options.variableWidth===!0&&(f=b.slideCount<=b.options.slidesToShow||b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow),c=b.options.rtl===!0?f[0]?-1*(b.$slideTrack.width()-f[0].offsetLeft-f.width()):0:f[0]?-1*f[0].offsetLeft:0,b.options.centerMode===!0&&(f=b.slideCount<=b.options.slidesToShow||b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow+1),c=b.options.rtl===!0?f[0]?-1*(b.$slideTrack.width()-f[0].offsetLeft-f.width()):0:f[0]?-1*f[0].offsetLeft:0,c+=(b.$list.width()-f.outerWidth())/2)),c},b.prototype.getOption=b.prototype.slickGetOption=function(a){var b=this;return b.options[a]},b.prototype.getNavigableIndexes=function(){var e,a=this,b=0,c=0,d=[];for(a.options.infinite===!1?e=a.slideCount:(b=-1*a.options.slidesToScroll,c=-1*a.options.slidesToScroll,e=2*a.slideCount);e>b;)d.push(b),b=c+a.options.slidesToScroll,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d},b.prototype.getSlick=function(){return this},b.prototype.getSlideCount=function(){var c,d,e,b=this;return e=b.options.centerMode===!0?b.slideWidth*Math.floor(b.options.slidesToShow/2):0,b.options.swipeToSlide===!0?(b.$slideTrack.find(".slick-slide").each(function(c,f){return f.offsetLeft-e+a(f).outerWidth()/2>-1*b.swipeLeft?(d=f,!1):void 0}),c=Math.abs(a(d).attr("data-slick-index")-b.currentSlide)||1):b.options.slidesToScroll},b.prototype.goTo=b.prototype.slickGoTo=function(a,b){var c=this;c.changeSlide({data:{message:"index",index:parseInt(a)}},b)},b.prototype.init=function(b){var c=this;a(c.$slider).hasClass("slick-initialized")||(a(c.$slider).addClass("slick-initialized"),c.buildRows(),c.buildOut(),c.setProps(),c.startLoad(),c.loadSlider(),c.initializeEvents(),c.updateArrows(),c.updateDots()),b&&c.$slider.trigger("init",[c]),c.options.accessibility===!0&&c.initADA()},b.prototype.initArrowEvents=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.on("click.slick",{message:"previous"},a.changeSlide),a.$nextArrow.on("click.slick",{message:"next"},a.changeSlide))},b.prototype.initDotEvents=function(){var b=this;b.options.dots===!0&&b.slideCount>b.options.slidesToShow&&a("li",b.$dots).on("click.slick",{message:"index"},b.changeSlide),b.options.dots===!0&&b.options.pauseOnDotsHover===!0&&b.options.autoplay===!0&&a("li",b.$dots).on("mouseenter.slick",a.proxy(b.setPaused,b,!0)).on("mouseleave.slick",a.proxy(b.setPaused,b,!1))},b.prototype.initializeEvents=function(){var b=this;b.initArrowEvents(),b.initDotEvents(),b.$list.on("touchstart.slick mousedown.slick",{action:"start"},b.swipeHandler),b.$list.on("touchmove.slick mousemove.slick",{action:"move"},b.swipeHandler),b.$list.on("touchend.slick mouseup.slick",{action:"end"},b.swipeHandler),b.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},b.swipeHandler),b.$list.on("click.slick",b.clickHandler),a(document).on(b.visibilityChange,a.proxy(b.visibility,b)),b.$list.on("mouseenter.slick",a.proxy(b.setPaused,b,!0)),b.$list.on("mouseleave.slick",a.proxy(b.setPaused,b,!1)),b.options.accessibility===!0&&b.$list.on("keydown.slick",b.keyHandler),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().on("click.slick",b.selectHandler),a(window).on("orientationchange.slick.slick-"+b.instanceUid,a.proxy(b.orientationChange,b)),a(window).on("resize.slick.slick-"+b.instanceUid,a.proxy(b.resize,b)),a("[draggable!=true]",b.$slideTrack).on("dragstart",b.preventDefault),a(window).on("load.slick.slick-"+b.instanceUid,b.setPosition),a(document).on("ready.slick.slick-"+b.instanceUid,b.setPosition)},b.prototype.initUI=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.show(),a.$nextArrow.show()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.show(),a.options.autoplay===!0&&a.autoPlay()},b.prototype.keyHandler=function(a){var b=this;a.target.tagName.match("TEXTAREA|INPUT|SELECT")||(37===a.keyCode&&b.options.accessibility===!0?b.changeSlide({data:{message:"previous"}}):39===a.keyCode&&b.options.accessibility===!0&&b.changeSlide({data:{message:"next"}}))},b.prototype.lazyLoad=function(){function g(b){a("img[data-lazy]",b).each(function(){var b=a(this),c=a(this).attr("data-lazy"),d=document.createElement("img");d.onload=function(){b.animate({opacity:0},100,function(){b.attr("src",c).animate({opacity:1},200,function(){b.removeAttr("data-lazy").removeClass("slick-loading")})})},d.src=c})}var c,d,e,f,b=this;b.options.centerMode===!0?b.options.infinite===!0?(e=b.currentSlide+(b.options.slidesToShow/2+1),f=e+b.options.slidesToShow+2):(e=Math.max(0,b.currentSlide-(b.options.slidesToShow/2+1)),f=2+(b.options.slidesToShow/2+1)+b.currentSlide):(e=b.options.infinite?b.options.slidesToShow+b.currentSlide:b.currentSlide,f=e+b.options.slidesToShow,b.options.fade===!0&&(e>0&&e--,f<=b.slideCount&&f++)),c=b.$slider.find(".slick-slide").slice(e,f),g(c),b.slideCount<=b.options.slidesToShow?(d=b.$slider.find(".slick-slide"),g(d)):b.currentSlide>=b.slideCount-b.options.slidesToShow?(d=b.$slider.find(".slick-cloned").slice(0,b.options.slidesToShow),g(d)):0===b.currentSlide&&(d=b.$slider.find(".slick-cloned").slice(-1*b.options.slidesToShow),g(d))},b.prototype.loadSlider=function(){var a=this;a.setPosition(),a.$slideTrack.css({opacity:1}),a.$slider.removeClass("slick-loading"),a.initUI(),"progressive"===a.options.lazyLoad&&a.progressiveLazyLoad()},b.prototype.next=b.prototype.slickNext=function(){var a=this;a.changeSlide({data:{message:"next"}})},b.prototype.orientationChange=function(){var a=this;a.checkResponsive(),a.setPosition()},b.prototype.pause=b.prototype.slickPause=function(){var a=this;a.autoPlayClear(),a.paused=!0},b.prototype.play=b.prototype.slickPlay=function(){var a=this;a.paused=!1,a.autoPlay()},b.prototype.postSlide=function(a){var b=this;b.$slider.trigger("afterChange",[b,a]),b.animating=!1,b.setPosition(),b.swipeLeft=null,b.options.autoplay===!0&&b.paused===!1&&b.autoPlay(),b.options.accessibility===!0&&b.initADA()},b.prototype.prev=b.prototype.slickPrev=function(){var a=this;a.changeSlide({data:{message:"previous"}})},b.prototype.preventDefault=function(a){a.preventDefault()},b.prototype.progressiveLazyLoad=function(){var c,d,b=this;c=a("img[data-lazy]",b.$slider).length,c>0&&(d=a("img[data-lazy]",b.$slider).first(),d.attr("src",null),d.attr("src",d.attr("data-lazy")).removeClass("slick-loading").load(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad(),b.options.adaptiveHeight===!0&&b.setPosition()}).error(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad()}))},b.prototype.refresh=function(b){var d,e,c=this;e=c.slideCount-c.options.slidesToShow,c.options.infinite||(c.slideCount<=c.options.slidesToShow?c.currentSlide=0:c.currentSlide>e&&(c.currentSlide=e)),d=c.currentSlide,c.destroy(!0),a.extend(c,c.initials,{currentSlide:d}),c.init(),b||c.changeSlide({data:{message:"index",index:d}},!1)},b.prototype.registerBreakpoints=function(){var c,d,e,b=this,f=b.options.responsive||null;if("array"===a.type(f)&&f.length){b.respondTo=b.options.respondTo||"window";for(c in f)if(e=b.breakpoints.length-1,d=f[c].breakpoint,f.hasOwnProperty(c)){for(;e>=0;)b.breakpoints[e]&&b.breakpoints[e]===d&&b.breakpoints.splice(e,1),e--;b.breakpoints.push(d),b.breakpointSettings[d]=f[c].settings}b.breakpoints.sort(function(a,c){return b.options.mobileFirst?a-c:c-a})}},b.prototype.reinit=function(){var b=this;b.$slides=b.$slideTrack.children(b.options.slide).addClass("slick-slide"),b.slideCount=b.$slides.length,b.currentSlide>=b.slideCount&&0!==b.currentSlide&&(b.currentSlide=b.currentSlide-b.options.slidesToScroll),b.slideCount<=b.options.slidesToShow&&(b.currentSlide=0),b.registerBreakpoints(),b.setProps(),b.setupInfinite(),b.buildArrows(),b.updateArrows(),b.initArrowEvents(),b.buildDots(),b.updateDots(),b.initDotEvents(),b.checkResponsive(!1,!0),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().on("click.slick",b.selectHandler),b.setSlideClasses(0),b.setPosition(),b.$slider.trigger("reInit",[b]),b.options.autoplay===!0&&b.focusHandler()},b.prototype.resize=function(){var b=this;a(window).width()!==b.windowWidth&&(clearTimeout(b.windowDelay),b.windowDelay=window.setTimeout(function(){b.windowWidth=a(window).width(),b.checkResponsive(),b.unslicked||b.setPosition()},50))},b.prototype.removeSlide=b.prototype.slickRemove=function(a,b,c){var d=this;return"boolean"==typeof a?(b=a,a=b===!0?0:d.slideCount-1):a=b===!0?--a:a,d.slideCount<1||0>a||a>d.slideCount-1?!1:(d.unload(),c===!0?d.$slideTrack.children().remove():d.$slideTrack.children(this.options.slide).eq(a).remove(),d.$slides=d.$slideTrack.children(this.options.slide),d.$slideTrack.children(this.options.slide).detach(),d.$slideTrack.append(d.$slides),d.$slidesCache=d.$slides,void d.reinit())},b.prototype.setCSS=function(a){var d,e,b=this,c={};b.options.rtl===!0&&(a=-a),d="left"==b.positionProp?Math.ceil(a)+"px":"0px",e="top"==b.positionProp?Math.ceil(a)+"px":"0px",c[b.positionProp]=a,b.transformsEnabled===!1?b.$slideTrack.css(c):(c={},b.cssTransitions===!1?(c[b.animType]="translate("+d+", "+e+")",b.$slideTrack.css(c)):(c[b.animType]="translate3d("+d+", "+e+", 0px)",b.$slideTrack.css(c)))},b.prototype.setDimensions=function(){var a=this;a.options.vertical===!1?a.options.centerMode===!0&&a.$list.css({padding:"0px "+a.options.centerPadding}):(a.$list.height(a.$slides.first().outerHeight(!0)*a.options.slidesToShow),a.options.centerMode===!0&&a.$list.css({padding:a.options.centerPadding+" 0px"})),a.listWidth=a.$list.width(),a.listHeight=a.$list.height(),a.options.vertical===!1&&a.options.variableWidth===!1?(a.slideWidth=Math.ceil(a.listWidth/a.options.slidesToShow),a.$slideTrack.width(Math.ceil(a.slideWidth*a.$slideTrack.children(".slick-slide").length))):a.options.variableWidth===!0?a.$slideTrack.width(5e3*a.slideCount):(a.slideWidth=Math.ceil(a.listWidth),a.$slideTrack.height(Math.ceil(a.$slides.first().outerHeight(!0)*a.$slideTrack.children(".slick-slide").length)));var b=a.$slides.first().outerWidth(!0)-a.$slides.first().width();a.options.variableWidth===!1&&a.$slideTrack.children(".slick-slide").width(a.slideWidth-b)},b.prototype.setFade=function(){var c,b=this;b.$slides.each(function(d,e){c=b.slideWidth*d*-1,b.options.rtl===!0?a(e).css({position:"relative",right:c,top:0,zIndex:b.options.zIndex-2,opacity:0}):a(e).css({position:"relative",left:c,top:0,zIndex:b.options.zIndex-2,opacity:0})}),b.$slides.eq(b.currentSlide).css({zIndex:b.options.zIndex-1,opacity:1})},b.prototype.setHeight=function(){var a=this;if(1===a.options.slidesToShow&&a.options.adaptiveHeight===!0&&a.options.vertical===!1){var b=a.$slides.eq(a.currentSlide).outerHeight(!0);a.$list.css("height",b)}},b.prototype.setOption=b.prototype.slickSetOption=function(b,c,d){var f,g,e=this;if("responsive"===b&&"array"===a.type(c))for(g in c)if("array"!==a.type(e.options.responsive))e.options.responsive=[c[g]];else{for(f=e.options.responsive.length-1;f>=0;)e.options.responsive[f].breakpoint===c[g].breakpoint&&e.options.responsive.splice(f,1),f--;e.options.responsive.push(c[g])}else e.options[b]=c;d===!0&&(e.unload(),e.reinit())},b.prototype.setPosition=function(){var a=this;a.setDimensions(),a.setHeight(),a.options.fade===!1?a.setCSS(a.getLeft(a.currentSlide)):a.setFade(),a.$slider.trigger("setPosition",[a])},b.prototype.setProps=function(){var a=this,b=document.body.style;a.positionProp=a.options.vertical===!0?"top":"left","top"===a.positionProp?a.$slider.addClass("slick-vertical"):a.$slider.removeClass("slick-vertical"),(void 0!==b.WebkitTransition||void 0!==b.MozTransition||void 0!==b.msTransition)&&a.options.useCSS===!0&&(a.cssTransitions=!0),a.options.fade&&("number"==typeof a.options.zIndex?a.options.zIndex<3&&(a.options.zIndex=3):a.options.zIndex=a.defaults.zIndex),void 0!==b.OTransform&&(a.animType="OTransform",a.transformType="-o-transform",a.transitionType="OTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.MozTransform&&(a.animType="MozTransform",a.transformType="-moz-transform",a.transitionType="MozTransition",void 0===b.perspectiveProperty&&void 0===b.MozPerspective&&(a.animType=!1)),void 0!==b.webkitTransform&&(a.animType="webkitTransform",a.transformType="-webkit-transform",a.transitionType="webkitTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.msTransform&&(a.animType="msTransform",a.transformType="-ms-transform",a.transitionType="msTransition",void 0===b.msTransform&&(a.animType=!1)),void 0!==b.transform&&a.animType!==!1&&(a.animType="transform",a.transformType="transform",a.transitionType="transition"),a.transformsEnabled=a.options.useTransform&&null!==a.animType&&a.animType!==!1},b.prototype.setSlideClasses=function(a){var c,d,e,f,b=this;d=b.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden","true"),b.$slides.eq(a).addClass("slick-current"),b.options.centerMode===!0?(c=Math.floor(b.options.slidesToShow/2),b.options.infinite===!0&&(a>=c&&a<=b.slideCount-1-c?b.$slides.slice(a-c,a+c+1).addClass("slick-active").attr("aria-hidden","false"):(e=b.options.slidesToShow+a,d.slice(e-c+1,e+c+2).addClass("slick-active").attr("aria-hidden","false")),0===a?d.eq(d.length-1-b.options.slidesToShow).addClass("slick-center"):a===b.slideCount-1&&d.eq(b.options.slidesToShow).addClass("slick-center")),b.$slides.eq(a).addClass("slick-center")):a>=0&&a<=b.slideCount-b.options.slidesToShow?b.$slides.slice(a,a+b.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"):d.length<=b.options.slidesToShow?d.addClass("slick-active").attr("aria-hidden","false"):(f=b.slideCount%b.options.slidesToShow,e=b.options.infinite===!0?b.options.slidesToShow+a:a,b.options.slidesToShow==b.options.slidesToScroll&&b.slideCount-a<b.options.slidesToShow?d.slice(e-(b.options.slidesToShow-f),e+f).addClass("slick-active").attr("aria-hidden","false"):d.slice(e,e+b.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false")),"ondemand"===b.options.lazyLoad&&b.lazyLoad()},b.prototype.setupInfinite=function(){var c,d,e,b=this;if(b.options.fade===!0&&(b.options.centerMode=!1),b.options.infinite===!0&&b.options.fade===!1&&(d=null,b.slideCount>b.options.slidesToShow)){for(e=b.options.centerMode===!0?b.options.slidesToShow+1:b.options.slidesToShow,c=b.slideCount;c>b.slideCount-e;c-=1)d=c-1,a(b.$slides[d]).clone(!0).attr("id","").attr("data-slick-index",d-b.slideCount).prependTo(b.$slideTrack).addClass("slick-cloned");for(c=0;e>c;c+=1)d=c,a(b.$slides[d]).clone(!0).attr("id","").attr("data-slick-index",d+b.slideCount).appendTo(b.$slideTrack).addClass("slick-cloned");b.$slideTrack.find(".slick-cloned").find("[id]").each(function(){a(this).attr("id","")})}},b.prototype.setPaused=function(a){var b=this;b.options.autoplay===!0&&b.options.pauseOnHover===!0&&(b.paused=a,a?b.autoPlayClear():b.autoPlay())},b.prototype.selectHandler=function(b){var c=this,d=a(b.target).is(".slick-slide")?a(b.target):a(b.target).parents(".slick-slide"),e=parseInt(d.attr("data-slick-index"));return e||(e=0),c.slideCount<=c.options.slidesToShow?(c.setSlideClasses(e),void c.asNavFor(e)):void c.slideHandler(e)},b.prototype.slideHandler=function(a,b,c){var d,e,f,g,h=null,i=this;return b=b||!1,i.animating===!0&&i.options.waitForAnimate===!0||i.options.fade===!0&&i.currentSlide===a||i.slideCount<=i.options.slidesToShow?void 0:(b===!1&&i.asNavFor(a),d=a,h=i.getLeft(d),g=i.getLeft(i.currentSlide),i.currentLeft=null===i.swipeLeft?g:i.swipeLeft,i.options.infinite===!1&&i.options.centerMode===!1&&(0>a||a>i.getDotCount()*i.options.slidesToScroll)?void(i.options.fade===!1&&(d=i.currentSlide,c!==!0?i.animateSlide(g,function(){i.postSlide(d);
}):i.postSlide(d))):i.options.infinite===!1&&i.options.centerMode===!0&&(0>a||a>i.slideCount-i.options.slidesToScroll)?void(i.options.fade===!1&&(d=i.currentSlide,c!==!0?i.animateSlide(g,function(){i.postSlide(d)}):i.postSlide(d))):(i.options.autoplay===!0&&clearInterval(i.autoPlayTimer),e=0>d?i.slideCount%i.options.slidesToScroll!==0?i.slideCount-i.slideCount%i.options.slidesToScroll:i.slideCount+d:d>=i.slideCount?i.slideCount%i.options.slidesToScroll!==0?0:d-i.slideCount:d,i.animating=!0,i.$slider.trigger("beforeChange",[i,i.currentSlide,e]),f=i.currentSlide,i.currentSlide=e,i.setSlideClasses(i.currentSlide),i.updateDots(),i.updateArrows(),i.options.fade===!0?(c!==!0?(i.fadeSlideOut(f),i.fadeSlide(e,function(){i.postSlide(e)})):i.postSlide(e),void i.animateHeight()):void(c!==!0?i.animateSlide(h,function(){i.postSlide(e)}):i.postSlide(e))))},b.prototype.startLoad=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.hide(),a.$nextArrow.hide()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.hide(),a.$slider.addClass("slick-loading")},b.prototype.swipeDirection=function(){var a,b,c,d,e=this;return a=e.touchObject.startX-e.touchObject.curX,b=e.touchObject.startY-e.touchObject.curY,c=Math.atan2(b,a),d=Math.round(180*c/Math.PI),0>d&&(d=360-Math.abs(d)),45>=d&&d>=0?e.options.rtl===!1?"left":"right":360>=d&&d>=315?e.options.rtl===!1?"left":"right":d>=135&&225>=d?e.options.rtl===!1?"right":"left":e.options.verticalSwiping===!0?d>=35&&135>=d?"left":"right":"vertical"},b.prototype.swipeEnd=function(a){var c,b=this;if(b.dragging=!1,b.shouldClick=b.touchObject.swipeLength>10?!1:!0,void 0===b.touchObject.curX)return!1;if(b.touchObject.edgeHit===!0&&b.$slider.trigger("edge",[b,b.swipeDirection()]),b.touchObject.swipeLength>=b.touchObject.minSwipe)switch(b.swipeDirection()){case"left":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide+b.getSlideCount()):b.currentSlide+b.getSlideCount(),b.slideHandler(c),b.currentDirection=0,b.touchObject={},b.$slider.trigger("swipe",[b,"left"]);break;case"right":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide-b.getSlideCount()):b.currentSlide-b.getSlideCount(),b.slideHandler(c),b.currentDirection=1,b.touchObject={},b.$slider.trigger("swipe",[b,"right"])}else b.touchObject.startX!==b.touchObject.curX&&(b.slideHandler(b.currentSlide),b.touchObject={})},b.prototype.swipeHandler=function(a){var b=this;if(!(b.options.swipe===!1||"ontouchend"in document&&b.options.swipe===!1||b.options.draggable===!1&&-1!==a.type.indexOf("mouse")))switch(b.touchObject.fingerCount=a.originalEvent&&void 0!==a.originalEvent.touches?a.originalEvent.touches.length:1,b.touchObject.minSwipe=b.listWidth/b.options.touchThreshold,b.options.verticalSwiping===!0&&(b.touchObject.minSwipe=b.listHeight/b.options.touchThreshold),a.data.action){case"start":b.swipeStart(a);break;case"move":b.swipeMove(a);break;case"end":b.swipeEnd(a)}},b.prototype.swipeMove=function(a){var d,e,f,g,h,b=this;return h=void 0!==a.originalEvent?a.originalEvent.touches:null,!b.dragging||h&&1!==h.length?!1:(d=b.getLeft(b.currentSlide),b.touchObject.curX=void 0!==h?h[0].pageX:a.clientX,b.touchObject.curY=void 0!==h?h[0].pageY:a.clientY,b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curX-b.touchObject.startX,2))),b.options.verticalSwiping===!0&&(b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curY-b.touchObject.startY,2)))),e=b.swipeDirection(),"vertical"!==e?(void 0!==a.originalEvent&&b.touchObject.swipeLength>4&&a.preventDefault(),g=(b.options.rtl===!1?1:-1)*(b.touchObject.curX>b.touchObject.startX?1:-1),b.options.verticalSwiping===!0&&(g=b.touchObject.curY>b.touchObject.startY?1:-1),f=b.touchObject.swipeLength,b.touchObject.edgeHit=!1,b.options.infinite===!1&&(0===b.currentSlide&&"right"===e||b.currentSlide>=b.getDotCount()&&"left"===e)&&(f=b.touchObject.swipeLength*b.options.edgeFriction,b.touchObject.edgeHit=!0),b.options.vertical===!1?b.swipeLeft=d+f*g:b.swipeLeft=d+f*(b.$list.height()/b.listWidth)*g,b.options.verticalSwiping===!0&&(b.swipeLeft=d+f*g),b.options.fade===!0||b.options.touchMove===!1?!1:b.animating===!0?(b.swipeLeft=null,!1):void b.setCSS(b.swipeLeft)):void 0)},b.prototype.swipeStart=function(a){var c,b=this;return 1!==b.touchObject.fingerCount||b.slideCount<=b.options.slidesToShow?(b.touchObject={},!1):(void 0!==a.originalEvent&&void 0!==a.originalEvent.touches&&(c=a.originalEvent.touches[0]),b.touchObject.startX=b.touchObject.curX=void 0!==c?c.pageX:a.clientX,b.touchObject.startY=b.touchObject.curY=void 0!==c?c.pageY:a.clientY,void(b.dragging=!0))},b.prototype.unfilterSlides=b.prototype.slickUnfilter=function(){var a=this;null!==a.$slidesCache&&(a.unload(),a.$slideTrack.children(this.options.slide).detach(),a.$slidesCache.appendTo(a.$slideTrack),a.reinit())},b.prototype.unload=function(){var b=this;a(".slick-cloned",b.$slider).remove(),b.$dots&&b.$dots.remove(),b.$prevArrow&&b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.remove(),b.$nextArrow&&b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.remove(),b.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},b.prototype.unslick=function(a){var b=this;b.$slider.trigger("unslick",[b,a]),b.destroy()},b.prototype.updateArrows=function(){var b,a=this;b=Math.floor(a.options.slidesToShow/2),a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&!a.options.infinite&&(a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===a.currentSlide?(a.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-a.options.slidesToShow&&a.options.centerMode===!1?(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-1&&a.options.centerMode===!0&&(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},b.prototype.updateDots=function(){var a=this;null!==a.$dots&&(a.$dots.find("li").removeClass("slick-active").attr("aria-hidden","true"),a.$dots.find("li").eq(Math.floor(a.currentSlide/a.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden","false"))},b.prototype.visibility=function(){var a=this;document[a.hidden]?(a.paused=!0,a.autoPlayClear()):a.options.autoplay===!0&&(a.paused=!1,a.autoPlay())},b.prototype.initADA=function(){var b=this;b.$slides.add(b.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),b.$slideTrack.attr("role","listbox"),b.$slides.not(b.$slideTrack.find(".slick-cloned")).each(function(c){a(this).attr({role:"option","aria-describedby":"slick-slide"+b.instanceUid+c})}),null!==b.$dots&&b.$dots.attr("role","tablist").find("li").each(function(c){a(this).attr({role:"presentation","aria-selected":"false","aria-controls":"navigation"+b.instanceUid+c,id:"slick-slide"+b.instanceUid+c})}).first().attr("aria-selected","true").end().find("button").attr("role","button").end().closest("div").attr("role","toolbar"),b.activateADA()},b.prototype.activateADA=function(){var a=this;a.$slideTrack.find(".slick-active").attr({"aria-hidden":"false"}).find("a, input, button, select").attr({tabindex:"0"})},b.prototype.focusHandler=function(){var b=this;b.$slider.on("focus.slick blur.slick","*",function(c){c.stopImmediatePropagation();var d=a(this);setTimeout(function(){b.isPlay&&(d.is(":focus")?(b.autoPlayClear(),b.paused=!0):(b.paused=!1,b.autoPlay()))},0)})},a.fn.slick=function(){var f,g,a=this,c=arguments[0],d=Array.prototype.slice.call(arguments,1),e=a.length;for(f=0;e>f;f++)if("object"==typeof c||"undefined"==typeof c?a[f].slick=new b(a[f],c):g=a[f].slick[c].apply(a[f].slick,d),"undefined"!=typeof g)return g;return a}});
(function(window, document, undefined){
'use strict';
var skrollr={
get:function(){
return _instance;
},
init:function(options){
return _instance || new Skrollr(options);
},
VERSION:'0.6.30'
};
var hasProp=Object.prototype.hasOwnProperty;
var Math=window.Math;
var getStyle=window.getComputedStyle;
var documentElement;
var body;
var EVENT_TOUCHSTART='touchstart';
var EVENT_TOUCHMOVE='touchmove';
var EVENT_TOUCHCANCEL='touchcancel';
var EVENT_TOUCHEND='touchend';
var SKROLLABLE_CLASS='skrollable';
var SKROLLABLE_BEFORE_CLASS=SKROLLABLE_CLASS + '-before';
var SKROLLABLE_BETWEEN_CLASS=SKROLLABLE_CLASS + '-between';
var SKROLLABLE_AFTER_CLASS=SKROLLABLE_CLASS + '-after';
var SKROLLR_CLASS='skrollr';
var NO_SKROLLR_CLASS='no-' + SKROLLR_CLASS;
var SKROLLR_DESKTOP_CLASS=SKROLLR_CLASS + '-desktop';
var SKROLLR_MOBILE_CLASS=SKROLLR_CLASS + '-mobile';
var DEFAULT_EASING='linear';
var DEFAULT_DURATION=1000;
var DEFAULT_MOBILE_DECELERATION=0.004;
var DEFAULT_SKROLLRBODY='skrollr-body';
var DEFAULT_SMOOTH_SCROLLING_DURATION=200;
var ANCHOR_START='start';
var ANCHOR_END='end';
var ANCHOR_CENTER='center';
var ANCHOR_BOTTOM='bottom';
var SKROLLABLE_ID_DOM_PROPERTY='___skrollable_id';
var rxTouchIgnoreTags=/^(?:input|textarea|button|select)$/i;
var rxTrim=/^\s+|\s+$/g;
var rxKeyframeAttribute=/^data(?:-(_\w+))?(?:-?(-?\d*\.?\d+p?))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/;
var rxPropValue=/\s*(@?[\w\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi;
var rxPropEasing=/^(@?[a-z\-]+)\[(\w+)\]$/;
var rxCamelCase=/-([a-z0-9_])/g;
var rxCamelCaseFn=function(str, letter){
return letter.toUpperCase();
};
var rxNumericValue=/[\-+]?[\d]*\.?[\d]+/g;
var rxInterpolateString=/\{\?\}/g;
var rxRGBAIntegerColor=/rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g;
var rxGradient=/[a-z\-]+-gradient/g;
var theCSSPrefix='';
var theDashedCSSPrefix='';
var detectCSSPrefix=function(){
var rxPrefixes=/^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;
if(!getStyle){
return;
}
var style=getStyle(body, null);
for(var k in style){
theCSSPrefix=(k.match(rxPrefixes) || (+k==k && style[k].match(rxPrefixes)));
if(theCSSPrefix){
break;
}}
if(!theCSSPrefix){
theCSSPrefix=theDashedCSSPrefix='';
return;
}
theCSSPrefix=theCSSPrefix[0];
if(theCSSPrefix.slice(0,1)==='-'){
theDashedCSSPrefix=theCSSPrefix;
theCSSPrefix=({
'-webkit-':'webkit',
'-moz-':'Moz',
'-ms-':'ms',
'-o-':'O'
})[theCSSPrefix];
}else{
theDashedCSSPrefix='-' + theCSSPrefix.toLowerCase() + '-';
}};
var polyfillRAF=function(){
var requestAnimFrame=window.requestAnimationFrame || window[theCSSPrefix.toLowerCase() + 'RequestAnimationFrame'];
var lastTime=_now();
if(_isMobile || !requestAnimFrame){
requestAnimFrame=function(callback){
var deltaTime=_now() - lastTime;
var delay=Math.max(0, 1000 / 60 - deltaTime);
return window.setTimeout(function(){
lastTime=_now();
callback();
}, delay);
};}
return requestAnimFrame;
};
var polyfillCAF=function(){
var cancelAnimFrame=window.cancelAnimationFrame || window[theCSSPrefix.toLowerCase() + 'CancelAnimationFrame'];
if(_isMobile || !cancelAnimFrame){
cancelAnimFrame=function(timeout){
return window.clearTimeout(timeout);
};}
return cancelAnimFrame;
};
var easings={
begin:function(){
return 0;
},
end:function(){
return 1;
},
linear:function(p){
return p;
},
quadratic:function(p){
return p * p;
},
cubic:function(p){
return p * p * p;
},
swing:function(p){
return (-Math.cos(p * Math.PI) / 2) + 0.5;
},
sqrt:function(p){
return Math.sqrt(p);
},
outCubic:function(p){
return (Math.pow((p - 1), 3) + 1);
},
bounce:function(p){
var a;
if(p <=0.5083){
a=3;
} else if(p <=0.8489){
a=9;
} else if(p <=0.96208){
a=27;
} else if(p <=0.99981){
a=91;
}else{
return 1;
}
return 1 - Math.abs(3 * Math.cos(p * a * 1.028) / a);
}};
function Skrollr(options){
documentElement=document.documentElement;
body=document.body;
detectCSSPrefix();
_instance=this;
options=options || {};
_constants=options.constants || {};
if(options.easing){
for(var e in options.easing){
easings[e]=options.easing[e];
}}
_edgeStrategy=options.edgeStrategy || 'set';
_listeners={
beforerender:options.beforerender,
render:options.render,
keyframe:options.keyframe
};
_forceHeight=options.forceHeight!==false;
if(_forceHeight){
_scale=options.scale || 1;
}
_mobileDeceleration=options.mobileDeceleration || DEFAULT_MOBILE_DECELERATION;
_smoothScrollingEnabled=options.smoothScrolling!==false;
_smoothScrollingDuration=options.smoothScrollingDuration || DEFAULT_SMOOTH_SCROLLING_DURATION;
_smoothScrolling={
targetTop:_instance.getScrollTop()
};
_isMobile=((options.mobileCheck || function(){
return (/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera);
})());
if(_isMobile){
_skrollrBody=document.getElementById(options.skrollrBody || DEFAULT_SKROLLRBODY);
if(_skrollrBody){
_detect3DTransforms();
}
_initMobile();
_updateClass(documentElement, [SKROLLR_CLASS, SKROLLR_MOBILE_CLASS], [NO_SKROLLR_CLASS]);
}else{
_updateClass(documentElement, [SKROLLR_CLASS, SKROLLR_DESKTOP_CLASS], [NO_SKROLLR_CLASS]);
}
_instance.refresh();
_addEvent(window, 'resize orientationchange', function(){
var width=documentElement.clientWidth;
var height=documentElement.clientHeight;
if(height!==_lastViewportHeight || width!==_lastViewportWidth){
_lastViewportHeight=height;
_lastViewportWidth=width;
_requestReflow=true;
}});var requestAnimFrame=polyfillRAF();
(function animloop(){
_render();
_animFrame=requestAnimFrame(animloop);
}());
return _instance;
}
Skrollr.prototype.refresh=function(elements){
var elementIndex;
var elementsLength;
var ignoreID=false;
if(elements===undefined){
ignoreID=true;
_skrollables=[];
_skrollableIdCounter=0;
elements=document.getElementsByTagName('*');
} else if(elements.length===undefined){
elements=[elements];
}
elementIndex=0;
elementsLength=elements.length;
for(; elementIndex < elementsLength; elementIndex++){
var el=elements[elementIndex];
var anchorTarget=el;
var keyFrames=[];
var smoothScrollThis=_smoothScrollingEnabled;
var edgeStrategy=_edgeStrategy;
var emitEvents=false;
if(ignoreID && SKROLLABLE_ID_DOM_PROPERTY in el){
delete el[SKROLLABLE_ID_DOM_PROPERTY];
}
if(!el.attributes){
continue;
}
var attributeIndex=0;
var attributesLength=el.attributes.length;
for (; attributeIndex < attributesLength; attributeIndex++){
var attr=el.attributes[attributeIndex];
if(attr.name==='data-anchor-target'){
anchorTarget=document.querySelector(attr.value);
if(anchorTarget===null){
throw 'Unable to find anchor target "' + attr.value + '"';
}
continue;
}
if(attr.name==='data-smooth-scrolling'){
smoothScrollThis=attr.value!=='off';
continue;
}
if(attr.name==='data-edge-strategy'){
edgeStrategy=attr.value;
continue;
}
if(attr.name==='data-emit-events'){
emitEvents=true;
continue;
}
var match=attr.name.match(rxKeyframeAttribute);
if(match===null){
continue;
}
var kf={
props:attr.value,
element:el,
eventType:attr.name.replace(rxCamelCase, rxCamelCaseFn)
};
keyFrames.push(kf);
var constant=match[1];
if(constant){
kf.constant=constant.substr(1);
}
var offset=match[2];
if(/p$/.test(offset)){
kf.isPercentage=true;
kf.offset=(offset.slice(0, -1) | 0) / 100;
}else{
kf.offset=(offset | 0);
}
var anchor1=match[3];
var anchor2=match[4] || anchor1;
if(!anchor1 || anchor1===ANCHOR_START || anchor1===ANCHOR_END){
kf.mode='absolute';
if(anchor1===ANCHOR_END){
kf.isEnd=true;
} else if(!kf.isPercentage){
kf.offset=kf.offset * _scale;
}}else{
kf.mode='relative';
kf.anchors=[anchor1, anchor2];
}}
if(!keyFrames.length){
continue;
}
var styleAttr, classAttr;
var id;
if(!ignoreID && SKROLLABLE_ID_DOM_PROPERTY in el){
id=el[SKROLLABLE_ID_DOM_PROPERTY];
styleAttr=_skrollables[id].styleAttr;
classAttr=_skrollables[id].classAttr;
}else{
id=(el[SKROLLABLE_ID_DOM_PROPERTY]=_skrollableIdCounter++);
styleAttr=el.style.cssText;
classAttr=_getClass(el);
}
_skrollables[id]={
element:el,
styleAttr:styleAttr,
classAttr:classAttr,
anchorTarget:anchorTarget,
keyFrames:keyFrames,
smoothScrolling:smoothScrollThis,
edgeStrategy:edgeStrategy,
emitEvents:emitEvents,
lastFrameIndex:-1
};
_updateClass(el, [SKROLLABLE_CLASS], []);
}
_reflow();
elementIndex=0;
elementsLength=elements.length;
for(; elementIndex < elementsLength; elementIndex++){
var sk=_skrollables[elements[elementIndex][SKROLLABLE_ID_DOM_PROPERTY]];
if(sk===undefined){
continue;
}
_parseProps(sk);
_fillProps(sk);
}
return _instance;
};
Skrollr.prototype.relativeToAbsolute=function(element, viewportAnchor, elementAnchor){
var viewportHeight=documentElement.clientHeight;
var box=element.getBoundingClientRect();
var absolute=box.top;
var boxHeight=box.bottom - box.top;
if(viewportAnchor===ANCHOR_BOTTOM){
absolute -=viewportHeight;
} else if(viewportAnchor===ANCHOR_CENTER){
absolute -=viewportHeight / 2;
}
if(elementAnchor===ANCHOR_BOTTOM){
absolute +=boxHeight;
} else if(elementAnchor===ANCHOR_CENTER){
absolute +=boxHeight / 2;
}
absolute +=_instance.getScrollTop();
return (absolute + 0.5) | 0;
};
Skrollr.prototype.animateTo=function(top, options){
options=options || {};
var now=_now();
var scrollTop=_instance.getScrollTop();
var duration=options.duration===undefined ? DEFAULT_DURATION:options.duration;
_scrollAnimation={
startTop:scrollTop,
topDiff:top - scrollTop,
targetTop:top,
duration:duration,
startTime:now,
endTime:now + duration,
easing:easings[options.easing || DEFAULT_EASING],
done:options.done
};
if(!_scrollAnimation.topDiff){
if(_scrollAnimation.done){
_scrollAnimation.done.call(_instance, false);
}
_scrollAnimation=undefined;
}
return _instance;
};
Skrollr.prototype.stopAnimateTo=function(){
if(_scrollAnimation && _scrollAnimation.done){
_scrollAnimation.done.call(_instance, true);
}
_scrollAnimation=undefined;
};
Skrollr.prototype.isAnimatingTo=function(){
return !!_scrollAnimation;
};
Skrollr.prototype.isMobile=function(){
return _isMobile;
};
Skrollr.prototype.setScrollTop=function(top, force){
_forceRender=(force===true);
if(_isMobile){
_mobileOffset=Math.min(Math.max(top, 0), _maxKeyFrame);
}else{
window.scrollTo(0, top);
}
return _instance;
};
Skrollr.prototype.getScrollTop=function(){
if(_isMobile){
return _mobileOffset;
}else{
return window.pageYOffset || documentElement.scrollTop || body.scrollTop || 0;
}};
Skrollr.prototype.getMaxScrollTop=function(){
return _maxKeyFrame;
};
Skrollr.prototype.on=function(name, fn){
_listeners[name]=fn;
return _instance;
};
Skrollr.prototype.off=function(name){
delete _listeners[name];
return _instance;
};
Skrollr.prototype.destroy=function(){
var cancelAnimFrame=polyfillCAF();
cancelAnimFrame(_animFrame);
_removeAllEvents();
_updateClass(documentElement, [NO_SKROLLR_CLASS], [SKROLLR_CLASS, SKROLLR_DESKTOP_CLASS, SKROLLR_MOBILE_CLASS]);
var skrollableIndex=0;
var skrollablesLength=_skrollables.length;
for(; skrollableIndex < skrollablesLength; skrollableIndex++){
_reset(_skrollables[skrollableIndex].element);
}
documentElement.style.overflow=body.style.overflow='';
documentElement.style.height=body.style.height='';
if(_skrollrBody){
skrollr.setStyle(_skrollrBody, 'transform', 'none');
}
_instance=undefined;
_skrollrBody=undefined;
_listeners=undefined;
_forceHeight=undefined;
_maxKeyFrame=0;
_scale=1;
_constants=undefined;
_mobileDeceleration=undefined;
_direction='down';
_lastTop=-1;
_lastViewportWidth=0;
_lastViewportHeight=0;
_requestReflow=false;
_scrollAnimation=undefined;
_smoothScrollingEnabled=undefined;
_smoothScrollingDuration=undefined;
_smoothScrolling=undefined;
_forceRender=undefined;
_skrollableIdCounter=0;
_edgeStrategy=undefined;
_isMobile=false;
_mobileOffset=0;
_translateZ=undefined;
};
var _initMobile=function(){
var initialElement;
var initialTouchY;
var initialTouchX;
var currentElement;
var currentTouchY;
var currentTouchX;
var lastTouchY;
var deltaY;
var initialTouchTime;
var currentTouchTime;
var lastTouchTime;
var deltaTime;
_addEvent(documentElement, [EVENT_TOUCHSTART, EVENT_TOUCHMOVE, EVENT_TOUCHCANCEL, EVENT_TOUCHEND].join(' '), function(e){
var touch=e.changedTouches[0];
currentElement=e.target;
while(currentElement.nodeType===3){
currentElement=currentElement.parentNode;
}
currentTouchY=touch.clientY;
currentTouchX=touch.clientX;
currentTouchTime=e.timeStamp;
if(!rxTouchIgnoreTags.test(currentElement.tagName)){
e.preventDefault();
}
switch(e.type){
case EVENT_TOUCHSTART:if(initialElement){
initialElement.blur();
}
_instance.stopAnimateTo();
initialElement=currentElement;
initialTouchY=lastTouchY=currentTouchY;
initialTouchX=currentTouchX;
initialTouchTime=currentTouchTime;
break;
case EVENT_TOUCHMOVE:if(rxTouchIgnoreTags.test(currentElement.tagName) && document.activeElement!==currentElement){
e.preventDefault();
}
deltaY=currentTouchY - lastTouchY;
deltaTime=currentTouchTime - lastTouchTime;
_instance.setScrollTop(_mobileOffset - deltaY, true);
lastTouchY=currentTouchY;
lastTouchTime=currentTouchTime;
break;
default:case EVENT_TOUCHCANCEL:case EVENT_TOUCHEND:var distanceY=initialTouchY - currentTouchY;
var distanceX=initialTouchX - currentTouchX;
var distance2=distanceX * distanceX + distanceY * distanceY;
if(distance2 < 49){
if(!rxTouchIgnoreTags.test(initialElement.tagName)){
initialElement.focus();
var clickEvent=document.createEvent('MouseEvents');
clickEvent.initMouseEvent('click', true, true, e.view, 1, touch.screenX, touch.screenY, touch.clientX, touch.clientY, e.ctrlKey, e.altKey, e.shiftKey, e.metaKey, 0, null);
initialElement.dispatchEvent(clickEvent);
}
return;
}
initialElement=undefined;
var speed=deltaY / deltaTime;
speed=Math.max(Math.min(speed, 3), -3);
var duration=Math.abs(speed / _mobileDeceleration);
var targetOffset=speed * duration + 0.5 * _mobileDeceleration * duration * duration;
var targetTop=_instance.getScrollTop() - targetOffset;
var targetRatio=0;
if(targetTop > _maxKeyFrame){
targetRatio=(_maxKeyFrame - targetTop) / targetOffset;
targetTop=_maxKeyFrame;
} else if(targetTop < 0){
targetRatio=-targetTop / targetOffset;
targetTop=0;
}
duration=duration * (1 - targetRatio);
_instance.animateTo((targetTop + 0.5) | 0, {easing:'outCubic', duration:duration});break;
}});window.scrollTo(0, 0);
documentElement.style.overflow=body.style.overflow='hidden';
};
var _updateDependentKeyFrames=function(){
var viewportHeight=documentElement.clientHeight;
var processedConstants=_processConstants();
var skrollable;
var element;
var anchorTarget;
var keyFrames;
var keyFrameIndex;
var keyFramesLength;
var kf;
var skrollableIndex;
var skrollablesLength;
var offset;
var constantValue;
skrollableIndex=0;
skrollablesLength=_skrollables.length;
for(; skrollableIndex < skrollablesLength; skrollableIndex++){
skrollable=_skrollables[skrollableIndex];
element=skrollable.element;
anchorTarget=skrollable.anchorTarget;
keyFrames=skrollable.keyFrames;
keyFrameIndex=0;
keyFramesLength=keyFrames.length;
for(; keyFrameIndex < keyFramesLength; keyFrameIndex++){
kf=keyFrames[keyFrameIndex];
offset=kf.offset;
constantValue=processedConstants[kf.constant] || 0;
kf.frame=offset;
if(kf.isPercentage){
offset=offset * viewportHeight;
kf.frame=offset;
}
if(kf.mode==='relative'){
_reset(element);
kf.frame=_instance.relativeToAbsolute(anchorTarget, kf.anchors[0], kf.anchors[1]) - offset;
_reset(element, true);
}
kf.frame +=constantValue;
if(_forceHeight){
if(!kf.isEnd && kf.frame > _maxKeyFrame){
_maxKeyFrame=kf.frame;
}}
}}
_maxKeyFrame=Math.max(_maxKeyFrame, _getDocumentHeight());
skrollableIndex=0;
skrollablesLength=_skrollables.length;
for(; skrollableIndex < skrollablesLength; skrollableIndex++){
skrollable=_skrollables[skrollableIndex];
keyFrames=skrollable.keyFrames;
keyFrameIndex=0;
keyFramesLength=keyFrames.length;
for(; keyFrameIndex < keyFramesLength; keyFrameIndex++){
kf=keyFrames[keyFrameIndex];
constantValue=processedConstants[kf.constant] || 0;
if(kf.isEnd){
kf.frame=_maxKeyFrame - kf.offset + constantValue;
}}
skrollable.keyFrames.sort(_keyFrameComparator);
}};
var _calcSteps=function(fakeFrame, actualFrame){
var skrollableIndex=0;
var skrollablesLength=_skrollables.length;
for(; skrollableIndex < skrollablesLength; skrollableIndex++){
var skrollable=_skrollables[skrollableIndex];
var element=skrollable.element;
var frame=skrollable.smoothScrolling ? fakeFrame:actualFrame;
var frames=skrollable.keyFrames;
var framesLength=frames.length;
var firstFrame=frames[0];
var lastFrame=frames[frames.length - 1];
var beforeFirst=frame < firstFrame.frame;
var afterLast=frame > lastFrame.frame;
var firstOrLastFrame=beforeFirst ? firstFrame:lastFrame;
var emitEvents=skrollable.emitEvents;
var lastFrameIndex=skrollable.lastFrameIndex;
var key;
var value;
if(beforeFirst || afterLast){
if(beforeFirst && skrollable.edge===-1 || afterLast && skrollable.edge===1){
continue;
}
if(beforeFirst){
_updateClass(element, [SKROLLABLE_BEFORE_CLASS], [SKROLLABLE_AFTER_CLASS, SKROLLABLE_BETWEEN_CLASS]);
if(emitEvents && lastFrameIndex > -1){
_emitEvent(element, firstFrame.eventType, _direction);
skrollable.lastFrameIndex=-1;
}}else{
_updateClass(element, [SKROLLABLE_AFTER_CLASS], [SKROLLABLE_BEFORE_CLASS, SKROLLABLE_BETWEEN_CLASS]);
if(emitEvents && lastFrameIndex < framesLength){
_emitEvent(element, lastFrame.eventType, _direction);
skrollable.lastFrameIndex=framesLength;
}}
skrollable.edge=beforeFirst ? -1:1;
switch(skrollable.edgeStrategy){
case 'reset':_reset(element);
continue;
case 'ease':frame=firstOrLastFrame.frame;
break;
default:case 'set':var props=firstOrLastFrame.props;
for(key in props){
if(hasProp.call(props, key)){
value=_interpolateString(props[key].value);
if(key.indexOf('@')===0){
element.setAttribute(key.substr(1), value);
}else{
skrollr.setStyle(element, key, value);
}}
}
continue;
}}else{
if(skrollable.edge!==0){
_updateClass(element, [SKROLLABLE_CLASS, SKROLLABLE_BETWEEN_CLASS], [SKROLLABLE_BEFORE_CLASS, SKROLLABLE_AFTER_CLASS]);
skrollable.edge=0;
}}
var keyFrameIndex=0;
for(; keyFrameIndex < framesLength - 1; keyFrameIndex++){
if(frame >=frames[keyFrameIndex].frame && frame <=frames[keyFrameIndex + 1].frame){
var left=frames[keyFrameIndex];
var right=frames[keyFrameIndex + 1];
for(key in left.props){
if(hasProp.call(left.props, key)){
var progress=(frame - left.frame) / (right.frame - left.frame);
progress=left.props[key].easing(progress);
value=_calcInterpolation(left.props[key].value, right.props[key].value, progress);
value=_interpolateString(value);
if(key.indexOf('@')===0){
element.setAttribute(key.substr(1), value);
}else{
skrollr.setStyle(element, key, value);
}}
}
if(emitEvents){
if(lastFrameIndex!==keyFrameIndex){
if(_direction==='down'){
_emitEvent(element, left.eventType, _direction);
}else{
_emitEvent(element, right.eventType, _direction);
}
skrollable.lastFrameIndex=keyFrameIndex;
}}
break;
}}
}};
var _render=function(){
if(_requestReflow){
_requestReflow=false;
_reflow();
}
var renderTop=_instance.getScrollTop();
var afterAnimationCallback;
var now=_now();
var progress;
if(_scrollAnimation){
if(now >=_scrollAnimation.endTime){
renderTop=_scrollAnimation.targetTop;
afterAnimationCallback=_scrollAnimation.done;
_scrollAnimation=undefined;
}else{
progress=_scrollAnimation.easing((now - _scrollAnimation.startTime) / _scrollAnimation.duration);
renderTop=(_scrollAnimation.startTop + progress * _scrollAnimation.topDiff) | 0;
}
_instance.setScrollTop(renderTop, true);
}
else if(!_forceRender){
var smoothScrollingDiff=_smoothScrolling.targetTop - renderTop;
if(smoothScrollingDiff){
_smoothScrolling={
startTop:_lastTop,
topDiff:renderTop - _lastTop,
targetTop:renderTop,
startTime:_lastRenderCall,
endTime:_lastRenderCall + _smoothScrollingDuration
};}
if(now <=_smoothScrolling.endTime){
progress=easings.sqrt((now - _smoothScrolling.startTime) / _smoothScrollingDuration);
renderTop=(_smoothScrolling.startTop + progress * _smoothScrolling.topDiff) | 0;
}}
if(_forceRender || _lastTop!==renderTop){
_direction=(renderTop > _lastTop) ? 'down':(renderTop < _lastTop ? 'up':_direction);
_forceRender=false;
var listenerParams={
curTop:renderTop,
lastTop:_lastTop,
maxTop:_maxKeyFrame,
direction:_direction
};
var continueRendering=_listeners.beforerender && _listeners.beforerender.call(_instance, listenerParams);
if(continueRendering!==false){
_calcSteps(renderTop, _instance.getScrollTop());
if(_isMobile && _skrollrBody){
skrollr.setStyle(_skrollrBody, 'transform', 'translate(0, ' + -(_mobileOffset) + 'px) ' + _translateZ);
}
_lastTop=renderTop;
if(_listeners.render){
_listeners.render.call(_instance, listenerParams);
}}
if(afterAnimationCallback){
afterAnimationCallback.call(_instance, false);
}}
_lastRenderCall=now;
};
var _parseProps=function(skrollable){
var keyFrameIndex=0;
var keyFramesLength=skrollable.keyFrames.length;
for(; keyFrameIndex < keyFramesLength; keyFrameIndex++){
var frame=skrollable.keyFrames[keyFrameIndex];
var easing;
var value;
var prop;
var props={};
var match;
while((match=rxPropValue.exec(frame.props))!==null){
prop=match[1];
value=match[2];
easing=prop.match(rxPropEasing);
if(easing!==null){
prop=easing[1];
easing=easing[2];
}else{
easing=DEFAULT_EASING;
}
value=value.indexOf('!') ? _parseProp(value):[value.slice(1)];
props[prop]={
value:value,
easing:easings[easing]
};}
frame.props=props;
}};
var _parseProp=function(val){
var numbers=[];
rxRGBAIntegerColor.lastIndex=0;
val=val.replace(rxRGBAIntegerColor, function(rgba){
return rgba.replace(rxNumericValue, function(n){
return n / 255 * 100 + '%';
});});if(theDashedCSSPrefix){
rxGradient.lastIndex=0;
val=val.replace(rxGradient, function(s){
return theDashedCSSPrefix + s;
});}
val=val.replace(rxNumericValue, function(n){
numbers.push(+n);
return '{?}';
});numbers.unshift(val);
return numbers;
};
var _fillProps=function(sk){
var propList={};
var keyFrameIndex;
var keyFramesLength;
keyFrameIndex=0;
keyFramesLength=sk.keyFrames.length;
for(; keyFrameIndex < keyFramesLength; keyFrameIndex++){
_fillPropForFrame(sk.keyFrames[keyFrameIndex], propList);
}
propList={};
keyFrameIndex=sk.keyFrames.length - 1;
for(; keyFrameIndex >=0; keyFrameIndex--){
_fillPropForFrame(sk.keyFrames[keyFrameIndex], propList);
}};
var _fillPropForFrame=function(frame, propList){
var key;
for(key in propList){
if(!hasProp.call(frame.props, key)){
frame.props[key]=propList[key];
}}
for(key in frame.props){
propList[key]=frame.props[key];
}};
var _calcInterpolation=function(val1, val2, progress){
var valueIndex;
var val1Length=val1.length;
if(val1Length!==val2.length){
throw 'Can\'t interpolate between "' + val1[0] + '" and "' + val2[0] + '"';
}
var interpolated=[val1[0]];
valueIndex=1;
for(; valueIndex < val1Length; valueIndex++){
interpolated[valueIndex]=val1[valueIndex] + ((val2[valueIndex] - val1[valueIndex]) * progress);
}
return interpolated;
};
var _interpolateString=function(val){
var valueIndex=1;
rxInterpolateString.lastIndex=0;
return val[0].replace(rxInterpolateString, function(){
return val[valueIndex++];
});};
var _reset=function(elements, undo){
elements=[].concat(elements);
var skrollable;
var element;
var elementsIndex=0;
var elementsLength=elements.length;
for(; elementsIndex < elementsLength; elementsIndex++){
element=elements[elementsIndex];
skrollable=_skrollables[element[SKROLLABLE_ID_DOM_PROPERTY]];
if(!skrollable){
continue;
}
if(undo){
element.style.cssText=skrollable.dirtyStyleAttr;
_updateClass(element, skrollable.dirtyClassAttr);
}else{
skrollable.dirtyStyleAttr=element.style.cssText;
skrollable.dirtyClassAttr=_getClass(element);
element.style.cssText=skrollable.styleAttr;
_updateClass(element, skrollable.classAttr);
}}
};
var _detect3DTransforms=function(){
_translateZ='translateZ(0)';
skrollr.setStyle(_skrollrBody, 'transform', _translateZ);
var computedStyle=getStyle(_skrollrBody);
var computedTransform=computedStyle.getPropertyValue('transform');
var computedTransformWithPrefix=computedStyle.getPropertyValue(theDashedCSSPrefix + 'transform');
var has3D=(computedTransform && computedTransform!=='none') || (computedTransformWithPrefix && computedTransformWithPrefix!=='none');
if(!has3D){
_translateZ='';
}};
skrollr.setStyle=function(el, prop, val){
var style=el.style;
prop=prop.replace(rxCamelCase, rxCamelCaseFn).replace('-', '');
if(prop==='zIndex'){
if(isNaN(val)){
style[prop]=val;
}else{
style[prop]='' + (val | 0);
}}
else if(prop==='float'){
style.styleFloat=style.cssFloat=val;
}else{
try {
if(theCSSPrefix){
style[theCSSPrefix + prop.slice(0,1).toUpperCase() + prop.slice(1)]=val;
}
style[prop]=val;
} catch(ignore){}}
};
var _addEvent=skrollr.addEvent=function(element, names, callback){
var intermediate=function(e){
e=e || window.event;
if(!e.target){
e.target=e.srcElement;
}
if(!e.preventDefault){
e.preventDefault=function(){
e.returnValue=false;
e.defaultPrevented=true;
};}
return callback.call(this, e);
};
names=names.split(' ');
var name;
var nameCounter=0;
var namesLength=names.length;
for(; nameCounter < namesLength; nameCounter++){
name=names[nameCounter];
if(element.addEventListener){
element.addEventListener(name, callback, false);
}else{
element.attachEvent('on' + name, intermediate);
}
_registeredEvents.push({
element:element,
name:name,
listener:callback
});}};
var _removeEvent=skrollr.removeEvent=function(element, names, callback){
names=names.split(' ');
var nameCounter=0;
var namesLength=names.length;
for(; nameCounter < namesLength; nameCounter++){
if(element.removeEventListener){
element.removeEventListener(names[nameCounter], callback, false);
}else{
element.detachEvent('on' + names[nameCounter], callback);
}}
};
var _removeAllEvents=function(){
var eventData;
var eventCounter=0;
var eventsLength=_registeredEvents.length;
for(; eventCounter < eventsLength; eventCounter++){
eventData=_registeredEvents[eventCounter];
_removeEvent(eventData.element, eventData.name, eventData.listener);
}
_registeredEvents=[];
};
var _emitEvent=function(element, name, direction){
if(_listeners.keyframe){
_listeners.keyframe.call(_instance, element, name, direction);
}};
var _reflow=function(){
var pos=_instance.getScrollTop();
_maxKeyFrame=0;
if(_forceHeight && !_isMobile){
body.style.height='';
}
_updateDependentKeyFrames();
if(_forceHeight && !_isMobile){
body.style.height=(_maxKeyFrame + documentElement.clientHeight) + 'px';
}
if(_isMobile){
_instance.setScrollTop(Math.min(_instance.getScrollTop(), _maxKeyFrame));
}else{
_instance.setScrollTop(pos, true);
}
_forceRender=true;
};
var _processConstants=function(){
var viewportHeight=documentElement.clientHeight;
var copy={};
var prop;
var value;
for(prop in _constants){
value=_constants[prop];
if(typeof value==='function'){
value=value.call(_instance);
}
else if((/p$/).test(value)){
value=(value.slice(0, -1) / 100) * viewportHeight;
}
copy[prop]=value;
}
return copy;
};
var _getDocumentHeight=function(){
var skrollrBodyHeight=0;
var bodyHeight;
if(_skrollrBody){
skrollrBodyHeight=Math.max(_skrollrBody.offsetHeight, _skrollrBody.scrollHeight);
}
bodyHeight=Math.max(skrollrBodyHeight, body.scrollHeight, body.offsetHeight, documentElement.scrollHeight, documentElement.offsetHeight, documentElement.clientHeight);
return bodyHeight - documentElement.clientHeight;
};
var _getClass=function(element){
var prop='className';
if(window.SVGElement && element instanceof window.SVGElement){
element=element[prop];
prop='baseVal';
}
return element[prop];
};
var _updateClass=function(element, add, remove){
var prop='className';
if(window.SVGElement && element instanceof window.SVGElement){
element=element[prop];
prop='baseVal';
}
if(remove===undefined){
element[prop]=add;
return;
}
var val=element[prop];
var classRemoveIndex=0;
var removeLength=remove.length;
for(; classRemoveIndex < removeLength; classRemoveIndex++){
val=_untrim(val).replace(_untrim(remove[classRemoveIndex]), ' ');
}
val=_trim(val);
var classAddIndex=0;
var addLength=add.length;
for(; classAddIndex < addLength; classAddIndex++){
if(_untrim(val).indexOf(_untrim(add[classAddIndex]))===-1){
val +=' ' + add[classAddIndex];
}}
element[prop]=_trim(val);
};
var _trim=function(a){
return a.replace(rxTrim, '');
};
var _untrim=function(a){
return ' ' + a + ' ';
};
var _now=Date.now || function(){
return +new Date();
};
var _keyFrameComparator=function(a, b){
return a.frame - b.frame;
};
var _instance;
var _skrollables;
var _skrollrBody;
var _listeners;
var _forceHeight;
var _maxKeyFrame=0;
var _scale=1;
var _constants;
var _mobileDeceleration;
var _direction='down';
var _lastTop=-1;
var _lastRenderCall=_now();
var _lastViewportWidth=0;
var _lastViewportHeight=0;
var _requestReflow=false;
var _scrollAnimation;
var _smoothScrollingEnabled;
var _smoothScrollingDuration;
var _smoothScrolling;
var _forceRender;
var _skrollableIdCounter=0;
var _edgeStrategy;
var _isMobile=false;
var _mobileOffset=0;
var _translateZ;
var _registeredEvents=[];
var _animFrame;
if(typeof define==='function' && define.amd){
define([], function (){
return skrollr;
});} else if(typeof module!=='undefined' && module.exports){
module.exports=skrollr;
}else{
window.skrollr=skrollr;
}}(window, document));
(function($){
function injector(t, splitter, klass, after){
var a=t.text().split(splitter), inject='';
if(a.length){
$(a).each(function(i, item){
inject +='<span class="'+klass+(i+1)+'">'+item+'</span>'+after;
});t.empty().append(inject);
}}
var methods={
init:function(){
return this.each(function(){
injector($(this), '', 'char', '');
});},
words:function(){
return this.each(function(){
injector($(this), ' ', 'word', ' ');
});},
lines:function(){
return this.each(function(){
var r="eefec303079ad17405c889e092e105b0";
injector($(this).children("br").replaceWith(r).end(), r, 'line', '');
});}};
$.fn.lettering=function( method){
if(method && methods[method]){
return methods[ method ].apply( this, [].slice.call( arguments, 1));
} else if(method==='letters' || ! method){
return methods.init.apply( this, [].slice.call( arguments, 0)); 
}
$.error( 'Method ' +  method + ' does not exist on jQuery.lettering');
return this;
};})(jQuery);
(function ($){
"use strict";
function isInEffect (effect){
return /In/.test(effect) || $.inArray(effect, $.fn.textillate.defaults.inEffects) >=0;
};
function isOutEffect (effect){
return /Out/.test(effect) || $.inArray(effect, $.fn.textillate.defaults.outEffects) >=0;
};
function stringToBoolean(str){
if(str!=="true" && str!=="false") return str;
return (str==="true");
};
function getData (node){
var attrs=node.attributes || []
, data={};
if(!attrs.length) return data;
$.each(attrs, function (i, attr){
var nodeName=attr.nodeName.replace(/delayscale/, 'delayScale');
if(/^data-in-*/.test(nodeName)){
data.in=data.in || {};
data.in[nodeName.replace(/data-in-/, '')]=stringToBoolean(attr.nodeValue);
} else if(/^data-out-*/.test(nodeName)){
data.out=data.out || {};
data.out[nodeName.replace(/data-out-/, '')]=stringToBoolean(attr.nodeValue);
} else if(/^data-*/.test(nodeName)){
data[nodeName.replace(/data-/, '')]=stringToBoolean(attr.nodeValue);
}})
return data;
}
function shuffle (o){
for (var j, x, i=o.length; i; j=parseInt(Math.random() * i), x=o[--i], o[i]=o[j], o[j]=x);
return o;
}
function animate ($t, effect, cb){
$t.addClass('animated ' + effect)
.css('visibility', 'visible')
.show();
$t.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){
$t.removeClass('animated ' + effect);
cb && cb();
});}
function animateTokens ($tokens, options, cb){
var that=this
, count=$tokens.length;
if(!count){
cb && cb();
return;
}
if(options.shuffle) $tokens=shuffle($tokens);
if(options.reverse) $tokens=$tokens.toArray().reverse();
$.each($tokens, function (i, t){
var $token=$(t);
function complete (){
if(isInEffect(options.effect)){
$token.css('visibility', 'visible');
} else if(isOutEffect(options.effect)){
$token.css('visibility', 'hidden');
}
count -=1;
if(!count && cb) cb();
}
var delay=options.sync ? options.delay:options.delay * i * options.delayScale;
$token.text() ?
setTimeout(function (){ animate($token, options.effect, complete) }, delay):complete();
});};
var Textillate=function (element, options){
var base=this
, $element=$(element);
base.init=function (){
base.$texts=$element.find(options.selector);
if(!base.$texts.length){
base.$texts=$('<ul class="texts"><li>' + $element.html() + '</li></ul>');
$element.html(base.$texts);
}
base.$texts.hide();
base.$current=$('<span>')
.html(base.$texts.find(':first-child').html())
.prependTo($element);
if(isInEffect(options.in.effect)){
base.$current.css('visibility', 'hidden');
} else if(isOutEffect(options.out.effect)){
base.$current.css('visibility', 'visible');
}
base.setOptions(options);
base.timeoutRun=null;
setTimeout(function (){
base.options.autoStart && base.start();
}, base.options.initialDelay)
};
base.setOptions=function (options){
base.options=options;
};
base.triggerEvent=function (name){
var e=$.Event(name + '.tlt');
$element.trigger(e, base);
return e;
};
base.in=function (index, cb){
index=index || 0;
var $elem=base.$texts.find(':nth-child(' + ((index||0) + 1) + ')')
, options=$.extend(true, {}, base.options, $elem.length ? getData($elem[0]):{})
, $tokens;
$elem.addClass('current');
base.triggerEvent('inAnimationBegin');
base.$current
.html($elem.html())
.lettering('words');
if(base.options.type=="char"){
base.$current.find('[class^="word"]')
.css({
'display':'inline-block',
'-webkit-transform':'translate3d(0,0,0)',
'-moz-transform':'translate3d(0,0,0)',
'-o-transform':'translate3d(0,0,0)',
'transform':'translate3d(0,0,0)'
})
.each(function (){ $(this).lettering() });}
$tokens=base.$current
.find('[class^="' + base.options.type + '"]')
.css('display', 'inline-block');
if(isInEffect(options.in.effect)){
$tokens.css('visibility', 'hidden');
} else if(isOutEffect(options.in.effect)){
$tokens.css('visibility', 'visible');
}
base.currentIndex=index;
animateTokens($tokens, options.in, function (){
base.triggerEvent('inAnimationEnd');
if(options.in.callback) options.in.callback();
if(cb) cb(base);
});};
base.out=function (cb){
var $elem=base.$texts.find(':nth-child(' + ((base.currentIndex||0) + 1) + ')')
, $tokens=base.$current.find('[class^="' + base.options.type + '"]')
, options=$.extend(true, {}, base.options, $elem.length ? getData($elem[0]):{})
base.triggerEvent('outAnimationBegin');
animateTokens($tokens, options.out, function (){
$elem.removeClass('current');
base.triggerEvent('outAnimationEnd');
if(options.out.callback) options.out.callback();
if(cb) cb(base);
});};
base.start=function (index){
setTimeout(function (){
base.triggerEvent('start');
(function run (index){
base.in(index, function (){
var length=base.$texts.children().length;
index +=1;
if(!base.options.loop && index >=length){
if(base.options.callback) base.options.callback();
base.triggerEvent('end');
}else{
index=index % length;
base.timeoutRun=setTimeout(function (){
base.out(function (){
run(index)
});}, base.options.minDisplayTime);
}});}(index || 0));
}, base.options.initialDelay);
};
base.stop=function (){
if(base.timeoutRun){
clearInterval(base.timeoutRun);
base.timeoutRun=null;
}};
base.init();
}
$.fn.textillate=function (settings, args){
return this.each(function (){
var $this=$(this)
, data=$this.data('textillate')
, options=$.extend(true, {}, $.fn.textillate.defaults, getData(this), typeof settings=='object' && settings);
if(!data){
$this.data('textillate', (data=new Textillate(this, options)));
} else if(typeof settings=='string'){
data[settings].apply(data, [].concat(args));
}else{
data.setOptions.call(data, options);
}})
};
$.fn.textillate.defaults={
selector:'.texts',
loop:false,
minDisplayTime:2000,
initialDelay:0,
in:{
effect:'fadeInLeftBig',
delayScale:1.5,
delay:50,
sync:false,
reverse:false,
shuffle:false,
callback:function (){}},
out:{
effect:'hinge',
delayScale:1.5,
delay:50,
sync:false,
reverse:false,
shuffle:false,
callback:function (){}},
autoStart:true,
inEffects:[],
outEffects:[ 'hinge' ],
callback:function (){},
type:'char'
};}(jQuery));