<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::orderBy('nome')->get();

        return view('welcome', [
            'contactos' => $contactos,
        ]);
    }

    public function create()
    {
        return view('contactos.formulario', [
            'contactoEditar' => null,
        ]);
    }

    public function edit(Contacto $contacto)
    {
        return view('contactos.formulario', [
            'contactoEditar' => $contacto,
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
