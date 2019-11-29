@extends('admin.layouts.masterAddEdit')

@section('card_body')
    @php    
        use App\UserRoles;
        use App\UserMenuActions;
    @endphp

    <div class="card-body">
        <input type="hidden" name="userroleId" value="{{$userRoles->id}}">

        <div class="row">
            <div class="col-md-10">
                <input type="checkbox" class="select_all" name="select_all"> Select All                                        
            </div>
        </div>

        <div class="row">
            @foreach ($userMenus as $menu)
                @php
                    $userMenuAction = UserMenuActions::where('actionStatus',1)->orderBy('orderBy','ASC')->where('parentmenuId',$menu->id)->get();
                    $rolePermission = explode(',', $userRoles->permission);
                    if (in_array($menu->id, $rolePermission))
                    {
                        $checked = "checked";
                    }
                    else
                    {
                        $checked = "";
                    }                                            
                @endphp

                <div class="col-md-2" style="margin-bottom: 12px;">
                    <input class="parentMenu_{{$menu->parentMenu}} menu" type="checkbox" name="usermenu[]" value="{{$menu->id}}" {{$checked}}  data-id="{{$menu->id}}">
                    <span>{{$menu->menuName}}</span>
                    <div style="margin-left: 26px;margin-top: 3px;">
                        @foreach ($userMenuAction as $action)
                            @php
                                $actionPermission = explode(',', $userRoles->actionPermission);
                                if (in_array($action->id, $actionPermission))
                                {
                                    $actionChecked = "checked";
                                }
                                else
                                {
                                    $actionChecked = "";
                                }                                                    
                            @endphp
                            <input class="childMenu_{{$action->parentmenuId}}" type="checkbox" name="usermenuAction[]" value="{{$action->id}}" style="margin-bottom: 8px;" {{$actionChecked}}> {{$action->actionName}} <br>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.select_all').click(function(event){
                if(this.checked)
                {
                    // Iterate each checkbox
                    $(':checkbox').each(function(){
                        this.checked = true;
                    });
                }
                else
                {
                    $(':checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });

            $('.menu').click(function(event){
                var menuId = $(this).data('id');
                if(this.checked)
                {
                    $('.parentMenu_'+menuId).each(function()
                    {
                        this.checked = true;
                    });

                    $('.childMenu_'+menuId).each(function(){
                        this.checked = true;
                    });
                }
                else
                {
                    $('.parentMenu_'+menuId).each(function()
                    {
                        this.checked = false;
                    });

                    $('.childMenu_'+menuId).each(function(){
                        this.checked = false;
                    });
                }
            });
        });

        document.forms['editUser'].elements['role'].value = "{{$userRoles->role}}";
    </script>
@endsection


