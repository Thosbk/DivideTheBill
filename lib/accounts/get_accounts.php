<?php
include_once(__DIR__.'/../get_db.php');

function get_accounts()
{
	$db = get_db();

	try
	{
		$myquery = 'SELECT * FROM '.TABLE_ACCOUNTS;
		$prepare_query = $db->prepare($myquery);
		$prepare_query->execute();
		$reponse = $prepare_query->fetchAll();
	}
	catch (Exception $e)
	{
		echo 'Fail to connect : ' . $e->getMessage();
	}
	$prepare_query->closeCursor();
	return $reponse;
}
