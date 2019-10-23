<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songList = Song::limit(8)->with('artist')->get();

        return $songList;
    }

    /**
     * Display a listing as a result of a search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchString = $request->get('searchString');

        $like = "%".$searchString."%";

        $songList = Song::with('artist')
            ->where('name','like', $like)
            ->get();

        $songs = Song::with('artist')->get();

        foreach ($songs as $song){
            if (stripos(Artist::find($song->artist)->name, $searchString) !== false) {
                if (! $songList->find($song->id))
                    $songList->add($song);
            }
        }


        return $songList;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Song  $song
     * @return \App\Song
     */
    public function show(Song $song)
    {
        $song = Song::with('artist')->find($song->id);

        return $song;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
