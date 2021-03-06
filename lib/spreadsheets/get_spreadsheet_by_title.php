<?php
/**
 * This software is governed by the CeCILL-B license. If a copy of this license
 * is not distributed with this file, you can obtain one at
 * http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.txt
 *
 * Author of Accounter: Bertrand THIERRY (bertrand.thierry1@gmail.com)
 *
 */
 
/*
Return an array of every spreadsheets of a particular title and associated account id.
A spreadsheet is a row in the spreadsheets SQL table.
*/

include_once(__DIR__.'/../get_db.php');

function get_spreadsheet_by_title($account_id_arg, $spreadsheet_title_arg)
{
	$db = get_db();

	$account_id = (int)$account_id_arg;
	$spreadsheet_title = $spreadsheet_title_arg;
	
	try
	{
		$myquery = 'SELECT * FROM  '.TABLE_SPREADSHEETS.'
     WHERE account_id=:account_id AND upper(title)=upper(:spreadsheet_title)';
		$prepare_query = $db->prepare($myquery);
		$prepare_query->bindValue(':account_id', $account_id, PDO::PARAM_INT);
		$prepare_query->bindValue(':spreadsheet_title', $spreadsheet_title, PDO::PARAM_STR); 
		$prepare_query->execute();
	}
	catch (Exception $e)
	{
	//	echo 'Fail to connect: ' . $e->getMessage();
	}
	$reply = $prepare_query->fetchAll();
	$prepare_query->closeCursor();
	if(!empty($reply))
	{
		return $reply[0];
	}
	else
	{
		return array();
	}
}
