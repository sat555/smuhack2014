<!DOCTYPE html>
<head>
<title>Customer Profiler</title>
<?php include('include.php');?>
<script>
function search()
	{
		searchQuery=document.getElementById('searchbar').value;
		window.location.href = 'businesses.html?cluster=1&page=1&search='+searchQuery;
	}
function toggleChecked( id ){

	    $('#checkboxes').find(':checkbox').each(function(){
	        jQuery(this).prop('checked', $('#' + id).is(':checked'));

	    	});
    	clustersUpdate();
	}
	
	function getUrlVars() {
		var map = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			map[key] = value;
		});
		return map;
	}
	
	function getUrlVarsFrom(url) {
		var map = {};
		var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			map[key] = value;
		});
		return map;
	}	
	
	function startIframe()
	{
		updateIframe(getUrlVars()['id'], 1, 'stars', '1234567');
		document.getElementById('currPage').innerHTML=1;
	}

	function updateIframe(business_id, page, sort, clusters)
	{
		//document.getElementById('theIframe').src='reviewList.php?business_id='+business_id+'&page='+page+'&sort='+sort+'&clusters='+clusters;
	}
	
	function setIframeHeight()
	{
		var theIframe=document.getElementById('theIframe');
		var newHeight=theIframe.contentWindow.document.body.scrollHeight;
		if(newHeight<600)
		{
			newHeight=600;
		}
		theIframe.height=newHeight+'px';
	}
	
	function changeSort(newSort)
	{
		varsMap=getUrlVarsFrom(document.getElementById('theIframe').src);
		updateIframe(varsMap['business_id'], varsMap['page'], newSort, varsMap['clusters']);		
	}
	
	function prevPage()
	{
		varsMap=getUrlVarsFrom(document.getElementById('theIframe').src);
		updateIframe(varsMap['business_id'], document.getElementById('currPage').innerHTML*1-1, varsMap['sort'], varsMap['clusters']);	
		document.getElementById('currPage').innerHTML=document.getElementById('currPage').innerHTML*1-1;
		document.location.href = "#theIframe"; 
	}

	function nextPage()
	{
		varsMap=getUrlVarsFrom(document.getElementById('theIframe').src);
		updateIframe(varsMap['business_id'], document.getElementById('currPage').innerHTML*1+1, varsMap['sort'], varsMap['clusters']);
		document.getElementById('currPage').innerHTML=document.getElementById('currPage').innerHTML*1+1;
		document.location.href = "#theIframe"; 
	}
	
	function clustersUpdate()
	{
		var clustersList='';

		for(var i=1; i<8; i++)
		{
			if(document.getElementById('checkbox'+i).checked)
			{
				clustersList+=i;
			}
		}

		if(clustersList=='1234567')
		{
			document.getElementById('checkAll').checked=true;
		}
		else
		{
			document.getElementById('checkAll').checked=false;
		}

		varsMap=getUrlVarsFrom(document.getElementById('theIframe').src);
		updateIframe(varsMap['business_id'], varsMap['page'], varsMap['sort'], clustersList);
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
.control {
	margin: 5px;
}
.modal-body {
    max-height: 800px;
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
</style>
</head>

<body onload='startIframe();'>
		<?php include('navModals.php');?>

		<?php include('header2.php');?>
		<?php include('db.php');?>
		<div class='row-fluid' id='profile'>
		<?php
		$id=$_GET["id"];

				$cmd="select * from Customers join customerCluster join clusterInfo on (Customers.customer_id=customerCluster.customer_id and customerCluster.cluster=clusterInfo.cluster_no) where Customers.customer_id='$id'";
				$result = mysql_query($cmd)
        or die(mysql_error());

				$row = mysql_fetch_assoc($result);
				$firstname=$row['customer_first_name'];
				$lastname=$row['customer_last_name'];
				$email=$row['email_address'];
				$phone=$row['phone_number'];
				$starIcons="";
				$address=$row['address'];
				$city=$row['town_city'];
				$prov=$row['county'];
				
				
				echo "<table class='table table-bordered span10 offset1'>
				<tr>
					<td><h4>$name</h4></td>
				</tr>
				<tr>
					<td class='span3'>
						<div>
							<strong>
								First Name: $firstname</br>
								Last Name: $lastname</br>
								email: $email</br>
								phone: $phone</br>
								province: $prov</br>
							</strong>
							<p>city: $city
								<br/> Address: $address
							</p>
						</div>
					</td>
					<td class='span9'>
						<div class='span12'>
							<strong>Profile: $profile</strong>
							<p>$details</p>
						</div>
					</td>
				</tr>";
			?>
			</table>
		</div>
		<div class='row-fluid'>
			<table class='table span10 offset1'>
				<tr>
					<td>
						<a class='btn btn-small btn-info control' onclick='prevPage()'>Previous</a>
						<a class='btn btn-small btn-info control' onclick='nextPage()'>Next</a>
						<div id='currPage'></div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</body>
</html>	