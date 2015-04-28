<?php
/**
 * phpunit -c PHPUnit_OAuth2.xml test-OAuth2Token.php
 */
require_once ("vendor/autoload.php");
require_once ("../Infusionsoft/infusionsoft.php");

class TestOAuth2Token extends PHPUnit_Framework_TestCase
{
	private $logger;

	public function __construct()
	{
		// $this->logger = new \Katzgrau\KLogger\Logger("logs", \Psr\Log\LogLevel::DEBUG);
		// Infusionsoft_AppPool::addApp(new Infusionsoft_App(AppId . ".infusionsoft.com", ApiKey));
	}

	/**
	 * Tests:
	 *  Token constructor with access_token key
	 *  getAccessToken()
	 */
	public function testOAuth2Token_00()
	{
		$r0 = "sample access token";
		
		$token = new Infusionsoft_OAuth2Token(array("access_token" => $r0));
		
		$this->assertEquals($r0, $token->getAccessToken());
	}

	/**
	 * Tests:
	 *  Token constructor with refresh_token key
	 *  getRefreshToken()
	 */
	public function testOAuth2Token_01()
	{
		$r0 = "sample refresh token";
		
		$token = new Infusionsoft_OAuth2Token(array("refresh_token" => $r0));
		
		$this->assertEquals($r0, $token->getRefreshToken());
	}

	/**
	 * Tests:
	 *  Token constructor with expires_in key
	 *  getTokenExpirationTime()
	 */
	public function testOAuth2Token_02()
	{
		$r0 = 10;
		$r1 = time();
		$r2 = $r0 + $r1;
		$token = new Infusionsoft_OAuth2Token(array("expires_in" => $r0));
		
		$this->assertGreaterThan($r1, $token->getTokenExpirationTime());
		$this->assertLessThanOrEqual($r2, $token->getTokenExpirationTime());
	}

	/**
	 * Tests:
	 *  Token constructor with cargo data
	 *  getTokenCargo()
	 */
	public function testOAuth2Token_03()
	{
		$r0 = array("token", "cargo");
		
		$token = new Infusionsoft_OAuth2Token(array("extra" => $r0));
		
		$result = $token->getTokenCargo();
		$this->assertEquals($r0[0], $result["extra"][0]);
		$this->assertEquals($r0[1], $result["extra"][1]);
	}

	/**
	 * Tests:
	 *  Token constructor with access token, refresh token, access token lifetime, token cargo
	 *  getAccessToken()
	 *  getRefreshToken()
	 *  getTokenExpirationTime()
	 *  getTokenCargo()
	 */
	public function testOAuth2Token_04()
	{
		$r0 = "sample access token";
		$r1 = "sample refresh token";
		$r2 = array(10, time());
		$r2[2] = ($r2[0] + $r2[1]);
		$r3 = array("token", "cargo");
		
		$token = new Infusionsoft_OAuth2Token(array("access_token" => $r0, "refresh_token" => $r1, "expires_in" => $r2[0], "extra" => $r3));
		
		$this->assertEquals($r0, $token->getAccessToken());
		$this->assertEquals($r1, $token->getRefreshToken());
		$this->assertGreaterThan($r2[1], $token->getTokenExpirationTime());
		$this->assertLessThanOrEqual($r2[2], $token->getTokenExpirationTime());
		
		$result = $token->getTokenCargo();
		$this->assertEquals($r3[0], $result["extra"][0]);
		$this->assertEquals($r3[1], $result["extra"][1]);
	}
}