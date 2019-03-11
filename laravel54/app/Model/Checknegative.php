<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Comcheckdetail;

use DB;
class Checknegative extends Model
{
    //
    protected $table = 'checknegative';

    public function getChecknegative($checkId)
    {
    	$detail = Comcheckdetail::where(['checkId'=>$checkId,'status'=>2])->get();
        dd($detail);
    	$negativeStr = '';
    	foreach($detail as $k => $v)
    	{
            if($v['negatives']) {
                $negativeStr .= $v['negatives'].',';
            }
    		
    	}
        $negative = explode(',', substr($negativeStr, 0, -1));
    	$rs = self::wherein('id',$negative)->get();
    	return $rs;
    }
}
