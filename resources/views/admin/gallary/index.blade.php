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
                            <h4 class="card-title">Gallery</h4>
                            <div class="d-flex justify-content-end ">
                                <a href="{{route('gallary.create')}}" class="btn btn-outline-primary round mr-1 mb-1 ">Add Image</a>
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
                                                            <th>Image</th>
                                                            <th>City/State</th>
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
<style>
    .table-responsive{
        overflow-x:hidden !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/datatables/dataTables.bootstrap4.min.css')}}">
@endpush

@push('js')
    <script src="{{ asset('app-assets/vendors/js/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var url = "{{url('admin/gallary')}}";
            var auth_uid = {{\Auth::user()->id}};
            datatable = $('.datatable').dataTable({
                pagingType: "full_numbers",
                "scrollX": false,
                processing: true,
                serverSide: true,
                autoWidth: false,
                searching: false,
                stateSave: false,
                order: [0, "DESC"],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                
                columns: [
                    { "data": "id","name":"id","searchable": false,"width":"8%"},
                    { 
                        "data": null,
                        "searchable" :false,
                        "orderable" : false,
                        "render" : function (o){
                            if(o.get_all_ref_file != null){
                                if(o.get_all_ref_file[0].file_url != ''){
                                    return '<img src="'+o.get_all_ref_file[0].file_url+'" width="100px" height="auto" />'
                                }
                                else if(o.get_all_ref_file.length == 2){
                                    return '<img src="'+o.get_all_ref_file[1].file_url+'" width="100px" height="auto" />'
                                }
                                
                            }
                            return null
                            
                        }

                    },
                    {
                        "data" : null,
                        "searchable" :false,
                        "orderable" : false,
                        "width" : "4%" ,
                        "render" : function (o) {
                            return o.get_city.city_name+'/'+o.get_city.state_name;
                        
                        }
                    },
                    { 
                        "data" : null,
                        "searchable" :false, 
                        "orderable" : false, 
                        "width" : "4%" , 
                        "render" :  function (o) { 
                            var d = " <a href='javascript:void(0);' class='del-item btn btn-danger btn-sm' data-id="+o.id+" title='@lang('tooltip.common.icon.delete')'><i class='fa fa-trash action_icon '></i></a>"; 
                            return d;
        
                         }
                    }
                ],
                fnRowCallback: function (nRow, aData, iDisplayIndex) {
                $('td', nRow).attr('nowrap', 'nowrap');
                return nRow;
                },
                ajax: {
                    url: "{{ url('admin/gallary/datatable') }}", // json datasource
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