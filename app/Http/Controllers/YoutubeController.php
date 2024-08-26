<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube as FacadesYoutube;
use App\Models\GroupUser;
use App\Models\User;
use App\Models\Youtube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $youtube = Youtube::all();
        return view('master.youtube.index', compact('youtube'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::whereNot('role', 'admin')->get();
        $group = GroupUser::whereHas('user')->get();
        $usersWithoutGroups = User::doesntHave('group')->get();
        return view('master.youtube.create', compact('user', 'group', 'usersWithoutGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $videoId = FacadesYoutube::parseVidFromURL($request->link);
        $video = FacadesYoutube::getVideoInfo($videoId);

        $youtube = new Youtube();
        $youtube->judul = $video->snippet->title;
        $youtube->deskripsi = $video->snippet->description;
        $youtube->link = $videoId;
        $youtube->save();
        $youtube->user()->sync($request->user);
        return redirect()->route('youtube.index')->with(['success' => 'Berhasil Menambahkan Youtube']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Youtube $youtube)
    {
        $video = FacadesYoutube::getVideoInfo($youtube->link);
        $channel = FacadesYoutube::getChannelById($video->snippet->channelId);
        $youtube->channel = $channel;
        $youtube->video = $video;
        if (Auth::user()->role == 'admin') {
            $youtubeAll = Youtube::all();
        } else {
            $youtubeAll = Auth::user()->youtube;
        }

        foreach ($youtubeAll as $all) {
            $videoData = FacadesYoutube::getVideoInfo($all->link);
            $channelData = FacadesYoutube::getChannelById($videoData->snippet->channelId);
            $all->channel = $channelData;
            $all->video = $videoData;
        }
        // dd($youtubeAll);
        return view('master.youtube.show', compact('youtubeAll', 'youtube'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Youtube $youtube)
    {
        $user = User::whereNot('role', 'admin')->get();
        $group = GroupUser::whereHas('user')->get();
        $usersWithoutGroups = User::doesntHave('group')->get();
        return view('master.youtube.edit', compact('youtube', 'user', 'group', 'usersWithoutGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Youtube $youtube)
    {
        $videoId = FacadesYoutube::parseVidFromURL($request->link);
        $video = FacadesYoutube::getVideoInfo($videoId);

        $youtube->judul = $video->snippet->title;
        $youtube->deskripsi = $video->snippet->description;
        $youtube->link = $videoId;
        $youtube->save();
        $youtube->user()->sync($request->user);
        return redirect()->route('youtube.index')->with(['success' => 'Berhasil Mengedit Youtube']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Youtube $youtube)
    {
        $youtube->delete();
        return redirect()->route('youtube.index')->with(['success' => 'Berhasil Menghapus Youtube']);
    }
}
