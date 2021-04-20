@extends('admin.admin_master')
@section('admin')

    <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <div class="card-header">
                <h4 style="display: inline-block;">All Sliders</h4>
                <a href="{{ route('slider.add') }}" style="float: right;">
                  <button class="btn btn-info">Add New</button>
                </a>
              </div>
              <table class="table">
              <thead>
                <tr>
                  <th scope="col" style="width: 5%">SL No</th>
                  <th scope="col" style="width: 15%">Title</th>
                  <th scope="col" style="width: 15%">Image</th>
                  <th scope="col" style="width: 25%">Description</th>
                  <th scope="col" style="width: 15%">Date</th>
                  <th scope="col" style="width: 25%">Action</th>
                </tr>
              </thead>
              <tbody>

                @php( $i = 1 )
                @foreach($sliders as $slider)
                  <tr>
                    <th scope="row"> {{ $i++ }} </th>
                    <td> {{ $slider->title }} </td>
                    <td> <img src="{{ asset($slider->image) }}" style="height: 40px;width: auto;"> 
                    </td>
                    <td> {{ $slider->description }} </td>
                    <td> 
                      @if($slider->created_at == NULL)
                      <span class="text-danger">No Date Set</span>
                      @else
                      {{ Carbon\Carbon::parse($slider->created_at)->diffForHumans() }} 
                      @endif
                    </td>
                    <td> 
                      <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                      <a href="{{ url('/slider/delete/'.$slider->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
                    </td>
                  </tr>
                @endforeach

               </tbody>
            </table>
            {{ $sliders->links() }}

            </div>
          </div>

        </div>
    </div>

@endsection
