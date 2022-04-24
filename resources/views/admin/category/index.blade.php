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

                <div class="py-12">
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
                                    <th scope="col">Action</th>
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
                                        <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-success" >تحرير</a>
                                        <a href="{{url('category/delete')}}" class="btn btn-danger" >حذف</a>
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
            </x-app-layout>





