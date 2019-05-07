<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        if($request->return_users_count){
            $users_count = $users->count();
            return response()->json(
                [
                    'status' => 'success',
                    'users_count' => $users_count,
                ], 200);
        }
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($user->save()){
            return response([
                'status' => 'success',
                'data' => $user
            ]);
        }
        return response([
            'status' => 'error'
        ]);
    }
}