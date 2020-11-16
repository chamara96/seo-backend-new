@extends('frontend.layouts.app_blog')

@section('title')
{{$$module_name_singular->name}}
@stop


@section('content')
<div>
    <section class="page-header page-header-small gradient-7" style="min-height: 0vh;padding:0;">
        <div id="banner-area" class="about-banner-area">
            <div class="container">
                <div class="page-header2 page-header-small2">
                    <div class="content-center">
                        <div class="container">
                            <h1 class="title2">
                                {{$$module_name_singular->name}}
                                <br>
                                <small>{{isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name}}</small>
                            </h1>
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

{{-- <div class="page-header page-header-small">

    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset($$module_name_singular->featured_image)}}');">
    </div>
    <div class="content-center">
        <div class="container">
            <h1 class="title">
                {{$$module_name_singular->name}}
                <br>
                <small>{{isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name}}</small>
            </h1>

            @include('flash::message')

            <!-- Errors block -->
            @include('frontend.includes.errors')
            <!-- / Errors block -->


        </div>
    </div>
</div> --}}


<div class="section gradient-7">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    @php
                    $post_details_url = route('frontend.posts.show_user',[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
                    @endphp
                    <img class="card-img-top" src="/{{$$module_name_singular->featured_image}}" alt="{{$$module_name_singular->name}}">
                    <div class="card-body">
                        <a href="{{$post_details_url}}">
                            <h4 class="card-title">{{$$module_name_singular->name}}</h4>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {!!isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : '<a href="#">'.$$module_name_singular->created_by_name.'</a>'!!}
                        </h6>
                        <hr>
                        <p class="card-text">
                            {!!$$module_name_singular->content!!}
                        </p>
                        <hr>

                        <p class="card-text">
                            <a href="#" class="badge badge-primary">{{$$module_name_singular->category_name}}</a>
                        </p>

                        {{-- <p class="card-text">
                            @foreach ($$module_name_singular->tags as $tag)
                            <a href="{{route('frontend.tags.show', [encode_id($tag->id), $tag->slug])}}" class="badge badge-warning">{{$tag->name}}</a>
                            @endforeach
                        </p> --}}





                        <p class="card-text">
                            <small class="text-muted">{{$$module_name_singular->published_at_formatted}}</small>
                        </p>
                    </div>
                </div>
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


      /* ================================== */
      .page-header2 {
  min-height: 100vh;
  max-height: 999px;
  padding: 0;
  color: #FFFFFF;
  position: relative;
  overflow: hidden;
}

.page-header2>.content {
  margin-top: 12%;
  text-align: center;
  margin-bottom: 50px;
}

.page-header2.page-header-small2 {
  min-height: 60vh;
  max-height: 440px;
}

/* .page-header2:before {
  background-color: rgba(0, 0, 0, 0.3);
} */

.page-header2>.container {
  z-index: 2;
  padding-top: 12vh;
  padding-bottom: 40px;
}

.page-header2 .page-header-image {
  position: absolute;
  background-size: cover;
  background-position: center center;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.page-header2 .content-center {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 2;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  color: #FFFFFF;
  padding: 0 15px;
  width: 100%;
  max-width: 880px;
}

.page-header2 footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}

.page-header2 .container {
  height: 100%;
  z-index: 1;
  text-align: center;
  position: relative;
}

.page-header2 .category,
.page-header2 .description {
  color: rgba(255, 255, 255, 0.8);
}

.page-header2:after,
.page-header2:before {
  position: absolute;
  z-index: 0;
  width: 100%;
  height: 100%;
  display: block;
  left: 0;
  top: 0;
  content: "";
}

.title2 {
  font-weight: 700;
}

@media screen and (max-width: 748px) {
  #banner-area{
      height: auto;
  }
}

@media screen and (min-width: 748px) {
  #banner-area{
      height: 300px;
  }
}

</style>

@endpush
