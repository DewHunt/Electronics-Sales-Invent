@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" id="search" action="{{ route($searchFormLink) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnSummary" value="Summary"><i class="fa fa-search"></i> Lifting Summary</button>
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnRecord" value="Record"><i class="fa fa-search"></i> Lifting History</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="print" value="print">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="supplier">Supplier</label>
                        <div class="form-group">
                            <select class="form-control chosen-select" id="vendor" name="vendor[]" multiple>
                                @foreach ($vendors as $vendorInfo)
                                    @php
                                        $select = "";
                                        if ($vendor)
                                        {
                                            if (in_array($vendorInfo->id, $vendor))
                                            {
                                                $select = "selected";
                                            }
                                            else
                                            {
                                                $select = "";
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $vendorInfo->id }}" {{ $select }}>{{ $vendorInfo->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="from-date">From Date</label>
                        <input  type="text" class="form-control datepicker" id="{{ $print == "print" ? "" : "from_date" }}" name="fromDate" placeholder="Select Date From" value="{{ date('d-m-Y',strtotime($fromDate)) }}" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="to-date">To Date</label>
                        <input  type="text" class="form-control datepicker" id="{{ $print == "print" ? "" : "to_date" }}" name="toDate" placeholder="Select Date To" value="{{ date('d-m-Y',strtotime($toDate)) }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="type">Type</label>
                        <div class="form-group">
                            @php
                                $types = array('store'=>'Store','showroom'=>'Showroom');
                            @endphp
                            <select class="form-control chosen-select" id="type" name="type">
                                <option value="">Select Types</option>
                                @foreach ($types as $key => $value)
                                    @php
                                        $select = "";
                                        if ($type)
                                        {
                                            if ($key == $type)
                                            {
                                                $select = "selected";
                                            }
                                            else
                                            {
                                                $select = "";
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $key }}" {{ $select }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <label for="store-or-showroom">Stores Or Showrooms</label>
                        <div class="form-group">
                            <select class="form-control chosen-select" name="storeOrShowroom">
                                <option value=" ">Select Stores Or Showrooms</option>
                                @foreach ($storesAndShowrooms as $storeAndShowroom)
                                    @php
                                        if ($storeAndShowroom->type == $storeOrShowroomType AND $storeAndShowroom->id == $storeOrShowroomId)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }                                        
                                    @endphp
                                    <option value="{{ $storeAndShowroom->id }},{{ $storeAndShowroom->type }}" {{ $select }}>{{ $storeAndShowroom->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="category">Category</label>
                        <div class="form-group">
                            <select class="form-control chosen-select" id="category" name="category[]" multiple>
                                @foreach ($categories as $categoryInfo)
                                    @php
                                        $select = "";
                                        if ($category)
                                        {
                                            if (in_array($categoryInfo->id, $category))
                                            {
                                                $select = "selected";
                                            }
                                            else
                                            {
                                                $select = "";
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $categoryInfo->id }}" {{ $select }}>{{ $categoryInfo->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <label for="product">Product</label>
                        <div class="form-group">
                            <select class="form-control chosen-select" id="product" name="product[]" multiple>
                                @foreach ($products as $productInfo)
                                    @php
                                        $select = "";
                                        if ($product)
                                        {
                                            if (in_array($productInfo->id, $product))
                                            {
                                                $select = "selected";
                                            }
                                            else
                                            {
                                                $select = "";
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $productInfo->id }}" {{ $select }}>{{ $productInfo->name }}</option>
                                @endforeach
                            </select>
                        </div>                                  
                    </div>
                </div>                              
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnSummary" value="Summary"><i class="fa fa-search"></i> Lifting Summary</button>
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnRecord" value="Record"><i class="fa fa-search"></i> Lifting History</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>

    @if ($btnSummary != "" || $btnRecord != "")
        <div class="card" style="margin-bottom: 0px;">              
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">Searched Report</h4></div>
                    <div class="col-md-6 text-right">
                        <form class="form-horizontal" id="print" action="{{ route($printFormLink) }}" target="_blank" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @if ($vendor)
                                @foreach ($vendor as $vendorInfo)
                                    <input type="hidden" name="vendor[]" value="{{ $vendorInfo }}">
                                @endforeach
                            @endif

                            @if ($category)
                                @foreach ($category as $categoryInfo)
                                    <input type="hidden" name="category[]" value="{{ $categoryInfo }}">
                                @endforeach
                            @endif

                            @if ($product)
                                @foreach ($product as $productInfo)
                                    <input type="hidden" name="product[]" value="{{ $productInfo }}">
                                @endforeach
                            @endif

                            <input type="hidden" name="fromDate" value="{{ $fromDate }}">
                            <input type="hidden" name="toDate" value="{{ $toDate }}">

                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="storeOrShowroomType" value="{{ $storeOrShowroomType }}">
                            <input type="hidden" name="storeOrShowroomId" value="{{ $storeOrShowroomId }}">
                            <input type="hidden" id="print_value" name="print" value="{{ $print }}">

                            @if ($btnSummary == "Summary")
                                <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnPrintSummary" value="Print Summary"><i class="fa fa-print"></i> Print Lifting Summary</button>
                            @endif
                            
                            @if ($btnRecord == "Record")
                                <button type="submit" class="btn btn-outline-info btn-lg waves-effect" name="btnPrintRecord" value="Print Record"><i class="fa fa-print"></i> Print Lifting History</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($btnSummary == "Summary")
                    <table id="dataTable" name="liftingSummary" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th width="20px">Sl</th>
                                <th>Product Name</th>
                                <th width="200px">Model</th>
                                <th width="100px">Total Lifting</th>
                                <th width="110px">Toal Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($liftingSummaries as $liftingSummary)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $liftingSummary->productName }}</td>
                                    <td>{{ $liftingSummary->productModelNo }}</td>
                                    <td align="right">{{ $liftingSummary->totalLifting }}</td>
                                    <td align="right">{{ $liftingSummary->totalLiftingPrice }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if ($btnRecord == "Record")
                    <table id="dataTable" name="liftingRecord" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th width="20px">Sl</th>
                                <th>Date</th>
                                <th>Lifting No</th>
                                <th>Vendor</th>
                                <th>Store/Showroom Name</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Serial</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($liftingRecords as $liftingRecord)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $liftingRecord->liftingDate }}</td>
                                    <td>{{ $liftingRecord->liftingNo }}</td>
                                    <td>{{ $liftingRecord->vendorName }}</td>
                                    <td>{{ $liftingRecord->storeOrShowroomName }}</td>
                                    <td>{{ $liftingRecord->categoryName }}</td>
                                    <td>{{ $liftingRecord->productName }}</td>
                                    <td>{{ $liftingRecord->productSerialNo }}</td>
                                    <td>{{ $liftingRecord->productModelNo }}</td>
                                    <td>{{ $liftingRecord->productColor }}</td>
                                    <td align="right">{{ $liftingRecord->productQty }}</td>
                                    <td align="right">{{ $liftingRecord->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif                            
            </div>
        </div>
    @endif
@endsection