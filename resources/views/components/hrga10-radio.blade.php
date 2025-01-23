<div>
    <div>{{ $question }}</div>
    <x-label_ind :text="$translation" />
</div>
<div class="flex gap-2 items-center justify-end mt-2">
    <div>
        <input id="{{ $name }}_yes" type="radio" value="ya" class="form-check" name="{{ $name }}">
        <label for="{{ $name }}_yes">Yes/ <x-label_ind text="Ya" /></label>
    </div>
    <div>
        <input id="{{ $name }}_no" type="radio" value="tidak" class="form-check" name="{{ $name }}"
        checked>
        <label for="{{ $name }}_no">No/ <x-label_ind text="Tidak" /></label>
    </div>
</div>
