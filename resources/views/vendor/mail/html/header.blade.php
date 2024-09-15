@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: flex;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://www.cotecmar.com/sites/default/files/media/imagenes/2021-12/CotecmarLogo.png" class="logo" alt="Cotecmar Logo"> --}}

{{-- <img src="{{ $message->embedData($qrCodeAsPng, 'qrcodeform.png') }}" /> --}}

{{-- <img src="{!!$message->embedData($qr, 'QrCode.png', 'image/png')!!}"> --}}
{{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('QrCode as PNG image!')) !!}" /> --}}
{{-- {!! QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!} --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
