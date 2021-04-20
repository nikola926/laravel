@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">
    <div class="content">							
      	<div class="row">
			<div class="col-lg-12">
				<div class="card card-default">
					<div class="card-header card-header-border-bottom">
						<h2>Add New Slider</h2>
					</div>
					<div class="card-body">


<form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
@csrf

	<div class="form-group">
		<label for="exampleFormControlInput1">Title</label>
		<input type="text" name="slider_title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title">
		@error('slider_title')
	      <span class="text-danger">{{ $message }}</span>
	    @enderror
	</div>
	<div class="form-group">
		<label for="exampleFormControlTextarea1">Textarea</label>
		<textarea class="form-control" name="slider_text" id="exampleFormControlTextarea1" rows="3"></textarea>
		@error('slider_text')
	      <span class="text-danger">{{ $message }}</span>
	    @enderror
	</div>
	<div class="form-group">
		<label for="exampleFormControlFile1">Image</label>
		<input type="file" name="slider_image" class="form-control-file" id="exampleFormControlFile1">
		@error('slider_image')
	      <span class="text-danger">{{ $message }}</span>
	    @enderror
	</div>
	<div class="form-footer pt-4 pt-5 mt-4 border-top">
		<button type="submit" class="btn btn-primary btn-default">Submit</button>
		<button type="submit" class="btn btn-secondary btn-default">Cancel</button>
	</div>
</form>


					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection