@extends('Layout.layout')
@section('content')
	<div class="col-lg-12">
		<div class="card card-outline card-primary">
			<div class="card-body">
				<form action="{{route('save_project')}}" id="manage-project">
			<input type="hidden" name="id" value="{{ isset($project->id) ? $project->id : ''  }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Name</label>
						<input type="text" class="form-control form-control-sm" name="name" value="{{ isset($project->name) ? $project->name : ''  }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Status</label>
						<select name="status" id="status" class="custom-select custom-select-sm">
							<option value="0" {{ isset($project->status) && $project->status == 0 ? 'selected' : ''  }}>Pending</option>
							<option value="3" {{ isset($project->status) && $project->status == 3 ? 'selected' : ''  }}>On-Hold</option>
							<option value="5" {{ isset($project->status) && $project->status == 5 ? 'selected' : ''  }}>Done</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
				<div class="form-group">
				<label for="" class="control-label">Start Date</label>
				<input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="{{ isset($project->start_date) ? date("Y-m-d",strtotime($project->start_date)) : '' }}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				<label for="" class="control-label">End Date</label>
				<input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="{{ isset($project->end_date) ? date("Y-m-d",strtotime($project->end_date)) : '' }}">
				</div>
			</div>
			</div>
			<div class="row">
				@if(auth()->user()->type == 1 ) 
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Project Manager</label>
							<select class="form-control form-control-sm select2" name="manager_id">
								<option></option>
								@php
									$managers = DB::select("SELECT *, CONCAT(firstname, ' ', lastname) as name FROM users WHERE type = 2 ORDER BY CONCAT(firstname, ' ', lastname) ASC");
								@endphp
								@foreach($managers as $manager)
									<option value="{{ $manager->id }}" {{ isset($manager_id) && $manager_id == $manager->id ? "selected" : '' }}>{{ ucwords($manager->name) }}</option>
								@endforeach
							</select>
						</div>
					</div>
				@else
					<input type="hidden" name="manager_id" value="{{ auth()->user()->id }}">
				@endif 
			</div>
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label for="" class="control-label">Description</label>
						<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
							{{ isset($project->description) ? $project->description : '' }}
						</textarea>
					</div>
				</div>
			</div>
			</form>
			</div>
			<div class="card-footer border-top border-info">
				<div class="d-flex w-100 justify-content-center align-items-center">
					<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project">Save</button>
					<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick='window.history.back()'">Cancel</button>
				</div>
			</div>
		</div>
	</div>	
@endsection
<script>
    $('#manage-project').submit(function(e){
        e.preventDefault();
        start_load();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: new FormData(form[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'GET',
			success:function(resp){
				if(resp.status === 'success'){
					alert_toast(resp.message);
				}else if(resp.status === 'error'){
					$('#msg').html("<div class='alert alert-danger'>".(res.message)."</div>");
					end_load()
				}
			}
        });
    });
</script>