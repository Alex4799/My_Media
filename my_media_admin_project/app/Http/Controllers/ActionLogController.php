<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionLogController extends Controller
{
    //viewCount

    public function viewCount(Request $req){
        $postData=[
            'user_id'=>$req->userId,
            'post_id'=>$req->postId,
        ];
        ActionLog::create($postData);
        $post=ActionLog::where('post_id',$req->postId)->get();
        $data=[
            'post'=>$post,
            'message'=>'success',
        ];

        return response()->json($data, 200);
    }

        //trendPost page
        public function trendPost(){
            $posts=ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts','posts.id','action_logs.post_id')
            ->groupBy('action_logs.post_id')
            ->get();
            return view('admin.trendPost.trendPost',compact('posts'));
        }

        //detail
        public function detail($id){
            $post=Post::where('id',$id)->first();
            return view('admin.trendPost.details',compact('post'));
        }
}
