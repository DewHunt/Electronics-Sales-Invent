@extends('admin.layouts.master')


@section('content')
    <div class="card-pad"></div>

    <form class="form-horizontal" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
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

                    Session::forget('msg');

                    $showroomsId = explode(',', $users->showroomId);
                @endphp

                @if( count($errors) > 0 )
                    <div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <input type="hidden" name="userId" value="{{ $users->id }}">
                <input type="hidden" name="previousUserImage" value="{{ $users->image }}">

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group {{ $errors->has('parent') ? ' has-danger' : '' }}">
                            <label for="role">User Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">Select Role</option>
                                @foreach($userRoles as $role)
                                    @php
                                        if ($role->id == $users->role)
                                        {
                                            $select = 'slected';
                                        }
                                        else
                                        {
                                            $select = '';
                                        }
                                    @endphp
                                    <option value="{{ $role->id }}" {{ $select }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent'))
                                @foreach($errors->get('parent') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>                                       
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group {{ $errors->has('showrooms') ? ' has-danger' : '' }}">
                            <label for="role">Showrooms</label>
                            <select class="form-control chosen-select" id="showrooms" name="showrooms[]" multiple>
                                @foreach($showrooms as $showroom)
                                    @php
                                        if (in_array($showroom->id,$showroomsId))
                                        {
                                            $select = 'selected';
                                        }
                                        else
                                        {
                                            $select = '';
                                        }
                                    @endphp
                                    <option value="{{ $showroom->id }}" {{ $select }}>{{ $showroom->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('showrooms'))
                                @foreach($errors->get('showrooms') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>                                       
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">                 
                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-danger" name="name" value="{{ $users->name }}" required>
                            @if ($errors->has('name'))
                                @foreach($errors->get('name') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>                                       
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('username') ? ' has-danger' : '' }}">
                            <label for="user-name">User Name</label>
                            <input type="text" class="form-control form-control-danger" name="username" value="{{ $users->username }}" required>
                            @if ($errors->has('username'))
                                @foreach($errors->get('username') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>                                       
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-danger" name="email" value="{{ $users->email }}" required>
                            @if ($errors->has('email'))
                                @foreach($errors->get('email') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>                                       
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('userImage') ? ' has-danger' : '' }}">
                                    <label for="user-image">User Image</label>
                                    <input type="file" class="form-control-file border" name="userImage">
                                    @if ($errors->has('userImage'))
                                        @foreach($errors->get('userImage') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                    <img src="{{ url($users->image) }}" class="img-thumbnail" alt="User Image" width="100px" height="100px">
                            </div>
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

    <script type="text/javascript">
        document.forms['editUser'].elements['role'].value = "{{$users->role}}";
    </script>
@endsection


