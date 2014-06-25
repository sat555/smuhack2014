<!DOCTYPE html>
<head>
<title>Weekly Report</title>
<?php include('include.php');?>

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
<body>
<!-- echo "<table class='table table-bordered'>
		<tr id='divider'>
			<td colspan=2>
				<h4>Customers</h4>
			</td>
		</tr>"; -->
		
		<!-- echo 	"<tr>
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
					<strong>Spending Rating: </strong>"; -->
					
		
<!-- 		echo $rating;
					echo "</br>
					<strong>Spending: </strong>$spending</br>
					<strong>Visits: </strong>$visits</br>
					<strong>Products: </strong>$products</br>
					<strong>Profit: </strong>$profit</br>
				</p>
				
			</td>
		</tr>";
	}
	echo "</table>"; -->

<?php
//$yesterday=date("Y-m-d", strtotime("yesterday"));
include('navReports.php');
include('header3.php');
include('db.php');
//echo $yesterday;

$sql="SELECT count(distinct `receipt_number`) as visits FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate();";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$visits=$row['visits'];
				}
$sql="SELECT count(`receipt_number`) as products FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate();";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$products=$row['products'];
				}
$sql="SELECT sum(price) as revenues FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate();";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$revenues=$row['revenues'];
				}
				
$english_format_revenues = number_format($revenues, 2, '.', ',');

$sql="SELECT sum(price-cost) as profit FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate();";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$profit=$row['profit'];
				}
$english_format_profit = number_format($profit, 2, '.', ',');
echo "<table class='table table-bordered'>
		<tr id='divider'>
			<td colspan=2>
				<h4>Overall Data(for past 7 days)</h4>
			</td>
		</tr>";
echo 	"<tr>
			<td class='span4'>
				<div>
					<strong>
								Overall Visits for the week: $visits</br>
								Overall Products Sold for the week: $products</br>
								Overall Revenues for the week: $english_format_revenues</br>
								Overall Profit for the week: $english_format_profit</br>
					</strong>
					
				</div>
			</td></tr></table>";
			
echo "<table class='table table-bordered'>
		<tr id='divider'>
			<td colspan=2>
				<h4>Top 5 Products</h4>
			</td>
		</tr>";
			
			$sql="select invoice4477year05to07anon.product_id, product_name, sum(quantity) as sold , sum(invoice4477year05to07anon.price) as revenue, sum(invoice4477year05to07anon.price-invoice4477year05to07anon.cost) as profit from invoice4477year05to07anon join Products4477 on (invoice4477year05to07anon.product_id=Products4477.product_id) where DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate() group by product_id order by sold desc limit 5;";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$profit=$row['profit'];
				$revenue=$row['revenue'];
				$sold=$row['sold'];
				$name=$row['product_name'];
				
				echo 	"<tr>
			<td class='span4'>
				<div>
					<strong>
						Product name: </br>$name</br>
					</strong>
				</div>
			</td>
			<td class='span9'>
				<p>
			
				<strong>Quantity sold: </strong>$sold</br>
					<strong>Revenue generated: </strong>$revenue</br>
					<strong>Profit: </strong>$profit</br>
				</p>
				
			</td>
		</tr>";
	}
	
	
	echo "<table class='table table-bordered'>
		<tr id='divider'>
			<td colspan=2>
				<h4>Top 5 Customers</h4>
			</td>
		</tr>";
			$sql="select invoice4477year05to07anon.customer_id, sum(price-cost) as profit, sum(price) as spending, count(receipt_number) as products, Customers.customer_first_name as fname, Customers.customer_last_name as lname, Customers.email_address as email, Customers.phone_number as phone, Customers.address as address, Customers.town_city as city, Customers.county as prov from invoice4477year05to07anon join Customers on (Customers.customer_id=invoice4477year05to07anon.customer_id) where DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate() group by customer_id order by spending desc limit 5;";
		$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		
				$profit=$row['profit'];
				$spending=$row['spending'];
				$products=$row['products'];
				$fname=$row['fname'];
				$visits=$row['visits'];
				$lname=$row['lname'];
				$email=$row['email'];
				$phone=$row['phone'];
				$address=$row['address'];
				$city=$row['city'];
				$prov=$row['prov'];
				
				echo 	"<tr>
			<td class='span4'>
				<div>
					<strong>
						Customer name: $fname $lname</br>
						Email: $email</br>
						Phone: $phone</br>
						Address: $address, $city, $prov
					</strong>
				</div>
			</td>
			<td class='span9'>
				<p>
					<strong>Spending: </strong>$spending</br>
					<strong>Profit: </strong>$profit</br>
					<strong>Products baught: </strong>$products</br>
				</p>
				
			</td>
		</tr>";
	}
	echo "</table>";
	
		echo "<div class='navbar navbar-inverse'>
				<div class='navbar-inner'>
					<h2 class='navbar-text text-center'>Daily Breakdown</h2>
				</div>
			</div>";
	
		/**
	$sql="SELECT distinct(date) as date FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate();";
	$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		$date=$row['date'];
		echo "<div class='row-fluid'>
					<div class='well span4 offset4 pagination-centered'>";
		echo "<a target='_blank' href='daily2.php?day=$date' role='button' class='btn btn-large btn-success span12' data-toggle='modal'><p>$date</p></a><br>";
    echo "</div></div>";
		}		
		**/
		$date=array();
		$revenues=array();
		$sql="SELECT date, sum(price) as revenues FROM `invoice4477year05to07anon` WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date and date < curdate() group by date;";
	$result = mysql_query($sql)
        or die(mysql_error());
		while ($row = mysql_fetch_assoc($result)) {
		$date[]=$row['date'];
		$revenues[]=$row['revenues'];
		//echo $row['date'];
		//echo "</br>";
		//echo $row['revenues'];
		//echo "</br>";
		}		
		$revenues_string = "[" . join(", ", $revenues) . "]";
        $date_string = "['" . join("', '", $date) . "']";
				
?>

<canvas id="cvs" width="600" height="250">[No canvas support]</canvas>
    <script>
        chart = new RGraph.Bar('cvs', <?php print($revenues_string) ?>)
            .set('background.grid.autofit', true)
            .set('gutter.left', 60)
            .set('gutter.right', 40)
            .set('hmargin', 10)
            .set('tickmarks', 'endcircle')
						.set('tooltips', ['revenues: <?php print($revenues[0]) ?><a href="daily2.php?day=<?php print($date[0]) ?>" target="_blank"> View all data</a>',
                                  'revenues: <?php print($revenues[1]) ?><a href="daily2.php?day=<?php print($date[1]) ?>" target="_blank"> View all data</a>',
                                  'revenues: <?php print($revenues[2]) ?><a href="daily2.php?day=<?php print($date[2]) ?>" target="_blank"> View all data</a>',
                                  'revenues: <?php print($revenues[3]) ?><a href="daily2.php?day=<?php print($date[3]) ?>" target="_blank"> View all data</a>',
																	'revenues: <?php print($revenues[4]) ?><a href="daily2.php?day=<?php print($date[4]) ?>" target="_blank"> View all data</a>',
																	'revenues: <?php print($revenues[5]) ?><a href="daily2.php?day=<?php print($date[5]) ?>" target="_blank"> View all data</a>',
                                  'revenues: <?php print($revenues[6]) ?><a href="daily2.php?day=<?php print($date[6]) ?>" target="_blank"> View all data</a>'])
            .set('labels', <?php print($date_string) ?>)
            .draw();
    </script>

</body>
</html>