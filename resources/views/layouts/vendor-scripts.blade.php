<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<!-- toastr plugin -->
<script src="{{ URL::asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
<!-- toastr init -->
<script src="{{ URL::asset('assets/js/pages/toastr.init.js') }}"></script>

@yield('script')

<!-- App js -->
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>


<script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": 300,
      "hideDuration": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000,
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    function showSpinner() {
        $("#loader").removeClass("d-none");
    }

    function hideSpinner() {
        $("#loader").addClass("d-none");
    }
    const public = "{{ URL::asset('/') }}";
    const BaseUrl = "{{ url('/') }}";
    
</script>


@yield('script-bottom')
