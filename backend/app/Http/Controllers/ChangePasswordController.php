<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request)
    {
        return $this->getPasswordResetTableRow($request);
    }
    private function getPasswordResetTableRow($request)
    {
        return DB::table('password_reset')->where(['email' => $request->email, 'token'=>$request->resetToken]);
    }
}
