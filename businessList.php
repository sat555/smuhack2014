<html>
<head>
	<title>Customer Profiler</title>
	<?php include('include.php');?>
	<style type="text/css">
	body {
	background-color: #FFF;
	}
	.btncustom {
	    width: 300px !important;
	    height: 50px !important;
	    margin: 10px;
	}
	.paddedCell {
		padding-left: 40px;
	}
	label {
		float: left;
		margin: 10px;
	}
	#divider {
		text-align: center;
		background-color: #000;
	}
	#divider h4 {
		color: white;
	}
	.sortButton {
		
	}
	</style>
</head>
<body>
	<?php include('db.php');?>
	<?php 

	$cluster=$_GET["cluster"];
	$page=$_GET["page"];
	$offset=(10*$page)-10;
	$sort=$_GET["sort"];
	//stars, totalReviews, totalCheckins
	$search=$_GET["search"];
	$user_id=$_GET["user_id"];
	
if($search=="")
	{
		if($user_id=="")
		{
	$cmd="select * from Customers join customerCluster join clusterInfo on (Customers.customer_id=customerCluster.customer_id and customerCluster.cluster=clusterInfo.cluster_no) where clusterInfo.cluster_no=$cluster limit $offset,10";
		}
		
		else
		{
				$clusters=str_split($_GET["clusters"]);
				if(count($clusters)>0)
				{
					$clusterSelector='and (';
					for($i=0; $i<count($clusters); $i++)
					{
						//Build cluster selection string
						$clusterSelector.="customerCluster.cluster=$clusters[$i]";
						if($i<count($clusters)-1)
						{
							$clusterSelector.=' or ';
						}
					}
					$clusterSelector.=')';
				}
				else
				{
					$clusterSelector="";
				}


			//$cmd="select * from reviewInfo join businessInfo join businessCluster join businessClusterInfo on (reviewInfo.business_id=businessInfo.id and reviewInfo.business_id=businessCluster.id and businessCluster.cluster=businessClusterInfo.cluster_no) where user_id='$user_id' $clusterSelector order by $sort desc limit $offset,10";
		}
		}
	else
	{
		$cmd="select * from Customers join customerCluster join clusterInfo on (Customers.customer_id=customerCluster.customer_id and customerCluster.cluster=clusterInfo.cluster_no) where Customers.customer_last_name like '%$search%' limit $offset,10";
	}
		
		
		
		
		
		$result = mysql_query($cmd)
        or die(mysql_error());
				
				
				echo "<table class='table table-bordered'>
		<tr id='divider'>
			<td colspan=2>
				<h4>Customers</h4>
			</td>
		</tr>";


	while ($row = mysql_fetch_assoc($result)) {
		$firstname=$row['customer_first_name'];
				$lastname=$row['customer_last_name'];
				$email=$row['email_address'];
				$phone=$row['phone_number'];
				$starIcons="";
				$address=$row['address'];
				$city=$row['town_city'];
				$prov=$row['county'];
		$profile=$row['title'];
		$cluster=$row['cluster'];
		
   		echo 	"<tr>
			<td class='span4'>
				<div>
					<strong>
						First Name: $firstname</br>
								Last Name: $lastname</br>
								email: $email</br>
								phone: $phone</br>
								province: $prov</br>
					</strong>
					<a href='#business$cluster' class='btn btn-small btn-danger' data-dismiss='modal' data-toggle='modal'>View Profile</a>
				</div>
			</td>
			<td class='span9'>
				<p>
					<strong>City:</strong>$city</br>
					<strong>Address:</strong>$address
				</p>
				
			</td>
		</tr>";
	}
	echo "</table>";
	?>


	<?php include('profileModals.php');?>

</body>
</html>