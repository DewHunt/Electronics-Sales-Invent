@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('user.savePassword') }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">{{ $title }} Of {{ $users->name }}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a style="margin-right: 0px; font-size: 16px;" class="btn btn-outline-info btn-lg"  href="{{ route($goBackLink) }}">
                            <i class="fa fa-arrow-circle-left"></i> Go Back
                        </a>
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @php
                    $message = Session::get('msg');
                    if (isset($message))
                    {
                        echo"<div style='display:inline-block;width: auto;' class='alert alert-success'><strong>" .$message."</strong></div>";
                    }

                    Session::forget('msg')
                @endphp

                @if( count($errors) > 0 )
                    <div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <input type="hidden" name="userId" value="{{ $users->id }}">

                <div class="row">
                    <div class="col-md-12">                                        
                        <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-danger" name="password" value="" required>
                            @if ($errors->has('password'))
                                @foreach($errors->get('password') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection


