<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="icon" href="title.ico">
	<title>提交结果</title>
	<!-- Bootstrap 核心 CSS 文件 --> 
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 --> 
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style type="text/css">
		@media (min-width: 1200px) {
		  .container {
		    width: 700px;
		  }

		}
		


		.container{
			text-align: center;
		}
		.container a{

			margin-top: 100px;
			width: 200px;
		    padding: 10px 20px;
		    text-align: center;
		    border-radius: 30px;


		    display: inline-block;
		    padding: 5px 14px;
		    background-color: #fff;
		    border: 1px solid #ddd;
		    border-radius: 15px;
		  }

		}
		}
	</style>
</head>
<body>

	
		<!--下面这段是获取输入数据，然后再将其插入数据库中-->
		 <?php 
	 	//获得输入信息
	 	$name = $_POST["name"];
	 	$address = $_POST["address"];
	 	$zip = $_POST["zip"];

	 	$book1 = $_POST["book1"];
	 	$book2 = $_POST["book2"];
	 	$book3 = $_POST["book3"];
	 	$book4 = $_POST["book4"];

	 	$payment = $_POST["payment"];

	 	//把空白未填的置0
	 	// if($book1 == "")
	 	// 	$book1 = 0;

	 	// if($book2 == "")
	 	// 	$book2 = 0;

	 	// if($book3 == "")
	 	// 	$book3 = 0;

	 	// if($book4 == "")
	 	// 	$book1 = 0;
	  ?>

	

	<?php

	// 连接数据库
	$con = mysqli_connect("localhost","root","");

	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}



	// Create database 创建数据库
	mysqli_query($con,"CREATE DATABASE bookseller_db");


	// Create table in my_db database  在数据库中创建表
	mysqli_select_db($con,"bookseller_db");

	$sql = "CREATE TABLE customer_info
	(
	name varchar(20) primary key,
	address varchar(20),
	zip varchar(20)
	)";

	$sq2 = "CREATE TABLE book_info
	(
	book varchar(20) primary key,
	publisher varchar(20),
	price varchar(20)
	)";

	$sq3 = "CREATE TABLE order_info
	(
	name varchar(20),
	book varchar(20),
	quantity varchar(20),
	primary key(name,book)
	)";


	mysqli_query($con,$sql);
	mysqli_query($con,$sq2);
	mysqli_query($con,$sq3);


	//将数据插入数据库
	//customer_info数据
	mysqli_query($con,"INSERT INTO customer_info (name, address, zip) 
					VALUES ('$name', '$address', '$zip') 
					ON DUPLICATE KEY UPDATE address = '$address',zip='$zip'");

	//book_info数据
	mysqli_query($con,"INSERT INTO book_info (book, publisher, price) 
					VALUES ('Web technology','Springer press','$5.0')");

	mysqli_query($con,"INSERT INTO book_info (book, publisher, price)  
					VALUES ('mathematics', 'ACM press', '$6.2')");

	mysqli_query($con,"INSERT INTO book_info (book, publisher, price)  
					VALUES ('principle of OS', 'Science press', '$10')");

	mysqli_query($con,"INSERT INTO book_info (book, publisher, price)  
					VALUES ('Theory of matrix', 'High education press', '$7.8')");


	//order_info数据
	if($book1 != 0){
		mysqli_query($con,"INSERT INTO order_info (name, book, quantity) 
			VALUES ('{$name}', 'Web technology', '{$book1}')
					ON DUPLICATE KEY UPDATE quantity = '$book1'");
	}



	if($book2 != 0){
		mysqli_query($con,"INSERT INTO order_info (name, book, quantity) 
			VALUES ('{$name}', 'mathematics', '{$book2}')
			ON DUPLICATE KEY UPDATE quantity = '$book2'");
	}


	if($book3 != 0){
		mysqli_query($con,"INSERT INTO order_info (name, book, quantity) 
			VALUES ('{$name}', 'principle of OS', '{$book3}')
			ON DUPLICATE KEY UPDATE quantity = '$book3'");
	}


	if($book4 != 0){
		mysqli_query($con,"INSERT INTO order_info (name, book, quantity) 
			VALUES ('{$name}', 'Theory of matrix', '{$book4}')
			ON DUPLICATE KEY UPDATE quantity = '$book4'");
	}

	mysqli_close($con);
	?>
	

	<div class="container">
		<a href="index.html">返回首页</a>
		<a href="select.html">进入订单查询界面</a>
	</div>


	 
</body>
</html>