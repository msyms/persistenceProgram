<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'company';

    //获取基础管理类
	public function getGroup()
	{
		return $this->belongsTo('App\Model\Checkgroup','category');
	}

    //
    public function safeOfficer()
    {
    	return $this->hasMany('App\Model\Comsafeofficer','companyId');
    }

    public function healthOfficer()
    {
    	return $this->hasMany('App\Model\Comhealthofficer','companyId');
    }
}
