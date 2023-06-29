<HTML>
<head>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>KPP Data Tool 4.6</title>
	</head>
	
<body>

<script>
function goBack() {
    window.history.back();
}
</script>

<p><a href="index.php">KPP Data Search (Home)</a></p>	
<h2>KPP Data Tool 4.6 - Search Results</h2>

<button onclick="goBack()">Back to Previous Page</button>
<hr>

<?php include 'conn.php'; ?>

<?php
//Form fields from POST
$post_cpt = ($_POST['cpt']);
$post_cptalt = ($_POST['cptalt']);
$post_andor = ($_POST['andor']);
$post_drg = ($_POST['drg']);
$post_category = ($_POST['category']);
$post_icd9 = ($_POST['icd9']);
$post_icd10 = ($_POST['icd10']);
$post_description = ($_POST['description']);
$post_keyword1 = ($_POST['keyword1']);
$post_keyword2 = ($_POST['keyword2']);
$post_st = ($_POST['st']);	
$post_zip = ($_POST['zip']);
	
//Get variables from URL
if (isset($_GET['cpt'])) {
	$post_cpt = $_GET['cpt'];
}
if (isset($_GET['cptalt'])) {
	$post_cptalt = $_GET['cptalt'];
}	
if (isset($_GET['zip'])) {
	$post_zip = $_GET['zip'];
}		

//if (isset($post_zip) and isset($post_cpt) and isset($post_cptalt) and isset($post_keyword1) and isset($post_keyword2)) {
if ($post_zip == '' and $post_cpt == '' and $post_keyword1 == '' and $post_keyword2 == '' and $post_drg == '') {	
	echo '<h3 style="color:#666">No search criteria were were populated, showing zero results. Please specify at least one criteria before searching.</p>';
	echo '<br />';
	echo '<br />';	
	} 
else {	
	
//if they enter a zip code, determine user's lat and long from the zip code they entered
if ($post_zip != '') {
	$sql="SELECT TOP 1 city, state, zipcode, lat, long FROM zipcodes WHERE zipcode = '".$post_zip."'";
	$rs=odbc_exec($conn,$sql); 
	$rowcount = (odbc_num_rows($rs));

	while (odbc_fetch_row($rs))
	{
	$userlat = (odbc_result($rs,"lat"));
	$userlong = (odbc_result($rs,"long"));	
	}
	odbc_free_result($rs);
	//odbc_close($conn);
	
	//SQL queries for when the user enters a zip code initially OLD VERSION
	/*if ($post_cptalt != '') {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules, kpplist.lat, kpplist.long, dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") as 'distance' FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%') ".$post_andor." (CPT_1 LIKE '%" . $post_cptalt . "%' OR CPT_2 LIKE '%" . $post_cptalt . "%' OR CPT_3 LIKE '%" . $post_cptalt . "%' OR CPT_4 LIKE '%" . $post_cptalt . "%' OR CPT_5 LIKE '%" . $post_cptalt . "%' OR CPT_6 LIKE '%" . $post_cptalt . "%' OR CPT_7 LIKE '%" . $post_cptalt . "%' OR CPT_8 LIKE '%" . $post_cptalt . "%' OR CPT_9 LIKE '%" . $post_cptalt . "%' OR CPT_10 LIKE '%" . $post_cptalt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") <= '".$post_maxrange."' AND suppressProviderDataTool = 'NO' ORDER BY distance, 'PROVIDER NAME' ASC";*/
		
	//SQL queries for when the user enters a zip code initially NEW VERSION
	if ($post_cptalt != '') {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules, kpplist.lat, kpplist.long, dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") as 'distance' FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%') ".$post_andor." (CPT_1 LIKE '%" . $post_cptalt . "%' OR CPT_2 LIKE '%" . $post_cptalt . "%' OR CPT_3 LIKE '%" . $post_cptalt . "%' OR CPT_4 LIKE '%" . $post_cptalt . "%' OR CPT_5 LIKE '%" . $post_cptalt . "%' OR CPT_6 LIKE '%" . $post_cptalt . "%' OR CPT_7 LIKE '%" . $post_cptalt . "%' OR CPT_8 LIKE '%" . $post_cptalt . "%' OR CPT_9 LIKE '%" . $post_cptalt . "%' OR CPT_10 LIKE '%" . $post_cptalt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND suppressProviderDataTool = 'NO' ORDER BY distance, 'PROVIDER NAME' ASC";
		
		
}
	// OLD VERSION
	/*else {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules, kpplist.lat, kpplist.long, dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") as 'distance' FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") <= '".$post_maxrange."' AND suppressProviderDataTool = 'NO'  ORDER BY distance, 'PROVIDER NAME' ASC";
	}*/	
	
	// NEW VERSION
	else {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules, kpplist.lat, kpplist.long, dbo.CalculateDistance(kpplist.long,kpplist.lat,".$userlong.",".$userlat.") as 'distance' FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND suppressProviderDataTool = 'NO'  ORDER BY distance, 'PROVIDER NAME' ASC";
	}	
	
$rs=odbc_exec($conn,$sql); 
$rowcount = (odbc_num_rows($rs));

}
	//SQL queries for when a user DOES NOT enter a zip code initially
	else {
	if ($post_cptalt != '') {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%') ".$post_andor." (CPT_1 LIKE '%" . $post_cptalt . "%' OR CPT_2 LIKE '%" . $post_cptalt . "%' OR CPT_3 LIKE '%" . $post_cptalt . "%' OR CPT_4 LIKE '%" . $post_cptalt . "%' OR CPT_5 LIKE '%" . $post_cptalt . "%' OR CPT_6 LIKE '%" . $post_cptalt . "%' OR CPT_7 LIKE '%" . $post_cptalt . "%' OR CPT_8 LIKE '%" . $post_cptalt . "%' OR CPT_9 LIKE '%" . $post_cptalt . "%' OR CPT_10 LIKE '%" . $post_cptalt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND suppressProviderDataTool = 'NO'  ORDER BY 'PROVIDER NAME' ASC";
}
	
	else {
	$sql="SELECT *, kpplist.city, kpplist.st, kpplist.pdffilename, kpplist.groupRules FROM dbo.allproceduresmerged_v2 INNER JOIN dbo.kpplist ON dbo.allproceduresmerged_v2.providerid = kpplist.kppid WHERE ((CPT_1 LIKE '%" . $post_cpt . "%' OR CPT_2 LIKE '%" . $post_cpt . "%' OR CPT_3 LIKE '%" . $post_cpt . "%' OR CPT_4 LIKE '%" . $post_cpt . "%' OR CPT_5 LIKE '%" . $post_cpt . "%' OR CPT_6 LIKE '%" . $post_cpt . "%' OR CPT_7 LIKE '%" . $post_cpt . "%' OR CPT_8 LIKE '%" . $post_cpt . "%' OR CPT_9 LIKE '%" . $post_cpt . "%' OR CPT_10 LIKE '%" . $post_cpt . "%')) AND DRG LIKE '%" . $post_drg . "%' AND CATEGORY LIKE '%" . $post_category . "%' AND ICD9 LIKE '%" . $post_icd9 . "%' AND ICD10 LIKE '%" . $post_icd10 . "%' AND DESCRIPTION LIKE '%" . $post_keyword1 . "%' AND DESCRIPTION LIKE '%" . $post_keyword2 . "%' AND st LIKE '%" . $post_st . "%' AND suppressProviderDataTool = 'NO'  ORDER BY 'PROVIDER NAME' ASC";
	}	
$rs=odbc_exec($conn,$sql); 
$rowcount = (odbc_num_rows($rs));

}
	
// if the row count is zero, print response and link back to home.
if ($rowcount == 0) {
	echo '<h4 style="color:#666">No records found.</h4>';
	//echo '<br><br><br><br><br>';
	//echo '<hr />'.$sql.'<hr />Row Count: '.$rowcount;
	//echo '<hr />Zip('.$post_zip.')<br />';
	}

// otherwise, proceed with results.
else {
	//echo $sql;
	//echo '<br />';
	echo '<h3 style="color:#666">Success! '.$rowcount.' records matching your search criteria have been located:</h3>';
	echo '<hr />';
	
	while (odbc_fetch_row($rs))
	{
	$result_providername = (odbc_result($rs,"PROVIDER NAME"));
	$result_groupRules = (odbc_result($rs,"groupRules"));		
	//Color coding provider names
	$color = "Black";	
	$result_cpt_1 = (odbc_result($rs,"CPT_1"));
	$result_cpt_2 = (odbc_result($rs,"CPT_2"));	
	$result_cpt_3 = (odbc_result($rs,"CPT_3"));	
	$result_cpt_4 = (odbc_result($rs,"CPT_4"));	
	$result_cpt_5 = (odbc_result($rs,"CPT_5"));	
	$result_cpt_6 = (odbc_result($rs,"CPT_6"));	
	$result_cpt_7 = (odbc_result($rs,"CPT_7"));	
	$result_cpt_8 = (odbc_result($rs,"CPT_8"));	
	$result_cpt_9 = (odbc_result($rs,"CPT_9"));	
	$result_cpt_10 = (odbc_result($rs,"CPT_10"));	
	$result_drg = odbc_result($rs,"DRG");
	$result_description = (odbc_result($rs,"DESCRIPTION"));
	$result_category = odbc_result($rs,"CATEGORY");
	$result_inout = odbc_result($rs,"INOUT");
	$result_ICD9 = odbc_result($rs,"ICD9");
	$result_ICD10 = odbc_result($rs, "ICD10");
	$result_notes = odbc_result($rs, "NOTES");
	$result_bundle_includes = odbc_result($rs, "BUNDLE_INCLUDES");		
	$result_price = odbc_result($rs, "PRICE");	
	$result_bundleid = (odbc_result($rs,"BUNDLE_ID"));
	$result_city = (odbc_result($rs,"city"));		
	$result_st = (odbc_result($rs,"st"));
	$result_kppid = (odbc_result($rs,"kppid"));
	$result_pdffilename = (odbc_result($rs,"pdffilename"));
	$result_distance = (odbc_result($rs,"distance"));
	$result_avg_allowable_amount = (odbc_result($rs,"AVG_ALLOWABLE_AMOUNT"));
	$result_estimated_savings = (odbc_result($rs,"ESTIMATED_SAVINGS"));

	echo '<table width="1000" border=0>';

	//if  a bundle ID is set, then add the BUNDLED PROCEDURE descriptive row.
	if ($result_bundleid !='') {
		echo '<tr class="bundlerow"><td colspan=6><strong>BUNDLED PROCEDURE</strong></td></tr>'; 
	}
		
	echo '<tr><td rowspan="3" width="240"><strong><font color="'. $color .'"><a href="providerdetails.php?kppid='.$result_kppid.'">'.$result_providername.'</a></font></strong><br><em>'.$result_city.', '.$result_st.'</em>';
	if ($result_groupRules != '') {
		echo '<br /><br /><p class="groupRules"><strong>Special Group Rules:</strong><br />'.$result_groupRules.'</p></td></tr>';
	}
	else echo '</td></tr>'; 
	
	//if not a bundle, show the result with a single CPT code (CPT_1 field)	and no bundle ID:
	if ($result_bundleid =='') {
		echo '<tr class="rowheading"><td width="500">Procedure Description</td><td>CPT</td><td>DRG</td><td>PRICE</td><td>Qualified Procedures</td></tr>';
		echo '<tr><td>'.$result_description.'</td><td><a href="./searchresults.php?cpt='.$result_cpt_1.'&zip='.$post_zip.'">'.$result_cpt_1.'</a></td><td>'.$result_drg.'</td><td>'.$result_price.'</td><td><ul><li><a href="http://www.kemptonpremierproviders.com/pdf/'.$result_pdffilename.'" target="_blank">PDF</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px"></li></ul></td></tr>';
		echo '<tr><td></td><td colspan="5">Average Allowable Amount: <strong style="color: #347C17">'.$result_avg_allowable_amount.'</strong> - Estimated Savings: <strong style="color: #347C17">'.$result_estimated_savings.'</strong></td></tr>';
		//hide the distance if the user didn't enter a zip code
		if ($result_distance != '') { 
			echo '<tr><td><em>Distance: <strong>'.$result_distance.'</strong> miles from '.$post_zip.'</em></td></tr>';	
		}
	}
	
	//otherwise we want to display the bundle ID and the CPT codes that make up that bundle:
	else {
		echo '<tr class="rowheading"><td width="500">Procedure Description</td><td>Bundle ID</td><td>DRG</td><td>PRICE</td><td>Qualified Procedures</td></tr>';
		echo '<tr><td>'.$result_description.'</td><td>'.$result_bundleid.'</td><td>'.$result_drg.'</td><td>'.$result_price.'</td><td><ul><li><a href="http://www.kemptonpremierproviders.com/pdf/'.$result_pdffilename.'" target="_blank">PDF</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px"></li></ul></td></tr>';
		echo '<tr><td></td><td colspan="5">Average Allowable Amount: <strong style="color: #347C17">'.$result_avg_allowable_amount.'</strong> - Estimated Savings: <strong style="color: #347C17">'.$result_estimated_savings.'</strong></td></tr>';
		echo '<tr><td></td><td colspan="4"><strong>CPT codes included in this bundle: <a href="./searchresults.php?cpt='.$result_cpt_1.'&zip='.$post_zip.'">'.$result_cpt_1.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_2.'&zip='.$post_zip.'">'.$result_cpt_2.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_3.'&zip='.$post_zip.'">'.$result_cpt_3.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_4.'&zip='.$post_zip.'">'.$result_cpt_4.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_5.'&zip='.$post_zip.'">'.$result_cpt_5.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_6.'&zip='.$post_zip.'">'.$result_cpt_6.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_7.'&zip='.$post_zip.'">'.$result_cpt_7.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_8.'&zip='.$post_zip.'">'.$result_cpt_8.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_9.'&zip='.$post_zip.'">'.$result_cpt_9.'</a>&nbsp;<a href="./searchresults.php?cpt='.$result_cpt_10.'&zip='.$post_zip.'">'.$result_cpt_10.'</a></strong></td></tr>';	
		//hide the distance if the user didn't enter a zip code
		if ($result_distance != '') { 
			echo '<tr><td><em>Distance: <strong>'.$result_distance.'</strong> miles from '.$post_zip.'</em></td></tr>';	
		}
		
	}
	
	if ($result_bundle_includes != '') {
		echo '<tr><td></td><td colspan="4"><strong><font color="Purple">Bundle Includes: ' . $result_bundle_includes . '</font></strong></td></tr>';	
	}
	
	//if the notes field starts with http, turn it into a hyperlink.
	if (substr($result_notes, 0, 4) === "http") {
		echo '<tr><td></td><td colspan="4"><em><a href="' . $result_notes . '" target="_blank">' . $result_notes . '</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px"></em></td></tr>';
	}
	//if the notes field starts with ""(CORAL) http" then we trim out the (CORAL) and turn it into a link.
	else if (substr($result_notes, 8, 4) === "http") {
		echo '<tr><td></td><td colspan="4"><em><a href="' . ltrim($result_notes,"(CORAL)") . '" target="_blank">' . $result_notes . '</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px"></em></td></tr>';
	}
	//otherwise, if the notes field is not blank, output normally.
	else if ($result_notes != '') {
		echo '<tr><td></td><td colspan="4"><em><font color="red">Notes: ' . $result_notes . '</font></em></td></tr>';
	}
	
	echo '</table>';
	echo '<hr>';
		
	}
		
	odbc_free_result($rs);
	odbc_close($conn);
	}
}
?>	
<button onclick="goBack()">Back to Previous Page</button>
<p><a href="index.php">KPP Data Search (Home)</a></p>	
	
</body>
</HTML>