## Exemplo de controller no Laravel ACL

Vejamos um controller típico do ribafs/laravel-acl

## Controller Clients

```php
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index(Request $request)
    {
        $auth = Auth::user()->hasRole('super', 'manager', 'user');
        if((!$auth)){
            return view('home');
        }else{
            $keyword = $request->get('search');
            $perPage = 5;

            if (!empty($keyword)) {
                $clients = Client::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->orderBy('id')->paginate($perPage);
            } else {
                $clients = Client::latest()->orderBy('id')->paginate($perPage);
            }

            return view('admin.clients.index', compact('clients'));
        }
    }

    public function create()
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            return view('admin.clients.create');
        }
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            Client::create($requestData);

            return redirect('admin/clients')->with('flash_message', 'Client added!');
        }
    }

    public function show($id)
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            $client = Client::findOrFail($id);

            return view('admin.clients.show', compact('client'));
        }
    }

    public function edit($id)
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            $client = Client::findOrFail($id);

            return view('admin.clients.edit', compact('client'));
        }
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            
            $requestData = $request->all();
            
            $client = Client::findOrFail($id);
            $client->update($requestData);

            return redirect('admin/clients')->with('flash_message', 'Client updated!');
        }
    }

    public function destroy($id)
    {
        $auth = Auth::user()->hasRole('super', 'manager');
        if((!$auth)){
            return view('home');
        }else{
            Client::destroy($id);

            return redirect('admin/clients')->with('flash_message', 'Client deleted!');
        }
    }
}
```

## Usando o método can()

Então podemos controlar em nossos actions dos controller o acesso através das permissões dos usuários

Testar de o usuário logado pode usar a permissão all-all

    public function index(Request $request){
        if ($request->user()->can('all-all')) {
            return 'Seja muito bem vindo seu Super';
        }
    }

