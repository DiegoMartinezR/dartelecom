<x-app-layout title="Crear Blog">

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form id="blog-form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div
                class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Creación de
                        nuevo post</h2>
                </header>

                <div class="p-3">
                    <div class="rounded  p-4 px-4 ">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <label for="titulo">Título de post</label>
                                <div class="relative mb-2  mt-2">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                    <input type="text" id="titulo" name="titulo" value=""
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Título">
                                </div>
                            </div>

                            <!-- URL Amigable (Slug) -->
                            <div class="md:col-span-5">
                                <label for="slug" class="block font-medium text-gray-700 dark:text-gray-300">
                                    URL Amigable (Slug) <span class="text-xs text-gray-400 font-normal">(Opcional: si se deja vacío se genera automáticamente del título)</span>
                                </label>
                                <div class="relative mb-2 mt-1">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-link"></i>
                                    </div>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="ejemplo-mi-articulo-de-blog">
                                </div>
                                <p class="text-xs text-gray-500 mb-2">Ejemplo de enlace resultante: <code class="text-blue-600 font-semibold">https://dartelecom.pe/post/<b>tu-slug</b></code></p>
                            </div>
                            <div class="md:col-span-5 mt-2">

                                <label for="extracto">Descripción Breve</label>

                                <div class="relative mb-2  mt-2">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                    <textarea type="text" id="extracto" name="extracto" value=""
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('extracto') is-invalid @enderror"
                                        placeholder="Extracto"></textarea>
                                    @error('extracto')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="md:col-span-5">
                                <label for="category_post_id">Categoría de post</label>
                                <div class="relative mb-2 mt-2">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-list-ul"></i>
                                    </div>
                                    <select type="text" rows="2" id="category_post_id" name="category_post_id"
                                        value=""
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Seleccionar Categoria </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="md:col-span-5">
                                <label for="descripcion">Descripción Extensa</label>
                                <div class="relative mb-2 mt-2">
                                    <div id="description-editor" class="w-full min-h-[200px]"></div>
                                    <input type="hidden" name="descripcion" id="descripcion">
                                </div>
                            </div>

                            <div class="md:col-span-5">
                                <label for="imagen">Imagen principal</label>
                                <div class="relative mb-2  mt-2">
                                    <input id="imagen" name="imagen"
                                        class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                </div>
                            </div>

                            <!-- Sección SEO Técnico -->
                            <div class="md:col-span-5 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-chart-line text-blue-600"></i>
                                    <h3 class="font-semibold text-slate-800 dark:text-slate-100 text-base">
                                        Optimización SEO (Metadatos del Post)
                                    </h3>
                                </div>

                                <!-- Meta Title -->
                                <div class="mb-3">
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Meta Título (SEO Title)
                                    </label>
                                    <div class="relative mt-1">
                                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                            maxlength="255"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Ej: Guía de Instalación de Antenas ISP | DarTelecom Blog">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Recomendado: 50 a 60 caracteres.</p>
                                </div>

                                <!-- Meta Description -->
                                <div class="mb-3">
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Meta Descripción (Snippet de Google)
                                    </label>
                                    <div class="relative mt-1">
                                        <textarea id="meta_description" name="meta_description" rows="3"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Breve resumen informativo y atractivo del artículo para captar clics en Google...">{{ old('meta_description') }}</textarea>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Recomendado: 120 a 160 caracteres.</p>
                                </div>

                                <!-- Meta Keywords -->
                                <div class="mb-3">
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Palabras Clave (Keywords separadas por comas)
                                    </label>
                                    <div class="relative mt-1">
                                        <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="telecomunicaciones, wisp, antenas, configuracion de red">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Términos relevantes separados por comas.</p>
                                </div>

                                <!-- Meta Image (OpenGraph / Redes Sociales) -->
                                <div class="mb-3">
                                    <label for="meta_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Imagen para Compartir (OpenGraph / Redes Sociales)
                                    </label>
                                    <div class="relative mt-1">
                                        <input type="file" id="meta_image" name="meta_image" accept="image/*"
                                            class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Recomendado: 1200x630px en formato JPG/PNG para WhatsApp y redes.</p>
                                </div>
                            </div>




                            <div class="md:col-span-5 text-right mt-6 flex justify-between">
                                <div class="inline-flex items-end">
                                    <a href="{{ URL::previous() }}"
                                        class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
                                </div>
                                <div class="inline-flex items-end">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Guardar
                                        post</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote'],
                ['link', 'image', 'video'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'list': 'check'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'align': []
                }]
            ];

            // Inicializar Quill
            const quillDescription = new Quill('#description-editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Escriba la descripción aquí...',
                theme: 'snow'
            });

            // Sincronizar el campo oculto con el contenido de Quill
            function updateDescriptionField() {
                document.getElementById('descripcion').value = quillDescription.root.innerHTML;
            }

            // Escuchar cambios en el contenido de Quill
            quillDescription.on('text-change', updateDescriptionField);

            // Manejo del formulario con AJAX
            $("#blog-form").submit(function(e) {
                e.preventDefault();

                // Asegurarse de que el campo oculto tiene la descripción antes de enviar
                updateDescriptionField();
                // Deshabilitar el botón y mostrar loader
                Swal.fire({
                    title: "Guardando...",
                    text: "Por favor, espera",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: "{{ route('blog.store') }}",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "¡Éxito!",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = "Hubo un problema al crear la publicación.";
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = "<ul style='text-align: left; list-style-type: disc; padding-left: 20px;'>" + 
                                errors.map(err => "<li>" + err + "</li>").join("") + 
                                "</ul>";
                            Swal.fire({
                                title: "Campos requeridos o inválidos",
                                html: errorMessage,
                                icon: "warning"
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: errorMessage,
                                icon: "error"
                            });
                        }
                    }
                });
            });
        });
    </script>


</x-app-layout>
