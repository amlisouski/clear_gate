<x-app-layout>
    <form method="POST"
          @if($task)
              action="{{ route('admin.tasks.update', $task) }}"
          @else
              action="{{ route('admin.tasks.store') }}"
          @endif
    >
        @if($task)
            @method('PATCH')
        @endif
        @csrf
        <div class="card card border-0 shadow mb-4">
            <div class="card-header text-end">
                <a class="btn btn-link btn-sm" href="{{ route('admin.tasks.index') }}">Cancel</a>
            </div>
            <div class="card-body">
                <div class="row form-group mb-2">
                    <label class="col-1 required">Title</label>
                    <div class="col-11">
                        <input type="text" class="form-control" name="title" value="{{ $task?->title }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-1 required">Description</label>
                    <div class="col-11">
                        <textarea class="form-control" rows="10" name="description">{{ $task?->description }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-1">Is Complete</label>
                    <div class="col-11">
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input"
                                   name="is_complete"
                                   value="1"
                                   {{ $task?->is_complete ? 'checked' : '' }}
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-sm">Save task</button>
            </div>
        </div>
    </form>
</x-app-layout>
