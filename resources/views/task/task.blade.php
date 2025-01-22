@extends('layouts.master')
@section('content')
    <p class="font-bold text-2xl">{{ $project->name }}</p>

    <div class="tasks">
        <form action="{{ route('task.store') }}" class="ww-full" method="POST">
            @csrf
            <div class="input-group flex w-full h-11 flex gap-5 my-5">
                <input type="text" class="w-full pl-2 rounded-md" name="name" placeholder="Add Task">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <button type="submit" class="bg-black text-white rounded-lg px-5">Add</button>
            </div>
            @include("components.success")
            @include("components.session-success")
        </form>
        <div class="task-table">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-8">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Task
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>


                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($tasks ?? [] as $task)

                        <tr draggable="true" data-task-id="{{ $task->id }}"
                            class="bg-white border-b  hover:bg-gray-50 ">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $task->id }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $task->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $task->created_at->format('F j, Y H:i:s') }}
                            </td>

                            <td class="px-6 py-4 text-right ">
                                <div class="flex justify-end">
                                <a href="{{ route('task.edit', $task->id) }}"
                                    class="font-medium text-blue-600  hover:underline mr-3">Edit</a>
                                    <form action="{{ route('task.delete', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="font-medium text-red-600  hover:underline">Delete</button>
                                    </form>
                            </div>



                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="my-5 mr-2">

                    {{ $tasks->links() }}
                </div>
            </div>

        </div>
    </div>

    <script>
        $(function() {
            $("#sortable").sortable({
                update: function() {
                    let sortedIds = $("#sortable tr").map(function() {
                        return $(this).data("task-id");
                    }).get();
                    $.ajax({
                        url: "{{ route('task.reorder') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sortedIds: sortedIds
                        },
                        success: function() {
                            $("#alert-border-4").show().text('Task ordered updated successfully.')
                                .fadeOut(3000);
                        }
                    });
                }
            });
        });
    </script>
@endsection
