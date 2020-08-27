<?php

namespace hmphu\fortnox\request;

use hmphu\fortnox\models\VoucherFileConnection;

/**
 * Class VoucherfileConnectionRequest
 * @package hmphu\fortnox\request
 */
class VoucherfileConnectionRequest extends RequestAbstract implements RequestInterface
{
    /**
     * @param string $fileId
     * @param int $VoucherNumber
     * @param string $VoucherSeries
     */
    function __construct($fileId, $VoucherNumber, $VoucherSeries){
        $this->parameters['json'] = [
            'VoucherFileConnection' => [
                'FileId' => $fileId,
                'VoucherNumber' => $VoucherNumber,
                'VoucherSeries' => $VoucherSeries,
            ]
        ];
    }
}
