<!DOCTYPE html>

<html>
<head>
<script>
</script>
</head>
<body>

<h1>Create a new account</h1>

<form method="post">
  <fieldset>
    <legend>Create a new account:</legend>
    Name: <input type="text" name="name_of_account" id="name_of_account" required /><br>
    Email: <input type="email" name="contact_email" id="contact_email" required/><br>
	 <button type="submit" name="submit" value="Submit">Submit</button> 
  </fieldset>
</form>


<?php
if(isset($_POST['submit']))
{
	$name_of_account = filter_input(INPUT_POST, 'name_of_account', FILTER_SANITIZE_STRING);
	$contact_email = filter_input(INPUT_POST, 'contact_email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
	do {
		$hashid = bin2hex(openssl_random_pseudo_bytes(8));
	}
	while(!$hashid);
	do {
		$hashid_admin = bin2hex(openssl_random_pseudo_bytes(8));
	}
	while(!$hashid_admin);
	echo '<p> Hashid created : '.$hashid.'</p>';

	// on se connecte à MySQL 
	try
	{
	$db = new PDO('mysql:host=localhost;dbname=dividethebill;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}

	
	try{
		$myquery = 'INSERT INTO accounts(id, hashid, hashid_admin, name, email) VALUES(NULL, :hashid, :hashid_admin, :name, :email)';
		$prepare_query = $db->prepare($myquery);
		$prepare_query->bindValue(':hashid', $hashid, PDO::PARAM_STR);
		$prepare_query->bindValue(':hashid_admin', $hashid_admin, PDO::PARAM_STR);
		$prepare_query->bindValue(':name', $name_of_account, PDO::PARAM_STR);
		$prepare_query->bindValue(':email', $contact_email, PDO::PARAM_STR);
		$prepare_query->execute();
		if($prepare_query)
		{
			echo '<p> GOOD JOB</p>';
		}
		else
		{
			echo '<p> BAD JOB</p>';
		}
		$prepare_query->closeCursor();
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
	
	header('Location: /DivideTheBill/account/'.$hashid);
}
?>


</body>
</html>