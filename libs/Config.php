<?php
class Config
{
    public function __construct($configFile){
	if(file_exists($configFile))
	{
	    require $configFile;
	    foreach($c as $k => $v)
	    {
		if(is_array($v))
		{
		    foreach($v as $k1 => $v1)
		    {
			$this->$k->$k1 = $v1;
		    }
		}
		else
		{
		    $this->$k = $v;
		}
	    }
	    return $this;
	}
	else
	{
	    die('No Config file found! Please create one in the main folder!');
	}
    }
    
    public static function getValue($key)
    {
	$filename = "../config/config.inc.php";
	if(file_exists($filename))
	{
	    require $filename;
	    foreach($c as $k => $v){
		if($key == $k)
		{
		    return $v;
		}
	    }
	    return false;
	}
    }
}