<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\User;

class HeaderComposer
{
    public function compose(View $view)
    {
        $countUnverifiedUsers = User::where('verified_by', null)->count();
        $getUnverifiedUsers = User::with('business')->where('verified_by', null)->get();
        $view->with([
            'countUnverifiedUsers' => $countUnverifiedUsers,
            'getUnverifiedUsers' => $getUnverifiedUsers,
        ]);
    }
}