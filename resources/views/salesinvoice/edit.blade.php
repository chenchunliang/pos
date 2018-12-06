@extends('commontable')

@section('h2_title','銷貨發票設定')

@section('h3_title','編輯銷貨發票')

@section('commontable')

<style>
input[type=number]{
	text-align:center
}
#pricetype{	
	width:auto;
}
</style>
<form id="form1" name="form1" method="post" action="{{url('salesinvoice/'.$Salesinvoice->id)}}">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <table width="100%" class="table table-bordered table-hover" id="table2" style="margin-bottom:1px">
    <tr>
      <th style="width:25%">發票號碼 (隨機碼)</th>
      <td style="width:25%; text-align:center">{{$Salesinvoice->salesinvoice_invoicenumber}} ({{$Salesinvoice->salesinvoice_randomnumber}})</td>
      <th style="width:25%">發票時間</th>
      <td style="width:25%; text-align:center">{{$Salesinvoice->salesinvoice_date}}<br>
        {{$Salesinvoice->salesinvoice_time}}</td>
    <tr>
      <th>買方</th>
      <td style="text-align:center">
      <select name="customer_id" class="form-control">
          @foreach($Customers as $customer)
          <option value="{{$customer->id}}" @if($customer->id==$Salesinvoice->customer_id) selected @endif>{{$customer->customer_name}}</option>
          @endforeach
      </select></td>
      <th>買方統編</th>
      <td style="text-align:center"><input class="form-control" type="text" name="salesinvoice_identifier" value="{{$Salesinvoice->salesinvoice_identifier}}"></td>
    </tr>
    <tr>
      <th>列印狀態：
      <input type="checkbox" class="form-control" name="salesinvoice_printstate"  value="1" style="width:20px;margin:0" {{$Salesinvoice->salesinvoice_printstate?'checked':''}}></th>
      <th>上傳開立：<input type="checkbox" class="form-control" name="salesinvoice_C0401state" value="1" style="width:20px;margin:0" {{$Salesinvoice->salesinvoice_C0401state?'checked':''}}></th>
      <th>作廢狀態：<input type="checkbox" class="form-control" name="salesinvoice_invalidstate" value="1" style="width:20px;margin:0" {{$Salesinvoice->salesinvoice_invalidstate?'checked':''}}></th>
      <th>上傳作廢：<input type="checkbox" class="form-control" name="salesinvoice_C0501state" value="1" style="width:20px;margin:0" {{$Salesinvoice->salesinvoice_C0501state?'checked':''}}></th>
    </tr>
    <tr>
      <th>訂單備註</th>
      <td colspan="3" style=" text-align:center"><textarea name="salesinvoice_remark" rows="2" style="width:95%" class="form-control">{{$Salesinvoice->salesinvoice_remark?$Salesinvoice->salesinvoice_remark:'無'}}</textarea></td>
    </tr>
    <tr>
      <th colspan="4" style="background-color:#f0f0f0;line-height: 35px;"><span style="padding-left:13%;">商品資訊&nbsp;
        <select class="form-control" id="pricetype">
        @php
      	  $i=1;
        @endphp
      
        @foreach($Parameters as $Parameter)   
          <option value="{{$i}}">{{$Parameter->parameter_value?$Parameter->parameter_value:'售價'.$i}}</option>
        @php
      	  $i++;
        @endphp
        @endforeach
        </select></span>
        <span style="text-align:center">
        <span style="float:right"><input type="button" class="btn btn-lg" value="新增一列" id="insertbtn" data-n="{{count(json_decode($Salesinvoice->salesinvoice_productarray))+1}}"></span>
      </span></th>
    </tr>
    <tr>
      <th>刪除</th>
      <th>品項</th>
      <th>數量</th>
      <th>單價</th>
    </tr>
    @php $i=1; @endphp
   @foreach(json_decode($Salesinvoice->salesinvoice_productarray) as $productArray)
    <tr id="row{{$i}}">
      <td align="center"><button type="button" class="btn btn-warning btn-lg" data-n="{{$i}}" onclick="deleteThisRow({{$i}})">刪除</button><input type="hidden" name="ProductCode[]"  id="ProductCode_{{$i}}" value="{{$productArray->ProductCode}}"><input type="hidden" name="TaxType[]"  id="TaxType_{{$i}}" value="{{$productArray->TaxType}}"></td>
      <td align="center">
        <select class="form-control" name="ProductName[]" id="ProductName_{{$i}}" onBlur="calculateProductAmount({{$i}})" data-n="{{$i}}">          
        @foreach($Items as $Item)
          <option value="{{$Item->item_name}}" data-id="{{$Item->id}}" data-taxtype="{{$Item->item_taxtype}}" data-unitprice1="{{$Item->item_unitprice1}}" data-unitprice2="{{$Item->item_unitprice2}}" data-unitprice3="{{$Item->item_unitprice3}}" data-unitprice4="{{$Item->item_unitprice4}}" data-unitprice5="{{$Item->item_unitprice5}}" @if($productArray->ProductCode==$Item->id) selected @endif  >{{$Item->item_name}}</option>
        @endforeach
        </select></td>
      <td align="center"><input type="number" class="form-control" name="ProductQty[]" value="{{$productArray->ProductQty}}" min="1" id="ProductQty_{{$i}}" onBlur="calculatetotalAmount()"></td>
      <td align="center"><input type="number" class="form-control" name="ProductAmount[]" value="{{$productArray->ProductAmount}}" min="1" id="ProductAmount_{{$i}}" onBlur="calculatetotalAmount()"></td>
    </tr>
     @php $i++; @endphp
    @endforeach
  </table>
  <table width="100%" class="table table-bordered table-hover">
    <tr>
      <th style="width:25%">應稅銷售額</th>
      <td style="width:25%; text-align:center"><span id="txsalesamount">{{ number_format($Salesinvoice->salesinvoice_txsalesamount) }}</span></td>
      <th style="width:25%">免稅銷售額</th>
      <td style="width:25%; text-align:center"><span id="tnsalesamount">{{ number_format($Salesinvoice->salesinvoice_tnsalesamount) }}</span></td>
    </tr>
    <tr>
      <th style="width:25%">稅額</th>
      <td style="width:25%; text-align:center"><span id="taxamount">{{ number_format($Salesinvoice->salesinvoice_taxamount) }}</span></td>
      <th style="width:25%">總金額</th>
      <td style="width:25%; text-align:center"><span id="totalamount">{{ number_format($Salesinvoice->salesinvoice_totalamount) }}</span></td>
    </tr>
  </table>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>
@endsection

@section('customjs')
<script>
$('#insertbtn').click(function() {
	
	var n=$('#insertbtn').data("n");
	var string="<tr id=\"row"+n+"\">"+
	"<td align=\"center\"><button type=\"button\" class=\"btn btn-danger btn-lg\" onclick=\"deleteThisRow("+n+")\">刪除</button><input type=\"hidden\" name=\"ProductCode[]\"  id=\"ProductCode_"+n+"\"><input type=\"hidden\" name=\"TaxType[]\" id=\"TaxType_"+n+"\"></td>"+
	"<td align=\"center\">"+
	"<select class=\"form-control\" name=\"ProductName[]\" id=\"ProductName_"+n+"\" "+		
	 	"onBlur=\"calculateProductAmount("+n+")\" data-n=\""+n+"\">"+
        @foreach($Items as $Item)
        "<option value=\"{{$Item->item_name}}\" data-id=\"{{$Item->id}}\" data-taxtype=\"{{$Item->item_taxtype}}\" data-unitprice1=\"{{$Item->item_unitprice1}}\" data-unitprice2=\"{{$Item->item_unitprice2}}\" data-unitprice3=\"{{$Item->item_unitprice3}}\" data-unitprice4=\"{{$Item->item_unitprice4}}\" data-unitprice5=\"{{$Item->item_unitprice5}}\">{{$Item->item_name}}</option>"+
		@endforeach
	"</select>"+
	"</td>"+
	"<td align=\"center\">"+
		"<input type=\"number\" class=\"form-control\" name=\"ProductQty[]\" id=\"ProductQty_"+n+
		"\"onBlur=\"calculatetotalAmount()\" value=\"1\">"+
	"</td>"+
	"<td align=\"center\">"+
		"<input type=\"number\" class=\"form-control\" name=\"ProductAmount[]\" id=\"ProductAmount_"+n+"\" onBlur=\"calculatetotalAmount()\">"+
	"</td>"+
	"</tr>";
	$('#table2 tr:last').after(string);
	calculateProductAmount(n);
	$('#insertbtn').data("n",n+1);
	
});

function deleteThisRow(n){
	$('#row'+n).remove();
	calculatetotalAmount();
}
function calculateProductAmount(i){
	var pricetype=$('#pricetype').val();
	
	var unitprice=$('#ProductName_'+i).find(':selected').data('unitprice'+pricetype);
	$('#ProductAmount_'+i).val(unitprice);
	
	var id=$('#ProductName_'+i).find(':selected').data('id');
	$('#ProductCode_'+i).val(id);
	
	var TaxType=$('#ProductName_'+i).find(':selected').data('taxtype');
	if(TaxType==1) TaxType="TN";
	else if(TaxType==2) TaxType="TX";
	$('#TaxType_'+i).val(TaxType);
	
	//console.log(pricetype+' '+taxtype+' '+unitprice);
	calculatetotalAmount();
}

function calculatetotalAmount(){
	var taxrate=1+{{$Parameter_tax->parameter_value}};
	
	var tnsalesamount=0;//免稅銷售額
	var txamount=0;//應稅總金額
	var txsalesamount=0;//應稅銷售額
	var taxamount=0;//稅額
	var totalamount=0;//總金額
	
	$("select")  // for all select
    .each(function() {  //
		if(this.name=="ProductName[]"){
			//console.log(this);
			
			var i=$(this).data('n');
			var taxtype=$('#ProductName_'+i).find(':selected').data('taxtype');	
			var qty=$('#ProductQty_'+i).val()?$('#ProductQty_'+i).val():1;
			var amount=$('#ProductAmount_'+i).val();
			
			if(taxtype==1){//免稅
				tnsalesamount+=qty*amount;
			}else if(taxtype==2){//應稅
				txamount+=qty*amount;//應稅總金額
			}
			//console.log(taxtype+' '+qty+' '+amount);
		}
    });
	
	txsalesamount=Math.round(txamount/taxrate);
	taxamount=txamount-txsalesamount;
	totalamount=tnsalesamount+txamount;
	//console.log('tn:'+tnsalesamount+' tx:'+txsalesamount+' tax:'+taxamount+' total:'+totalamount);
	
	$('#tnsalesamount').html(tnsalesamount.numberFormat(0, '.', ','));
	$('#txsalesamount').html(txsalesamount.numberFormat(0, '.', ','));
	$('#taxamount').html(taxamount.numberFormat(0, '.', ','));
	$('#totalamount').html(totalamount.numberFormat(0, '.', ','));
}



Number.prototype.numberFormat = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
</script>
@endsection