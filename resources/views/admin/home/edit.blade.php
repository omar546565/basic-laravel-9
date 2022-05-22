@extends('admin.admin_master')
@section('admin')

                <div class="py-12">
                    <div class="container" >
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card" >

                                    <div class="card-header" >
                                        Edit about
                                    </div>
                                    <div class="card-body">

                                        <form action="{{url('about/update/'.$abouts->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf


                                            <div class="mb-3">
                                                <label for="exampleInputbrand" class="form-label">title</label>
                                                <input type="text" name="title" value="{{$abouts->title}}" class="form-control"  aria-describedby="CategoryHelp">
                                                @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label  class="form-label">short_dis</label>
                                                <textarea   name="long_dis" class="form-control"    aria-describedby="BrandHelp">{{$abouts->short_dis}}</textarea>
                                                @error('short_dis')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label  class="form-label">long_dis</label>
                                                <textarea   name="long_dis" class="form-control"    aria-describedby="BrandHelp">{{$abouts->long_dis}}</textarea>
                                                @error('long_dis')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-success" style="background: #2168c9">update about</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection





