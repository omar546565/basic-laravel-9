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
                                                All about
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">about Title</th>
                                                        <th scope="col">short_dis</th>
                                                        <th scope="col">long_dis</th>
                                                        <th scope="col">created at</th>
                                                        <th scope="col">edit-delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($abouts as $about )
                                                        <tr>
                                                            <th scope="row">{{$about->id}} </th>
                                                            <td>{{$about->title}}</td>
                                                            <td>{{$about->short_dis}}</td>
                                                            <td>{{$about->long_dis}}</td>

                                                            <td>
                                                                @if($about->created_at == NULL)
                                                                    <span class="text-danger">لا يوجد تاريخ</span>
                                                                @else
                                                                    {{$about->created_at->diffForHumans()}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{url('about/edit/'.$about->id)}}" class="btn" ><i style="font-size: 24px;color: rgba(12,114,23,0.93)" class="icofont-edit"></i></a>
                                                                <a href="{{url('about/forcedelete/'.$about->id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا البند نهائيا')" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$abouts->links()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card" >
                                            <div class="card-header" >
                                                add about
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('store.about')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label  class="form-label">about Title</label>
                                                        <input type="text" name="title" class="form-control"   aria-describedby="BrandHelp">
                                                        @error('title')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label  class="form-label">short_dis</label>
                                                        <textarea   name="short_dis" class="form-control"   aria-describedby="BrandHelp"></textarea>
                                                        @error('short_dis')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label  class="form-label">long_dis</label>
                                                        <textarea   name="long_dis" class="form-control"   aria-describedby="BrandHelp"></textarea>
                                                        @error('long_dis')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary" style="background: #2168c9">add about</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                    </div>
          @endsection







