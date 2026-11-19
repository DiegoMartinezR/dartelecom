<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Rutas Estáticas Principales --}}
    @foreach ($rutasEstaticas as $ruta)
        <url>
            <loc>{{ $ruta['url'] }}</loc>
            <lastmod>{{ $ruta['lastmod'] }}</lastmod>
            <changefreq>{{ $ruta['changefreq'] }}</changefreq>
            <priority>{{ $ruta['priority'] }}</priority>
        </url>
    @endforeach

    {{-- Servicios Públicos --}}
    @foreach ($servicios as $servicio)
        <url>
            <loc>{{ route('servicios', $servicio->slug) }}</loc>
            <lastmod>{{ $servicio->updated_at ? $servicio->updated_at->tz('UTC')->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Productos Públicos --}}
    @foreach ($productos as $producto)
        <url>
            <loc>{{ route('producto', $producto->slug) }}</loc>
            <lastmod>{{ $producto->updated_at ? $producto->updated_at->tz('UTC')->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Artículos de Blog Públicos --}}
    @foreach ($posts as $post)
        <url>
            <loc>{{ route('detalleBlog', $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at ? $post->updated_at->tz('UTC')->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
