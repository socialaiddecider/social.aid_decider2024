<div class="form-group flex flex-col gap-3">
    <label for="{{ $key }}" class="text-neutral-950 font-medium">{{ $title }}</label>
    <div class="">
        <input type="{{ $type }}" name="{{ $key }}" id="{{ $key }}"
            class="form-control w-full p-3 border rounded-lg" placeholder="{{ $placeholder }}"
            value="{{ $value == null ? old($key) : $value }}" @required($required) @disabled($disabled)>
        @error($key)
            <div class="text-sm text-error-500">{{ $message }}</div>
        @enderror
    </div>
</div>
