<html>
<head>
<link rel="stylesheet" href='<?php echo base_url(); ?>css/webcalc.css'
	type="text/css" media="screen, projection" />
<title>Calculation Test</title>
</head>
<body>
<script type="text/javascript">
function cancelEvent()
{
	var theForm=document.getElementById("calcForm");
//	alert(theForm);	
	  theForm.action = '../../breakeven';
//	this.action=;
//	window.location.href=';
	document.calcForm.submit();		
}
function expenseCalculation()
{  
	  var val1=document.calcForm.TotalSale.value ;
	  var val2=document.calcForm.CostofSale.value ;
	  var val3=document.calcForm.AverageSale.value ;
	  var val4=document.calcForm.ConversionRate.value ;
	//  var val5=document.calcForm.Total1.value
	  //// For radio button value to collect ///
//	  for(var i=0; i < document.calcForm.type.length; i++){
//	  if(document.form1.type[i].checked)
//	  var val4=document.form1.type[i].value 
//	  }
	  document.calcForm.action='<?php echo $expenseUrl;?>';
//		  /'+val1+'/'+val2+'/'+val3+'/'+val4+'';
		document.calcForm.submit();
	  

//		  window.location.href="expense.php?TotalSale=$totalSale";
}

	  
</script>
<center>
<form id="calcForm" name="calcForm" method="post"
	action="<?php echo $_REQUEST['urlValue'] ?>" 
	enctype="application/x-www-form-urlencoded" class="input"><input
	type=hidden name=todo value=get><input type="hidden" name="breakeven"
	value="even" /> <?php

	
	//validation
	//if(isset($_REQUEST['formsubmit'])){
	
	$error=false;
	$errorMsg="";
	function check_input($data,$problem){
		
		global $errorMsg;
		if(empty($data))
		{
			$price_error = 'Enter TotalSale';
			//echo $price_error;
			$errorMsg.= "$problem Require:";
			$error=true;
		}
		elseif(!is_numeric($data))
		{
			$price_error = 'TotalSale is invalid. Numbers only (eg: 123.45)';
			//echo $price_error;
			$errorMsg.= "$problem invalid: ";
			$error=true;
		}
		//}
		return $data;
	}





	// ... more code here


	$totalSale=check_input($_REQUEST['TotalSale'],'Total Sale ');
	$costofSale=check_input($_REQUEST['CostofSale'],'Cost of Sale ');
	$averageSale=check_input($_REQUEST['AverageSale'],'Average Sale ');
	$conversionRate=check_input($_REQUEST['ConversionRate'],'Conversion Rate ');
	$fixedCost=check_input($_REQUEST['FixedCost'],'Fixed Cost');
	$timePeriod=$_REQUEST['timePeriod'];

	$total=$fixedCost;
//	$breakeven=$_REQUEST['breakeven'];

	$requestFrom=$_REQUEST['requestFrom'];
	echo $requestFrom;
	//	if (strcmp($requestFrom,"expense") == 0) {
	//	$total=$_REQUEST['Total'];
	//	echo $total;
	//	}
	//$total=$_REQUEST['Total'];
	//print ($total);
	//Parse the query portion of the url into an assoc. array
	//$url_parts = parse_url($url);
	//	parse_str($url_parts['query'], $path_parts);
	//	echo $path_parts['TotalSale'];
	//Break even calculation
	//	if (strcmp($breakeven,"even") == 0) {
		
	//if(isset($_REQUEST['formsubmit']))
	//	{
	$grossIncome =grossIncomeC($totalSale, $costofSale);
	$grossMargin = grossMarginD($grossIncome, $totalSale);
	$fixedcostQuerterly = round(fixedcostQuarterlyE($fixedCost));
	$fixedcostMonthly = round(fixedcostMonthlyE($fixedCost));
	$fixedcostWeekly =round(fixedcostWeeklyE($fixedCost));
	$fixedcostDaily = round(fixedcostDailyE($fixedcostWeekly));
	$grossmarginYearly =round(grossmarginYearlyE($grossMargin));
	$grossmarginQuerterly =round( grossmarginQuarterlyE($grossMargin),2);
	$grossmarginMonthly = round(grossmarginMonthlyE($grossMargin),2);
	$grossmarginWeekly = round(grossmarginWeeklyE($grossMargin),2);
	$grossmarginDaily = round(grossmarginDailyE($grossmarginWeekly),2);

	$breakevenSalesYearly = round(breakevenSalesYearlyF($fixedCost,$grossMargin));
	$breakevenSalesfixedcostQuerterly =round(breakevenSalesQuarterlyF($breakevenSalesYearly));
	$breakevenSalesfixedcostMonthly = round(breakevenSalesMonthlyF($breakevenSalesYearly));
	$breakevenSalesfixedcostWeekly = round(breakevenSalesWeeklyF($breakevenSalesYearly));
	$breakevenSalesfixedcostDaily = round(breakevenSalesDailyF($breakevenSalesfixedcostWeekly));
	$eventransactionYearly =round(eventransactionYearlyH($breakevenSalesYearly,$averageSale),1);
	$eventransactionQuerterly = round(eventransactionQuarterlyH($eventransactionYearly),2);
	$eventransactionMonthly = round(eventransactionMonthlyH($eventransactionYearly),2);
	$eventransactionWeekly =round( eventransactionWeeklyH($eventransactionYearly),2);
	$eventransactionDaily = round(eventransactionDailyH($eventransactionYearly),2);
	$leadsYearly = round(leadsYearlyJ($eventransactionYearly,$conversionRate),1);
	$leadsQuerterly =round (leadsQuarterlyJ($leadsYearly),2);
	$leadsMonthly = round(leadsMonthlyJ($leadsYearly),2);
	$leadsWeekly = round(leadsWeeklyJ($leadsYearly),2);
	$leadsDaily = round(leadsDailyJ($leadsYearly),2);

	$netProfit = round(netProfitK($grossIncome,$fixedCost),2);
	$percentagenetProfit = round(netProfitL($netProfit,$totalSale));

		//}		
	function grossIncomeC($totalSale,$costofSale){
		$grossIncome=$totalSale-$costofSale;
		return $grossIncome;
	}

	function grossMarginD($grossIncome, $totalSale){
		if($totalSale<=0)return 0;
		$grossMargin=$grossIncome/$totalSale*100;
		return $grossMargin;

	}
	function  fixedcostQuarterlyE($fixedCost)
	{

		$fixedcostQuerterly=$fixedCost/4;
		return $fixedcostQuerterly;

	}
	function  fixedcostMonthlyE($fixedCost)
	{

		$fixedcostMonthly=$fixedCost/12;
		return $fixedcostMonthly;

	}
	function  fixedcostWeeklyE($fixedCost)
	{

		$fixedcostWeekly=$fixedCost/51;
		return $fixedcostWeekly;

	}
	function fixedcostDailyE($fixedcostWeekly)
	{

		$fixedcostDaily=$fixedcostWeekly/5;
		return $fixedcostDaily;

	}

	//gross margin
	function  grossmarginYearlyE($grossmargin)
	{

		$grossmarginYearly=$grossmargin;
		return $grossmarginYearly;

	}
	function  grossmarginQuarterlyE($grossmargin)
	{

		$grossmarginQuerterly=$grossmargin/4;
		return $grossmarginQuerterly;

	}
	function  grossmarginMonthlyE($grossmargin)
	{

		$grossmarginMonthly=$grossmargin/12;
		return $grossmarginMonthly;

	}
	function  grossmarginWeeklyE($grossmargin)
	{

		$grossmarginWeekly=$grossmargin/52;
		return $grossmarginWeekly;

	}
	function  grossmarginDailyE($grossmarginWeekly)
	{

		$grossmarginDaily=$grossmarginWeekly/5;
		return $grossmarginDaily;

	}

	//breakevensales
	function breakevenSalesYearlyF($fixedCost,$grossMargin)
	{
		if($fixedCost<=0 || $grossMargin==0)return 0;
		$breakevenSalesYearly=$fixedCost/$grossMargin*100;
		return $breakevenSalesYearly;

	}
	function breakevenSalesQuarterlyF($breakevenSalesYearly)
	{

		$breakevenSalesfixedcostQuerterly=$breakevenSalesYearly/4;
		return $breakevenSalesfixedcostQuerterly;

	}
	function breakevenSalesMonthlyF($breakevenSalesYearly)
	{

		$breakevenSalesfixedcostMonthly=$breakevenSalesYearly/12;
		return $breakevenSalesfixedcostMonthly;

	}
	function breakevenSalesWeeklyF($breakevenSalesYearly)
	{

		$breakevenSalesfixedcostWeekly=$breakevenSalesYearly/51;
		return $breakevenSalesfixedcostWeekly;

	}
	function breakevenSalesDailyF($breakevenSalesfixedcostWeekly)
	{

		$breakevenSalesfixedcostDaily=$breakevenSalesfixedcostWeekly/5;
		return $breakevenSalesfixedcostDaily;

	}

	///average tranction
	function eventransactionYearlyH($breakevenSalesYearly,$averageSale)
	{
		if($averageSale<=0)return 0;
		$eventransactionYearly=$breakevenSalesYearly/$averageSale;
		return $eventransactionYearly;

	}
	function eventransactionQuarterlyH($eventransactionYearly)
	{

		$eventransactionQuerterly=$eventransactionYearly/4;
		return $eventransactionQuerterly;

	}
	function eventransactionMonthlyH($eventransactionYearly)
	{

		$eventransactionMonthly=$eventransactionYearly/12;
		return $eventransactionMonthly;

	}
	function eventransactionWeeklyH($eventransactionYearly)
	{

		$eventransactionWeekly=$eventransactionYearly/52;
		return $eventransactionWeekly;

	}
	function eventransactionDailyH($eventransactionYearly)
	{

		$eventransactionDaily=$eventransactionYearly/52;
		return $eventransactionDaily;

	}
	//leads require


	function leadsYearlyJ($eventransactionYearly,$conversionRate)
	{
		if($conversionRate<=0)return 0;
		$leadsYearly=$eventransactionYearly/$conversionRate*100;
		return $leadsYearly;

	}
	function leadsQuarterlyJ($leadsYearly)
	{

		$leadsQuerterly=$leadsYearly/4;
		return $leadsQuerterly;

	}
	function leadsMonthlyJ($leadsYearly)
	{

		$leadsMonthly=$leadsYearly/12;
		return $leadsMonthly;

	}
	function leadsWeeklyJ($leadsYearly)
	{

		$leadsWeekly=$leadsYearly/52;
		return $leadsWeekly;

	}
	function leadsDailyJ($leadsYearly)
	{

		$leadsDaily=$leadsYearly/52;
		return $leadsDaily;

	}
	//Net profit

	function netProfitK($grossIncome,$fixedCost)
	{

		$netProfit=$grossIncome-$fixedCost;
		return $netProfit;

	}
	//Net profit %
	function netProfitL($netProfit,$totalSale)
	{
		if($totalSale<=0){


			return 0;
		}
		$percentagenetProfit=$netProfit/$totalSale*100;
		return $percentagenetProfit;

	}
			
	//	}
	// Database Connection

	if(isset($_REQUEST['SaveRecord']))
	{
		$con = mysql_connect("localhost:3306","root","root");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		//	$date = date("Y-m-d"); ;
		//echo "$dt1";
		mysql_select_db("mysql", $con);
		echo mysql_errno($con) . ": " . mysql_error($con). "\n";

		$sql="INSERT INTO break_even_data2 (be_total_sale, be_cost_sale, be_fix_cost,be_avg_sale,be_conv_rate,be_create_by)
	VALUES
	('$totalSale','$costofSale','$fixedCost','$averageSale','$conversionRate','alpesh')";

		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		echo "save record";

		mysql_close($con);
	}


	// Expense Total Calculation
	if (strcmp($requestFrom,"expense") == 0) {
	$rentMonthly=$_REQUEST['rentMonthly'];
	$phoneMonthly=$_REQUEST['phoneMonthly'];
	$insuranceMonthly=$_REQUEST['insuranceMonthly'];
	$electricityMonthly=$_REQUEST['electricityMonthly'];
	$carRegoMonthly=$_REQUEST['carRegoMonthly'];
	$fuelMonthly=$_REQUEST['fuelMonthly'];
	$advertisingMonthly=$_REQUEST['advertisingMonthly'];
	$wagsMonthly=$_REQUEST['wagsMonthly'];
	$paygMonthly=$_REQUEST['paygMonthly'];
	$workersMonthly=$_REQUEST['workersMonthly'];
	$otherMonthly=$_REQUEST['otherMonthly'];

	//expense
	$rentExpense=$_REQUEST['rentExpense'];
	$phoneExpense=$_REQUEST['phoneExpense'];
	$insuranceExpense=$_REQUEST['insuranceExpense'];
	$electricityExpense=$_REQUEST['electricityExpense'];
	$carRegoExpense=$_REQUEST['carRegoExpense'];
	$fuelExpense=$_REQUEST['fuelExpense'];
	$advertisingExpense=$_REQUEST['advertisingExpense'];
	$wagsExpense=$_REQUEST['wagsExpense'];
	$paygExpense=$_REQUEST['paygExpense'];
	$workersExpense=$_REQUEST['workersExpense'];
	$otherExpense=$_REQUEST['otherExpense'];
	
	$rentYearly = calculateExpenseRent($rentMonthly, $rentExpense);
	echo $rentYearly;
	$phoneYearly =calculateExpensePhone($phoneMonthly, $phoneExpense);
	$insuranceYearly=calculateExpenseInsurance($insuranceMonthly, $insuranceExpense);
	$electricityYearly =calculateExpenseElectricity($electricityMonthly,$electricityExpense);
	$carRegoYearly=calculateExpenseCarRego($carRegoMonthly, $carRegoExpense);
	$fuelYearly =calculateExpenseFuel($fuelMonthly, $fuelExpense);
	$advertisingYearly = calculateExpenseAdvertising($advertisingMonthly,
	$advertisingExpense);
	$wagsYearly =calculateExpenseWags($wagsMonthly, $wagsExpense);
	$paygYearly =calculateExpensePayg($paygMonthly, $paygExpense);
	$workersYearly=calculateExpenseWorkers($workersMonthly, $workersExpense);
	$otherYearly = calculateExpenseOther($otherMonthly, $otherExpense);

	echo $requestFrom;
	
		$total = totalYearly($rentYearly, $phoneYearly,
		$insuranceYearly, $electricityYearly, $carRegoYearly,
		$fuelYearly, $advertisingYearly, $wagsYearly, $paygYearly,
		$workersYearly, $otherYearly);
		echo $total;

	//echo $total;
	//	echo "$wagsYearly <br> ";
	//	echo "$paygYearly <br> ";
	//	echo "$advertisingYearly <br> ";
	//	echo "$workersYearly <br> ";
	//	echo "$otherYearly <br> ";

	//	echo "$phoneYearly; <br> ";
	//$total=$_GET['Total'];

	//echo "$total <br>";
	//$total=$_GET['Total'];

	}
	//End of expense condition

	function  calculateExpenseRent($rentMonthly,$rentExpense) {
		$calculatedRent = $rentMonthly;
		if ($rentExpense=="Weekly") {
			$calculatedRent = $rentMonthly * 52;
		} else if ($rentExpense=="Monthly") {
			$calculatedRent = $rentMonthly * 12;
		} else if ($rentExpense=="Quarterly") {
			$calculatedRent = $rentMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpensePhone($phoneMonthly,$phoneExpense) {
		$calculatedRent = $phoneMonthly;
		if ($phoneExpense=="Weekly") {
			$calculatedRent = $phoneMonthly * 52;
		} else if ($phoneExpense=="Monthly") {
			$calculatedRent = $phoneMonthly * 12;
		} else if ($phoneExpense=="Quarterly") {
			$calculatedRent = $phoneMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseInsurance($insuranceMonthly,$insuranceExpense) {
		$calculatedRent = $insuranceMonthly;
		if ($insuranceExpense=="Weekly") {
			$calculatedRent = $insuranceMonthly * 52;
		} else if ($insuranceExpense=="Monthly") {
			$calculatedRent = $insuranceMonthly * 12;
		} else if ($insuranceExpense=="Quarterly") {
			$calculatedRent = $insuranceMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseElectricity($electricityMonthly,$electricityExpense) {
		$calculatedRent = $electricityMonthly;
		if ($electricityExpense=="Weekly") {
			$calculatedRent = $electricityMonthly * 52;
		} else if ($electricityExpense=="Monthly") {
			$calculatedRent = $electricityMonthly * 12;
		} else if ($electricityExpense=="Quarterly") {
			$calculatedRent = $electricityMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseCarRego($carRegoMonthly,$carExpense) {
		$calculatedRent = $carRegoMonthly;
		if ($carExpense=="Weekly") {
			$calculatedRent = $carRegoMonthly * 52;
		} else if ($carExpense=="Monthly") {
			$calculatedRent = $carRegoMonthly * 12;
		} else if ($carExpense=="Quarterly") {
			$calculatedRent = $carRegoMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseFuel($fuelMonthly,$fuelExpense) {
		$calculatedRent = $fuelMonthly;
		if ($fuelExpense=="Weekly") {
			$calculatedRent = $fuelMonthly * 52;
		} else if ($fuelExpense=="Monthly") {
			$calculatedRent = $fuelMonthly * 12;
		} else if ($fuelExpense=="Quarterly") {
			$calculatedRent = $fuelMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseAdvertising($advertisingMonthly,$advertisingExpense) {
		$calculatedRent = $advertisingMonthly;
		if ($advertisingExpense=="Weekly") {
			$calculatedRent = $advertisingMonthly * 52;
		} else if ($advertisingExpense=="Monthly") {
			$calculatedRent = $advertisingMonthly * 12;
		} else if ($advertisingExpense=="Quarterly") {
			$calculatedRent = $advertisingMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseWags($wagsMonthly,$wagsExpense) {
		$calculatedRent = $wagsMonthly;
		if ($wagsExpense=="Weekly") {
			$calculatedRent = $wagsMonthly * 52;
		} else if ($wagsExpense=="Monthly") {
			$calculatedRent = $wagsMonthly * 12;
		} else if ($wagsExpense=="Quarterly") {
			$calculatedRent = $wagsMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpensePayg($paygMonthly,$paygExpense) {
		$calculatedRent = $paygMonthly;
		if ($paygExpense=="Weekly") {
			$calculatedRent = $paygMonthly * 52;
		} else if ($paygExpense=="Monthly") {
			$calculatedRent = $paygMonthly * 12;
		} else if ($paygExpense=="Quarterly") {
			$calculatedRent = $paygMonthly * 4;
		}
		return $calculatedRent;
	}
	function  calculateExpenseWorkers($workersMonthly,$workersExpense) {
		$calculatedRent = $workersMonthly;
		if ($workersExpense=="Weekly") {
			$calculatedRent = $workersMonthly * 52;
		} else if ($workersExpense=="Monthly") {
			$calculatedRent = $workersMonthly * 12;
		} else if ($workersExpense=="Quarterly") {
			$calculatedRent = $workersMonthly * 4;
		}
		return $calculatedRent;
	}
	function calculateExpenseOther($otherMonthly, $otherExpense) {
		$calculatedRent = $otherMonthly;
		if ($otherExpense=="Weekly") {
			$calculatedRent = $otherMonthly * 52;
		} else if ($otherExpense=="Monthly") {
			$calculatedRent = $otherMonthly * 12;
		} else if ($otherExpense=="Quarterly") {
			$calculatedRent = $otherMonthly * 4;
		}
		return $calculatedRent;
	}

	function  totalYearly($rentYearly, $phoneYearly,
	$insuranceYearly, $electricityYearly, $carRegoYearly,
	$fuelYearly, $advertisingYearly, $wagsYearly, $paygYearly,
	$workersYearly, $otherYearly) {
		$total = $rentYearly + $phoneYearly + $insuranceYearly + $electricityYearly
		+ $carRegoYearly + $fuelYearly + $advertisingYearly + $wagsYearly + $paygYearly
		+ $workersYearly + $otherYearly;
		return $total;
	}
	function  calculateExpense($rentMonthly,$rentExpense) {
		$calculatedRent = $rent;
		if ("Weekly"==$expenseType) {
			$calculatedRent = $rent * 52;
		} else if ("Monthly"==$expenseType) {
			$calculatedRent = $rent * 12;
		} else if ("Quarterly"==$expenseType) {
			$calculatedRent = $rent * 4;
		}
		return $calculatedRent;
	}

	
	//validation



	?>
<table id="panelGrid" width="475px"
	style="width: 1029px; border-bottom-width: medium; border-bottom-style: double; border-top-style: double; border-left-color: #606060; border-top-color: #606060; border-right-color: #606060; border-left-style: double; border-right-width: medium; border-right-style: double; border-left-width: medium; border-bottom-color: #606060; border-top-width: medium; background-color: #ebf3fd">
	<thead>
		<tr>
			<th scope="colgroup" colspan="1"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			<a href="<?php echo $logoutUrl;?>"  id="_id0:_id6" style="color: #0000A0; font-size:12px">Logout</a>			
			<input type="hidden" name="requestFrom" value="calcForm" />
			<table border="2" width="475px"
				style="width: 1010px; background-color: #ebf3fd; height: 269px">
				<tbody>
					<tr>
						<td>Name:-</td>
						<td>alpesh</td>
						<td>Company Name:-</td>
						<td>alpesh</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">TOTAL SALE $</span></td>
						<td><input id="TotalSale" name="TotalSale" type="text"
							value="<?php echo $_REQUEST['TotalSale']; ?>" maxlength="8"
							class="inputBaox" tabindex="1" /></td>
						<td></td>
						<td><span style="font-size: 13px">TIME PERIOD: </span></td>
						<td><input id="timePeriod" name="timePeriod" type="text"
							value="<?php echo $_REQUEST['timePeriod']; ?>" class="inputBaox"
							tabindex="2" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">COST OF SALE $</span></td>
						<td><input id="CostofSale" name="CostofSale" type="text"
							value="<?php echo $_REQUEST['CostofSale']; ?>" maxlength="8"
							tabindex="3" /></td>
						<td></td>
						<td><span style="font-size: 13px">GROSS INCOME $</span></td>
						<td><input id="agrossIncome" name="agrossIncome" type="text"
							value="<?php echo $grossIncome; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">AVERAGE SALE $</span></td>
						<td><input id="AverageSale" name="AverageSale" type="text"
							value="<?php echo $_REQUEST['AverageSale']; ?>" maxlength="8"
							tabindex="4" /></td>
						<td></td>
						<td><span style="font-size: 13px">GROSS MARGIN $</span></td>
						<td><input id="grossMargin" name="grossMargin" type="text"
							value="<?php echo $grossMargin; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">CONVERSION RATE $</span></td>
						<td><input id="ConversionRate" name="ConversionRate" type="text"
							value="<?php echo $_REQUEST['ConversionRate']; ?>" maxlength="8"
							tabindex="5" /></td>
						<td></td>
						<td><span style="font-size: 13px">NET PROFIT $</span></td>
						<td><input id="netProfit" name="netProfit" type="text"
							value="<?php echo $netProfit; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">NET PROFIT%</span></td>
						<td><input id="percentagenetProfit" name="percentagenetProfit"
							type="text" value="<?php echo $percentagenetProfit; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table border="0">
				<tbody>
					<tr>
						<?php if(!$cancelButton)
											
						echo '<td><input id="expenses" name="Expenses" type="button"
							value="Expenses" onclick="expenseCalculation()"
							style="width: 85px;" class="buttonStyle" /></td>
						<td><input id="breakeven" name="formsubmit" type="submit"
							value="BreakEven" style="width: 105px;" class="buttonStyle" /></td>
						<td> <input id="saveRecord" name="SaveRecord" type="submit"
							value="Save" style="width: 83px;" class="buttonStyle"/> </td>'
						?>
						
						<?php if($cancelButton)
							echo ' <td> <input id="cancelButton" name="cancelButton" onclick="cancelEvent()" 
							value="Cancel" style="width: 83px;" class="buttonStyle" type="button"/>
							</td>'
						?>
						
						<td style="border: 0" >
						<span style="font-size: 8pt; color:#FF0000"><?php echo $errorMsg;?></span>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td>
			<table border="2" width="475px"
				style="width: 1010px; background-color: #ebf3fd; height: 291px">
				<tbody>
					<tr>
						<td></td>
						<td><span style="font-size: 12px">YEARLY</span></td>
						<td><span style="font-size: 12px">QUARTERLY</span></td>
						<td><span style="font-size: 12px">MONTHLY</span></td>
						<td><span style="font-size: 12px">WEEKLY</span></td>
						<td><span style="font-size: 12px">DAILY</span></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">FIXED COST $</span></td>
						<td><input id="FixedCost" name="FixedCost" type="text"
							value="<?php echo $total; ?>" maxlength="10" tabindex="6" /></td>
						<td><input id="fixedcostQuerterly" name="fixedcostQuerterly"
							type="text" value="<?php echo $fixedcostQuerterly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="fixedcostMonthly" name="fixedcostMonthly"
							type="text" value="<?php echo $fixedcostMonthly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="fixedcostWeekly" name="fixedcostWeekly" type="text"
							value="<?php echo $fixedcostWeekly; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
						<td><input id="fixedcostDaily" name="fixedcostDaily" type="text"
							value="<?php echo $fixedcostDaily; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
					</tr>

					<tr>
						<td><span style="font-size: 13px">GROSS MARGIN $</span></td>
						<td><input id="grossmarginYearly" name="grossmarginYearly"
							type="text" value="<?php echo $grossmarginYearly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="grossmarginQuerterly" name="grossmarginQuerterly"
							type="text" value="<?php echo $grossmarginQuerterly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="grossmarginMonthly" name="grossmarginMonthly"
							type="text" value="<?php echo $grossmarginMonthly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="grossmarginWeekly" name="grossmarginWeekly"
							type="text" value="<?php echo $grossmarginWeekly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="grossmarginDaily" name="grossmarginDaily"
							type="text" value="<?php echo $grossmarginDaily; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">BREAK EVEN $</span></td>
						<td><input id="breakevenSalesYearly" name="breakevenSalesYearly"
							type="text" value="<?php echo $breakevenSalesYearly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="breakevenSalesfixedcostQuerterly"
							name="breakevenSalesfixedcostQuerterly" type="text"
							value="<?php echo $breakevenSalesfixedcostQuerterly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="breakevenSalesfixedcostMonthly"
							name="breakevenSalesfixedcostMonthly" type="text"
							value="<?php echo $breakevenSalesfixedcostMonthly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="breakevenSalesfixedcostWeekly"
							name="breakevenSalesfixedcostWeekly" type="text"
							value="<?php echo $breakevenSalesfixedcostWeekly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="breakevenSalesfixedcostDaily"
							name="breakevenSalesfixedcostDaily" type="text"
							value="<?php echo $breakevenSalesfixedcostDaily; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">BREAK TRANSCTION $</span></td>
						<td><input id="eventransactionYearly" name="eventransactionYearly"
							type="text" value="<?php echo $eventransactionYearly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="eventransactionQuerterly"
							name="eventransactionQuerterly" type="text"
							value="<?php echo $eventransactionQuerterly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="eventransactionMonthly"
							name="eventransactionMonthly" type="text"
							value="<?php echo $eventransactionMonthly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="eventransactionWeekly" name="eventransactionWeekly"
							type="text" value="<?php echo $eventransactionWeekly; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
						<td><input id="eventransactionDaily" name="eventransactionDaily"
							type="text" value="<?php echo $eventransactionDaily; ?>"
							readonly="readonly" style="background-color: #ebf3fd"
							disabled="disabled" /></td>
					</tr>
					<tr>
						<td><span style="font-size: 13px">LEADS REQUIRED</span></td>
						<td><input id="leadsYearly" name="leadsYearly" type="text"
							value="<?php echo $leadsYearly; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
						<td><input id="leadsQuerterly" name="leadsQuerterly" type="text"
							value="<?php echo $leadsQuerterly ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
						<td><input id="leadsMonthly" name="leadsMonthly" type="text"
							value="<?php echo $leadsMonthly; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
						<td><input id="leadsWeekly" name="leadsWeekly" type="text"
							value="<?php echo $leadsWeekly; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
						<td><input id="leadsDaily" name="leadsDaily" type="text"
							value="<?php echo $leadsDaily; ?>" readonly="readonly"
							style="background-color: #ebf3fd" disabled="disabled" /></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</form>
</center>


</body>
</html>


	