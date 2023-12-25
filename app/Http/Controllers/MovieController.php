<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $movies = $request->user()->movies()->latest()->paginate(10);

        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request): MovieResource
    {
        $movie = $request->user()->movies()->create($request->validated());

        if ($request->hasFile('poster')) {
            $movie->poster = $request->file('poster')->store();
        }

        $movie->save();

        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): MovieResource
    {
        $this->authorize('view', $movie);

        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $oldImage = $movie->poster;

        $movie->update($request->validated());

        if ($request->hasFile('poster')) {
            $movie->poster = $request->file('poster')->store();
            $movie->save();

            if (Storage::has($oldImage)) {
                Storage::delete($oldImage);
            }
        }

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);

        $movie->delete();

        return response()->successMessage('Movie successfully deleted..');
    }
}
