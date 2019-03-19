<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

use App\Http\Controllers\Controller;

use Validator;

use App\Model\Checkgroup;
use App\Model\Checknegative;
use App\Model\Checkaccord;
use App\Model\Checkcommand;
use App\Model\Company;
use App\Model\Comcheck;
use App\Model\Comcheckdetail;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRequest;

class ComcheckController extends Controller
{
	public function choose(Request $request) {
        $rules = [
            'id' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $id = $request->input('id');
		$company = Company::find($id)->getGroup()->first();
		$entryIds = $company->entryIds;
        $groupId = $company->id;
        $comcheck = Comcheck::where(['companyId'=>$id,'groupId'=>$groupId])->select('id')->first();
        $productCheck = Comcheck::where(['companyId'=>$id,'status'=>2])->select('id')->first();
        $checkId = 0;
        $productCheckId = 0;
        if($comcheck){
            $checkId = $comcheck->id;
        }
        if($productCheck) {
            $productCheckId = $productCheck->id;
        }
		$checkgroup = new Checkgroup();
	    $entry = $checkgroup->getEntry($entryIds);
        $data = [];
        // $data['entry'] = $entry;
        $data['checkId'] = $checkId;
        $data['productCheckId'] = $productCheckId;
        $data['id'] = $id;
    	return response()->json(['data' => $data], 200);
    }
    public function show(Request $request) {
        $rules = [
            'id' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), 'code' => '400'], 402);
        }
        $id = $request->input('id');
        $groupId = $request->input('groupId');
        if($groupId) {
            $group = Checkgroup::where('id',$groupId)->first();
            $entryIds = $group->entryIds;
        } else {
            $group = Company::find($id)->getGroup()->first();
            $entryIds = $group->entryIds;
            $groupId = $group->id;
        }
		$checkgroup = new Checkgroup();
	    $entrys = $checkgroup->getEntry($entryIds);
        return response()->json(['data' => $entrys,'code' => 200 ], 200);
    }

    public function create(Request $request) {
        try {
            $rules = [
                'companyId' => 'required',
                'groupId' => 'required'
            ];
            $messages = [
                'required' => ':attribute不能为空.',
            ];
            $attributes  = [
                'groupId' => '检查分类不能为空'
            ];
            $validator = Validator::make($request->all(),$rules,$messages);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors()], 402);
            }
            $data = $request->all();
            $check['companyId'] = $data['companyId'];
            $check['groupId'] = $data['groupId'];

            $user = Auth::user();
            $check['userId'] = $user->id;
            $check['created'] = date('Y-m-d H:i:s',time());
            $groupinfo = Checkgroup::find($data['groupId']);
            if(!$groupinfo) {
                return response()->json(['data' => '分类没有检查项'], 402);
            }
            //基础项还是生产项
            $status = $groupinfo->status;
            $check['status'] = $status;
            $comcheck = Comcheck::where(['companyId'=>$check['companyId'],'groupId'=>$check['groupId']])->first();
            if($comcheck){
                return response()->json(['data' => '初查已完成'], 200);
            }
            $checkId = Comcheck::insertGetId($check);
            $entryIds = $data['entryId'];
            $statuses = $data['status'];
            $contents = $data['content'];
            $negatives = $data['negative'];
            foreach ($entryIds as $k => $v) {
                $checkdetail[$k]['checkId'] = $checkId;
                $checkdetail[$k]['userId'] = $user->id;
                $checkdetail[$k]['entryId'] = $v;
            }
            foreach ($statuses as $k => $v) {
                $checkdetail[$k]['status'] = $v;
            }
            foreach ($contents as $k => $v) {
                $checkdetail[$k]['content'] = $v;
            }
            foreach ($negatives as $k => $v) {
                $checkdetail[$k]['negatives'] = $v;
            }
            // foreach ($checkdetail as $k => $v) {
            //     $checkdetail[$k]['negatives'] = '';
            //     foreach ($negatives as $kk => $vv) {
            //         if($v['entryId'] == $kk){
            //             $checkdetail[$k]['negatives'] = $vv;
            //         }
            //     }
            // }
            $result = [];
            $result['checkId'] = $checkId;
            $comCheckdetail = new Comcheckdetail();
            $comCheckdetail->addAll($checkdetail);
            return response()->json(['data' => $result,'code' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => '信息录入失败'], 400);
        }
        
    }


    public function inconform(Request $request)
    {
        $rules = [
            'checkId' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $checkId = $request->input('checkId');
        $detail = new Comcheckdetail();
        $comcheck = Comcheck::find($checkId);
        $infos = $detail->getInconform($checkId);
        return response()->json(['data' => $infos,'code'=>200], 200);
    }

    public function inconformdel(Request $request)
    {
        $rules = [
            'detailId' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $detailId = $request->input('detailId');
        $detail = Comcheckdetail::find($detailId);
        $checkId = $detail->checkId;
        $detail->status = '1';
        $detail->save();
        return response()->json(['data' => '删除成功','code' => 200], 200);
    }


    /**
     * 生成第一个检测报告
     *
     **/
    protected function exportWord1(Request $request)
    {
        $rules = [
            'companyId' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $companyId = $request->input('companyId');
        $company = Company::find($companyId);
        $comcheck = new Comcheck();
        $checkinfo = $comcheck->where(['companyId'=>$companyId,'status'=>1])->first();
        if(!$checkinfo) {
            return response()->json(['data' => '基础管理类未完成','code' => 400], 200);
        }
        $productinfo = $comcheck->where(['companyId'=>$companyId,'status'=>2])->first();
        if(!$productinfo) {
            return response()->json(['data' => '生产现场类未完成','code' => 400], 200);
        }
        $created = date('Y-m-d',strtotime($checkinfo->created));
        $year = date('Y',strtotime($checkinfo->created));
        $month = date('m',strtotime($checkinfo->created));
        $day = date('d',strtotime($checkinfo->created));

        // $company = Comcheck::find($id)->getCompany()->first();
        //负面清单
        $standardNegative = $comcheck->getStandardNegative($companyId);
        $productNegative = $comcheck->getProductNegative($companyId);
        $templateProcessor =  new TemplateProcessor('./word/word1.docx');
        $comName = $company->comName;
        $data['comName'] = $comName;
        $data['address'] = $company->address;
        $data['year'] = $year;
        $data['month'] = $month;
        $data['day'] = $day;
        $data['archives'] = '';
        $data['danger'] = '';
        $i = 0;
        $j = 0;
        foreach($standardNegative as $k => $v)
        {
            $i++;
            $data['archives'] .= '('.$i.')'.$v['content'].'<w:br />'; 
        }
        foreach ($productNegative as $k => $v) {
            $j++;
            $data['danger'] .= '('.$j.')'.$v['content'].'<w:br />'; 
        }
        // $templateProcessor->setValue('comName','青科安全');
        foreach($data as $k=>$v){
            $templateProcessor->setValue($k,$v);
        }
        $docName = $comName.'检测报告1_' . $created;
        $wordUrl = './word/'.$docName.'.docx';
        $templateProcessor->saveAs($wordUrl);
        $checkinfo->wordsUrl = $wordUrl;
        $checkinfo->save();
        return response()->json(['data' => $wordUrl,'code' => 200], 200);
    }
    

    public function getChecknegative(Request $request) {
        $rules = [
            'id' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $id = $request->input('id');
    	$checknegative = Checknegative::where('entryId',$id)->get();
    	return response()->json(['data'=>$checknegative,'code' => 200])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getCheckaccord(Request $request) {
        $rules = [
            'id' => 'required',
        ];
        $messages = [
            'required' => ':attribute不能为空.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 402);
        }
        $id = $request->input('id');
    	$checkaccord = Checkaccord::where('entryId',$id)->get();
        $checkcommand = Checkcommand::where('entryId',$id)->get();
        $data['checkaccord'] = $checkaccord;
        $data['checkcommand'] = $checkcommand;
    	return response()->json(['data'=>$data,'code' => 200])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

}
