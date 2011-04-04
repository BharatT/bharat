
<html>
<head>
<link rel="stylesheet" href='<?php echo base_url(); ?>css/webcalc.css'
	type="text/css" media="screen, projection" />
<LINK REL="SHORTCUT ICON"
       HREF="<?php echo base_url(); ?>images/favicon.ico">	
<title>Calculation Test</title>
</head>
<body>
<?php


$totalSale=$_REQUEST['TotalSale'];
//print ($totalSale);
//echo "$TotalSale";
$costofSale=$_REQUEST['CostofSale'];
//print ($costofSale);

$averageSale=$_REQUEST['AverageSale'];
//print ($averageSale);
$conversionRate=$_REQUEST['ConversionRate'];
//print ($conversionRate);

$total=$_REQUEST['FixedCost'];


$rentMonthly='';
$phoneMonthly='';
$insuranceMonthly='';
$electricityMonthly='';
$carRegoMonthly='';
$fuelMonthly='';
$advertisingMonthly='';
$wagsMonthly='';
$paygMonthly='';
$workersMonthly='';
$otherMonthly='';
$Total1='';
$jobValue='';
function check_input($data,$problem){

	global $errorMsg;
	if(empty($data))
	{
		$price_error = 'Enter TotalSale';
		echo $price_error;
		$errorMsg.= "$problem Require:";
		$error=true;
		//echo $_SERVER['PHP_SELF'];
		//	header('location: ' . $_SERVER['PHP_SELF']);
			
	}
	elseif(!is_numeric($data))
	{
		$price_error = 'TotalSale is invalid. Numbers only (eg: 123.45)';
		echo $price_error;
		$errorMsg.= "$problem invalid: ";
		$error=true;
	}
	//}
	return $data;
}

?>
<script type="text/javascript">

function isNumeric(){

	var numericExpression = /^[0-9]+$/;
	
		
	  var rentMonthly=document.getElementById('rentMonthly').value ;
	  var phoneMonthly=document.getElementById('phoneMonthly').value ;
	  var insuranceMonthly=document.getElementById('insuranceMonthly').value ;
	  var ConversionRate=document.getElementById('ConversionRate').value ;
	  var electricityMonthly=document.getElementById('electricityMonthly').value;
	  var carRegoMonthly=document.getElementById('carRegoMonthly').value;
	  var fuelMonthly=document.getElementById('fuelMonthly').value;
	  var advertisingMonthly=document.getElementById('advertisingMonthly').value;
	  var wagsMonthly=document.getElementById('wagsMonthly').value;
	  var paygMonthly=document.getElementById('paygMonthly').value;
	  var workersMonthly=document.getElementById('workersMonthly').value;
	  var otherMonthly=document.getElementById('otherMonthly').value;
	  var jobValue=document.getElementById('jobValue').value;
	  
	  document.getElementById('errorMessage').innerHTML="";
//	  alert(phoneMonthly);

	 // var val1=document.getElementById('rentMonthly').value

	  if(  (rentMonthly=="" || rentMonthly.match(numericExpression)) && (phoneMonthly=="" || phoneMonthly.match(numericExpression)) && (insuranceMonthly=="" || insuranceMonthly.match(numericExpression)) &&
			   (ConversionRate=="" || ConversionRate.match(numericExpression))
			  && (electricityMonthly=="" || electricityMonthly.match(numericExpression)) && (carRegoMonthly=="" || carRegoMonthly.match(numericExpression))&&
			  (fuelMonthly=="" || fuelMonthly.match(numericExpression)) && (advertisingMonthly=="" || advertisingMonthly.match(numericExpression))&&
			  (wagsMonthly=="" || wagsMonthly.match(numericExpression))&& (paygMonthly=="" || paygMonthly.match(numericExpression))&&
			  (workersMonthly=="" || workersMonthly.match(numericExpression))&& (otherMonthly=="" || otherMonthly.match(numericExpression)) 
				&& (jobValue=="" || jobValue.match(numericExpression)) 
			  ){
		document.calcForm.submit();
		
		}else{				

			document.getElementById('errorMessage').innerHTML="Invalid input value" 
//				alert(document.getElementById('errorMessage').innerHTML);
			
//		val1.focus();
		return false;
	}
	

	
}
</script>
<center>
<form id="calcForm" name="calcForm" method="post"
	action="../calculation/formSubmit" class="form"><input type=hidden name=todo
	value=post> <input type="hidden" name="requestFrom" value="expense" />
<table style="text-align: left;" id="panelGrid" width="475px" class="tableStyle">
	<thead>
		<tr>
			<th scope="colgroup" colspan="3" style="text-align: left;">* All values are in $</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td>Time</td>
			<td>Yearly</td>
		</tr>
		<tr>
			<td>Rent</td>
			<td><select name="rentExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="rentMonthly" name="rentMonthly" type="text"
				value="<?php echo $rentMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td><select name="phoneExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="phoneMonthly" name="phoneMonthly" type="text"
				value="<?php echo $phoneMonthly; ?>" class="input" /></td>
		</tr>
		<tr>
			<td>Insurances Business etc</td>
			<td><select name="insuranceExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="insuranceMonthly" name="insuranceMonthly" type="text"
				value="<?php echo $insuranceMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Electricity / Gas</td>
			<td><select name="electricityExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="electricityMonthly" name="electricityMonthly"
				type="text" value="<?php echo $electricityMonthly; ?>"
				maxlength="8" class="input" /></td>
		</tr>
		<tr>
			<td>Car Rego &amp; Insurance</td>
			<td><select name="carRegoExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="carRegoMonthly" name="carRegoMonthly" type="text"
				value="<?php echo $carRegoMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Fuel</td>
			<td><select name="fuelExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="fuelMonthly" name="fuelMonthly" type="text"
				value="<?php echo $fuelMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Advertising YP etc</td>
			<td><select name="advertisingExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="advertisingMonthly" name="advertisingMonthly"
				type="text" value="<?php echo $advertisingMonthly; ?>"
				maxlength="8" class="input" /></td>
		</tr>
		<tr>
			<td>Wages</td>
			<td><select name="wagsExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="wagsMonthly" name="wagsMonthly" type="text"
				value="<?php echo $wagsMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>PAYG</td>
			<td><select name="paygExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="paygMonthly" name="paygMonthly" type="text"
				value="<?php echo $paygMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Workers Comp</td>
			<td><select name="workersExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="workersMonthly" name="workersMonthly" type="text"
				value="<?php echo $workersMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>Other</td>
			<td><select name="otherExpense" size="1">
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Yearly">Yearly</option>
			</select></td>
			<td><input id="otherMonthly" name="otherMonthly" type="text"
				value="<?php echo $otherMonthly; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td>(Job only) Material</td>
			<td></td>
			<td><input id="jobValue" name="jobValue" type="text"
				value="<?php echo $jobValue; ?>" maxlength="8"
				class="input" /></td>
		</tr>
		<tr>
			<td><input id="total" name="Total1" type="hidden"
				value="<?php echo $total; ?>" maxlength="8" class="input" />
				
				<input id="FixedCost" name="FixedCost" type="hidden"
				value="<?php echo $total; ?>" maxlength="8" class="input" />
				<input id="timePeriod" name="timePeriod" type="hidden"
				value="<?php echo $_REQUEST['timePeriod']; ?>" maxlength="8" class="input" />
				<input
				id="total1" name="Total11" type="hidden"
				value="<?php echo $Total1; ?>" maxlength="8"
				class="input" /><input id="TotalSale" name="TotalSale" type="hidden"
				value="<?php echo $_REQUEST['TotalSale']; ?>" maxlength="8"
				class="input" /><input id="CostofSale" name="CostofSale"
				type="hidden" value="<?php echo $_REQUEST['CostofSale']; ?>"
				maxlength="8" class="input" /><input id="AverageSale"
				name="AverageSale" type="hidden"
				value="<?php echo $_REQUEST['AverageSale']; ?>" maxlength="8"
				class="input" /><input id="ConversionRate" name="ConversionRate"
				type="hidden" value="<?php echo $_REQUEST['ConversionRate']; ?>"
				maxlength="8" class="input" />
				
				<input id="jobName" name="jobName"
				type="hidden" value="<?php echo $_REQUEST['jobName'];?>" />				
				</td>
		</tr>
		<tr>
			<td>
			<table>
				<tbody>
					<tr>
						<td><input type="button" id="expenseTotal" name="expenseTotal" 
							onclick="isNumeric()" value="Cal Total" class="buttonStyle" /></td>
					</tr>

				</tbody>
			</table>
			</td>
			<td>
			<table>
			</table>
			</td>
			<td>
			<table></table>
			</td>
		</tr>
	</tbody>

</table>
<table>
		<tr>
		<td>
		<div id="errorMessage" ></div> 
		</td>
		</tr>

</table>
</form>

</center>
</body>
</html>
