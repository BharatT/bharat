



<html>
<head>
<link rel="stylesheet" href='<?php echo base_url(); ?>css/webcalc.css'
	type="text/css" media="screen, projection" />
<title>Web Break Even Calc</title>
</head>
<body>
<center>

	<form id="_id0" method="post" action="<?php echo base_url().$urlValue?>" class="input" enctype="application/x-www-form-urlencoded">

		
				
					<center>
					
					</center>
				
			
		
				
								
			
			
			
			
				
				
			

			
		
				
				
			
			
			


			<table id="_id0:panelGrid" class="tableStyle">
<thead>
<tr><th colspan="2" scope="colgroup">Break Even Calc</th></tr>
</thead>
<tbody>
<tr>
<td>Login ID: </td>
<td><input id="_id0:ID" type="text" name="myusername" maxlength="10" /></td>
</tr>
<tr>
<td> Password: </td>
<td><input id="_id0:Password" type="password" name="mypassword" value="" maxlength="10" size="10" style="width: 136px; " /></td>
</tr>
<tr>
<td> Company Name: </td>
<td><input id="_id0:Company" type="text" name="mycompany" maxlength="10" /></td>
</tr>
<tr>
<td><div></div></td>
<td><input type="image" src='<?php echo base_url(); ?>images/login_button.gif' name="_id0:_id6" style="background-color: AliceBlue" /></td>
</tr>

</tbody>
</table>

		
		<table ><tr>
<td><?php echo $errorMessage?></td>
</tr></table>
		
	<input type="hidden" name="_id0" value="_id0" /></form>

</center>
</body>
</html>
