<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $contactoEditar ? 'Editar contacto' : 'Criar contacto' }}</title>
    <link rel="stylesheet" href="{{ asset('css/contactos.css') }}">
</head>
<body>
    <main class="pagina pagina-formulario">
        <h1>{{ $contactoEditar ? 'Editar contacto' : 'Criar contacto' }}</h1>

        @if ($errors->any())
            <div class="erro">
                @foreach ($errors->all() as $erro)
                    <div>{{ $erro }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ $contactoEditar ? route('contactos.editar', $contactoEditar) : route('contactos.criar') }}">
            @csrf

            @if ($contactoEditar)
                @method('PUT')
            @endif

            <div class="formulario">
                <div>
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" value="{{ old('nome', $contactoEditar->nome ?? '') }}" required>
                </div>

                <div>
                    <label for="alcunha">Alcunha</label>
                    <input id="alcunha" name="alcunha" value="{{ old('alcunha', $contactoEditar->alcunha ?? '') }}">
                </div>

                <div>
                    <label for="telemovel">Telemovel</label>
                    <input id="telemovel" name="telemovel" value="{{ old('telemovel', $contactoEditar->telemovel ?? '') }}">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $contactoEditar->email ?? '') }}">
                </div>

                <div class="campo-grande">
                    <label for="localidade">Localidade</label>
                    <input id="localidade" name="localidade" value="{{ old('localidade', $contactoEditar->localidade ?? '') }}">
                </div>

                <div class="campo-grande">
                    <label for="observacoes">Observacoes</label>
                    <textarea id="observacoes" name="observacoes">{{ old('observacoes', $contactoEditar->observacoes ?? '') }}</textarea>
                </div>

                <div class="campo-grande acoes">
                    <button type="submit">{{ $contactoEditar ? 'Guardar alteracoes' : 'Criar contacto' }}</button>
                    <a class="botao botao-cancelar" href="{{ route('inicio') }}">Cancelar</a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
