<!DOCTYPE html>
<html>
<head>
    <title>Quotation Confirmation</title>
</head>
<body>
    <h3>{{ $quotation->name }}, gracias por su mensaje!</h3>
    <p>Recibimos su consulta sobre:</p>
    <ul>
        @foreach ($quotation->tags as $tag)
            <li>{{ $tag }}</li>
        @endforeach
    </ul>
    <p>Le responderemos a la brevedad a su correo: {{ $quotation->email }} o a su teléfono {{ $quotation->phone }}.</p>
</body>
</html>