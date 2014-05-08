<!DOCTYPE html>
<head>
<title>Retail Data Customer Profiler</title>

<?php include('include.php');?>
<script>
	function search()
	{
		searchQuery=document.getElementById('searchbar').value;
		window.location.href = 'businesses.php?cluster=1&page=1&search='+searchQuery;
	}
</script>
<style type="text/css">
body {
background-color: #CCC;
}
#content {
	background-color: #FFF;
	border-radius: 5px;
	white-space:normal;
	padding: 20px;
}
.btncustom {
    width: 300px !important;
    height: 25px !important;
}
.paddedCell {
	padding-left: 40px;
}
#header
{
	color:white;
	background-image: url('header.png');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
#video
{
	text-align: center;
	padding-left:25px;
	padding-right: 10px;
}
.bighr
{
color: #000;
background-color: #000;
height: 5px;
}
.popover{
 max-width: 800px !important;
 width: auto;
}
hr{
padding: 0px;
margin: 0px;    
}
#paper{
	height: 100px;
	width: 100px;
}
</style>
</head>
<body>

	<?php include('profileModals.php');?>

			<!--Page-->
			<?php include('header.php');?>
			<div class='row-fluid'>
					<div class='well span6 offset3 pagination-centered'>
					<h3>Customer Profiles</h3>
					<a href='#business1' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p><?php echo $businessProfiles[0][0];?></p></a><br>
					<a href='#business2' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p><?php echo $businessProfiles[1][0];?></p></a><br>
					<a href='#business3' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p><?php echo $businessProfiles[2][0];?></p></a><br>
					<a href='#business4' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p><?php echo $businessProfiles[3][0];?></p></a><br>
					<a href='#business5' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p><?php echo $businessProfiles[4][0];?></p></a><br>
					</div>
					
			</div>
		</div>
	</div>

</div>
</body>
</html>