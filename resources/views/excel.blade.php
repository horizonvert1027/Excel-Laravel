@extends('layouts.master')

@section('title')
    Excel
@endsection

@section('css')
    <!-- Lightbox css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Excel Management
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Select Importing Excel File </h4>
                    @if (session()->get('success'))
                        <div class="alert alert-danger alert-dismissible mt-4 fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="input-group my-4">
                                <input type="file" name="file" class="form-control" id="customFile">
                                <button class="btn btn-primary waves-effect waves-light">Import Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table align-middle dt-responsive  nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Planned_start</th>
                                <th>Planned_end</th>
                                <th>Actual_start</th>
                                <th>Actual_end</th>
                                <th>Percent_complete</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Image Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Select Image File </h4>
                            <form action="javascript:void(0)" method="POST" id="image-upload"
                                enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <div class="input-group my-4">
                                        <input type="file" name="image" placeholder="Choose Images" id="image"
                                            class="form-control">
                                        <button type="submit" id="submit"
                                            class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-upload"></i>
                                            Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <section class="game-section">
                                <h2 class="text-center">Upload Images</h2>
                                <div class="empty"></div>
                                <!-- Carousel -->
                                <div id="demo" class="carousel slide my-3" data-bs-ride="carousel">
                                    <!-- The slideshow/carousel -->
                                    <div class="carousel-inner">
                                    </div>
                                    <!-- Left and right controls/icons -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#demo"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#demo"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

    <script>
        const token = "{{ csrf_token() }}";
    </script>
@endsection
