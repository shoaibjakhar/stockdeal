<?php  include('partial/session_start.php'); ?>


<?php
// $UserName = $_GET[ 'UserName' ];
// $Source = $_GET[ 'Source' ];
// $Disposition = $_GET[ 'Disposition' ];

date_default_timezone_set( 'Asia/Kolkata' );

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clients Login Detail</title>
	<?php require('partial/plugins.php'); ?>



</head>

<body>


	<?php include('partial/sidebar.php') ?>

	<div class="main_container">
		<header>
			<?php include('partial/header-top.php') ?>

		</header>
		<div class="breadcurms">
			<div class="pull-left">
				<!--<a href="memberpage.php">Dashbord</a> | <a href="customer-profile.php">Customer Profile Last 60</a> | <a href="customer-profile-all.php">Customer Profile All</a> | <a href="clients.php"  class="btn btn-xs btn-primary">Clients Login</a> | <a href="clients-update.php">Client Update</a> | <a href="risk-profile.php">Risk Profile</a>-->
				<a href="memberpage.php">Dashbord</a>| <a href="clients.php"  class="btn btn-xs btn-primary">Clients Login</a> | <a href="clients-update.php">Client Update</a> | <a href="risk-profile.php">Risk Profile</a> 
			</div>
			<div class="pull-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#AddFreeTrail"><i class="fa fa-plus"></i> Add</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="containter" style="padding:20px 20px 0 20px;">

			<?php include('connection/dbconnection_crm.php')?>


			<?php
			$sql = ( "SELECT Id, User, PASSWORD , Mobile, DATE_FORMAT(  `Timestamp` ,  '%d-%m-%Y' ) AS DateTimeCurrent
FROM clients ORDER BY  `clients`.`Timestamp` DESC" );
			$result = mysqli_query($connect, $sql );
			echo( '<form action="aa.php" method="post">' );
			echo( '<table id="Clients" class="display table table-bordered" cellspacing="0" width="100%">' );
			echo( '<thead>' );
			echo( '<tr class="brand-color-bg">' );
			echo( '<th>Date</th>' );
			echo( '<th>User Name</th>' );

			echo( '<th>Password</th>' );
			echo( '<th>User ID / Mobile</th>' );

			echo( '</tr>' );
			echo( '</thead>' );
			echo( '<tbody>' );
			while ( $row = $result->fetch_array() ) {
				echo( '<tr>' );
				echo( '<td>' . $row[ 'DateTimeCurrent' ] . '</td>' );
				echo( '<td>' . $row[ 'User' ] . '</td>' );

				echo( '<td>' . $row[ 'PASSWORD' ] . '</td>' );
				echo( '<td>' . $row[ 'Mobile' ] . '</td>' );

				//echo('<td><input type="hidden" value="'.$row['Id'].'"'. 'class="id"/>'.'<a href="#_"' . 'class="btn btn-danger">Delete</a>'.'</td>');
			}
			echo( '</tr>' );
			echo( '</tbody>' );
			echo( '</table>' );
			echo( '</form>' );
			?>



		</div>

	</div>


	<!-- Modal -->
	<div class="modal fade" id="AddFreeTrail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="AddFreeTrailLabel">Add New Client Details</h4>
				</div>
				<div class="modal-body">

					<div class="alert alert-danger" style="display:none">
						<strong>All fields are mandatory except Last Name</strong>
					</div>

					<input type="hidden" id="" value="<? /*php echo date(" Y-m-d h:i:s ")*/ ?>"/>

					<table width="100%" border="0" class="table table-bordered" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>

								<td>User Name</td>
								<td>Password</td>
								<td>Mobile</td>
							</tr>

							<tr>
							  <td><input type="text" class="form-control" id="User" placeholder="User Name"></td>
							  <td><input type="text" class="form-control" id="Password" placeholder="Password"></td>
							  <td><input type="text" class="form-control" id="Mobile" placeholder="Mobile">
							      <input type="hidden" class="form-control" id="CurrentDateTime" placeholder="Mobile" value="<?php echo date("d-m-Y H:i A");?>">
							  </td>
							</tr>
						</tbody>
					</table>


					<!-- -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="Add">Add</button>
				</div>
			</div>
		</div>
	</div>

	<form action="stock-tips-delete.php" method="get" style="display:none">
		<input type="text" name="Id" class="Id" value=""/>

		<input type="submit" id="aa"/>
	</form>
	<?php include('partial/footer.php') ?>



	<script type="text/javascript">
		function showUser() {
			if ( window.XMLHttpRequest ) { // code for IE7+, Firefox, Chrome, Opera, Safari
				aa = new XMLHttpRequest();
			}

			aa.onreadystatechange = function () {
				if ( aa.readyState == 4 && aa.status == 200 ) {
					document.getElementById( "txtHint" ).innerHTML = aa.responseText;
				}
			}

			var StartDate = document.getElementById( "StartDate" ).value
			var EndtDate = document.getElementById( "EndtDate" ).value
			var Packages = document.getElementById( "Packages" ).value


			aa.open( "GET", "stock-tips-back.php?StartDate=" + StartDate + "&EndtDate=" + EndtDate + "&Packages=" + Packages, true );

			aa.send();
			//alert(p)

		}
	</script>


	<script type="text/javascript">
		function Add() {
			//alert('asd')
			if ( window.XMLHttpRequest ) { // code for IE7+, Firefox, Chrome, Opera, Safari
				aa = new XMLHttpRequest();
			}

			aa.onreadystatechange = function () {
				if ( aa.readyState == 4 && aa.status == 200 ) {
					document.getElementById( "txtHint" ).innerHTML = aa.responseText;
				}
			}

			var User = document.getElementById( 'User' ).value
			var Password = document.getElementById( 'Password' ).value
			var Mobile = document.getElementById( 'Mobile' ).value

			aa.open( "GET", "clients-add.php?User=" + User + "&Password=" + Password + "&Mobile=" + Mobile, true );
			aa.send();


			setTimeout( function () {
				location.reload();
			}, 1000 );

		}


		$( document ).ready( function () {

			$( '.btn-danger' ).click( function () {

				var deletetip = $( this ).prevAll( "input[type=hidden]" ).val();
				//alert(deletetip);


				$( '.Id' ).val( deletetip )
				$( '#aa' ).trigger( "click" );


			} );



			$( "#datepicker" ).datepicker( {
				dateFormat: 'dd-mm-yy',
				altField: '#FowllowUpDateTime',
				altFormat: 'yy-mm-dd',
				format: 'yy-mm-dd',
				minDate: 0
			} );


			$( "#StartDate" ).datepicker( {
				dateFormat: 'dd-mm-yy',
				altField: '#StartDateIndian',
				altFormat: 'yy-mm-dd',
				format: 'yy-mm-dd',

			} );


			$( "#EndtDate" ).datepicker( {
				dateFormat: 'dd-mm-yy',
				altField: '#EndtDateIndian',
				altFormat: 'yy-mm-dd',
				format: 'yy-mm-dd',

			} );



			$( '#Add' ).click( function () {

				var Segment = $( '#Segment' ).val();
				var FowllowUpDateTime = $( '#FowllowUpDateTime' ).val();
				var Idea = $( '#Idea' ).val();
				var Hour = $( '#Hour' ).val();
				var Minuts = $( '#Minuts' ).val();
				var Second = $( '#Second' ).val();



				if ( Segment != "" && FowllowUpDateTime != "" && Idea != "" && Hour != "" && Minuts != "" ) {
					$( '.alert-danger' ).hide();
					Add();
					// alert('aa')
				} else {
					$( '.alert-danger' ).show();
					//alert('bb')

				}


			} );



		} );
	</script>