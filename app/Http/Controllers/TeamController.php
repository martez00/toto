<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->limit || $request->return_team_count) {
            if ($request->limit)
                $teams = Team::orderBy('created_at', 'DESC')->take($request->limit)->get();
            else $teams = Team::all();
            if ($request->return_team_count) {
                $teams_count = $teams->count();
                return response()->json(
                    [
                        'status' => 'success',
                        'teams_count' => $teams_count,
                    ], 200);
            }
            return response()->json(
                [
                    'status' => 'success',
                    'teams' => $teams->toArray(),
                ], 200);
        }
        else {
            $teams = Team::orderBy('id', 'DESC')->paginate(20);
            $response = [
                'pagination' => [
                    'total' => $teams->total(),
                    'per_page' => $teams->perPage(),
                    'current_page' => $teams->currentPage(),
                    'last_page' => $teams->lastPage(),
                    'from' => $teams->firstItem(),
                    'to' => $teams->lastItem()
                ],
                'data' => $teams
            ];
            return response()->json($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = new Team;
        $team->name = $request->name;
        $team->short_name = $request->short_name;
        if($request->hasFile('image')){
            $filenameWithExt=$request->file('image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $filenameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images/team_images', $filenameToStore);
        }
        else {
            $filenameToStore="noimage.jpg";
        }
        $team->image = $filenameToStore;
        $team->save();
        return response([
            'status' => 'success',
            'data' => $team
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->delete();
        return response()->json(
            [
                'status' => 'success',
                'post' => $team->toArray()
            ], 200);
    }
}
