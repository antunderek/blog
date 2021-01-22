@if ($value)
    <input type="radio" id="{{ $name }}_yes" name="{{ $name }}" value="1" checked disabled>
    <label for="{{ $name }}_yes">Yes</label>
    <input type="radio" id="{{ $name }}_no" name="{{ $name }}" value="0" disabled>
    <label for="{{ $name }}_no">No</label>
@else
    <input class="form-check-input" type="radio" id="{{ $name }}_yes" name="{{ $name }}" value="1" disabled>
    <label for="{{ $name }}_yes">Yes</label>
    <input type="radio" id="{{ $name }}_no" name="{{ $name }}" value="0" checked disabled>
    <label for="{{ $name }}_no">No</label>
@endif
<br>
