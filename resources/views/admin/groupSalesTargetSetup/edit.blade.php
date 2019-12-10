@extends('admin.layouts.masterAddEdit')

@section('custom_css')
	<style type="text/css">
		 #total-target{vertical-align: middle; text-align: center; font-weight: bold; font-size: 16px;}
	</style>
@endsection

@section('card_body')
    <div class="card-body">
    	<input type="hidden" name="groupSalesTargetId" value="{{ $groupSalesTarget->id }}">
	    <div class="row">
	        <div class="col-md-6">
	            <label for="group">Group</label>
	            <div class="form-group">
	                <select class="form-control chosen-select" id="group" name="group">
	                	<option value="">Select Group</option>
	                    @foreach ($groups as $group)
	                    	@php
	                    		if ($group->id == $groupSalesTarget->group_id)
	                    		{
	                    			$select = "selected";
	                    		}
	                    		else
	                    		{
	                    			$select = "";
	                    		}	                    		
	                    	@endphp
	                        <option value="{{ $group->id }}" {{ $select }}>{{ $group->name }}</option>
	                    @endforeach
	                </select>
	            </div>  
	        </div>

	        <div class="col-md-6">
	            <div class="row">
	                <div class="col-md-6 form-group">
	                    <label for="from-date">Month</label>
	                    <div class="form-group">
	                        @php
                                $select = "";
	                            $months = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
	                        @endphp
	                        <select class="form-control" id="month" name="month">
	                            @foreach ($months as $key => $value)
	                                @php
	                                    if ($key == $groupSalesTarget->month)
	                                    {
	                                        $select = "selected";
	                                    }
	                                    else
	                                    {
	                                        $select = "";
	                                    }
	                                @endphp
	                                <option value="{{ $key }}" {{ $select }}>{{ $value }}</option>
	                            @endforeach
	                        </select>
	                    </div>
	                </div>
	                <div class="col-md-6 form-group">
	                    <label for="from_date">Year</label>
	                    <select class="form-control" id="year" name="year">
	                        @php
	                            $currentYear = date('Y');
	                        @endphp
	                        <option value="">Select Year</option>
	                        @for ($i = $currentYear; $i >= 1900; $i--)
	                            @php
	                                if ($i == $groupSalesTarget->year)
	                                {
	                                    $select = "selected";
	                                }
	                                else
	                                {
	                                    $select = "";
	                                }
	                            @endphp
	                            <option value="{{ $i }}" {{ $select }}>{{ $i }}</option>
	                        @endfor
	                    </select>
	                </div>
	            </div>                                  
	        </div>
	    </div>

    	@php
    		$i = 0;
    	@endphp

    	<table class="table table-bordered table-sm">
    		<thead class="thead-dark">
    			<th>Category</th>
    			<th>Target</th>
    		</thead>
    		<tbody>
			    @foreach ($categories as $category)
			    	@php
			    		$i++;
			    		$target = 0;
			    		foreach ($groupSalesTargetCategories as $groupSalesTargetCategory)
			    		{
			    			if ($category->id == $groupSalesTargetCategory->category_id)
			    			{
			    				$target = $groupSalesTargetCategory->target;
			    			}			    			
			    		}
			    	@endphp
			    	<tr>
			    		<td>
		                    <input type="hidden" name="categoryId[]" value="{{ $category->id }}">
		                    <input type="text" class="form-control" name="categoryName_{{ $i }}" value="{{ $category->name }}" readonly>
			    		</td>
			    		<td>
			    			<input type="number" class="form-control target" name="targets[]" value="{{ $target }}" oninput="countTarget()">
			    		</td>
			    	</tr>
			    @endforeach    			
    		</tbody>
    		<tfoot>
    			<tr>
    				<td id="total-target">Total Taget</td>
    				<td><input type="number" class="form-control" id="totalTarget" name="totalTarget" value="{{ $groupSalesTarget->total_target }}" readonly></td>
    			</tr>
    		</tfoot>
    	</table>
    </div>
@endsection

@section('custom-js')
	<script type="text/javascript">
		function countTarget(i){
			var totalTarget = 0;
            $(".target").each(function () {
                var target = parseInt($(this).val());
                totalTarget += isNaN(target) ? 0 : target;
                console.log(totalTarget);
            });

			$('#totalTarget').val(totalTarget);
		}
	</script>
@endsection