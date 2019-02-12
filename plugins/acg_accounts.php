<?php
/*
Plugin Name: GI Accounts Integration
Plugin URI: http://accounts.gi.org/
Description: I provide integration of GI Accounts into WordPress MU
Version: 0.1
Author: Matt Wood
Author URI: 
*/

require_once(ABSPATH . WPINC . "/RemoteFacade.php");
 // require_once(ABSPATH . WPINC . "/db_cache.php");
if(SERVERKEY == 'dev'){
	$accts_url = "http://accounts.acggi.net";
}else{
	$accts_url = "https://accounts.gi.org";
}
$accts_cookie_name = "GIAccounts";
$accts_psk = "xrkakcgnuxysc4f7a7kvkrmgdcic8bqytdppaoznu7zxyl2dw14sata3xmmx";
$accts_facade = $accts_url . "/account/verify";
$accts_app = $accts_url . "/account/verify?";

add_action("preprocess_author_data", "accts_preprocess_author_data");

function accts_preprocess_author_data($authordata) {
	global $user_ID;
	$user = wp_get_current_user();
	if ( !$user->ID ) {
		// we don't have a logged-in WordPress user
		if (accts_is_signed_in()) {
			// and they are a signed-in Mentor account
			$account = accts_get_account();
			$authordata["comment_author"] = $account->firstName . " " . $account->lastName;
			$authordata["comment_author_email"] = $account->email;
		}
	}
	return $authordata;
}

function accts_is_verified() {
	$acct = accts_get_account();
	return $acct !== false && $acct->isVerified() === true;
}

function accts_is_signed_in() {
	return accts_get_account() !== false;
}

function accts_get_account() {
	global $accts_cookie_name;
	if (! isset($_COOKIE[$accts_cookie_name])) {
		return false;
	}
	$token = $_COOKIE[$accts_cookie_name];
	$prefix = "accts_";
	//return site_db_cache($prefix . $token, "accts_getAccountFromToken", 20 * 60, null, array($token));
	if ( !session_id() ){
		session_start();
	}
	if(!isset($_SESSION['GItoken'])){
		$_SESSION['GItoken']="";
	}
	if($token != $_SESSION['GItoken']){
		return accts_getAccountFromToken($token);
	}else{
		$account = new Account();
		$account->id				= $_SESSION['account_id'];
		$account->firstName			= $_SESSION['account_firstName'];
		$account->lastName			= $_SESSION['account_lastName'];
		$account->email				= $_SESSION['account_email'];
		$account->acg_member_id		= $_SESSION['account_acg_member_id'];
		$account->journalaccess		= $_SESSION['account_journalaccess'];
		$account->rstatus		= $_SESSION['account_rstatus'];
		if(isset($_SESSION['account_w3token'])){
			$account->w3token = $_SESSION['account_w3token'];
			$account->w3signature = $_SESSION['account_w3signature'];
		}
		return $account;		
	}
}

function accts_get_accountid() {
	$account = accts_get_account();
	if ( $account === false ) {
		return false;
	} else {
		return $account->id;
	}
}

function accts_get_account_acg_member_id() {
	$account = accts_get_account();
	if ( $account === false ) {
		return false;
	} else {
		if($account->acg_member_id==0){
			return false;
		} elseif ($account->acg_member_id != 0 && strtolower($account->rstatus) == "pn") {
			return false;
		}else{
			return $account->acg_member_id;
		}
	}
}

function accts_get_account_acg_journal_access() {
	$account = accts_get_account();
	if ( $account === false ) {
		return false;
	} else {
		if($account->journalaccess=="True"){
			return true;
		}else{
			return false;
		}
	}
}

function accts_createaccount_url($returnUrl) {
	global $accts_app;
	return $accts_app . "createAccount&app=blogs&returnUrl=" . urlencode($returnUrl);
}

function accts_signin_url($returnUrl) {
	global $accts_app;
	return $accts_app . "signinAction&app=blogs&returnUrl=" . urlencode($returnUrl);
}

function accts_signout_url($returnUrl) {
	global $accts_url;
	return $accts_url . "/Account/Logout?returnUrl=" . urlencode($returnUrl);
}

function accts_forgotpassword_url($returnUrl) {
	global $accts_app;
	return $accts_app . "forgotPasswordForm&app=blogs&returnUrl=" . urlencode($returnUrl);
}

function accts_edit_account_url($returnUrl="") {
	global $accts_app;
	return $accts_app . "editAccount&app=blogs&returnUrl=" . urlencode($returnUrl);
}

function accts_getAccountFromToken($token) {
	global $accts_psk, $accts_facade;
	$facade = new JsonFacade($accts_facade . '?psk=' . $accts_psk . '&token=' . $token);
	$result = $facade->get();

	if ($result->info["http_code"] != 200) {
		throw new TokenValidationException("Token is invalid");
	}

	/*
	$account = new Account();
	$account->id				= intval($result->response->id);
	$account->firstName			= $result->response->firstName;
	$account->lastName			= $result->response->lastName;
	$account->email				= $result->response->email;
	$account->isCredentialed	= strtolower($result->response->isCredentialed) == "true";
	$account->isVerified		= strtolower($result->response->isVerified) == "true";
	*/
	
	$account = new Account();
	$account->id				= intval($result->response["id"]);
	$account->firstName			= $result->response["First"];
	$account->lastName			= $result->response["Last"];
	$account->email				= $result->response["email"];
	$account->acg_member_id		= intval($result->response["acg_member_id"]);
	$account->journalaccess		= $result->response["journalaccess"];
	$account->rstatus		= $result->response["rstatus"];
	if(isset($result->response["w3token"])){
		$account->w3token = $result->response["w3token"];
		$account->w3signature = $result->response["w3signature"];
	}
	
/*
	echo "<pre>";
	print_r($result);
	echo "</pre>";
	echo "<pre>";
	print_r($account);
	echo "</pre>";
	die();
*/
	$_SESSION['GItoken'] = $token;
	$_SESSION['account_id'] = $account->id;
	$_SESSION['account_firstName'] = $account->firstName;
	$_SESSION['account_lastName'] = $account->lastName;
	$_SESSION['account_email'] = $account->email;
	$_SESSION['account_acg_member_id'] = $account->acg_member_id;
	$_SESSION['account_journalaccess'] = $account->journalaccess;
	$_SESSION['account_rstatus'] = $account->rstatus;
	if(isset($result->response["w3token"])){
		$_SESSION['account_w3token'] = $account->w3token;
		$_SESSION['account_w3signature'] = $account->w3signature;
	}else{
		if(isset($_SESSION['account_w3token'])){
			unset($_SESSION['account_w3token']);
		}
		if(isset($_SESSION['account_w3signature'])){
			unset($_SESSION['account_w3signature']);
		}
	}
	
/*
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	die();
*/
	
	
/*
	$account->isCredentialed	= strtolower($result->response["isCredentialed"]) == "true";
	$account->isVerified		= strtolower($result->response["isVerified"]) == "true";
*/
	
	return $account;
}
class TokenValidationException extends Exception {}



class Account {
	var $id;
	var $firstName;
	var $lastName;
	var $email;
	var $acg_member_id;
	var $w3token;
	var $w3signature;
	var $journalaccess;
	var $rstatus;
/*
	var $isCredentialed;
	var $isVerified;
*/
}
?>
