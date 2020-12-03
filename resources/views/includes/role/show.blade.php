@if ($value)
    <input type="radio" id="yes" name="{{ $name }}" value="1" checked disabled>
    <label for="yes">Yes</label>
    <input type="radio" id="no" name="{{ $name }}" value="0" disabled>
    <label for="no">No</label>
@else
    <input class="form-check-input" type="radio" id="yes" name="{{ $name }}" value="1" disabled>
    <label for="yes">Yes</label>
    <input type="radio" id="no" name="{{ $name }}" value="0" checked disabled>
    <label for="no">No</label>
@endif
<br>
