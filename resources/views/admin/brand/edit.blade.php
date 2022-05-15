             <x-app-layout>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Edit brand <b> </b>

                    </h2>
                </x-slot>

                <div class="py-12">
                    <div class="container" >
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card" >

                                    <div class="card-header" >
                                        Edit brand
                                    </div>
                                    <div class="card-body">
                                        <form action="{{url('brand/update/'.$brands->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <input hidden type="text" name="old_image" value="{{$brands->brand_image}}" class="form-control"    >

                                            <div class="mb-3">
                                                <label for="exampleInputbrand" class="form-label">brand name</label>
                                                <input type="text" name="brand_name" value="{{$brands->brand_name}}" class="form-control"  id="exampleInputbrand" aria-describedby="CategoryHelp">
                                                @error('brand_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputbrandimage" class="form-label">brand image</label>
                                                <input type="file" name="brand_image" value="{{$brands->brand_image}}" class="form-control"  id="exampleInputbrandimage" aria-describedby="CategoryHelp">
                                                @error('brand_image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <img src="{{asset($brands->brand_image)}}" width="200" alt="{{$brands->brand_name}}">
                                            </div>

                                            <button type="submit" class="btn btn-success" style="background: #2168c9">edit brand</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </x-app-layout>





