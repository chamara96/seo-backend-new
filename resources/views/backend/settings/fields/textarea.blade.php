<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}"> <strong>{{ $field['label'] }}</strong> ({{ $field['name'] }})</label>
    <textarea type="{{ $field['type'] }}"
           name="{{ $field['name'] }}"
           value="{{ old($field['name'], setting($field['name'])) }}"
           class="form-control {{ Arr::get( $field, 'class') }} {{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
           id="{{ $field['name'] }}"
           placeholder="{{ $field['label'] }}"
           rows="10"
           form="usrform">{{ old($field['name'], setting($field['name'])) }}</textarea>

    @if ($errors->has($field['name'])) <small class="invalid-feedback">{{ $errors->first($field['name']) }}</small> @endif
</div>
