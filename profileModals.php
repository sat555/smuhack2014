<?php include('db.php');?>
<?php
			

			$cmd="select * from clusterInfo";
			$result = mysql_query($cmd)
        or die(mysql_error());

			$businessProfiles=array();
			while ($row = mysql_fetch_assoc($result)) {
				$businessProfiles[]=array($row['label'], $row['description']);
			}

			

			for($i=0;$i<7;$i++)
			{
				$businessProfilesNoBR[]=str_replace('<br>', ' ', $businessProfiles[$i][0]);
					
			}

			

			error_log($businessProfilesNoBR[0][0]);

			$businessProfileStats=array(
				"1"=>array(12,16,19,31,22,12,6,1,3,1,69,10,10),
				"2"=>array(11,6,5,7,22,61,21,1,5,1,60,6,6),
				"3"=>array(101,6,9,16,37,31,3,0,20,2,65,4,6),
				"4"=>array(13,6,7,12,55,20,8,1,3,1,75,5,8),
				"5"=>array(5,6,3,2,6,83,63,0,6,1,20,7,3),
				"6"=>array(5,51,11,9,14,15,11,1,5,2,34,42,6),
				"7"=>array(335,3,6,14,39,38,4,0,7,22,60,2,5)
			);

			

			for($id=1; $id<8;$id++){
				$name=$businessProfiles[$id-1][0];
				$summary=$businessProfiles[$id-1][1];

				echo "<div id='business$id' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='business1Label' aria-hidden='true'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 id='business1Label'>Customer Profile</h4>

					</div>
					<div class='modal-body'>
						<table class='table table-striped table-bordered'>
							<tr>
								<td ><h4>$name</h4></td>
							</tr>
							<tr>
								<td><strong class='paddedCell'>Summary</strong></td>
							</tr>
							<tr>
								<td>
									<p class='paddedCell'>$summary</p>
								</td>
							</tr>
							
						</table>
					</div>
					<div class='modal-footer'>
						<a class='btn btn-success' href='businesses.php?cluster=$id&page=1&search=' target='_parent'>View Customers</a>
					</div>
				</div>";

				echo "<script type='text/javascript'>
					$('#statsBus$id').popover({
						placement:'top',
						title: 'Statistics',
						html:true,
						content:'<hr class=\'bighr\'>Static Representation<hr class=\'bighr\'>Average Reviews Recieved: ".$businessProfileStats[$id][0]."<hr><i class=\'icon-star\'></i> Reviews : ".$businessProfileStats[$id][1]."%<br><i class=\'icon-star\'></i><i class=\'icon-star\'></i> Reviews : ".$businessProfileStats[$id][2]."%<br><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i> Reviews : ".$businessProfileStats[$id][3]."%<br><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i> Reviews : ".$businessProfileStats[$id][4]."%<br><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i><i class=\'icon-star\'></i> Reviews : ".$businessProfileStats[$id][5]."%<br><br><hr class=\'bighr\'>Dynamic Representation<hr class=\'bighr\'>".$reviewerProfilesNoBR[0]." : ".$businessProfileStats[$id][6]."%<hr>".$reviewerProfilesNoBR[1]." : ".$businessProfileStats[$id][7]."%<hr>".$reviewerProfilesNoBR[2]." : ".$businessProfileStats[$id][8]."%<hr>".$reviewerProfilesNoBR[3]." : ".$businessProfileStats[$id][9]."%<hr>".$reviewerProfilesNoBR[4]." : ".$businessProfileStats[$id][10]."%<hr>".$reviewerProfilesNoBR[5]." : ".$businessProfileStats[$id][11]."%<hr>".$reviewerProfilesNoBR[6]." : ".$businessProfileStats[$id][12]."%'
					});
				</script>";
			}

			

			$commonBusinessArray=array(
				"1"=>"<a href='#business6' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[5][0]."</a><br><a href='#business2' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[1][0]."</a><br><a href='#business7' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a>",
				"2"=>"<a href='#business2' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[1][0]."</a><br><a href='#business6' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[5][0]."</a><br><a href='#business7' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a>",
				"3"=>"<a href='#business3' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[2][0]."</a><br><a href='#business5' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[4][0]."</a><br><a href='#business7' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a>",
				"4"=>"<a href='#business4' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a><br><a href='#business7' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a><br><a href='#business1' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[0][0]."</a>",
				"5"=>"<a href='#business1' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[0][0]."</a><br><a href='#business6' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[5][0]."</a><br><a href='#business2' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[1][0]."</a>",
				"6"=>"<a href='#business6' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[5][0]."</a><br><a href='#business2' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[1][0]."</a><br><a href='#business1' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[0][0]."</a>",
				"7"=>"<a href='#business4' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[3][0]."</a><br><a href='#business7' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[6][0]."</a><br><a href='#business2' role='button' class='btn btn-success span4' data-dismiss='modal' data-toggle='modal'>".$businessProfiles[1][0]."</a>"
			);

			

					
		
?>