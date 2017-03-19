<?php

	function check_login()
	{
		if(isset($_SESSION['logged_in']) && isset($_SESSION['user_id']))
		{
			return true;
		}
		else
		{
			false;
		}
	}

?>