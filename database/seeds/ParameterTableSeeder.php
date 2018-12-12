<?php

use Illuminate\Database\Seeder;
use App\Parameter;

class ParameterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		
		$parameter = new Parameter;
		$parameter->parameter_code ="companyName";
		$parameter->parameter_title ="公司名稱";
		$parameter->parameter_value ="阿古力社會企業";
		$parameter->parameter_groups="營業人";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="companyAddress";
		$parameter->parameter_title ="地址";
		$parameter->parameter_value ="雲林縣斗六市西平路666號1樓";
		$parameter->parameter_groups="營業人";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="companyPhone";
		$parameter->parameter_title ="電話";
		$parameter->parameter_value ="05-5512323";
		$parameter->parameter_groups="營業人";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="companyIdentifier";
		$parameter->parameter_title ="統編";
		$parameter->parameter_value ="55891836";
		$parameter->parameter_groups="營業人";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="AESKey";
		$parameter->parameter_title ="電子發票AESKey";
		$parameter->parameter_value ="6F42C5148D45357E77124DC9CD27225A";
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="uploadC0401Folder";
		$parameter->parameter_title ="發票開立上傳目錄";
		$parameter->parameter_value ="C:\PlusmoreInvoiceStorage\C0401";
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="uploadC0501Folder";
		$parameter->parameter_title ="發票作廢上傳路徑";
		$parameter->parameter_value ="C:\PlusmoreInvoiceStorage\C0501";
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="uploadEmptyFolder";
		$parameter->parameter_title ="空白發票匯出路徑";
		$parameter->parameter_value ="C:\PlusmoreInvoiceStorage";
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="invoiceImage";
		$parameter->parameter_title ="發票LOGO";
		$parameter->parameter_value ="data:image/png;base64,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";//發票樣圖
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="invoiceDetail";
		$parameter->parameter_title ="電子發票明細列印";
		$parameter->parameter_value ="是";
		$parameter->parameter_groups="發票";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice1";
		$parameter->parameter_title ="售價一";
		$parameter->parameter_value ="市售價";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice2";
		$parameter->parameter_title ="售價二";
		$parameter->parameter_value ="員工價";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice3";
		$parameter->parameter_title ="售價三";
		$parameter->parameter_value ="豐泰價";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice4";
		$parameter->parameter_title ="售價四";
		$parameter->parameter_value ="自定價";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice5";
		$parameter->parameter_title ="售價五";
		$parameter->parameter_value ="自定價";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="tax";
		$parameter->parameter_title ="營業稅";
		$parameter->parameter_value =0.05;
		$parameter->parameter_groups="其他";
        $parameter->save();
	}
}
