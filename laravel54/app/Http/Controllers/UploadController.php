<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\File;
use App\Services\UploadsManager;
use Excel;
use DB;

class UploadController extends Controller
{
    //
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Show page of files / subfolders
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('check.upload.index', $data);
    }

    /**
	 * 上传文件
	 */
	public function uploadExcel(UploadFileRequest $request)
	{
	    $file = $_FILES['file'];
	    $fileName = $request->get('file_name');
	    $fileName = $fileName ?: $file['name'];
	    $path = str_finish($request->get('folder'), '/') . $fileName;
	   	$data = [];
	    $content = File::get($file['tmp_name']);
	    $filePath = $file['tmp_name'];
	    Excel::load($filePath, function($reader) {
	        $sheet = $reader->getSheet(2);
	        $highestRow=$sheet->getHighestRow();//取得总行数
			$highestColumn=$sheet->getHighestColumn(); //取得总列数
			//循环读取excel文件,读取一条,插入一条
			for($j=1;$j<=$highestRow;$j++){//从第一行开始读取数据
				$str='';
				for($k='A';$k<=$highestColumn;$k++){            //从A列读取数据
				//这种方法简单，但有不妥，以'\\'合并为数组，再分割\\为字段值插入到数据库,实测在excel中，如果某单元格的值包含了\\导入的数据会为空        
				$data[$j][$k]=$sheet->getCell("$k$j")->getValue().'\\';//读取单元格
			 }
			}
			foreach ($data as $k => $v) {
				if($v['A'] == '\\')
				{
					dump($v['A']);
					break;
				}
				$idno = substr($v['A'], 0, -1);
				$entry = DB::table('checkentry')->where('idno', $idno)->get();
				if(!$entry->isEmpty())
				{
					dump($entry);
					continue;
				}
				echo '---------';
				if($k == 2) {
					$check['entry'] = $v['B'];
					$check['code'] = $v['C'];
					$entryId = DB::table('checkentry')->insertGetId([
						'entry' => substr($v['B'], 0, -1) ,
						'code' => substr($v['C'], 0, -1),
						'idno' => substr($v['A'], 0, -1)
					]);
				}
				$j = $k - 1;
				if($k > 2) {
					if($v['A']!=$data[$j]['A']) {
						$check['entry'] = $v['B'];
						$check['code'] = $v['C'];
						$entryId = DB::table('checkentry')->insertGetId([
							'entry' => substr($v['B'], 0, -1) ,
							'code' => substr($v['C'], 0, -1),
							'idno' => substr($v['A'], 0, -1)
						]);
					}
				}
				if($k == 1 ) {
					continue;
				}
				//负面清单
				if($v['D']!='\\') {
					DB::table('checklist')->insertGetId([
						'entryId' => $entryId,
						'content' => substr($v['D'], 0, -1)
					]);
				}
				//处罚标准
				if($v['G']!='\\') {

					DB::table('checkcommand')->insertGetId([
						'entryId' => $entryId,
						'title' => substr($v['G'], 0, -1),
						'content' => substr($v['H'], 0, -1)
					]);
				}
				//依据标准
				if($v['E']!='\\') {
					DB::table('checkaccord')->insertGetId([
						'entryId' => $entryId,
						'title' => substr($v['E'], 0, -1),
						'content' => substr($v['F'], 0, -1),
					]);
				}
				
				
			}
	    });
			
	}

	/**
	 * 上传文件
	 */
	public function uploadFile(UploadFileRequest $request)
	{
	    $file = $_FILES['file'];
	    $fileName = $request->get('file_name');
	    $fileName = $fileName ?: $file['name'];
	    $path = str_finish($request->get('folder'), '/') . $fileName;
	    $content = File::get($file['tmp_name']);

	    $result = $this->manager->saveFile($path, $content);

	    if ($result === true) {
	        return redirect()
	            ->back()
	            ->with("success", '文件「' . $fileName . '」上传成功.');
	    }

	    $error = $result ?: "文件上传出错.";
	    return redirect()
	        ->back()
	        ->withErrors([$error]);
	}

}
