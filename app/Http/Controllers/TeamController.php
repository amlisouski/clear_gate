<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use LogicException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:team.view|team.create|team.edit|team.delete', [
            'only' => ['index', 'show']
        ]);

        $this->middleware('permission:team.create', [
            'only' => ['create', 'store']
        ]);

        $this->middleware('permission:team.edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:team.contact.edit', [
            'only' => ['update_contact']
        ]);

        $this->middleware('permission:team.delete', [
            'only' => ['destroy']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teams = Team::with(['foreman', 'createdBy'])->get();

            $dataTable = [];
            foreach ($teams as $team) {
                $dataTable[] = [
                    'id' => $team->id,
                    'name' => $team->name,
                    'foreman' => $team->foreman->getFullName(),
                    'created_by' => $team->createdBy->getFullName(),
                    'created_at' => $team->created_at->format('m/d/Y H:i:s')
                ];
            }

            return DataTables::of(collect($dataTable))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('teams.show', $row['id']) . '" class="btn btn-secondary btn-sm"><i class="bi bi-eye"></i>&nbsp;View</a>&nbsp;';
                    if( Auth::user()->can('team.edit') ) {
                        $btn .= '<a href="' . route('teams.edit', $row['id']) . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i>&nbsp;Edit</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('teams.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foremans = Role::findByName('foreman')->users;
        $workers = Role::findByName('worker')->users;
        return view('teams.create', [
            'foremans' => $foremans,
            'workers' => $workers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $input = $request->safe()->all();

            $team = Team::create([
                'name' => $input['name'],
                'foreman_id' => $input['foreman'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
            $team->members()->sync($input['workers']);

        } catch (LogicException $exception) {
            $this->redirect_with_notyf(
                redirect()->back(),
                false,
                $exception->getMessage()
            );
        }

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Team $team)
    {
        if ($request->ajax()) {
            $team = Team::with(['foreman','members'])->whereId($team->id)->get();
            return response()->json($team->toArray(), 200);
        }
        $members = $team->members()->get();
        return view('teams.show', [
            'team' => $team,
            'foreman' => $team->foreman,
            'members' => $members
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $foremans = Role::findByName('foreman')->users;
        $workers = Role::findByName('worker')->users;
        $members = $team->members()->pluck('id')->toArray();
        return view('teams.edit', [
            'team' => $team,
            'foreman' => $team->foreman,
            'members' => $members,
            'foremans' => $foremans,
            'workers' => $workers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Team $team): \Illuminate\Http\RedirectResponse
    {
        try {
            $input = $request->safe()->all();

            $team->update([
                'name' => $input['name'],
                'foreman_id' => $input['foreman']
            ]);

            $team->members()->sync($input['workers']);

        } catch ( LogicException|ValidationException $logicException) {
            $this->redirect_with_notyf(
                redirect()->route('teams.edit', $team->id),
                false
            );
        }
        return $this->redirect_with_notyf(back());
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
