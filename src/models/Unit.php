<?php

/**
 * @Author: Phu Hoang
 * @Date:   2016-01-13 10:14:56
 * @Last Modified by:   Phu Hoang
 * @Last Modified time: 2016-01-14 11:14:41
 */

namespace hmphu\fortnox\models;

/**
 * Class Unit
 * @package hmphu\fortnox\models
 */
class Unit extends BaseModel
{

    /**
     * Direct URL to the record
     * @var string
     */
    private $Url;

    /**
     * The code of the unit
     * @var string
     */
    public $Code;

    /**
     * The description of the unit
     * @var string
     */
    public $Description;
}
