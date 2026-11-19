<x-app-layout title="Detalle del mensaje">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Navegación y Encabezado Superior -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('mensajes.index') }}"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors mb-2">
                    <svg class="w-4 h-4 mr-1.5 fill-current" viewBox="0 0 16 16">
                        <path d="m6.7 13.7-5-5a1 1 0 0 1 0-1.4l5-5a1 1 0 0 1 1.4 1.4L4.8 7H14a1 1 0 1 1 0 2H4.8l3.3 3.3a1 1 0 0 1-1.4 1.4z" />
                    </svg>
                    Volver a todos los mensajes
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-slate-100 flex items-center gap-3">
                    <span>Mensaje #{{ $message->id }}</span>
                    @if (strtolower($message->comunication ?? ($message->source ?? '')) === 'whatsapp')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                            <i class="fa-solid fa-globe"></i> Formulario Web
                        </span>
                    @endif
                </h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Recibido el {{ $message->created_at ? $message->created_at->format('d/m/Y \a \l\a\s H:i') : 'Fecha no disponible' }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                @if ($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        Contactar por WhatsApp
                    </a>
                @endif
                @if ($message->email)
                    <a href="mailto:{{ $message->email }}?subject=Respuesta%20a%20tu%20consulta%20-%20Dar%20Telecom"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-900 dark:bg-slate-100 dark:hover:bg-white dark:text-slate-800 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                        Enviar Email
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Columna Izquierda: Información Detallada del Contacto (2 columnas) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Card: Datos Principales del Formulario -->
                <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-750 flex items-center justify-between">
                        <h2 class="font-bold text-slate-800 dark:text-slate-100 text-base flex items-center gap-2">
                            <i class="fa-solid fa-address-card text-slate-400"></i>
                            Información del Contacto
                        </h2>
                        <span class="text-xs font-medium text-slate-400">ID: {{ $message->id }}</span>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nombres y apellidos -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Nombres y apellidos
                            </span>
                            <span class="text-base font-bold text-slate-800 dark:text-slate-100">
                                {{ $message->full_name ?? '-' }}
                            </span>
                        </div>

                        <!-- Empresa / Razón Social -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Empresa / Razón Social
                            </span>
                            <span class="text-base font-bold text-slate-800 dark:text-slate-100">
                                {{ $message->company ?? 'No especificada' }}
                            </span>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Correo Electrónico
                            </span>
                            <a href="mailto:{{ $message->email }}" class="text-base font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:underline break-all">
                                {{ $message->email ?? '-' }}
                            </a>
                        </div>

                        <!-- Teléfono / WhatsApp -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Teléfono / WhatsApp
                            </span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="text-base font-semibold text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 inline-flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp"></i>
                                {{ $message->phone ?? '-' }}
                            </a>
                        </div>

                        <!-- Ciudad / Región -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Ciudad / Región
                            </span>
                            <span class="text-base font-medium text-slate-800 dark:text-slate-200">
                                {{ $message->city ?? 'No especificada' }}
                            </span>
                        </div>

                        <!-- Tipo de requerimiento / Asesoría -->
                        <div class="bg-slate-50 dark:bg-slate-900/40 p-4 rounded-lg border border-slate-100 dark:border-slate-800">
                            <span class="block text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">
                                Tipo de requerimiento
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                {{ $message->service_product ?? 'No especificado' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card: Mensaje o Consulta Escrita -->
                <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-750 flex items-center justify-between">
                        <h2 class="font-bold text-slate-800 dark:text-slate-100 text-base flex items-center gap-2">
                            <i class="fa-solid fa-comment-dots text-slate-400"></i>
                            Consulta / Detalle del Proyecto
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="bg-slate-50 dark:bg-slate-900/60 p-5 rounded-xl border border-slate-200/80 dark:border-slate-700 text-slate-800 dark:text-slate-200 leading-relaxed text-base whitespace-pre-line">
                            {{ $message->message ? $message->message : 'Sin mensaje adicional adjunto.' }}
                        </div>
                    </div>
                </div>

                <!-- Formulario para responder por correo (Quill) -->
                <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-750 flex items-center justify-between">
                        <h2 class="font-bold text-slate-800 dark:text-slate-100 text-base flex items-center gap-2">
                            <i class="fa-solid fa-reply text-slate-400"></i>
                            Responder al Cliente por Correo
                        </h2>
                        <span class="text-xs text-slate-500">Destinatario: {{ $message->email }}</span>
                    </div>

                    <form id="message-form" action="{{ route('mensajes.reply', $message->id) }}" method="POST" class="p-6">
                        @csrf
                        <div class="mb-4">
                            <label for="response_message" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Redactar respuesta
                            </label>
                            <div class="relative bg-white dark:bg-slate-900 rounded-lg">
                                <div id="response_message-editor" class="w-full min-h-[220px]"></div>
                                <input type="hidden" name="response_message" id="response_message">
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700">
                            <a href="{{ route('mensajes.index') }}"
                                class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-200 font-semibold rounded-lg text-sm transition-colors">
                                Volver
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm shadow-sm transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                Enviar Respuesta
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Columna Derecha: Metadatos y Datos Técnicos (1 columna) -->
            <div class="space-y-6">

                <!-- Card: Estado y Canal -->
                <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 p-5 space-y-4">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider">
                        Estado del Registro
                    </h3>

                    <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-700 text-sm">
                        <span class="text-slate-500">Canal de origen</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">
                            {{ $message->comunication ?? ($message->source ?? 'Formulario Web') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-700 text-sm">
                        <span class="text-slate-500">Estado</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Leído
                        </span>
                    </div>

                    <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-700 text-sm">
                        <span class="text-slate-500">Fecha de recepción</span>
                        <span class="font-medium text-slate-800 dark:text-slate-200">
                            {{ $message->created_at ? $message->created_at->format('d/m/Y') : '-' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between py-2 text-sm">
                        <span class="text-slate-500">Hora</span>
                        <span class="font-medium text-slate-800 dark:text-slate-200">
                            {{ $message->created_at ? $message->created_at->format('H:i:s') : '-' }}
                        </span>
                    </div>
                </div>

                <!-- Card: Información del Dispositivo y Sistema -->
                <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 p-5 space-y-3">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-laptop text-slate-400"></i>
                        Datos Técnicos del Cliente
                    </h3>

                    <div class="text-xs space-y-2.5 pt-2">
                        <div class="flex justify-between py-1 border-b border-slate-100 dark:border-slate-700">
                            <span class="text-slate-500">Dirección IP:</span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">{{ $message->ip ?? 'No registrada' }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100 dark:border-slate-700">
                            <span class="text-slate-500">Tipo de dispositivo:</span>
                            <span class="font-medium capitalize text-slate-700 dark:text-slate-300">{{ $message->device ?? 'Desconocido' }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100 dark:border-slate-700">
                            <span class="text-slate-500">Sistema / Navegador:</span>
                            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $message->client_system ?? 'No registrado' }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100 dark:border-slate-700">
                            <span class="text-slate-500">Resolución de pantalla:</span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">
                                @if ($message->client_width && $message->client_height)
                                    {{ $message->client_width }} x {{ $message->client_height }} px
                                @else
                                    No registrada
                                @endif
                            </span>
                        </div>
                        @if ($message->client_latitude && $message->client_longitude && $message->client_latitude !== 'Sin data')
                            <div class="flex justify-between py-1">
                                <span class="text-slate-500">Coordenadas:</span>
                                <a href="https://www.google.com/maps?q={{ $message->client_latitude }},{{ $message->client_longitude }}" target="_blank" class="text-blue-500 hover:underline font-mono">
                                    {{ $message->client_latitude }}, {{ $message->client_longitude }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Script del Editor Quill (Mantenido intacto) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote'],
                ['link'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'list': 'check' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }]
            ];

            const quillDescription = new Quill('#response_message-editor', {
                modules: { toolbar: toolbarOptions },
                placeholder: 'Escriba la respuesta aquí...',
                theme: 'snow',
                height: 300
            });

            const form = document.getElementById('message-form');
            if (form) {
                form.addEventListener('submit', function(event) {
                    document.getElementById('response_message').value = quillDescription.root.innerHTML;
                    return true;
                });
            }
        });
    </script>
</x-app-layout>
