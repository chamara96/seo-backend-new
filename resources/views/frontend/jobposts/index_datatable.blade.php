@extends('frontend.layouts.app_job')

@section('title')
Jobs
@stop


@section('content')
{{-- <div class="page-header page-header-small">

    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset('/img/home/job-home.jpg')}}');">
    </div>
    <div class="content-center">
        <div class="container" >
            <h1 class="title">
                Job Posts
            </h1>

            <div class="text-center">
                @php $title_text = 'Test text'; @endphp
            </div>
        </div>
    </div>

</div> --}}

<div>
    <section class="gradient-1 section" style="min-height: 0vh;padding:0;">
        <div id="banner-area" class="about-banner-area" style="height: 300px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 ml-auto">
                        <div class="banner-heading wow fadeInRight">
                            <h1 class="banner-title" style="color: #2F2C2C;">Jobs</h1>
                            {{-- <ol class="breadcrumb">

                            </ol> --}}
                        </div>
                    </div>
                    <!-- Col end -->
                </div>
                <!-- Row end -->
            </div>
            <!-- Container end -->
        </div>
        <!-- Banner area end -->
    </section>
</div>

<div class="section gradient-7">

    <div class="container">

        {{-- <div class="container" > --}}
            <h1 class="title">
                Jobs
            </h1>

            <div class="text-center">
                @php $title_text = 'Test text'; @endphp
            </div>
        {{-- </div> --}}

        {{-- <div class="row">
            <div class="col-12 col-sm-12">
                <table  id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th> Job Title </th>
                            <th> City </th>
                            <th class="text-right"> Action  </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> --}}

        <table style="background: rgb(255, 255, 255);"  id="datatable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th> Job Title </th>
                    <th> City </th>
                    <th> Action  </th>
                </tr>
            </thead>
        </table>


    </div>
</div>



@endsection


@push ('after-styles')

<style>
    .section{
        padding-top: 50px !important
    }
    .gradient-7 {
        background-image: -webkit-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -moz-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -o-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -ms-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%);
        background-blend-mode: multiply;
        min-height: 100vh;
        /* color: #fff */
    }

    .gradient-1 {
         background-image: -webkit-linear-gradient(110deg, #31c8b1 10%, #4ec7ff 90%), url("/img/diamond_upholstery.png");
         background-image: -moz-linear-gradient(110deg, #31c8b1 10%, #4ec7ff 90%), url("/img/diamond_upholstery.png");
         background-image: -o-linear-gradient(110deg, #31c8b1 10%, #4ec7ff 90%), url("/img/diamond_upholstery.png");
         background-image: linear-gradient(110deg, #31c8b1 10%, #4ec7ff 90%), url("/img/diamond_upholstery.png");
         background-blend-mode: multiply;
         color: #fff;
      }

    .my_class{
        vertical-align: middle !important;
    }

    /* .about-banner-area {
        background-image: url("/img/improve_conversion_rate.webp");
    } */

</style>

@endpush


@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="text/javascript">
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        responsive: true,
        ajax: '{{ route("frontend.jobposts.index_datatable") }}',
        columns: [
            // {
            //     data: 'id',
            //     name: 'id'
            // },
            {
                data: 'jobtitle',
                name: 'jobtitle',
                className: "my_class"
            },
            {
                data: 'city',
                name: 'city',
                className: "my_class"
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
@endpush
