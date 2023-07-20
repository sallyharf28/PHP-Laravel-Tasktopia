@extends('Layout.layout')
@section('content')
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('save_user') }}" id="manage_user">
					@csrf
					<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="form-group">
								<label for="" class="control-label">First Name</label>
								<input type="text" name="firstname" class="form-control form-control-sm" required value="{{ isset($firstname) ? $firstname : '' }}">
							</div>
							<div class="form-group">
								<label for="" class="control-label">Last Name</label>
								<input type="text" name="lastname" class="form-control form-control-sm" required value="{{ isset($lastname) ? $lastname : '' }}">
							</div>
							@if( auth()->user()->type == 1) 
								<div class="form-group">
									<label for="" class="control-label">User Role</label>
									<select name="type" id="type" class="custom-select custom-select-sm">
										<option value="2" {{ isset($type) && $type == 2 ? 'selected' : '' }}>Team Member</option>
										<option value="1" {{ isset($type) && $type == 1 ? 'selected' : '' }}>Admin</option>
									</select>
								</div>
							@else
								<input type="hidden" name="type" value="2">
							@endif 
							<div class="form-group">
								<label for="" class="control-label">Avatar</label>
								<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
								<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
							<div class="form-group d-flex justify-content-center align-items-center">
								<img src="{{ isset($avatar) ? 'assets/uploads/'.$avatar :'' }}" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control form-control-sm" name="email" required value="{{ isset($email) ? $email : '' }}">
								<small id="#msg"></small>
							</div>
							<div class="form-group">
								<label class="control-label">Password</label>
								<input type="password" class="form-control form-control-sm" name="password" {{ !isset($id) ? "required":'' }}>
								<small><i>{{ isset($id) ? "Leave this blank if you dont want to change you password":'' }}</i></small>
							</div>
							<div class="form-group">
								<label class="label control-label">Confirm Password</label>
								<input type="password" class="form-control form-control-sm" name="cpass" {{ !isset($id) ? "required":'' }}>
								<small id="pass_match" data-status=''></small>
							</div>
						</div>
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button class="btn btn-primary mr-2">Save</button>
						<button class="btn btn-secondary" type="button" onclick='window.history.back()'">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endsection
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url: form.attr('action'),
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
			success:function(resp){
				if(resp.status === 'success'){
					alert_toast(resp.message);
				}else if(resp.status === 'error'){
					$('#msg').html("<div class='alert alert-danger'>".(res.message)."</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>