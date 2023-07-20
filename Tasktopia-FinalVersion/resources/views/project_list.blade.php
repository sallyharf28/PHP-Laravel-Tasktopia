@extends('Layout.layout')
@section('content')
	<div class="col-lg-12">
		<div class="card card-outline card-success">
			<div class="card-header">
					<div class="card-tools">
						<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./new_project"><i class="fa fa-plus"></i> Add New Task</a>
					</div>
			</div>
			<div class="card-body">
				<table class="table tabe-hover table-condensed" id="list">
					<colgroup>
						<col width="5%">
						<col width="35%">
						<col width="15%">
						<col width="15%">
						<col width="20%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Tasks</th>
							<th class="text-center">Date Started</th>
							<th class="text-center">Due Date</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
							$where = "";
							if(auth()->user()->type == 2){
								$where = " where manager_id = '".auth()->user()->id."' ";
							}
							$qry = DB::select("SELECT * FROM projects $where order by name asc");
							@endphp
							@foreach($qry as $row)
							@php
								$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
								unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
								$desc = strtr(html_entity_decode($row->description),$trans);
								$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
							@endphp
						<tr>
							<th class="text-center">{{ $i++ }}</th>
							<td>
								<p><b>{{ ucwords($row->name) }}</b></p>
								<p class="truncate">{{ strip_tags($desc) }}</p>
							</td>
							<td class="text-center"><b>{{ date("M d, Y",strtotime($row->start_date)) }}</b></td>
							<td class="text-center"><b>{{ date("M d, Y",strtotime($row->end_date)) }}</b></td>
							<td class="text-center">
								<?php
								if($stat[$row->status] =='Pending'){
									echo "<span class='badge badge-secondary'>{$stat[$row->status]}</span>";
								}elseif($stat[$row->status] =='Started'){
									echo "<span class='badge badge-primary'>{$stat[$row->status]}</span>";
								}elseif($stat[$row->status] =='On-Progress'){
									echo "<span class='badge badge-info'>{$stat[$row->status]}</span>";
								}elseif($stat[$row->status] =='On-Hold'){
									echo "<span class='badge badge-warning'>{$stat[$row->status]}</span>";
								}elseif($stat[$row->status] =='Over Due'){
									echo "<span class='badge badge-danger'>{$stat[$row->status]}</span>";
								}elseif($stat[$row->status] =='Done'){
									echo "<span class='badge badge-success'>{$stat[$row->status]}</span>";
								}
								?>
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								Action
								</button>

								<div class="dropdown-menu">
									<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('view-form-{{$row->id}}').submit();">View</a>
									<form id="view-form-{{$row->id}}" action="/view_project" method="POST" style="display:none;">
										@csrf
										<input type="hidden" name="project_id" value="{{$row->id}}">
									</form>
									<div class="dropdown-divider"></div>
									@if(auth()->user()->type != 2)
									<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('edit-form-{{$row->id}}').submit();">Edit</a>
									<form id="edit-form-{{$row->id}}" action="/edit_project" method="POST" style="display:none;">
										@csrf
										<input type="hidden" name="project_id" value="{{$row->id}}">
									</form>
									<div class="dropdown-divider"></div>
									<a  href="{{ route('delete_project', ['id' => $row->id]) }}" class="dropdown-item" data-id="{{ $row->id }}">Delete</a>
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
	</div>
@endsection
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>