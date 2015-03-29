<?php

interface Infusionsoft_IToken
{
	/*
	 * token keys
	 */
	const TOKEN_EXPIRATION_TIME = "expirationTime";
	const TOKEN_REFRESH = "refresh";
	const TOKEN_ACCESS = "access";
	const TOKEN_CARGO = "cargo";

	/**
	 * Set the current access token
	 * 
	 * @param string $token
	 */
	public function setAccessToken($token);

	/**
	 * Return the current access token
	 * @return string current access token
	 */
	public function getAccessToken();

	/**
	 * Set the current refresh token
	 * 
	 * @param string $token
	 */
	public function setRefreshToken($token);

	/**
	 * Return the current refresh token
	 * @return string current refresh token
	 */
	public function getRefreshToken();

	/**
	 * Set the current access token expiration time 
	 * 
	 * @param int expirationTime
	 */
	public function setTokenExpirationTime($expirationTime);

	/**
	 * Return the current token cargo 
	 * @return int current token expiration time
	 */
	public function getTokenExpirationTime();

	/**
	 * Set the current token cargo
	 * 
	 * Cargo is an array of whatever data remains after setting access and refresh tokens, access lifetime
	 * 
	 * @param array cargo
	 */
	public function setTokenCargo(array $cargo);

	/**
	 * Return the current token cargo
	 * @return array current token cargo
	 */
	public function getTokenCargo();
}