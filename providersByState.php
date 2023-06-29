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
$post_st = ($_POST['st']);	
	
	
$sql="SELECT * FROM dbo.kpplist WHERE st = '$post_st' and suppressProviderDataTool = 'NO' ORDER BY st, kppname, city ASC";	
	
$rs=odbc_exec($conn,$sql); 
$rowcount = (odbc_num_rows($rs));

	//echo $sql;
	//echo '<br />';
	echo '<h3 style="color:#666">Success! '.$rowcount.' records in the state of '.$post_st.' have been found::</h3>';
	//echo '<hr />';

	echo '<table width="100%" border=0>';
	echo '<tr class="rowheading"><td>KPPID</td><td>PROCEDURES</TD><td>KPPNAME</td><td>PHYSICAL ADDRESS</td><td>CITY</td><td>ST</td><td>SPECIALTY1</td><td>SPECIALTY2</td><td>SPECIALTY3</td><td>SPECIALTY4</td><td>SPECIALTY5</td><td>SPECIALTY6</td><td>SPECIALTY7</td></tr>';
	
	while (odbc_fetch_row($rs))
	{
	$result_kppid = (odbc_result($rs,"kppid"));
	$result_st = (odbc_result($rs,"st"));
	$result_kppname = (odbc_result($rs,"kppname"));		
	$result_physicalAddress = (odbc_result($rs,"physicalAddress"));
	$result_city = (odbc_result($rs,"city"));
	$result_specialty1 = (odbc_result($rs,"specialty1"));
	$result_specialty2 = (odbc_result($rs,"specialty2"));
	$result_specialty3 = (odbc_result($rs,"specialty3"));
	$result_specialty4 = (odbc_result($rs,"specialty4"));
	$result_specialty5 = (odbc_result($rs,"specialty5"));
	$result_specialty6 = (odbc_result($rs,"specialty6"));
	$result_specialty7 = (odbc_result($rs,"specialty7"));
	$result_pdffilename = (odbc_result($rs,"pdffilename"));

	echo '<tr><td width="100"><a href="providerdetails.php?kppid='.$result_kppid.'">'.$result_kppid.'</a></td><td width="50"><a href="http://www.kemptonpremierproviders.com/pdf/'.$result_pdffilename.'" target="_blank">PDF</a><img src="img/ext.png" alt="opens in new window" style="margin-left:5px"></td><td width="400">'.$result_kppname.'</td><td>'.$result_physicalAddress.'</td><td>'.$result_city.'</td><td>'.$result_st.'</td><td>'.$result_specialty1.'</td><td>'.$result_specialty2.'</td><td>'.$result_specialty3.'</td><td>'.$result_specialty4.'</td><td>'.$result_specialty5.'</td><td>'.$result_specialty6.'</td><td>'.$result_specialty7.'</td></tr>';
	//echo '<tr><td></td><td colspan="5">Average Allowable Amount: <strong style="color: #347C17">'.$result_avg_allowable_amount.'</strong> - Estimated Savings: <strong style="color: #347C17">'.$result_estimated_savings.'</strong></td></tr>';
			
		
	}

echo '</table>';
echo '<br />';
echo '<br />';
echo '<br />';

	odbc_free_result($rs);
	odbc_close($conn);
?>	
<button onclick="goBack()">Back to Previous Page</button>
<p><a href="index.php">KPP Data Search (Home)</a></p>	
	
</body>
</HTML>