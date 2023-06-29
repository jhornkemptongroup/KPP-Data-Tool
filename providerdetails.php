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
<h2>KPP Provider Details</h2>
<button onclick="goBack()">Back to Previous Page</button>
<hr>


<?php
//Form fields from POST
$post_kppid = ($_POST['kppid']);
	
//Form fields from GET
$get_kppid = ($_GET['kppid']);
	
// SQL connection
include 'conn.php';
if ($post_kppid == '') {
	$sql="SELECT * FROM kpplist WHERE kppid = '".$get_kppid."'";   
   }	
else {
	$sql="SELECT * FROM kpplist WHERE kppid = '".$post_kppid."'";	
}
	
$rs=odbc_exec($conn,$sql); 
$rowcount = (odbc_num_rows($rs));
//echo $sql;
//echo '<br>';
//echo '$post_kppid = '.$post_kppid;
//echo '<br>';
//echo '$get_kppid = '.$get_kppid;	
//echo '<br>';

	while (odbc_fetch_row($rs))
	{
		$result_kppid = odbc_result($rs, "kppid");
		$result_kppname = odbc_result($rs, "kppname");
		$result_taxIDNumber = odbc_result($rs, "taxIDNumber");
		$result_npi = odbc_result($rs, "npi");
		$result_sequence = odbc_result($rs, "sequence");
		$result_physicalAddress = odbc_result($rs, "physicalAddress");
		$result_city = odbc_result($rs, "city");
		$result_st = odbc_result($rs, "st");
		$result_zip = odbc_result($rs, "zip");
		$result_PublicPhone = odbc_result($rs, "PublicPhone");
		$result_publicAltPhone = odbc_result($rs, "publicAltPhone");
		$result_publicFax = odbc_result($rs, "publicFax");
		$result_website = odbc_result($rs, "website");
		$result_lat = odbc_result($rs, "lat");
		$result_long = odbc_result($rs, "long");
		$result_pdffilename = odbc_result($rs, "pdffilename");
		$result_specialty1 = odbc_result($rs, "specialty1");
		$result_specialty2 = odbc_result($rs, "specialty2");
		$result_specialty3 = odbc_result($rs, "specialty3");
		$result_specialty4 = odbc_result($rs, "specialty4");
		$result_specialty5 = odbc_result($rs, "specialty5");
		$result_specialty6 = odbc_result($rs, "specialty6");
		$result_specialty7 = odbc_result($rs, "specialty7");
		$result_imagefilename = odbc_result($rs, "imagefilename");
		$result_para1 = odbc_result($rs, "para1");
		$result_para2 = odbc_result($rs, "para2");
		$result_para3 = odbc_result($rs, "para3");
		$result_para4 = odbc_result($rs, "para4");
		$result_para5 = odbc_result($rs, "para5");
		$result_para6 = odbc_result($rs, "para6");
		$result_suppressProvider = odbc_result($rs, "suppressProvider");
		$result_suppressProviderDataTool = odbc_result($rs, "suppressProviderDataTool");
		$result_groupRules = odbc_result($rs, "groupRules");
		$result_mailingAddress = odbc_result($rs, "mailingAddress");
		$result_mailingZipCode = odbc_result($rs, "mailingZipCode");
		$result_mailingCity = odbc_result($rs, "mailingCity");
		$result_mailingState = odbc_result($rs, "mailingState");
		$result_mailingContact = odbc_result($rs, "mailingContact");
		$result_makeChecksPayableTo = odbc_result($rs, "makeChecksPayableTo");
		$result_ReferralContactName = odbc_result($rs, "ReferralContactName");
		$result_ReferralContactPhone = odbc_result($rs, "ReferralContactPhone");
		$result_ReferralContactEmail = odbc_result($rs, "ReferralContactEmail");
		$result_SchedulingContactName = odbc_result($rs, "SchedulingContactName");
		$result_SchedulingContactPhone = odbc_result($rs, "SchedulingContactPhone");
		$result_SchedulingContactEmail = odbc_result($rs, "SchedulingContactEmail");
		$result_BillingContactName = odbc_result($rs, "BillingContactName");
		$result_BillingContactPhone = odbc_result($rs, "BillingContactPhone");
		$result_BillingContactEmail = odbc_result($rs, "BillingContactEmail");
		$result_CoralContactName = odbc_result($rs, "CoralContactName");
		$result_CoralContactPhone = odbc_result($rs, "CoralContactPhone");
		$result_CoralContactEmail = odbc_result($rs, "CoralContactEmail");
		$result_OtherContact1Name = odbc_result($rs, "OtherContact1Name");
		$result_OtherContact1Title = odbc_result($rs, "OtherContact1Title");
		$result_OtherContact1Phone = odbc_result($rs, "OtherContact1Phone");
		$result_OtherContact1Email = odbc_result($rs, "OtherContact1Email");
		$result_OtherContact2Name = odbc_result($rs, "OtherContact2Name");
		$result_OtherContact2Title = odbc_result($rs, "OtherContact2Title");
		$result_OtherContact2Phone = odbc_result($rs, "OtherContact2Phone");
		$result_OtherContact2Email = odbc_result($rs, "OtherContact2Email");
		$result_OtherContact3Name = odbc_result($rs, "OtherContact3Name");
		$result_OtherContact3Title = odbc_result($rs, "OtherContact3Title");
		$result_OtherContact3Phone = odbc_result($rs, "OtherContact3Phone");
		$result_OtherContact3Email = odbc_result($rs, "OtherContact3Email");
		$result_OtherContact4Name = odbc_result($rs, "OtherContact4Name");
		$result_OtherContact4Title = odbc_result($rs, "OtherContact4Title");
		$result_OtherContact4Phone = odbc_result($rs, "OtherContact4Phone");
		$result_OtherContact4Email = odbc_result($rs, "OtherContact4Email");

		echo '<table>';
		echo '<tr><p style="font-size: 12pt">This page contains expanded information about <strong>'.$result_kppname.'</strong>. To visit their public website profile on KemptonPremierProviders.com please <a href="http://www.kemptonpremierproviders.com/viewkpp.php?id='.$result_kppid.'" target="_blank">click here</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px">.<br /><br />Please be aware that some of this information is sensitive and not to be disseminated with participants or third parties without expressed approval from the Provider Relations team. If you notice incorrect/missing information please contact Provider Relations.</p></tr>';
		echo '<tr><th class="headerdescription">Basic KPP Information</th></tr>';		
		//echo '<tr><th>Field Name</th><th>Field Data</th><th>Field Description</th></tr>';					
		echo '<tr><td>KPP Internal ID (not editable)</td><td><input type="text" size="40" name="kppid" value="'.$result_kppid.'" readonly></td><td></td></tr>';
		echo '<tr><td>KPP Name</td><td><input type="text" size="40" name="kppname" value="'.$result_kppname.'" readonly></td><td></td></tr>';
		echo '<tr><td>Tax ID</td><td><input type="text" size="40" name="taxIDNumber" value="'.$result_taxIDNumber.'" readonly></td><td></td></tr>';
		echo '<tr><td>NPI</td><td><input type="text" size="40" name="npi" value="'.$result_npi.'" readonly></td><td></td></tr>';
		echo '<tr><td>Sequence</td><td><input type="text" size="40" name="sequence" value="'.$result_sequence.'" readonly></td><td></td></tr>';		
		echo '<tr><th class="headerdescription">Physical Address Information</th></tr>';					
		//echo '<tr><th>Field Name</th><th>Field Data</th><th>Field Description</th></tr>';				
		echo '<tr><td>Physical Address</td><td><input type="text" size="40" name="physical address" maxlength="50" value="'.$result_physicalAddress.'" readonly></td><td><a href="https://www.google.com/maps/place/'.$result_physicalAddress.'+'.$result_city.'+'.$result_st.'+'.$result_zip.'" target="_blank">Click to view this address on Google Maps</a></tr>';
		echo '<tr><td>Physical City</td><td><input type="text" size="40" name="city" value="'.$result_city.'" readonly></td><td></td></tr>';
		echo '<tr><td>Physical State</td><td><input type="text" size="40" name="st" maxlength="2" value="'.$result_st.'" readonly></td><td></td></tr>';
		echo '<tr><td>Physical Zip</td><td><input type="text" size="40" name="zip" maxlength="5" value="'.$result_zip.'" readonly></td><td></td></tr>';	
		echo '<tr><td>Public Phone</td><td><input type="text" size="40" name="public phone" value="'.$result_PublicPhone.'" readonly></td><td></td></tr>';		
		echo '<tr><td>Public Alternate Phone</td><td><input type="text" size="40" name="public phone" value="'.$result_publicAltPhone.'" readonly></td><td></td></tr>';		
		echo '<tr><td>Public Fax</td><td><input type="text" size="40" name="public fax" value="'.$result_publicFax.'" readonly></td><td></td></tr>';		
		echo '<tr><td>Website</td><td><input type="text" size="40" name="website" value="'.$result_website.'" readonly></td><td><a href="'.$result_website.'" target="_blank">Click to view this website</a></td></tr>';
		echo '<tr><th class="headerdescription">Specialties</th></tr>';
		//echo '<tr><th>Field Name</th><th>Field Data</th><th>Field Description</th></tr>';				
		echo '<tr><td>Specialty 1</td><td><input type="text" size="40" name="specialty1" value="'.$result_specialty1.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 2</td><td><input type="text" size="40" name="specialty2" value="'.$result_specialty2.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 3</td><td><input type="text" size="40" name="specialty3" value="'.$result_specialty3.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 4</td><td><input type="text" size="40" name="specialty4" value="'.$result_specialty4.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 5</td><td><input type="text" size="40" name="specialty5" value="'.$result_specialty5.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 6</td><td><input type="text" size="40" name="specialty6" value="'.$result_specialty6.'" readonly></td><td></td></tr>';
		echo '<tr><td>Specialty 7</td><td><input type="text" size="40" name="specialty7" value="'.$result_specialty7.'" readonly></td><td></td></tr>';
		echo '<tr><th class="headerdescription">For Internal Use Only</th></tr>';
		//echo '<tr><th>Field Name</th><th>Field Data</th><th>Field Description</th></tr>';				
		echo '<tr><td>Suppress Provider?</td><td><input type="text" size="40" name="suppress provider" value="'.$result_suppressProvider.'" readonly></td><td>If this value is "YES" then the provider will not appear on public websites.</td></tr>';
		echo '<tr><td>Group Rules</td><td><input type="text" size="40" name="group rules" value="'.$result_groupRules.'" readonly></td><td>Special rules about this provider group.</td></tr>';
			echo '<tr><th>Mailing</th></tr>';				
		echo '<tr><td>mailingAddress</td><td><input type="text" size="40" name="group rules" value="'.$result_mailingAddress.'" readonly></td><td></td></tr>';
		echo '<tr><td>mailingZipCode</td><td><input type="text" size="40" name="group rules" value="'.$result_mailingZipCode.'" readonly></td><td></td></tr>';
		echo '<tr><td>mailingCity</td><td><input type="text" size="40" name="group rules" value="'.$result_mailingCity.'" readonly></td><td></td></tr>';
		echo '<tr><td>mailingState</td><td><input type="text" size="40" name="group rules" value="'.$result_mailingState.'" readonly></td><td></td></tr>';
		echo '<tr><td>mailingContact</td><td><input type="text" size="40" name="group rules" value="'.$result_mailingContact.'" readonly></td><td></td></tr>';
		echo '<tr><td>makeChecksPayableTo</td><td><input type="text" size="40" name="group rules" value="'.$result_makeChecksPayableTo.'" readonly></td><td></td></tr>';
			echo '<tr><th>Referral</th></tr>';				
		echo '<tr><td>ReferralContactName</td><td><input type="text" size="40" name="group rules" value="'.$result_ReferralContactName.'" readonly></td><td></td></tr>';
		echo '<tr><td>ReferralContactPhone</td><td><input type="text" size="40" name="group rules" value="'.$result_ReferralContactPhone.'" readonly></td><td></td></tr>';
		echo '<tr><td>ReferralContactEmail</td><td><input type="text" size="40" name="group rules" value="'.$result_ReferralContactEmail.'" readonly></td><td></td></tr>';
			echo '<tr><th>Scheduling</th></tr>';				
		echo '<tr><td>SchedulingContactName</td><td><input type="text" size="40" name="group rules" value="'.$result_SchedulingContactName.'" readonly></td><td></td></tr>';
		echo '<tr><td>SchedulingContactPhone</td><td><input type="text" size="40" name="group rules" value="'.$result_SchedulingContactPhone.'" readonly></td><td></td></tr>';
		echo '<tr><td>SchedulingContactEmail</td><td><input type="text" size="40" name="group rules" value="'.$result_SchedulingContactEmail.'" readonly></td><td></td></tr>';
			echo '<tr><th>Billing</th></tr>';				
		echo '<tr><td>BillingContactName</td><td><input type="text" size="40" name="group rules" value="'.$result_BillingContactName.'" readonly></td><td></td></tr>';
		echo '<tr><td>BillingContactPhone</td><td><input type="text" size="40" name="group rules" value="'.$result_BillingContactPhone.'" readonly></td><td></td></tr>';
		echo '<tr><td>BillingContactEmail</td><td><input type="text" size="40" name="group rules" value="'.$result_BillingContactEmail.'" readonly></td><td></td></tr>';
			echo '<tr><th>Coral</th></tr>';				
		echo '<tr><td>CoralContactName</td><td><input type="text" size="40" name="group rules" value="'.$result_CoralContactName.'" readonly></td><td></td></tr>';
		echo '<tr><td>CoralContactPhone</td><td><input type="text" size="40" name="group rules" value="'.$result_CoralContactPhone.'" readonly></td><td></td></tr>';
		echo '<tr><td>CoralContactEmail</td><td><input type="text" size="40" name="group rules" value="'.$result_CoralContactEmail.'" readonly></td><td></td></tr>';
			echo '<tr><th>Other Contacts</th></tr>';				
		echo '<tr><td>OtherContact1Name</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact1Name.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact1Title</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact1Title.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact1Phone</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact1Phone.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact1Email</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact1Email.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact2Name</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact2Name.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact2Title</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact2Title.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact2Phone</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact2Phone.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact2Email</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact2Email.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact3Name</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact3Name.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact3Title</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact3Title.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact3Phone</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact3Phone.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact3Email</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact3Email.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact4Name</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact4Name.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact4Title</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact4Title.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact4Phone</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact4Phone.'" readonly></td><td></td></tr>';
		echo '<tr><td>OtherContact4Email</td><td><input type="text" size="40" name="group rules" value="'.$result_OtherContact4Email.'" readonly></td><td></td></tr>';
	echo '</table>';
	echo '</form>';
	echo '<hr />';		
	odbc_free_result($rs);
	odbc_close($conn);		
	}

?>	

<p><a href="index.php">KPP Data Search (Home)</a></p>	
	
</body>
</HTML>