<?php
include_once(__DIR__.'/../get_db.php');
include_once(LIBPATH.'/solutions/compute_bill_solutions.php');

/* Compute a solution for the global problem */

function compute_solution($account_id_arg)
{
	$db = get_db();
	
	$account_id = (int)$account_id_arg;
	$Refunds = array(array()); //who must give money to who ?
	$Refunds[-1]['total'] = 0;

	$bill_solutions = compute_bill_solutions($account_id);
	if(empty($bill_solutions)){return $Refunds;}

	$my_participants = get_participants($account_id);
	if(empty($my_participants)){return $Refunds;}
	
	//Store debt computed previously
	foreach ($bill_solutions as $bill_sol)
	{
		foreach($my_participants as $contrib)
		{
			$uid = $contrib['id'];
			foreach($my_participants as $other)
			{
				$vid = $other['id'];
				if($uid == $vid){continue;}
				$Refunds[$uid][$vid] = 0;
			}
		}
	}
	
	//Store debt computed previously
	$total_payment = 0;
	foreach ($bill_solutions as $key => $bill_sol)
	{
		if($key < 1){continue;}
		$total_payment += (float)($bill_sol[-1]['total']);
		foreach($my_participants as $contrib)
		{
			$uid = $contrib['id'];
			if(!isset($bill_sol[$uid])){continue;}
			foreach($my_participants as $other)
			{
				$vid = $other['id'];
				if($uid == $vid){continue;}
				if(!isset($bill_sol[$uid][$vid])){continue;}
				$Refunds[$uid][$vid] += $bill_sol[$uid][$vid];
			}
		}
	}
		
	//Last loop to avoid 'two direction' refund (A must pay B and B must pay A)
	foreach($my_participants as $contrib)
	{
		$uid = $contrib['id'];
		foreach($my_participants as $other)
		{
			$vid = $other['id'];
			if($uid == $vid){continue;}
			$u_to_v = $Refunds[$uid][$vid];
			$v_to_u = $Refunds[$vid][$uid];
			if($u_to_v > 0 && $v_to_u > 0)
			{
				if($u_to_v > $v_to_u)
				{
					$Refunds[$uid][$vid] = $u_to_v - $v_to_u;
					$Refunds[$vid][$uid] = 0;
				}
				else
				{
					$Refunds[$vid][$uid] = $v_to_u - $u_to_v;
					$Refunds[$uid][$vid] = 0;
				}
			}
		}
	}
	
	
	//Usefull values
	$Refunds[-1]['total'] = $total_payment;
	
	//send solution	
	return $Refunds;
}
?>