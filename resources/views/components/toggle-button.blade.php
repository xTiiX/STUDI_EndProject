@props(['service'])

<div class="flex ml-2">
    <input type="checkbox" name="services[]" value="{{ $service->id }}" id="{{ $service->id }}">
    <label for="{{ $service->id }}" class="ml-1">{{ $service->name }}</label>
    <script>
        console.log({{$service->is_checked}});
        if ( {{$service->is_checked}} == 1 )
            document.getElementById({{$service->id}}).checked = true;
    </script>
</div>
