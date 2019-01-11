<?php
/**
 * Class CEXPORT 导出
 * @package app\common\utils
 */
namespace Common\Utils;
class CExport{
    /**
     * @param $html 是不是html
     * @param bool $is_html
     * @param $file 保存文件名称
     * @desc 不支持设置页眉页脚，html或者str
     */
    public static function exportToPdf($html,$is_html = true,$file='doc'){
        ob_start();
        require_once __DIR__."/../../../vendor/tecnickcom/tcpdf/tcpdf.php";
        $pdf = new \TCPDF('p','mm','A4',true,'utf-8',false,false);
        // 设置文档信息
        $pdf->SetCreator('Helloweba');
        $pdf->SetAuthor('yueguangguang');
        $pdf->SetTitle('Welcome to helloweba.com!');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, PHP');
        // 设置页眉和页脚信息
        $pdf->SetHeaderData('logo.png', 30, '', '',
            array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '10'));
        $pdf->setFooterFont(Array('helvetica', '', '8'));

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        // 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //设置字体
        $pdf->SetFont('stsongstdlight', '', 14);
//        $pdf->SetFont('droidsansfallback', '', 20);

        $pdf->AddPage();

        if ($is_html){
            $pdf->writeHTML($html);
            ob_end_clean();
            $pdf->Output($file.'.pdf','I');
            die();
        }else{
            $pdf->Write(0,$html,'', 0, 'L', true, 0, false, false, 0);
            //输出PDF
            ob_end_clean();
            $pdf->Output($file.'.pdf', 'I');
            die();
        }
    }

    /**
     * @param $filename 文件名称
     * @param array $tileArray 标题
     * @param array $dataArray 内容
     */
    public static function exportToExcel($filename, $tileArray=[], $dataArray=[]){
        ini_set('memory_limit','512M');
        ini_set('max_execution_time',0);
        ob_end_clean();
        ob_start();
        header("Content-Type: text/csv");
        header("Content-Disposition:filename=".$filename.'.csv');
        $fp=fopen('php://output','w');
        fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码
        fputcsv($fp,$tileArray);
        $index = 0;
        foreach ($dataArray as $item) {
            if($index==1000){
                $index=0;
                ob_flush();
                flush();
            }
            $index++;
            fputcsv($fp,$item);
        }

        ob_flush();
        flush();
        ob_end_clean();
        die();
    }
}