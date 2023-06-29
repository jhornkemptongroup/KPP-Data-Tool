<HTML>
<head>
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link href="bootstrap.min (2).css" rel="stylesheet" />
    <script src="jquery-3.7.0.js"></script>
</head>

<title>KPP Data Tool 4.6</title>
<body>

<h2>KPP Data Tool 4.6</h2>
	<h5><a href="https://whitehatsearch.kemptongroup.com/">Toggle White Hat Data Tool</a></h5>	
	<hr>
<h4>Release Notes (11/5/2021)</h4>
<ul>
	<li>Release 4.6:</li>
	<li>Added ability to search KPPFree providers by state.</li>
</ul>
<hr>
<h2 style="color: slategray">Procedure Search</h2>
	<p style="color: mediumvioletred; font-size: 11pt"><em>Note: You must provide at least one keyword and/or CPT code in order to search.</em></p>
<table>
	<tr>
    	<td>
            <form action="searchresults.php" method="post">
                <table border="0" cellpadding="10">
                    <tr>
                        <td><p>First Keyword:</p></td><td colspan="3"><input type="text" name="keyword1" size="70" /></td>
                    </tr>
                    <tr>
                        <td><p>Second Keyword:</p></td><td colspan="3"><input type="text" name="keyword2" size="70" /></td>
                    </tr>
                    <tr>
						<td><p>CPT Code:</p></td><td><input type="text" name="cpt" size="20" /></td><td><select name="andor"><option value="AND">AND</option><option value="OR">OR</option></select></td><td><input type="text" name="cptalt" size="20" /></td>
                    </tr>
                    <tr>
                        <td><p>DRG Code:</p></td><td><input type="text" name="drg" size="20" /></td>
                    </tr>
                    <tr>
                        <td><p>ICD9 Code:</p></td><td><input type="text" name="icd9" size="20" /></td><td><p>ICD10 Code:</p></td><td><input type="text" name="icd10" size="20" /></td>
                    </tr>
                    <tr>
                        <td><p>State: (enter two letter abbreviation)</p></td><td><input type="text" name="st" size="20" /></td><td><p>Zip Code: (5 digits)</p></td><td><input type="text" name="zip" size="20" /></td>
                    </tr>
                    <tr>
						<td></td><td></td><td></td><td></td>
                    </tr>
					<tr>
                        <td colspan="2" align="right"><p><input type="submit" value="Search" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset Form" /></p></td>
                    </tr>
                </table>
                <p><em>Important Note: Cancer Specialists of Oklahoma will not appear in search results as their list of qualified procedures and pricing is not available.</em></p>
            </form>
         </td>
     </tr>
</table>
<hr />
<h2 style="color: slategray">View KPP Provider Details</h2>
<form action="providerdetails.php" method="post">
    <table border="0" cellpadding="10">
        <tr>
            <td><p>Choose a KPP to view their provider information:</p></td>
            <td>
                <select name="kppid">
					<?php
					include 'conn.php'; 
					$sql="SELECT kppid from kpplist";
					$rs=odbc_exec($conn,$sql); 
					$rowcount = (odbc_num_rows($rs));
					odbc_free_result($rs);
					//odbc_close($conn);	
                    $sql="SELECT kppname,kppid FROM kpplist WHERE suppressProviderDataTool = 'NO' ORDER BY kppname ASC";
                    $rs=odbc_exec($conn,$sql); 
                        while (odbc_fetch_row($rs))
                        {
							$result_kppname = odbc_result($rs,"kppname");	
							$result_kppid = odbc_result($rs,"kppid");	
							echo '<option value="'.$result_kppid.'">'.$result_kppname.' (KPP ID: '.$result_kppid.')</option>';
                        }
                        odbc_free_result($rs);
                        odbc_close_all();
                    ?>	
                </select>
            </td>
            <td colspan="2" align="right"><p><input type="submit" value="View KPP Details" /></p></td>
        </tr>
    </table>
</form>
<hr />
<h2 style="color: slategray">View KPP Providers By State</h2>
<form action="providersByState.php" method="post">
    <table border="0" cellpadding="10">
        <tr>
            <td><p>Choose a state (missing states mean there are no KPPs in that state):</p></td>
            <td>
                <select name="st">
					<?php
					include 'conn.php'; 
					$sql="SELECT kppid from kpplist";
					$rs=odbc_exec($conn,$sql); 
					$rowcount = (odbc_num_rows($rs));
					odbc_free_result($rs);
					//odbc_close($conn);	
                    $sql="SELECT distinct st FROM kpplist WHERE suppressProviderDataTool = 'NO' ORDER BY st ASC";
                    $rs=odbc_exec($conn,$sql); 
                        while (odbc_fetch_row($rs))
                        {
							$result_st = odbc_result($rs,"st");	
							//$result_kppname = odbc_result($rs,"kppname");	
							//$result_kppid = odbc_result($rs,"kppid");	
							//echo '<option value="'.$result_kppid.'">'.$result_kppname.' (KPP ID: '.$result_kppid.')'.$result_st.'</option>';
							echo '<option value="'.$result_st.'">'.$result_st.'</option>';
                        }
                        odbc_free_result($rs);
                        odbc_close_all();
						
                    ?>	
                </select>
			</td>
            <td colspan="2" align="right"><p><input type="submit" value="View KPP Providers in This State" /></p></td>
        </tr>
    </table>
</form>
	

</body>
</HTML>