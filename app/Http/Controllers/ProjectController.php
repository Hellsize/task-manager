<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use App\Http\Resources\PrpjectResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request){
        
        return new ProjectCollection(Auth::user()->projects()->paginate());
    }
    public function store(StoreProjectRequest $request){
        $validated = $request->validated();
        $project = Auth::user()->projects()->create($validated);
        return new PrpjectResource($project);
    }
    public function show(Request $request,Project $project){
return (new PrpjectResource($project))->load('tasks');
    }

    public function update(UpdateProjectRequest $request, Project $project){
        $validated = $request->validated();
        $project->update($validated);
        return new PrpjectResource($project);  
    }
    public function destroy(Request $request,Project $project){
        $project->delete();
        return response()->noContent();
    }
}
