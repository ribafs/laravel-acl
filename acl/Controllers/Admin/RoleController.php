<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
                $roles = Role::where('name', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->latest()->orderBy('id')->paginate($perPage);
            } else {
                $roles = Role::latest()->orderBy('id')->paginate($perPage);
            }

            return view('admin.roles.index', compact('roles'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            return view('admin.roles.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            Role::create($requestData);

            return redirect('admin/roles')->with('flash_message', 'Role added!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            $role = Role::findOrFail($id);

            return view('admin.roles.show', compact('role'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            $role = Role::findOrFail($id);

            return view('admin.roles.edit', compact('role'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            $role = Role::findOrFail($id);
            $role->update($requestData);

            return redirect('admin/roles')->with('flash_message', 'Role updated!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasRole('super', 'admin');
        if((!$auth)){
            return view('home');
        }else{
            Role::destroy($id);

            return redirect('admin/roles')->with('flash_message', 'Role deleted!');
        }
    }
}
