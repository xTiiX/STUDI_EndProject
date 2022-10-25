<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Live Search</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Products info </h3>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-controller" id="search" name="search"></input>
                    </div>
                </div>
                <div id="list">
                    @foreach ($partners as $partner)
                        <x-partner-board-part :partner="$partner" />
                    @endforeach
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var list = document.getElementById('list');
            $('#search').on('keyup', function () {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search') }}',
                    data: { 'search': $value },
                    success: function (data) {
                        list.innerHTML = data;
                    }
                });
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken': '{{ csrf_token() }}' } });
        </script>
    </body>
</html>
