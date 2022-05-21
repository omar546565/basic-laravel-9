          @extends('admin.admin_master')
          @section('admin')
                <div class="py-12">
                                 <div class="row">
                                    <div class="col-md-8">
                                        <div class="card" >
                                            @if(session('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{session('success')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if(session('delete'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{session('delete')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <div class="card-header" >
                                                All slider
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">slider Title</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">image</th>
                                                        <th scope="col">created at</th>
                                                        <th scope="col">edit-delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sliders as $slider )
                                                        <tr>
                                                            <th scope="row">{{$slider->id}} </th>
                                                            <td>{{$slider->title}}</td>
                                                            <td>{{$slider->description}}</td>
                                                            <td><img src="{{asset($slider->image)}}" width="200" alt="{{$slider->title}}">  </td>
                                                            <td>
                                                                @if($slider->created_at == NULL)
                                                                    <span class="text-danger">لا يوجد تاريخ</span>
                                                                @else
                                                                    {{$slider->created_at->diffForHumans()}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{url('slider/edit/'.$slider->id)}}" class="btn" ><i style="font-size: 24px;color: rgba(12,114,23,0.93)" class="icofont-edit"></i></a>
                                                                <a href="{{url('slider/forcedelete/'.$slider->id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا البند نهائيا')" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$sliders->links()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card" >
                                            <div class="card-header" >
                                                add slider
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('store.slider')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label  class="form-label">slider Title</label>
                                                        <input type="text" name="title" class="form-control"   aria-describedby="BrandHelp">
                                                        @error('title')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label  class="form-label">description</label>
                                                        <textarea   name="description" class="form-control"   aria-describedby="BrandHelp"></textarea>
                                                        @error('description')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                     <div class="mb-3">
                                                        <label   class="form-label">slider image</label>
                                                        <input type="file" name="image" class="form-control"   aria-describedby="BrandHelp">
                                                        @error('image')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" style="background: #2168c9">add slider</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                    </div>
          @endsection







