@extends('mail.base', [
    'title' => ''
])

@section('icon', '🎉')

@section('body')
<!-- Título e subtítulo -->
<tr>
    <td class="hero-pad" style="padding:24px 40px 8px; text-align:center;">
        <h1 class="large-title" style="margin:0; font-size:28px; line-height:34px; font-weight:400; color:#222222;">
            Olá <strong>{{ $user->name }}</strong>, bem-vindo ao FlowChat!
        </h1>
        <p style="margin:12px 0 0; color:#7a8694; font-size:14px; line-height:20px;">
            Para começar a usar a FlowChat, confirme seu endereço de e-mail.
        </p>
    </td>
</tr>

<!-- Botão principal -->
<tr>
    <td align="center" style="padding:20px 40px 28px;">
        <a href="{{ route('user.confirm-account', ['user' => $user]) }}" target="_blank" style="display:inline-block; background-color:#00a6ff; color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:6px; font-weight:600; font-size:16px;">
            Abrir o FlowChat
        </a>
    </td>
</tr>

<!-- Link alternativo (texto simples) -->
<tr>
    <td style="padding:0 40px 22px; text-align:center; color:#9aa4ae; font-size:12px;">
        <p style="margin:0;">
            Não consegue clicar no botão? Copie e cole este link no seu navegador:
        </p>
        <p style="margin:8px 0 0; word-break:break-all;">
            <a href="{{ route('user.confirm-account', ['user' => $user]) }}" style="color:#1da1f2; text-decoration:none;">
                {{ route('user.confirm-account', ['user' => $user]) }}
            </a>
        </p>
    </td>
</tr>

<!-- Linha divisória -->
<tr>
    <td style="border-top:1px solid #eef1f4; padding:20px 40px 0;"></td>
</tr>

<!-- Três blocos (Discover / Become an investor / Support companies) -->
<tr>
    <td class="content" style="padding:18px 40px 28px;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <!-- Item 1 -->
                <td class="stack" width="33%" valign="top" style="padding:8px 8px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="width:44px; vertical-align:top;">
                                <div style="font-size:20px; line-height:20px; color:#00a6ff;">🔎</div>
                            </td>
                            <td style="padding-left:10px;">
                                <strong style="display:block; font-size:16px; color:#222;">Explorar conversas</strong>
                                <p style="margin:6px 0 0; color:#6d7780; font-size:13px; line-height:18px;">
                                    Descubra salas e tópicos ativos para trocar ideias em tempo real.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- Item 2 -->
                <td class="stack" width="33%" valign="top" style="padding:8px 8px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="width:44px; vertical-align:top;">
                                <div style="font-size:20px; line-height:20px; color:#00a6ff;">🎓</div>
                            </td>
                            <td style="padding-left:10px;">
                                <strong style="display:block; font-size:16px; color:#222;">Aprender e compartilhar</strong>
                                <p style="margin:6px 0 0; color:#6d7780; font-size:13px; line-height:18px;">
                                    Conecte-se com pessoas, troque experiências e amplie seu conhecimento.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- Item 3 -->
                <td class="stack" width="33%" valign="top" style="padding:8px 8px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="width:44px; vertical-align:top;">
                                <div style="font-size:20px; line-height:20px; color:#00a6ff;">🤝</div>
                            </td>
                            <td style="padding-left:10px;">
                                <strong style="display:block; font-size:16px; color:#222;">Construir comunidade</strong>
                                <p style="margin:6px 0 0; color:#6d7780; font-size:13px; line-height:18px;">
                                    Crie grupos, fortaleça conexões e apoie as pessoas que importam para você.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Rodapé: logo pequeno -->
<tr>
    <td style="background:#fbfdff; padding:18px 40px; text-align:center;">
        <div style="font-size:12px; color:#b7c1c9;">FlowChat</div>
    </td>
</tr>
@endsection
