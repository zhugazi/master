<?php
	include("inc/inc.php");
	$ccFid = $_GET["ccFid"];
	$sql = "select * from data_list where dataNum=".$ccFid;
	$result = mysql_query($sql);
	?>
	<option value="-1">请选择子类型</option>
	<?php
	while($rs = mysql_fetch_assoc($result)){
	?>
	<option value="<?php echo $rs["dataId"]?>"><?php echo $rs["dataName"]?></option>
	<?php
	}
 
?>                                                                                                                                                                                                                                                                                                                                                          