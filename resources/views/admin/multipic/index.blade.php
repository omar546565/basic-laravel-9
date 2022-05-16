             <x-app-layout>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        multi image <b> </b>
                        <b style="float:right" >
                            Total
                            <span class="badge bg-danger" >{{count($images)}}</span>
                        </b>
                    </h2>
                </x-slot>

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
                                                All multi
                                            </div>

                                             <div class="row">
                                                 @foreach($images as $multi )
                                                     <div style="width: 400px;position: relative;margin: auto">
                                                         <img src="{{asset($multi->image)}}" width="300" height="300" alt="">
                                                         <a   href="{{url('multi/forcedelete/'.$multi->id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا البند نهائيا')" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                     </div>
                                                 @endforeach
                                             </div>



                                                {{$images->links()}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card" >

                                            <div class="card-header" >
                                                add multi
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('store.images')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                     <div class="mb-3">
                                                        <label for="Inputmultiimage" class="form-label">multi image</label>
                                                        <input type="file" name="image[]" class="form-control" id="Inputmultiimage" multiple="" aria-describedby="multiHelp">
                                                        @error('image')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary" style="background: #2168c9">add multi</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                    </div>



                </div>
            </x-app-layout>





