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
		$parameter->parameter_code ="uploadFolder";
		$parameter->parameter_title ="發票上傳目錄";
		$parameter->parameter_value ="C:\\temp";
		$parameter->parameter_groups="其他";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="tax";
		$parameter->parameter_title ="營業稅";
		$parameter->parameter_value =0.05;
		$parameter->parameter_groups="其他";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="currentInvoice";
		$parameter->parameter_title ="目前發票序號 ";
		$parameter->parameter_value =1;
		$parameter->parameter_groups="其他";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="defaultCustomer";
		$parameter->parameter_title ="櫃台預設客戶代號";
		$parameter->parameter_value =1;
		$parameter->parameter_groups="其他";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="AESKey";
		$parameter->parameter_title ="電子發票AESKey";
		$parameter->parameter_value ="6F42C5148D45357E77124DC9CD27225A";
		$parameter->parameter_groups="其他";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="invoiceDetail";
		$parameter->parameter_title ="電子發票明細列印";
		$parameter->parameter_value =1;
		$parameter->parameter_groups="其他";
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
		$parameter->parameter_value ="";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		$parameter = new Parameter;
		$parameter->parameter_code ="saleprice5";
		$parameter->parameter_title ="售價五";
		$parameter->parameter_value ="";
		$parameter->parameter_groups="價格";
        $parameter->save();
		
		
		
    }
}
