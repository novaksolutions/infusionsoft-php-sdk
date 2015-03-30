<?php

class Infusionsoft_OAuth2 extends Infusionsoft_App
{
	const GRANT_TYPE_AUTHORIZATION_CODE = "authorization_code";
	const TOKEN_REQUEST_URL = "https://api.infusionsoft.com/token";
	const AUTHORIZATION_URL = "https://signin.infusionsoft.com/app/oauth/authorize";
	
	/**
	 * @var string
	 */
	protected $clientId;
	
	/**
	 * @var string
	 */
	protected $clientSecret;
	
	/**
	 * @var string
	 */
	protected $redirectUri;
	
	/**
	 * @var string
	 */
	protected $state;
	
	/**
	 * @var OAuth2Token
	 */
	protected $token;

	public function __construct(array $argList)
	{
		$this->clientId = isset($argList["clientId"]) ? $argList["clientId"] : "";
		$this->clientSecret = isset($argList["clientSecret"]) ? $argList["clientSecret"] : "";
		$this->redirectUri = isset($argList["redirectUri"]) ? $argList["redirectUri"] : "";
		$this->state = isset($argList["state"]) ? Infusionsoft_OAuth2::base64UrlEncode($argList["state"]) : "";
	}

	/**
	 * Set the current session token
	 * @param OAuth2Token $token
	 */
	public function setToken(Infusionsoft_OAuth2Token $token)
	{
		$this->token = $token;
	}

	/**
	 * Get the current session token
	 * 
	 * @return OAuth2Token
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @return string
	 */
	public function getAuthorizationUrl()
	{
		$params = array("client_id" => $this->clientId, "redirect_uri" => $this->redirectUri, "response_type" => "code", "scope" => "full");
		if ("" != $this->state) {
			$params["state"] = $this->state;
		}
		return self::AUTHORIZATION_URL . "?" . http_build_query($params);
	}

	public function getDataFromSource($code)
	{
		$data = $this->requestAccessToken($code);
	}

	/**
	 * @param string $code
	 * @return array
	 * @throws InfusionsoftException
	 */
	public function requestAccessToken($code)
	{
		$params = array("client_id" => $this->clientId, 
				"client_secret" => $this->clientSecret, 
				"code" => $code, 
				"grant_type" => self::GRANT_TYPE_AUTHORIZATION_CODE, 
				"redirect_uri" => $this->redirectUri);
		
		$client = $this->getHttpClient();
		
		$tokenInfo = $client->request(self::TOKEN_REQUEST_URL, $params, array(), "POST");
		
		$this->setToken(new Infusionsoft_OAuth2Token($tokenInfo));
		
		return $this->getToken();
	}

	public static function base64UrlEncode($inputStr)
	{
		return strtr(base64_encode($inputStr), '+/=', '-_,');
	}

	public static function base64UrlDecode($inputStr)
	{
		return base64_decode(strtr($inputStr, '-_,', '+/='));
	}
}