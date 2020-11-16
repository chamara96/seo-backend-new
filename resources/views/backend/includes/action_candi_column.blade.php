<table>
    <tr>
        <td style="border:none">
            <a href='{!!route("backend.$module_name.active", $data)!!}'> {{$active_candi = $job_res_model::where('jobposts_id', $data->id)->where('status', 1)->count() }} Shortlisted </a>
        </td>

        <td style="border:none">
            <a href='{!!route("backend.$module_name.await", $data)!!}'> {{$active_candi = $job_res_model::where('jobposts_id', $data->id)->whereIn('status', [0, 2])->count() }} Awaiting </a>
        </td>

        <td style="border:none">
            <a href='{!!route("backend.$module_name.reviewed", $data)!!}'> {{$active_candi = $job_res_model::where('jobposts_id', $data->id)->where('status', 3)->count() }} Rejected </a>
        </td>

        <td style="border:none">
            <a href='{!!route("backend.$module_name.allcandi", $data)!!}'> {{$active_candi = $job_res_model::where('jobposts_id', $data->id)->whereIn('status', [0,1,2,3])->count() }} All </a>
        </td>

    </tr>
</table>