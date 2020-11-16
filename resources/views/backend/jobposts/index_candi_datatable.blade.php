@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.jobposts.index')!!}"><i class="icon-speedometer"></i>Job Dashboard</a></li>
<li class="breadcrumb-item active"><i class="{{ $module_icon }}"></i> {{ $module_title }}</li>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{$question_list->jobtitle}} {{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ Str::title($module_name) }} Management Dashboard
                </div>
            </div>

        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <table id="datatable" style="width: 100%;" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Phone No </th>
                            <th>Email </th>
                            <th>Applied on </th>
                            <th class="text-right"> Action </th>
                            <th>{{$question_list->question_1}} </th>
                            <th>{{$question_list->question_2}} </th>
                            <th>{{$question_list->question_3}} </th>
                            <th>{{$question_list->question_4}} </th>
                            <th>{{$question_list->question_5}} </th>
                            <th>{{$question_list->question_6}} </th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

{{-- https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css --}}

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">



@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

{{-- https://code.jquery.com/jquery-3.5.1.js --}}
{{-- https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js --}}


<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

<script type="text/javascript">
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,


        //         dom: 'Bfrtip',
        //   buttons: [{
        //     extend: 'pdfHtml5',
        //     exportOptions : {
        //       rows : {search:'applied'}
        //     }
        //   }],
        // columnDefs: [{
        //     orderable: false,
        //     className: 'select-checkbox',
        //     targets: 0
        // }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },

        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                title: '{{$question_list->jobtitle}} Candidates - {{$export_name}}',
                footer: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5,7,8,9,10,11,12]
                },
            },

            {
                extend: 'pdf',
                title: '{{$question_list->jobtitle}} Candidates - {{$export_name}}',
                footer: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5,7,8,9,10,11,12]
                },
            },

        ],

        responsive: true,
        ajax: '{{ route("backend.$module_name.$canditype", $jpid) }}',
        columns: [{
                "defaultContent": '',
                orderable: false,
                searchable: false,
                className: 'select-checkbox'
            },

            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'users_firstname',
                name: 'users_firstname'
            },
            {
                data: 'users_telephone',
                name: 'users_telephone'
            },
            {
                data: 'users_email',
                name: 'users_email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

            {
                data: 'answer_1',
                name: 'answer_1',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },
            {
                data: 'answer_2',
                name: 'answer_2',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },
            {
                data: 'answer_3',
                name: 'answer_3',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },
            {
                data: 'answer_4',
                name: 'answer_4',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },
            {
                data: 'answer_5',
                name: 'answer_5',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },
            {
                data: 'answer_6',
                name: 'answer_6',
                "defaultContent": "",
                orderable: false,
                searchable: false
            },

        ],
        order: [[ 5, 'dsc' ]],

        "columnDefs": [

            {
                "targets": [ 7,8,9,10,11,12 ],
                "visible": false
            }
        ]

    });
</script>
@endpush
