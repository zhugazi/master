<?php
	include("inc/inc.php");
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻列表</title>
</head>
<body>
	<table align="center" cellpadding="0" cellspacing="0"width="90%" border="1">
		<tr height="40"><td colspan="9" align="center">新闻列表</td></tr>
		<tr height="30">
			<td align="center">标题</td>
			<td align="center">来源网址</td>
			<td align="center">来源媒体</td>
			<td align="center">日期</td>			
			<td align="center">记者</td>
			<td align="center">类型</td>			
			<td align="center">文章图片</td>
			<td align="center">操作</td>
		</tr>
		<?php
			$sql_0 = "select * from cms_data where caId";
			$result_0 = mysql_query($sql_0);
			$count = mysql_num_rows($result_0);
			
			$pagesize=2;
			$yeshu=ceil($count/$pagesize);
			
			if(isset($_GET["page"])){
				$page=$_GET["page"];
				if($page>$yeshu){$page=$yeshu;};
				if($page<1){$page=1;};
			}else{
				$page=1;
			}
			$start=($page-1)*$pagesize;
			
			$sql="select ca.caId, ca.caTitle,ca.caWebUrl,ca.caSource,ca.caDate,ca.caJizhe,ca.caImg,cc.dataName as cn,ccs.dataName as cns from cms_data as ca ";
			$sql.="left join data_list as cc on ca.ccFid=cc.dataId";
			$sql.=" left join data_list as ccs on ca.ccSid=ccs.dataId";
			$sql.=" limit {$start},{$pagesize}";
			$result=mysql_query($sql);
			
			
			/*echo $sql_0;
			exit;*/
			//$sql_0="select * from cms_data where caId limit {$start},{$pagesize}";
			
			//echo $sql;
			//exit;
			while($rs=mysql_fetch_assoc($result)){
		?>
		<tr align="center" height="55">
			<td width="120" align="center"><?php echo $rs["caTitle"] ?></td>
			<td width="180" align="center"><?php echo $rs["caWebUrl"] ?></td>
			<td width="120" align="center"><?php echo $rs["caSource"] ?></td>
			<td width="180" align="center"><?php echo $rs["caDate"] ?></td>
			<td width="120" align="center"><?php echo $rs["caJizhe"] ?></td>
			<td width="180" align="center">
				<?php echo $rs["cn"] ?>>><?php echo $rs["cns"] ?>
			</td>
			<td width="120" align="center"><img src="<?php echo $rs['caImg']; ?>" width='80' style='margin-top:1px; display:block;'/></td>
			<td width="180" align="center">
				<a href="xinwen.php?action=delete&caId=<?php echo $rs["caId"] ?>">删除</a>
					|
				<a href="xinwenupdata.php?action=updata&caId=<?php echo $rs["caId"] ?>">修改</a>
			</td>
		</tr>
		<?php
		}
		?>
		<tr height="30">
			<td colspan="8" align="right">
				共<?php echo $yeshu?>页/第<?php echo $page?>页
				<a href="?page=<?php echo 1 ?>">首页</a>  
				|
				<a href="?page=<?php echo $page-1?>">上一页</a>
				|
				<?php
					if($page<5){
						for($i=1;$i<=10;$i++){
							if($i==$yeshu){
								?>
								<a href="?page=<?php echo $i?>"><?php echo $i?></a>
								<?php
								break;
							}
							?>
							<a href="?page=<?php echo $i?>"><?php echo $i?></a>
							<?php
						}
					}else{
						for($i=$page-4;$i<=$page+5;$i++){
							if($i==$yeshu){
								?>
								<a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
								<?php
								break;
							}
						?>
						<a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
						<?php
							
						}
					}
				?>
				|
				<a href="?page=<?php echo $page+1 ?>">下一页</a>
				|
				<a href="?page=<?php echo $yeshu?>">尾页</a>
			</td>
		</tr>
	</table>
</body>
</html>                                                                                                                                    