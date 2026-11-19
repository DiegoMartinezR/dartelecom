<x-app-layout title="Editar Servicio">

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form id="service-form" action="{{ route('servicios.update', $servicios->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
                class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Edición del
                        servicio:
                        {{ $servicios->title }}</h2>
                </header>

                <div class="p-3">
                    <div class="rounded shadow-lg p-4 px-4 ">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="col-span-3">
                                <div class="md:col-span-5">
                                    <label for="title">Título del servicio</label>
                                    <div class="relative mb-2  mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                        <input type="text" id="title" name="title"
                                            value="{{ $servicios->title }}"
                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Titulo">
                                    </div>
                                </div>

                                <!-- URL Amigable (Slug) -->
                                <div class="md:col-span-5">
                                    <label for="slug" class="block font-medium text-gray-700 dark:text-gray-300">
                                        URL Amigable (Slug) <span class="text-xs text-gray-400 font-normal">(Personaliza la ruta URL de este servicio)</span>
                                    </label>
                                    <div class="relative mb-2 mt-1">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                            <i class="fa-solid fa-link"></i>
                                        </div>
                                        <input type="text" id="slug" name="slug"
                                            value="{{ old('slug', $servicios->slug) }}"
                                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="ejemplo-mi-servicio-personalizado">
                                    </div>
                                    <p class="text-xs text-gray-500 mb-2">Enlace actual: <a href="{{ route('servicios', $servicios->slug) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">{{ url('/servicios/' . $servicios->slug) }}</a></p>
                                </div>
                                <div class="md:col-span-5">
                                    <label for="title">Subtítulo del servicio</label>
                                    <div class="relative mb-2  mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                        <input type="text" id="subtitle" name="subtitle"
                                            value="{{ $servicios->subtitle }}"
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
                                            placeholder="Descripción Breve">{{ $servicios->descripcion_breve }}</textarea>
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
                                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $servicios->meta_title) }}"
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
                                                placeholder="Breve resumen persuasivo del servicio para los resultados de búsqueda...">{{ old('meta_description', $servicios->meta_description) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Recomendado: 120 a 160 caracteres.</p>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Palabras Clave (Keywords separadas por comas)
                                        </label>
                                        <div class="relative mt-1">
                                            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $servicios->meta_keywords) }}"
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
                                        @if($servicios->meta_image)
                                            <div class="mb-2 mt-1">
                                                <img src="{{ asset($servicios->meta_image) }}" alt="SEO Image Actual" class="w-32 h-20 object-cover rounded-md border">
                                                <p class="text-xs text-gray-500 mt-1">Imagen actual</p>
                                            </div>
                                        @endif
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
                                    <label for="description">Icono del servicio</label>
                                    <div class="relative mb-2 mt-2">
                                        <div class=" h-10 w-10 bg-colorBackgroundAzulOscuro"
                                            style="mask-image: url('{{ asset($servicios->icono) }}'); mask-size: cover; mask-repeat: no-repeat;"">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="icono">Actualizar Icono</label>
                                    <div class="relative mb-2  mt-2">

                                        <input name="icono"
                                            class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="icono" type="file" accept="image/svg+xml">
                                    </div>
                                </div>
                                <!-- Agregar el campo de la galería de imágenes -->
                                <div class="md:col-span-5 mt-4" hidden>
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
                                            class="hidden">
                                    </div>
                                </div>
                                <div class="md:col-span-5" hidden>
                                    <label for="album">Galería de imágenes</label>
                                    <div class="border p-4 rounded shadow mt-1" id="gallery-container">
                                        <!-- Imágenes -->
                                        @if ($album->images->isNotEmpty())
                                            <div class="grid grid-cols-3 gap-4">
                                                @foreach ($album->images as $image)
                                                    <div class="relative group" id="image-{{ $image->id }}">
                                                        <img src="{{ asset($image->url_image) }}"
                                                            alt="{{ $image->name_image }}"
                                                            class="w-auto h-32 object-cover rounded-xl">
                                                        <button
                                                            onclick="deleteImage('{{ route('servicio.images.destroy', $image) }}', {{ $image->id }})"
                                                            class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500">No hay imágenes en este álbum.</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="md:col-span-5">
                                    <label for="imagen_principal">Imagen Principal del Servicio</label>
                                    <span class="text-colorRojo ml-4 text-xs">( Imagen principal que representa el servicio )</span>
                                    <div class="relative mb-2 mt-2">
                                        @if($servicios->imagen_principal)
                                            <div class="mb-3">
                                                <img src="{{ asset($servicios->imagen_principal) }}" alt="Imagen Principal" class="w-full aspect-video object-cover rounded-lg">
                                                <p class="text-sm text-gray-600 mt-1">Imagen actual</p>
                                            </div>
                                        @endif
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
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar
                                    </button>
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

            // Inicializar Quill para Descripción Extensa
            const quillDescription = new Quill('#description-editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Escriba la descripción aquí...',
                theme: 'snow',
                height: 300
            });



            // 1️⃣ **Recuperar contenido desde la base de datos**
            const descriptionData = `{!! $servicios->descripcion_extensa ?? '' !!}`;


            // 2️⃣ **Insertar contenido en Quill (usar clipboard.dangerouslyPasteHTML)**
            quillDescription.clipboard.dangerouslyPasteHTML(descriptionData);

            // Obtener los valores de Quill antes de enviar el formulario
            document.getElementById("service-form").addEventListener("submit", function() {
                document.getElementById("descripcion_extensa").value = quillDescription.root.innerHTML;

            });
        });
    </script>
    <script>
        document.getElementById('fileAlbum').addEventListener('change', function(event) {
            uploadImages(event.target.files);
        });

        function asset(path) {
            return `${window.location.origin}/${path}`;
        }

        function uploadImages(files) {
            if (files.length === 0) return;

            let formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            fetch('{{ route('servicio.uploadImages', $album->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    console.log("Respuesta completa del servidor:", response);
                    return response.json().catch(() => {
                        throw new Error("La respuesta no es JSON válido");
                    });
                })
                .then(data => {
                    console.log("Datos procesados:", data);

                    if (data.success) {
                        Swal.fire('¡Imágenes agregadas!', data.message, 'success');
                        updateGallery(data.album); // Asegura que data.album tenga imágenes
                    } else {
                        Swal.fire('Error', data.message || 'Hubo un problema al agregar las imágenes', 'error');
                    }
                })
                .catch(error => {
                    console.error("Error en la subida:", error);
                    Swal.fire('Error', 'Ocurrió un error al procesar la solicitud', 'error');
                });
        }

        function updateGallery(album) {


            const galleryContainer = document.getElementById('gallery-container');
            galleryContainer.innerHTML = '';

            if (!album || !album.images || album.images.length === 0) {
                console.warn("El álbum no tiene imágenes o no se recibió correctamente.");
                galleryContainer.innerHTML = '<p class="text-gray-500">No hay imágenes en este álbum.</p>';
                return;
            }

            const grid = document.createElement('div');
            grid.classList.add('grid', 'grid-cols-3', 'gap-4');

            album.images.forEach(image => {
                const imageWrapper = document.createElement('div');
                imageWrapper.classList.add('relative', 'group');

                const img = document.createElement('img');
                img.src = asset(image.url_image);
                img.alt = image.name_image;
                img.classList.add('w-auto', 'h-36', 'object-cover', 'rounded-xl');

                const deleteButton = document.createElement('button');
                deleteButton.classList.add('absolute', 'top-2', 'right-2', 'bg-red-600', 'text-white', 'px-2',
                    'py-1', 'rounded-full', 'opacity-0', 'group-hover:opacity-100', 'transition-opacity');
                deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
                deleteButton.onclick = function() {
                    deleteImage('{{ route('products.images.destroy', '') }}/' + image.id, imageWrapper);
                };

                imageWrapper.appendChild(img);
                imageWrapper.appendChild(deleteButton);
                grid.appendChild(imageWrapper);
            });

            galleryContainer.appendChild(grid);
        }


        function deleteImage(deleteUrl, imageId) {
            event.preventDefault(); // Esto evita la recarga de la página

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteUrl, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Eliminado", data.message, "success");
                                // Eliminar la imagen del DOM
                                document.getElementById(`image-${imageId}`).remove();
                                updateGallery(data.album);
                            } else {
                                Swal.fire("Error", data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error("Error al eliminar:", error);
                            Swal.fire("Error", "No se pudo eliminar la imagen.", "error");
                        });
                }
            });
        }
    </script>

</x-app-layout>
