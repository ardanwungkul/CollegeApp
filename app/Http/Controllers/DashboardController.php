<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube as FacadesYoutube;
use App\Models\Youtube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->role == 'admin') {
            $youtube = Youtube::all();
        } else {
            $youtube = Auth::user()->youtube;
        }
        foreach ($youtube as $all) {
            $videoData = FacadesYoutube::getVideoInfo($all->link);
            $channelData = FacadesYoutube::getChannelById($videoData->snippet->channelId);
            $all->channel = $channelData;
            $all->video = $videoData;
        }
        return view('dashboard', compact('youtube'));
    }
}
