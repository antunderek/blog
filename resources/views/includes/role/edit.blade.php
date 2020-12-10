@if ($value)
    <input type="radio" id="{{ $name }}_yes" name="{{ $name }}" value="1" checked>
    <label for="{{ $name }}_yes">Yes</label>
    <input type="radio" id="{{ $name }}_no" name="{{ $name }}" value="0">
    <label for="{{ $name }}_no">No</label>
@else
    <input type="radio" id="{{ $name }}_yes" name="{{ $name }}" value="1">
    <label for="{{ $name }}_yes">Yes</label>
    <input type="radio" id="{{ $name }}_no" name="{{ $name }}" value="0" checked>
    <label for="{{ $name }}_no">No</label>
@endif
<br>
