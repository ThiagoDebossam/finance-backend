<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recuperação de Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Recuperação de Conta</h2>

    <p>Olá {{ $user->name }},</p>

    <p>Recebemos uma solicitação de recuperação de conta para o seu endereço de e-mail.</p>

    <p>Para redefinir sua senha, clique no link abaixo:</p>

    <p><a href="{{$url}}">Redefinir Senha</a></p>

    <p>Se você não solicitou a recuperação da conta, ignore este e-mail.</p>

    <p>Obrigado,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>