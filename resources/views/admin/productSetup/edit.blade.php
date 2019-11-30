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

{{--     @php
    	if (empty($_GET['productId']))
    	{
    		$productId = "";
    	}
    	else
    	{
    		$productId = $_GET['productId'];
    	}    	
    @endphp --}}

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
    		@include('admin/productSetup/element/update/updateBasicInfo')
    	</div>

    	<div id="advance_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/update/updateAdvanceInfo')
    	</div>

    	<div id="image_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/update/updateImageInfo')
    	</div>

    	<div id="seo_info" class="container tab-pane fade">
    		<div class="card-pad"></div>
    		@include('admin/productSetup/element/update/updateSeoInfo')
    	</div>
    </div>
@endsection

@section('custom-js')
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

    <script type="text/javascript">
        $(document).ready(function() {
            var updateThis ;

            //ajax upload image
            $( "form[name='image-form']" ).on( "submit", function( event ) {
                $('.has-danger').removeClass('has-danger');
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('productSetupImage.save') }}",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var images = response.images;
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Image Successfully Uploded!",
                            timer: 2000,
                            html: true,
                        });
                        $('#images').html(images);
                    },
                    error: function(response) {

                    }
                });
                $("#image-form")[0].reset();
            });
        });

        //ajax remove image
        function removeImage(imageId)
        {
            // e.preventDefault();
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover this imaginary file!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel plx!",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            },

            function(isConfirm){
                if (isConfirm) {                    
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type : 'POST',
                        url: "{{ route('productSetupImage.delete') }}",
                        data : {imageId : imageId},
                        success : function(response){
                            swal({
                                title: "<small class='text-success'>Success!</small>", 
                                type: "success",
                                text: "Image deleted Successfully!",
                                timer: 1000,
                                html: true,
                            });
                            $('.card_image_'+imageId).remove();
                        }
                    })

                }else { 
                    swal({
                        title: "Cancelled", 
                        type: "error",
                        text: "Your Image is safe :)",
                        timer: 1000,
                        html: true,
                    });    
                }
            });
        }
    </script>
@endsection