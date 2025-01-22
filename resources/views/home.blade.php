@extends("layouts.master")
@section("content")
<div class="min-h-96 ">
@if($projects->count() > 0)
    <div class="flex gap-5">

    @foreach ($projects ?? [] as $project )
    <div class="rounded-sm bg-white p-5 w-full max-w-xs">
        <div class="">{{ $project->name }}</div>
        <div class="mb-5">Tasks: {{ $project->tasks->count() }}</div>
        <a class="bg-black text-white rounded-lg p-2 text-sm" href="{{ route('task.index', $project->slug) }}">Add Task</a>
    </div>
    @endforeach
</div>

@endif
</div>
@endsection
