<div class="text-right">
    {{-- <a href='{!!route("backend.$module_name.show", $data)!!}' class='btn btn-sm btn-success mt-1' data-toggle="tooltip" title="Show {{ ucwords(Str::singular($module_name)) }}"><i class="fas fa-tv"></i></a> --}}
<a href='/admin/jobresponses/{{$data->id}}?type={{$tb_type}}' class='btn btn-sm btn-success mt-1' data-toggle="tooltip" title="Show {{ ucwords(Str::singular($module_name)) }}"><i class="fas fa-tv"></i></a>
</div>
