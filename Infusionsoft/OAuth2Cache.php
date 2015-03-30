<?php

class Infusionsoft_OAuth2Cache extends Infusionsoft_SmartCache
{
	const TOKEN_CACHE_NAME = "oauth";
	const TOKEN_CACHE_TTL = 86400; // 24 hours
	const TOKEN_CACHE_DIR = "tokens";
	const MAX_DELAY = 3;
	const READ_DELAY = 300;
	const CACHE_CARGO_LENGTH = 512;
	
	/**
	 * @var Infusionsoft_OAuth2
	 */
	private $oAuth2;
	
	/**
	 * @var string
	 */
	private $code;

	public function __construct(Infusionsoft_OAuth2 $oAuth2, $code)
	{
		if (! defined('DS')) define('DS', DIRECTORY_SEPARATOR);
		parent::__construct(self::TOKEN_CACHE_NAME, self::TOKEN_CACHE_TTL, self::TOKEN_CACHE_DIR);
		Infusionsoft_SmartCache::setExternalCacheClassName(__CLASS__);
		$this->oAuth2 = $oAuth2;
		$this->code = $code;
	}

	/**
	 * @param string $fileName
	 */
	public static function read($fileName)
	{
		if (! $fh = @fopen($fileName, "r")) {return FALSE;}
		$delay = 0;
		while ( ! flock($fh, LOCK_SH | LOCK_NB) ) {
			$delay ++;
			if ($delay <= self::MAX_DELAY) {
				time_nanosleep(0, self::READ_DELAY);
			} else {
				throw new Exception("Unable to read token cache");
			}
		}
		
		$data = FALSE;
		if (! $data = fread($fh, self::CACHE_CARGO_LENGTH)) {return FALSE;}
		flock($fh, LOCK_UN);
		fclose($fh);
		return $data;
	}

	/**
	 * @param string $fileName
	 * @param string $data
	 */
	public static function write($fileName, $data)
	{
		$fh = fopen($fileName, "a+");
		$delay = 0;
		while ( ! flock($fh, LOCK_EX | LOCK_NB) ) {
			$delay ++;
			if ($delay <= self::MAX_DELAY) {
				time_nanosleep(0, self::READ_DELAY);
			} else {
				throw new Exception("Unable to write token cache");
			}
		}
		
		if (! ftruncate($fh, 0)) {throw new Exception("Unable to write token cache");}
		
		if (strlen($data) != fwrite($fh, $data)) {throw new Exception("Unable to write token cache");}
		
		if (! fflush($fh)) {throw new Exception("Unable to write token cache");}
		
		flock($fh, LOCK_UN);
		
		fclose($fh);
	}

	/**
	 * @param string $fileName
	 */
	public static function delete($fileName)
	{
		if (! $fh = @fopen($fileName, "r+")) {return FALSE;}
		$delay = 0;
		while ( ! flock($fh, LOCK_EX | LOCK_NB) ) {
			$delay ++;
			if ($delay <= self::MAX_DELAY) {
				time_nanosleep(0, self::READ_DELAY);
			} else {
				throw new Exception("Unable to delete token cache");
			}
		}
		
		if (! unlink($fileName)) {throw new Exception("Unable to delete token cache");}
		
		flock($fh, LOCK_UN);
		
		fclose($fh);
	}

	public function getDataFromSource()
	{
		
		/**
		 * @var Infusionsoft_OAuth2Token $result
		 */
		$result = $this->oAuth2->requestAccessToken($this->code);
		return array("accessToken" => $result->getAccessToken(), "refreshToken" => $result->getRefreshToken(), "tokenExpirationTime" => $result->getTokenExpirationTime());
	}
}