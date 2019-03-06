<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;


class Checkgroup extends Model
{
	protected $table = 'checkgroup';

	public function getGroup()
	{
		return $this->belongsTo('Models\Company','category');
	}
    //
    public function getEntry($ids)
    {
    	// $groupInfo = Checkgroup::find($groupId);
    	$checkentry = DB::select("select * from checkentry where id in ( {$ids} ) order by id desc ");
    	return $checkentry;
    }
}
