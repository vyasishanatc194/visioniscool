@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">City </h4>
                            <div class="d-flex justify-content-end ">
                                <a href="#" data-state_id="" data-city="" data-id="0" class="btn btn-outline-primary round mr-1 mb-1 form-for-city ">Add City</a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="city-table" width="100%" class="table table-striped table-bordered datatable responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>City</th>
                                                            <th>State</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@push('modal')
<div class="modal fade text-left" id="city_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form_model">Basic Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ft-x font-medium-2 text-bold-700"></i></span>
                </button>
            </div>
            
                <input class="form-control" id="city_id" name="city_id" type="hidden" value="0">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="name" class="">State</label>
                            <div class="form-group position-relative">
                                <select name="state_id" id="state_id">
                                    @foreach ($state as $item)
                                        <option value="{{$item->id}}">{{$item->state_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="name" class="">City name</label>
                            <div class="form-group position-relative">
                                <input type="text" name="city" class="filter form-control" id="city_name"
                                    style="" autocomplete='off'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="form_submit_error text-error"></p>
                    <button type="button" class="btn btn-primary" style="float: none;" data-dismiss="modal"
                        aria-hidden="true">Cancel</button>
                    <input class="btn btn-light" type="button" id="submit" value="Submit">
                </div>
            


        </div>
    </div>
</div>
@endpush
@push('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/vendors/css/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="{{ asset('app-assets/vendors/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var url ="{{ url('/admin/city-data') }}";
        var edit_url = "{{ url('/admin/city') }}";
        var auth_check = "{{ Auth::check() }}";
        
        datatable = $('#city-table').DataTable({
            dom: 
                "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'row be-datatable-body'<'col-sm-12'tr>>" +
                "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
            processing: true,
            serverSide: true,
            "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
            "caseInsensitive": false,
            "order": [[0,"desc"]],
            "pageLength": 25,
            "scrollY": 480, "scrollX": true,
            ajax: {
                url:url,
                type:"get",
            },
            "drawCallback": function( settings ) {
                
            },
            columns: [
                { data: 'id',name : 'id',"searchable": false, "orderable": true},
                { data: 'city_name',name : 'city_name',"searchable": true, "orderable": true},
                { data: 'state_name',name : 'state_name',"searchable": true, "orderable": true},
                {
                    "data": null,
                    "searchable": false,
                    "orderable": false,
                    "width":150,
                    "render": function (o) {
                        var e=""; 
                        e = "<a herf='#' data-state_id="+o.state_id+" data-id='"+o.id+"' data-city='"+o.city_name+"' class='btn btn-info btn-sm form-for-city'><i class='fa fa-pencil action_icon'></i></a>&nbsp;";
                        return e;
                    }

                }
            ]
        });

        $(document).on('click', '.form-for-city', function (e) {
            var id=$(this).attr('data-id');
            $("#city_id").val(id);
            $("#state_id").val($(this).attr('data-state_id'));
            //$("#state_id option[value="+ $(this).attr('data-state_id') +"]").attr('selected', 'selected');
            $("#city_name").val($(this).attr('data-city'));
            if(id!=0){
                $("#title_form_model").html("Edit State");
                
            }else{
                $("#title_form_model").html("Add State");
            }
            
            $("#city_modal").modal('show');
            return false;
        });

        // $('#form_state').submit(function(event) {
        $('#submit').click(function(e){
            e.preventDefault();
            //event.preventDefault();
            var error_msg = "";
            if(error_msg!=""){
                $(".form_submit_error").html(error_msg).show().delay(5000).fadeOut();
                return false;
            }
        
            var formData = {
                city_id : $("#city_id").val(),
                state_id : $("#state_id").val(),
                city_name : $("#city_name").val()
                
            };
            var url = "{{url('admin/city')}}";
            var method = "POST";
            
            if($("#city_id").val()!="" && $("#city_id").val()!=0){
                url = "{{url('admin/city')}}/"+$("#city_id").val();
                method = "PUT";
            }
            $.ajax({
                type: method,
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#city_modal").modal('hide');
                    toastr.success('Action Success!', data.message);
                    datatable.draw(false);
                },
                error: function (xhr, status, error) {
                    var erro = ajaxError(xhr, status, error);
                    toastr.error('Action Not Proceed!',erro)
                }
            });
            
            return false;
        });
    });

</script>

@endpush