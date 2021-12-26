<?php require '../check_admin.php' ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/form_css.css">
	<title></title>
</head>
<body>
	<div class="form_insert">
		<h1>Sửa thông tin sản phẩm</h1>
		<?php 
			require '../notification.php';
			if(empty($_GET['id'])) {
				header('location: index.php?error=Bạn chưa truyền mã để sửa!');
				exit;
			}
			$id = $_GET['id'];
			require '../db/connect.php';
			$sql = "select * from producer where id = '$id' ";
			$result = mysqli_query($connect,$sql);
			$each = mysqli_fetch_array($result);

		?>
		
		<form action="process_update.php" method="post">
			<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
			<p>Tên sản phẩm</p>
			<input type="text" name="name" value="<?php echo $each['name'] ?>" >
			<button type="submit">Sửa</button>
		</form>	
		<?php require '../db/close.php' ?>
	</div>
</body>
</html>