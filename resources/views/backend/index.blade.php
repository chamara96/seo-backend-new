@extends('backend.layouts.app')

@section ('title', 'Dashboard' . " - " . config('app.name'))

@section('breadcrumbs')
<li class="breadcrumb-item active"><i class="icon-speedometer"></i> Dashboard</li>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title mb-0">{{ Auth::user()->name }}, Welcome to {{ config('app.name') }} Dashboard.</h4>
                <div class="small text-muted">{{ date('D, F d, Y') }}</div>
            </div>

            {{-- <div class="col-sm-4 hidden-sm-down">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <button type="button" class="btn btn-primary float-right">
                        <i class="icon-cloud-download"></i>
                    </button>
                </div>
            </div> --}}

        </div>


        <hr>

        <div class="row">
            <div class="col-sm-8">
                <a href='{{ route("frontend.posts.index_user") }}' target="_blank" class="btn btn-success" data-toggle="tooltip" title="Blog Home Page"><i class="fa fa-clipboard"></i> Blog Home - User</a>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-8">
                <a href='{{ route("frontend.posts.index_merchant") }}' target="_blank" class="btn btn-success" data-toggle="tooltip" title="Blog Home Page"><i class="fa fa-clipboard"></i> Blog Home - merchant</a>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-8">
                <a href='{{ route("frontend.jobposts.index") }}' target="_blank" class="btn btn-success" data-toggle="tooltip" title="Job Home Page"><i class="fa fa-suitcase"></i> Job Home</a>
            </div>
        </div>

        <hr>

    </div>

</div>
<!-- / card -->

@endsection
