<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class Comcheckdetail extends Model
{
    //

    protected $table = 'comcheckdetail';
    public function addAll(Array $data)
 	{
      $rs = DB::table($this->getTable())->insert($data);
      return $rs;
  	}

  	public function getInconform($id)
  	{
  		$rs = DB::select("select checkentry.* from comcheckdetail detail 
  						left join checkentry 
  						on checkentry.id = detail.entryId 
  						where detail.checkId = $id and detail.status = 2 ");
  		return $rs;
  	}


}
