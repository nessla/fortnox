<?php

/**
 * @Author: Phu Hoang
 * @Date:   2016-01-11 13:19:26
 * @Last Modified by:   Phu Hoang
 * @Last Modified time: 2016-02-22 11:50:12
 */

namespace hmphu\fortnox\api;

use GuzzleHttp\Client;
use hmphu\fortnox\request\Exception;
use hmphu\fortnox\FortnoxConfig;
use hmphu\fortnox\Util;

/**
 * Class ApiAbstract
 * @package hmphu\fortnox\api
 */
abstract class ApiAbstract
{
	const API_URL = 'api.fortnox.se/3';

    /**
     * @var string
     */
    protected $url;
    
    /**
     * @var string
     */
    protected $response;
    
    /**
     * @var FortnoxConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $accessToken;
    
    /**
     * @param $config
     */
    function __construct(FortnoxConfig $config, $https = true) {
    	$this->config = $config;
    	$this->url = ($https ? 'https://' : 'http://') . self::API_URL;
    }
    
    /**
     * @param $methodName
     * @param RequestInterface $request
     * @return mixed
     */
    public function call($endpoint, $request) {
    	$client = new Client(['verify' => false]);
    	
    	$parameters = array_merge($this->config->getParameterArray(), $request->getParameterArray());
    	try {
    		$res = $client->request(
				$request->method,
				$this->url . $endpoint,
				array_merge([
					'headers' => [
						'Accept' => 'application/json',
						'Client-Secret' => $this->config->clientSecret,
						'Access-Token' => $this->config->accessToken
					]
				], $parameters)
	        );

	    	$this->response = $res;
	    	return $res;	
    	} catch (\Exception $e) {
            $json = $this->parseJsonResponse($e->getResponse());

            if(isset($json['ErrorInformation'])) {
                $error = $json['ErrorInformation'];
                if(isset($error['error'])) {
                    throw new Exception(sprintf("ERROR: %s (%s)", $error['error'], $error['message']), $error['code']);
                }
            }
            throw $e;
    	}

    	return false;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param string $dataKey json key to move to before returning
     * @param array $options
     * @return array
     */
    protected function callJson($endpoint, $request, $dataKey = '') {
    	$res = $this->call($endpoint, $request);
    	$json = $this->parseJsonResponse($res);
    	if ( $dataKey !== '' ) {
    		$json = $json[$dataKey];
    	}
    	return $json;
    }


     /**
     * @param string $endpoint
     * @param string $dataKey
     * @param array $options
     * @return array
     */
     protected function getPaginated($endpoint, $request, $dataKey) {
     	$response = $this->call($endpoint, $request);
     	$parsed = $this->parseJsonResponse($response);
     	$items = $parsed[$dataKey];
     	return $items;
     }
     
     /**
     * @param Respond $res
     * @return array
     */
     protected function parseJsonResponse($res) {
     	return json_decode((string) $res->getBody(), $assoc = true);
     }

     /**
     * @return ResponseInterface
     */
     public function getResponse() {
     	return $this->response;
     }
 }
