<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\LearningContent;
use App\Models\LearningTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        return self::read_learning_log($user_id);
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

        return  self::read_learning_log($user_id);
    }

    private function read_learning_log(string $user_id)
    { // 今日の学習時間
        $today = Carbon::today();
        $today_time = LearningTime::whereDate('learning_time_date', $today)
            ->where('user_id', '=', $user_id)
            ->sum('learning_time');


        $month = Carbon::today()->subDay(30);
        $monthly_time_query = LearningTime::whereDate('learning_time_date', '>=', $month)
            ->where('user_id', '=', $user_id);

        // 今月の学習時間
        $monthly_sum = $monthly_time_query->sum('learning_time');

        // 棒グラフ用のデータ
        $monthly_learning_times = $monthly_time_query
            ->orderBy('learning_time_date', 'asc')
            ->get(['learning_time', 'learning_time_date']);

        // 累計学習時間
        $total_sum = LearningTime::where('user_id', '=', $user_id)->sum('learning_time');

        // PieChart
        $content_circle = DB::table('learning_contents')
            ->join('learning_content_learning_time', 'learning_contents.learning_content_id', '=', 'learning_content_learning_time.learning_content_id')
            ->join('learning_times', 'learning_times.learning_time_id', '=', 'learning_content_learning_time.learning_time_id')
            ->selectRaw('learning_contents.name as name')
            ->selectRaw('COUNT(learning_contents.name) as ratio')
            ->whereDate('learning_times.learning_time_date', '>=', $month)
            ->where('learning_times.user_id', '=', $user_id)
            ->groupBy('learning_contents.name')
            ->get();

        $language_circle = DB::table('languages')
            ->join('language_learning_time', 'languages.language_id', '=', 'language_learning_time.language_id')
            ->join('learning_times', 'learning_times.learning_time_id', '=', 'language_learning_time.learning_time_id')
            ->selectRaw('languages.language as name')
            ->selectRaw('COUNT(languages.language) as ratio')
            ->whereDate('learning_times.learning_time_date', '>=', $month)
            ->where('learning_times.user_id', '=', $user_id)
            ->groupBy('languages.language')
            ->get();

        return json_encode(
            compact(
                'today_time',
                'monthly_sum',
                'total_sum',
                'monthly_learning_times',
                'content_circle',
                'language_circle'
            ),
            JSON_UNESCAPED_UNICODE
        );
    }
}
