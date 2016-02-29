<?php

$CookieCompliance = $Sitewide['Cookies']['Prefix'].'_cookie_compliance';

if (
	(
		!empty($Sitewide['Settings']['Cookies Compliance']['Worldwide']) ||
		(
			!$Sitewide['Geo']['Continent'] ||
			$Sitewide['Geo']['Continent'] == 'EU'
		)
	) &&
	!isset($_COOKIE[$CookieCompliance])
) {
	echo <<<'SCRIPT1'
<script>
var BodyTag = document.getElementsByTagName('body')[0];
var CookieComplianceBanner = document.createElement('div');
CookieComplianceBanner.setAttribute('id', 'cookie-compliance-banner');
CookieComplianceBanner.innerHTML = '<p>We use cookies on this site. <a class="close-cookie-banner" href="javascript:void(0);" onclick="removeMe();"><span>X</span></a></p>';
BodyTag.insertBefore(CookieComplianceBanner, BodyTag.firstChild);
document.getElementsByTagName('body')[0].className+=' has-cookie-compliance-banner';
function removeMe() {
SCRIPT1;
	echo '
	document.cookie = "'.$CookieCompliance.' = accepted; expires = Tues, 19 Jan 2038 03:14:07 UTC; path = /;";';
	echo <<<'SCRIPT2'
	var element = document.getElementById('cookie-compliance');
	element.parentNode.removeChild(element);
}
</script>
SCRIPT2;

} else if (
	isset($_COOKIE[$CookieCompliance])
) {
	setcookie($CookieCompliance, 'accepted', 2147483647, '/', $Sitewide['Request']['Host'], $Sitewide['Request']['Secure'], $Sitewide['Cookies']['HTTPOnly']);

} else if (
	!empty($Sitewide['Settings']['Cookies Compliance']['Auto Accept'])
) {
	setcookie($CookieCompliance, 'auto-accepted', 2147483647, '/', $Sitewide['Request']['Host'], $Sitewide['Request']['Secure'], $Sitewide['Cookies']['HTTPOnly']);
}
