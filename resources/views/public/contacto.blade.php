@extends('components.public.matrix', ['pagina' => 'Contacto'])

@section('titulo', 'Contacto')
@section('meta_title', 'Contáctanos | DarTelecom - Asesoría y Cotización de Equipos')
@section('meta_description', 'Ponte en contacto con DarTelecom. Atención especializada para operadores ISP, cotización de equipos y proyectos de infraestructura en Lince, Lima y todo el Perú.')
@section('meta_keywords', 'contacto dartelecom, cotizar equipos telecomunicaciones, asesorate isp lima peru, telefono dartelecom, lince')
@section('css_importados')

@stop


@section('content')
<main class="bg-gradient-to-b from-[#F4F8FC] via-white to-white relative overflow-hidden">

    <!-- Sección Principal de Contacto -->
    <section class="w-full relative pt-24 sm:pt-28 lg:pt-32 pb-16 lg:pb-24 overflow-hidden">
        <!-- Fondo de la sección que empieza desde la izquierda -->
        <div class="absolute inset-0 pointer-events-none select-none z-0">
            <img src="{{ asset('images/img/bannercontacto.png') }}" alt="Dar Telecom Fondo"
                class="w-full h-full object-cover object-left" />
        </div>

        <div class="w-11/12 lg:max-w-7xl mx-auto flex flex-col lg:flex-row items-start justify-between gap-10 lg:gap-12 relative z-10"
            data-aos="fade-up" data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
            
            <!-- Columna Izquierda: Información de contacto -->
            <div class="w-full lg:w-5/12 xl:w-5/12 flex flex-col justify-start">
                <div class="w-full max-w-lg flex flex-col justify-start items-start gap-6 lg:gap-8">
                    <div>
                        <h1 class="text-[#0E1D42] text-4xl sm:text-5xl font-extrabold tracking-tight">
                            {{ $contactoview->titleSection ?? 'Contáctanos' }}
                        </h1>
                        <p class="text-slate-600 text-base sm:text-lg font-normal leading-relaxed mt-4" data-aos="fade-down">
                            {{ $contactoview->subtitleSection ?? 'Queremos conocer tu proyecto y ayudarte a encontrar la mejor solución para tu red.' }}
                        </p>
                    </div>

                    <!-- Lista de Datos de Contacto -->
                    <div class="flex flex-col gap-6 w-full" data-aos="fade-down">
                        <!-- Horario de oficina -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-full bg-[#FEE4E2] text-[#ED1B2F] flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                                <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9" />
                                    <path stroke-linecap="round" d="M12 7v5l3 2" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-[#ED1B2F] font-bold text-base leading-snug">Horario de oficina</h4>
                                <p class="text-slate-600 text-sm leading-relaxed mt-0.5">
                                    {!! !empty($general->schedule) ? str_replace(',', '<br>', $general->schedule) : 'Lunes a viernes de 9:30 a. m. a 6:30 p. m.<br>y sábados de 9:00 a. m. a 1:00 p. m.' !!}
                                </p>
                            </div>
                        </div>

                        <!-- Nuestra dirección -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-full bg-[#FEE4E2] text-[#ED1B2F] flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                                <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4-4-7-7.5-7-11a7 7 0 1114 0c0 3.5-3 7-7 11z" />
                                    <circle cx="12" cy="10" r="2.5" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-[#ED1B2F] font-bold text-base leading-snug">Nuestra dirección</h4>
                                <p class="text-slate-600 text-sm leading-relaxed mt-0.5">
                                    {{ $general->address ?? 'Av. Francisco Lazo 1777' }} - {{ $general->district ?? 'Lince' }} - {{ $general->city ?? 'Lima' }}
                                </p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-full bg-[#FEE4E2] text-[#ED1B2F] flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                                <i class="fa-brands fa-whatsapp text-2xl leading-none"></i>
                            </div>
                            <div>
                                <h4 class="text-[#ED1B2F] font-bold text-base leading-snug">WhatsApp</h4>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $general->whatsapp ?? '51908931873') }}" target="_blank"
                                    class="text-slate-700 hover:text-[#ED1B2F] font-semibold text-sm leading-relaxed mt-0.5 inline-block transition-colors">
                                    {{ $general->whatsapp ?? '+51 908931873' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta informativa Atención especializada ISP -->
                    <div class="w-full bg-[#EAF5FC] border border-[#BAE6FD]/80 rounded-2xl p-4 sm:p-5 flex items-center gap-4 shadow-sm">
                        <div class="w-12 h-12 rounded-full bg-[#BAE6FD] text-[#0284C7] flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 16v-1a4 4 0 00-3.37-3.95A5.96 5.96 0 0114 12a6 6 0 016 6v1h-4zM4 16v-1a4 4 0 013.37-3.95A5.96 5.96 0 006 12a6 6 0 00-6 6v1h4z"/>
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-[#0E1D42] font-bold text-sm sm:text-base leading-tight">Atención especializada para ISP</h5>
                            <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-snug">
                                Nos enfocamos en atender las necesidades de operadores ISP y proyectos de telecomunicaciones.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Card Formulario "Envíanos tu consulta" -->
            <div class="w-full lg:w-7/12 xl:w-7/12">
                <div class="bg-white rounded-3xl p-6 sm:p-8 lg:p-10 shadow-[0_15px_50px_-12px_rgba(0,0,0,0.08)] border border-slate-100/90 relative">
                    <h2 class="text-[#0E1D42] text-2xl sm:text-3xl lg:text-[34px] font-extrabold tracking-tight">
                        {{ $contactoview->titleForm ?? 'Envíanos tu consulta' }}
                    </h2>
                    <p class="text-slate-500 text-sm sm:text-base leading-relaxed mt-2 mb-6 sm:mb-8">
                        {{ $contactoview->subtitleForm ?? 'Completa tus datos y cuéntanos en qué podemos ayudarte. Nuestro equipo se pondrá en contacto contigo a la brevedad.' }}
                    </p>

                    <form id="formContactos" method="POST" action="{{ route('guardarContactos') }}" class="space-y-4 sm:space-y-5">
                        @csrf
                        
                        <!-- Inputs ocultos para analítica de dispositivo y captura técnica -->
                        <input type="hidden" name="sistema" id="sistema" value="" />
                        <input type="hidden" name="dispositivo" id="dispositivo" value="" />
                        <input type="hidden" name="latitud" id="latitud" value="" />
                        <input type="hidden" name="longitud" id="longitud" value="" />
                        <input type="hidden" name="llegade" id="llegade" value="" />
                        <input type="hidden" name="anchodispositivo" id="anchodispositivo" value="" />
                        <input type="hidden" name="largodispositivo" id="largodispositivo" value="" />

                        <!-- Fila 1: Nombres y apellidos + Empresa / Razón social -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                            <div>
                                <label for="full_name" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                    Nombres y apellidos <span class="text-red-500">*</span>
                                </label>
                                <input id="full_name" type="text" name="full_name" required placeholder="Ingresa tu nombre completo"
                                    class="w-full text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none placeholder:text-slate-400" />
                                <p id="error-full_name" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                            </div>

                            <div>
                                <label for="company" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                    Empresa / Razón social <span class="text-red-500">*</span>
                                </label>
                                <input id="company" type="text" name="company" required placeholder="Ingresa el nombre de tu empresa"
                                    class="w-full text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none placeholder:text-slate-400" />
                                <p id="error-company" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                            </div>
                        </div>

                        <!-- Fila 2: Correo corporativo + Teléfono / WhatsApp -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                            <div>
                                <label for="email" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                    Correo corporativo <span class="text-red-500">*</span>
                                </label>
                                <input id="email" type="email" name="email" required placeholder="tu@empresa.com"
                                    class="w-full text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none placeholder:text-slate-400" />
                                <p id="error-email" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                            </div>

                            <div>
                                <label for="phone" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                    Teléfono / WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input id="phone" type="tel" name="phone" required placeholder="+51 900 000 000"
                                    class="w-full text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none placeholder:text-slate-400" />
                                <p id="error-phone" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                            </div>
                        </div>

                        <!-- Fila 3: Ciudad / Región -->
                        <div>
                            <label for="city" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                Ciudad / Región <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="city" name="city" required
                                    class="w-full appearance-none text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none cursor-pointer">
                                    <option value="" disabled selected>Selecciona tu ciudad / región</option>
                                    <option value="Lima">Lima</option>
                                    <option value="Arequipa">Arequipa</option>
                                    <option value="Cusco">Cusco</option>
                                    <option value="La Libertad / Trujillo">La Libertad / Trujillo</option>
                                    <option value="Lambayeque / Chiclayo">Lambayeque / Chiclayo</option>
                                    <option value="Piura">Piura</option>
                                    <option value="Junín / Huancayo">Junín / Huancayo</option>
                                    <option value="Áncash / Chimbote">Áncash / Chimbote</option>
                                    <option value="Ica">Ica</option>
                                    <option value="San Martín / Tarapoto">San Martín / Tarapoto</option>
                                    <option value="Loreto / Iquitos">Loreto / Iquitos</option>
                                    <option value="Puno / Juliaca">Puno / Juliaca</option>
                                    <option value="Tacna">Tacna</option>
                                    <option value="Cajamarca">Cajamarca</option>
                                    <option value="Ucayali / Pucallpa">Ucayali / Pucallpa</option>
                                    <option value="Huánuco">Huánuco</option>
                                    <option value="Ayacucho">Ayacucho</option>
                                    <option value="Madre de Dios">Madre de Dios</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Apurímac">Apurímac</option>
                                    <option value="Huancavelica">Huancavelica</option>
                                    <option value="Moquegua">Moquegua</option>
                                    <option value="Pasco">Pasco</option>
                                    <option value="Tumbes">Tumbes</option>
                                    <option value="Otra región">Otra región</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p id="error-city" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                        </div>

                        <!-- Fila 4: ¿Cómo podemos ayudarte? (4 opciones interactivas tipo cards) -->
                        <div>
                            <label class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-2">
                                ¿Cómo podemos ayudarte? <span class="text-red-500">*</span>
                            </label>
                            
                            <!-- Campo hidden con el valor seleccionado -->
                            <input type="hidden" name="service_product" id="service_product" value="Comprar equipos" />

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <!-- Card 1: Comprar equipos (seleccionada por defecto) -->
                                <button type="button" data-value="Comprar equipos"
                                    class="service-option-card border-2 border-[#ED1B2F] bg-[#FFF5F5] text-[#ED1B2F] rounded-2xl p-3.5 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200 min-h-[96px] shadow-sm hover:shadow">
                                    <svg class="w-6 h-6 mb-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm font-bold leading-tight">Comprar<br>equipos</span>
                                </button>

                                <!-- Card 2: Mejorar infraestructura -->
                                <button type="button" data-value="Mejorar infraestructura"
                                    class="service-option-card border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/60 rounded-2xl p-3.5 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200 min-h-[96px]">
                                    <svg class="w-6 h-6 mb-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm font-semibold leading-tight">Mejorar<br>infraestructura</span>
                                </button>

                                <!-- Card 3: Contratar un servicio -->
                                <button type="button" data-value="Contratar un servicio"
                                    class="service-option-card border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/60 rounded-2xl p-3.5 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200 min-h-[96px]">
                                    <svg class="w-6 h-6 mb-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <span class="text-xs sm:text-sm font-semibold leading-tight">Contratar<br>un servicio</span>
                                </button>

                                <!-- Card 4: Necesito asesoría -->
                                <button type="button" data-value="Necesito asesoría"
                                    class="service-option-card border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/60 rounded-2xl p-3.5 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200 min-h-[96px]">
                                    <svg class="w-6 h-6 mb-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-xs sm:text-sm font-semibold leading-tight">Necesito<br>asesoría</span>
                                </button>
                            </div>
                        </div>

                        <!-- Fila 5: Cuéntanos más sobre tu proyecto -->
                        <div>
                            <label for="message" class="block text-[#0E1D42] text-xs sm:text-sm font-semibold mb-1.5">
                                Cuéntanos más sobre tu proyecto <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" required rows="3"
                                placeholder="Escríbenos tu consulta, requerimiento o detalle del proyecto..."
                                class="w-full text-sm sm:text-base px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ED1B2F]/20 focus:border-[#ED1B2F] transition duration-200 outline-none placeholder:text-slate-400 resize-none min-h-[96px]"></textarea>
                            <p id="error-message" class="hidden text-xs text-red-500 mt-1 font-medium"></p>
                        </div>

                        <!-- Fila 6: Botones de Acción (Enviar consulta + Continuar por WhatsApp) -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-2">
                            <!-- Botón 1: Enviar consulta -->
                            <button type="submit" id="btnSubmitContact"
                                class="flex-1 bg-[#ED1B2F] hover:bg-[#d81326] active:scale-[0.99] text-white font-bold py-3.5 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2.5 text-base cursor-pointer">
                                <svg class="w-5 h-5 fill-current transform -rotate-45" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                </svg>
                                <span>Enviar consulta</span>
                            </button>

                            <!-- Botón 2: Continuar por WhatsApp -->
                            <a id="btnWhatsAppDirect" href="https://wa.me/51908931873" target="_blank"
                                class="flex-1 bg-white hover:bg-emerald-50 active:scale-[0.99] text-[#107C41] font-bold py-3.5 px-6 rounded-xl border-2 border-[#25D366] transition-all duration-200 flex items-center justify-center gap-2.5 text-base shadow-sm cursor-pointer">
                                <i class="fa-brands fa-whatsapp text-2xl text-[#25D366]"></i>
                                <span>Continuar por WhatsApp</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!--Seccion FAQs-->
    <section class="w-11/12 lg:max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 mt-12" data-aos="fade-up"
        data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
        <div class="w-full lg:w-1/2">
            <h2 class="text-text32 font-bold text-colorAzulOscuro">{{ $contactoview->titleFaqs }}</h2>
            <p class="text-colorParrafo font-light text-text16">{{ $contactoview->subtitleFaqs }}</p>
        </div>
        <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
            @foreach ($faqs as $faq)
            <div x-data="{ open: false }" class="border-b pb-4">
                <!-- Pregunta -->
                <h4 @click="open = !open"
                    class="cursor-pointer flex justify-between items-center text-text16 font-semibold text-colorRojo py-3">
                    {{ $faq->pregunta }}

                    <div class="h-6 w-6 border-2 border-[#ed1b2f] rounded-full flex items-center justify-center">
                        <i x-show="!open" class="fa-solid fa-plus"></i>
                        <i x-show="open" class="fa-solid fa-minus"></i>
                    </div>

                </h4>
                <!-- Respuesta -->
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                    class="text-gray-500 overflow-hidden">
                    <p class="pt-3">
                        {{ $faq->respuesta }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!--Seccion Contactar-->
    <section class="w-11/12 lg:max-w-7xl mx-auto py-12" data-aos="fade-up" data-aos-offset="150"
        data-aos-duration="1000" data-aos-delay="200">
        <section class="bg-colorBackgroundAzulClaro rounded-xl p-8 w-full relative overflow-hidden z-0 ">
            <div class="absolute -left-16  transform  rotate-[85deg] -z-10">
                <img src="{{ asset('images/img/background/bg-footer.png') }}" alt="" class="w-full"
                    style=" filter: opacity(10%);">
            </div>
            <div class="mt-6 flex justify-center items-center z-20">
                <div x-data="carousel()" class="w-full flex justify-center items-center relative overflow-hidden">
                    <!-- Contenedor de las imágenes -->
                    <div class="relative flex w-[300px] h-[100px] justify-center items-center">
                        <template x-for="(image, index) in visibleImages" :key="index">
                            <div class="absolute transition-all duration-1000 flex items-center justify-center "
                                :class="{
                                        'w-14 h-14 z-10 left-1/2 transform -translate-x-1/2': index === 1,
                                        /* Imagen central */
                                        'w-12 h-12 z-0 opacity-80 left-1/4': index === 0,
                                        /* Izquierda */
                                        'w-12 h-12 z-0 opacity-80 right-1/4': index === 2 /* Derecha */
                                    }">
                                <img :src="image.image" alt="Imagen"
                                    class="object-cover w-full h-full rounded-full border-2 border-white bg-colorBackgroundAzulOscuro">
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <script>
                function carousel() {
                    return {
                        images: [],
                        currentIndex: 0,
                        get visibleImages() {
                            let total = this.images.length;
                            if (total < 3) return this.images; // Si hay menos de 3 imágenes, mostrarlas todas
                            let prev = (this.currentIndex - 1 + total) % total;
                            let next = (this.currentIndex + 1) % total;
                            return [this.images[prev], this.images[this.currentIndex], this.images[next]];
                        },
                        async init() {
                            const response = await fetch('/imagenes');
                            this.images = await response.json();
                            this.startAutoSlide();
                        },
                        startAutoSlide() {
                            setInterval(() => {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                            }, 3000); // Cambia cada 3 segundos
                        }
                    }
                }
            </script>

            <div class="text-center max-w-md mx-auto z-20" data-aos="fade-up" data-aos-offset="150"
                data-aos-duration="1000" data-aos-delay="200">
                <h2 class="text-text24 font-semibold text-colorAzulOscuro">{{ $contactoview->titleSlider }}</h2>
                <p class="text-colorParrafo mt-2 text-text16">{{ $contactoview->subtitleSlider }}</p>
            </div>

            <div class="mt-6 text-center z-20" data-aos="fade-up" data-aos-offset="150" data-aos-duration="1000"
                data-aos-delay="200">

                <x-custom.button-cotizar :general="$general" text="Ponerse en contacto"
                    style=" bg-colorBackgroundRed text-white px-6 py-3 rounded-full hover:bg-colorBackgroundRed transition duration-300" />
            </div>


        </section>


    </section>
    <!-- Modal -->
    <div id="modalDarTelecom"
        class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6  w-[600px] h-[650px] relative rounded-xl overflow-hidden">
            <video class="absolute top-0 left-0 w-full h-full object-cover" autoplay loop muted>
                <source src="{{ asset('images/img/background/backgroundInicio.mp4') }}" type="video/mp4" />
                Tu navegador no soporta la reproducción de videos.
            </video>
            <div
                class="absolute inset-0 bg-transparent bg-opacity-50 flex flex-col mt-24 justify-start items-center text-white text-center">
                <img src="{{ asset('images/img/logo/DarTelecom.png') }}" alt="Dar Telecom"
                    class="h-14 w-auto object-cover mb-6" />
                <h2 class="text-text28 font-bold">¡Gracias por escribirnos!</h2>
                <p id="text-nombre" class="mt-2 font-medium">¡Hola [Nombre del Cliente]!</p>
                <p class="mt-2 font-medium">En breve nos estaremos comunicando contigo.</p>
                <button onclick="document.getElementById('modalDarTelecom').classList.add('hidden');"
                    class="bg-colorBackgroundRed cursor-pointer mt-4  hover:bg-colorBackgroundRed text-white font-semibold py-3 rounded-full px-5 text-base">
                    Visita nuestra Web
                </button>
            </div>
            <div class="absolute left-0  bottom-20 transform translate-y-1/2">
                <img src="{{ asset('images/img/background/bg-cable.png') }}" alt="" class="w-96">
            </div>
        </div>

    </div>
    </div>
</main>


@section('scripts_importados')
<script>
    // Captura técnica avanzada del cliente (Dispositivo, Navegador, Sistema Operativo, Pantalla y Red)
    (function capturarTelemetriaCliente() {
        const ua = navigator.userAgent || '';

        // 1. Detección precisa de Sistema Operativo
        let os = 'Desconocido';
        if (/windows nt 10/i.test(ua)) os = 'Windows 10/11';
        else if (/windows nt 6.3/i.test(ua)) os = 'Windows 8.1';
        else if (/windows nt 6.2/i.test(ua)) os = 'Windows 8';
        else if (/windows nt 6.1/i.test(ua)) os = 'Windows 7';
        else if (/android/i.test(ua)) {
            const m = ua.match(/android\s([0-9\.]+)/i);
            os = m ? 'Android ' + m[1] : 'Android';
        } else if (/iphone/i.test(ua)) {
            const m = ua.match(/os\s([0-9\_]+)/i);
            os = m ? 'iOS ' + m[1].replace(/_/g, '.') : 'iOS (iPhone)';
        } else if (/ipad/i.test(ua)) {
            os = 'iPadOS';
        } else if (/macintosh|mac os x/i.test(ua)) {
            os = 'macOS';
        } else if (/linux/i.test(ua)) {
            os = 'Linux';
        } else if (/cros/i.test(ua)) {
            os = 'Chrome OS';
        }

        // 2. Detección precisa de Navegador y versión principal
        let browser = 'Desconocido';
        if (/edg/i.test(ua)) {
            const m = ua.match(/edg\/([0-9\.]+)/i);
            browser = 'Edge ' + (m ? m[1].split('.')[0] : '');
        } else if (/opr|opera/i.test(ua)) {
            const m = ua.match(/(opr|opera)\/([0-9\.]+)/i);
            browser = 'Opera ' + (m ? m[2].split('.')[0] : '');
        } else if (/samsungbrowser/i.test(ua)) {
            const m = ua.match(/samsungbrowser\/([0-9\.]+)/i);
            browser = 'Samsung Internet ' + (m ? m[1].split('.')[0] : '');
        } else if (/chrome|crios/i.test(ua) && !/edg/i.test(ua)) {
            const m = ua.match(/chrome\/([0-9\.]+)/i);
            browser = 'Chrome ' + (m ? m[1].split('.')[0] : '');
        } else if (/safari/i.test(ua) && !/chrome/i.test(ua)) {
            const m = ua.match(/version\/([0-9\.]+)/i);
            browser = 'Safari ' + (m ? m[1].split('.')[0] : '');
        } else if (/firefox|fxios/i.test(ua)) {
            const m = ua.match(/firefox\/([0-9\.]+)/i);
            browser = 'Firefox ' + (m ? m[1].split('.')[0] : '');
        }

        // 3. Detección de Dispositivo (Mobile, Tablet o Desktop)
        let device = 'desktop';
        const isMobile = /android|iphone|ipod|blackberry|iemobile|opera mini/i.test(ua);
        const isTablet = /ipad|android(?!.*mobile)|tablet/i.test(ua);
        if (isMobile) {
            device = 'mobile';
        } else if (isTablet) {
            device = 'tablet';
        } else if (window.innerWidth <= 768) {
            device = 'mobile';
        }

        // 4. Idioma y Zona Horaria
        const lang = navigator.language || navigator.userLanguage || 'es';
        let timezone = '';
        try {
            timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        } catch (e) {
            timezone = '';
        }

        const clientSystemFormatted = `${os} | ${browser}` + (timezone ? ` (${timezone}, ${lang})` : ` (${lang})`);

        // Asignación segura a los inputs ocultos
        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val;
        };

        setVal('sistema', clientSystemFormatted);
        setVal('dispositivo', device);
        setVal('anchodispositivo', window.screen.width || window.innerWidth);
        setVal('largodispositivo', window.screen.height || window.innerHeight);
        setVal('llegade', document.referrer || 'Acceso directo');

        // 5. Geolocalización (si el usuario la autoriza, no invasiva)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    setVal('latitud', pos.coords.latitude.toFixed(6));
                    setVal('longitud', pos.coords.longitude.toFixed(6));
                },
                function() {
                    // Silencioso si no se permite
                },
                { timeout: 5000, maximumAge: 60000 }
            );
        }
    })();
</script>

<script>
    function alerta(message) {
        Swal.fire({
            title: message,
            icon: "error",
        });
    }

    // Validación unificada del formulario de contacto
    function validarFormularioContacto() {
        let esValido = true;
        let primerErrorEl = null;

        // Limpiar errores previos
        const campos = ['full_name', 'company', 'email', 'phone', 'city', 'message'];
        campos.forEach(campo => {
            const el = document.getElementById(campo);
            const errEl = document.getElementById('error-' + campo);
            if (el) {
                el.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                el.classList.add('border-slate-200');
            }
            if (errEl) {
                errEl.classList.add('hidden');
                errEl.textContent = '';
            }
        });

        const marcarError = (campoId, mensaje) => {
            const el = document.getElementById(campoId);
            const errEl = document.getElementById('error-' + campoId);
            if (el) {
                el.classList.remove('border-slate-200');
                el.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                if (!primerErrorEl) {
                    primerErrorEl = el;
                }
            }
            if (errEl) {
                errEl.textContent = mensaje;
                errEl.classList.remove('hidden');
            }
            esValido = false;
        };

        // 1. Nombre completo
        const fullName = ($('#full_name').val() || '').trim();
        if (!fullName) {
            marcarError('full_name', 'Por favor ingresa tus nombres y apellidos.');
        } else if (fullName.length < 3) {
            marcarError('full_name', 'El nombre debe tener al menos 3 caracteres.');
        }

        // 2. Empresa / Razón social
        const company = ($('#company').val() || '').trim();
        if (!company) {
            marcarError('company', 'Por favor ingresa el nombre de tu empresa o razón social.');
        } else if (company.length < 2) {
            marcarError('company', 'El nombre de empresa debe tener al menos 2 caracteres.');
        }

        // 3. Correo corporativo
        const email = ($('#email').val() || '').trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            marcarError('email', 'Por favor ingresa tu correo electrónico corporativo.');
        } else if (!emailRegex.test(email)) {
            marcarError('email', 'Por favor ingresa un correo electrónico válido (ej: contacto@empresa.com).');
        }

        // 4. Teléfono / WhatsApp
        const phone = ($('#phone').val() || '').trim();
        const cleanDigits = phone.replace(/\D/g, '');
        if (!phone) {
            marcarError('phone', 'Por favor ingresa tu número de teléfono o WhatsApp.');
        } else if (cleanDigits.length < 9) {
            marcarError('phone', 'El teléfono debe contener al menos 9 dígitos.');
        }

        // 5. Ciudad / Región
        const city = ($('#city').val() || '').trim();
        if (!city) {
            marcarError('city', 'Por favor selecciona tu ciudad o región.');
        }

        // 6. Mensaje / Consulta
        const message = ($('#message').val() || '').trim();
        if (!message) {
            marcarError('message', 'Por favor cuéntanos sobre tu requerimiento o proyecto.');
        } else if (message.length < 5) {
            marcarError('message', 'El mensaje debe tener al menos 5 caracteres.');
        }

        if (!esValido) {
            if (primerErrorEl) {
                primerErrorEl.focus();
            }
            Swal.fire({
                title: 'Completa los campos obligatorios',
                text: 'Para continuar, es necesario completar toda la información requerida (*).',
                icon: 'warning',
                confirmButtonColor: '#ED1B2F',
                confirmButtonText: 'Entendido'
            });
        }

        return esValido;
    }

    // Limpieza reactiva de errores al escribir o cambiar valores
    $(document).ready(function() {
        ['full_name', 'company', 'email', 'phone', 'city', 'message'].forEach(campo => {
            $('#' + campo).on('input change', function() {
                $(this).removeClass('border-red-500 focus:border-red-500 focus:ring-red-500/20').addClass('border-slate-200');
                $('#error-' + campo).addClass('hidden').text('');
            });
        });
    });

    // Interacción para tarjetas de "¿Cómo podemos ayudarte?"
    $('.service-option-card').click(function(e) {
        e.preventDefault();
        
        // Deseleccionar todas
        $('.service-option-card')
            .removeClass('border-2 border-[#ED1B2F] bg-[#FFF5F5] text-[#ED1B2F] shadow-sm')
            .addClass('border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/60');
        $('.service-option-card span')
            .removeClass('font-bold')
            .addClass('font-semibold');

        // Seleccionar la actual
        $(this)
            .removeClass('border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/60')
            .addClass('border-2 border-[#ED1B2F] bg-[#FFF5F5] text-[#ED1B2F] shadow-sm');
        $(this).find('span')
            .removeClass('font-semibold')
            .addClass('font-bold');

        const selectedValue = $(this).data('value');
        $('#service_product').val(selectedValue);
    });

    // Botón Continuar por WhatsApp: valida formulario, registra en BD y abre WhatsApp estructurado
    $('#btnWhatsAppDirect').click(function(e) {
        e.preventDefault();

        // 1. Validar que todos los campos requeridos estén completos
        if (!validarFormularioContacto()) {
            return false;
        }

        const formData = $('#formContactos').serialize();
        const whatsappNumber = "{{ preg_replace('/[^0-9]/', '', $general->whatsapp ?? '51908931873') }}";

        // Abrir pestaña para evitar bloqueo de popups del navegador
        const newTab = window.open('about:blank', '_blank');

        Swal.fire({
            title: 'Conectando con WhatsApp...',
            text: 'Estamos registrando tu consulta para brindarte atención inmediata.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Registrar en segundo plano en la BD y obtener URL estructurada del servidor
        $.ajax({
            url: "{{ route('guardarContactoWsp') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                Swal.close();
                if (response && response.whatsapp_url) {
                    if (newTab && !newTab.closed) {
                        newTab.location.href = response.whatsapp_url;
                    } else {
                        window.location.href = response.whatsapp_url;
                    }
                } else {
                    const fallbackUrl = 'https://api.whatsapp.com/send?phone=' + whatsappNumber;
                    if (newTab && !newTab.closed) {
                        newTab.location.href = fallbackUrl;
                    } else {
                        window.location.href = fallbackUrl;
                    }
                }
            },
            error: function(xhr) {
                Swal.close();
                if (newTab && !newTab.closed) {
                    newTab.close();
                }

                if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.message) {
                    const errors = xhr.responseJSON.message;
                    const firstError = typeof errors === 'string' ? errors : (Array.isArray(errors) ? errors[0] : Object.values(errors)[0][0]);
                    Swal.fire({
                        title: 'Datos incompletos',
                        text: firstError,
                        icon: 'warning',
                        confirmButtonColor: '#ED1B2F'
                    });
                } else {
                    Swal.fire({
                        title: 'Error de conexión',
                        text: 'No pudimos registrar tu consulta en el servidor. Por favor intenta de nuevo.',
                        icon: 'error',
                        confirmButtonColor: '#ED1B2F'
                    });
                }
            }
        });
    });

    // Envío regular del formulario
    $('#formContactos').submit(function(event) {
        event.preventDefault();

        // 1. Validar que todos los campos requeridos estén completos
        if (!validarFormularioContacto()) {
            return false;
        }

        const formData = $(this).serialize();

        Swal.fire({
            title: 'Procesando información...',
            html: '<div class="spinner"></div>',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: "{{ route('guardarContactos') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                Swal.close();
                const userName = (response.data && response.data.full_name) ? response.data.full_name : 'Estimado cliente';
                $('#text-nombre').html('¡Hola ' + userName + '!');

                $('#modalDarTelecom').removeClass('hidden');
                $('#formContactos')[0].reset();

                // Restaurar tarjeta por defecto
                $('.service-option-card').first().click();
            },
            error: function(error) {
                Swal.close();
                if (error.status === 400 && error.responseJSON && error.responseJSON.message) {
                    const errors = error.responseJSON.message;
                    const firstError = typeof errors === 'string' ? errors : (Array.isArray(errors) ? errors[0] : Object.values(errors)[0][0]);
                    Swal.fire({
                        title: 'Datos incompletos',
                        text: firstError,
                        icon: 'warning',
                        confirmButtonColor: '#ED1B2F'
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error inesperado al enviar el mensaje. Inténtalo de nuevo o contáctanos por WhatsApp.',
                        icon: 'error',
                        confirmButtonColor: '#ED1B2F'
                    });
                }
            },
        });
    });

    $('#newsletterForm').submit(function(event) {
        event.preventDefault();
        let formDataArray = $(this).serializeArray();

        if (!validarEmail($('#emailSubscriptor').val())) {
            return;
        };

        Swal.fire({

            title: 'Procesando información',
            html: `Enviando... 
                    <p class=" text-text12">Espere un momento</p>
                        <div class="max-w-2xl mx-auto overflow-hidden flex justify-center items-center mt-4 ">
                            <div role="status">
                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                
                            </div>
                        </div>                  
                        `,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "{{ route('guardarSubscriptor') }}",
            method: 'POST',
            data: {
                email: $('#emailSubscriptor').val(), // Envía directamente el valor del campo de email
                _token: $('input[name="_token"]').val() // Incluye el token CSRF
            },
            success: function(response) {
                Swal.close();
                Swal.fire({
                    title: response.message,
                    icon: "success",
                });
                $('#newsletterForm')[0].reset();
            },
            error: function(error) {
                Swal.close();
                console.log(error);
            }
        });
    });
</script>


@stop

@stop