<?php
$role = checkUser($_COOKIE['username']);	
if(!is_numeric(strpos($role,'p'))){
	header("location: kioskcontroller");
}
if(isset($_POST['submitButton'])) {
	switch($_POST['submitButton']) {
		case 'Save':
			$data = array(
				'homePage' => $_POST['homePage'],
				'description' => $_POST['description'],
				'whiteList' => $_POST['whiteList'],
				'idleTime' => $_POST['idleTime'],
				'refreshTime' => $_POST['refreshTime'],
				'browseTime' => $_POST['browseTime'],
				'goodByePage' => $_POST['goodByePage'],
				'offDomainMessage' => $_POST['offDomainMessage'],
				'navBarIconsColorScheme' => $_POST['navBarIconsColorScheme'],
				'navBarBackgroundColor' => $_POST['navBarBackgroundColor'],
				'clBackgroundColor' => $_POST['clBackgroundColor'],
				'clButtonBackgroundColor' => $_POST['clBackButtongroundColor'],
				'clLabel1' => $_POST['clLabel1'],
				'clLink1' => $_POST['clLink1'],
				'clLabel2' => $_POST['clLabel2'],
				'clLink2' => $_POST['clLink2'],
				'clLabel3' => $_POST['clLabel3'],
				'clLink3' => $_POST['clLink3'],
				'clLabel4' => $_POST['clLabel4'],
				'clLink4' => $_POST['clLink4'],
				'clLabel5' => $_POST['clLabel5'],
				'clLink5' => $_POST['clLink5'],
				'clLabel6' => $_POST['clLabel6'],
				'clLink6' => $_POST['clLink6'],
				'pageReloadBackgroundColor' => $_POST['pageReloadBackgroundColor'],
				'blackList' => $_POST['blackList'],
				'pageLoadTime' => $_POST['pageLoadTime'],
				'pdfScrollingType' => $_POST['pdfScrollingType'],
				'pdfInfiniteScrollOrientation' => $_POST['pdfInfiniteScrollOrientation'],
				'pdfBackgroundImageFile' => $_POST['pdfBackgroundImageFile'],
				'cookieAcceptPolicy' => $_POST['cookieAcceptPolicy'],
				'manualControlOfBrightness' => $_POST['manualControlOfBrightness'],
				'accessJS_API' => $_POST['accessJS_API']
			);
			
			if($_POST['showStatusBar'] == 'on') {
				$data['showStatusBar'] = 1;
			} else {
				$data['showStatusBar'] = 0;
			}
			if($_POST['showAddressBar'] == 'on') {
				$data['showAddressBar'] = 1;
			} else {
				$data['showAddressBar'] = 0;
			}
			if($_POST['showNavigationBar'] == 'on') {
				$data['showNavigationBar'] = 1;
			} else {
				$data['showNavigationBar'] = 0;
			}
			if($_POST['zoomDisabled'] == 'on') {
				$data['zoomDisabled'] = 1;
			} else {
				$data['zoomDisabled'] = 0;
			}
			if($_POST['printEnabled'] == 'on') {
				$data['printEnabled'] = 1;
			} else {
				$data['printEnabled'] = 0;
			}
			if($_POST['showLoadingProgress'] == 'on') {
				$data['showLoadingProgress'] = 1;
			} else {
				$data['showLoadingProgress'] = 0;
			}
			if($_POST['viewOnly'] == 'on') {
				$data['viewOnly'] = 1;
			} else {
				$data['viewOnly'] = 0;
			}
			if($_POST['showSiteMessage'] == 'on') {
				$data['showSiteMessage'] = 1;
			} else {
				$data['showSiteMessage'] = 0;
			}
			if($_POST['customLinksEnabled'] == 'on') {
				$data['customLinksEnabled'] = 1;
			} else {
				$data['customLinksEnabled'] = 0;
			}
			if($_POST['textSelection'] == 'on') {
				$data['textSelection'] = 1;
			} else {
				$data['textSelection'] = 0;
			}
			if($_POST['disableWebViewBouncing'] == 'on') {
				$data['disableWebViewBouncing'] = 1;
			} else {
				$data['disableWebViewBouncing'] = 0;
			}
			if($_POST['pdfShowThumbs'] == 'on') {
				$data['pdfShowThumbs'] = 1;
			} else {
				$data['pdfShowThumbs'] = 0;
			}
			if($_POST['pdfShowPageNumbers'] == 'on') {
				$data['pdfShowPageNumbers'] = 1;
			} else {
				$data['pdfShowPageNumbers'] = 0;
			}
			if($_POST['pdfDisableZoom'] == 'on') {
				$data['pdfDisableZoom'] = 1;
			} else {
				$data['pdfDisableZoom'] = 0;
			}
			if($_POST['clearCache'] == 'on') {
				$data['clearCache'] = 1;
			} else {
				$data['clearCache'] = 0;
			}
			if($_POST['clearCookies'] == 'on') {
				$data['clearCookies'] = 1;
			} else {
				$data['clearCookies'] = 0;
			}
			if($_POST['showPrintIcon'] == 'on') {
				$data['showPrintIcon'] = 1;
			} else {
				$data['showPrintIcon'] = 0;
			}
			$data['modifiedBy'] = $_COOKIE['username'];
			$data['dateModified'] = date( 'Y-m-d H:i:s', time() );
			
			$wpdb->insert('application',$data);
			break;
		case 'Update':
			$ID = $_POST['ID'];
						$data = array(
				'homePage' => $_POST['homePage'],
				'description' => $_POST['description'],
				'whiteList' => $_POST['whiteList'],
				'idleTime' => $_POST['idleTime'],
				'refreshTime' => $_POST['refreshTime'],
				'browseTime' => $_POST['browseTime'],
				'goodByePage' => $_POST['goodByePage'],
				'offDomainMessage' => $_POST['offDomainMessage'],
				'navBarIconsColorScheme' => $_POST['navBarIconsColorScheme'],
				'navBarBackgroundColor' => $_POST['navBarBackgroundColor'],
				'clBackgroundColor' => $_POST['clBackgroundColor'],
				'clButtonBackgroundColor' => $_POST['clBackButtongroundColor'],
				'clLabel1' => $_POST['clLabel1'],
				'clLink1' => $_POST['clLink1'],
				'clLabel2' => $_POST['clLabel2'],
				'clLink2' => $_POST['clLink2'],
				'clLabel3' => $_POST['clLabel3'],
				'clLink3' => $_POST['clLink3'],
				'clLabel4' => $_POST['clLabel4'],
				'clLink4' => $_POST['clLink4'],
				'clLabel5' => $_POST['clLabel5'],
				'clLink5' => $_POST['clLink5'],
				'clLabel6' => $_POST['clLabel6'],
				'clLink6' => $_POST['clLink6'],
				'pageReloadBackgroundColor' => $_POST['pageReloadBackgroundColor'],
				'blackList' => $_POST['blackList'],
				'pageLoadTime' => $_POST['pageLoadTime'],
				'pdfScrollingType' => $_POST['pdfScrollingType'],
				'pdfInfiniteScrollOrientation' => $_POST['pdfInfiniteScrollOrientation'],
				'pdfBackgroundImageFile' => $_POST['pdfBackgroundImageFile'],
				'cookieAcceptPolicy' => $_POST['cookieAcceptPolicy'],
				'manualControlOfBrightness' => $_POST['manualControlOfBrightness'],
				'accessJS_API' => $_POST['accessJS_API']	
			);
			if($_POST['showStatusBar'] == 'on') {
				$data['showStatusBar'] = 1;
			} else {
				$data['showStatusBar'] = 0;
			}
			if($_POST['showAddressBar'] == 'on') {
				$data['showAddressBar'] = 1;
			} else {
				$data['showAddressBar'] = 0;
			}
			if($_POST['showNavigationBar'] == 'on') {
				$data['showNavigationBar'] = 1;
			} else {
				$data['showNavigationBar'] = 0;
			}
			if($_POST['zoomDisabled'] == 'on') {
				$data['zoomDisabled'] = 1;
			} else {
				$data['zoomDisabled'] = 0;
			}
			if($_POST['printEnabled'] == 'on') {
				$data['printEnabled'] = 1;
			} else {
				$data['printEnabled'] = 0;
			}
			if($_POST['showLoadingProgress'] == 'on') {
				$data['showLoadingProgress'] = 1;
			} else {
				$data['showLoadingProgress'] = 0;
			}
			if($_POST['viewOnly'] == 'on') {
				$data['viewOnly'] = 1;
			} else {
				$data['viewOnly'] = 0;
			}
			if($_POST['showSiteMessage'] == 'on') {
				$data['showSiteMessage'] = 1;
			} else {
				$data['showSiteMessage'] = 0;
			}
			if($_POST['customLinksEnabled'] == 'on') {
				$data['customLinksEnabled'] = 1;
			} else {
				$data['customLinksEnabled'] = 0;
			}
			if($_POST['textSelection'] == 'on') {
				$data['textSelection'] = 1;
			} else {
				$data['textSelection'] = 0;
			}
			if($_POST['disableWebViewBouncing'] == 'on') {
				$data['disableWebViewBouncing'] = 1;
			} else {
				$data['disableWebViewBouncing'] = 0;
			}
			if($_POST['pdfShowThumbs'] == 'on') {
				$data['pdfShowThumbs'] = 1;
			} else {
				$data['pdfShowThumbs'] = 0;
			}
			if($_POST['pdfShowPageNumbers'] == 'on') {
				$data['pdfShowPageNumbers'] = 1;
			} else {
				$data['pdfShowPageNumbers'] = 0;
			}
			if($_POST['pdfDisableZoom'] == 'on') {
				$data['pdfDisableZoom'] = 1;
			} else {
				$data['pdfDisableZoom'] = 0;
			}
			if($_POST['clearCache'] == 'on') {
				$data['clearCache'] = 1;
			} else {
				$data['clearCache'] = 0;
			}
			if($_POST['clearCookies'] == 'on') {
				$data['clearCookies'] = 1;
			} else {
				$data['clearCookies'] = 0;
			}
			if($_POST['showPrintIcon'] == 'on') {
				$data['showPrintIcon'] = 1;
			} else {
				$data['showPrintIcon'] = 0;
			}
			$data['modifiedBy'] = $_COOKIE['username'];
			$data['dateModified'] = date( 'Y-m-d H:i:s', time() );
				
			$wpdb->update('application',$data,array(
				'application_id' => $ID
				));	
			break;
		case 'Delete':
			$ID = $_POST['ID'];
			
			$wpdb->query("DELETE FROM application WHERE application_id = $ID;");
		
			break;	
	}
}


$sql = "SELECT *
FROM application";

$apps = $wpdb->get_results($sql,ARRAY_A);

foreach($apps as $app) {
	extract($app);
	$img = "data:".$mime.";base64," . base64_encode($thumb);
	$appsOut .= <<<EOT
<tr>
	<td><img height="150" src="$img"></td>
	<td>$homePage</td>
	<td>$description</td>
	<td>$dateCreated</td>
	<td>$dateModified</td>
	<td>$modifiedBy</td>
	<td><a class="copyLink" dbID="$application_id" style="cursor:pointer">Copy</a> <a class="editLink" dbID="$application_id" style="cursor:pointer">Edit</a> <a class="deleteLink" dbID="$application_id" style="cursor:pointer">Delete</a></td>
</tr>	
EOT;
	
}



?>

<h2>Add New Application</h2>
<form action="kioskcontroller?page=applications" method="post">
  <fieldset class="form-group">
    <legend>General</legend>
    <label for="homePage" class="control-label col-xs-4">Home Page</label>
    <div class="col-xs-8">
      <input name="homePage" id="homePage" type="text" />
    </div>
    <label for="description" class="control-label col-xs-4">Description</label>
    <div class="col-xs-8">
      <input name="description" id="description" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Display</legend>
    <label for="showStatusBar" class="control-label col-xs-4">Show Top iPad Information Bar</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showStatusBar" id="showStatusBar" />
    </div>
    <label for="showAddressBar" class="control-label col-xs-4">Show Address Bar</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showAddressBar" id="showAddressBar" />
    </div>
    <label for="showNavigationBar" class="control-label col-xs-4">Show Bottom Navigation Bar</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showNavigationBar" id="showNavigationBar" />
    </div>
    <label for="printEnabled" class="control-label col-xs-4">Printing</label>
    <div class="col-xs-8">
      <input type="checkbox" name="printEnabled" id="printEnabled" />
    </div>
    <label for="showLoadingProgress" class="control-label col-xs-4">Show Loading Progress</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showLoadingProgress" id="showLoadingProgress" />
    </div>
    <label for="textSelection" class="control-label col-xs-4">Text Selection for Accessibility</label>
    <div class="col-xs-8">
      <input type="checkbox" name="textSelection" id="textSelection" />
    </div>
    <label for="disableWebViewBouncing" class="control-label col-xs-4">Pin Window to Viewport</label>
    <div class="col-xs-8">
      <input type="checkbox" name="disableWebViewBouncing" id="disableWebViewBouncing" />
    </div>
    <label for="zoomDisabled" class="control-label col-xs-4">Disable Zooming</label>
    <div class="col-xs-8">
      <input	type="checkbox" name="zoomDisabled" id="zoomDisabled" />
    </div>
    <label for="viewOnly" class="control-label col-xs-4">Disable Touches</label>
    <div class="col-xs-8">
      <input name="viewOnly" id="viewOnly" type="checkbox" />
    </div>
    <label for="pageReloadBackgroundColor" class="control-label col-xs-4">Page Loading Background Color</label>
    <div class="col-xs-8">
      <input name="pageReloadBackgroundColor" id="pageReloadBackgroundColor" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Navigation</legend>
    <label for="whiteList" class="control-label col-xs-4">Allowed Domains (use ; as separator)</label>
    <div class="col-xs-8">
      <input name="whiteList" id="whiteList" type="text" />
    </div>
    <label for="blackList" class="control-label col-xs-4">Restricted Domains (use ; as separator)</label>
    <div class="col-xs-8">
      <input name="blackList" id="blackList" type="text" />
    </div>
    <label for="showSiteMessage" class="control-label col-xs-4">Show Off-Domain Dialog</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showSiteMessage" id="showSiteMessage" />
    </div>
    <label for="offDomainMessage" class="control-label col-xs-4">Off-Domain Dialog Text</label>
    <div class="col-xs-8">
      <input type="text" name="offDomainMessage" id="offDomainMessage" />
    </div>
  </fieldset>
  <fieldset>
    <legend>Bottom Bar Links</legend>
    <label for="navBarIconsColorScheme" class="control-label col-xs-4">Navigation Bar Icons Color Scheme</label>
    <div class="col-xs-8">
      <select name="navBarIconsColorScheme" id="navBarIconsColorScheme">
        <option value="0">Red</option>
        <option value="1">Yellow</option>
        <option value="2">Green</option>
        <option value="3">Blue</option>
        <option value="4">Light Gray</option>
        <option value="5" selected="selected">Dark Gray</option>
        <option value="6">Black</option>
        <option value="7">White</option>
      </select>
    </div>
    <label for="navBarBackgroundColor" class="control-label col-xs-4">Navigation Bar Background Color</label>
    <div class="col-xs-8">
      <input name="navBarBackgroundColor" id="navBarBackgroundColor" type="text" />
    </div>
    <label for="customLinksEnabled" class="control-label col-xs-4">Enable Custom Links</label>
    <div class="col-xs-8">
      <input type="checkbox" name="customLinksEnabled" id="customLinksEnabled" />
    </div>
    <label for="clButtonBackgroundColor" class="control-label col-xs-4">Custom Links Button Background Color</label>
    <div class="col-xs-8">
      <input name="clButtonBackgroundColor" id="clButtonBackgroundColor" type="text" />
    </div>
    <label for="clLabel1" class="control-label col-xs-4">Custom Links Label 1</label>
    <div class="col-xs-8">
      <input name="clLabel1" id="clLabel1" type="text" />
    </div>
    <label for="clLink1" class="control-label col-xs-4">Custom Links Link 1</label>
    <div class="col-xs-8">
      <input name="clLink1" id="clLink1" type="text" />
    </div>
    
    <label for="clLabel2" class="control-label col-xs-4">Custom Links Label 2</label>
    <div class="col-xs-8">
      <input name="clLabel2" id="clLabel2" type="text" />
    </div>
    <label for="clLink2" class="control-label col-xs-4">Custom Links Link 2</label>
    <div class="col-xs-8">
      <input name="clLink2" id="clLink2" type="text" />
    </div>
    
    <label for="clLabel3" class="control-label col-xs-4">Custom Links Label 3</label>
    <div class="col-xs-8">
      <input name="clLabel3" id="clLabel3" type="text" />
    </div>
    <label for="clLink3" class="control-label col-xs-4">Custom Links Link 3</label>
    <div class="col-xs-8">
      <input name="clLink3" id="clLink3" type="text" />
    </div>
    
    <label for="clLabel4" class="control-label col-xs-4">Custom Links Label 4</label>
    <div class="col-xs-8">
      <input name="clLabel4" id="clLabel4" type="text" />
    </div>
    <label for="clLink4" class="control-label col-xs-4">Custom Links Link 4</label>
    <div class="col-xs-8">
      <input name="clLink4" id="clLink4" type="text" />
    </div>
    
    <label for="clLabel5" class="control-label col-xs-4">Custom Links Label 5</label>
    <div class="col-xs-8">
      <input name="clLabel5" id="clLabel5" type="text" />
    </div>
    <label for="clLink5" class="control-label col-xs-4">Custom Links Link 5</label>
    <div class="col-xs-8">
      <input name="clLink5" id="clLink5" type="text" />
    </div>
    
    <label for="clLabel6" class="control-label col-xs-4">Custom Links Label 6</label>
    <div class="col-xs-8">
      <input name="clLabel6" id="clLabel6" type="text" />
    </div>
    <label for="clLink6" class="control-label col-xs-4">Custom Links Link 6</label>
    <div class="col-xs-8">
      <input name="clLink6" id="clLink6" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Timing</legend>
    <label for="idleTime" class="control-label col-xs-4">Idle Time Limit (seconds)</label>
    <div class="col-xs-8">
      <input name="idleTime" id="idleTime" type="text" />
    </div>
    <label for="refreshTime" class="control-label col-xs-4">Homepage Refresh Time (minutes)</label>
    <div class="col-xs-8">
      <input name="idleTime" id="idleTime" type="text" />
    </div>
    <label for="pageLoadTime" class="control-label col-xs-4">Page Loading Time Limit (seconds)</label>
    <div class="col-xs-8">
      <input name="pageLoadTime" id="pageLoadTime" type="text" />
    </div>
    <label for="browseTime" class="control-label col-xs-4">Browsing Time Limit</label>
    <div class="col-xs-8">
      <select name="browseTime" id="browseTime">
        <option value="5">5 min</option>
        <option value="10">10 min</option>
        <option value="15">15 min</option>
        <option value="20">20 min</option>
        <option value="30">30 min</option>
        <option value="45">45 min</option>
        <option value="60">60 min</option>
        <option value="-1" selected="selected">Forever</option>
      </select>
    </div>
    <label for="goodByePage" class="control-label col-xs-4">Good-Bye Page</label>
    <div class="col-xs-8">
      <input name="goodByePage" id="goodByePage" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>PDF Display</legend>
    <label for="pdfShowThumbs" class="control-label col-xs-4">Show Thumbnails</label>
    <div class="col-xs-8">
      <input type="checkbox" name="pdfShowThumbs" id="pdfShowThumbs" />
    </div>
    <label for="pdfShowPageNumbers" class="control-label col-xs-4">Show page Numbers</label>
    <div class="col-xs-8">
      <input type="checkbox" name="pdfShowPageNumbers" id="pdfShowPageNumbers" />
    </div>
    <label for="pdfDisableZoom" class="control-label col-xs-4">PDF Disable Zoom</label>
    <div class="col-xs-8">
      <input type="checkbox" name="pdfDisableZoom" id="pdfDisableZoom" />
    </div>
    <label for="pdfScrollingType" class="control-label col-xs-4">PDF Display Style</label>
    <div class="col-xs-8">
      <select name="pdfScrollingType" id="pdfScrollingType">
        <option selected></option>
        <option value="0">Scroll</option>
        <option value="1">Page Turn</option>
        <option value="2">Hyperlink Only</option>
      </select>
    </div>
    <label for="pdfInfitineScrollOrientation" class="control-label col-xs-4">Scroll Orientation</label>
    <div class="col-xs-8">
      <select name="pdfInfitineScrollOrientation" id="pdfInfitineScrollOrientation">
        <option selected></option>
        <option value="0">Horizontal</option>
        <option value="1">Veritcal</option>
      </select>
    </div>
    <label for="pdfBackgroundImageFile" class="control-label col-xs-4">Background Image URL</label>
    <div class="col-xs-8">
      <input name="pdfBackgroundImageFile" id="pdfBackgroundImageFile" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Memory Settings</legend>
    <label for="clearCache" class="control-label col-xs-4">Clear Cache</label>
    <div class="col-xs-8">
      <input type="checkbox" name="clearCache" id="clearCache" />
    </div>
    <label for="cookieAcceptPolicy" class="control-label col-xs-4">Accept Cookies</label>
    <div class="col-xs-8">
      <select name="cookieAcceptPolicy" id="cookieAcceptPolicy">
        <option selected></option>
        <option value="0">Never</option>
        <option value="1">From Visited</option>
        <option value="2">Always</option>
      </select>
    </div>
    <label for="clearCookies" class="control-label col-xs-4">Clear Cookies</label>
    <div class="col-xs-8">
      <input type="checkbox" name="clearCookies" id="clearCookies" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Printing</legend>
    <label for="printEnabled" class="control-label col-xs-4">AirPrint Enabled</label>
    <div class="col-xs-8">
      <input type="checkbox" name="printEnabled" id="printEnabled" />
    </div>
    <label for="showPrintIcon" class="control-label col-xs-4">Show AirPrint Icon</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showPrintIcon" id="showPrintIcon" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Miscellaneous</legend>
    <label for="manualControlOfBrightness" class="control-label col-xs-4">	Brightness (0-darkest 1-brightest)</label>
    <div class="col-xs-8">
      <input name="manualControlOfBrightness" id="manualControlOfBrightness" type="text" />
    </div>
    <label for="accessJS_API" class="control-label col-xs-4">JavaScript Execution Allowed:</label>
    <div class="col-xs-8">
    <select name="accessJS_API" id="accessJS_API">
        <option selected></option>
        <option value="0">By Injection</option>
        <option value="1">By Import</option>
        <option value="2">Never</option>
      </select>
    </div>
  </fieldset>
  <input type="hidden" id="ID" name="ID" />
  <input type="reset" value="Cancel" id="reset" class="btn" />
  <input type="submit" value="Save" id="submitButton" name="submitButton" class="btn btn-primary" />
</form>
<h2>Defined Applications</h2>
<table border="1" class="table">
  <tr>
    <td>App ID</td>
    <td>Home Page</td>
    <td>Description</td>
    <td>Date Created</td>
    <td>Date Modified</td>
    <td>Modified By</td>
    <td>Actions</td>
  </tr>
  <?php echo($appsOut); ?>
</table>
<script type="text/javascript" language="javascript">
	function isUndefined(x) {var u; return x === u;}

	var $j = jQuery.noConflict();
	
	$j(function() {
		$j(".datetimepicker").datetimepicker({
			showSecond: false,
			timeFormat: 'hh:mm:ss',
			dateFormat: 'yy-mm-dd'
		});
		
		$j('.copyLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('appdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					if(data[0].showStatusBar == '1'){
						$j('#showStatusBar').attr('checked',true);
					} else {
						$j('#showStatusBar').attr('checked',false);
					}
					if(data[0].showAddressBar =='1'){
						$j('#showAddressBar').attr('checked',true);
					} else {
						$j('#showAddressBar').attr('checked',false);
					}
					if(data[0].showNavigationBar =='1'){
						$j('#showNavigationBar').attr('checked',true);
					} else {
						$j('#showNavigationBar').attr('checked',false);
					}
					if(data[0].zoomDisabled =='1'){
						$j('#zoomDisabled').attr('checked',true);
					} else {
						$j('#zoomDisabled').attr('checked',false);
					}
					if(data[0].printEnabled =='1'){
						$j('#printEnabled').attr('checked',true);
					} else {
						$j('#printEnabled').attr('checked',false);
					}
					if(data[0].showLoadingProgress =='1'){
						$j('#showLoadingProgress').attr('checked',true);
					} else {
						$j('#showLoadingProgress').attr('checked',false);
					}
					if(data[0].viewOnly =='1'){
						$j('#viewOnly').attr('checked',true);
					} else {
						$j('#viewOnly').attr('checked',false);
					}
					if(data[0].showSiteMessage =='1'){
						$j('#showSiteMessage').attr('checked',true);
					} else {
						$j('#showSiteMessage').attr('checked',false);
					}
					if(data[0].customLinksEnabled =='1'){
						$j('#customLinksEnabled').attr('checked',true);
					} else {
						$j('#customLinksEnabled').attr('checked',false);
					}
					if(data[0].textSelection =='1'){
						$j('#textSelection').attr('checked',true);
					} else {
						$j('#textSelection').attr('checked',false);
					}
					if(data[0].disableWebViewBouncing =='1'){
						$j('#disableWebViewBouncing').attr('checked',true);
					} else {
						$j('#disableWebViewBouncing').attr('checked',false);
					}
					if(data[0].pdfShowThumbs =='1'){
						$j('#pdfShowThumbs').attr('checked',true);
					} else {
						$j('#pdfShowThumbs').attr('checked',false);
					}
					if(data[0].pdfShowPageNumbers =='1'){
						$j('#pdfShowPageNumbers').attr('checked',true);
					} else {
						$j('#pdfShowPageNumbers').attr('checked',false);
					}
					if(data[0].pdfDisplayZoom =='1'){
						$j('#pdfDisplayZoom').attr('checked',true);
					} else {
						$j('#pdfDisplayZoom').attr('checked',false);
					}
					if(data[0].clearCache =='1'){
						$j('#clearCache').attr('checked',true);
					} else {
						$j('#clearCache').attr('checked',false);
					}
					if(data[0].clearCookies =='1'){
						$j('#clearCookies').attr('checked',true);
					} else {
						$j('#clearCookies').attr('checked',false);
					}
					if(data[0].showPrintIcon =='1'){
						$j('#showPrintIcon').attr('checked',true);
					} else {
						$j('#showPrintIcon').attr('checked',false);
					}
					$j('#homePage').val(data[0].homePage);
					$j('#description').val(data[0].description);
					$j('#whiteList').val(data[0].whiteList);
					$j('#idleTime').val(data[0].idleTime);
					$j('#refreshTime').val(data[0].refreshTime);
					$j('#browseTime').val(data[0].browseTime);
					$j('#goodByePage').val(data[0].goodByePage);
					$j('#offDomainMessage').val(data[0].offDomainMessage);
					$j('#navBarIconsColorScheme').val(data[0].navBarIconsColorScheme);
					$j('#navBarBackgroundColor').val(data[0].navBarBackgroundColor);
					$j('#clBackgroundColor').val(data[0].clBackgroundColor);
					$j('#clButtonBackgroundColor').val(data[0].clButtonBackgroundColor);
					$j('#clLabel1').val(data[0].clLabel1);
					$j('#clLink1').val(data[0].clLink1);
					$j('#clLabel2').val(data[0].clLabel2);
					$j('#clLink2').val(data[0].clLink2);
					$j('#clLabel3').val(data[0].clLabel3);
					$j('#clLink3').val(data[0].clLink3);
					$j('#clLabel4').val(data[0].clLabel4);
					$j('#clLink4').val(data[0].clLink4);
					$j('#clLabel5').val(data[0].clLabel5);
					$j('#clLink5').val(data[0].clLink5);
					$j('#clLabel6').val(data[0].clLabel6);
					$j('#clLink6').val(data[0].clLink6);
					$j('#pageReloadBackgroundColor').val(data[0].pageReloadBackgroundColor);
					$j('#blackList').val(data[0].blackList);
					$j('#pageLoadTime').val(data[0].pageLoadTime);
					$j('#pdfScrollingType').val(data[0].pdfScrollingType);
					$j('#pdfInfiniteScrollOrientation').val(data[0].pdfInfiniteScrollOrientation);
					$j('#pdfBackgroundImageFile').val(data[0].pdfBackgroundImageFile);
					$j('#cookieAcceptPolicy').val(data[0].cookieAcceptPolicy);
					$j('#manualControlOfBrightness').val(data[0].manualControlOfBrightness);
					$j('#accessJS_API').val(data[0].accessJS_API);
				});
			});
		
		$j('.editLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('appdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					if(isUndefined(data)){
						return false;	
					}
					if(data[0].showStatusBar == '1'){
						$j('#showStatusBar').attr('checked',true);
					} else {
						$j('#showStatusBar').attr('checked',false);
					}
					if(data[0].showAddressBar =='1'){
						$j('#showAddressBar').attr('checked',true);
					} else {
						$j('#showAddressBar').attr('checked',false);
					}
					if(data[0].showNavigationBar =='1'){
						$j('#showNavigationBar').attr('checked',true);
					} else {
						$j('#showNavigationBar').attr('checked',false);
					}
					if(data[0].zoomDisabled =='1'){
						$j('#zoomDisabled').attr('checked',true);
					} else {
						$j('#zoomDisabled').attr('checked',false);
					}
					if(data[0].printEnabled =='1'){
						$j('#printEnabled').attr('checked',true);
					} else {
						$j('#printEnabled').attr('checked',false);
					}
					if(data[0].showLoadingProgress =='1'){
						$j('#showLoadingProgress').attr('checked',true);
					} else {
						$j('#showLoadingProgress').attr('checked',false);
					}
					if(data[0].viewOnly =='1'){
						$j('#viewOnly').attr('checked',true);
					} else {
						$j('#viewOnly').attr('checked',false);
					}
					if(data[0].showSiteMessage =='1'){
						$j('#showSiteMessage').attr('checked',true);
					} else {
						$j('#showSiteMessage').attr('checked',false);
					}
					if(data[0].customLinksEnabled =='1'){
						$j('#customLinksEnabled').attr('checked',true);
					} else {
						$j('#customLinksEnabled').attr('checked',false);
					}
					if(data[0].textSelection =='1'){
						$j('#textSelection').attr('checked',true);
					} else {
						$j('#textSelection').attr('checked',false);
					}
					if(data[0].disableWebViewBouncing =='1'){
						$j('#disableWebViewBouncing').attr('checked',true);
					} else {
						$j('#disableWebViewBouncing').attr('checked',false);
					}
					if(data[0].pdfShowThumbs =='1'){
						$j('#pdfShowThumbs').attr('checked',true);
					} else {
						$j('#pdfShowThumbs').attr('checked',false);
					}
					if(data[0].pdfShowPageNumbers =='1'){
						$j('#pdfShowPageNumbers').attr('checked',true);
					} else {
						$j('#pdfShowPageNumbers').attr('checked',false);
					}
					if(data[0].pdfDisplayZoom =='1'){
						$j('#pdfDisplayZoom').attr('checked',true);
					} else {
						$j('#pdfDisplayZoom').attr('checked',false);
					}
					if(data[0].clearCache =='1'){
						$j('#clearCache').attr('checked',true);
					} else {
						$j('#clearCache').attr('checked',false);
					}
					if(data[0].clearCookies =='1'){
						$j('#clearCookies').attr('checked',true);
					} else {
						$j('#clearCookies').attr('checked',false);
					}
					if(data[0].showPrintIcon =='1'){
						$j('#showPrintIcon').attr('checked',true);
					} else {
						$j('#showPrintIcon').attr('checked',false);
					}
					$j('#homePage').val(data[0].homePage);
					$j('#description').val(data[0].description);
					$j('#whiteList').val(data[0].whiteList);
					$j('#idleTime').val(data[0].idleTime);
					$j('#refreshTime').val(data[0].refreshTime);
					$j('#browseTime').val(data[0].browseTime);
					$j('#goodByePage').val(data[0].goodByePage);
					$j('#offDomainMessage').val(data[0].offDomainMessage);
					$j('#navBarIconsColorScheme').val(data[0].navBarIconsColorScheme);
					$j('#navBarBackgroundColor').val(data[0].navBarBackgroundColor);
					$j('#clBackgroundColor').val(data[0].clBackgroundColor);
					$j('#clButtonBackgroundColor').val(data[0].clButtonBackgroundColor);
					$j('#clLabel1').val(data[0].clLabel1);
					$j('#clLink1').val(data[0].clLink1);
					$j('#clLabel2').val(data[0].clLabel2);
					$j('#clLink2').val(data[0].clLink2);
					$j('#clLabel3').val(data[0].clLabel3);
					$j('#clLink3').val(data[0].clLink3);
					$j('#clLabel4').val(data[0].clLabel4);
					$j('#clLink4').val(data[0].clLink4);
					$j('#clLabel5').val(data[0].clLabel5);
					$j('#clLink5').val(data[0].clLink5);
					$j('#clLabel6').val(data[0].clLabel6);
					$j('#clLink6').val(data[0].clLink6);
					$j('#pageReloadBackgroundColor').val(data[0].pageReloadBackgroundColor);
					$j('#blackList').val(data[0].blackList);
					$j('#pageLoadTime').val(data[0].pageLoadTime);
					$j('#pdfScrollingType').val(data[0].pdfScrollingType);
					$j('#pdfInfiniteScrollOrientation').val(data[0].pdfInfiniteScrollOrientation);
					$j('#pdfBackgroundImageFile').val(data[0].pdfBackgroundImageFile);
					$j('#cookieAcceptPolicy').val(data[0].cookieAcceptPolicy);
					$j('#manualControlOfBrightness').val(data[0].manualControlOfBrightness);
					$j('#accessJS_API').val(data[0].accessJS_API);
					
					
					
					$j('#ID').val(data[0].application_id);
					$j('#submitButton').val('Update');
				});
		});
		
		$j('.deleteLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('appdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					
					
					$j('#ID').val(data[0].application_id);
					$j('#submitButton').val('Delete');
					if(confirm("Are you sure you want to delete this application?")){
						$j('#submitButton').click();
					}
					return false;
			});
		});
	});


</script>