<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Company;
use App\Model\Checknegative;

use DB;

class Comcheck extends Model
{
    //
    protected $table = 'comcheck';

	public $timestamps = false;
    public function getCompany()
    {
    	return $this->belongsTo('App\Model\Company','companyId');
    }

    public function getStandardNegative($componyId)
    {
    	$details = DB::select("select detail.* from comcheckdetail detail 
    				left join comcheck on detail.checkId = comcheck.id
    				where comcheck.companyId = $componyId and detail.status = 2 and comcheck.status = 1 ");
    	$negativeStr = '';
    	foreach($details as $k => $v)
    	{
            if($v->negatives) {
                $negativeStr .= $v->negatives;
            }
    		
    	}
        $negative = explode(',', substr($negativeStr, 0, -1));
    	$rs = Checknegative::wherein('id',$negative)->get();
    	return $rs;
    }

    public function getProductNegative($componyId)
    {
    	$details = DB::select("select detail.* from comcheckdetail detail 
    				left join comcheck on detail.checkId = comcheck.id
    				where comcheck.companyId = $componyId and detail.status = 2 and comcheck.status = 2 ");
    	$negativeStr = '';
    	foreach($details as $k => $v)
    	{
            if($v->negatives) {
                $negativeStr .= $v->negatives;
            }
    		
    	}
        $negative = explode(',', substr($negativeStr, 0, -1));
    	$rs = Checknegative::wherein('id',$negative)->get();
    	return $rs;
    }

}
