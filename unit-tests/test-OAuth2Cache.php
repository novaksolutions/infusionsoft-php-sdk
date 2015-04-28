<?php
/**
 * phpunit -c PHPUnit_OAuth2.xml test-OAuth2Cache.php
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

class TestOAuth2Cache extends PHPUnit_Framework_TestCase
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
	 *  OAuth2Cache constructor with client ID, client secret, redirect URI
	 *  __construct()
	 */
	public function testOAuth2Cache_00()
	{
		$oAuth2 = new MockOAuth2(
				array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		$oAuth2Cache = new Infusionsoft_OAuth2Cache($oAuth2, self::MOCK_ACCESS_CODE);
		$this->assertInstanceOf("Infusionsoft_SmartCache", $oAuth2Cache);
	}

	/**
	 * Tests:
	 *  Expire cache data
	 *  expireCache()
	 */
	public function testOAuth2Cache_01()
	{
		$oAuth2 = new MockOAuth2(
				array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		$oAuth2Cache = new Infusionsoft_OAuth2Cache($oAuth2, self::MOCK_ACCESS_CODE);
		$oAuth2Cache->expireCache();
		$this->assertFileNotExists($oAuth2Cache->getCacheFileName());
	}

	/**
	 * Tests:
	 *  Read cache data
	 *  getData()
	 */
	public function testOAuth2Cache_02()
	{
		$oAuth2 = new MockOAuth2(
				array("clientId" => self::MOCK_CLIENT_ID, "clientSecret" => self::MOCK_CLIENT_SECRET, "redirectUri" => self::MOCK_REDIRECT_URI));
		$oAuth2Cache = new Infusionsoft_OAuth2Cache($oAuth2, self::MOCK_ACCESS_CODE);
		$result = $oAuth2Cache->getData();
		$this->assertEquals(MockHttpClient::MOCK_ACCESS_TOKEN, $result["accessToken"]);
		$this->assertEquals(MockHttpClient::MOCK_REFRESH_TOKEN, $result["refreshToken"]);
		
		$r0 = MockHttpClient::MOCK_EXPIRE_INTERVAL;
		$r1 = time();
		$r2 = $r0 + $r1;
		
		$this->assertGreaterThan($r1, $result["tokenExpirationTime"]);
		$this->assertLessThanOrEqual($r2, $result["tokenExpirationTime"]);
	}
}