<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href='<?php echo base_url(); ?>css/webcalc.css'
	type="text/css" media="screen, projection" />
	
<title>Break Even List</title>
</head>
<body><form action="" method="post">

<h1 align="center">
</h1>
		<table id="_id0:panelGrid" style="width: 70%; right: 80%" width="475px">



<tbody>



<tr>



<td><span class="input"></span></td>



<td></td>



<td></td>



<td></td>



</tr>



</tbody>



</table>
		<table id="_id0:body" 

		style="height: auto; width: auto; border-bottom-style: solid; border-bottom-width: thick; border-top-style: solid; border-left-style: solid; border-right-width: thick; border-right-style: solid; border-left-width: thick; border-top-width: thick; border-left-color: LightSlateGray; border-top-color: LightSlateGray; border-right-color: LightSlateGray; border-bottom-color: LightSlateGray; background-attachment: fixed; background-color: #ebf3fd; background-position: center center; font-family: Verdana; font-size: 10px">



<tbody>



<tr>



<td>





<a href="login/logout"  id="_id0:_id6" style="color: #0000A0; font-size:12px">Logout</a></td>



</tr>



<tr>



<td>



<table id="_id0:data" border="10" cellpadding="5" cellspacing="3" frame="hsides" width="50%" style="height: auto; width: auto; border-bottom-style: none; border-bottom-width: thick; border-top-style: none; border-left-style: none; border-right-width: thick; border-right-style: none; border-left-width: thick; border-top-width: thick; border-left-color: #400040; border-top-color: #400040; border-right-color: #400040; border-bottom-color: #400040; background-attachment: fixed; background-color: #ebf3fd; background-position: center center" class="tableStyle">




<?php echo $this->table->generate($results); ?>
</table>
</td>
</tr>



</tbody>



</table>
<table>
<tr>
<td>
<?php echo $this->pagination->create_links(); ?>
</td></tr>
</table>


</form>
</body>
</html>
