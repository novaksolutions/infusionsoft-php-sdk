<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 4/29/2015
 * Time: 4:47 PM
 */


/**
 * Class Infusionsoft_OAuth2
 * @package NovakSolutions\Infusionsoft
 * @static TokenStorageProvider $storageProvider
 */
class Infusionsoft_OAuth2 {
    public static $clientId = '';
    public static $clientSecret = '';

    public static $proxy = '';
    public static $useProxy = false;

    public static $redirectUri = '';

    const GRANT_TYPE_AUTHORIZATION_CODE = "authorization_code";
    const TOKEN_REQUEST_URI = "https://api.infusionsoft.com/token";
    const AUTHORIZATION_URI = "https://signin.infusionsoft.com/app/oauth/authorize";


    public static function getAuthorizationUrl(){
        if(static::$useProxy){
            $authorizeUrl = static::AUTHORIZATION_URI . "?client_id=" . static::$clientId . '&redirect_uri=' . static::$proxy . '&response_type=code&scope=full';
            return static::$proxy . '?authorizeUri=' . urlencode($authorizeUrl) . '&redirectUri=' . urlencode(static::$redirectUri);
        } else {
            $authorizeUrl = static::AUTHORIZATION_URI . "?client_id=" . static::$clientId . '&redirect_uri=' . static::$redirectUri . '&response_type=code&scope=full';
            return $authorizeUrl;
        }
    }

    public static function getToken($code){
        $params = array(
            'client_id'     => static::$clientId,
            'client_secret' => static::$clientSecret,
            'code'          => $code,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => static::$useProxy ? static::$proxy : static::$redirectUri,
        );

        $ch = curl_init(static::TOKEN_REQUEST_URI);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($params));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/infusionsoft.pem');



        //curl_setopt()
        $response = curl_exec($ch);

        if($response == false){
            $curlError = curl_error($ch);
            curl_close($ch);
            throw new Exception($curlError);
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        return $decodedResponse;
    }

    public static function processAuthenticationResponseIfPresent(){
        if(isset($_GET['scope']) && isset($_GET['code'])){
            self::processAuthenticationScopeAndCode($_GET['scope'], $_GET['code']);
        }
    }

    public static function processAuthenticationScopeAndCode($scope, $code){
        $parts = explode("|", $scope);
        $scope = array_shift($parts);
        $appDomain = array_shift($parts);
        $response = static::getToken($code);
        if(isset($response['error'])){
            throw new Exception($response['error_description']);
        }
        /** @var Infusionsoft_App $app */
        $app = Infusionsoft_AppPool::getApp($appDomain);
        if($app == null){
            $app = new Infusionsoft_App($appDomain);
        }
        $app->updateAndSaveTokens($response['access_token'], $response['refresh_token'], $response['expires_in']);
        return true;
    }

    public static function refreshToken($refreshToken){
        $params = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken
        );

        $ch = curl_init(static::TOKEN_REQUEST_URI);

        curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($params));
        curl_setopt($ch, CURLOPT_USERPWD,  static::$clientId . ':' . static::$clientSecret);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/infusionsoft.pem');

        //curl_setopt()
        $response = curl_exec($ch);

        if($response == false){
            $curlError = curl_error($ch);
            curl_close($ch);
            throw new Exception($curlError);
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        if(isset($decodedResponse['error'])){
            throw new Exception($decodedResponse['error_description']);
        }

        return $decodedResponse;
    }
} 