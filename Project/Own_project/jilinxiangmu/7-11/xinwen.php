<?php
	include("inc/inc.php");
	$action=$_GET["action"];
	
	if($action=="insert"){
		
		$caTitle=$_POST["caTitle"];
		$ccFid=$_POST["ccFid"];
		$ccSid=$_POST["ccSid"];
		$caWebUrl=$_POST["caWebUrl"];
		$caSource=$_POST["caSource"];
		$ccJizhe=$_POST["ccJizhe"];
		$ccImg=$_FILES["ccImg"];
		
		
		$extName=end(explode(".",$ccImg["name"]));
		//判断文件类型：
		if($extName != "jpg" && $extName != "png" && $extName != "gif" ){
			echo "图片类型不对";
			exit;	
		}
		//判断文件类型
		if($ccImg["size"]>6000000){
			echo "图像太大";
			exit;	
		}
		$filePath = "upload/".date("Ymd")."/";  //is_dir($filePath) 存在 true 不存在 false
		if(!is_dir($filePath)){
			mkdir($filePath); //创建目录
		}
		$fileName=$filePath.time().rand(100000,999999).rand(100000, 999999).".".$extName;
		move_uploaded_file($ccImg["tmp_name"], $fileName);
		
		$ccNeirong=$_POST["ccNeirong"];
		$caData= date("Y-m-d H:i:s");
		
		$sql="insert into cms_data(caTitle,caWebUrl,caSource,caDate,caNeirong,caJizhe,ccFid,ccSid,caImg)";
		$sql.="values('{$caTitle}','{$caWebUrl}','{$caSource}','{$caData}','{$ccNeirong}','{$ccJizhe}',{$ccFid},{$ccSid},'{$fileName}')";         
		?>
		<script>
			location.href="xinwenliebiao.php";
		</script>
		<?php
		mysql_query($sql);
		
	}else if($action=="delete"){
		$caId=$_GET["caId"];
		$sql="select caImg from cms_data where caId=".$caId;
		$result=mysql_query($sql);
		$rs=mysql_fetch_assoc($result);
		if(is_file($rs["caImg"])){
			unlink($rs["caImg"]);
		}
		$sql_0="delete from cms_data where caId=".$caId;
		?>
		<script>
			alert("删除成功");
			location.href="xinwenliebiao.php";
		</script>
		<?php
		mysql_query($sql_0);
	}else if($action=="updata"){
		$caId=$_GET["caId"];
		$caTitle=$_POST["caTitle"];
		$ccFid=$_POST["ccFid"];
		$ccSid=$_POST["ccSid"];
		$caWebUrl=$_POST["caWebUrl"];
		$caSource=$_POST["caSource"];
		$ccJizhe=$_POST["ccJizhe"];
		$ccNeirong=$_POST["ccNeirong"];
		$caData= date("Y-m-d H:i:s");
		
		$ccImg=$_FILES["ccImg"];
		
		if(strlen($ccImg["name"])>0){//判断一下图片是否有更改
			$sql_1="select * from cms_data where caId=".$caId;
			$result_1=mysql_query($sql_1);
			$rs_1=mysql_fetch_assoc($result_1);
			if(is_file($rs_1["caImg"])){//判断一下图片是否存在
				unlink($rs_1["caImg"]);
			}
			
			$newname=end(explode(".", $ccImg["name"]));//截取后缀名
			if($newname!="jpg" && $newname!="png" && $newname!="gif"){
				echo "图片类型不对，请重新上传";
				exit;
			}
			if($ccImg["size"]>6000000){
				echo "图像太大";
				exit;	
			}
			$filePath = "upload/".date("Ymd")."/";  //is_dir($filePath) 存在 true 不存在 false
			if(!is_dir($filePath)){
				mkdir($filePath); //创建目录
			
			}
			$fileName=$filePath.time().rand(100000,999999).rand(100000, 999999).".".$newname;
			move_uploaded_file($ccImg["tmp_name"], $fileName);
			
		}else{
			$sql_0="select caImg from cms_data where caId=".$caId;
			$result_0=mysql_query($sql_0);
			$rs_0=mysql_fetch_assoc($result_0);
			$fileName=$rs_0["caImg"];
		}
		
		$sql="update cms_data set caTitle='{$caTitle}', caWebUrl='{$caWebUrl}',caSource='{$caSource}',caDate='{$caData}',caNeirong='{$ccNeirong}',caJizhe='{$ccJizhe}',ccFid={$ccFid},ccSid={$ccSid},caImg='{$fileName}' where caId=".$caId;
		?>
		<script>
			alert("修改成功");
			location.href="xinwenliebiao.php";
		</script>
		<?php
		mysql_query($sql);
		
	}
	
	
	
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     