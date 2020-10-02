<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index(Request $request)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()
                ->paginate($perPage);
            } else {
                $users = User::orderBy('id')->latest()->paginate($perPage);
            }

            return view('admin.users.index', compact('users'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            return view('admin.users.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            User::create($requestData);

            return redirect('admin/users')->with('flash_message', 'User added!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            $user = User::findOrFail($id);

            return view('admin.users.show', compact('user'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            $user = User::findOrFail($id);

            return view('admin.users.edit', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            $user = User::findOrFail($id);
            $user->update($requestData);

            return redirect('admin/users')->with('flash_message', 'User updated!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            User::destroy($id);

            return redirect('admin/users')->with('flash_message', 'User deleted!');
        }
    }
}
