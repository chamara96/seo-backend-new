@extends('frontend.layouts.app_job')

@section('title')
Job Posts
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

<div class="section gradient-7">
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <td>Job Title</td>
                    <td>City</td>
                    <td>Apply</td>
                </thead>
                <tbody>
                    <tr>
                        <td>AA</td>
                        <td>AA</td>
                        <td>Apply</td>
                    </tr>
                    <tr>
                        <td>AA</td>
                        <td>AA</td>
                        <td>Apply</td>
                    </tr>
                    <tr>
                        <td>AA</td>
                        <td>AA</td>
                        <td>Apply</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            @foreach ($$module_name as $$module_name_singular)
            <div class="col-12 col-sm-6">
                <div class="card">
                    @php
                    $post_details_url = route("frontend.$module_name.show",[encode_id($$module_name_singular->id)]);
                    @endphp
                    <div class="card-body">
                        <a href="{{$post_details_url}}">
                            <h4 class="card-title">{{$$module_name_singular->jobtitle}}</h4>
                        </a>
                        <h6>
                            {{$$module_name_singular->city}}
                        </h6>

                        <p class="card-text">
                            <div class="row">
                                <div class="col">
                                    <div class="float-right">
                                        <a href="{{$post_details_url}}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-right"></i> Apply</a>
                                    </div>
                                </div>
                            </div>
                        </p>

                        <p class="card-text">
                            <small class="text-muted">{{$$module_name_singular->created_at}}</small>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                {{$$module_name->links()}}
            </div>
        </div>
    </div>
</div>



@endsection


@push ('after-styles')

<style>
    .gradient-7 {
        background-image: -webkit-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -moz-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -o-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: linear-gradient(110deg, #42d3d8 10%, #3c69da 90%), url("/img/diamond_upholstery.png");
        background-image: -ms-linear-gradient(110deg, #42d3d8 10%, #3c69da 90%);
        background-blend-mode: multiply;
        /* color: #fff */
    }

</style>

@endpush
