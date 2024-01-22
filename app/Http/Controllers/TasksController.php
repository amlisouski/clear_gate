<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequiest;
use App\Models\Task;

class TasksController extends Controller
{
	public function index()
	{
		return view('tasks.index', [
			'tasks' => Task::all()
		]);
	}

	public function create()
	{
		return $this->manage();
	}

	public function edit(Task $task)
	{
		return $this->manage($task);
	}

	private function manage(Task $task = null)
	{
		return view('tasks.manage', [
			'task' => $task
		]);
	}

	public function store(TaskRequiest $requiest)
	{
		return $this->save($requiest);
	}

	public function update(TaskRequiest $requiest, Task $task)
	{
		return $this->save($requiest, $task);
	}

	private function save(TaskRequiest $requiest, Task $task = null)
	{
		$taskData = $requiest->validated();

		Task::updateOrCreate([
			'id' => $task?->id
		], $taskData);

		return $this->redirect_with_notyf(
			redirect()->route('admin.tasks.index'),
			true,
			'Task successfully saved.'
		);
	}

	public function destroy(Task $task)
	{
		$task->delete();

		return response()->json([
			'status' => 'ok'
		]);
	}

	public function complete(Task $task)
	{
		$task->update([
			'is_complete' => !($task->is_complete)
		]);

		return response()->json([
			'status' => 'ok',
			'is_complete' => $task->is_complete
		]);
	}
}