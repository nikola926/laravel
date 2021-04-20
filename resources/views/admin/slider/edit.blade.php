@extends('admin.admin_master')
@section('admin')



    <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
        <div class="row">
          <div class="col-md-12">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">Edit Slider</div>
              <div class="card-body">


<form method="POST" action="{{ url('/slider/update/'.$sliders->id) }}" enctype="multipart/form-data">
@csrf

  
  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input type="text" name="slider_title" class="form-control" id="exampleFormControlInput1" value="{{ $sliders->title }}" placeholder="Enter Title">
    @error('slider_title')
        <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Textarea</label>
    <textarea class="form-control" name="slider_text" id="exampleFormControlTextarea1" rows="3">{{ $sliders->description }}</textarea>
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
      <img src="{{ asset($sliders->image) }}" style="width: 150px;height: 100px;margin-top: 20px;">
  </div>
  <div class="form-footer pt-4 pt-5 mt-4 border-top">
    <button type="submit" class="btn btn-primary btn-default">Update</button>
    
  </div>
</form>


              </div>
            </div>
          </div>
            
        </div>
    </div>

@endsection
