<?php
/**
 * phpunit -c PHPUnit_OAuth2.xml test-OAuth2Token.php
 */
require_once ("vendor/autoload.php");
require_once ("../Infusionsoft/infusionsoft.php");

class MockHttpClient
{
	const MOCK_ACCESS_TOKEN = "sample access token";
	const MOCK_REFRESH_TOKEN = "sample refresh token";
	const MOCK_EXPIRE_INTERVAL = 10;

	public function __construct()
	{
	}

	public function request()
	{
		return array("access_token" => self::MOCK_ACCESS_TOKEN, 
				"refresh_token" => self::MOCK_REFRESH_TOKEN, 
				"expires_in" => self::MOCK_EXPIRE_INTERVAL);
	}
}

class MockOAuth2 extends Infusionsoft_OAuth2
{
	private $mockHttpClient;

	public function __construct(array $argList)
	{
		parent::__construct($argList);
		$this->mockHttpClient = new MockHttpClient();
	}

	public function getClientId()
	{
		return $this->clientId;
	}

	public function getClientSecret()
	{
		return $this->clientSecret;
	}

	public function getRedirectUri()
	{
		return $this->redirectUri;
	}

	public function getHttpClient()
	{
		return $this->mockHttpClient;
	}
}

class TestOAuth2 extends PHPUnit_Framework_TestCase
{
	const MOCK_CLIENT_ID = "client id";
	const MOCK_CLIENT_SECRET = "client secret";
	const MOCK_REDIRECT_URI = "http://example.com";
	const MOCK_ACCESS_CODE = "access code";
	
	private $logger;

	public function __construct()
	{
	}

	/**
	 * Tests:
	 *  OAuth2 constructor with client ID, client secret, redirect URI
	 *  __construct()
	 */
	public function testOAuth2_00()
	{		
		$oAuth2 = new MockOAuth2(array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		
		$this->assertEquals(self::MOCK_CLIENT_ID, $oAuth2->getClientId());
		$this->assertEquals(self::MOCK_CLIENT_SECRET, $oAuth2->getClientSecret());
		$this->assertEquals(self::MOCK_REDIRECT_URI, $oAuth2->getRedirectUri());
	}

	/**
	 * Tests:
	 *  OAuth2 constructor with client ID, client secret, redirect URI
	 *  setToken()
	 *  getToken()
	 *  requestAccessToken()
	 */
	public function testOAuth2_01()
	{		
		$oAuth2 = new MockOAuth2(array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		
		$token = $oAuth2->getData(self::MOCK_ACCESS_CODE);
		
		$r2 = array(MockHttpClient::MOCK_EXPIRE_INTERVAL, time());
		$r2[2] = ($r2[0] + $r2[1]);
		
		$this->assertEquals(MockHttpClient::MOCK_ACCESS_TOKEN, $token->getAccessToken());
		$this->assertEquals(MockHttpClient::MOCK_REFRESH_TOKEN, $token->getRefreshToken());
		$this->assertGreaterThan(MockHttpClient::MOCK_EXPIRE_INTERVAL, $token->getTokenExpirationTime());
		$this->assertLessThanOrEqual($r2[2], $token->getTokenExpirationTime());
	}
	
	/**
	 * Tests:
	 *  getAuthorizationUrl()
	 */
	public function testOAuth2_02()
	{
		$oAuth2 = new MockOAuth2(array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		
		$url = $oAuth2->getAuthorizationUrl();
				
		$this->assertContains(Infusionsoft_OAuth2::AUTHORIZATION_URL, $url);
		$this->assertContains(urlencode(self::MOCK_CLIENT_ID), parse_url($url, PHP_URL_QUERY));
	}

}