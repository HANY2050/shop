@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div class="card-header">{{ __('Tags') }}</div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong  >{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        <form action="{{route('tags')}}" method="post" class="row">

                            @csrf

                            <div class="form-group col-md-6 ">
                                <label for="tag_name" >Tag Name</label>
                                <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Tag Name " required >
                            </div>



                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary btn2 " >ادخال البيانات</button>
                            </div>
                        </form>













                        <div class="row">

                            @foreach($tags as $tag)
                                <div class="col-md-4" >
                                    <div class="alert alert-primary" role="alert">
<span>
                                            <form action="{{route('tags')}}" method="post"  >
                                         @csrf

                                       <input type="hidden" name="_method"  value="delete" />
                                                   <input type="hidden" name="tag_id"  value="{{$tag->id}}" />
                                                <button type="submit" class="delete-btn" ><i class="fas fa-trash-alt"></i></button>

                                            </form>

                                        </span>

                                        <span> <a class="edit-All" data-tagname="{{$tag->tag}}"

                                                  data-tagid="{{$tag->id}}"> <i class="fas fa-edit"></i> </a>  </span>

                                        <h5>{{$tag->tag}}</h5>



                                    </div>


                                </div>

                            @endforeach

                        </div>

                            {{ (!is_null($showLinks)&&$showLinks)  ? $tags->links('pagination::bootstrap-4'):'' }}
                            <form action="{{route('search-tags')}}"  method="get"  >
                                @csrf
                                <div class="row" >
                                    <div class="form-group col-md-6 ">
                                        <input type="text" class="form-control" name="tag_search" id="tag_search" placeholder="Tag Search " required >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary" >بحث</button>
                                    </div>
                                </div>
                            </form>

                    </div>

                </div>

            </div>

        </div>

    </div>




    <div class="modal" tabindex="-1"  id="edit" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل البيانات</h5>
                    <span> <a  href=""  class="edit-close"  >  <i class="fas fa-window-close"></i> </a>  </span>
                </div>
                <div class="modal-body">
                    <form action="{{route('tags')}}" method="post" class="row">

                        @csrf

                        <div class="form-group col-md-6 ">
                            <label for="tag_name" >Tag Name</label>
                            <input type="text" class="form-control" name="tag_name" id="edit_tag_name" placeholder="Tag Name " required >
                        </div>

                        <input type="hidden" class="form-control" name="tag_id" id="edit_tag_id"  required >
                        <input type="hidden" name="_method"  value="put" />
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn2 " >تحديث البيانات </button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


    <script type="text/javascript">
        $('.delete-btn').click(function(e) {
            if(!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        $(document).ready(function (){
            var $deleteUnit = $('.edit-All');
            var $deleteWindow = $('#edit');
            var $edit_tag_name =$('#edit_tag_name');

            var $edit_tag_id =$('#edit_tag_id');
            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var tagName = $(this).data('tagname');

                var tagId = $(this).data('tagid');
                $deleteWindow.modal('show');

                $edit_tag_name.val(tagName);

                $edit_tag_id.val(tagId);

            });


        });


    </script>


@endsection

