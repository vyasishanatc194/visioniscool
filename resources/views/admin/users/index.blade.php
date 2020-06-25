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
                            <h4 class="card-title">Accountants List</h4>
                            <div class="d-flex justify-content-end ">
                                <a href="{{route('users.create')}}" class="btn btn-outline-primary round mr-1 mb-1 ">Add Accountant</a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered datatable responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
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

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@push('js')
    <script src="{{ asset('app-assets/vendors/js/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var url = "{{url('admin/users')}}";
            var auth_uid = {{\Auth::user()->id}};
            datatable = $('.datatable').dataTable({
                pagingType: "full_numbers",
                "scrollX": false,
                processing: true,
                serverSide: true,
                autoWidth: false,
                stateSave: false,
                order: [0, "DESC"],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: 4 }
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                
                columns: [
                    { "data": "id","name":"id","searchable": false,"width":"8%"},
                    { "data": "first_name","name":"first_name","searchable": true},
                    { "data": "last_name","name":"last_name","searchable": true},
                    { "data": "email","name":"email","searchable": true},
                    { "data": "phone","name":"phone","searchable": false},
                    { "data": "status","name":"status","searchable": false},
                    { 
                        "data" : null,
                        "searchable" :false, 
                        "orderable" : false, 
                        "width" : "4%" , 
                        "render" :  function (o) { 
                            var e="" ; var d="" ; var v="" ; var l="" ;
                            if(auth_uid !=o.id && o.id !=1){
                                e=" <a href='" +url+"/"+o.id+"/edit' class='btn btn-warning btn-sm'data-id="+o.id+" title='@lang(' tooltip.common.icon.edit')'><i class='fa fa-pencil action_icon'></i></a>";
                                d = " <a href='javascript:void(0);' class='del-item btn btn-danger btn-sm' data-id="+o.id+" title='@lang('tooltip.common.icon.delete')'><i class='fa fa-trash action_icon '></i></a>";
                            }   
                             var v = "";//" <a href='"+url+"/"+o.id+"' class='btn btn-info btn-sm' data-id="+o.id+" title='@lang('tooltip.common.icon.eye')'><i class='fa fa-eye' aria-hidden='true'></i></a>";
                            return v+d+e;
        
                         }
                    }
                ],
                fnRowCallback: function (nRow, aData, iDisplayIndex) {
                $('td', nRow).attr('nowrap', 'nowrap');
                return nRow;
                },
                ajax: {
                    url: "{{ url('admin/users/datatable') }}", // json datasource
                    type: "get", // method , by default get
                    data: function (d) {
                
                    }
                }
            });
        
            $(document).on('click', '.del-item', function (e) {
                var id = $(this).attr('data-id');
                var r = confirm("@lang('common.js_msg.confirm_for_delete_data')");
                if (r == true) {
                    $.ajax({
                        type: "DELETE",
                        url: url + "/" + id,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            datatable.fnDraw();
                            toastr.success("@lang('common.js_msg.action_success')", data.message)
                        },
                        error: function (xhr, status, error) {
                            var erro = ajaxError(xhr, status, error);
                            toastr.error("@lang('common.js_msg.action_not_Proceed')",erro)
                        }
                    });
                }
            });
        });
    </script>
@endpush