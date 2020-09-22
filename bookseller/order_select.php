<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">



	<link rel="icon" href="title.ico">
	<title>订单查询信息</title>


	<!-- Bootstrap 核心 CSS 文件 --> 
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 --> 
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<style type="text/css">
		/*在大分辨率下设置宽度*/
		@media (min-width: 1200px) {
		  .container {
		    width: 700px;
		  }

		}
	</style>
</head>
<body>



	<div class="container">


		<div class="page-header">
			<h1>查询结果</h1>
		</div>

		<?php 
			$customer_name = $_POST["customer_name"];

			$con = mysqli_connect("localhost","root","");

		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}

		mysqli_select_db($con,"bookseller_db");

		$result = mysqli_query($con,"SELECT * FROM order_info WHERE name = '$customer_name'");

		if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}


		echo "<table class='table table-bordered'>
		<tr>
			<th>name</th>
			<th>book</th>
			<th>publisher</th>
			<th>quantity</th>
		</tr>";

		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>" .$row['name'] . "</td>";
			echo "<td>" . $row['book'] . "</td>";

			$p = $row['book'];
			$publisher = mysqli_query($con,"SELECT publisher FROM book_info WHERE book = '$p'");
			$row_book_info = mysqli_fetch_array($publisher);
			echo "<td>" . $row_book_info['publisher'] ."</td>";
			echo "<td>" . $row['quantity'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		mysqli_close($con);


		 ?>




	 </div> <!-- container -->

</body>
</html>