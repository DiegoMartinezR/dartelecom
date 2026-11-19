<x-app-layout title="Crear Servicio">

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form id="service-form" action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div
                class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Creación de
                        nuevo servicio</h2>
                </header>

                <div class="p-3">
                    <div class="rounded  p-4 px-4 ">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="col-span-3">
                                <div class="md:col-span-5">
                                    <label for="title">Título del servicio</label>
                                    <div class="relative mb-2  mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                        <input type="text" id="title" name="title" value=""
                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Titulo">
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
                                            placeholder="ejemplo-mi-servicio-personalizado">
                                    </div>
                                    <p class="text-xs text-gray-500 mb-2">Ejemplo de enlace: <code class="text-blue-600 font-semibold">https://dartelecom.pe/servicios/<b>tu-slug</b></code></p>
                                </div>
                                <div class="md:col-span-5">
                                    <label for="title">Subtítulo del servicio</label>
                                    <div class="relative mb-2  mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                        <input type="text" id="subtitle" name="subtitle" value=""
                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Subtitulo">
                                    </div>
                                </div>



                                <div class="md:col-span-5">
                                    <label for="descripcion_breve">Descripcion Breve del servicio</label>
                                    <span class="text-colorRojo ml-4 text-xs">( Menciona a la brevedad sobre el servicio
                                        )</span>
                                    <div class="relative mb-2 mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none top-0">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                        <textarea type="text" rows="2" id="descripcion_breve" name="descripcion_breve" value=""
                                            class="mt-1 min-h-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Descripción Breve"></textarea>
                                    </div>
                                </div>

                          

                                <div class="md:col-span-5">
                                    <label for="descripcion_extensa">Descripción Extensa</label>
                                    <div class="relative mb-2 mt-2">
                                        <div id="description-editor" class="w-full min-h-[200px]"></div>
                                        <input type="hidden" name="descripcion_extensa" id="descripcion_extensa">
                                    </div>
                                </div>

                                <!-- Sección SEO Técnico -->
                                <div class="md:col-span-5 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center gap-2 mb-3">
                                        <i class="fa-solid fa-chart-line text-blue-600"></i>
                                        <h3 class="font-semibold text-slate-800 dark:text-slate-100 text-base">
                                            Optimización SEO (Metadatos del Servicio)
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
                                                placeholder="Ej: Servicio de Instalación de Torres y Radioenlaces | DarTelecom">
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
                                                placeholder="Breve resumen persuasivo del servicio para los resultados de búsqueda...">{{ old('meta_description') }}</textarea>
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
                                                placeholder="torres ventadas, radioenlaces isp, mantenimiento telecomunicaciones">
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
                            </div>
                            <div class="col-span-2">
                                <div class="md:col-span-5">
                                    <label for="icono">Subir un Icono</label>
                                    <div class="relative mb-2  mt-2">

                                        <input name="icono"
                                            class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="icono" type="file" accept="image/svg+xml">
                                    </div>
                                </div>
                                <!-- Agregar el campo de la galería de imágenes -->
                                <div class="md:col-span-5" hidden>
                                    <div class="w-full">
                                        <label for="fileAlbum"
                                            class="cursor-pointer text-center p-4 md:p-8 block border-2 border-dashed rounded-lg">
                                            <i class="fa-solid fa-cloud-arrow-up fa-3x text-colorAzul"></i>
                                            <p class="mt-3 text-colorParrafo max-w-xs mx-auto">
                                                Haga clic para <span class="font-medium text-indigo-600">Cargar su
                                                    archivo</span> o arrastre y suelte su archivo aquí
                                            </p>
                                        </label>
                                        <input type="file" id="fileAlbum" name="images[]" multiple accept="image/*"
                                            class="hidden" onchange="handleImageUpload(event)">
                                    </div>
                                </div>

                                <div class="md:col-span-5" hidden>
                                    <label for="album">Galería de imágenes</label>
                                    <div class="border p-4 rounded shadow mt-1 grid grid-cols-3 gap-4"
                                        id="gallery-container">
                                        <!-- Aquí se mostrarán las imágenes cargadas -->
                                    </div>
                                </div>

                                      <div class="md:col-span-5">
                                    <label for="imagen_principal">Imagen Principal del Servicio</label>
                                    <span class="text-colorRojo ml-4 text-xs">( Imagen principal que representa el servicio )</span>
                                    <div class="relative mb-2 mt-2">
                                        <input name="imagen_principal"
                                            class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="imagen_principal" type="file" accept="image/*">
                                    </div>
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
                                        servicio</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
        /*VALIDAR QUE EL ICONO SEA SVG*/
        document.getElementById("fileInput").addEventListener("change", function() {
            const file = this.files[0];

            if (file) {
                // Verificar tipo MIME
                if (file.type !== "image/svg+xml") {
                    Swal.fire({



                        icon: "error",
                        title: 'Solo se admiten archivos SVG', // Mostrar el mensaje dinámico
                        showConfirmButton: true,
                        timer: 1500
                    });
                    this.value = ""; // Resetea el input
                } else {
                    Swal.fire({

                        icon: "error",
                        title: 'Archivo válido' + file.name, // Mostrar el mensaje dinámico
                        showConfirmButton: true,
                        timer: 1500
                    });

                }
            }
        });
    </script>
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

            // Inicializar Quill para Descripción Extensa
            const quillDescription = new Quill('#description-editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Escriba la descripción aquí...',
                theme: 'snow',
                height: 300
            });


            // Actualizar los campos ocultos antes de enviar el formulario
            const form = document.getElementById('service-form');
            form.addEventListener('submit', function(event) {
                // Actualizar el campo oculto "description" con el contenido de Quill
                document.getElementById('descripcion_extensa').value = quillDescription.root.innerHTML;


                // Continuar con el envío del formulario
                return true;
            });

        });
    </script>

    <script>
        let selectedFiles = []; // Array para almacenar los archivos seleccionados

        // Función para limpiar el input de tipo file
        function clearFileInput() {
            const fileInput = document.getElementById('fileAlbum');
            fileInput.value = ''; // Limpiar el input de tipo file
        }

        // Función para actualizar el input con los archivos restantes
        function updateFileInput() {
            const fileInput = document.getElementById('fileAlbum');
            clearFileInput(); // Limpiar el input antes de agregar nuevos archivos

            // Crear un nuevo DataTransfer para agregar los archivos restantes
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            // Asignar los archivos al input de tipo file
            fileInput.files = dataTransfer.files;
        }

        // Función para manejar la carga de imágenes
        function handleImageUpload(event) {
            const files = event.target.files;
            const galleryContainer = document.getElementById("gallery-container");

            // Limpiar la galería antes de agregar nuevas imágenes
            galleryContainer.innerHTML = "";

            // Vaciar el array de archivos seleccionados
            selectedFiles = [];

            // Mostrar las imágenes seleccionadas
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.alt = file.name;
                    imgElement.classList.add("w-auto", "h-32", "object-cover", "rounded-xl", "mb-4");

                    // Crear un botón para eliminar la imagen de la vista previa
                    const deleteButton = document.createElement("button");
                    deleteButton.classList.add("absolute", "top-2", "right-2", "bg-red-600", "text-white",
                        "px-2", "py-1", "rounded-full");
                    deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
                    deleteButton.onclick = () => removeImageFromPreview(file.name);

                    const imageWrapper = document.createElement("div");
                    imageWrapper.classList.add("relative", "group", "images");
                    imageWrapper.appendChild(imgElement);
                    imageWrapper.appendChild(deleteButton);

                    galleryContainer.appendChild(imageWrapper);
                }
                reader.readAsDataURL(file);

                // Agregar el archivo al array de archivos seleccionados
                selectedFiles.push(file);
            });

            // Actualizar el input de tipo file
            updateFileInput();
        }

        // Función para eliminar imágenes de la vista previa
        function removeImageFromPreview(fileName) {
            const galleryContainer = document.getElementById("gallery-container");
            const images = galleryContainer.querySelectorAll("div.images");

            // Eliminar la imagen de la vista previa
            images.forEach(imageWrapper => {
                if (imageWrapper.querySelector("img").alt === fileName) {
                    galleryContainer.removeChild(imageWrapper);
                }
            });

            // Eliminar el archivo del array de archivos seleccionados
            selectedFiles = selectedFiles.filter(file => file.name !== fileName);

            // Actualizar el input de tipo file
            updateFileInput();
        }
    </script>

</x-app-layout>
