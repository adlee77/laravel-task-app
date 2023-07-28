@extends('layouts.app')

@section('content')
    <div>
        <h1>Create New Task</h1>
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            <div>
                <label for="task_name">Task Name:</label>
                <input type="text" name="task_name" id="task_name" required>
            </div>
            <div>
                <label for="task_body">Message:</label>
                <textarea type="text" name="task_body" id="task_body" rows="3" required></textarea>
            </div>
            <div>
                <label for="priority">Priority:</label>
                <input type="number" name="priority" id="priority" required>
            </div>
            <button type="submit">Create Task</button>
        </form>
    </div>
@endsection
