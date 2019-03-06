<?php

namespace App\Http\Controllers\Home;


use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

use App\Http\Controllers\Controller;

use App\Model\Checkgroup;
use App\Model\Checklist;
use App\Model\Checkaccord;
use App\Model\Checkcommand;
use App\Model\Company;
use App\Model\Comcheck;
use App\Model\Comcheckdetail;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRequest;

class ComcheckController extends Controller
{
	//

	public function choose($id) {
		$company = Company::find($id)->getGroup()->first();
		$entryIds = $company->entryIds;
		$checkgroup = new Checkgroup();
	    $entry = $checkgroup->getEntry($entryIds);
    	return view('check/choose')
    		->with('entry',$entry)
    		->with('id',$id);
    }
    //
    public function show($id) {
    	$company = Company::find($id)->getGroup()->first();
		$entryIds = $company->entryIds;
        $category = $company->id;

		$checkgroup = new Checkgroup();
	    $entrys = $checkgroup->getEntry($entryIds);
    	return view('check/show')
                ->with('entrys',$entrys)
                ->with('groupId',$category)
                ->with('id',$id);
    }

    public function create(CheckRequest $request) {
        $data = $request->all();
        $check['companyId'] = $data['id'];
        $user = Auth::user();
        $check['userId'] = $user->id;
        $check['created'] = date('Y-m-d H:i:s',time());
        $check['groupId'] = $data['groupId'];
        $checkId = 1;
        $checkId = Comcheck::insertGetId($check);

        $entryIds = $data['entryId'];
        $statuses = $data['status'];
        $contents = $data['content'];
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
        // foreach ($lists as $k => $v) {
        //     $checkdetail[$k]['list'] = $v;
        // }
        $comCheckdetail = new Comcheckdetail();
        $comCheckdetail->addAll($checkdetail);
        // $this->exportWord1($checkId);
        return redirect('check/inconform/'.$checkId);
    }

    public function inconform($id)
    {
        $detail = new Comcheckdetail();
        $infos = $detail->getInconform($id);
        return view('check/inconform')
                ->with('infos',$infos);
    }


    /**
     * 生成第一个检测报告
     *
     **/
    protected function exportWord1($id)
    {
        $comcheck = Comcheck::find($id);
        $created = date('Y-m-d',strtotime($comcheck->created));

        $company = Comcheck::find($id)->getCompany()->first();
        //负面清单
        $checklist = new Checklist();
        $listDetail = $checklist->getCompanyList($id);
        //不符合项
        $comCheckdetail = new Comcheckdetail();
        $Inconforms = $comCheckdetail->getInconform($id);

        $templateProcessor =  new TemplateProcessor('./word/word1.docx');
        $comName = $company->comName;
        $data['comName'] = $comName;
        $data['address'] = $company->address;
        // $templateProcessor->setValue('comName','青科安全');
        foreach($data as $k=>$v){
            $templateProcessor->setValue($k,$v);
        }
        $docName = $comName.'检测报告1_' . $created;
        $templateProcessor->saveAs('./word/'.$docName.'.docx');
        return $docName;

    }
    

    public function getChecklist($id) {
    	$checklist = Checklist::where('entryId',$id)->get();
    	return response()->json($checklist)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getCheckaccord($id) {
    	$checkaccord = Checkaccord::where('entryId',$id)->get();
        $checkcommand = Checkcommand::where('entryId',$id)->get();
        $data['checkaccord'] = $checkaccord;
        $data['checkcommand'] = $checkcommand;
    	return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }




}
