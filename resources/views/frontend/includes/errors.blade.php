@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <p>
        <i class="fa fa-exclamation-triangle"></i> Please fix the following errors and submit again!
    </p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))

<div class="alert alert-success" role="alert">
    <p>
        <i class="fa fa-exclamation-triangle"></i> SUCCESS
    </p>
    <ul>
        <li>{{ session('success') }}</li>
    </ul>
</div>


@endif