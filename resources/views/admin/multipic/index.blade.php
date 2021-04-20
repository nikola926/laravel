<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Picture
            
            
        </h2>
    </x-slot>

    <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
            @foreach($images as $image)

              <div class="col-md-4 pt-5">
                <div class="card">
                  <img src="{{ asset($image->image) }}" alt="">
                </div>
              </div>

            @endforeach
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">Add Image</div>
              <div class="card-body">


<form action="{{ route('multi.add') }}" method="POST" enctype="multipart/form-data" >
  @csrf



  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"> Brand Name</label>
    <input type="file" name="image[]" class="form-control" id="brand_image" aria-describedby="emailHelp" multiple="">
    @error('brand_image')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Add Image</button>
</form>


              </div>
            </div>
          </div>


            
        </div>
    </div>
</x-app-layout>
