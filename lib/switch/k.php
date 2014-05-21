<?php
//ini_set('display_errors',1);
$__template = "xml";

if(!isset($_GET['i'])) {
	die('"i" not defined on the querystring');
} else {
	$i = $_GET['i'];
}

//find all the changes that need to be written
$sql = "CALL getCurrentSettings('$i');";
error_log($sql);

// Perform Query
$settings = $wpdb->get_results($sql,ARRAY_A);
//error_log(print_r($settings,true));

// Use result
//write the files
foreach ($settings as $row) {
	//print_r($row);
	extract($row);
	$showStatusBarOut = formatBoolean($showStatusBar);
	$showAddressBarOut = formatBoolean($showAddressBar);
	$showNavigationBarOut = formatBoolean($showNavigationBar);
	$zoomDisabledOut = formatBoolean($zoomDisabled);
	$printEnabledOut = formatBoolean($printEnabled);
	$showLoadingProgressOut = formatBoolean($showLoadingProgress);
	$viewOnlyOut = formatBoolean($viewOnly);
	$showSiteMessageOut = formatBoolean($showSiteMessage);
	$emailOnPowerOut = formatBoolean($emailOnPower);
	$smtpRequiresAuthOut = formatBoolean($smtpRequiresAuth);
	$smtpEnableSSLOut = formatBoolean($smtpEnableSSL);
	$remoteSettingsEnabledOut = formatBoolean($remoteSettingsEnabled);
	$customLinksEnabledOut = formatBoolean($customLinksEnabled);
	$textSelectionOut = formatBoolean($textSelection);
	$disableWebViewBouncingOut = formatBoolean($disableWebViewBouncing);
	$pdfShowThumbsOut = formatBoolean($pdfShowThumbs);
	$pdfShowPageNumbersOut = formatBoolean($pdfShowPageNumbers);
	$showConnectionProblemPageOut = formatBoolean($showConnectionProblemPage);
	$clearCacheOut = formatBoolean($clearCache);
	$clearCookiesOut = formatBoolean($clearCookies);
	$showPrintIconOut = formatBoolean($showPrintIcon);
	$emailOnRemoteSettingsChangeOut = formatBoolean($emailOnRemoteSettingsChange);
	$pdfDisableZoom = formatBoolean($pdfDisableZoom);
	$_kp_disableTelLinks_ = formatBoolean($_kp_disableTelLinks_);
	$_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_ = formatBoolean($_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_);
	
	
	$dictSettingsShowingOption = formatDict('settingsShowingOption',$settingsShowingOption,'integer','<!--Show Settings In-App: 0 = On App Launch, 1 = Never, 2 = On Touch Gesture and Passcode (added in version 2.3)-->');
	$dictSettingsPassCode = formatDict('settingsPassCode',$settingsPassCode,'string','<!--Passcode (added in version 2.3)-->');
	$dictUniqueiPadID = formatDict('uniqueiPadID',$uniqueiPadID,'string','<!--Unique iPad ID-->');
	$dictHomePage = formatDict('homePage',$homePage,'string','<!--Home Page-->');
	$dictShowStatusBar = formatDict('showStatusBar',$showStatusBarOut,'boolean','<!--Show Top iPad Information Bar-->');
	$dictShowAddressBar = formatDict('showAddressBar',$showAddressBarOut,'boolean','<!--Show Address Bar-->');
	$dictShowNavigationBar = formatDict('showNavigationBar',$showNavigationBarOut,'boolean','<!--Show Bottom Navigation Bar-->');
	$dictShowLoadingProgress = formatDict('showLoadingProgress',$showLoadingProgressOut,'boolean','<!--Show Progress Indicator-->');
	$dictTextSelection = formatDict('textSelection',$textSelectionOut,'boolean','<!--Text Selection for Accessibility (added in version 2.5)-->');
	$dictDisableWebViewBouncing = formatDict('disableWebViewBouncing',$disableWebViewBouncingOut,'boolean','<!-- Fix Window to Viewport (new! added in version 3.1) -->');
	$dictZoomDisabled = formatDict('zoomDisabled',$zoomDisabledOut,'boolean','<!--Disable Zoom-->');
	$dictViewOnly = formatDict('viewOnly',$viewOnlyOut,'boolean','<!--Disable Touch Gestures-->');
	$dictPageReloadBackgroundColor = formatDict('pageReloadBackgroundColor',$pageReloadBackgroundColor,'string','<!--Page Loading Background Color (added in version 2.1)-->');
	$dictWhiteList = formatDict('whiteList',$whiteList,'string','<!--Allowed Domains-->');
	$dictBlackList = formatDict('blackList',$blackList,'string','<!--Restricted Domains (added in version 2.4)-->');
	$dictShowSiteMessage = formatDict('showSiteMessage',$showSiteMessageOut,'boolean','<!--Show Off-Domain Alert-->');
	$dictOffDomainMessage = formatDict('offDomainMessage',$offDomainMessage,'string','<!--Off-Domain Alert Text-->');
	$dictaccessJS_API = formatDict('accessJS_API',$accessJS_API,'integer','<!--Access JavaScript API: 0 = By Injection, 1 = By Import, 2 = Never -->');
	$dictIdleTime = formatDict('idleTime',$idleTime,'integer','<!--Idle Time Limit (seconds)-->');
	$dictRefreshTime = formatDict('refreshTime',$refreshTime,'string','<!--Refresh Homepage Every (minutes)-->');
	$dictPageLoadTime = formatDict('pageLoadTime',$pageLoadTime,'string','<!--Page Loading Time Limit (seconds) (added in version 2.5)-->');
	$dictBrowseTime = formatDict('browseTime',$browseTime,'integer','<!--Browsing Time Limit: -1 = Forever, 5 = 5 min, 10 = 10 min, etc.-->');
	$dictGoodByePage = formatDict('goodByPage',$goodByePage,'string','<!--Good-Bye Page-->');
	$dictnavBarIconsColorScheme = formatDict('navBarIconsColorScheme',$navBarIconsColorScheme,'string','<!--Standard Icon Color (0= Red, 1 = Yellow, 2 = Green, 3 = Blue, 4 = Light Gray, 5 = Dark Gray, 6 = Black, 7 = White)-->');
	$dictnavBarBackgroundColor = formatDict('navBarBackgroundColor',$navBarBackgroundColor,'string','<!--Standard Bar Background (must be in RGB format)-->');
	$dictCustomLinksEnabled = formatDict('customLinksEnabled',$customLinksEnabledOut,'boolean','<!--Enable Custom Links-->');
	$dictCLBackgroundColor = formatDict('clBackgroundColor',$clBackgroundColor,'string','<!--RGB Background Color-->');
	$dictCLButtonBackgroundColor = formatDict('clButtonBackgroundColor',$clButtonBackgroundColor,'string','<!--RGB Button Background Color-->');
	$dictCLLabel1 = formatDict('clLabel1',$clLabel1,'string','<!--Label 1-->');
	$dictCLLink1 = formatDict('clLink1',$clLink1,'string','<!--Link 1-->');
	$dictCLLabel2 = formatDict('clLabel2',$clLabel2,'string','<!--Label 2-->');
	$dictCLLink2 = formatDict('clLink2',$clLink2,'string','<!--Link 2-->');
	$dictCLLabel3 = formatDict('clLabel3',$clLabel3,'string','<!--Label 3-->');
	$dictCLLink3 = formatDict('clLink3',$clLink3,'string','<!--Link 3-->');
	$dictCLLabel4 = formatDict('clLabel4',$clLabel4,'string','<!--Label 4-->');
	$dictCLLink4 = formatDict('clLink4',$clLink4,'string','<!--Link 4-->');
	$dictCLLabel5 = formatDict('clLabel5',$clLabel5,'string','<!--Label 5-->');
	$dictCLLink5 = formatDict('clLink5',$clLink5,'string','<!--Link 5-->');
	$dictCLLabel6 = formatDict('clLabel6',$clLabel6,'string','<!--Label 6-->');
	$dictCLLink6 = formatDict('clLink6',$clLink6,'string','<!--Link 6-->');
	$dictPDFShowThumbs = formatDict('pdfShowThumbs',$pdfShowThumbsOut,'boolean','<!--Show Thumbnails-->');
	$dictPDFShowPageNumbers = formatDict('pdfShowPageNumbers',$pdfShowPageNumbersOut,'boolean','<!--Show Page Numbers-->');
	$dictPDFDisableZoom = formatDict('pdfDisableZoom',$pdfDisableZoom,'boolean','<!--Disable Zoom for PDFs-->');
	$dictPDFScrollingType = formatDict('pdfScrollingType',$pdfScrollingType,'integer','<!--PDF Display Style: 0 = Scroll, 1 = Page Turn, 2 = Hyperlink Only (updated in version 3.1)-->');
	$dictPDFInfiniteScrollOrientation = formatDict('pdfInfiniteScrollOrientation',$pdfInfiniteScrollOrientation,'integer','<!--Scroll Orientation: 0 = Horizontal, 1 = Vertical -->');
	$dictPDFBackgroundImageFile = formatDict('pdfBackgroundImageFile',$pdfBackgroundImageFile,'string','<!--Background Image-->');
	$dictShowConnectionProblemPage = formatDict('showConnectionProblemPage',$showConnectionProblemPageOut,'boolean','<!--Detect Connection Errors-->');
	$dictCustomConnectionProblemPage = formatDict('customConnectionProblemPage',$customConnectionProblemPage,'string','<!--Custom Connection Problem Page-->');
	$dictClearCache = formatDict('clearCache',$clearCacheOut,'boolean','<!--Clear Cache-->');
	$dictCookieAcceptPolicy = formatDict('cookieAcceptPolicy',$cookieAcceptPolicy,'integer','<!--Accept Cookies: 0 = Never, 1 = From Visited, 2 = Always (added in version 2.5)-->');
	$dictClearCookies = formatDict('clearCookies',$clearCookiesOut,'boolean','<!--Clear Cookies-->');
	$dictPrintEnabled = formatDict('printEnabled',$printEnabledOut,'boolean','<!--AirPrint-->');
	$dictShowPrintIcon = formatDict('showPrintIcon',$showPrintIconOut,'boolean','<!--Show AirPrint Icon (added in version 1.4)-->');
	$dictRemoteSettingsEnabled = formatDict('remoteSettingsEnabled',$remoteSettingsEnabledOut,'boolean','<!--Enable Remote Settings-->');
	$dictExternalSettingsFile = formatDict('externalSettingsFile',$externalSettingsFile,'string','<!--Remote Settings XML File Location-->');
	$dictLocalSettingsUpdatePeriod = formatDict('localSettingsUpdatePeriod',$localSettingsUpdatePeriod,'string','<!--Update Period (minutes)-->');
	$dictSMTPFromEmail = formatDict('smtpFromEmail',$smtpFromEmail,'string','<!--From E-mail-->');
	$dictSMTPToEmail = formatDict('smtpToEmail',$smtpToEmail,'string','<!--To E-mail-->');
	$dictSMTPServer = formatDict('smtpServer',$smtpServer,'string','<!--SMTP Server-->');
	$dictSMTPPorts = formatDict('smtpPorts',$smtpPorts,'string','<!--SMTP Ports (added in version 3.0)-->');
	$dictSMTPRequiresAuth = formatDict('smtpRequiresAuth',$smtpRequiresAuthOut,'boolean','<!--Requires Authorization-->');
	$dictSMTPUserName = formatDict('smtpUserName',$smtpUserName,'string','<!--User Name-->');
	$dictSMTPPassword = formatDict('smtpPassword',$smtpPassword,'string','<!--Password-->');
	$dictSMTPEnableSSL = formatDict('smtpEnableSSL',$smtpEnableSSLOut,'boolean','<!--Enable SSL-->');
	$dictEmailOnPower = formatDict('emailOnPower',$emailOnPowerOut,'boolean','<!--Email on Power Supply Change-->');
	$dictEmailOnRemoteSettingsChange = formatDict('emailOnRemoteSettingsChange',$emailOnRemoteSettingsChangeOut,'boolean','<!--Email on Remote Settings Change-->');
	$dictManualControlOfBrightness = formatDict('manualControlOfBrightness',$manualControlOfBrightness,'real','<!--Screen Brightness: maximum screen brightness = 1, minimum = 0; setting must be between 1 and 0; otherwise, if you do not wish to control screen brightness from remote settings, entire setting <dict> to </dict> must be deleted from the file (added in version 2.5)-->');
	$dict_kp_disableTelLinks_ = formatDict('_kp_disableTelLinks_',$_kp_disableTelLinks_,'boolean','<!--Special (no UI) setting to ON/OFF - disabling tel links in HTML-page. Default value: true - allow disabling.-->');
	$dict_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_ = formatDict('_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_',$_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_,'boolean','<!-- Special (no UI) setting to ON/OFF - disabling the default callout shown when you touch target in HTML-page. Default value: true - allow disabling.-->');
	
	$ret = <<<EOT
<plist version="1.0">
    <dict>
        <key>kioskSettings</key>
        <array>
            
            
            <!--Compatible with Kiosk Pro, updated March 20, 2014, more information available at http://www.kioskproapp.com -->
            
            <!--Settings Menu-->
            
            $dictSettingsShowingOption
            $dictSettingsPassCode
            
            
            <!--General-->
            
            $dictUniqueiPadID
            $dictHomePage
            
            
            <!--Display-->
            
            $dictShowStatusBar
            $dictShowAddressBar
            $dictShowNavigationBar
            $dictShowLoadingProgress
            $dictTextSelection 
            $dictDisableWebViewBouncing
            $dictZoomDisabled
            $dictViewOnly
            $dictPageReloadBackgroundColor
            
            
            <!--Navigation-->
            
            $dictWhiteList
            $dictBlackList
            $dictShowSiteMessage
            $dictOffDomainMessage
            
            
            <!--API Acces-->
            $dictaccessJS_API
            
            <!--Timer Settings-->
            
            $dictIdleTime
            $dictRefreshTime
            $dictPageLoadTime
            
            
            <!--Visitor Management-->
            
            $dictBrowseTime
            $dictGoodByePage
            
            
            <!--Custom Navigation Links-->
            
            $dictnavBarIconsColorScheme
            $dictnavBarBackgroundColor
            $dictCustomLinksEnabled
            $dictCLButtonBackgroundColor
            $dictCLLabel1
            $dictCLLink1
            $dictCLLabel2
            $dictCLLink2
            $dictCLLabel3
            $dictCLLink3
            $dictCLLabel4
            $dictCLLink4
            $dictCLLabel5
            $dictCLLink5
            $dictCLLabel6
            $dictCLLink6
            
            
            <!-- PDF Display (all added in version 2.2)-->
            
            $dictPDFShowThumbs
            $dictPDFShowPageNumbers
            $dictPDFDisableZoom
            $dictPDFScrollingType
            $dictPDFInfiniteScrollOrientation
            $dictPDFBackgroundImageFile
            
            
            <!--Internet Access (all added in version 2.3)-->
            
            $dictShowConnectionProblemPage
            $dictCustomConnectionProblemPage
            
            
            <!--Memory Settings-->
            
            $dictClearCache
            $dictCookieAcceptPolicy
            $dictClearCookies
            
            
            <!--Printing-->
            
            $dictPrintEnabled
            $dictShowPrintIcon
            
            
            <!--Remote Settings Control-->
            
            $dictRemoteSettingsEnabled
            $dictExternalSettingsFile
            $dictLocalSettingsUpdatePeriod
            
            
            <!--Email Notifications-->
            
            $dictSMTPFromEmail
            $dictSMTPToEmail
            $dictSMTPServer
            $dictSMTPPorts
            $dictSMTPRequiresAuth
            $dictSMTPUserName
            $dictSMTPPassword
            $dictSMTPEnableSSL
            $dictEmailOnPower
            $dictEmailOnRemoteSettingsChange
            
            
            <!--Volume: cannot be controlled currently by xml due to restrictions by Apple-->
            
            $dictManualControlOfBrightness
            
            <!--Settings Not Included In Menu-->
            
            $dict_kp_disableTelLinks_
            $dict_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_
            
        </array>
    </dict>
</plist>	
EOT;
	echo($ret);
}


function formatBoolean($setting) {
	if($setting){
		return("<true/>");
	} else {
		return("<false/>");
	}	
}

function formatDict($setting, $value, $type, $comment) {
	$type = strtolower($type);
	if((strlen($value)>0) AND (in_array($type,array('string','integer','real','boolean')))) {
		$ret = <<<EOT
		$comment
		<dict>
			<key>Key</key><string>$setting</string>
			<key>Value</key>
EOT;
		if($type == 'boolean') {
			$ret .=  $value;	
		} else {
			$ret .= "<$type>$value</$type>";
		}
		$ret .= <<<EOT
		
		</dict>			
EOT;
	} else {
		$ret = '';	
	}
	return($ret);
}