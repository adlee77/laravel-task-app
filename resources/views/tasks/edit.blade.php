@extends('layouts.app')

@section('content')
    <div>
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label for="task_name">Task Name:</label>
                <input type="text" name="task_name" id="task_name" value="{{ $task->task_name }}" required>
            </div>
            <div>
                <label for="priority">Priority:</label>
                <input type="number" name="priority" id="priority" value="{{ $task->priority }}" required>
            </div>
            <div>
                <label for="task_body">Message:</label>
                <textarea name="task_body" id="task_body" rows="3" required>{{ $task->task_body }}</textarea>
            </div>
            <button type="submit">Update Task</button>
        </form>
    </div>
@endsection
