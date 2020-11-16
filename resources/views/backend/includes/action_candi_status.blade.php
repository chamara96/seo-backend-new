@if ($data->status == 0)
<span class="badge badge-warning">Awating</span>
@elseif ($data->status == 1)
<span class="badge badge-success">Shortlisted</span>
@elseif ($data->status == 2)
<span class="badge badge-primary">Review later</span>
@else
<span class="badge badge-danger">Rejected</span>
@endif