<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $contactos = Contacto::orderBy('nome')->get();
        $contactoEditar = null;

        if ($request->filled('editar')) {
            $contactoEditar = Contacto::find($request->query('editar'));
        }

        return view('welcome', [
            'contactos' => $contactos,
            'contactoEditar' => $contactoEditar,
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|max:255',
            'alcunha' => 'nullable|max:255',
            'telemovel' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'localidade' => 'nullable|max:255',
            'observacoes' => 'nullable',
        ]);

        Contacto::create($dados);

        return redirect()->route('inicio')->with('mensagem', 'Contacto criado com sucesso.');
    }

    public function update(Request $request, Contacto $contacto)
    {
        $dados = $request->validate([
            'nome' => 'required|max:255',
            'alcunha' => 'nullable|max:255',
            'telemovel' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'localidade' => 'nullable|max:255',
            'observacoes' => 'nullable',
        ]);

        $contacto->update($dados);

        return redirect()->route('inicio')->with('mensagem', 'Contacto editado com sucesso.');
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();

        return redirect()->route('inicio')->with('mensagem', 'Contacto eliminado com sucesso.');
    }
}
