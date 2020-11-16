@extends('frontend.layouts.app_blog')

@section('title')
Posts
@stop


@section('content')
{{-- <div class="page-header page-header-small"> --}}
<div>

    <section class="gradient-1 section" style="min-height: 0vh;padding:0;">
        <div id="banner-area" class="about-banner-area" style="height: 300px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 ml-auto">
                        <div class="banner-heading wow fadeInRight">
                            <h1 class="banner-title" style="color: #2F2C2C;">Blogs</h1>
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
    {{-- <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset('/img/home/blog-home.jpg')}}');">
    </div> --}}

    {{-- <div class="content-center">
        <div class="container">
            <h1 class="title">
                Posts
            </h1>

            <div class="text-center">
                @php $title_text = ''; @endphp

            </div>
        </div>
    </div> --}}

</div>

<div class="section gradient-7">
    <div class="container">
        <div class="row">
            @foreach ($$module_name as $$module_name_singular)
            <div style="padding-bottom:30px" class="col-12 col-sm-4">
                {{-- <div class="card">
                    @php
                    $post_details_url = route("frontend.$module_name.show",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
                    @endphp
                    <a href="{{$post_details_url}}">
                        <img class="card-img-top" src="/{{$$module_name_singular->featured_image}}" alt="{{$$module_name_singular->name}}">
                    </a>
                    <div class="card-body">
                        <a href="{{$post_details_url}}">
                            <h4 class="card-title">{{$$module_name_singular->name}}</h4>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {!!isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : '<a href="'.route('frontend.users.profile', $$module_name_singular->created_by).'">'.$$module_name_singular->created_by_name.'</a>'!!}
                        </h6>
                        <hr>
                        <p class="card-text">
                            {{$$module_name_singular->intro}}
                        </p>
                        <hr>

                        <p class="card-text">
                            <a href="{{route('frontend.categories.show', [encode_id($$module_name_singular->category_id), $$module_name_singular->category->slug])}}" class="badge badge-primary">{{$$module_name_singular->category_name}}</a>
                        </p>



                        <p class="card-text">
                            <div class="row">
                                <div class="col">
                                    <div class="float-right">
                                        <a href="{{$post_details_url}}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-right"></i> Continue Reading</a>
                                    </div>
                                </div>
                            </div>
                        </p>

                        <p class="card-text">
                            <small class="text-muted">{{$$module_name_singular->published_at_formatted}}</small>
                        </p>
                    </div>
                </div> --}}

                {{-- ========================== --}}
                <div class="post item">

                    @php
                    if ($current_view=='user') {
                        $post_details_url = route("frontend.$module_name.show_user",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
                    }
                    elseif ($current_view=='merchant') {
                        $post_details_url = route("frontend.$module_name.show_merchant",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
                    }

                    @endphp

                    <div class="post-img"> <img class="img-responsive" src="/{{$$module_name_singular->featured_image}}" alt="{{$$module_name_singular->name}}" /> </div>

                    <div class="post-info" style="margin-left:0;text-align: center;">
                      <h3><b><a href="{{$post_details_url}}">{{$$module_name_singular->name}}</a></b></h3>
                      <h6>{{$$module_name_singular->published_at_formatted}}</h6>
                      <div style="height:185px; overflow: hidden">
                        <p>{{$$module_name_singular->intro}}</p>
                      </div>
                    </div>

                    <div style="background:#212121; padding-bottom:30px;text-align: center;">
                       <a class="readmore" href="{{$post_details_url}}"><span>Read More</span></a>
                    </div>
                </div>
                {{-- ========================== --}}



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

    /* .about-banner-area {
        background-image: url("/img/improve_conversion_rate.webp");
    } */

    /* ===================== */

    /* ===================== */

</style>

@endpush
