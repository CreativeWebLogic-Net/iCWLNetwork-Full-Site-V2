<?php

class clsExceptionHandler
{
	public function handle(Throwable $ex)
	{
		echo "xxx".var_export($ex,true);
	}
}

