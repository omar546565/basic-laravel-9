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
                                                All Brand
                                            </div>

                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Brand</th>
                                                        <th scope="col">image</th>
                                                        <th scope="col">created at</th>
                                                        <th scope="col">edit-delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($brands as $Brand )
                                                        <tr>
                                                            <th scope="row">{{$Brand->id}} </th>
                                                            <td>{{$Brand->brand_name}}</td>
                                                            <td><img src="{{asset($Brand->brand_image)}}" width="50" alt="{{$Brand->brand_name}}">  </td>

                                                            <td>
                                                                @if($Brand->created_at == NULL)
                                                                    <span class="text-danger">لا يوجد تاريخ</span>
                                                                @else
                                                                    {{$Brand->created_at->diffForHumans()}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <a href="{{url('brand/edit/'.$Brand->id)}}" class="btn" ><i style="font-size: 24px;color: rgba(12,114,23,0.93)" class="icofont-edit"></i></a>
                                                                <a href="{{url('brand/forcedelete/'.$Brand->id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا البند نهائيا')" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$brands->links()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card" >

                                            <div class="card-header" >
                                                add Brand
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="InputBrandname" class="form-label">Brand name</label>
                                                        <input type="text" name="brand_name" class="form-control" id="InputBrandname" aria-describedby="BrandHelp">
                                                        @error('brand_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                     <div class="mb-3">
                                                        <label for="InputBrandimage" class="form-label">Brand image</label>
                                                        <input type="file" name="brand_image" class="form-control" id="InputBrandimage" aria-describedby="BrandHelp">
                                                        @error('brand_image')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary" style="background: #2168c9">add Brand</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                    </div>
          @endsection







