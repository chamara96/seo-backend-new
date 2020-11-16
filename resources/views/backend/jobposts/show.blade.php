@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.jobposts.index')!!}"><i class="icon-speedometer"></i> Job Dashboard</a></li>
<li class="breadcrumb-item"><a href='{!!route("backend.$module_name.index")!!}'><i class="{{ $module_icon }}"></i> {{ $module_title }}</a></li>
<li class="breadcrumb-item active"> {{ $module_action }}</li>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ ucwords($module_name) }} Management Dashboard
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <a href="{{ route("backend.$module_name.index") }}" class="btn btn-secondary mt-1 btn-sm" data-toggle="tooltip" title="{{ ucwords($module_name) }} List"><i class="fas fa-list"></i> List</a>
                    @can('edit_'.$module_name)
                    <a href="{{ route("backend.$module_name.edit", $$module_name_singular) }}" class="btn btn-primary mt-1 btn-sm" data-toggle="tooltip" title="Edit {{ Str::singular($module_name) }} "><i class="fas fa-wrench"></i> Edit</a>
                    @endcan
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col-12 col-sm-9">
                <table>
                    <tr>
                        <th>Title</th>
                        <td>{{ $$module_name_singular['jobtitle'] }}</td>
                    </tr>
                    <tr>
                        <th>Introduction</th>
                        <td>{{ $$module_name_singular['intro'] }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $$module_name_singular['city'] }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $$module_name_singular['type'] }}</td>
                    </tr>

                    <tr>
                        <th>Created at</th>
                        <td>{{ $$module_name_singular['created_at'] }}</td>
                    </tr>
                    <tr>
                        <th>Updated at</th>
                        <td>{{ $$module_name_singular['updated_at'] }}</td>
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
                        @if (isset($$module_name_singular->question_1))
                        <tr>
                            <td>{{$$module_name_singular->question_1}} </td>
                            <td>{{$$module_name_singular->answers_1}}</td>
                        </tr>
                        @endif
                        @if (isset($$module_name_singular->question_2))
                        <tr>
                            <td>{{$$module_name_singular->question_2}} </td>
                            <td>{{$$module_name_singular->answers_2}}</td>
                        </tr>
                        @endif
                        @if (isset($$module_name_singular->question_3))
                        <tr>
                            <td>{{$$module_name_singular->question_3}} </td>
                            <td>{{$$module_name_singular->answers_3}}</td>
                        </tr>
                        @endif
                        @if (isset($$module_name_singular->question_4))
                        <tr>
                            <td>{{$$module_name_singular->question_4}} </td>
                            <td>{{$$module_name_singular->answers_4}}</td>
                        </tr>
                        @endif
                        @if (isset($$module_name_singular->question_5))
                        <tr>
                            <td>{{$$module_name_singular->question_5}} </td>
                            <td>{{$$module_name_singular->answers_5}}</td>
                        </tr>
                        @endif
                        @if (isset($$module_name_singular->question_6))
                        <tr>
                            <td>{{$$module_name_singular->question_6}} </td>
                            <td>{{$$module_name_singular->answers_6}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <br>
                <h4>Content</h4>
                <hr>

                <div>
                    {!! $$module_name_singular['content'] !!}
                </div>

            </div>

            <div class="col-12 col-sm-3">
                <div class="text-center">
                    <a href="{{route("frontend.$module_name.show", [encode_id($$module_name_singular->id), ])}}" class="btn btn-success" target="_blank"><i class="fas fa-link"></i> Public View</a>
                </div>
                <hr>
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
