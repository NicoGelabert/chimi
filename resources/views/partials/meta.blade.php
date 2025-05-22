@props([
    'title' => 'Chimi Creativo. Agencia de Diseño y Branding',
    'description' => 'Chimi Creativo es un estudio especializado en diseño gráfico, desarrollo web y branding que transforma tus ideas en experiencias visuales impactantes. Ofrecemos soluciones personalizadas que destacan por su creatividad e innovación. Descubre cómo podemos impulsar tu marca y darle vida a tus proyectos con nuestro equipo de expertos en diseño y desarrollo.',
    'keywords' => 'estudio de diseño gráfico, desarrollo web, diseño de marca, branding, diseño web, agencia de diseño, diseño UX/UI, identidad visual, Málaga, diseño creativo, diseño de logotipos, marketing digital, soluciones creativas',
    'canonical' => url('/'),
    'type' => 'website',
])

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ is_array($keywords) ? implode(', ', $keywords) : $keywords }}">
<link rel="canonical" href="{{ $canonical }}">
