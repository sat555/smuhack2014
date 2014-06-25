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
  $i=1;
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
	$cmd="select * from Customers join customerCluster join clusterInfo on (Customers.customer_id=customerCluster.customer_id and customerCluster.cluster=clusterInfo.cluster_no) where clusterInfo.cluster_no=$cluster order by $sort asc limit $offset,10";
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
				$cid=$row['customer_id'];
				$starIcons="";
				$address=$row['address'];
				$city=$row['town_city'];
				$prov=$row['county'];
		$profile=$row['title'];
		
		$profit="";
				$spending="";
				$visits="";
				$products="";
		
		
		$sql="select * from summary WHERE id = '$cid';";
		$result2 = mysql_query($sql)
        or die(mysql_error());
		while ($row2 = mysql_fetch_assoc($result2)) {
		$profit=$row2['profit'];
				$spending=$row2['spending'];
				$visits=$row2['visits'];
				$products=$row2['products'];
				}
				$sql2="select * from customerCluster WHERE customer_id = '$cid';";
		$result3 = mysql_query($sql2)
        or die(mysql_error());
		while ($row3 = mysql_fetch_assoc($result3)) {
		
				$clust=$row3['cluster'];
				}
		
   		echo 	"<tr>
			<td class='span4'>
				<div>
					<strong>
						First Name: $firstname</br>
								Last Name: $lastname</br>
								email: $email</br>
								phone: $phone</br>
								province: $prov</br>
								City: $city</br>
					      Address: $address</br>
					</strong>
					
				</div>
			</td>
			<td class='span9'>
				<p>
					<strong>Spending Rating: </strong>";
					$rating="";
					
					if($spending <=100) $rating="$";
elseif($spending >=101 && $spending <=200) $rating="$$";
elseif($spending >=201 && $spending <=500) $rating="$$$";
elseif($spending >=501 && $spending <=1000) $rating="$$$$";
elseif($spending >=1001) $rating="$$$$$";
          
					echo $rating;
					echo "</br>
					<strong>Spending: </strong>$spending</br>
					<strong>Visits: </strong>$visits</br>
					<strong>Products: </strong>$products</br>
					<strong>Profit: </strong>$profit</br>
				</p>
				
			</td>
		</tr>";
	}
	echo "</table>";
	?>


	<?php include('profileModals.php');?>

</body>
</html>