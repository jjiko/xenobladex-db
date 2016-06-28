@foreach($results as $name => $tasks)
    <h2><a href="/g/xbx/db/squad-task/{{ urlencode($name) }}">Squad Tasks #{{ $name }}</a></h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Objective</th>
            <th>Target</th>
            <th>Region</th>
            <th>Location</th>
            <th>Notes</th>
            <th>Mission Unlock</th>
        </tr>
        </thead>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->objective }}</td>
                <td>{{ $task->target }}</td>
                <td>{{ $task->region }}</td>
                <td>{{ $task->location }}</td>
                <td>{{ $task->notes }}</td>
                <td>{{ $task->mission_unlock }}</td>
            </tr>
        @endforeach
    </table>
@endforeach