<?php

namespace App\Http\Controllers\Home;


use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

use App\Http\Controllers\Controller;

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

	public function choose($id) {

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
    	return view('check/choose')
    		->with('entry',$entry)
            ->with('checkId',$checkId)
            ->with('productCheckId',$productCheckId)
    		->with('id',$id);
    }
    public function show($id,$groupId = '') {
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
    	return view('check/show')
                ->with('entrys',$entrys)
                ->with('groupId',$groupId)
                ->with('id',$id);
    }

    public function create(CheckRequest $request) {
        $data = $request->all();
        $check['companyId'] = $data['id'];
        $user = Auth::user();
        $check['userId'] = $user->id;
        $check['created'] = date('Y-m-d H:i:s',time());
        $check['groupId'] = $data['groupId'];
	    $groupinfo = Checkgroup::find($data['groupId']);
	    $status = $groupinfo->status;
	    $check['status'] = $status;
        $comcheck = Comcheck::where(['companyId'=>$check['companyId'],'groupId'=>$check['groupId']])->first();
        if($comcheck){
            return redirect('check/choose/'.$check['companyId']);
        }
        // $checkId = 1;
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
        foreach ($checkdetail as $k => $v) {
            $checkdetail[$k]['negatives'] = '';
            foreach ($negatives as $kk => $vv) {
                if($v['entryId'] == $kk){
                    $checkdetail[$k]['negatives'] = $vv;
                }
            }
        }
        // dd($checkdetail);
        // foreach ($negatives as $k => $v) {
        //     $checkdetail[$k]['negative'] = $v;
        // }
        $comCheckdetail = new Comcheckdetail();
        $comCheckdetail->addAll($checkdetail);
        // $this->exportWord1($checkId);
        return redirect('check/inconform/'.$checkId);
    }


    public function inconform($id)
    {
        $detail = new Comcheckdetail();
        $comcheck = Comcheck::find($id);
        $infos = $detail->getInconform($id);
        return view('check/inconform')
	            ->with('companyId',$comcheck->companyId)
                ->with('infos',$infos);
    }

    public function del($id)
    {
        $detail = Comcheckdetail::find($id);
        $checkId = $detail->checkId;
        $detail->status = '1';
        $detail->save();
        return redirect('check/inconform/'.$checkId);
    }


    /**
     * 生成第一个检测报告
     *
     **/
    protected function exportWord1($companyId)
    {
        $company = Company::find($companyId);
        $comcheck = new Comcheck();
        $checkinfo = $comcheck->where(['companyId'=>$companyId,'status'=>1])->first();
        if(!$checkinfo) {
            return redirect('/check/choose/'.$companyId);
        }
        if($checkinfo->wordsUrl) {
            return response()->download($checkinfo->wordsUrl);
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
        return response()->download($wordUrl);
    }
    

    public function getChecknegative($id) {
        header("Access-Control-Allow-Origin: *");
    	$checknegative = Checknegative::where('entryId',$id)->get();
    	return response()->json($checknegative)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getCheckaccord($id) {
        header("Access-Control-Allow-Origin: *");
    	$checkaccord = Checkaccord::where('entryId',$id)->get();
        $checkcommand = Checkcommand::where('entryId',$id)->get();
        $data['checkaccord'] = $checkaccord;
        $data['checkcommand'] = $checkcommand;
    	return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }




}
