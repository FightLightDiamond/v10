<?php

namespace App\Http\Controllers;

use Aws\Polly\PollyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use function Spiral\RoadRunner\Http\respond;

class SpeakController extends Controller
{
    public function getAlphabet()
    {
        return Inertia::render('Speak/Alphabet');
    }

    public function python()
    {
        return Inertia::render('Speak/Python');
    }

    public function generateSpeech(Request $request)
    {
        $text = $request->text;
        $content = Cache::remember($text, 10, function () use ($text) {
            $config = [
                'version' => 'latest',
                'region' => config('aws.region'),
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID', 'AKIAXTK37ZPAMMS5MVBU'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY', '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'),
                ],
            ];

            $result = (new \Aws\Polly\PollyClient($config))->synthesizeSpeech([
                'Text' => $text,
                'OutputFormat' => 'mp3', // Định dạng đầu ra của âm thanh
                'VoiceId' => 'Joanna', // Giọng đọc (có thể thay đổi)
            ]);

            return  $result['AudioStream']->getContents();
        });

//        return response()->stream(function () use ($content) {
//            echo $content;
//        }, 200, [
//            'Content-Type' => 'audio/mpeg',
//        ]);
        return response($content)
            ->header('Content-Type', 'audio/mpeg')
            ->header('Content-Disposition', 'inline; filename="output.mp3"');
    }
}
