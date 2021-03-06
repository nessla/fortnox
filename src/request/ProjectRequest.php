<?php

/**
 * @Author: Phu Hoang
 * @Date:   2016-01-11 13:43:28
 * @Last Modified by:   Phu Hoang
 * @Last Modified time: 2016-01-11 17:27:43
 */

namespace hmphu\fortnox\request;

/**
 * Class ProjectRequest
 * @package hmphu\fortnox\request
 */
class ProjectRequest extends RequestAbstract implements RequestInterface
{
	/**
	 * @data Array
	 */
	function __construct(array $data = []){
		if(!empty($data)){
			$this->parameters['json'] = [
				'Project' => $data
	        ];
		}
	}
}
