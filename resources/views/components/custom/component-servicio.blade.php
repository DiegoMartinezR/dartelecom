@if(empty($servicio))
    <div class="p-8 text-center text-slate-500 bg-slate-50 rounded-xl border border-slate-200">
        <i class="fa-solid fa-circle-info text-2xl text-blue-500 mb-2"></i>
        <p class="font-medium">No hay detalles disponibles para este subservicio.</p>
    </div>
@else
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-pagination-bullet {
            height: 15px;
            width: 15px;
            background-color: #eff1fb;
        }

        .swiper-pagination-bullet-active {
            background-color: #ed1b2f;
        }
    </style>

    <div class="flex flex-col md:flex-row items-start md:justify-between md:items-center mb-6" data-aos="fade-up"
        data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
        <div class="max-w-[90%]">
            @if(!empty($servicio->title))
            <h2 class="text-colorRojo text-[26px] sm:text-[30px] lg:text-text32 font-extrabold">{{ $servicio->title }}</h2>
            @endif
            @if(!empty($servicio->subtitle))
            <h3 class="text-text20 sm:text-text28 lg:text-text32 font-semibold mb-2 mt-1">{{ $servicio->subtitle }}</h3>
            @endif
        </div>
        <x-custom.button-cotizar :general="$general" text="CONTÁCTANOS" />
    </div>

    @if($album && !empty($album->images) && $album->images->count() > 0)
    <div class="mb-8" data-aos="fade-up" data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
        <div x-data="{}" x-init="new Swiper('.mySwiper', {
            loop: {{ $album->images->count() > 1 ? 'true' : 'false' }},
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($album->images as $image)
                        @if(!empty($image->url_image))
                        <div class="swiper-slide">
                            <div class="rounded-xl overflow-hidden w-full">
                                <img class="w-full !aspect-square lg:!aspect-video rounded-lg cursor-pointer object-cover"
                                    src="{{ asset($image->url_image) }}" alt="{{ $image->name_image ?? $servicio->title ?? 'Servicio' }}">
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    @endif

    @if(!empty($servicio->descripcion_extensa))
    <div id="descripcion_extensa" class="prose prose-lg max-w-7xl text-colorParrafo text-text18 mb-8" data-aos="fade-up"
        data-aos-offset="150" data-aos-duration="1000" data-aos-delay="200">
        {!! $servicio->descripcion_extensa !!}
    </div>
    @endif

    <!-- Benefits Section -->
    @if(!empty($servicio->beneficios))
    <x-custom.servicio-beneficio :text="$servicio->beneficios" :icono="$servicio->icono ?? ''" />
    @endif

    <!-- Call to Action -->
    <div class="text-start mt-8" hidden>
        <x-custom.button-cotizar :general="$general" text="Cotizar Servicio" />
    </div>
@endif
