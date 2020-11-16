@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.dashboard')!!}"><i class="icon-speedometer"></i> Dashboard</a></li>
<li class="breadcrumb-item active"><i class="{{ $module_icon }}"></i> {{ $module_title }}</li>
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
                    {{ ucwords($module_name) }} Management Dashboard
                </div>

            </div>
            <!--/.col-->
            <div class="col-8">

                <div class="float-left">
                    <a href="javascript:void(0);" class="reorder_link btn btn-info m-1 btn-sm" id="saveReorder"><i class="fa fa-play"></i> Re Arrange</a>
                    <a href="{{ route("backend.$module_name.index") }}" id="btn_cancel" class="hidenview btn btn-danger m-1 btn-sm"><i class="fa fa-times"></i> Cancel</a>
                </div>

                <div class="float-right">
                    <a href="{{ route("backend.$module_name.create") }}" class="btn btn-success m-1 btn-sm" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i> Create</a>
                    <a href="{{ route("backend.$module_name.tableview") }}" class="btn btn-success m-1 btn-sm" data-toggle="tooltip" title="Table View"><i class="fas fa-plus-circle"></i> Table View</a>

                </div>


            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <!--start content -->
                <div class="container">
                    <!-- <a href="javascript:void(0);" class="reorder_link" id="saveReorder">reorder photos</a> -->
                    <div id="reorderHelper" class="light_box" style="display:none;">1. Drag photos to reorder.<br>2. Click 'Save Changes' when finished.</div>
                    <div class="gallery">
                        <hr id="hhh">
                        <ul id="myList" class="reorder_ul reorder-photos-list">

                            @php
                            $page_i=0;
                            @endphp

                            @if (count($$module_name) >0)


                            @foreach ($$module_name as $key => $row)



                            <li id="image_li_{!! $row->id !!}" class="ui-sortable-handle">
                                <p style="position: absolute;">{{$key+1}}</p>
                                <a href='{{ route("backend.$module_name.show", $row->id) }}' style="float:none;" class="image_link">
                                    <img src="/{!! $row->image_url !!}" alt="">
                                </a>
                                <h6>{{ $row->title }}</h6>
                            </li>
                            @endforeach

                            @endif

                        </ul>
                    </div>
                </div>
                <!--end content -->
            </div>
        </div>
    </div>

</div>
@stop


@push ('after-styles')
<!-- DataTables Core and Extensions -->
<!-- <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}"> -->

<style>
    .container {
        /* margin-top: 50px; */
        padding: 10px;
    }

    ul,
    ol,
    li {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .reorder_link111 {
        color: #3675B4;
        border: solid 2px #3675B4;
        border-radius: 3px;
        text-transform: uppercase;
        background: #fff;
        font-size: 18px;
        padding: 10px 20px;
        margin: 15px 15px 15px 0px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.35s;
        -moz-transition: all 0.35s;
        -webkit-transition: all 0.35s;
        -o-transition: all 0.35s;
        white-space: nowrap;
    }

    .reorder_link111:hover {
        color: #fff;
        border: solid 2px #3675B4;
        background: #3675B4;
        box-shadow: none;
    }

    #reorder-helper {
        margin: 18px 10px;
        padding: 10px;
    }

    .light_box {
        background: #efefef;
        padding: 20px;
        margin: 15px 0;
        text-align: center;
        font-size: 1.2em;
    }

    /* image gallery */
    .gallery {
        width: 100%;
        float: left;
        /* margin-top: 15px; */
    }

    .gallery ul {
        margin: 0;
        padding: 0;
        /* list-style-type: none; */
    }

    .gallery ul li {
        /* padding: 7px; */
        border: 2px solid #ccc;
        float: left;
        /* margin: 10px 7px; */
        background: none;
        /* width: 80px; */
        height: 120px;
        text-align: center;
    }

    .gallery ul li {
        width: 20%;
        /* margin-left: 3%; */
        /* display: inline; */
    }

    .gallery ul {
        display: flex;
        flex-wrap: wrap;
        /* column-count:4;
        grid-row: 3 */
    }

    .gallery img {
        /* max-width: 60px; */
        max-height: 100px;
    }

    /* .gallery li {
        width: 200px;
        height: 220px;
    } */

    /* notice box */
    .notice,
    .notice a {
        color: #fff !important;
    }

    .notice {
        z-index: 8888;
        padding: 10px;
        margin-top: 20px;
    }

    .notice a {
        font-weight: bold;
    }

    .notice_error {
        background: #E46360;
    }

    .notice_success {
        background: #657E3F;
    }

    #btn_cancel.hidenview {
        display: none;
    }

    /* .gallery ul li {
        width: 5em;
        float: left;
    } */

    .gallery ul {
        /* height: 100vh; */
        padding: 0;
        margin: 0;
        list-style-type: none;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .gallery li {
        width: 50%;
    }

    .gallery li:nth-child(n) {
        /* background: #000000; */
        flex: 0 0 20%;
    }

    .gallery li:nth-child(2n) {
        /* background: #30BB75; */
        flex: 0 0 20%;
    }

    .gallery li:nth-child(3n) {
        /* background: #BB3047; */
        flex: 0 0 20%;
    }

    .gallery li:nth-child(4n) {
        flex: 0 0 20%;
        /* background: #305EBB; */
    }

    .gallery li:nth-child(5n) {
        flex: 0 0 20%;
        /* margin: 3px 0px; */
        /* border-bottom: 2px solid black; */
        /* background: #305EBB; */
        /* margin-bottom:20px;  */
    }

    .gallery li:nth-child(15n) {
        margin-bottom:50px; 
    }
</style>

@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<!-- <script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $('.reorder_link').on('click', function() {
            $("ul.reorder-photos-list").sortable({
                tolerance: 'pointer'
            });
            $('.reorder_link').html('save reordering');
            $('.reorder_link').attr("id", "saveReorder");
            $('#btn_cancel').removeClass('hidenview');
            $('#reorderHelper').slideDown('slow');
            $('.image_link').attr("href", "javascript:void(0);");
            $('.image_link').css("cursor", "move");

            $("#saveReorder").click(function(e) {
                $('#btn_cancel').addClass('hidenview');
                if (!$("#saveReorder i").length) {
                    $(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
                    $("ul.reorder-photos-list").sortable('destroy');
                    $("#reorderHelper").html("Reordering Photos - This could take a moment. Please don't navigate away from this page.").removeClass('light_box').addClass('notice notice_error');

                    var h = [];
                    $("ul.reorder-photos-list li").each(function() {
                        h.push($(this).attr('id').substr(9));
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ route("backend.$module_name.orderUpdate") }}',
                        data: {
                            ids: " " + h + ""
                        },
                        success: function(json) {
                            console.log('AJAX Working');
                            console.log(json);
                            window.location.reload();
                        }
                    });
                    return false;
                }
                e.preventDefault();
            });
        });
    });
</script>

@endpush