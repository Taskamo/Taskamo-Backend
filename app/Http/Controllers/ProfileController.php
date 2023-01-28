<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function update(ProfileRequest $request): JsonResponse
    {
        $profileName = '';
        if ($request['profile']) {
            $profileName = time() . '.' . $request['profile']->getClientOriginalExtension();
            $request['profile']->move(public_path('profile'), $profileName);
        }

        Auth()->user()->update([
            'name' => $request['name'] ? $request['name'] : auth()->user()->name,
            'profile' => $request['profile'] ? $profileName : null
        ]);

        return $this->success(auth()->user());
    }
}
