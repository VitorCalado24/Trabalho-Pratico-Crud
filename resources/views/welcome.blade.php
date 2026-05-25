<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestao de Contactos</title>
    <style>
        :root {
            color-scheme: light;
            color: #1f2937;
            background: #f3f6fb;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(180deg, #eef4fb 0%, #f8fafc 100%);
            padding: 24px;
        }

        .pagina {
            max-width: 1080px;
            margin: 0 auto;
            padding: 28px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 55px rgba(15, 23, 42, 0.08);
        }

        h1,
        h2 {
            margin: 0;
            color: #111827;
        }

        h1 {
            font-size: clamp(2rem, 3vw, 2.6rem);
            letter-spacing: -0.03em;
            margin-bottom: 16px;
        }

        h2 {
            margin-top: 32px;
            margin-bottom: 18px;
            font-size: 1.25rem;
        }

        .mensagem,
        .erro,
        .sem-contactos {
            border-radius: 14px;
            padding: 16px 18px;
            margin: 16px 0;
            font-size: 0.97rem;
            line-height: 1.6;
            border: 1px solid transparent;
        }

        .mensagem {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .erro {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .formulario {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 8px;
        }

        .formulario > div {
            min-width: 0;
        }

        .campo-grande {
            grid-column: span 2;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        input,
        textarea {
            width: 100%;
            border-radius: 14px;
            border: 1px solid #d2d6dc;
            padding: 14px 16px;
            background: #f8fafc;
            color: #111827;
            font-size: 0.98rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
            background: #ffffff;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        button,
        .botao {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            color: #ffffff;
            background: #2563eb;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.18s ease, background-color 0.18s ease, box-shadow 0.18s ease;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.16);
        }

        button:hover,
        .botao:hover {
            transform: translateY(-1px);
            background-color: #1d4ed8;
        }

        .botao-editar {
            background: #059669;
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.16);
        }

        .botao-eliminar {
            background: #dc2626;
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.16);
        }

        .botao-cancelar {
            background: #6b7280;
            box-shadow: 0 8px 20px rgba(107, 114, 128, 0.16);
        }

        .botao-editar:hover {
            background: #047857;
        }

        .botao-eliminar:hover {
            background: #b91c1c;
        }

        .botao-cancelar:hover {
            background: #4b5563;
        }

        .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
        }

        th,
        td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            color: #111827;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 0.85rem;
        }

        tr:nth-child(even) td {
            background: #f8fafc;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .pagina > .erro,
        .pagina > .mensagem {
            margin-top: 0;
        }

        @media (max-width: 900px) {
            .formulario {
                grid-template-columns: 1fr;
            }

            .campo-grande {
                grid-column: span 1;
            }
        }

        @media (max-width: 720px) {
            body {
                padding: 16px;
            }

            .pagina {
                padding: 20px;
                border-radius: 18px;
            }

            th,
            td {
                padding: 12px 14px;
            }

            button,
            .botao {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="pagina">
        <h1>Gestao de Contactos</h1>

        @if (session('mensagem'))
            <div class="mensagem">{{ session('mensagem') }}</div>
        @endif

        @if ($errors->any())
            <div class="erro">
                @foreach ($errors->all() as $erro)
                    <div>{{ $erro }}</div>
                @endforeach
            </div>
        @endif

        <h2>{{ $contactoEditar ? 'Editar contacto' : 'Criar contacto' }}</h2>

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

                <div class="campo-grande">
                    <button type="submit">{{ $contactoEditar ? 'Guardar alteracoes' : 'Criar contacto' }}</button>

                    @if ($contactoEditar)
                        <a class="botao botao-cancelar" href="{{ route('inicio') }}">Cancelar</a>
                    @endif
                </div>
            </div>
        </form>

        <h2>Lista de Contactos</h2>

        @if ($contactos->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Alcunha</th>
                        <th>Telemovel</th>
                        <th>Email</th>
                        <th>Localidade</th>
                        <th>Observacoes</th>
                        <th>Acoes</th>
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
                                    <a class="botao botao-editar" href="{{ route('inicio', ['editar' => $contacto->id]) }}">Editar</a>

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
    </div>
</body>
</html>
