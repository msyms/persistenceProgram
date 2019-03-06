<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Company;

class Comcheck extends Model
{
    //
    protected $table = 'comcheck';

    public function getCompany()
    {
    	return $this->belongsTo('App\Model\Company','companyId');
    }

}
