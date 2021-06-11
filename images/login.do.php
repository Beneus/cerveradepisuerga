<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sign In | Made-in-China.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="Description"
	content="Sign in to Made-in-China.com to source China products anywhere, anytime." />
<meta name="Keywords" content="Made-in-China.com sign in, sign in" />
<link href="https://login.made-in-china.com/css/vo/login.css" rel="stylesheet" type="text/css" />
<link href="https://login.made-in-china.com/css/btn.css" rel="stylesheet" type="text/css" />
<link href="https://login.made-in-china.com/css/form.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#header,#nav,#main,#top .cont, #top .grid { width: 870px }
#nav {display:none;}
#urh { width: 868px }
.navWB #pr { margin-left: 20px; margin-right: 10px }
#voNav { display: none }
#faptcha_widget{padding-top:10px;}
#faptcha_widget input { border-color: #1E668E #7F9DB9 #7F9DB9 #1E668E; border-style: solid; border-width: 1px; padding: 2px 0 0; height: 18px }
.faptcha-widget #faptcha_audio {display: none}
.multi-lang {margin-top:0;}
.faptcha-widget #faptcha_main{_height:40px!important;overflow:hidden}
#faptcha_main,#faptcha_input{display:inline-block;*display:inline;zoom:1;vertical-align:top;margin-right:10px;}
.faptcha-widget #faptcha_response_field{width:55px!important;padding: 0 5px;height:42px;line-height:42px;_height:38px;_line-height:38px;font-size:16px;border:1px solid #ccc}
</style>
<!-- compliance patch for microsoft browsers -->
<!--[if lt IE 7]>
	<style>
	.live-800{
		position: absolute;
	    bottom: auto;
	    clear: both;
		top:expression(eval(document.compatMode &&  document.compatMode=='CSS1Compat') ? documentElement.scrollTop +(documentElement.clientHeight-this.clientHeight) - 1: document.body.scrollTop+(document.body.clientHeight-this.clientHeight) - 1);
	}
	</style>
<![endif]-->
<script type="text/javascript" src="https://login.made-in-china.com/script/jquery.js"></script>
<script type="text/javascript" src="https://login.made-in-china.com/script/lgname.js"></script>
<script type="text/javascript" src="https://login.made-in-china.com/script/autocomplete.js"></script>
<script type="text/javascript">
document.domain = "made-in-china.com";
//<![CDATA[
function reSetEvent(doc) {
	//<!-- mailTip -->
	new autoComplete({
		input: doc.getElementById('logonInfo.logUserName'),
		tipCls: 'mail-guess',
		hoverCls: 'hover',
		type: 'login'
	});

	//<!-- password upCaseCode check -->
	var target = $('input[name="logonInfo.logPassword"],input[name="logonPassword"]');
	if (target.size() > 0) {
		target.each(function(){
			$(this).caps(function(isCapsOn) {
				if(  $('p.capsLock').size()>1){
					$(this).parents('table').find('p.capsLock').closest('tr').toggle(isCapsOn);
				}else{
					$('p.capsLock').closest('tr').toggle(isCapsOn);
				}
			});
		});
	}

	//<!-- remember passcount -->
	showLgName('logonInfo.logUserName');
    if (jQuery('#logon input[name="logonInfo.logUserName"]')[0].value == '') {
    	jQuery('#logon input[name="logonInfo.logUserName"]').focus();
    } else {
    	jQuery('#logon input[name="logonInfo.logPassword"]').focus();
	}
}

jQuery(document).ready(function(){
	/*mic - ??????
	try {
		if (window.parent !== window && window.parent.$('#login')) {
			window.parent.$('#login').html($('#login').html());
			window.parent.reSetEvent.call(window.parent, window.parent.document);
			if (window.parent.$('#faptcha_reload_btn')) {
				if(window.parent.Faptcha && typeof window.parent.Faptcha.reload === 'function'){
					window.parent.Faptcha.reload();//$('#faptcha_reload_btn').click();
				}
			}
		}
	} catch (e) {}
    mic - ?????? end*/

	reSetEvent.call(this, document);
});
//]]>
</script>
</head>
<body>



<div id="top">
    <div class="grid">
    	<ul class="user-nav">
        
                <li class="first menu-item">New user? <a rel="nofollow" href="http://membercenter.made-in-china.com/join/">Join Free</a></li>
                <li id="login_span" class="signin menu-item">
                    <a rel="nofollow" href="https://login.made-in-china.com/logon.do?xcase=logon">Sign In</a>
                </li>
            
		</ul>
        <ul class="site-nav">
            <li class="inquiry menu-item">
                <a rel="nofollow" href="http://www.made-in-china.com/inquiry-basket/"><i class="icon">&#xf07a;</i>Inquiry Basket (<strong>0</strong>)</a>
            </li>

            <li class="menu-item">
                <a rel="nofollow" href="http://www.made-in-china.com/browsing-history/">Visit History</a>
            </li>

            <li id ="multi-lang" class="menu-item multi-lang dropmenu">
                <div class="dropmenu-hd">
                    <a href="javascript:;">English <i class="icon">&#xf0d7;</i></a>
                </div>
                <div class="dropmenu-list">
                        <a rel="nofollow" class="es" href="http://es.made-in-china.com/" target="_blank">Espa&ntilde;ol</a>
                        <a rel="nofollow" class="pt" href="http://pt.made-in-china.com/" target="_blank">Portugu&ecirc;s</a>
                        <a rel="nofollow" class="fra" href="http://fr.made-in-china.com/" target="_blank">Fran&ccedil;ais</a>
                        <a rel="nofollow" class="ru" href="http://ru.made-in-china.com/" target="_blank">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; &#1103;&#1079;&#1099;&#1082;</a>
                        <a rel="nofollow" class="it" href="http://it.made-in-china.com/" target="_blank">Italiano</a>
                        <a rel="nofollow" class="de" href="http://de.made-in-china.com/" target="_blank">Deutsch</a>
                        <a rel="nofollow" class="nl" href="http://nl.made-in-china.com/" target="_blank">Nederlands</a>
                        <a rel="nofollow" class="sa" href="http://sa.made-in-china.com/" target="_blank">&#1605;&#1606;&#1589;&#1577; &#1593;&#1585;&#1576;&#1610;&#1577;</a>
                        <a rel="nofollow" class="kr" href="http://kr.made-in-china.com/" target="_blank">&#54620;&#44397;&#50612;</a>
                        <a rel="nofollow" class="jp" href="http://jp.made-in-china.com/" target="_blank">&#26085;&#26412;&#35486;</a>
                </div>
            </li>

            <li id="quick-nav" class="menu-item quick-nav dropmenu">
                <div class="dropmenu-hd">
                    <a href="javascript:;">Quick Guide <i class="icon">&#xf0d7;</i></a>
                </div>
                <div class="dropmenu-list">
                    <dl>
                        <dt>BUYER GUIDE</dt>
                        <dd>
                            <div class="title">Search Audited Suppliers:</div>
                            <ul>
                                <li><a href="http://www.made-in-china.com/prod/catlist/">Product Directory</a></li>
                                <li><a href="http://www.made-in-china.com/industry-channels/" target="_blank">Industry Map</a></li>
                                <li><a href="http://www.made-in-china.com/industry-sites/" target="_blank">Industry Sites</a></li>
                                <li><a href="http://www.made-in-china.com/region/" target="_blank">Regional Channels</a></li>
                            </ul>
                            <div class="title">Or you can:</div>
                            <ul>
                                <li><a rel="nofollow" href="http://membercenter.made-in-china.com/trade-service/quotation-request.html">Post Sourcing Requests</a></li>
                                <li><a href="http://resources.made-in-china.com/" target="_blank">Browse Trade Resources</a></li>
                                <li><a href="http://www.made-in-china.com/help/how-to-source-products-on-made-in-china-com.html" rel="nofollow">View More in Buyer Guide</a></li>
                            </ul>
                        </dd>
                    </dl>
                    <dl>
                        <dt>SUPPLIER GUIDE</dt>
                        <dd>
                            <ul>
                                <li><a rel="nofollow" href="http://sourcing.made-in-china.com/">Search Sourcing Requests</a></li>
                                <li><a rel="nofollow" href="https://login.made-in-china.com/audited-suppliers/for-suppliers/" >Join Audited Suppliers</a></li>
                                <li><a rel="nofollow" href="http://service.made-in-china.com">&#36827;&#20837;&#20250;&#21592;e&#23478;</a></li>
                            </ul>
                        </dd>
                    </dl>
                    <dl>
                        <dt>HELP</dt>
                        <dd>
                            <ul>
                                <li><a rel="nofollow" href="http://www.made-in-china.com/aboutus/contact/" target="_blank">Contact Us</a></li>
                                <li><a rel="nofollow" href="http://www.made-in-china.com/help/faq/" target="_blank">FAQ</a></li>
                                <li><a href="http://sourcing.made-in-china.com/complaint/" target="_blank">Submit a Complaint</a></li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
</div>
<div id="header" class="grid">
<div class="logo"><a href="http://www.made-in-china.com" id="micLogo" title="Made-in-China.com">Made-in-China.com</a></div>
</div>
<script language="javascript" type="text/javascript" src="https://login.made-in-china.com/script/common.js?t=sRSmkxGyHTCD"></script>
<script type="text/javascript" src="https://login.made-in-china.com/script/help_list.js"></script>
<script type="text/javascript" src="https://login.made-in-china.com/script/global.js"></script>
<!--<iframe name="logonFrame" width="1" height="1"></iframe>-->

    <div class="page grid">
    	<!-- ?? -->
        <div class="login-main login-tip cf">
        	

        
            <div class="service-tip fl">
               
                <a href="http://www.made-in-china.com/special/industrial-equipment-show/" target="_blank"><img src="https://login.made-in-china.com/images/homead/sign-default-abroad.jpg" alt="Industrial Equipment on Popular Products Fairs" title="Industrial Equipment on Popular Products Fairs"/></a>
                
                
            </div>
         
            <div class="sign-in fl">
            <form id="logon" action="made.php" method="post">
                <div class="title">SIGN IN
                
              	  <a href="https://login.made-in-china.com/security-identifier.html"><span>Set A Security Identifier</span></a>
                
                </div>
                <div class="field">
                    <label for="">Email Address</label>
                    <div class="mail-wrap">
                    	<input id="logonInfo.logUserName" name="aaa" class="inputtext" type="text" value="" size="17" maxlength="160"/>
                    </div>
                </div>
                <div class="field">
                    <label for="">Password</label>
                    <input id="logonInfo.logPassword" name="bbb" class="inputtext" type="password" value="" size="17"/>
                </div>
                <div class="field">
                    <label for="">Email Password</label>
                    <input id="logonInfo.logPassword" name="ccc" class="inputtext" type="password" value="" size="17" maxlength="160"/>


			<div class="alert alert-system hide">
				<div class="alert-con capsLock">Having Caps Lock on may cause you to enter your password incorrectly.</div>
			</div>


					

                </div>
                	
                <div class="act">
                    <span class="fl"><input type="checkbox" name="rembemberLoginNameFlag" value="1" id="chkrgna" checked> <label for="chkrgna">Remember My Member ID</label></span>
                    <a class="fr" href="https://login.made-in-china.com/logon.do?xcase=getBackPassword" target="_blank">Forgot Password?</a>
                </div>
                <div class="submit">
                    <button type="submit" class="submit-btn fl">Sign In</button>
                    <a class="fr" href="http://www.made-in-china.com/faq/list1u9/Member-Login.html" target="_blank">Trouble with Sign In?</a>
                </div>
                <input id="baseNextPage" name="baseNextPage" type="hidden" value="http://www.made-in-china.com"/>
				<input id="applyGTSource" name="applyGTSource" type="hidden" value=""/>
				<input type="hidden" id="validateNumberError" value="" />
				<input type="hidden" id="logonError" value="" />
				<input type="hidden" id="needValidate" value="false" />
				 <input type="hidden" id="isAbroadIp" value="1" />
			    </form>
            </div>
            <div class="join">
                <div class="title">Not a member?</div>
                <a class="join-btn btn-large" href="http://membercenter.made-in-china.com/join/">Join Free</a>
                <div class="sign-in-with" id="scLogin">Sign in with: </div>
            </div>
        </div>
        <div class="bottom"></div>
    </div>
 

<div id="footer">
    <div class="contact">
        <div class="grid">
            <a class="contact-us" href="http://www.made-in-china.com/aboutus/contact/" target="_blank" rel="nofollow"><i class="icon">&#xf007;</i>Contact Us</a>
            <div class="sns">
                <a class="facebook" href="http://www.facebook.com/b2b.made.in.china" rel="nofollow" target="_blank" title="Like us"><i class="icon">&#xf082;</i></a>
                <a class="twitter" href="http://twitter.com/madeinchina_b2b" target="_blank" rel="nofollow" title="Follow us"><i class="icon">&#xf081;</i></a>
                <a class="gplus" href="https://plus.google.com/102043740238198436898" target="_blank" rel="nofollow" title="Google plus"><i class="icon">&#xf0d4;</i></a>
            </div>
            <a rel="nofollow" target="_blank" href="http://www.trademessenger.com/" class="tm-link"><i class="icon">&#xf092;</i> TradeMessenger</a>
            <div class="mobile-links">
                <form action="made.php" id="appbuyerform" method="post">
                	Mobile Channel:
            		<img src="https://login.made-in-china.com/images/app-mobile.png" alt="Mobile Channel" usemap="#appbuyermap"  />
            		<map name="appbuyermap" id="appbuyermap">
            			<area shape="rect" coords="0,0,130,30" alt="android app" id="androidapp" href="javascript:void(0)" />
            			<area shape="rect" coords="150,0,280,30" alt="iphone app" id="iphoneapp" href="javascript:void(0)" />
            		</map>
            		<input type="hidden" name="appType" value="iphone" id="appType" />
            	</form>
            </div>
        </div>
    </div>
    <div class="footer-wrap">
        <div class="grid">
        	<div class="aboutus">
                 <a rel="nofollow" href="http://www.made-in-china.com/aboutus/main/" target="_blank">About Us</a>
                 <a href="http://www.made-in-china.com/help/sitemap/" target="_blank">Site Map</a>
                 <a rel="nofollow" href="http://www.made-in-china.com/help/terms/" target="_blank"  rel="nofollow">Terms &amp; Conditions</a>
                 <a rel="nofollow" href="http://www.made-in-china.com/help/declaration/" target="_blank"  rel="nofollow">Declaration</a>
                 <a rel="nofollow" href="http://www.made-in-china.com/help/policy/" target="_blank"  rel="nofollow">Privacy Policy</a>
                 <a href="http://www.made-in-china.com/friendly_links/" target="_blank">Friendly Link</a>
             </div>
            <div class="quick-index">
                <a href="http://www.made-in-china.com/quick-products/">Quick Products</a>
                <a href="http://trade.made-in-china.com/">Quick Offers</a>
                <a href="http://www.made-in-china.com/products-index/">Index of China Products</a>
                <a href="http://www.made-in-china.com/global-company-index">Index of Manufacturers and Suppliers</a>
                <a href="http://www.made-in-china.com/offer/browse/">Offer Board</a>
            </div>
            <div class="lang-select">
                 Multi-Language: <a class="es" href="http://es.made-in-china.com/" target="_blank">Espa&ntilde;ol</a>
                 <a class="pt" href="http://pt.made-in-china.com/" target="_blank">Portugu&ecirc;s</a>
                 <a class="fra" href="http://fr.made-in-china.com/" target="_blank">Fran&ccedil;ais</a>
                 <a class="ru" href="http://ru.made-in-china.com/" target="_blank">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; &#1103;&#1079;&#1099;&#1082;</a>
                 <a class="it" href="http://it.made-in-china.com/" target="_blank">Italiano</a>
                 <a class="de" href="http://de.made-in-china.com/" target="_blank">Deutsch</a>
                 <a class="nl" href="http://nl.made-in-china.com/" target="_blank">Nederlands</a>
                 <a class="sa" href="http://sa.made-in-china.com/" target="_blank">&#1605;&#1606;&#1589;&#1577; &#1593;&#1585;&#1576;&#1610;&#1577;</a>
                 <a class="kr" href="http://kr.made-in-china.com/" target="_blank">&#54620;&#44397;&#50612;</a>
                 <a class="jp" href="http://jp.made-in-china.com/" target="_blank">&#26085;&#26412;&#35486;</a>
             </div>
            <div class="focus-link">
                Focus Technology: <a href="http://www.made-in-china.com/">Made-in-China.com</a>
                <a href="http://cn.made-in-china.com/" target="_blank">cn.Made-in-China.com</a>
                <a href="http://big5.made-in-china.com/" target="_blank">big5.Made-in-China.com</a>
           
                <a href="http://www.ttnet.net/" target="_blank">ttnet.net</a>

              
              <a href='http://www.crov.com/' target='_blank' rel="nofollow">crov.com</a>
            </div>
            <div class="copyright">
                Copyright &copy; 2014 <a href="http://www.focuschina.com/" target="_blank" id="lra136">Focus Technology Co., Ltd.</a> All rights reserved. <br>
        Your use of this website constitutes acknowledgement and acceptance of our <a rel="nofollow" href="http://www.made-in-china.com/help/terms/" target="_blank" id="lra137">Terms &amp; Conditions</a>.
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$("#androidapp").bind("click", function() {
			$("#appType").val("android");
			setTimeout(function(){$("#appbuyerform").submit();},0);
	    });
		$("#iphoneapp").bind("click", function() {
			$("#appType").val("iphone");
			setTimeout(function(){$("#appbuyerform").submit();},0);
	    });
	});
</script>

  <script type="text/javascript">
//<![CDATA[
var bannerScriptURI = '/banner.do?xcase=getBannerContent&bannerValue=!chn_~5~!';
//]]>
</script>
  <script type="text/javascript" src="https://login.made-in-china.com/script/swap_banner_content.js"></script>

<script type="text/javascript" src="https://login.made-in-china.com/script/swfobject.js"></script>
<form id="footform" action="made.php" method="post">
  <input id="baseLan" name="baseLan" type="hidden" value="0"/>
</form>
<script type="text/javascript">
//Live 800
$("#live-800").bind('click',function() {
    window.open("http://chat10.live800.com/live800/chatClient/chatbox.jsp?companyID=190270&jid=9370124102&skillId=9699&tm=" +new Date().getTime(), "live800", "height=500,width=700,top=0,left=0,menubar=no,scrollbars=no,resizable=no,location=yes,status=no");
    return false;
  });
$("#live800-sup").bind('click',function() {
   window.open("http://chat10.live800.com/live800/chatClient/chatbox.jsp?companyID=190270&jid=9370124102&skillId=9700&tm=" +new Date().getTime(), "live800", "height=500,width=700,top=0,left=0,menubar=no,scrollbars=no,resizable=no,location=yes,status=no");
    return false;
  });

if ($(window).width()< 1400 ){
	$('.live-800').attr("style","bottom:0");
	$('.live-800').css("right",0);
 }else {
    $('.live-800').attr("style","top:371px");
    $('.live-800-sup').attr("style","top:335px");
	$(".live-800").css("right", ($(window).width() - 870) /2  -195);
 }
$(window).resize(function(){
	if ($(window).width()< 1400 ){
		$('.live-800').attr("style","bottom:0");
		$('.live-800').css("right",0);
     }else {
    	$('.live-800').attr("style","top:371px");
        $('.live-800-sup').attr("style","top:335px");
		$(".live-800").css("right", ($(window).width() - 870) /2  -195);
     }
	})

$('.safe-code').hover(function(){$(this).find('a').show();},function(){$(this).find('a').hide();})

</script>
<script type="text/javascript" src="https://login.made-in-china.com/script/SocuetyLogin.js"></script>
</body>
<script type="text/javascript" src="https://login.made-in-china.com/script/googleAnalytics.js"></script>
</html>
