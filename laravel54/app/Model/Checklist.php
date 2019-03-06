<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Comcheckdetail;

use DB;
class Checklist extends Model
{
    //
    protected $table = 'checklist';

    public function getCompanyList($checkId)
    {
    	$detail = Comcheckdetail::where('checkId',$checkId)->get();
    	$list = [];
    	foreach($detail as $k => $v)
    	{
    		$detaillist = explode(',',$v['lists']);
    		array_push($list, $detaillist);
    	}
    	$rs = self::wherein($id,$list)->get();
    	return $rs;
    }
}
