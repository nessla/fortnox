<?php

namespace hmphu\fortnox\api;
use hmphu\fortnox\request\VoucherfileConnectionRequest;
use hmphu\fortnox\models\BaseModel;

/**
 * Class VoucherfileConnectionApi
 * @package hmphu\fortnox\api
 */
class VoucherfileConnectionApi extends ApiAbstract implements ApiInterface
{

   /**
     * @param $page Current page
     * @param $limit Total items per page
     * @param $query Search & Filters param
     * @return string[][] array of suppliers
     */
    public function all($page = 0, $limit = 10, $query = []) {
        return false;
    }

    /**
     * @param string $id
     * @return string[] supplier
     */
    public function get($id) {
        return false;
    }

    /**
     * @param string SupplierNumber
     * @param Supplier $data
     * @return Supplier
     */
    public function update($supplierNumber, BaseModel $data) {
        return false;
    }

    /**
     * Delete supplier
     * @param string supplierNumber
     */
    public function delete($supplierNumber){
        return false;
    }
 
    /**
     * @param BaseModel $data
     * @param string $year
     * @return VoucherFileConnection
     */
    public function create(BaseModel $data, $year) {
    	$request = new VoucherfileConnectionRequest($data);
    	$request->method = 'POST';
        $data = $this->callJson('/voucherfileconnections?financialyeardate=' . $year, $request, 'VoucherFileConnection');
        if(is_array($data)){
        	return new VoucherFileConnection($data);
        }
    }
}
