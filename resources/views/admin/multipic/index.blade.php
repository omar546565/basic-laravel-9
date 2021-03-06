@extends('admin.admin_master')
@section('admin')

                <div class="py-12">

                                 <div class="row">
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
                                                     <div class="mb-3">
                                                         <label for="Inputmultiimage" class="form-label">type image</label>
                                                            <select  class="form-control" name="type" required>
                                                                <option value=""></option>
                                                                <option value="web">web</option>
                                                                <option value="app">app</option>
                                                                <option value="card">card</option>
                                                            </select>
                                                            @error('type')
                                                         <span class="text-danger">{{$message}}</span>
                                                         @enderror
                                                     </div>

                                                     <button type="submit" class="btn btn-primary" style="background: #2168c9">add multi</button>
                                                 </form>
                                             </div>

                                         </div>
                                     </div>
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
                                                         <a   href="{{url('multi/forcedelete/'.$multi->id)}}" onclick="return confirm('???? ?????? ?????????? ???? ?????? ?????? ?????????? ????????????')" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                     </div>
                                                 @endforeach
                                             </div>



                                                {{$images->links()}}

                                        </div>
                                    </div>

                                </div>



                </div>


@endsection



