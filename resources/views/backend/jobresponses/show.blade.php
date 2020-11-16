@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.jobposts.index')!!}"><i class="icon-speedometer"></i> Job Dashboard</a></li>
{{-- <li class="breadcrumb-item"><a href='{!!route("backend.$module_name.index")!!}'><i class="{{ $module_icon }}"></i> {{ $module_title }}</a></li> --}}
<li class="breadcrumb-item active"> {{ $module_action }}</li>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{-- {{ ucwords($module_name) }} Management Dashboard --}}
                    {{$job_details->jobtitle}}
                </div>
            </div>

            <div class="col-4">
                @if ($btn_next)
                <div class="float-left">
                    <a style="font-size: 20px;" href="/admin/jobresponses/{{$btn_next}}?type={{$show_type}}"  data-toggle="tooltip" title="Prev Candidate"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>
                </div>
                @endif

                @if ($btn_prev)
                <div class="float-right">
                    <a style="font-size: 20px;" href="/admin/jobresponses/{{$btn_prev}}?type={{$show_type}}"  data-toggle="tooltip" title="Next Candidate"><i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                </div>
                @endif

            </div>


            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <a href="{{ session()->get('last_url') }}" class="btn btn-secondary mt-1 btn-sm" data-toggle="tooltip" title="{{ ucwords($module_name) }} List"><i class="fas fa-list"></i> Back</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col-12 col-sm-9">

                <div>



                    <table>
                        <tr>
                            <th>Candidate's Name -</th>
                            <td>{{ $$module_name_singular['users_firstname'] }}</td>
                        </tr>
                        <tr>
                            <th>Candidate's Phono No -</th>
                            <td>{{ $$module_name_singular['users_telephone'] }}</td>
                        </tr>
                        <tr>
                            <th>Candidate's Email - </th>
                            <td>{{ $$module_name_singular['users_email'] }}</td>
                        </tr>
                        <tr>
                            <th>CV Link</th>
                            <td><a target="_blank" href="/{{$$module_name_singular['users_cv'] }}">Download CV</a></td>
                        </tr>

                        @if ($$module_name_singular['status']!=0)
                        <tr>
                            <th>Reviewd by -</th>
                            <td>{{ $$module_name_singular['reviewed_by_name'] }}</td>
                        </tr>
                        @endif

                        <tr>
                            <th>Current Status -</th>
                            <td>
                                @if ($$module_name_singular['status']==0)
                                Active
                                @elseif ($$module_name_singular['status']==1)
                                Awating
                                @elseif ($$module_name_singular['status']==2)
                                Reviewed
                                @elseif ($$module_name_singular['status']==3)
                                Rejected
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th>Applied Date-</th>
                            @php
                            use Carbon\Carbon;
                            $diff = Carbon::now()->diffInHours($$module_name_singular->created_at);

                            if ($diff < 25) {
                                $applied_date= $$module_name_singular->created_at->diffForHumans();
                                } else {
                                $applied_date= $$module_name_singular->created_at->toCookieString();
                                }
                            @endphp
                                <td>{{ $applied_date }}</td>
                        </tr>

                    </table>

                    <br>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th> Question </th>
                                <th>Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($job_details->question_1))
                            <tr>
                                <td>{{$job_details->question_1}} </td>
                                <td>{{$$module_name_singular->answer_1}}</td>
                            </tr>
                            @endif
                            @if (isset($job_details->question_2))
                            <tr>
                                <td>{{$job_details->question_2}} </td>
                                <td>{{$$module_name_singular->answer_2}}</td>
                            </tr>
                            @endif
                            @if (isset($job_details->question_3))
                            <tr>
                                <td>{{$job_details->question_3}} </td>
                                <td>{{$$module_name_singular->answer_3}}</td>
                            </tr>
                            @endif
                            @if (isset($job_details->question_4))
                            <tr>
                                <td>{{$job_details->question_4}} </td>
                                <td>{{$$module_name_singular->answer_4}}</td>
                            </tr>
                            @endif
                            @if (isset($job_details->question_5))
                            <tr>
                                <td>{{$job_details->question_5}} </td>
                                <td>{{$$module_name_singular->answer_5}}</td>
                            </tr>
                            @endif
                            @if (isset($job_details->question_6))
                            <tr>
                                <td>{{$job_details->question_6}} </td>
                                <td>{{$$module_name_singular->answer_6}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    @if ($cv_ext=='pdf')
                    <object data="/{{$$module_name_singular['users_cv'] }}" type="application/pdf" width="100%" height="700px">
                        <p>Please download the word file <a href="/{{$$module_name_singular['users_cv'] }}"> here</a></p>
                    </object>
                    @endif


                </div>

            </div>
            <div class="col-12 col-sm-3">

                @if ($$module_name_singular['status']==0)

                {{ Form::open(['route' => ['backend.jobresponses.set_await']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button style="displ" type="submit" class="btn btn-warning">
                    <i class="fa fa-check"></i> Shortlisted
                </button>
                {{ Form::close() }}

                <hr>

                {{ Form::open(['route' => ['backend.jobresponses.set_reviewed']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Review Later
                </button>
                {{ Form::close() }}

                <hr>

                {{ Form::open(['route' => ['backend.jobresponses.set_reject']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-check"></i> Rejected
                </button>
                {{ Form::close() }}

                @elseif ($$module_name_singular['status']==1)


                {{ Form::open(['route' => ['backend.jobresponses.set_reviewed']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Review Later
                </button>
                {{ Form::close() }}

                <hr>

                {{ Form::open(['route' => ['backend.jobresponses.set_reject']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-check"></i> Rejected
                </button>
                {{ Form::close() }}

                @elseif ($$module_name_singular['status']==2)

                {{ Form::open(['route' => ['backend.jobresponses.set_await']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button style="displ" type="submit" class="btn btn-warning">
                    <i class="fa fa-check"></i> Shortlisted
                </button>
                {{ Form::close() }}

                <hr>

                {{ Form::open(['route' => ['backend.jobresponses.set_reject']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-check"></i> Rejected
                </button>
                {{ Form::close() }}

                @else
                Application is Rejected by {{$$module_name_singular['reviewed_by_name']}}
                {{ Form::open(['route' => ['backend.jobresponses.set_reviewed']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Review Later
                </button>
                {{ Form::close() }}

                <hr>

                {{ Form::open(['route' => ['backend.jobresponses.set_await']]) }}
                <input type="hidden" value="{{ $$module_name_singular['id'] }}" name="job_response_id">
                <button style="displ" type="submit" class="btn btn-warning">
                    <i class="fa fa-check"></i> Shortlisted
                </button>
                {{ Form::close() }}

                @endif




                <!-- <div class="text-center">
                    <a href="#" class="btn btn-success" target="_blank"><i class="fas fa-link"></i> Under Review</a>
                </div>
                <hr>
                <div class="text-center">
                    <a href="#" class="btn btn-success" target="_blank"><i class="fas fa-link"></i> Reject</a>
                </div>
                <hr>
                <div class="text-center">
                    <a href="#" class="btn btn-success" target="_blank"><i class="fas fa-link"></i> Accept</a>
                </div>
                <hr> -->

            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->toCookieString()}}
                </small>
            </div>
        </div>
    </div>
</div>

@stop
