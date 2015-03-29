<?php

class Infusionsoft_OAuth2Token implements Infusionsoft_IToken
{
	
	/**
	 * @var string
	 */
	protected $tokens = array();

	public function __construct(array $data)
	{
		if (isset($data["access_token"])) {
			$this->setAccessToken($data["access_token"]);
			unset($data["access_token"]);
		}
		
		if (isset($data["refresh_token"])) {
			$this->setRefreshToken($data["refresh_token"]);
			unset($data["refresh_token"]);
		}
		
		if (isset($data["expires_in"])) {
			$this->setTokenExpirationTime($data["expires_in"]);
			unset($data["expires_in"]);
		}
		
		if (count($data) > 0) {
			$this->setTokenCargo($data);
		}
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::setAccessToken()
	 */
	public function setAccessToken($token)
	{
		$this->tokens[self::TOKEN_ACCESS] = $token;
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::getAccessToken()
	 */
	public function getAccessToken()
	{
		return $this->tokens[self::TOKEN_ACCESS];
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::setRefreshToken()
	 */
	public function setRefreshToken($token)
	{
		$this->tokens[self::TOKEN_REFRESH] = $token;
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::getRefreshToken()
	 */
	public function getRefreshToken()
	{
		return $this->tokens[self::TOKEN_REFRESH];
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::setTokenExpirationTime()
	 */
	public function setTokenExpirationTime($expirationTime)
	{
		$this->token[self::TOKEN_EXPIRATION_TIME] = time() + $expirationTime;
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::getTokenExpirationTime()
	 */
	public function getTokenExpirationTime()
	{
		return $this->token[self::TOKEN_EXPIRATION_TIME];
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::setTokenCargo()
	 */
	public function setTokenCargo(array $cargo)
	{
		foreach ( $cargo as $key => $value ) {
			$this->token[self::TOKEN_CARGO][$key] = $value;
		}
	}

	/* (non-PHPdoc)
	 * @see Infusionsoft_IToken::getTokenCargo()
	 */
	public function getTokenCargo()
	{
		$r0 = array();
		foreach ( $this->token[self::TOKEN_CARGO] as $key => $value ) {
			$r0[$key] = $value;
		}
		return $r0;
	}
}