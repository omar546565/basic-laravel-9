@extends('admin.admin_master')
@section('admin')

                <div class="py-12">
                    <div class="container" >
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card" >

                                    <div class="card-header" >
                                        Edit slider
                                    </div>
                                    <div class="card-body">

                                        <form action="{{url('slider/update/'.$sliders->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <input hidden type="text" name="old_image" value="{{$sliders->image}}" class="form-control"    >

                                            <div class="mb-3">
                                                <label for="exampleInputbrand" class="form-label">title</label>
                                                <input type="text" name="title" value="{{$sliders->title}}" class="form-control"  aria-describedby="CategoryHelp">
                                                @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputbrand" class="form-label">description</label>
                                                <textarea   name="description" class="form-control" style="height: 150px" aria-describedby="CategoryHelp">{{$sliders->description}}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputbrandimage" class="form-label">image</label>
                                                <input type="file" name="image" value="{{$sliders->image}}" class="form-control"   aria-describedby="CategoryHelp">
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <img src="{{asset($sliders->image)}}" width="200" alt="{{$sliders->title}}">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-success" style="background: #2168c9">update slider</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection





