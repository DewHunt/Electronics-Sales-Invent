@extends('admin.layouts.masterPrint')

@section('custome-css')
  
@endsection

@section('content')
    @php
        use App\DealerSetup;
        use App\StaffSetup;
        use App\Product;
        use App\CommissionConfiguration;
        $commissionType = array('Dealer Commission' => 'Dealer Commission', 'Staff Commission' => 'Staff Commission', 'Group Commission' => 'Group Commission');

            $dealer = DealerSetup::where('id',@$commission->dealer_id)->first();
            $staff = StaffSetup::where('id',@$commission->staff_id)->first();
            if(@$dealer){
                $name = $dealer->name;
            }elseif(@$staff){
                $name = $staff->name;
            }else{

            }
    @endphp
    <table id="report-header">
        <tr>
            <td>Commission Details</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table width="100%">
        <tr>
            <td width="50%">
                <table>
                    <tbody>
                        <tr>
                            <td>Type</td>
                            <td width="10px">:</td>
                            <td>{{$commission->commission_type}}</td>
                        </tr>
                    </tbody>
                </table>
            </td>

            <td width="50%" align="right">
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td width="10px">:</td>
                            <td>{{$name}}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        
    </table>


    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th>Product Category Name</th>
                <th width="150px">Commission Rate (%)</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
            @endphp
            @foreach ($categoryList as $category)
            @php
                $commissionCategory = CommissionConfiguration::where('category_id',$category->id)->where('commission_type',$commission->commission_type)->first();
                $product = Product::where('category_id',$category->id)->get();
                if(@$product){
            @endphp
            <tr>
                <td>{{ $sl++ }}</td>
                <td>
                    {{ $category->name }}
                    <input type="hidden" name="categoryId[]" value="{{ $category->id }}">
                    <input type="hidden" name="categoryName[]" value="{{ $category->name }}">
                </td>
                <td style="text-align: center;">
                    {{@$commissionCategory->commission_rate}}
                </td>
            </tr>
            
            @php
                }
            @endphp
            @endforeach
        </tbody>
    </table>
@endsection