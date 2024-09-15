<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invitación a Reunión</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
</head>

<body>
    <a href="http://www.cotecmar.com" target="_blank" noreferrer noopener nofollow>
        <img src="https://www.cotecmar.com/sites/default/files/media/imagenes/2021-12/CotecmarLogo.png"
            alt="Cotecmar Logo" type="logo" style="width: 100px; height: 100px;" />
    </a>
    <h1>Estimado Asistente</h1>
    <h3>Escanee el código Qr para ser direccionado al registro individual de asistencia: </h3>
    <br>
    <img
        src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->errorCorrection('L')->generate($ruta)) }}" />
    <br>
    <br>
    <p>Si tiene problemas con la lectura del código QR, por favor copie y pegue el siguiente enlace en su navegador web:
    </p>
    <br>
    <br>
    <button type="button">
        <a href="" target="_blank" noreferrer noopener nofollow>{{ $ruta }}</a>
    </button>
    <br>
    <br>
    <hr size="2px" color="black">
</body>
