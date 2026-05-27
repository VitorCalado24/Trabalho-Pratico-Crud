<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestao de Contactos</title>
    <link rel="stylesheet" href="{{ asset('css/contactos.css') }}">
</head>
<body>
    <main class="pagina">
        <div class="cabecalho">
            <h1>Lista de Contactos</h1>
            <a class="botao" href="{{ route('contactos.formulario') }}">Criar contacto</a>
        </div>

        @if (session('mensagem'))
            <div class="mensagem">{{ session('mensagem') }}</div>
        @endif

        @if ($contactos->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Alcunha</th>
                        <th>Telemovel</th>
                        <th>Email</th>
                        <th>Localidade</th>
                        <th>Observaçoes</th>
                        <th>Açoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactos as $contacto)
                        <tr>
                            <td>{{ $contacto->nome }}</td>
                            <td>{{ $contacto->alcunha }}</td>
                            <td>{{ $contacto->telemovel }}</td>
                            <td>{{ $contacto->email }}</td>
                            <td>{{ $contacto->localidade }}</td>
                            <td>{{ $contacto->observacoes }}</td>
                            <td>
                                <div class="acoes">
                                    <a class="botao botao-editar" href="{{ route('contactos.formulario-editar', $contacto) }}">Editar</a>

                                    <form method="POST" action="{{ route('contactos.eliminar', $contacto) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="botao-eliminar" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="sem-contactos">Ainda nao existem contactos.</div>
        @endif
    </main>
</body>
</html>
