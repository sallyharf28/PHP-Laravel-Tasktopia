@extends('Layout.layout')
@section('content')
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./new_user"><i class="fa fa-plus"></i> Add New User</a> 
            </div>
        </div>
        <div class="card-body">
            <table class="table tabe-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    $type = ['', 'Admin', 'Team Member'];
                    $users = DB::table('users')->orderBy(DB::raw("CONCAT(firstname, ' ', lastname)"), 'asc')->get();
                    @endphp
                    @foreach($users as $user)
                        <tr>
                            <th class="text-center">{{ $i++ }}</th>
                            <td><b>{{ ucwords($user->firstname . ' ' . $user->lastname) }}</b></td>
                            <td><b>{{ $user->email }}</b></td>
                            <td><b>{{ $type[$user->type] }}</b></td>
                            <td class="text-center">
                                 <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button> 
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('view-form-{{$user->id}}').submit();">View</a>
                                  <form id="view-form-{{$user->id}}" action="/view_user" method="POST" style="display:none;">
                                      @csrf
                                      <input type="hidden" name="user_id" value="{{$user->id}}">
                                  </form>
                                    @if(auth()->user()->type==1)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('edit-form-{{$user->id}}').submit();">Edit</a>
                                    <form id="edit-form-{{$user->id}}" action="/edit" method="POST" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                    </form>
                                    <div class="dropdown-divider"></div>
                                        <a  href="{{ route('delete_user', ['id' => $user->id]) }}" class="dropdown-item" data-id="{{ $user->id }}">Delete</a>
                                    @endif
                              </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<!-- Display success message -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Display error message -->
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif