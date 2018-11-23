@include('header')
 <section id="batchlist">
                <div class="container">
                    <div class="row">
                        <div class="main_pricing_area sections">
                            <div class="head_title text-center">
                                <h2>阿古力社會企業-食品履歷系統</h2>
                                <div class="separator"></div>
                            </div><!-- End off Head_title -->
                           
                      
                            @for($i=0;$i<count($Items);$i++)
                            <div class="col-md-6 col-sm-6" style="">
                                <div class="single_pricing @if($i%2==0) pricing_business @endif">
                                    <div class="pricing_head">
                                        <h3 style="margin-bottom: 20px;">{{ $Items[$i]->batchs_number.' '.$Items[$i]->items_name }}</h3>
                                        {{ HTML::image('images/items/'.$Items[$i]->batchs_items_image, $Items[$i]->batchs_number.' '.$Items[$i]->items_name ,array('title'=>$Items[$i]->batchs_number.' '.$Items[$i]->items_name,'style'=>'margin-bottom: 49px;padding: 0% 5%;')) }}</div>
                                    <div class="@if($i%2==0) pricing_body2 @else pricing_body @endif">
                                    	<ul>
                                            <li>規格：{{ $Items[$i]->items_specification}}</li>
                                            <li>簡介：{{ $Items[$i]->items_description}}</li>
                                            <li>合作農友：{{ $Items[$i]->farmers_name}}</li>
                                        </ul>
                                    <p align="center"><a href="{{url('reports/'.$Items[$i]->batchs_number)}}" target="_blank" class="btn @if($i%2==0)  btn-lg @else btn-lg2 @endif">查看!!</a></p>
                                    </div>
                                </div>
                            </div> <!-- End off col-md-4 -->
                            @endfor
                            
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Pricing Section --> 


</div>
<script>
	$('.culmn').addClass('home');
	$('#mobile_btn').remove();
	$('#bs-example-navbar-collapse-1').remove();
</script>

<!-- START SCROLL TO TOP  -->
@include('footer')