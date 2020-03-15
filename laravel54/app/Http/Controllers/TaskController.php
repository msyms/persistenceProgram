<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
	public function home()
	{
	    $phpWord = new \PhpOffice\PhpWord\PhpWord();
        //设置默认样式
        $phpWord->setDefaultFontName('仿宋');//字体
        $phpWord->setDefaultFontSize(16);//字号

        //添加页面
        $section = $phpWord->createSection();

        //添加目录
        // $styleTOC  = ['tabLeader' => \PhpOffice\PhpWord\Style\TOC::TABLEADER_DOT];
        // $styleFont = ['spaceAfter' => 60, 'name' => 'Tahoma', 'size' => 12];
        // $section->addTOC($styleFont, $styleTOC);

        //默认样式
        $section->addText('Hello PHP!');
        $section->addTextBreak();//换行符

        //指定的样式
        $section->addText(
            'Hello world!',
            [
                'name' => '宋体',
                'size' => 16,
                'bold' => true,
            ]
        );
        $section->addTextBreak(5);//多个换行符

        //自定义样式
        $myStyle = 'myStyle';
        $phpWord->addFontStyle(
            $myStyle,
            [
                'name' => 'Verdana',
                'size' => 12,
                'color' => '1BFF32',
                'bold' => true,
                'spaceAfter' => 20,
            ]
        );
        $section->addText('Hello Laravel!', $myStyle);
        $section->addText('Hello Vue.js!', $myStyle);
        $section->addPageBreak();//分页符

        //添加文本资源
        $textrun = $section->createTextRun();
        $textrun->addText('加粗', ['bold' => true]);
        $section->addTextBreak();//换行符
        $textrun->addText('倾斜', ['italic' => true]);
        $section->addTextBreak();//换行符
        $textrun->addText('字体颜色', ['color' => 'AACC00']);

        //超链接
        $linkStyle = ['color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE];
        $phpWord->addLinkStyle('myLinkStyle', $linkStyle);
        $section->addLink('http://www.baidu.com', '百度一下', 'myLinkStyle');
        $section->addLink('http://www.baidu.com', null, 'myLinkStyle');

        // //添加图片
        // $imageStyle = ['width' => 480, 'height' => 640, 'align' => 'center'];
        // $section->addImage('./img/t1.jpg', $imageStyle);
        // $section->addImage('./img/t2.jpg',$imageStyle);

        //添加标题
        $phpWord->addTitleStyle(1, ['bold' => true, 'color' => '1BFF32', 'size' => 38, 'name' => 'Verdana']);
        $section->addTitle('生产安全事故隐患告知单', 1);
        $section->addTitle('标题2', 1);
        $section->addTitle('标题3', 1);

        //添加表格
        $styleTable = [
            'borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 50,
        ];
        $styleFirstRow = ['bgColor' => '66BBFF'];//第一行样式
        $phpWord->addTableStyle('myTable', $styleTable, $styleFirstRow);

        $table = $section->addTable('myTable');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('学号');
        $table->addCell(2000)->addText('姓名');
        $table->addCell(2000)->addText('专业');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('2015123');
        $table->addCell(2000)->addText('小明');
        $table->addCell(2000)->addText('计算机科学与技术');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('2016789');
        $table->addCell(2000)->addText('小傻');
        $table->addCell(2000)->addText('教育学技术');

        //页眉与页脚
        $header = $section->createHeader();
        $footer = $section->createFooter();
        $header->addPreserveText('页眉');
        $footer->addPreserveText('页脚 - 页数 {PAGE} - {NUMPAGES}.');

        //生成的文档为Word2007
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save('./word/hello.docx');

        //将文档保存为ODT文件... 
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $writer->save('./word/hello.odt');

        //将文档保存为HTML文件... 
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $writer->save('./word/hello.html');
	}
    //
}