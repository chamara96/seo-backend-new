<div class="text-right">
    @php
    $post_details_url = route("frontend.$module_name.show",[encode_id($data->id),slug_format($data->jobtitle)]);
    // $post_details_url=slug_format("chamara madhj nfjd 12")
    @endphp
    {{-- @php
    $post_details_url = route("frontend.$module_name.show",[encode_id($data->id), $data->slug]);
    @endphp --}}
    {{-- <a href='{!!route("backend.$module_name.edit", $data)!!}' class='btn btn-sm btn-primary mt-1' data-toggle="tooltip" title="Edit {{ ucwords(Str::singular($module_name)) }}"><i class="fas fa-wrench"></i></a> --}}
    <div class="float-right">
        <a href="{{$post_details_url}}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-right"></i> Apply</a>
    </div>
</div>
