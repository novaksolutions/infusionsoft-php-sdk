<?php
/* Usage */

class Infusionsoft_Classloader{	
	protected $paths = array();
	protected static $allowedChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_0123456789";
	
	static public function sanitizeClassName($className){
		$out = '';
		for($i=0;$i<strlen($className);$i++){
			$character = substr($className, $i, 1);		
			if(strpos(self::$allowedChars, $character) !== FALSE){
				$out .= $character;
			}
		}			
		return $out;
	}
	
	public function __construct($path = null){
		if($path == null){
			//Add one directory above this file to the path.
			$path = dirname(dirname(__FILE__)) . "/";
		}
		$this->paths[] = $path;
	}
		
	public function loadClass($class){
		$class = self::sanitizeClassName($class);
		$relativePath = str_replace('_', "/", $class) . ".php";
		foreach($this->paths as $path){			
			if(file_exists($path . $relativePath)){
				include($path . $relativePath);
				return true;
			}				
		}
		return false;
	}	
		
	public function addPath($path){
		$paths[] = $path;
	}
	
}