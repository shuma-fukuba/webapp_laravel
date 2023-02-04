<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\LearningContent;
use App\Models\LearningTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        return LearningTime::read_learning_log($user_id);
    }

    public function read_langs_contents(Request $request)
    {
        $languages = Language::all();
        $contents = LearningContent::all();
        return json_encode(
            compact('languages', 'contents'),
            JSON_UNESCAPED_UNICODE
        );
    }

    public function create_learning_log(Request $request)
    {
        $date = $request->date;
        $time = $request->learning_time;
        $user_id = $request->user_id;
        $languages = array_map('intval', explode(',', $request->languages));
        $contents = array_map('intval', explode(',',  $request->contents));

        $learning_time = new LearningTime;
        $learning_time->learning_time = $time;
        $learning_time->learning_time_date = $date;
        $learning_time->user_id = $user_id;

        $learning_time->save();

        // dd($learning_time);
        foreach ($languages as $language) {
            $learning_time->languages()->attach($language);
        }

        foreach ($contents as $content) {
            $learning_time->learning_contents()->attach($content);
        }

        return  LearningTime::read_learning_log($user_id);
    }

}
