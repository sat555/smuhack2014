
	<!--Modals-->
	    <?php include('db.php');?>
			<?php

				$cmd="select * from clusterInfo";
				$result = mysql_query($cmd)
        or die(mysql_error());

				while ($row = mysql_fetch_assoc($result)) {
					$businessProfiles[]=array($row['label'], $row['description']);
				}

				
			?>


				<div id='businessProfiles' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='business1Label' aria-hidden='true'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 id='business1Label'>Customer Profiles</h4>
					</div>
					<div class='modal-body pagination-centered'>
						<a href='businesses.php?cluster=1&page=1&search=' role='button' class='btn btn-success span3 offset1' data-toggle='modal'><p><?php echo $businessProfiles[0][0];?></p></a><br>
						<a href='businesses.php?cluster=2&page=1&search=' role='button' class='btn btn-success span3 offset1' data-toggle='modal'><p><?php echo $businessProfiles[1][0];?></p></a><br>
						<a href='businesses.php?cluster=3&page=1&search=' role='button' class='btn btn-success span3 offset1' data-toggle='modal'><p><?php echo $businessProfiles[2][0];?></p></a><br>
						<a href='businesses.php?cluster=4&page=1&search=' role='button' class='btn btn-success span3 offset1' data-toggle='modal'><p><?php echo $businessProfiles[3][0];?></p></a><br>
						<a href='businesses.php?cluster=5&page=1&search=' role='button' class='btn btn-success span3 offset1' data-toggle='modal'><p><?php echo $businessProfiles[4][0];?></p></a><br>
						
					</div>
				</div>

				
