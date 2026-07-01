<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

$userid=$_SESSION['detsuid'];

//add category
if(isset($_POST['submit']))
{
  $categoryname=$_POST['categoryname'];
  $query=mysqli_query($con, "insert into tblcategory(UserId,CategoryName) value('$userid','$categoryname')");
  if($query){
  echo "<script>alert('Category has been added');</script>";
  echo "<script>window.location.href='manage-category.php'</script>";
  } else {
  echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}

//delete category
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblcategory where ID='$rowid'");
if($query){
echo "<script>alert('Category successfully deleted');</script>";
echo "<script>window.location.href='manage-category.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Manage Category</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+Lao:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><em class="fa fa-home"></em></a></li>
				<li class="active">Category</li>
			</ol>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Add Category</div>
					<div class="panel-body">
						<form role="form" method="post" action="">
							<div class="form-group">
								<label>Category Name</label>
								<input class="form-control" type="text" name="categoryname" required="true">
							</div>
							<button type="submit" class="btn btn-primary" name="submit">Add</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Category List</div>
					<div class="panel-body">
						<table class="table table-bordered mg-b-0">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Category Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$ret=mysqli_query($con,"select * from tblcategory where UserId='$userid'");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) {
							?>
								<tr>
									<td><?php echo $cnt;?></td>
									<td><?php echo $row['CategoryName'];?></td>
									<td><a href="manage-category.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('Delete this category?');">Delete</a></td>
								</tr>
							<?php
							$cnt=$cnt+1;
							}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('includes/footer.php');?>
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
<?php }  ?>