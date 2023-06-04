<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function list(Request $request) {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 5;
        $videos = Video::where('status', 'ready')
            ->orderBy('id', 'desc')
            ->get()
            ->skip(($page-1) * $limit)
            ->take($limit);
        return view('videos.list', ['videos' => $videos]);
    }

    public function watch(Request $request, $id) {
        $video = Video::findOrFail($id);
        $vdocipher = new VdocipherController();
        $playbackCredentials = $vdocipher->generateOTPInfo($video->uuid);
        if ($playbackCredentials) {
            return view('videos.watch', [
                'title' => $video->title,
                'otp' => $playbackCredentials->otp,
                'playbackInfo' => $playbackCredentials->playbackInfo,
            ]);
        }
        return view('videos.watch', ['error' => 'Video not found']);
    }
}
