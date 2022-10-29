@props(['service'])

<div class="flex">
    <input type="checkbox" name="{{ $service->name }}" id="{{ $service->name }}" checked="{{ $service->is_checked }}">
    <label for="{{ $service->name }}">{{ $service->name }}</label>
</div>
