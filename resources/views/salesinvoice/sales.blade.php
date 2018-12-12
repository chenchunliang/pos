@extends('commontable')

@section('h2_title','櫃檯作業')

@section('commontable')
<style>
.table>thead>tr>th{
	vertical-align: middle;
}
.table>thead>tr>td{
	vertical-align: middle;
}
.catalog_item{
	cursor:pointer;
}

.small_btn{
    padding: 3px 12px;
}

#pricetype{	
	width:auto;
}

#item_list_table {
	width: 100%;
	background-color: #f3f3f3;
}
#item_list_table tbody {
	height: 600px;
	overflow-y: auto;
	width: 100%;
}
#item_list_table tbody, #item_list_table tr, #item_list_table td, #item_list_table th {
	display: flow-root;
}
#item_list_table tbody td {
	float: left;
}

.catalog_item_price{
  /*  float: left;
    position: relative;
    top: -30px;
    left: 10px;*/
	z-index:2;
	color:red;
	background: white;
    padding:1px 4px;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h3>{{$Parameters->where('parameter_code','companyName')->first()->parameter_value}} (統編：{{$Parameters->where('parameter_code','companyIdentifier')->first()->parameter_value}})</h3>
<table width="100%" class="table table-striped table-bordered">
  
    <th width="20%"><a href="{{url('invoice')}}" target="_blank">發票號碼</a></th>
    <th width="20%"><input type="hidden" id="invoices_id" value="{{($Invoice)?$Invoice->id:''}}"><input name="salesinvoice_invoicenumber" id="salesinvoice_invoicenumber" type="text" class="form-control" readonly value="{{($Invoice)?$Invoice->invoice_wordtrack.(str_pad($Invoice->invoice_currentnumber+1,8,'0',STR_PAD_LEFT)):'★☆★☆發票號碼用罄☆★☆★'}}" style="text-align:center"></th>
    <th width="20%">發票日期</th>
    <th width="20%">{{date('Y/m/d')}}</th>
    <th width="20%">{{HTML::image('images/barcode_sample.png','barcode sample image',array('width'=>100))}}</th>
  </tr>
  <tr>
    <th>客戶名稱</th>
    <th><span style="text-align:center">
      <select name="customer_id" id="customer_id" class="form-control">
        
        
          @foreach($Customers as $customer)
        
        
        <option value="{{$customer->id}}" @if($customer->customer_name=='零售') selected @endif>{{$customer->customer_name}}</option>
        
        
          @endforeach
      
      
      </select>
      </span></th>
    <th>客戶統編</th>
    <th><input type="text" id="salesinvoice_identifier"  name="salesinvoice_identifier" class="form-control"></th>
    <th><input type="text" class="form-control" id="barcode_input_area" placeholder="掃條碼!" style="text-align:center" autofocus></th>
  </tr>
  <tr>
    <th colspan="3" style="vertical-align:super;"> <table class="table" style="margin-bottom:0px;background-color: #f9f9f9;">
        <tr>
          <th style="border-top: unset;" width="10%"><button type="button" class="btn btn-danger btn-lg small_btn" onclick="deleteThisRow('all')">清空</button></th>
          <th style="border-top: unset; text-align:left" width="39%">商品項目</th>
          <th style="border-top: unset;" width="10%">單位</th>
          <th style="border-top: unset;" width="20%">數量</th>
          <th style="border-top: unset;" width="20%">單價</th>
        </tr>
      </table>
    </th>
    <th colspan="2"><span style="padding-left:13%;">商品目錄&nbsp;&nbsp;
      <select name="pricetype" class="form-control" id="pricetype">
        
        @php
      		$i=1;
        @endphp

        @foreach($Parameters->where('parameter_groups','價格')->all() as $Parameter)
        	
        <option value="{{$i}}">{{$Parameter->parameter_value?$Parameter->parameter_value:'售價'.$i}}</option>
        
        @php
      		$i++;
        @endphp
        @endforeach
      
      </select>
      </span></th>
  </tr>
  <tr>
    <th colspan="3" style="vertical-align:super;"><table class="table" id="item_list_table">
        <tbody>
        </tbody>
      </table></th>
    <td width="45%" colspan="2" rowspan="2" style="vertical-align:super"><!-- Nav tabs -->
      
      <div>
        <ul class="nav nav-pills">
          @foreach($Catalogs as $i=>$Catalog)
          <li class="{{$i==0?'active':''}}"><a href="#catalog{{$i}}" data-toggle="tab" aria-expanded="false">{{$Catalog->catalog_name}}</a> </li>
          @endforeach
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content"> @php
          $m=0;
          @endphp
          
          @foreach($Catalogs as $i=>$Catalog)
          <div class="tab-pane fade {{$i==0?'in active':''}}" id="catalog{{$i}}">
            <table class="table table-bordered">
              @for($y=1;$y<=8;$y++)
              <tr style="height:80px;"> @for($x=1;$x<=5;$x++)
                <td style="text-align:center;width:20%;line-height: 0.5;"><span class="catalog_item" id="c{{$m}}_x{{$x}}_y{{$y}}"></span></td>
                @endfor </tr>
              @endfor
            </table>
          </div>
          @php
          $m++;
          @endphp
          @endforeach </div>
      </div></td>
  </tr>
  <tr>
    <th colspan="3" style="vertical-align:super;background-color: #fff;">
    <table class="table" style="margin-bottom: 0px;">
          <tr>
            <th style="width:10%;"><button type="button" class="btn btn-info btn-lg" id="change_btn">找零</button></th>
            <th style="width:10%;">應稅銷售額</th>
          <td style="width:10%; text-align:center"><span id="txsalesamount"></span></td>
          <th style="width:10%">免稅銷售額</th>
          <td style="width:10%; text-align:center"><span id="tnsalesamount"></span></td>
        </tr>
        <tr>
          <th style="width:10%;"><button type="button" class="btn btn-success btn-lg checkout_btn">結帳</button></th>
          <th style="width:10%;">稅額</th>
          <td style="width:10%; text-align:center"><span id="taxamount"></span></td>
          <th style="width:10%">總金額</th>
          <td style="width:10%; text-align:center"><span id="totalamount" style="color:blue"></span></td>
      </table>
    </th>
  </tr>
</table>
<input type="hidden" id="rownumber" value="0">
    
<!--找零-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
    <div style="padding:5%">
    <form oninput="changeMoney.value=receivedmoney.valueAsNumber - needMoney.valueAsNumber">
    <p>須收： <input type="number" class="form-control" autofocus id="needMoney" name="needMoney" style="color:blue;width:60%" readonly> 元</p>
    <p>收現： <input type="number" class="form-control" autofocus id="receivedmoney" name="receivedmoney" style="width:60%" placeholder="請輸入金額"> 元</p>
    <p>找零： <input type="number" class="form-control" autofocus id="changeMoney" name="changeMoney" style="width:60%;color:red" readonly> 元</p>
    <p><button type="button" class="btn btn-success btn-lg checkout_btn">結帳</button></p>
    </form></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<!--發票號碼用罄-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content" style="padding: 4% 0%;">
    <h1 style="color:red; text-align:center">發票號碼用罄</h1>
    <p>&nbsp;</p>
    <p style="text-align:center"><a href="{{url('invoice')}}" target="_blank" role="button" class="btn btn-warning btn-lg">設定發票號碼</a></p>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@endsection

@section('customjs')
<script>

{{($Invoice)?"":"noInvoicenumber()"}}

$('#customer_id').change(function() {
	var customerObject =getCustomerById(this.value)[0];
	$('#salesinvoice_identifier').val(customerObject.customer_identifier);
});

$('.catalog_item').click(function() {
	//console.log($(this).data());
	var item_id=$(this).data('item_id');
	var item_name=$(this).data('item_name');
	var item_unit=$(this).data('item_unit');
	var item_unitprice=$(this).data('item_unitprice');
	var item_taxtype=$(this).data('item_taxtype');
	insertItem(item_id,item_name,item_unit,item_unitprice,item_taxtype);
});

$('#barcode_input_area').keypress(function(event) {
	//console.log( "Handler for .keypress() called." );
	if(event.which == 13){
		var item_barcode=event.currentTarget.value;
		//console.log(item_barcode);
		
		var itemObject =getItemByBarcode(item_barcode)[0];
		//console.log(itemObject);
		
		var pricetype=$('#pricetype').val();
		insertItem(itemObject.id,itemObject.item_name,itemObject.item_unit,itemObject['item_unitprice'+pricetype],itemObject.item_taxtype);
		
		$('#barcode_input_area').val('');		
	}
});

$('#change_btn').click(function() {
	if($('.ProductQty').length){
		var totalamount=$('#totalamount').html();
		totalamoun=totalamount.replace(",", "");
		totalamount=parseInt(totalamoun);
		
		$('#needMoney').val(totalamount);
		$('#myModal').modal('show');
	}else{
		alert('未選擇任何品項!');
	}
});

$('#myModal').on('shown.bs.modal', function() {//Modal顯示好後 觸發focus事件
  $('#receivedmoney').focus();
})

$("#myModal").on('hidden.bs.modal', function () {
   $('#receivedmoney').val('');
   $('#changeMoney').val('');
});

$('#receivedmoney').keypress(function(event) {
	//console.log( "Handler for .keypress() called." );
	if(event.which == 13){
		checkout_all_item();
	}
	
});

$('.checkout_btn').click(function() {
	checkout_all_item();
});

function noInvoicenumber(){//發票號碼用罄
	$('#myModal2').modal('show');
	$('#change_btn').prop('disabled',true);
	$('.checkout_btn').prop('disabled',true);
}


function checkout_all_item(){//結帳
	console.log("結帳");
	
	var invoices_id=$('#invoices_id').val();
	var salesinvoice_invoicenumber=$('#salesinvoice_invoicenumber').val();
	var customer_id=$('#customer_id').val();
	var salesinvoice_identifier=$('#salesinvoice_identifier').val();
	
	
	var salesinvoice_productarray="";
	if($('.ProductQty').length){
	$('.ProductQty').each(function() {//選取所有數量欄位
		var n=$(this).data('n');
		var item_id=$(this).data('item_id');
		var taxtype=$(this).data('taxtype');
		var item_name=$(this).data('item_name');
		var qty=$(this).val();
		var amount=$('#ProductAmount_'+n).val();
		
		salesinvoice_productarray+='{'+
			'"ProductCode":"'+item_id+'",'+
			'"ProductName":"'+item_name+'",'+
			'"ProductQty":"'+qty+'",'+
			'"ProductAmount":"'+amount+'",'+
			'"ProductSumAmount":"'+(qty*amount)+'",'+
			'"TaxType":"'+(taxtype==1?'TN':'TX')+
			'"},';
		
		
	});
	
	salesinvoice_productarray='['+salesinvoice_productarray.slice(0, -1)+']';

	var salesinvoice_tnsalesamount=$('#tnsalesamount').html();
	var salesinvoice_txsalesamount=$('#txsalesamount').html();
	var salesinvoice_taxamount=$('#taxamount').html();
	var salesinvoice_totalamount=$('#totalamount').html();
	
	salesinvoice_tnsalesamount=salesinvoice_tnsalesamount.replace(",", "");
	salesinvoice_tnsalesamount=parseInt(salesinvoice_tnsalesamount);
	
	salesinvoice_txsalesamount=salesinvoice_txsalesamount.replace(",", "");
	salesinvoice_txsalesamount=parseInt(salesinvoice_txsalesamount);
	
	salesinvoice_taxamount=salesinvoice_taxamount.replace(",", "");
	salesinvoice_taxamount=parseInt(salesinvoice_taxamount);
	
	salesinvoice_totalamount=salesinvoice_totalamount.replace(",", "");
	salesinvoice_totalamount=parseInt(salesinvoice_totalamount);
	
	console.log(
		"發票號碼："+salesinvoice_invoicenumber+' '+
		"買方統編："+salesinvoice_identifier+' '+
		"商品明細："+salesinvoice_productarray+' '+
		"免稅："+salesinvoice_tnsalesamount+' '+
		"應稅："+salesinvoice_txsalesamount+' '+
		"稅額："+salesinvoice_taxamount+' '+
		"總金額："+salesinvoice_totalamount
	);
	
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		type: "POST",
		data:{
			invoices_id:invoices_id,
			salesinvoice_invoicenumber:salesinvoice_invoicenumber,
			salesinvoice_identifier:salesinvoice_identifier,
			salesinvoice_productarray:salesinvoice_productarray,
			salesinvoice_tnsalesamount:salesinvoice_tnsalesamount,
			salesinvoice_txsalesamount:salesinvoice_txsalesamount,
			salesinvoice_taxamount:salesinvoice_taxamount,
			salesinvoice_totalamount:salesinvoice_totalamount,
			customer_id:customer_id
			},
		url: '{{url("salesinvoice")}}',
		success: function(msg)
		{
			console.log(msg);
			obj=JSON.parse(msg);
			console.log(obj);
			if(obj.result){
				
				window.open("{{url('salesinvoice/show')}}/"+obj.salesinvoices_id+'/type/1');
				
				$('#invoices_id').val(obj.Nextinvoiceid);
				$('#salesinvoice_invoicenumber').val(obj.Nextinvoicenumber);
				$('#salesinvoice_identifier').val('');
				$('#tnsalesamount').html('');
				$('#txsalesamount').html('');
				$('#taxamount').html('');
				$('#totalamount').html('');
				deleteThisRow('all');
				$('#barcode_input_area').focus();
				$('#myModal').modal('hide');
				
				
			}else{
				alert('錯誤!');	
			}
		},//end success
		complete: function(msg) {
            if(!obj.Nextinvoiceid){
				noInvoicenumber();//發票號碼用罄
			}
        } 
	});
	
	}else{
		alert('未選擇任何品項!');	
		$('#myModal').modal('hide');
	}

}

function insertItem(item_id,item_name,item_unit,item_unitprice,item_taxtype){
	var n=$('#rownumber').val();
	var string=
	"<tr id=\"row"+n+"\">"+
		"<td style=\"text-align:center;width:11%\">"+
			"<button type=\"button\" class=\"btn btn-danger btn-lg small_btn\" onclick=\"deleteThisRow("+n+")\">X</button>"+
		"</td>"+
		"<td style=\"text-align:left;width:38%\">"+
			item_name+
		"</td>"+
		"<td style=\"text-align:center;width:11%\">"+
			item_unit+
		"</td>"+
		"<td style=\"text-align:center;width:21%\">"+
			"<input type=\"number\" style=\"width:95%\"class=\"form-control ProductQty\"  data-n=\""+n+"\" onBlur=\"calculatetotalAmount()\" data-taxtype=\""+item_taxtype+"\" data-item_id=\""+item_id+"\"  data-item_name=\""+item_name+"\"value=\"1\">"+
		"</td>"+
		"<td style=\"text-align:center;width:19%\">"+
			"<input type=\"number\" style=\"width:95%\"class=\"form-control ProductAmount\" id=\"ProductAmount_"+n+"\" onBlur=\"calculatetotalAmount()\" value=\""+item_unitprice+"\">"+
		"</td>"+
	"</tr>";
	$('#item_list_table tbody').append(string);
	$('#rownumber').val(parseInt(n)+1);
	
	calculatetotalAmount();
}

function deleteThisRow(n){
	if(n!='all'){
		$('#row'+n).remove();
		calculatetotalAmount();
	}else if(n=='all'){
		$('#item_list_table tbody').empty();//清空整筆訂單
	}
}

$('#pricetype').change(function() {
	displayCatalog();
});

function calculatetotalAmount(){
	var taxrate=1+{{$Parameter_tax->parameter_value}};
	
	var tnsalesamount=0;//免稅銷售額
	var txamount=0;//應稅總金額
	var txsalesamount=0;//應稅銷售額
	var taxamount=0;//稅額
	var totalamount=0;//總金額
	
	$("#item_list_table .ProductQty") //所有數量欄位
    .each(function() {  //
			//console.log(this);
			var i=$(this).data('n');
			var taxtype=$(this).data('taxtype');
				
			var qty=$(this).val();
			var amount=$('#ProductAmount_'+i).val();
			
			if(taxtype==1){//免稅
				tnsalesamount+=qty*amount;
			}else if(taxtype==2){//應稅
				txamount+=qty*amount;//應稅總金額
			}
			//console.log(taxtype+' '+qty+' '+amount);
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

function displayCatalog(){
@php
	$m=0;
@endphp
@foreach($Catalogs as $i=>$Catalog)
	@foreach($Catalog->position as $position)
		var itemObject = getItemById({{$position->item_id}})[0];
		var pricetype=$('#pricetype').val();
		//console.log(itemObject);
		//console.log(itemObject.item_name);
		
		$("#c{{$m}}_x{{$position->position_x.'_y'.$position->position_y}}").html(
			"<img src='"+itemObject.item_image+"' width='55' height='55'/><span class=\"catalog_item_price\">$"+itemObject['item_unitprice'+pricetype]+'</span>'
		);
		$("#c{{$m}}_x{{$position->position_x.'_y'.$position->position_y}}").data({
			'item_id':itemObject.id,
			'item_name':itemObject.item_name,
			'item_unit':itemObject.item_unit,
			'item_unitprice':itemObject['item_unitprice'+pricetype],
			'item_taxtype':itemObject.item_taxtype,
		});

	@endforeach
	@php
		$m++;
	@endphp
@endforeach
}

function getItemById(code) {
  return Item_json_text.filter(
      function(Item_json_text){ return Item_json_text.id == code }
  );
}

function getItemByBarcode(code) {
  return Item_json_text.filter(
      function(Item_json_text){ return Item_json_text.item_barcode == code }
  );
}

function getCustomerById(code) {
  return Customer_json_text.filter(
      function(Customer_json_text){ return Customer_json_text.id == code }
  );
}

var Item_json_text= {!!json_encode($Items)!!};
var Customer_json_text= {!!json_encode($Customers)!!};

displayCatalog();//載入頁面 第1次呼叫


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