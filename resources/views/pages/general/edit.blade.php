<x-app-layout title="Editar General">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{ route('datosgenerales.update', $general->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
                class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Datos generales
                        del negocio</h2>
                </header>
                @if (session('success'))
                    <script>
                        window.onload = function() {
                            mostrarAlerta();
                        }
                    </script>
                @endif
                <div class="p-3">

                    <div>

                        <div class="flex items-center justify-center">
                            <div>
                                <div>

                                    <div class=" rounded  p-4 px-4 ">
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">

                                            <div class="">

                                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                                    <h2
                                                        class="md:col-span-5 text-lg font-semibold text-slate-800 dark:text-white">
                                                        Información Breve de la Empresa</h2>

                                                    <div class="md:col-span-5">
                                                        <label for="aboutus">Descripción</label>
                                                        <div class="relative mb-2 ">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </div>
                                                            <textarea type="text" id="aboutus" name="aboutus"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $general->aboutus }}</textarea>
                                                        </div>
                                                    </div>

                                                    <h2
                                                        class="md:col-span-5 text-lg font-semibold text-slate-800 dark:text-white">
                                                        Información de contacto</h2>

                                                    <div class="md:col-span-5">
                                                        <label for="address">Dirección de la empresa</label>
                                                        <div class="relative mb-2 ">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </div>
                                                            <input type="text" id="address" name="address"
                                                                value="{{ $general->address }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Ingresa tu direccion">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label for="inside">Interior</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </div>
                                                            <input type="text" id="inside" name="inside"
                                                                value="{{ $general->inside }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-1">
                                                        <label for="district">Ciudad</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </div>
                                                            <input type="text" id="city" name="city"
                                                                value="{{ $general->city }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-1">
                                                        <label for="district">Distrito</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </div>
                                                            <input type="text" id="district" name="district"
                                                                value="{{ $general->district }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-1">
                                                        <label for="country">País</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </div>
                                                            <input type="text" id="country" name="country"
                                                                value="{{ $general->country }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Interior Oficina 204 - Piso 4">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="md:col-span-5">
                                                        <label for="mapa">Url de mapa google</label>
                                                        <div class="relative mb-2 ">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                               <i class="fa-regular fa-pen-to-square"></i>
                                                            </div>
                                                            <input type="text" id="mapa" name="mapa"
                                                                value="{{ $general->mapa }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Url de google maps">
                                                        </div>
                                                    </div> --}}

                                                    <div class="md:col-span-2">
                                                        <label for="email">Correo electrónico principal</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-at"></i>
                                                            </div>
                                                            <input type="email" id="email" name="email"
                                                                value="{{ $general->email }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="name@flowbite.com">
                                                        </div>
                                                    </div>

                                                    <!-- CAMPO DE CORREOS PARA NOTIFICACIONES AL ADMINISTRADOR -->
                                                    <div class="md:col-span-5 bg-blue-50/70 dark:bg-slate-700/50 border border-blue-200 dark:border-slate-600 rounded-xl p-4 my-2">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <i class="fa-solid fa-envelope-circle-check text-blue-600 text-lg"></i>
                                                            <div>
                                                                <label for="form_email" class="block font-bold text-slate-800 dark:text-white text-sm">
                                                                    Correos para Notificación al Administrador (Mensajes de Contacto y Web)
                                                                </label>
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    Correos que recibirán una alerta cada vez que un cliente registre un mensaje desde el formulario web o inicie contacto por WhatsApp.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="relative mt-2">
                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-users text-gray-400"></i>
                                                            </div>
                                                            <input type="text" id="form_email" name="form_email"
                                                                value="{{ $general->form_email }}"
                                                                class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="correo1@dartelecom.pe, correo2@dartelecom.pe, gerencia@dartelecom.pe">
                                                        </div>
                                                        <div class="flex items-start gap-1.5 mt-2 text-xs text-gray-600 dark:text-gray-300">
                                                            <i class="fa-solid fa-circle-info text-blue-500 mt-0.5"></i>
                                                            <span>
                                                                Puedes ingresar <strong>múltiples correos separados por comas ( , ) o punto y coma ( ; )</strong>. Si dejas este campo vacío, las notificaciones se enviarán únicamente al correo principal (<strong>{{ $general->email ?: 'ventas@dartelecom.pe' }}</strong>).
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label for="cellphone">Número de celular</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </div>
                                                            <input type="text" id="cellphone" name="cellphone"
                                                                value="{{ $general->cellphone }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51 123456789">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-1">
                                                        <label for="office_phone">Número de Teléfono</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </div>
                                                            <input type="text" id="office_phone"
                                                                name="office_phone"
                                                                value="{{ $general->office_phone }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51 1234567">
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label for="whatsapp">Whatsapp de soporte 1 (sin
                                                            guiones)</label>
                                                        <div class="relative mb-3">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                            </div>
                                                            <input type="text" id="whatsapp" name="whatsapp"
                                                                value="{{ $general->whatsapp }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51987654321">
                                                        </div>
                                                    </div>






                                                    <div class="md:col-span-3">
                                                        <label for="mensaje_whatsapp">Mensaje predeterminado para
                                                            Whastapp</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                            </div>
                                                            <input type="text" id="mensaje_whatsapp"
                                                                name="mensaje_whatsapp"
                                                                value="{{ $general->mensaje_whatsapp }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="+51 1234567">
                                                        </div>
                                                    </div>


                                                    <div class="md:col-span-5">
                                                        <label for="schedule">Horario de Oficina</label>
                                                        <div class="relative mb-2">
                                                            <div
                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                <i class="fa-regular fa-calendar"></i>
                                                            </div>
                                                            <input type="text" id="schedule" name="schedule"
                                                                value="{{ $general->schedule }}"
                                                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Horario de Oficina">
                                                        </div>
                                                    </div>


                                                    <h2
                                                        class="md:col-span-5 text-lg font-semibold text-slate-800 mt-2 dark:text-white">
                                                        Redes Sociales</h2>

                                                    <div class="md:col-span-5">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-0">
                                                            <div>
                                                                <div class="relative">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_facebook"
                                                                        name="facebook"
                                                                        value="{{ $general->facebook }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Facebook">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="relative ">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-instagram"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_instagram"
                                                                        name="instagram"
                                                                        value="{{ $general->instagram }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Instagram">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="relative ">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-youtube"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_youtube"
                                                                        name="youtube"
                                                                        value="{{ $general->youtube }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Youtube">
                                                                </div>
                                                            </div>

                                                            <div>

                                                                <div class="relative">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-x-twitter"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_twitter"
                                                                        name="twitter"
                                                                        value="{{ $general->twitter }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Twitter">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="relative ">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-tiktok"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_tiktok"
                                                                        name="tiktok" value="{{ $general->tiktok }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Tik Tok">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="relative ">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                    </div>
                                                                    <input type="text" id="rs_linkedin"
                                                                        name="linkedin"
                                                                        value="{{ $general->linkedin }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="Linkedin">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>



                                                    <!-- SECCIÓN METADATOS SEO PARA LA PÁGINA DE INICIO (HOME) -->
                                                    <div class="md:col-span-5 border-t border-b border-gray-200 dark:border-gray-700 py-6 my-4">
                                                        <div class="flex items-center gap-2 mb-4">
                                                            <i class="fa-solid fa-globe text-blue-600 text-xl"></i>
                                                            <div>
                                                                <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                                                                    Optimización SEO de la Página de Inicio (Home)
                                                                </h2>
                                                                <p class="text-xs text-gray-500">Configura cómo aparece la página principal de DarTelecom en los resultados de Google y al compartir en redes sociales.</p>
                                                            </div>
                                                        </div>

                                                        <div class="grid gap-4 grid-cols-1 md:grid-cols-5">
                                                            <div class="md:col-span-5">
                                                                <label for="meta_title" class="block font-medium text-gray-700 dark:text-gray-300">Meta Título (Home SEO Title)</label>
                                                                <div class="relative mt-1">
                                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </div>
                                                                    <input type="text" id="meta_title" name="meta_title" value="{{ $general->meta_title }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                                        placeholder="Ej: DarTelecom | Equipos de Red y Soluciones de Telecomunicaciones en Perú">
                                                                </div>
                                                                <p class="mt-1 text-xs text-gray-500">Recomendado: 50 a 60 caracteres.</p>
                                                            </div>

                                                            <div class="md:col-span-5">
                                                                <label for="meta_description" class="block font-medium text-gray-700 dark:text-gray-300">Meta Descripción (Snippet de Google)</label>
                                                                <div class="relative mt-1">
                                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none top-3">
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </div>
                                                                    <textarea id="meta_description" name="meta_description" rows="3"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                                        placeholder="Breve resumen persuasivo de DarTelecom para captar clics en Google...">{{ $general->meta_description }}</textarea>
                                                                </div>
                                                                <p class="mt-1 text-xs text-gray-500">Recomendado: 120 a 160 caracteres.</p>
                                                            </div>

                                                            <div class="md:col-span-5">
                                                                <label for="meta_keywords" class="block font-medium text-gray-700 dark:text-gray-300">Palabras Clave (Separadas por comas)</label>
                                                                <div class="relative mt-1">
                                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <i class="fa-solid fa-key"></i>
                                                                    </div>
                                                                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ $general->meta_keywords }}"
                                                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                                        placeholder="telecomunicaciones peru, fibra optica, antenas isp, radioenlaces, routers">
                                                                </div>
                                                            </div>

                                                            <div class="md:col-span-5">
                                                                <label for="meta_image" class="block font-medium text-gray-700 dark:text-gray-300">Imagen Principal para Redes Sociales (OpenGraph / WhatsApp)</label>
                                                                @if($general->meta_image)
                                                                    <div class="mb-2 mt-2">
                                                                        <img src="{{ asset($general->meta_image) }}" alt="Preview SEO Home" class="w-48 h-28 object-cover rounded-lg border shadow-sm">
                                                                        <p class="text-xs text-gray-500 mt-1">Imagen actual configurada</p>
                                                                    </div>
                                                                @endif
                                                                <input type="file" id="meta_image" name="meta_image" accept="image/*"
                                                                    class="mt-1 p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                                                                <p class="mt-1 text-xs text-gray-500">Recomendado: 1200 x 630 px en JPG o PNG.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="md:col-span-5 text-right mt-6">
                                                        <div class="inline-flex items-end">
                                                            <button type="submit" id="form_general"
                                                                onclick="confirmarActualizacion()"
                                                                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar
                                                                datos</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </form>

        {{-- SECCIÓN DE HERRAMIENTAS SEO TÉCNICAS: SITEMAP & ROBOTS.TXT --}}
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mt-8">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-screwdriver-wrench text-blue-600 text-xl"></i>
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-xl tracking-tight">
                        Herramientas SEO Técnicas: Sitemap.xml & Robots.txt
                    </h2>
                </div>
            </header>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Tarjeta 1: Regenerar Sitemap -->
                <div class="p-5 border border-gray-200 dark:border-gray-700 rounded-xl bg-slate-50 dark:bg-slate-900 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa-solid fa-sitemap text-indigo-600 text-lg"></i>
                            <h3 class="font-bold text-slate-800 dark:text-white text-base">Mapa del Sitio (Sitemap.xml)</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            Genera o actualiza el archivo físico en el servidor con todos los productos, servicios y artículos de blog activos para los motores de búsqueda.
                        </p>
                        <div class="text-xs bg-white dark:bg-slate-800 p-2.5 rounded border border-gray-200 dark:border-gray-700 mb-4 text-gray-600 dark:text-gray-400">
                            <strong>URL Pública:</strong> <a href="{{ url('/sitemap.xml') }}" target="_blank" class="text-blue-600 underline">{{ url('/sitemap.xml') }}</a>
                        </div>
                    </div>

                    <form action="{{ route('seo.sitemap.regenerate') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-150">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Regenerar Sitemap Ahora
                        </button>
                    </form>
                </div>

                <!-- Tarjeta 2: Editar Robots.txt -->
                <div class="p-5 border border-gray-200 dark:border-gray-700 rounded-xl bg-slate-50 dark:bg-slate-900 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa-solid fa-shield-halved text-emerald-600 text-lg"></i>
                            <h3 class="font-bold text-slate-800 dark:text-white text-base">Archivo Robots.txt</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            Controla qué páginas pueden rastrear los robots de Google y bloquea rutas privadas o sensibles.
                        </p>
                    </div>

                    @php
                        $robotsContent = file_exists(public_path('robots.txt')) ? file_get_contents(public_path('robots.txt')) : "User-agent: *\nAllow: /\nDisallow: /admin/\nSitemap: " . url('/sitemap.xml');
                    @endphp

                    <form action="{{ route('seo.robots.update') }}" method="POST">
                        @csrf
                        <textarea name="robots_content" rows="6" class="w-full font-mono text-xs p-3 bg-white dark:bg-slate-800 border border-gray-300 dark:border-gray-700 rounded-lg text-slate-800 dark:text-slate-200 mb-3 focus:ring-blue-500 focus:border-blue-500">{{ $robotsContent }}</textarea>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-150">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Guardar Cambios en Robots.txt
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        $('document').ready(function() {

            tinymce.init({
                selector: 'textarea#description',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'table'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px;}'
            });
            // Función para mostrar la alerta de confirmación antes de enviar el formulario
            function confirmarActualizacion() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción actualizará los datos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envía el formulario si se confirma la acción
                        document.getElementById('form_general').submit();
                    }
                });
            }


            function mostrarAlerta() {
                Swal.fire({
                    title: '¡Actualizado!',
                    text: 'Los datos se han actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                });
            }


        });
    </script>
    <script>
        let valorInput = 0

        $('document').ready(function() {

            const existingInputs = document.querySelectorAll("input[name^='Nombre-']");

            if (existingInputs.length > 0) {
                // Encontrar el valor numérico más alto en los names existentes
                existingInputs.forEach(input => {
                    const nameParts = input.name.split('-');
                    const number = parseInt(nameParts[1], 10);
                    if (number > valorInput) {
                        valorInput = number;
                    }
                });
            }

            $("#AddEspecifiacion").on('click', function(e) {
                e.preventDefault()
                valorInput++
                console.log('agregando especificacion')
                const addButton = document.getElementById("AddEspecifiacion");
                const divFlex = document.createElement("div");
                const dRelative = document.createElement("div");
                const dRelative2 = document.createElement("div");
                const dRelative3 = document.createElement("div");
                const dRelative4 = document.createElement("div");

                divFlex.classList.add('flex', 'gap-2')
                dRelative.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-1/2', 'lg:w-1/4')
                dRelative2.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-1/2', 'lg:w-1/4')
                dRelative3.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-1/2', 'lg:w-1/4')
                dRelative4.classList.add('relative', 'mb-2', 'mt-2', 'w-full', 'md:w-1/2', 'lg:w-1/4')

                const iconContainer = document.createElement("div");
                const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>`
                iconContainer.innerHTML = icon;

                // Obtener el nodo del icono
                const iconNode = iconContainer.firstChild;



                const inputArea = document.createElement("select");
                const inputName = document.createElement("input");
                const inputPhone = document.createElement("input");
                const inputEmail = document.createElement("input");

                let inputA = agregarElementoSelect(inputArea, valorInput, 'Area')
                let inputN = agregarElementos(inputName, valorInput, 'Nombre')
                let inputC = agregarElementos(inputPhone, valorInput, 'Celular')
                let inputE = agregarElementos(inputEmail, valorInput, 'Email')


                dRelative.appendChild(inputA);
                dRelative2.appendChild(inputN);
                dRelative3.appendChild(inputC);
                dRelative4.appendChild(inputE);


                // Agregar el icono como primer hijo de dRelative
                dRelative.insertBefore(iconNode, inputA);

                // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
                const iconNodeCloned = iconNode.cloneNode(true);
                dRelative2.insertBefore(iconNodeCloned, inputN);

                const iconNodeCloned2 = iconNode.cloneNode(true);
                dRelative3.insertBefore(iconNodeCloned2, inputC);

                const iconNodeCloned3 = iconNode.cloneNode(true);
                dRelative4.insertBefore(iconNodeCloned3, inputE);


                divFlex.appendChild(dRelative);
                divFlex.appendChild(dRelative2);
                divFlex.appendChild(dRelative3);
                divFlex.appendChild(dRelative4);

                const parentContainer = addButton.parentElement
                    .parentElement; // Obtener el contenedor padre
                parentContainer.insertBefore(divFlex, addButton.parentElement
                    .nextSibling); // Insertar el input antes del siguiente elemento después del botón



            })
        })

        function agregarElementos(elemento, valorInput, name) {
            elemento.setAttribute("type", "text");
            elemento.setAttribute("name", `${name}-${valorInput}`);
            elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
            elemento.setAttribute("id", `${name}-${valorInput}`);
            //elemento.setAttribute("id", `${name}-${valorInput}`);
            //elemento.setAttribute("id", `${name}-${valorInput}`);

            elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
                "rounded-lg",
                "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "pl-10", "p-2.5",
                "dark:bg-gray-700",
                "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
                "dark:focus:ring-blue-500",
                "dark:focus:border-blue-500");

            return elemento
        }




        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>

</x-app-layout>
