<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
            $keyword = $request->get('search');
            $perPage = 5;

            if (!empty($keyword)) {
                $clients = Client::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orderBy('id')
                ->latest()
                ->paginate($perPage);
            } else {
                $clients = Client::orderBy('id')->latest()->paginate($perPage);
            }

            return view('clients.index', compact('clients'));
    }

    public function show($id)
    {
            $client = Client::findOrFail($id);

            return view('clients.show', compact('client'));
    }
}
