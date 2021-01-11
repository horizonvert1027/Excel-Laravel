<style>
    .loader {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999999;
        position: fixed;
        background: #222736;
        opacity: .8;
    }

    .loaderContainer {
        position: relative;
        width: 200px;
        height: 100px;
        font-size: 18px;
    }

    .spinner-border {
        display: block !important;
        margin: 10px auto;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: #c2c2c2;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #c3c3c3;
    }
</style>

@yield('css')

<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- Toastr Css -->
<link href="{{ URL::asset('/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />
