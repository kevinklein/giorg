<?php
class RemoteFacade {
	var $url;
	
	function RemoteFacade($url) {
		$this->url = $url;
	}
	
	function get($params = null) {
		return $this->makeRequest($params, false);
	}
	
	function post($params = null) { // pass a string or an associative array
		return $this->makeRequest($params);
	}
	
	// Don't use this method.  Really.  Use get() or post() instead.
	function makeRequest($params = null, $isPost = true) {
		$url = $this->url;
		if (! $isPost && $params != null) {
			if (is_array($params)) {
				$a = array();
				foreach ($params as $name => $value) {
					$a[] = $name . "=" . $value;
				}
				$params = implode("&", $a);
			}
			$url .= (strpos($url, "?") === false ? "?" : "&") . $params;
		}
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if ($isPost) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		$result = new RequestResult();
		$result->response = curl_exec($ch);
		$result->info = curl_getinfo($ch);
		curl_close($ch);
		if ($result->response === false || $result->info["http_code"] == 404 || $result->info["http_code"] == 503) {
			throw new ConnectionException("Could not connect to " . $this->url);
		}
		return $result;
	}
}

class JsonFacade {
	var $facade;
	
	function JsonFacade($url) {
		$this->facade = new RemoteFacade($url);
	}
	
	function get($params = null) {
		return $this->makeRequest($params, false);
	}
	
	function post($params = null) { // pass a string or an associative array
		return $this->makeRequest($params);
	}
	
	// Don't use this method.  Really.  Use get() or post() instead.
	function makeRequest($params = null, $isPost = true) {
		$result = $this->facade->makeRequest($params, $isPost);
		if ($result->info["http_code"] == 200) {
			$result->response = json_decode($result->response, true);
		}
		return $result;
	}
}

class ConnectionException extends Exception {}

class RequestResult {
	var $response;
	var $info;
}

?>