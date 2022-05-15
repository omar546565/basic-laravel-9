             <x-app-layout>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        All Category <b> </b>
                        <b style="float:right" >
                            Total
                            <span class="badge bg-danger" >{{count($categories)}}</span>
                        </b>
                    </h2>
                </x-slot>

                <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Category</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">trashCat</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container" >
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card" >
                                            @if(session('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{session('success')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if(session('restore'))
                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <strong>{{session('restore')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if(session('Soft'))
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>{{session('Soft')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <div class="card-header" >
                                                All Category
                                            </div>

                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">category</th>
                                                        <th scope="col">user</th>
                                                        <th scope="col">created at</th>
                                                        <th scope="col">edit-delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($categories as $category )
                                                        <tr>
                                                            <th scope="row">{{$category->id}} </th>
                                                            <td>{{$category->category_name}}</td>
                                                            <td>{{$category->user->name}}</td>
                                                            <td>
                                                                @if($category->created_at == NULL)
                                                                    <span class="text-danger">لا يوجد تاريخ</span>
                                                                @else
                                                                    {{$category->created_at->diffForHumans()}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <a href="{{url('category/edit/'.$category->id)}}" class="btn" ><i style="font-size: 24px;color: rgba(12,114,23,0.93)" class="icofont-edit"></i></a>
                                                                <a href="{{url('category/softdelete/'.$category->id)}}" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-delete-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$categories->links()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card" >

                                            <div class="card-header" >
                                                add Category
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('store.category')}}" method="POST" >
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputCategory" class="form-label">Category name</label>
                                                        <input type="text" name="category_name" class="form-control" id="exampleInputCategory" aria-describedby="CategoryHelp">
                                                        @error('category_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary" style="background: #2168c9">add Category</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> <div class="container" >
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card" >
                                            @if(session('delete'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{session('delete')}}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <div class="card-header" >
                                                trashCat
                                            </div>

                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">category</th>
                                                        <th scope="col">user</th>
                                                        <th scope="col">created at</th>
                                                        <th scope="col">restore-delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($trashCat as $trash )
                                                        <tr>
                                                            <th scope="row">{{$trash->id}} </th>
                                                            <td>{{$trash->category_name}}</td>
                                                            <td>{{$trash->user->name}}</td>
                                                            <td>
                                                                @if($trash->created_at == NULL)
                                                                    <span class="text-danger">لا يوجد تاريخ</span>
                                                                @else
                                                                    {{$trash->created_at->diffForHumans()}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <a href="{{url('category/restore/'.$trash->id)}}" class="btn" ><i style="font-size: 24px;color: #8bb8e0" class="icofont-reply"></i></a>
                                                                <a href="{{url('category/forcedelete/'.$trash->id)}}" class="btn" ><i style="font-size: 20px;color: #d97070" class="icofont-ui-delete"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$trashCat->links()}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div></div>

                    </div>



                </div>
            </x-app-layout>





