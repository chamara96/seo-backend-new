@extends('frontend.layouts.app_job')

@section('title')
{{$$module_name_singular->jobtitle}}
@stop


@section('content')
<div class="page-header page-header-small gradient-7" >

    <div class="page-header-image" data-parallax="true">
    </div>
    <div class="content-center">
        <div class="container">
            <h1 class="title">
                {{$$module_name_singular->jobtitle}}
                {{-- <br> --}}
                {{-- <small>{{isset($$module_name_singular->created_by_alias)? $$module_name_singular->created_by_alias : $$module_name_singular->created_by_name}}</small> --}}
            </h1>

            @include('flash::message')

            <!-- Errors block -->
            @include('frontend.includes.errors')
            <!-- / Errors block -->

        </div>
    </div>
</div>


<div class="section gradient-7">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    @php
                    $post_details_url = route('frontend.jobposts.show',[encode_id($$module_name_singular->id)]);
                    @endphp
                    <img class="card-img-top" src="{{$$module_name_singular->featured_image}}" alt="{{$$module_name_singular->name}}">
                    <div class="card-body">
                        <a href="{{$post_details_url}}">
                            <h4 class="card-title">{{$$module_name_singular->jobtitle}}</h4>
                        </a>
                        <p class="card-text">
                            <a href="#" class="badge badge-primary">{{$$module_name_singular->type}}</a>
                        </p>

                        <hr>
                        <p class="card-text">
                            {!!$$module_name_singular->content!!}
                        </p>
                        <hr>



                        <!-- <p class="card-text">
                            <div class="row">
                                <div class="col">
                                    <div class="text-center">


                                    </div>
                                </div>
                            </div>
                        </p> -->



                        <p class="card-text">
                            <small class="text-muted">{{$$module_name_singular->created_at}}</small>
                        </p>

                        <form action="{{ route('frontend.jobposts.uploadcv') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{$$module_name_singular->id}}" name="job_id">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Full Name</label>
                                <div class="col-sm-9">
                                    {!! Form::text('users_firstname', null,array('class' => 'form-control','placeholder'=>'Your Full name' )) !!}
                                    {{-- <input name="users_firstname" type="text" class="form-control" placeholder="Your Full name"> --}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    {!! Form::text('users_email', null,array('class' => 'form-control','placeholder'=>'Your Email Address','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$', 'oninvalid'=>"setCustomValidity('Please enter a valid email')",  'onchange'=>"try{setCustomValidity('')}catch(e){}",'oninput'=>"this.setCustomValidity(' ')" )) !!}
                                    {{-- 'oninvalid'=>"this.setCustomValidity('Please enter a valid email')",  'oninput'=>"this.setCustomValidity('')",'id'=>'candidate_email_val' --}}
                                    {{-- <input name="users_email" type="email" class="form-control" placeholder="Your Email Address"> --}}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    {!! Form::number('users_telephone', null,array('class' => 'form-control','placeholder'=>'Your Phone No' )) !!}
                                    {{-- <input name="users_telephone" type="text" class="form-control" placeholder="Your Telephone No"> --}}
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Your CV</label>
                                <div class="col-sm-9">
                                    {!! Form::file('file', null,array('class' => 'form-control' )) !!}
                                    {{-- <input type="file" name="file" class="form-control"> --}}
                                    <span style="margin-left: 15px; width: 480px;" class="custom-file-control"></span>
                                </div>
                            </div>

                            <hr>

                            @if (isset($$module_name_singular->question_1))
                            <p>Please answer the following questions.</p>

                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">1. {{$$module_name_singular->question_1}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_1',$q1_ans,null, array('style' => 'width:100%' )) !!}
                                    {{-- <select name="answer_1">
                                        @foreach($q1_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif


                            @if (isset($$module_name_singular->question_2))
                            <hr>
                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">2. {{$$module_name_singular->question_2}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_2',$q2_ans ,null, array('style' => 'width:100%' )) !!}
                                    {{-- <select name="answer_2">
                                        @foreach($q2_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif



                            @if (isset($$module_name_singular->question_3))
                            <hr>
                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">3. {{$$module_name_singular->question_3}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_3',$q3_ans,null, array('style' => 'width:100%' ) ) !!}
                                    {{-- <select name="answer_3">
                                        @foreach($q3_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif



                            @if (isset($$module_name_singular->question_4))
                            <hr>
                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">4. {{$$module_name_singular->question_4}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_4',$q4_ans,null, array('style' => 'width:100%' ) ) !!}
                                    {{-- <select name="answer_4">
                                        @foreach($q4_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif



                            @if (isset($$module_name_singular->question_5))
                            <hr>
                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">5. {{$$module_name_singular->question_5}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_5',$q5_ans,null, array('style' => 'width:100%' ) ) !!}
                                    {{-- <select name="answer_5">
                                        @foreach($q5_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif



                            @if (isset($$module_name_singular->question_6))
                            <hr>
                            <div class="form-group row">
                                <label style="padding-left: 50px;" class="col-sm-8 col-form-label">6. {{$$module_name_singular->question_6}}</label>
                                <div class="col-sm-4">

                                    {!! Form::select('answer_6',$q6_ans,null, array('style' => 'width:100%' ) ) !!}
                                    {{-- <select name="answer_6">
                                        @foreach($q6_ans as $ans )
                                        <option value="{{ $ans }}">{{ $ans }}</option>
                                        @endforeach
                                    </select> --}}

                                </div>
                            </div>
                            @endif


                            <div class="form-group row">
                                <div class="offset-sm-9 col-sm-3">
                                    {!! Form::submit('Submit',array('class' => 'btn btn-primary' )) !!}
                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
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
