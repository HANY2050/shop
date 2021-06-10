
@extends('layouts.app')

@section('content')


    <div class="container">






        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div class="card-header">{{ __('Units') }}</div>




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





                        <form action="{{route('units')}}" method="post" class="row">

                            @csrf

                            <div class="form-group col-md-6 ">
                                <label for="unit_name" >Unit Name</label>
                                <input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="Unit Name " required >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit_code" >Unit Code</label>
                                <input type="text" class="form-control" name="unit_code" id="unit_code" placeholder="Unit Code " required >
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary btn2 " >ادخال البيانات</button>
                            </div>
                        </form>





                        <div class="row">

                            @foreach($units as $unit)

                                <div class="col-md-3" >
                                    <div class="alert alert-primary" role="alert">
                                         <span>
                                            <form action="{{route('units')}}" method="post"  >
                                         @csrf

                                       <input type="hidden" name="_method"  value="delete" />
                                                   <input type="hidden" name="unit_id"  value="{{$unit->id}}" />
                                                <button type="submit" class="delete-btn" ><i class="fas fa-trash-alt"></i></button>

                                            </form>

                                        </span>

                                        <span> <a class="edit-unit" data-unitname="{{$unit->unit_name}}"
                                                  data-unitcode="{{$unit->unit_code}}"
                                                  data-unitid="{{$unit->id}}"> <i class="fas fa-edit"></i> </a>  </span>

                                        <p>{{$unit->unit_name}},{{$unit->unit_code}}</p>


                                    </div>


                                </div>

                            @endforeach

                        </div>










                            {{ (!is_null($showLinks)&&$showLinks)  ? $units->links('pagination::bootstrap-4'):'' }}



                            <form action="{{route('search-units')}}"  method="get"  >
                                @csrf
                                <div class="row" >
                                    <div class="form-group col-md-6 ">
                                        <input type="text" class="form-control" name="unit_search" id="unit_search" placeholder="Unit Search " required >
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





    <div class="modal" tabindex="-1"  id="edit-unit" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل البيانات</h5>
                    <span> <a  href=""  class="edit-close"  >  <i class="fas fa-window-close"></i> </a>  </span>
                </div>
                <div class="modal-body">

                    <form action="{{route('units')}}" method="post" class="row">

                        @csrf

                        <div class="form-group col-md-6 ">
                            <label for="edit_unit_name" >Unit Name</label>
                            <input type="text" class="form-control" name="unit_name" id="edit_unit_name" placeholder="Unit Name " required >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="edit_unit_code" >Unit Code</label>
                            <input type="text" class="form-control" name="unit_code" id="edit_unit_code" placeholder="Unit Code " required >
                        </div>

                        <input type="hidden" class="form-control" name="unit_id" id="edit_unit_id"  required >
                        <input type="hidden" name="_method"  value="put" />
                        <div class="form-group col-md-12">


                            <button type="submit" class="btn btn-primary" >تعديل</button>
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
            var $deleteUnit = $('.edit-unit');
            var $deleteWindow = $('#edit-unit');
            var $edit_unit_name =$('#edit_unit_name');
            var $edit_unit_code =$('#edit_unit_code');
            var $edit_unit_id =$('#edit_unit_id');
            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                var unitId = $(this).data('unitid');
                $deleteWindow.modal('show');

                $edit_unit_name.val(unitName);
                $edit_unit_code.val(unitCode);
                $edit_unit_id.val(unitId);

            });


        });


    </script>




@endsection








