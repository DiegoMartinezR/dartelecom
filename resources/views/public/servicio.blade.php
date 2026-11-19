@php
    $servicioActual = $servicioParaHeader ?? null;
    $tituloLimpio = trim(preg_replace('/\s+/', ' ', str_replace(['*', '/'], ['', ' '], $servicioActual?->title ?? 'Servicios')));
    $metaTitulo = $servicioActual?->meta_title ?: ($tituloLimpio ? $tituloLimpio . ' | DarTelecom' : 'Servicios de Telecomunicaciones | DarTelecom');
    $metaDesc = $servicioActual?->meta_description ?: ($servicioActual?->descripcion_breve ? Str::limit(strip_tags($servicioActual->descripcion_breve), 155) : 'Soluciones integrales y servicios de telecomunicaciones para operadores ISP y empresas en Perú.');
    $metaKeywords = $servicioActual?->meta_keywords ?: null;
@endphp
@extends('components.public.matrix', ['pagina' => $servicioActual?->meta_title ?: ($tituloLimpio ?: 'Servicios')])

@section('titulo', $tituloLimpio ?: 'Servicios')
@section('meta_title', $metaTitulo)
@section('meta_description', $metaDesc)
@if(!empty($metaKeywords))
@section('meta_keywords', $metaKeywords)
@endif
@if(!empty($servicioActual?->meta_image))
@section('og_image', asset($servicioActual->meta_image))
@endif

@push('structured_data')
@if($servicioActual)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "{{ addslashes($tituloLimpio) }}",
  "description": "{{ addslashes(Str::limit(strip_tags($servicioActual->descripcion_breve ?? $tituloLimpio), 200)) }}",
  "provider": {
    "@type": "Organization",
    "name": "DarTelecom",
    "url": "{{ url('/') }}"
  },
  "areaServed": {
    "@type": "Country",
    "name": "Perú"
  },
  "url": "{{ route('servicios', $servicioActual->slug) }}"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Inicio",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Servicios",
      "item": "{{ route('servicios') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ addslashes($tituloLimpio) }}",
      "item": "{{ route('servicios', $servicioActual->slug) }}"
    }
  ]
}
</script>
@endif
@endpush
@section('css_importados')

    <style>
        .swiper-pagination_productos>.swiper-pagination-bullet-active {
            background-color: transparent;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            width: 20px;
            height: 20px;
            opacity: 1;
            background-image: url({{ asset('images/svg/image_29.svg') }});
        }

        .swiper-pagination_productos .swiper-pagination-bullet:not(.swiper-pagination-bullet-active) {
            background-color: transparent;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            width: 20px;
            height: 20px;
            opacity: 1;
            background-image: url({{ asset('images/svg/image_30.svg') }});
        }

        .swiper-button-next {
            background-color: #FFD9C7;
            background-repeat: no-repeat;
            background-position: center;
            width: calc(var(--swiper-navigation-size) / 29 * 27) !important;
            height: 50px;
            border-radius: 50%;
            transition: background-color 0.3s ease-in;
            background-image: url({{ asset('images/svg/image_43.svg') }})
        }

        .swiper-button-next:hover {
            background-color: #FF5E14;
            opacity: 1;
        }

        .swiper-button-prev {
            background-color: #FFD9C7;
            background-repeat: no-repeat;
            background-position: center;
            width: calc(var(--swiper-navigation-size) / 29 * 27) !important;
            height: 50px;
            border-radius: 50%;
            transition: background-color 0.3s ease-in;
            background-image: url({{ asset('images/svg/image_44.svg') }})
        }

        .swiper-button-prev:hover {
            background-color: #FF5E14;
            opacity: 1;
        }

        .slider-pagination {

            margin-bottom: 30px;
        }

        /* Estilo de los puntos de paginación */
        .slider-pagination .swiper-pagination-bullet {
            width: 16px;
            /* Ancho personalizado */
            height: 9px;
            /* Alto personalizado */
            border-radius: 6px;
            /* Bordes redondeados */
            background-color: #F07407 !important;
            /* Color base */
            transition: background-color 0.3s, transform 0.3s;
            /* Transiciones suaves */
        }

        /* Estilo de los puntos que no están activos */
        .slider-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active) {
            background-color: white !important;
            /* Color más tenue */
            opacity: 0.8;
            /* Opacidad constante */
        }

        #imagen-zona {
            transition: opacity 0.3s ease-in-out;
        }

        .blocker {
            z-index: 50 !important;
        }

        .comment.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .comment {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        /*ESTILOS PARA ESTA SE3CCION DAR TELECOM*/
        #descripcion_extensa>p {
            margin-bottom: 1rem;
        }

        /* En tu archivo CSS */
        aside nav ul li.active,
        aside nav .swiper-slide li.active {
            background-color: #ed1b2f !important;
            color: white !important;
            border: none !important;
        }

        aside nav ul li.active div,
        aside nav .swiper-slide li.active div {
            background-color: #FFFFFF !important;
        }

        /* Estilos para el carrusel de servicios en mobile */
        .servicios-swiper {
            padding: 0 !important;
            margin: 0 !important;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        .servicios-swiper .swiper-slide {
            height: auto;
            display: flex;
            justify-content: center;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        .servicios-swiper .swiper-slide li {
            height: 100%;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        /* Eliminar cualquier borde/outline del swiper activo */
        .servicios-swiper .swiper-slide-active,
        .servicios-swiper .swiper-slide-active li,
        .servicios-swiper .swiper-slide-next,
        .servicios-swiper .swiper-slide-prev {
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        /* CRÍTICO: Eliminar el shadow/border ROJO del slide activo de Swiper */
        .servicios-swiper .swiper-slide-active::before,
        .servicios-swiper .swiper-slide-active::after {
            display: none !important;
            content: none !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        /* Forzar transparencia en cualquier pseudo-elemento del swiper */
        .servicios-swiper .swiper-slide::before,
        .servicios-swiper .swiper-slide::after,
        .servicios-swiper .swiper-wrapper::before,
        .servicios-swiper .swiper-wrapper::after {
            display: none !important;
            content: none !important;
            border: 0 !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        /* Eliminar cualquier efecto visual adicional del slide activo */
        .servicios-swiper .swiper-slide-active {
            transform: none !important;
            filter: none !important;
            opacity: 1 !important;
            background: transparent !important;
        }

        /* Asegurar que el contenedor del swiper no tenga bordes */
        .servicios-swiper .swiper-container,
        .servicios-swiper.swiper {
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        /* Asegurar que no haya bordes en ningún estado del swiper */
        .servicios-swiper .swiper-wrapper,
        .servicios-swiper .swiper-container {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .servicios-next,
        .servicios-prev {
            width: 36px !important;
            height: 36px !important;
            margin-top: -18px !important;
            background-color: #ed1b2f !important;
            border-radius: 50% !important;
            color: white !important;
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .servicios-next:after,
        .servicios-prev:after {
            font-size: 16px !important;
            font-weight: bold !important;
        }

        .servicios-next {
            right: 5px !important;
        }

        .servicios-prev {
            left: 5px !important;
        }

        .servicios-next.swiper-button-disabled,
        .servicios-prev.swiper-button-disabled {
            opacity: 0.3 !important;
            visibility: visible !important;
        }

        /* Eliminar cualquier focus outline o borde del swiper */
        .servicios-swiper *:focus,
        .servicios-swiper *:focus-visible,
        .servicios-swiper *:active {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Resetear estilos específicos de Swiper que puedan causar bordes */
        .servicios-swiper .swiper-slide::before,
        .servicios-swiper .swiper-slide::after {
            display: none !important;
        }

        /* Eliminar el marco rojo del swiper completo */
        .servicios-swiper,
        .servicios-swiper .swiper-container,
        .servicios-swiper .swiper-wrapper,
        aside nav > div {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
        }

        /* AOS puede agregar efectos - eliminarlos del swiper */
        [data-aos].lg\\:hidden {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Forzar eliminación de TODOS los outlines, borders y shadows en el swiper de servicios */
        aside nav .lg\\:hidden *,
        aside nav .lg\\:hidden,
        aside nav .servicios-swiper *,
        aside nav .servicios-swiper {
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
        }

        /* Eliminar ring de Tailwind en focus */
        aside nav .servicios-swiper *:focus,
        aside nav .servicios-swiper *:focus-within,
        aside nav .servicios-swiper *:focus-visible {
            --tw-ring-shadow: 0 0 #0000 !important;
            --tw-ring-offset-shadow: 0 0 #0000 !important;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        /* Eliminar cualquier borde del aside completo en mobile */
        aside,
        aside nav,
        aside nav > *,
        aside .lg\\:hidden {
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
        }

        /* Eliminar COMPLETAMENTE el outline/shadow de focus y active en TODOS los elementos */
        aside *,
        aside *:focus,
        aside *:active,
        aside *:focus-visible,
        aside *:focus-within,
        .servicios-swiper,
        .servicios-swiper *,
        .servicios-swiper *:focus,
        .servicios-swiper *:active,
        .servicios-swiper *:focus-visible,
        .servicios-swiper li,
        .servicios-swiper li:focus,
        .servicios-swiper li:active,
        .servicios-swiper a,
        .servicios-swiper a:focus,
        .servicios-swiper a:active {
            outline: 0 !important;
            outline-width: 0 !important;
            outline-style: none !important;
            outline-color: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            -webkit-tap-highlight-color: transparent !important;
            --tw-ring-shadow: 0 0 #0000 !important;
            --tw-ring-offset-shadow: 0 0 #0000 !important;
            --tw-shadow: 0 0 #0000 !important;
            --tw-shadow-colored: 0 0 #0000 !important;
        }
    </style>



@stop


@section('content')
    <main class="bg-white">

        <!-- HERO SECTION: Estilo de Alta Fidelidad replicando el diseño visual de DarTelecom -->
        <section class="relative w-full bg-[#07132B] overflow-hidden pt-28 sm:pt-32 lg:pt-36 pb-14 sm:pb-16 lg:pb-20 min-h-[650px] flex flex-col justify-center" style="min-height: 650px;">
            
            <!-- Imagen Fotográfica en la Mitad Derecha con Fusión Degradada -->
            <div class="absolute inset-y-0 right-0 w-full lg:w-[58%] xl:w-[52%] h-full z-0 pointer-events-none select-none">
                <!-- Imagen del Servicio -->
                <img src="{{ !empty($servicioParaHeader?->imagen_principal) ? asset($servicioParaHeader->imagen_principal) : asset($servicioPage?->imagen ?? 'images/img/background/bg-contacto-torre.png') }}"
                     alt="{{ $servicioParaHeader?->title ?? 'Servicio DarTelecom' }}"
                     class="w-full h-full object-cover object-center lg:object-[center_right] opacity-75 lg:opacity-95" />
                
                <!-- Degradado de Fusión Suave Horizontal (De azul marino a transparente) -->
                <div class="hidden lg:block absolute inset-y-0 left-0 w-2/5 bg-gradient-to-r from-[#07132B] via-[#07132B]/80 to-transparent"></div>
                
                <!-- Degradado para Móvil (Oscurecimiento general para lectura impecable) -->
                <div class="lg:hidden absolute inset-0 bg-gradient-to-t from-[#07132B] via-[#07132B]/85 to-[#07132B]/60"></div>
                
                <!-- Degradado Superior para integración con Navbar -->
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-[#07132B]/90 to-transparent"></div>
            </div>

            <!-- Franja o Textura Curva Roja (Delante de la imagen en la esquina inferior derecha) -->
            <div class="absolute -bottom-1 right-0 pointer-events-none z-10 w-[220px] sm:w-[300px] md:w-[380px] lg:w-[460px] xl:w-[520px] overflow-hidden">
                <svg viewBox="0 0 520 420" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block transform translate-x-1 translate-y-1">
                    <defs>
                        <linearGradient id="redGradientSwoop" x1="140" y1="420" x2="520" y2="130" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#C8102E" />
                            <stop offset="40%" stop-color="#ED1B2F" />
                            <stop offset="100%" stop-color="#FF384D" />
                        </linearGradient>
                        <filter id="glowSwoop" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="-4" dy="-4" stdDeviation="12" flood-color="#ED1B2F" flood-opacity="0.35"/>
                        </filter>
                    </defs>
                    <!-- Curva roja distintiva de la marca DarTelecom -->
                    <path d="M 140 420 C 280 390, 420 280, 520 130 L 520 420 Z" 
                          fill="url(#redGradientSwoop)" 
                          filter="url(#glowSwoop)" />
                    <!-- Línea de borde luminosa interna para acabado premium -->
                    <path d="M 140 420 C 280 390, 420 280, 520 130" 
                          stroke="rgba(255, 255, 255, 0.45)" 
                          stroke-width="2.5" 
                          stroke-linecap="round" />
                </svg>
            </div>

            <!-- Contenido Principal (Columna Izquierda con Tipografía de Alto Impacto) -->
            <div class="w-11/12 lg:max-w-7xl mx-auto px-4 sm:px-6 relative z-20">
                <div class="w-full lg:w-[60%] xl:w-[55%] flex flex-col items-start justify-center text-left"
                     data-aos="fade-up" data-aos-duration="900" data-aos-offset="100">
                    
                    <!-- 1. Breadcrumb con Icono de Inicio -->
                    <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-300 font-medium mb-5 sm:mb-6" aria-label="Ruta de navegación">
                        <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center gap-1.5" title="Inicio">
                            <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('servicios') }}" class="hover:text-white transition-colors">Servicios</a>
                        <span class="text-slate-500 font-semibold">&gt;</span>
                        <span class="text-[#ED1B2F] font-bold">{{ $tituloLimpio ?: 'Servicio' }}</span>
                    </nav>

                    <!-- 2. Badge Píldora (Subtítulo / Categoría) -->
                    <div class="mb-4 sm:mb-5">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full border border-white/90 text-white font-bold text-xs sm:text-sm tracking-wider uppercase bg-white/5 backdrop-blur-sm shadow-sm">
                            {{ mb_strtoupper(trim(str_replace(['*', '/'], ['', ' '], $servicioParaHeader?->subtitle ?: ($servicioParaHeader?->title ?: 'Servicio Especializado')))) }}
                        </span>
                    </div>

                    <!-- 3. Título Principal (H1) con Resaltado en Rojo y Salto de Línea Personalizado -->
                    @php
                        $tituloRaw = $servicioParaHeader?->title ?? $servicioPage?->titulo ?? 'Servicios de Telecomunicaciones';
                        $hasCustomSyntax = (strpos($tituloRaw, '*') !== false) || (strpos($tituloRaw, '/') !== false);

                        if ($hasCustomSyntax) {
                            $escaped = e($tituloRaw);
                            // 1. Reemplazar slashes con <br /> primero para evitar colisión con el cierre </span>
                            $withBreaks = preg_replace('/\s*\/\s*/', '<br />', $escaped);
                            // 2. Reemplazar texto entre *asteriscos* con el color rojo de DarTelecom
                            $tituloHtml = preg_replace('/\*([^*]+)\*/', '<span class="text-[#ED1B2F] font-extrabold">$1</span>', $withBreaks);
                        } else {
                            if (preg_match('/\b(ISP)\b/i', $tituloRaw)) {
                                $tituloHtml = preg_replace('/\b(ISP)\b/i', '<span class="text-[#ED1B2F] font-extrabold">$1</span>', e($tituloRaw));
                            } else {
                                $words = explode(' ', e($tituloRaw));
                                if (count($words) > 1) {
                                    $lastWord = array_pop($words);
                                    $tituloHtml = implode(' ', $words) . ' <span class="text-[#ED1B2F] font-extrabold">' . $lastWord . '</span>';
                                } else {
                                    $tituloHtml = '<span class="text-[#ED1B2F] font-extrabold">' . e($tituloRaw) . '</span>';
                                }
                            }
                        }
                    @endphp
                    <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-[46px] xl:text-[52px] font-extrabold tracking-tight leading-[1.14] mb-5 sm:mb-6">
                        {!! $tituloHtml !!}
                    </h1>

                    <!-- 4. Descripción Breve -->
                    @if(!empty($servicioParaHeader?->descripcion_breve))
                    <p class="text-slate-200 text-sm sm:text-base md:text-lg font-normal leading-relaxed max-w-xl text-balance mb-6 sm:mb-8">
                        {{ $servicioParaHeader->descripcion_breve }}
                    </p>
                    @endif

                    <!-- 5. Botones de Acción (Cotizar & Ver Soluciones) -->
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                        <x-custom.button-cotizar :general="$general" text="COTIZAR SERVICIO" style="bg-[#ED1B2F] hover:bg-[#d81326] text-white px-7 py-3.5 rounded-full font-bold shadow-lg shadow-red-600/30 hover:shadow-red-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 text-sm uppercase tracking-wide inline-flex items-center gap-2 cursor-pointer" />
                        
                        @if($servicios && $servicios->count() > 0)
                        <a href="#subservicios-seccion" class="inline-flex items-center gap-2 border border-white/40 hover:border-white text-white font-semibold text-sm px-6 py-3.5 rounded-full hover:bg-white/10 transition-all duration-200">
                            <span>Ver especialidades</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </section>

        <!-- SECCIÓN: Descripción Extensa del Servicio (Acerca de este servicio) -->
        @if(!empty($servicioParaHeader?->descripcion_extensa))
        <section class="w-full bg-[#F8FAFC] border-b border-slate-200/80 py-10 lg:py-14 relative z-10">
            <div class="w-11/12 lg:max-w-7xl mx-auto px-4">
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 lg:p-10 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] relative overflow-hidden"
                     data-aos="fade-up" data-aos-duration="800">
                    <!-- Barra de acento roja vertical -->
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#ED1B2F]"></div>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-lg bg-red-50 text-[#ED1B2F] flex items-center justify-center font-bold text-sm">
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                        <h2 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-[#ED1B2F]">
                            Detalles y Alcance del Servicio
                        </h2>
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
                        {!! $servicioParaHeader->descripcion_extensa !!}
                    </div>
                </div>
            </div>
        </section>
        @endif

        <section id="subservicios-seccion" class="relative w-full bg-white">
            @if($servicios && $servicios->count() > 0)
            <div class="w-11/12 lg:max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-8 pt-8">
                <!-- Sidebar -->
                <aside class="lg:w-1/4">
                    <nav class="">
                        <!-- Desktop: Grid normal -->
                        <ul class="hidden lg:grid grid-cols-1 gap-4" data-aos="fade-up" data-aos-offset="150"
                            data-aos-duration="1000" data-aos-delay="200">
                            @foreach ($servicios as $index => $servicioItem)
                                <li data-slug="{{ $servicioItem->slug }}"
                                    class="cursor-pointer group rounded-xl flex items-center gap-4 p-4 text-text20 font-semibold bg-colorBackgroundAzulClaro hover:bg-colorBackgroundRed text-colorAzulOscuro hover:text-white transition-all duration-300 {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? 'active' : ($index === 0 && !isset($servicioSeleccionado) ? 'active' : '') }}">
                                    <div class="group-hover:hidden h-7 w-7 bg-black {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? 'hidden' : '' }}"
                                        style="mask-image: url('{{ asset($servicioItem->icono) }}'); mask-size: contain; mask-repeat: no-repeat;">
                                    </div>
                                    <div class="hidden group-hover:inline-block h-7 w-7 bg-white {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? '!inline-block' : '' }}"
                                        style="mask-image: url('{{ asset($servicioItem->icono) }}'); mask-size: contain; mask-repeat: no-repeat;">
                                    </div>
                                    <a href="#" class="servicio-link">{{ trim(str_replace(['*', '/'], ['', ' '], $servicioItem->title)) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <!-- Mobile: Swiper Carousel -->
                        <div class="lg:hidden" data-aos="fade-up" data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200" style="border: none !important; outline: none !important; box-shadow: none !important;">
                            <div class="swiper servicios-swiper" style="border: none !important; outline: none !important; box-shadow: none !important;">
                                <div class="swiper-wrapper" style="border: none !important; outline: none !important; box-shadow: none !important;">
                                    @foreach ($servicios as $index => $servicioItem)
                                        <div class="swiper-slide" style="border: none !important; outline: none !important; box-shadow: none !important;">
                                            <li data-slug="{{ $servicioItem->slug }}"
                                                class="cursor-pointer group rounded-xl flex items-center gap-3 p-3 text-text16 font-semibold bg-colorBackgroundAzulClaro hover:bg-colorBackgroundRed text-colorAzulOscuro hover:text-white transition-all duration-300 {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? 'active' : ($index === 0 && !isset($servicioSeleccionado) ? 'active' : '') }}"
                                                style="border: none !important; outline: none !important; box-shadow: none !important;">
                                                <div class="group-hover:hidden min-h-6 min-w-6 bg-black {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? 'hidden' : '' }}"
                                                    style="mask-image: url('{{ asset($servicioItem->icono) }}'); mask-size: contain; mask-repeat: no-repeat;">
                                                </div>
                                                <div class="hidden group-hover:inline-block h-6 w-6 bg-white {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicioItem->slug ? '!inline-block' : '' }}"
                                                    style="mask-image: url('{{ asset($servicioItem->icono) }}'); mask-size: contain; mask-repeat: no-repeat;">
                                                </div>
                                                <a href="#" class="servicio-link text-sm">{{ trim(str_replace(['*', '/'], ['', ' '], $servicioItem->title)) }}</a>
                                            </li>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Navegación del swiper -->
                                <div class="swiper-button-next servicios-next"></div>
                                <div class="swiper-button-prev servicios-prev"></div>
                            </div>
                        </div>
                    </nav>
                </aside>

                <!-- Main Content -->
                <main class="lg:w-3/4 max-w-full bg-white mb-16" id="main-content">
                    <!-- El contenido del primer subservicio se mostrará por defecto -->
                    @if($servicio)
                        @include('components.custom.component-servicio', $servicio)
                    @endif
                </main>
            </div>
            @else
            <div class="w-11/12 lg:max-w-3xl mx-auto px-4 text-center py-16">
                <div class="bg-gray-50 rounded-lg p-8" data-aos="fade-up" data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
                    <i class="fa-solid fa-info-circle text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Sin subservicios disponibles</h3>
                    <p class="text-gray-600">Este servicio aún no tiene subservicios configurados.</p>
                </div>
            </div>
            @endif

        </section>
    </main>







@section('scripts_importados')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar el carrusel de servicios para mobile
            const serviciosSwiper = new Swiper('.servicios-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                centeredSlides: true,
                // Desactivar efectos visuales que puedan causar el borde
                effect: 'slide',
                watchSlidesProgress: false,
                watchSlidesVisibility: false,
                navigation: {
                    nextEl: '.servicios-next',
                    prevEl: '.servicios-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        centeredSlides: false,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        centeredSlides: false,
                    }
                },
                // Eventos para forzar eliminación de estilos
                on: {
                    init: function() {
                        removeActiveStyles();
                        // Forzar visibilidad de los botones
                        showNavigationButtons();
                    },
                    slideChange: function() {
                        removeActiveStyles();
                    }
                }
            });

            // Función para forzar la visibilidad de los botones
            function showNavigationButtons() {
                setTimeout(() => {
                    const nextBtn = document.querySelector('.servicios-next');
                    const prevBtn = document.querySelector('.servicios-prev');
                    
                    if (nextBtn) {
                        nextBtn.style.display = 'flex';
                        nextBtn.style.visibility = 'visible';
                        nextBtn.style.opacity = '1';
                    }
                    if (prevBtn) {
                        prevBtn.style.display = 'flex';
                        prevBtn.style.visibility = 'visible';
                        prevBtn.style.opacity = '1';
                    }
                }, 100);
            }

            // Función para eliminar estilos del slide activo
            function removeActiveStyles() {
                setTimeout(() => {
                    const activeSlides = document.querySelectorAll('.servicios-swiper .swiper-slide-active');
                    activeSlides.forEach(slide => {
                        slide.style.border = '0';
                        slide.style.outline = '0';
                        slide.style.boxShadow = 'none';
                    });
                }, 10);
            }

            const sidebarItems = document.querySelectorAll('aside nav ul li, aside nav .swiper-slide li');
            const mainContent = document.getElementById('main-content');

            // Función para cargar el contenido del servicio
            function loadServicioContent(servicioSlug) {
                fetch(`/servicios/show/${servicioSlug}`)
                    .then(response => response.text())
                    .then(data => {
                        mainContent.innerHTML = data;
                        
                        // Disparar evento para que los componentes se reinicialicen
                        setTimeout(() => {
                            window.dispatchEvent(new CustomEvent('contenidoCargado'));
                        }, 100);
                    })
                    .catch(error => console.error('Error al cargar el servicio:', error));
            }

            // Manejar el clic en los elementos del sidebar
            sidebarItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Quitar el foco del elemento inmediatamente para evitar el outline
                    this.blur();
                    if (e.target) e.target.blur();
                    if (document.activeElement) document.activeElement.blur();

                    // Remover la clase 'active' de todos los elementos (desktop y mobile)
                    document.querySelectorAll('aside nav ul li, aside nav .swiper-slide li').forEach(i => i.classList.remove('active'));

                    // Agregar la clase 'active' al elemento seleccionado
                    item.classList.add('active');

                    // También sincronizar el estado activo entre desktop y mobile
                    const servicioSlug = item.getAttribute('data-slug');
                    document.querySelectorAll(`[data-slug="${servicioSlug}"]`).forEach(el => {
                        el.classList.add('active');
                    });

                    // Cargar contenido
                    loadServicioContent(servicioSlug);
                });
                
                // También manejar touchstart para mobile
                item.addEventListener('touchstart', function(e) {
                    setTimeout(() => {
                        this.blur();
                        if (document.activeElement) document.activeElement.blur();
                    }, 10);
                });
            });

            // Cargar el contenido del servicio seleccionado o el primer servicio por defecto
            if (sidebarItems.length > 0) {
                // Buscar si hay un servicio activo (seleccionado desde la URL)
                const activeItem = document.querySelector('aside nav ul li.active, aside nav .swiper-slide li.active');
                if (activeItem) {
                    const servicioSlug = activeItem.getAttribute('data-slug');
                    // Sync active state between desktop and mobile
                    document.querySelectorAll(`[data-slug="${servicioSlug}"]`).forEach(el => {
                        el.classList.add('active');
                    });
                    loadServicioContent(servicioSlug);
                } else {
                    // Si no hay activo, cargar el primer servicio
                    const firstItem = sidebarItems[0];
                    const servicioSlug = firstItem.getAttribute('data-slug');
                    // Sync active state between desktop and mobile
                    document.querySelectorAll(`[data-slug="${servicioSlug}"]`).forEach(el => {
                        el.classList.add('active');
                    });
                    loadServicioContent(servicioSlug);
                }
            }
        });
    </script>

@stop

@stop
