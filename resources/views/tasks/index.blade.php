<x-app-layout>

{{--    <x-slot name="title">@lang("List of tasks")</x-slot>--}}
{{--    <x-breadcrumbs :items="[__('List of tasks')]"></x-breadcrumbs>--}}

{{--    <x-page-title :title="[__('List of tasks')]">--}}
{{--    </x-page-title>--}}

    <div class="card card border-0 shadow mb-4">
        <div class="card-header text-end">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.tasks.create') }}">Create new task</a>
        </div>
        <div class="card-body">
            @if(!$tasks->count())
                <span>There are no tasks yet.</span>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Is Complete</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td data-url="{{ route('admin.tasks.complete', $task) }}">
                                @if($task->is_complete)
                                    <button type="button" class="btn btn-success btn-sm task-complete">
                                        <i class="fa fa-check"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-info btn-sm task-complete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.tasks.edit', $task) }}">
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm remove-task" data-url="{{ route('admin.tasks.destroy', $task) }}">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    @push('footer-scripts')
        <script type="text/javascript">
            let TASKS = {
                init () {
                    $('.remove-task').on('click', TASKS.removeTask);
                    $('.task-complete').on('click', TASKS.completeTask);
                },

                completeTask() {
                    let btn = $(this);
                    let url = $(this).parent().attr('data-url');
                    $.ajax({
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: "json",
                        type: "PATCH",
                        cache: false,
                        success: function (response) {
                            const notyf = new Notyf();
                            notyf.success('{{ __('Task successfully updated.') }}')
                            if (response.is_complete) {
                                btn.removeClass('btn-info').addClass('btn-success')
                                        .find('.fa').removeClass('fa-times').addClass('fa-check');
                            } else {
                                btn.removeClass('btn-success').addClass('btn-info')
                                        .find('.fa').removeClass('fa-check').addClass('fa-times');
                            }
                        },
                        error: function (response) {
                            console.log(response);
                            alert('Something goes wrong during task updating.');
                        }
                    });
                },

                removeTask() {
                    if (confirm('Are you sure you want to delete this task?')) {
                        let url = $(this).attr('data-url');
                        let row = $(this).parents('.row:first');
                        $.ajax({
                            url: url,
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            dataType: "json",
                            type: "DELETE",
                            cache: false,
                            success: function (response) {
                                const notyf = new Notyf();
                                notyf.success('{{ __('Task successfully deleted.') }}')
                                row.remove();
                            },
                            error: function (response) {
                                console.log(response);
                                alert('Something goes wrong during task deletion');
                            }
                        });
                    }
                }
            };

            $(document).ready(TASKS.init);
        </script>
    @endpush
</x-app-layout>