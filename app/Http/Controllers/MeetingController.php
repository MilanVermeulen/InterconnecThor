<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MeetingController extends Controller
{
    // create meeting
    public function createMeeting(Request $request)
    {

        $METERED_DOMAIN = env('METERED_DOMAIN');
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');

        // Contain the logic to create a new meeting
        $response = Http::post("https://{$METERED_DOMAIN}/api/v1/room?secretKey={$METERED_SECRET_KEY}", [
            'autoJoin' => true
        ]);

        $roomName = $response->json("roomName");

        return redirect("/meeting/{$roomName}")->with('roomName', $roomName);
    }

    // validate meeting
    public function validateMeeting(Request $request)
    {
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');

        $meetingId = $request->input('meetingId');

        // Contains logic to validate existing meeting
        $response = Http::get("https://{$METERED_DOMAIN}/api/v1/room/{$meetingId}?secretKey={$METERED_SECRET_KEY}");

        $roomName = $response->json("roomName");

        if ($response->status() === 200) {
            return redirect("/meeting/{$roomName}")->with('roomName', $roomName);
        } else {
            return redirect("/?error=Invalid Meeting ID");
        }
    }
}
