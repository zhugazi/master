<?php
    header("content-type:text/html;charset=utf-8");
	$host="localhost";
	$user="root";
	$pwd="";
	$dbname="1312a";
	$link=@mysql_connect($host,$user,$pwd,$dbname) or die("数据库连接错误:".mysql_error());
	mysql_query("set names utf8");
	mysql_select_db($dbname,$link);
?>
                                                                                                                                                                                                                                                    