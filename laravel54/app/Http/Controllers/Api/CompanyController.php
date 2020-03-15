<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\Model\Comhealthofficer;
use App\Model\Comsafeofficer;
use App\Model\Company;

class CompanyController extends Controller
{

    public function create(Request $request)
    {
    	$company = $request->input('company');
    	$rules = [
            'company.comName' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
            'unique' => ':attribute已经存在.'
        ];
        $attributes  = [
        	'company.comName' => '公司名称',
        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()->first()], 402);
        }
    	if ($request->hasFile('photo')) {
	        $picture = $request->file('photo');
	        if (!$picture->isValid()) {
	            abort(400, '无效的上传文件');
	        }
	        // 文件扩展名
	        $extension = $picture->getClientOriginalExtension();
	        // 文件名
	        $fileName = $picture->getClientOriginalName();
	        // 生成新的统一格式的文件名
	        $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
	        // 图片保存路径
	        $savePath = 'images/' . $newFileName;
	        // Web 访问路径
	        $webPath = '/storage/' . $savePath;

	        $picture->storePubliclyAs('images', $newFileName, ['disk' => 'public']);

		    $company['photo'] = $webPath;
		}
		try {
			$id = Company::insertGetId($company);
		    $healthInfo = $request->input('health');
		    if($healthInfo['name'])
		    {
		    	$healthInfo['companyId'] = $id;
		    	Comhealthofficer::insert($healthInfo);
		    }
	    	$safeInfo = $request->input('safe');
	    	if($safeInfo['name'])
	    	{
	    		$safeInfo['companyId'] = $id;
	    		Comsafeofficer::insert($safeInfo);
	    	}
	    	$data['id'] = $id;
		} catch(\Exception $e) {
			return response()->json(['data' => '插入失败',400],200);
		}
    	return response()->json(['data' => $data,'code' => 200], 200);
    }

    public function update(CompanyRequest $request)
    {

    	$company = $request->input('company');
    	$id = $request->input('id');
    	$healthInfo = $request->input('health');
    	$safeInfo = $request->input('safe');
    	Company::where('id', '=', $id)->update($company);
    }

    public function search(Request $quest)
    {
    	$name = $quest->input('name');
    	$companys = Company::where('comName','like','%'.$name.'%')->get(['id','comName']);
    	return response()->json(['data' => $companys,'code' => 200], 200);
    }

    public function fileUpload(Request $request)
	{
	    if ($request->hasFile('picture')) {
	        $picture = $request->file('picture');
	        if (!$picture->isValid()) {
	            abort(400, '无效的上传文件');
	        }
	        // 文件扩展名
	        $extension = $picture->getClientOriginalExtension();
	        // 文件名
	        $fileName = $picture->getClientOriginalName();
	        // 生成新的统一格式的文件名
	        $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
	        // 图片保存路径
	        $savePath = 'images/' . $newFileName;
	        // Web 访问路径
	        $webPath = '/storage/' . $savePath;
	        // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在，如果存在直接返回
	        if (Storage::disk('public')->has($savePath)) {
	            return response()->json(['path' => $webPath]);
	        }
	        // 否则执行保存操作，保存成功将访问路径返回给调用方
	        if ($picture->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
	            return response()->json(['path' => $webPath]);
	        }
	        abort(500, '文件上传失败');
	    } else {
	        abort(400, '请选择要上传的文件');
	    }
	}
}
