<!-- BEGIN VENDOR JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/switchery.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN APEX JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/notification-sidebar.js') }}"></script>
<script src="{{ asset('app-assets/js/customizer.js') }}"></script>
<script src="{{ asset('app-assets/js/scroll-top.js') }}"></script>
<!-- END APEX JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
<!-- BEGIN: Custom CSS-->
<script src="{!! asset('app-assets/js/toastr.js')!!}"></script>
{{-- <script src="{{ asset('assets/js/scripts.js') }}"></script> --}}
<script src="{{ asset('app-assets/js/components-toast.js') }}"></script>
<!-- END: Custom CSS-->
@include('includes.page_notification')
@stack('js')