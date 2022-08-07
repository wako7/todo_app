<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Label;
use Illuminate\Http\Request;
//ログインしているユーザーの投稿のみをレスポンスとして返したいので、以下を追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * indexアクションではユーザーが作成したすべてのGoalを
         * 「JSON」(JavaScript Object Notation)という形式で送信
         */
         $goals = Auth::user()->goals;
         $goals = DB::table('goals')
            ->select('goals.id', 'goals.title', 'goals.user_id', 'goals.created_at', 'goals.updated_at', 'goals.completed_at', 'goals.status_id', 'goals.deadline', 'labels.label as label', 'goals.detail_id')
            ->join('labels', 'goals.label_id', '=', 'labels.id')
            ->get();
         
         return response()->json($goals);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * storeアクションでは送られてきたリクエストの値を使い、
         * 新しくGoalを作成します。
         * indexアクション同様にJSON形式でレスポンスを返します。
         */
         $goal = new Goal();
         $goal->title = request('title');
         $goal->user_id = Auth::id();
         $goal->save();
         
         $goals = Auth::user()->goals;
         
         return response()->json($goals);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        /**
         * updateアクションでは送られてきたリクエストの値を使い、
         * 既存のGoalを更新します。
         */
         $goal->title = request('title');
         $goal->user_id = Auth::id();
         $goal->save();
         
         $goals = Auth::user()->goals;
         
         return response()->json($goals);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        /**
         * destroyアクションでは送られてきたリクエストの値を使い、
         * 既存のGoalを削除する
         */
         $goal->delete();
         
         $goals = Auth::user()->goals;
         
         return response()->json($goals);
    }
}
