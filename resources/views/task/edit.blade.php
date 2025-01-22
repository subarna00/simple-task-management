@extends("layouts.master")

@section("content")
<div class="flex gap-5">
    <div class="w-full">
        <form action="{{ route("task.update", $task->id) }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ $task->name }}" class="w-full p-2 rounded-md border-gray-300">
            <button type="submit" class="bg-black text-white rounded-lg p-2 mt-4">Update</button>
        </form>
    </div>
</div>
@endsection
