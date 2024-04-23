@extends('layots\app')
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
    @props(['userTask'])

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th style={}>Task Name</th>


                    <th>
                        Priority
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tasks as $user)
                    @foreach ($user['userTask'] as $task)
                        <tr class="clickable-row" data-color="{{ $task['color'] }}">
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $task['name'] }}</td>

                            <td>
                                @if ($task['priority'] == 1)
                                    Very High
                                @elseif ($task['priority'] == 2)
                                    High
                                @elseif ($task['priority'] == 3)
                                    Medium
                                @elseif ($task['priority'] == 4)
                                    Low
                                @else
                                    {{ $task['priority'] }}
                                @endif
                            </td>
                            <td style="background-color: {{ $task['color'] }}; width: 5px; height: 10px;"></td>
                        </tr>
                    @endforeach
                @endforeach

                <script>
                    $tasks=get['']
                    $(document).ready(function() {
                        $(".clickable-row").click(function() {
                            var color = $(this).data('color');
                            $(this).addClass("table-active");
                            $(this).css("background-color", color);
                        });
                    });
                </script>
