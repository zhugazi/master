<?php
	include("../inc/inc.php")
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻列表</title>
</head>
<body>
	<table align="center" cellpadding="0" cellspacing="0"width="90%" border="1">
		<tr><td colspan="9" align="center">新闻列表</td></tr>
		<tr>
			<td align="center">标题</td>
			<td align="center">来源网址</td>
			<td align="center">来源媒体</td>
			<td align="center">日期</td>			
			<td align="center">记者</td>
			<td align="center">类型</td>			
			<td align="center">文章图片</td>
		</tr>
		<?php
			$sql="select * from cms_data where caId";
			$result=mysql_query($sql);
			while($rs=mysql_fetch_assoc($result)){
		?>
		<tr height="35" align="center">
			<td align="center"><?php echo $rs["caTitle"] ?></td>
			<td align="center"><?php echo $rs["caWebUrl"] ?></td>
			<td align="center"><?php echo $rs["caSource"] ?></td>
			<td align="center"><?php echo $rs["caDate"] ?></td>
			<td align="center"><?php echo $rs["caJizhe"] ?></td>
			<td align="center"></td>
			<td align="center"><img src="../"<?php echo $rs['caImg']; ?>"/></td>
		</tr>
		<?php
		}
		?>
	</table>
</body>
</html>                                                                                                                                    