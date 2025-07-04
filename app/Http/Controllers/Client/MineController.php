<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User2;

class MineController extends Controller
{
    public function index(){
        //return 'This is Dashboard';

         return view('client.mine');
    }
    public function setting(){
        return view('client.screens.setting');
    }
    public function profile(){
        return view('client.screens.profile');
    }
    public function invite_friend(){
        return view('client.screens.invite_friend');
    }
    public function virtualcurrency(){
        return view('client.screens.virtualcurrancy');
    }
    public function team(){
        $user = auth()->user();
        
        // Get direct referrals (Level 1)
        $level1Users = User2::where('refer_by', $user->refer_code)->get();
        
        // Get level 2 referrals
        $level2Users = User2::whereIn('refer_by', $level1Users->pluck('refer_code'))->get();
        
        // Get level 3 referrals
        $level3Users = User2::whereIn('refer_by', $level2Users->pluck('refer_code'))->get();
        
        // Calculate statistics
        $stats = [
            'team_amount' => $level1Users->sum('balance') + $level2Users->sum('balance') + $level3Users->sum('balance'),
            'agent_profit' => $user->refer_earn,
            'total_recharge' => \DB::table('deposit')
                ->whereIn('user_id', [
                    $user->id,
                    ...$level1Users->pluck('id'),
                    ...$level2Users->pluck('id'),
                    ...$level3Users->pluck('id')
                ])
                ->where('status', 'Success')
                ->sum('amount'),
            'total_withdraw' => \DB::table('withdraw')->whereIn('user_id', [
                $user->id,
                ...$level1Users->pluck('id'),
                ...$level2Users->pluck('id'),
                ...$level3Users->pluck('id')
            ])
            ->where('status', 'Success')
            ->sum('amount'),
            'order_commission' => $user->ref_earn ?? 0,
            'newcomers' => $level1Users->count() + $level2Users->count() + $level3Users->count(),
            'activities_number' => 0, // Add activities calculation if needed
            'team_number' => $level1Users->count() + $level2Users->count() + $level3Users->count()
        ];

        $teamData = [
            'level1' => $level1Users->map(function($user) {
                $referby_name = \App\Models\User2::where('refer_code', $user->refer_by)->value('name');
                return [
                    'name' => $user->name,
                    'balance' => $user->balance,
                    'total_deposit' => $user->total_deposit,
                    'total_withdraw' => $user->total_withdraw,
                    'joined_date' => $user->created_at,
                    'referby_name' => $referby_name
                ];
            }),
            'level2' => $level2Users->map(function($user) {
                $referby_name = \App\Models\User2::where('refer_code', $user->refer_by)->value('name');
                return [
                    'name' => $user->name,
                    'balance' => $user->balance,
                    'total_deposit' => $user->total_deposit,
                    'total_withdraw' => $user->total_withdraw,
                    'joined_date' => $user->created_at,
                    'referby_name' => $referby_name
                ];
            }),
            'level3' => $level3Users->map(function($user) {
                $referby_name = \App\Models\User2::where('refer_code', $user->refer_by)->value('name');
                return [
                    'name' => $user->name,
                    'balance' => $user->balance,
                    'total_deposit' => $user->total_deposit,
                    'total_withdraw' => $user->total_withdraw,
                    'joined_date' => $user->created_at,
                    'referby_name' => $referby_name
                ];
            })
        ];

        return view('client.screens.team', compact('stats', 'teamData'));
    }
}
