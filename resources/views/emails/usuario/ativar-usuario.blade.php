<div style="background-color: #EEEEEE;">
    <table width="600px" cellpadding="20" cellspacing="20" align="center">
        <tr>
            <td>
                <div style="background-color: #FFFFFF; width: 600px; margin: 20px; padding: 30px;">
                    <div></div>
                    <div style="height: 1px; background-color: #CCCCCC; margin: 10px;"></div>
                    <h2>{{$data['name']}},</h2>
                    <p>Clique no link abaixo ou copia e cole a url no navegador para ativar o seu usuário.</p>
                    <br>
                    <p>
                        <h4 style="text-align: center;">
                            <a href="{{env('APP_URL')}}/api/activate-user/{{$data['id_usuario']}}/{{$data['hash']}}">
                                {{env('APP_URL')}}/api/activate-user/{{$data['id_usuario']}}/{{$data['hash']}}
                            </a>
                        </h4>
                    </p>
                    <br>
                </div>
            </td>
        </tr>
    </table>
</div>



{{--<p>{{$dados['nome']}},</p>
<p>Obrigado por entrar em contato conosco. Em breve iremos responder.</p>
<p>Atenciosamente,</p>
<p>{{$settings->titulo}}</p>--}}
