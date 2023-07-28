@extends('layouts.app')

@section('content')
    <div>
        <h1>Task Management</h1>
        <a href="{{ route('tasks.create') }}">Create New Task</a>

        <table>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Message Body</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($tasks as $task)
                    <tr data-task-id="{{ $task->id }}">
                        <td>
                            <span class="drag-handle" style="cursor: grab">&#9776;</span>
                            {{ $task->task_name }}
                        </td>
                        <td>{{ $task->task_body }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
                            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#sortable").sortable({
                    handle: ".drag-handle",
                    update: function(event, ui) {
                        updateTaskPriority();
                    }
                });

                function updateTaskPriority() {
                    var taskOrder = $("#sortable").sortable('toArray', { attribute: 'data-task-id' });
                    var token = '{{ csrf_token() }}';

                    $.ajax({
                        type: "POST",
                        url: "{{ route('tasks.updatePriority') }}",
                        data: { task_order: taskOrder, _token: token },
                        success: function(data) {
                            console.log('Task priorities updated successfully.');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating task priorities: ' + error);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
