<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindRankUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\helperTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use helperTrait;

    public function findRankWithBonus(FindRankUserRequest $request){

        $userId = $request->id;
        $per_page = $request->input('per_page', Config::get('constants.api_config.per_page'));

        config()->set('database.connections.mysql.strict', false);

        $resultWithRank_ = User::query()
            ->join('images','image_id','=','images.id')
            ->select(['users.*','images.url as url'])
            ->groupBy('users.id')
            ->selectRaw('RANK() OVER(ORDER BY karma_score desc) as rank_');

        $current = DB::table($resultWithRank_)->select('rank_')->find($userId);

        $usersCount = User::query()->count();

        $numberOfElementsBeforeSelected = $this->countNumberOfBeforeSelectedItems($current->rank_, $per_page, $usersCount);

        $output = DB::table($resultWithRank_)
            ->having('rank_' , '>=',  $current->rank_ - $numberOfElementsBeforeSelected)
            ->limit($per_page)
            ->get();

        return view('users', ["users" => $output, "currentId" => $userId]);
    }



    public function findRank(FindRankUserRequest $request){

        $userId = $request->id;

        config()->set('database.connections.mysql.strict', false);

        $resultWithRank_ = User::query()
            ->join('images','image_id','=','images.id')
            ->select(['users.*','images.url as url'])
            ->groupBy('users.id')
            ->selectRaw('RANK() OVER(ORDER BY karma_score desc) as rank_');

        $current = DB::table($resultWithRank_)->select('rank_')->find($userId);

        $output = DB::table($resultWithRank_)
            ->havingRaw('ABS(rank_ -'.$current->rank_.') <= 2')
            ->get();

        return $this->sendResponseResource(UserResource::collection($output));
    }

}
