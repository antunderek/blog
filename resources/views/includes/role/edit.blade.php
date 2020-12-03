@if ($value)
    <input type="radio" id="yes" name="{{ $name }}" value="1" checked>
    <label for="yes">Yes</label>
    <input type="radio" id="no" name="{{ $name }}" value="0">
    <label for="no">No</label>
@else
    <input type="radio" id="yes" name="{{ $name }}" value="1">
    <label for="yes">Yes</label>
    <input type="radio" id="no" name="{{ $name }}" value="0" checked>
    <label for="no">No</label>
@endif
<br>
