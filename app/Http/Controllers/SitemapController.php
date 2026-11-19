<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Products;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Genera dinámicamente el Sitemap XML del sitio público
     */
    public function index(): Response
    {
        $ahora = now()->tz('UTC')->toAtomString();

        $rutasEstaticas = [
            [
                'url' => url('/'),
                'lastmod' => $ahora,
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'url' => route('nosotros'),
                'lastmod' => $ahora,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'url' => route('servicios'),
                'lastmod' => $ahora,
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'url' => route('catalogo'),
                'lastmod' => $ahora,
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'url' => route('blog'),
                'lastmod' => $ahora,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'url' => route('contacto'),
                'lastmod' => $ahora,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
        ];

        $servicios = Service::where('visible', 1)->select('slug', 'updated_at')->get();
        $productos = Products::where('status', 1)->where('visible', 1)->select('slug', 'updated_at')->get();
        $posts = Blog::where('visible', 1)->select('slug', 'updated_at')->get();

        $xml = view('public.sitemap', compact('rutasEstaticas', 'servicios', 'productos', 'posts'))->render();

        return response($xml, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8')
            ->header('X-Robots-Tag', 'noindex');
    }

    /**
     * Regenera y escribe el archivo sitemap.xml en el directorio public/
     */
    public function generateFile()
    {
        try {
            $ahora = now()->tz('UTC')->toAtomString();

            $rutasEstaticas = [
                ['url' => url('/'), 'lastmod' => $ahora, 'changefreq' => 'daily', 'priority' => '1.0'],
                ['url' => route('nosotros'), 'lastmod' => $ahora, 'changefreq' => 'monthly', 'priority' => '0.8'],
                ['url' => route('servicios'), 'lastmod' => $ahora, 'changefreq' => 'weekly', 'priority' => '0.9'],
                ['url' => route('catalogo'), 'lastmod' => $ahora, 'changefreq' => 'daily', 'priority' => '0.9'],
                ['url' => route('blog'), 'lastmod' => $ahora, 'changefreq' => 'weekly', 'priority' => '0.8'],
                ['url' => route('contacto'), 'lastmod' => $ahora, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ];

            $servicios = Service::where('visible', 1)->select('slug', 'updated_at')->get();
            $productos = Products::where('status', 1)->where('visible', 1)->select('slug', 'updated_at')->get();
            $posts = Blog::where('visible', 1)->select('slug', 'updated_at')->get();

            $xml = view('public.sitemap', compact('rutasEstaticas', 'servicios', 'productos', 'posts'))->render();

            file_put_contents(public_path('sitemap.xml'), $xml);

            return back()->with('success', '¡Sitemap.xml regenerado y actualizado en disco exitosamente!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error al regenerar el sitemap: ' . $th->getMessage());
        }
    }

    /**
     * Actualiza el contenido del archivo public/robots.txt
     */
    public function updateRobots(Request $request)
    {
        try {
            $content = $request->input('robots_content', '');
            file_put_contents(public_path('robots.txt'), $content);

            return back()->with('success', '¡Archivo robots.txt actualizado correctamente!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error al actualizar robots.txt: ' . $th->getMessage());
        }
    }
}
