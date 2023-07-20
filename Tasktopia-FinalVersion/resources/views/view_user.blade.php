@extends('Layout.layout')
  @section('content')
    @php
    $type_arr = array('', "Admin", "Team Member");
    @endphp
    <div class="container-fluid">
    <div class="card card-widget widget-user shadow">
        <div class="widget-user-header bg-dark">
            <h3 class="widget-user-username">{{ ucwords($user->name) }}</h3>
            <h5 class="widget-user-desc">{{ $user->email }}</h5>
        </div>
        <div class="widget-user-image">
            @if(empty($user->avatar) || (!empty($user->avatar) && !is_file('assets/uploads/'.$user->avatar)))
                <span class="brand-image img-circle elevation-2 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 90px;height:90px"><h4>{{ strtoupper(substr($user->firstname, 0,1).substr($user->lastname, 0,1)) }}</h4></span>
            @else
                <img class="img-circle elevation-2" src="assets/uploads/{{ $user->avatar }}" alt="User Avatar"  style="width: 90px;height:90px;object-fit: cover">
            @endif
        </div>
        <div class="card-footer">
            <div class="container-fluid">
                <dl>
                    <dt>Role</dt>
                    <dd>{{ $type_arr[$user->type] }}</dd>
                </dl>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer display p-0 m-0">
    <button id="closeButton" class="btn btn-secondary" data-dismiss="modal" onclick='window.history.back()'">Close</button>
    </div>
@endsection