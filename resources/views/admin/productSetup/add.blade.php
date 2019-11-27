@extends('admin.layouts.master')

@section('content')
    <div class="card-pad"></div>

    @php
        $message = Session::get('msg');
    @endphp

    @if (isset($message))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> {{ $message }}
		</div>
    @endif

    @php
        Session::forget('msg');
    @endphp

    @php
    	if (empty($_GET['productId']))
    	{
    		$productId = "";
    	}
    	else
    	{
    		$productId = $_GET['productId'];
    	}    	
    @endphp

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
    	<li class="nav-item">
    		<a class="nav-link active" data-toggle="tab" href="#basic_info" style="font-weight: bold;">{{ $tab1 }}</a>
    	</li>
    	<li class="nav-item">
    		<a class="nav-link" data-toggle="tab" href="#advance_info" style="font-weight: bold;">{{ $tab2 }}</a>
    	</li>
    	<li class="nav-item">
    		<a class="nav-link" data-toggle="tab" href="#image_info" style="font-weight: bold;">{{ $tab3 }}</a>
    	</li>
    	<li class="nav-item">
    		<a class="nav-link" data-toggle="tab" href="#seo_info" style="font-weight: bold;">{{ $tab4 }}</a>
    	</li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
    	<div id="basic_info" class="container tab-pane active">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/add/addBasicInfo')
    	</div>

    	<div id="advance_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/add/addAdvanceInfo')
    	</div>

    	<div id="image_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/add/addImageInfo')
    	</div>

    	<div id="seo_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/add/addSeoInfo')
    	</div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
        $(function(){
            $("#hotInput").click(function(){
                if ($(this).is(":checked")){
                    $("#hotDeal").show();
                    $("#specialInput"). prop("checked", false);
                    $("#specialDeal").hide();
                }
                else
                {
                    $("#hotDeal").hide();
                }
            });
        });

        $(function(){
            $("#specialInput").click(function(){
                if ($(this).is(":checked")){
                    $("#specialDeal").show();
                    $("#hotInput"). prop("checked", false);
                    $("#hotDeal").hide();
                }
                else
                {
                    $("#specialDeal").hide();
                }
            });
        });

        function findMrpHairePrice()
        {
        	if ($("#price").val() == "")
        	{
        		var price = 0
        	}
        	else
        	{
        		var price = parseFloat($("#price").val());
        	}

        	var mrpPrice = price + (price * 8)/100;
        	var hairePrice = mrpPrice + (mrpPrice * 12)/100;
        	$("#mrpPrice").val(mrpPrice.toFixed(2));
        	$("#hairePrice").val(hairePrice.toFixed(2));
        }
    </script>
@endsection