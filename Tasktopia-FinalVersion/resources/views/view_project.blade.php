@extends('Layout.layout')
@section('content')
@php
	use App\Models\User;
	use App\Models\Project;
	session_start();
	$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
	$id = $project->id ?? '';
	$name = $project->name ?? '';
	$description = $project->description ?? '';
	$start_date = $project->start_date ?? '';
	$end_date = $project->end_date ?? '';
	$manager_id = $project->manager_id ?? '';
	$status = $project->status ?? '';
	$manager = User::find($manager_id);
	$manager = ($manager->firstname ?? '').' '.($manager->lastname ?? '');
@endphp

<div class="col-lg-12">
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-info">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<dl>
								<dt><b class="border-bottom border-primary">Task Name</b></dt>
								<dd>{{ucwords($name)}}</dd>
								<dt><b class="border-bottom border-primary">Description</b></dt>
								<dd>{{ html_entity_decode($description) }}</dd>
							</dl>
						</div>
						<div class="col-md-6">
							<dl>
								<dt><b class="border-bottom border-primary">Start Date</b></dt>
								<dd>{{ \Carbon\Carbon::parse($start_date)->format("F d, Y") }}</dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">End Date</b></dt>
								<dd>{{ \Carbon\Carbon::parse($end_date)->format("F d, Y") }}</dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Status</b></dt>
								<dd>
									@if($stat[$status] =='Pending')
									  	<span class='badge badge-secondary'>{{$stat[$status]}}</span>
									@elseif($stat[$status] =='Started')
									  	<span class='badge badge-primary'>{{$stat[$status]}}</span>
									@elseif($stat[$status] =='On-Progress')
									  	<span class='badge badge-info'>{{$stat[$status]}}</span>
									@elseif($stat[$status] =='On-Hold')
									  	<span class='badge badge-warning'>{{$stat[$status]}}</span>
									@elseif($stat[$status] =='Over Due')
									  	<span class='badge badge-danger'>{{$stat[$status]}}</span>
									@elseif($stat[$status] =='Done')
									  	<span class='badge badge-success'>{{$stat[$status]}}</span>
									@endif
								</dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection