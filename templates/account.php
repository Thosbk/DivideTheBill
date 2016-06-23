<!DOCTYPE html>

<html>
<head>
<title>Account</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo BASEURL.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">
		
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/global.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/participant.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/bill.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/bill_participant.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/payment.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/account.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL.'/css/solution.css'?>">

<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" media="all">

<script type="text/javascript" src="<?php echo BASEURL.'/js/account.js'?>"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo BASEURL.'/js/hide_show_add_participant.jquery'?>"></script>

</head>


<body>

<div id="content">
<div class="container">

<div class="row">
<header>
<?php include(__DIR__.'/header/header.php'); ?>
</header>
</div>

<?php include(__DIR__.'/messages/messages.php');?>

<?php include(__DIR__.'/account/admin_panel.php');?>

<div class="row">
<?php include(__DIR__.'/account/solution.php');?>
</div>

<div class="row">
	<div class="col-md-3">
		<?php include(__DIR__.'/account/participant.php');?>
	</div>
	<div class="col-md-9">
		<?php include(__DIR__.'/account/bill.php');?>
	</div>
</div>

</div> <!-- content -->
</div>
</body>
</html>