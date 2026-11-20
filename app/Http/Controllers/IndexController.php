<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Http\Requests\StoreIndexRequest;
use App\Http\Requests\UpdateIndexRequest;
use App\Models\AboutUs;
use App\Models\AddressUser;
use App\Models\Album;
use App\Models\Attributes;
use App\Models\AttributesValues;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Faqs;
use App\Models\General;
use App\Models\Index;
use App\Models\Message;
use App\Models\Products;
use App\Models\Slider;
use App\Models\Strength;
use App\Models\Testimony;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Combinacion;
use App\Models\Descargables;
use App\Models\DetalleOrden;
use App\Models\ImagenProducto;
use App\Models\Liquidacion;
use App\Models\Microcategory;
use App\Models\Ordenes;
use App\Models\Specifications;
use App\Models\Staff;
use App\Models\Subcategory;
use App\Models\TypeAttribute;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\MisClientes;
use App\Models\MisMarcas;
use App\Models\Certificados;
use App\Models\ContactDetail;
use App\Models\ContactoView;
use App\Models\HomeView;
use App\Models\InnovacionView;
use App\Models\NosotrosView;
use App\Models\PolyticsCondition;
use App\Models\ProductosView;
use App\Models\Service;
use App\Models\ServiceView;
use App\Models\SubService;
use App\Models\TermsAndCondition;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class IndexController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Obtener datos con manejo de casos donde no haya resultados
    $home = HomeView::first() ?? null; // Si no hay datos, devuelve null
    $productos = Products::latest()->take(6)->get(); // Colección vacía si no hay productos
    $general = General::first(); // Registro de datos generales (única instancia)
    $servicios = Service::latest()->take(4)->get(); // Colección vacía si no hay servicios

    // Obtener el blog más reciente
    $mostRecentPost = Blog::where('visible', true)
      ->latest()
      ->with('category')
      ->first();

    // Obtener los siguientes 2 blogs más recientes (excluyendo el más reciente)
    $nextTwoRecentPosts = collect(); // Inicializamos una colección vacía
    if ($mostRecentPost) {
      $nextTwoRecentPosts = Blog::where('visible', true)
        ->whereNotIn('id', [$mostRecentPost->id])
        ->latest()
        ->take(2)
        ->with('category')
        ->get();
    }

    // Obtener los últimos 3 blogs visibles para móviles
    $mobilePosts = Blog::where('visible', true)
      ->latest()
      ->take(3)
      ->with('category')
      ->get();

    // Obtener testimonios activos y visibles
    $testimonios = Testimony::where('status', 1)
      ->where('visible', 1)
      ->get();

    // Verificar si todos los datos están vacíos
    $allEmpty = empty($home) &&
      $productos->isEmpty() &&
      empty($general) &&
      $servicios->isEmpty() &&
      empty($mostRecentPost) &&
      $nextTwoRecentPosts->isEmpty() &&
      $mobilePosts->isEmpty() &&
      $testimonios->isEmpty();

    // Pasar los datos a la vista con valores seguros
    return view('public.index', [
      'home' => $home,
      'productos' => $productos,
      'general' => $general,
      'servicios' => $servicios,
      'mostRecentPost' => $mostRecentPost,
      'nextTwoRecentPosts' => $nextTwoRecentPosts,
      'testimonios' => $testimonios,
      'mobilePosts' => $mobilePosts,
      'allEmpty' => $allEmpty, // Indicador para saber si todo está vacío
    ]);
  }
  public function servicios(Request $request, $slug = null)
  {
    $servicioPage = ServiceView::first();
    $general = General::first();

    // Determinar el servicio padre
    $servicioParaHeader = null;
    $subservicioSeleccionado = null;

    if ($slug) {
      // Si viene un slug, puede ser de un servicio o subservicio
      $servicioParaHeader = Service::where('visible', 1)->where('slug', $slug)->first();

      if (!$servicioParaHeader) {
        // Si no es un servicio, buscar si es un subservicio
        $subservicioTemp = SubService::where('visible', 1)->where('slug', $slug)->with('service')->first();
        if ($subservicioTemp) {
          $servicioParaHeader = $subservicioTemp->service;
          $subservicioSeleccionado = $subservicioTemp->slug;
        }
      }
    }

    // Si no se encontró servicio, usar el primero disponible
    if (!$servicioParaHeader) {
      $servicioParaHeader = Service::where('visible', 1)->first();
    }

    if (!$servicioParaHeader) {
      return redirect()->route('index')->with('error', 'No hay servicios disponibles.');
    }

    // Obtener los subservicios del servicio específico
    $subservicios = SubService::where('visible', 1)
      ->where('service_id', $servicioParaHeader->id)
      ->get();

    // Obtener el subservicio a mostrar
    $subservicio = null;
    if ($subservicioSeleccionado) {
      $subservicio = $subservicios->where('slug', $subservicioSeleccionado)->first();
    }

    if (!$subservicio) {
      $subservicio = $subservicios->first();
      if ($subservicio) {
        $subservicioSeleccionado = $subservicio->slug;
      }
    }

    // Si no hay subservicios, pasar datos vacíos para mostrar solo el header del servicio
    if (!$subservicio) {
      $servicios = collect(); // Colección vacía
      $servicio = null;
      $servicioSeleccionado = null;
      $album = null;

      return view('public.servicio', compact('servicios', 'servicio', 'servicioPage', 'general', 'album', 'servicioSeleccionado', 'servicioParaHeader'));
    }

    // Obtener el álbum relacionado al subservicio
    $albumName = $subservicio->slug;
    $album = Album::where('name', $albumName)->withCount(['images', 'children'])->first();

    if ($album) {
      $album->load('children', 'images');
    }

    // Asignar variables con nombres compatibles con la vista
    $servicios = $subservicios;
    $servicio = $subservicio;
    $servicioSeleccionado = $subservicioSeleccionado;

    return view('public.servicio', compact('servicios', 'servicio', 'servicioPage', 'general', 'album', 'servicioSeleccionado', 'servicioParaHeader'));
  }

  public function showServicios($slug)
  {
    $general = General::first();
    $subservicio = SubService::where('slug', $slug)->first();
    if (!$subservicio && is_numeric($slug)) {
      $subservicio = SubService::find($slug);
    }

    if (!$subservicio) {
      return response('<div class="p-8 text-center text-slate-500 bg-slate-50 rounded-xl border border-slate-200"><i class="fa-solid fa-circle-info text-2xl text-amber-500 mb-2"></i><p class="font-medium">El subservicio solicitado no se encuentra disponible.</p></div>', 200);
    }

    // Extraer solo el nombre del subservicio desde la ruta en "album"
    $albumName = $subservicio->slug;

    // Buscar el álbum en la base de datos de forma segura
    $album = null;
    if (!empty($albumName)) {
      $album = Album::where('name', $albumName)->withCount('images', 'children')->first();
      if ($album) {
        $album->load('children', 'images');
      }
    }

    // Pasamos el subservicio como servicio para mantener compatibilidad con el componente
    return view('components.custom.component-servicio', ['servicio' => $subservicio, 'general' => $general, 'album' => $album]);
  }

  public function coleccion($filtro)
  {
    try {
      $collections = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

      if ($filtro == 0) {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();
      } else {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('collection_id', '=', $filtro)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->first();
      }

      return view('public.collection', compact('filtro', 'productos', 'collection', 'collections'));
    } catch (\Throwable $th) {
    }
  }

  public function catalogoFiltroAjax(Request $request)
  {
    $productos = Products::obtenerProductos();
    $page = 0;
    if (!empty($productos->nextPageUrl())) {
      $parse_url = parse_url($productos->nextPageUrl());

      if (!empty($parse_url['query'])) {
        parse_str($parse_url['query'], $get_array);
        $page = !empty($get_array['page']) ? $get_array['page'] : 0;
      }
    }

    return response()->json(
      [
        'status' => true,
        'page' => $page,
        'success' => view('public._listproduct', [
          'productos' => $productos,
        ])->render(),
      ],
      200,
    );
  }

  public function catalogo(Request $request)
  {

    // Obtener datos generales
    $general = General::first();
    $textoproducto = ProductosView::first();
    $home = HomeView::first();
    $brands = Brand::all();
    $categorias = Category::where('visible', true)->get();
    $productos = Products::where('visible', true)->get();
    $precioMaximo = Products::max('precio');

    // Retornar la vista completa
    return view('public.catalogo2', compact('brands', 'productos', 'textoproducto', 'general', 'categorias', 'home', 'precioMaximo'));
  }



  public function filterProducts(Request $request)
  {
    // Obtener los parámetros de filtrado
    $brands = $request->input('brands', []);
    $priceMin = $request->input('price_min');
    $priceMax = $request->input('price_max');
    $sort = $request->input('sort', 'default');

    // Aplicar filtros
    $products = Products::whereBetween('precio', [$priceMin, $priceMax]);

    if (!empty($brands)) {
      $products = $products->whereIn('brand_id', $brands);
    }

    // Ordenar
    switch ($sort) {
      case 'low_to_high':
        $products = $products->orderBy('precio', 'asc');
        break;
      case 'high_to_low':
        $products = $products->orderBy('precio', 'desc');
        break;
      case 'latest':
        $products = $products->orderBy('created_at', 'desc');
        break;
      case 'destacado':
        $products = $products->orderBy('destacado', 'desc');
        break;
      default:
        $products = $products->orderBy('id', 'asc');
    }

    // Obtener los productos filtrados
    $productos = $products->get();

    // Retornar la vista parcial con los productos filtrados
    return view('public._listproduct', compact('productos'))->render();
  }

  public function comentario()
  {
    $comentarios = Testimony::where('status', '=', 1)->where('visible', '=', 1)->paginate(15);
    $contarcomentarios = count($comentarios);
    return view('public.comentario', compact('comentarios', 'contarcomentarios'));
  }

  public function hacerComentario(Request $request)
  {
    $user = auth()->user();

    $newComentario = new Testimony();
    if (isset($user)) {
      $alert = null;
      $request->validate(
        [
          'testimonie' => 'required',
        ],
        [
          'testimonie.required' => 'Ingresa tu comentario',
        ],
      );

      $newComentario->name = $user->name;
      $newComentario->testimonie = $request->testimonie;
      $newComentario->visible = 0;
      $newComentario->status = 1;
      $newComentario->email = $user->email;
      $newComentario->save();

      $mensaje = 'Gracias. Tu comentario pasará por una validación y será publicado.';
      $alert = 1;
    } else {
      $alert = 2;
      $mensaje = 'Inicia sesión para hacer un comentario';
    }

    return redirect()
      ->route('comentario')
      ->with(['mensaje' => $mensaje, 'alerta' => $alert]);
  }

  public function contacto()
  {
    $images = [
      ['name' => 'John Doe', 'image' => 'https://i.ibb.co/Sstnnfy/5701db8d4318f0d93edd1f4b64493b37.png'],
      ['name' => 'Jane Smith', 'image' => 'https://i.ibb.co/n3NFXXs/969a7d7f009059cfa5c45bc3cfc941ae.png'],
      ['name' => 'Robert Brown', 'image' => 'https://i.ibb.co/mSmGhwv/cc6e3e60f69ecac1443984f93e6078eb.png'],
    ];

    $general = General::first();
    $contactoview = ContactoView::first();
    $faqs = Faqs::where('status', true)->where('visible', true)->get();

    return view('public.contacto', compact('contactoview', 'general', 'faqs', 'images'));
  }


  public function imagenes()
  {
    $images = [
      ['name' => 'John Doe', 'image' => 'https://i.ibb.co/Sstnnfy/5701db8d4318f0d93edd1f4b64493b37.png'],
      ['name' => 'Jane Smith', 'image' => 'https://i.ibb.co/n3NFXXs/969a7d7f009059cfa5c45bc3cfc941ae.png'],
      ['name' => 'Robert Brown', 'image' => 'https://i.ibb.co/mSmGhwv/cc6e3e60f69ecac1443984f93e6078eb.png'],
    ];
    return response()->json($images);
  }

  public function carrito()
  {
    //
    $url_env = $_ENV['APP_URL'];
    $departamentos = DB::table('departments')->get();
    return view('public.checkout_carrito', compact('url_env', 'departamentos'));
  }

  public function pago(Request $request)
  {
    //
    $formToken = $request->input('token');
    $codigoCompra = $request->input('codigoCompra');

    $detalleUsuario = [];
    $user = auth()->user();
    $N_orden = Ordenes::where('codigo_orden', '=', $codigoCompra)->get()->toArray();
    /* if (!isNull($user)) {
      $detalleUsuario = UserDetails::where('email', $user->email)->get();
    } */
    $detalleUsuario = UserDetails::where('id', $N_orden[0]['usuario_id'])->get();

    $distritos = DB::select('select * from districts where active = ? order by 3', [1]);
    $provincias = DB::select('select * from provinces where active = ? order by 3', [1]);
    $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

    //consultar n orden
    // traer los datos necesarios para armar el token
    // $formToken =  $this->generateFormTokenIzipay();

    $url_env = $_ENV['APP_URL'];
    return view('public.checkout_pago', compact('url_env', 'distritos', 'provincias', 'departamento', 'detalleUsuario', 'formToken', 'codigoCompra'));
  }

  private function generateFormTokenIzipay($amount, $orderId, $email)
  {
    $clientId = config('services.izipay.client_id');
    $clientSecret = config('services.izipay.client_secret');
    $auth = base64_encode($clientId . ':' . $clientSecret);

    $url = config('services.izipay.url');
    $response = Http::withHeaders([
      'Authorization' => "Basic $auth",
      'Content-Type' => 'application/json',
    ])
      ->post($url, [
        'amount' => $amount * 100,
        'currency' => 'PEN',
        'orderId' => $orderId,
        'customer' => [
          'email' => $email,
        ],
      ])
      ->json();

    $token = $response['answer']['formToken'];
    return $token;
  }

  public function procesarPago(Request $request)
  {
    $codigoCompra = $request->codigoCompra;
    $dataArray = $request->data;
    $result = [];

    $codigoAleatorio = '';
    foreach ($dataArray as $item) {
      $result[$item['name']] = $item['value'];
    }
    $tipoTarjeta = $result['tipo_tarjeta'];

    try {
      $reglasPrimeraCompra = [
        'email' => 'required',
      ];
      $mensajes = [
        'email.required' => 'El campo Email es obligatorio.',
      ];
      // $request->validate($reglasPrimeraCompra, $mensajes);

      $orden = Ordenes::where('codigo_orden', '=', $codigoCompra);

      $orden->update(['tipo_tarjeta' => $tipoTarjeta]);

      $ordenid = $orden->get();
      AddressUser::where('id', $ordenid[0]['address_id'])->update([
        'dir_av_calle' => $result['dir_av_calle'],
        'dir_numero' => $result['dir_numero'],
        'dir_bloq_lote' => $result['dir_bloq_lote'],
      ]);

      UserDetails::where('email', '=', $request->email)->update($result);

      return response()->json(['message' => 'Todos los datos estan correctos', 'codigoCompra' => $codigoAleatorio]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => $th], 400);
    }
  }

  private function guardarOrden()
  {
    //almacenar venta, generar orden de pedido , guardar en tabla detalle de compra, li
  }

  private function codigoVentaAleatorio()
  {
    $codigoAleatorio = '';

    // Longitud deseada del código
    $longitudCodigo = 10;

    // Genera un código aleatorio de longitud 10
    for ($i = 0; $i < $longitudCodigo; $i++) {
      $codigoAleatorio .= mt_rand(0, 9); // Agrega un dígito aleatorio al código
    }
    return $codigoAleatorio;
  }

  public function agradecimiento(Request $request)
  {
    //
    $codigoCompra = $request->input('codigoCompra');

    $ordenes = Ordenes::where('codigo_orden', '=', $codigoCompra)->update(['status_id' => 2]);

    return view('public.checkout_agradecimiento', compact('codigoCompra'));
  }

  public function cambiofoto(Request $request)
  {
    $user = User::findOrFail($request->id);

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $route = 'storage/images/users/';
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

      if (File::exists(storage_path() . '/app/public/' . $user->profile_photo_path)) {
        File::delete(storage_path() . '/app/public/' . $user->profile_photo_path);
      }

      $this->saveImg($file, $route, $nombreImagen);

      $routeforshow = 'images/users/';
      $user->profile_photo_path = $routeforshow . $nombreImagen;

      $user->save();

      return response()->json(['message' => 'La imagen se cargó correctamente.']);
    }
  }

  public function actualizarPerfil(Request $request)
  {
    $name = $request->name;
    $lastname = $request->lastname;
    $email = $request->email;
    $user = User::findOrFail($request->id);

    if ($request->password !== null || $request->newpassword !== null || $request->confirmnewpassword !== null) {
      if (!Hash::check($request->password, $user->password)) {
        $imprimir = 'La contraseña actual no es correcta';
        $alert = 'error';
      } else {
        $user->password = Hash::make($request->newpassword);
        $imprimir = 'Cambio de contraseña exitosa';
        $alert = 'success';
      }
    }

    if ($user->name == $name && $user->lastname == $lastname) {
      $imprimir = 'Sin datos que actualizar';
      $alert = 'question';
    } else {
      $user->name = $name;
      $user->lastname = $lastname;
      $alert = 'success';
      $imprimir = 'Datos actualizados';
    }

    $user->save();
    return response()->json(['message' => $imprimir, 'alert' => $alert]);
  }

  public function micuenta()
  {
    $user = Auth::user();
    return view('public.dashboard', compact('user'));
  }

  public function pedidos()
  {
    $user = Auth::user();

    $detalleUsuario = UserDetails::where('email', $user->email)
      ->get()
      ->toArray();

    $ordenes = Ordenes::where('usuario_id', $detalleUsuario[0]['id'])
      ->with('DetalleOrden')
      ->with('statusOrdenes')
      ->get();

    return view('public.dashboard_order', compact('user', 'ordenes'));
  }

  public function direccionFavorita(Request $request)
  {
    $item = AddressUser::find($request->id);
    if ($item) {
      AddressUser::where('user_id', $item->user_id)->update(['favorite' => 0]);
      $item->favorite = 1;
      $item->save();

      return response()->json(['message' => 'Dirección favorita modificada']);
    }

    return response()->json(['error' => 'Item no encontrado'], 404);
  }

  public function direccion()
  {
    $user = Auth::user();
    $direcciones = AddressUser::where('user_id', $user->id)->get();
    $departamentofiltro = DB::select('select * from departments where active = ? order by 2', [1]);
    $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

    foreach ($direcciones as $direccion) {
      $distrito = DB::table('districts')
        ->where('id', $direccion->distrito_id)
        ->first();
      $provincia = DB::table('provinces')
        ->where('id', $direccion->provincia_id)
        ->first();
      $departamento = DB::table('departments')
        ->where('id', $direccion->departamento_id)
        ->first();

      $direccion->distrito_id = $distrito ? $distrito->description : '';
      $direccion->provincia_id = $provincia ? $provincia->description : '';
      $direccion->departamento_id = $departamento ? $departamento->description : '';
    }

    return view('public.dashboard_direccion', compact('user', 'direcciones', 'departamento', 'departamentofiltro'));
  }

  public function obtenerProvincia($departmentId)
  {
    $provinces = DB::select('select * from provinces where active = ? and department_id = ? order by description', [1, $departmentId]);
    return response()->json($provinces);
  }

  public function obtenerDistritos($provinceId)
  {
    $distritos = DB::select('select * from districts where active = ? and province_id = ? order by description', [1, $provinceId]);
    return response()->json($distritos);
  }

  public function guardarDireccion(Request $request)
  {
    $user = Auth::user();
    $direccion = new AddressUser();

    $direccion->departamento_id = $request->departamento_id;
    $direccion->provincia_id = $request->provincia_id;
    $direccion->distrito_id = $request->distrito_id;
    $direccion->dir_av_calle = $request->nombre_calle;
    $direccion->dir_numero = $request->numero_calle;
    $direccion->dir_bloq_lote = $request->direccion;
    $direccion->user_id = $user->id;
    $direccion->save();

    return response()->json(['message' => 'Dirección guardada exitosamente']);
  }

  public function error()
  {
    return response()->view('public.404', [], 404);
  }



  public function cambioGaleria(Request $request)
  {
    $colorId = $request->id;
    $productId = $request->idproduct;

    $images = ImagenProducto::where('color_id', $colorId)->where('product_id', $productId)->get();

    // return response()->json(['images' => $images]);
    // $productos = Products::where('id', '=', $productId)->with('attributes')->with('tags')->get();
    $tallas = Combinacion::where('color_id', $colorId)->where('product_id', $productId)->with('talla')->get();

    return response()->json(
      [
        'status' => true,
        'images' => $images,
        'tallas' => $tallas,
      ],
      200,
    );
  }


  public function productoShow($slug)
  {
    $general = General::first();
    $producto = Products::where('slug', '=', $slug)
      ->with('category')
      ->with('brand')
      ->firstOrFail();

    $productoRelacionado = Products::where('categoria_id', '=', $producto->categoria_id)
      ->where('id', '!=', $producto->id)
      ->latest()
      ->take(3)
      ->get();

    // Extraer solo el nombre del producto desde la ruta en "album"
    $albumName = $producto->slug;

    // Buscar el álbum en la base de datos
    $album = Album::where('name', $albumName)->withCount('images', 'children')->first();
    if ($album) {
      $album->load('children', 'images');
    }

    return view('public.product', compact('producto', 'productoRelacionado', 'album', 'general'));
  }

  public function producto(string $id)
  {

    $producto = Products::where('id', '=', $id)->first();




    $productos = Products::where('id', '=', $id)->with('attributes')->with('tags')->get();


    $especificaciones = Specifications::where('product_id', '=', $id)
      ->where(function ($query) {
        $query->whereNotNull('tittle')->orWhereNotNull('specifications');
      })
      ->get();
    $productosConGalerias = DB::select(
      "
            SELECT products.*, galeries.*
            FROM products
            INNER JOIN galeries ON products.id = galeries.product_id
            WHERE products.id = :productId limit 5
        ",
      ['productId' => $id],
    );

    $IdProductosComplementarios = $productos->toArray();
    $IdProductosComplementarios = $IdProductosComplementarios[0]['categoria_id'];

    $ProdComplementarios = $producto->productrelacionados()->where('status', 1)->get();

    if ($ProdComplementarios->isEmpty()) {
      $ProdComplementarios = Products::where('categoria_id', '=', $IdProductosComplementarios)
        ->where('id', '!=', $producto->id) // Excluir el producto actual
        ->where('status', 1)
        ->get();
    }

    //$productosRelacionados = Products::where('categoria_id', '=', $IdProductosComplementarios)->get();

    $atributos = Attributes::where('status', '=', true)->get();


    $valorAtributo = AttributesValues::where('status', '=', true)->get();

    $url_env = $_ENV['APP_URL'];

    return view('public.product', compact('meta_title', 'meta_description', 'meta_keywords', 'producto', 'productos', 'atributos', 'valorAtributo', 'ProdComplementarios', 'productosConGalerias', 'especificaciones', 'url_env', 'colors'));
  }

  public function liquidacion()
  {
    try {
      $liquidacion = Products::where('status', '=', 1)->where('visible', '=', 1)->where('liquidacion', '=', 1)->paginate(16);

      return view('public.liquidacion', compact('liquidacion'));
    } catch (\Throwable $th) {
    }
  }

  public function nosotros()
  {
    try {
      $general = General::first();
      $textosnosotros = NosotrosView::first();
      $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
      $staff = Staff::where('status', '=', 1)->get();
      $valores = MisClientes::where('status', '=', 1)->where('visible', '=', 1)->get();
      $certificados = Certificados::where('status', '=', 1)->where('visible', '=', 1)->get();
      // $nosotros = AboutUs::where('status', '=', 1)->get();
      $benefit = Strength::where('status', '=', 1)->get();

      /*IMPLEMENTACION DAR TELECOM  */

      $nosotros = AboutUs::first();
      $home = HomeView::first();
      return view('public.nosotros', compact('nosotros', 'home', 'textosnosotros', 'benefit', 'general', 'testimonie', 'staff', 'nosotros', 'valores', 'certificados'));
    } catch (\Throwable $th) {
    }
  }

  public function innovaciones()
  {
    $general = General::first();
    $innovaciontext = InnovacionView::first();
    return view('public.innovaciones', compact('general', 'innovaciontext'));
  }

  public function novedades()
  {
    try {
      $novedades = Products::where('status', '=', 1)->where('visible', '=', 1)->where('recomendar', '=', 1)->paginate(16);

      return view('public.novedades', compact('novedades'));
    } catch (\Throwable $th) {
    }
  }

  public function blog(Request $request, string $filtro = null)
  {

    $generales = General::all()->first();
    // Obtener el blog más reciente
    $mostRecentPost = Blog::where('visible', true)
      ->latest()
      ->with('category')
      ->first();

    // Obtener los siguientes 2 blogs más recientes (excluyendo el más reciente)
    $nextTwoRecentPosts = Blog::where('visible', true)
      ->whereNotIn('id', [$mostRecentPost->id])
      ->latest()
      ->take(2)
      ->with('category')
      ->get();

    // Obtener todos los blogs restantes (excluyendo los 3 anteriores)
    $excludedIds = $nextTwoRecentPosts->pluck('id')->push($mostRecentPost->id)->toArray();

    $remainingPosts = Blog::where('visible', true)
      ->whereNotIn('id', $excludedIds)
      ->latest()
      ->take(6)
      ->with('category')
      ->get();

    return view('public.blog', compact('generales', 'mostRecentPost', 'nextTwoRecentPosts', 'remainingPosts'));
  }

  public function detalleBlog($slug)
  {
    $post = Blog::where('slug', '=', $slug)
      ->with('category')
      ->firstOrFail();

    $postsrelacionados = Blog::where('visible', '=', 1)
      ->where('category_post_id', '=', $post->category_post_id)
      ->where('id', '!=', $post->id) // Excluir el post actual
      ->take(3)
      ->latest()
      ->with('category')
      ->get();



    return view('public.post', compact('post', 'postsrelacionados'));
  }

  public function catalogosDescargables($filtro)
  {
    try {
      $categorias = Category::where('status', '=', 1)->where('visible', '=', 1)->orderBy('order', 'asc')->get();

      if ($filtro == 0) {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
        $descargables = Descargables::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);

        $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->get();
        //$categoria = Category::all();
      } else {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
        $descargables = Descargables::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->paginate(16);

        $categoria = Category::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->get();
        //$categorias = Category::findOrFail($filtro);
      }

      return view('public.descargables', compact('descargables', 'categorias', 'filtro', 'categoria'));
    } catch (\Throwable $th) {
    }
  }

  public function searchProduct(Request $request)
  {
    $query = $request->input('query');
    $resultados = Products::where('producto', 'like', "%$query%")->where('visible', '=', true)->where('status', '=', true)
      ->with('categoria')->get();

    return response()->json($resultados);
  }
  //  --------------------------------------------
  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreIndexRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Index $index)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Index $index)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateIndexRequest $request, Index $index)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Index $index)
  {
    //
  }

  /**
   * Realizado para Dar Telecom
   */
  /**
   * Procesa y extrae datos técnicos del cliente (IP real, dispositivo, SO, navegador)
   */
  private function procesarDatosTecnicos(Request $request): array
  {
    $userAgent = $request->userAgent() ?? '';

    // 1. IP Real (Soporte Cloudflare, Proxies y Balanceadores)
    $ip = null;
    $headersToCheck = [
      'HTTP_CF_CONNECTING_IP',
      'HTTP_TRUE_CLIENT_IP',
      'HTTP_X_REAL_IP',
      'HTTP_X_FORWARDED_FOR',
      'HTTP_CLIENT_IP',
      'CF-Connecting-IP',
      'X-Forwarded-For',
      'X-Real-IP',
    ];
    foreach ($headersToCheck as $header) {
      $val = $request->server($header) ?? $request->header($header);
      if ($val) {
        $ipList = explode(',', $val);
        $candidate = trim($ipList[0]);
        if (filter_var($candidate, FILTER_VALIDATE_IP)) {
          $ip = $candidate;
          break;
        }
      }
    }
    if (!$ip) {
      $ip = $request->ip() ?? ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
    }

    // 2. Detección de Dispositivo a partir de User-Agent y dimensiones
    $device = 'desktop';
    $isMobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent);
    $isTablet = preg_match('/android|ipad|playbook|silk/i', $userAgent) && !preg_match('/mobile/i', $userAgent);

    if ($isMobile) {
      $device = 'mobile';
    } elseif ($isTablet) {
      $device = 'tablet';
    } elseif ($request->filled('dispositivo')) {
      $device = strtolower($request->dispositivo);
    } elseif ($request->filled('anchodispositivo')) {
      $ancho = (int) $request->anchodispositivo;
      if ($ancho > 0 && $ancho < 768) {
        $device = 'mobile';
      } elseif ($ancho >= 768 && $ancho <= 1024) {
        $device = 'tablet';
      }
    }

    // 3. Detección de Sistema Operativo
    $os = 'Desconocido';
    $osList = [
      '/iphone/i'             => 'iOS (iPhone)',
      '/ipad/i'               => 'iPadOS',
      '/android/i'            => 'Android',
      '/windows nt 10/i'      => 'Windows 10/11',
      '/windows nt 6.3/i'     => 'Windows 8.1',
      '/windows nt 6.2/i'     => 'Windows 8',
      '/windows nt 6.1/i'     => 'Windows 7',
      '/macintosh|mac os x/i' => 'macOS',
      '/linux/i'              => 'Linux',
      '/cros/i'               => 'Chrome OS',
    ];
    foreach ($osList as $regex => $value) {
      if (preg_match($regex, $userAgent)) {
        $os = $value;
        break;
      }
    }

    // 4. Detección de Navegador
    $browser = 'Desconocido';
    if (preg_match('/edg/i', $userAgent)) {
      $browser = 'Microsoft Edge';
    } elseif (preg_match('/opr|opera/i', $userAgent)) {
      $browser = 'Opera';
    } elseif (preg_match('/samsungbrowser/i', $userAgent)) {
      $browser = 'Samsung Internet';
    } elseif (preg_match('/chrome/i', $userAgent) && !preg_match('/edg/i', $userAgent)) {
      $browser = 'Google Chrome';
    } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
      $browser = 'Safari';
    } elseif (preg_match('/firefox/i', $userAgent)) {
      $browser = 'Mozilla Firefox';
    }

    // 5. Consolidación de client_system
    $clientSystem = $request->sistema;
    if (empty($clientSystem) || $clientSystem === 'Sin data' || $clientSystem === 'Win32' || $clientSystem === 'Linux armv81') {
      $clientSystem = "{$os} | {$browser}";
    }

    return [
      'ip'               => $ip,
      'device'           => $device,
      'client_system'    => $clientSystem,
      'client_width'     => $request->anchodispositivo ?? $request->client_width,
      'client_height'    => $request->largodispositivo ?? $request->client_height,
      'client_latitude'  => $request->latitud ?? $request->client_latitude,
      'client_longitude' => $request->longitud ?? $request->client_longitude,
      'source_ref'       => $request->llegade ?? null,
    ];
  }

  public function guardarContacto(Request $request)
  {
    $data = $request->all();

    // Soporte para campo unificado 'full_name' o separados 'name' y 'lastname'
    if ($request->filled('full_name') && !$request->filled('name')) {
      $parts = explode(' ', trim($request->full_name), 2);
      $name = $parts[0] ?? $request->full_name;
      $lastname = !empty($parts[1]) ? $parts[1] : $name;
      $request->merge([
        'name' => $name,
        'lastname' => $lastname,
      ]);
      $data['name'] = $name;
      $data['lastname'] = $lastname;
    } else if ($request->filled('name')) {
      $data['full_name'] = trim(($request->name ?? '') . ' ' . ($request->lastname ?? ''));
      $request->merge(['full_name' => $data['full_name']]);
    }

    // Normalizar teléfono a 9 dígitos si viene con prefijo +51 o espacios
    if ($request->filled('phone')) {
      $cleanPhone = preg_replace('/[^0-9]/', '', (string)$request->phone);
      if (str_starts_with($cleanPhone, '51') && strlen($cleanPhone) === 11) {
        $cleanPhone = substr($cleanPhone, 2);
      }
      $request->merge(['phone' => $cleanPhone]);
      $data['phone'] = $cleanPhone;
    }

    // Guardar cada campo en su columna correspondiente de la BD (sin concatenar)
    $data['full_name'] = $request->full_name ?? null;
    $data['company'] = $request->company ?? null;
    $data['city'] = $request->city ?? null;
    $data['service_product'] = $request->service_product ?? 'Comprar equipos';
    $data['message'] = $request->message ?? '';
    $data['source'] = $request->source ?? 'Formulario Web';
    $data['comunication'] = $request->comunication ?? 'Formulario Web';

    // Captura técnica avanzada de IP, dispositivo, navegador y sistema
    $datosTecnicos = $this->procesarDatosTecnicos($request);
    $data['ip'] = $datosTecnicos['ip'];
    $data['device'] = $datosTecnicos['device'];
    $data['client_system'] = $datosTecnicos['client_system'];
    $data['client_width'] = $datosTecnicos['client_width'];
    $data['client_height'] = $datosTecnicos['client_height'];
    $data['client_latitude'] = $datosTecnicos['client_latitude'];
    $data['client_longitude'] = $datosTecnicos['client_longitude'];

    try {
      $reglasValidacion = [
        'full_name' => 'required|string|min:3|max:255',
        'company' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|digits:9',
        'city' => 'required|string|max:255',
        'message' => 'required|string|min:5|max:3000',
        'service_product' => 'nullable|string|max:255',
      ];

      $mensajes = [
        'full_name.required' => 'El campo nombres y apellidos es obligatorio.',
        'full_name.min' => 'El nombre debe tener al menos :min caracteres.',
        'company.required' => 'El campo empresa / razón social es obligatorio.',
        'company.min' => 'La empresa debe tener al menos :min caracteres.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
        'phone.required' => 'El campo teléfono es obligatorio.',
        'phone.digits' => 'El teléfono debe tener 9 dígitos.',
        'city.required' => 'El campo ciudad / región es obligatorio.',
        'message.required' => 'El campo mensaje es obligatorio.',
        'message.min' => 'El mensaje debe tener al menos :min caracteres.',
        'message.max' => 'El campo mensaje no puede tener más de :max caracteres.',
      ];

      $request->validate($reglasValidacion, $mensajes);

      $saved = Message::create($data);

      try {
        $this->envioCorreoAdmin($saved);
        $this->envioCorreoCliente($saved);
      } catch (\Throwable $th) {
        // Silenciar si SMTP no está configurado
      }

      return response()->json(['message' => 'Mensaje enviado con éxito', 'data' => $saved]);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Ocurrió un error inesperado. Inténtalo de nuevo.'], 500);
    }
  }

  public function guardarContactoWsp(Request $request)
  {
    $data = $request->all();

    // Soporte para full_name o name/lastname
    if ($request->filled('full_name') && !$request->filled('name')) {
      $parts = explode(' ', trim($request->full_name), 2);
      $name = $parts[0] ?? $request->full_name;
      $lastname = !empty($parts[1]) ? $parts[1] : $name;
      $request->merge([
        'name' => $name,
        'lastname' => $lastname,
      ]);
      $data['name'] = $name;
      $data['lastname'] = $lastname;
    } else if ($request->filled('name')) {
      $data['full_name'] = trim(($request->name ?? '') . ' ' . ($request->lastname ?? ''));
      $request->merge(['full_name' => $data['full_name']]);
    }
    $data['full_name'] = $request->full_name ?? null;

    // Normalizar teléfono a 9 dígitos si viene con prefijo +51 o espacios
    if ($request->filled('phone')) {
      $cleanPhone = preg_replace('/[^0-9]/', '', (string)$request->phone);
      if (str_starts_with($cleanPhone, '51') && strlen($cleanPhone) === 11) {
        $cleanPhone = substr($cleanPhone, 2);
      }
      $request->merge(['phone' => $cleanPhone]);
      $data['phone'] = $cleanPhone;
    }

    try {
      $reglasValidacion = [
        'full_name' => 'required|string|min:3|max:255',
        'company' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|digits:9',
        'city' => 'required|string|max:255',
        'message' => 'required|string|min:5|max:3000',
        'service_product' => 'nullable|string|max:255',
      ];

      $mensajes = [
        'full_name.required' => 'El campo nombres y apellidos es obligatorio.',
        'full_name.min' => 'El nombre debe tener al menos :min caracteres.',
        'company.required' => 'El campo empresa / razón social es obligatorio.',
        'company.min' => 'La empresa debe tener al menos :min caracteres.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
        'phone.required' => 'El campo teléfono es obligatorio.',
        'phone.digits' => 'El teléfono debe tener 9 dígitos.',
        'city.required' => 'El campo ciudad / región es obligatorio.',
        'message.required' => 'El campo mensaje es obligatorio.',
        'message.min' => 'El mensaje debe tener al menos :min caracteres.',
        'message.max' => 'El campo mensaje no puede tener más de :max caracteres.',
      ];

      $request->validate($reglasValidacion, $mensajes);

      // Asignar campos individuales
      $data['company'] = $request->company;
      $data['city'] = $request->city;
      $data['service_product'] = $request->service_product ?? 'Comprar equipos';
      $data['message'] = $request->message;
      $data['source'] = 'WhatsApp';
      $data['comunication'] = 'WhatsApp';

      // Captura técnica avanzada de IP, dispositivo, navegador y sistema
      $datosTecnicos = $this->procesarDatosTecnicos($request);
      $data['ip'] = $datosTecnicos['ip'];
      $data['device'] = $datosTecnicos['device'];
      $data['client_system'] = $datosTecnicos['client_system'];
      $data['client_width'] = $datosTecnicos['client_width'];
      $data['client_height'] = $datosTecnicos['client_height'];
      $data['client_latitude'] = $datosTecnicos['client_latitude'];
      $data['client_longitude'] = $datosTecnicos['client_longitude'];

      // Registrar en BD
      $saved = null;
      try {
        $saved = Message::create($data);
        try {
          $this->envioCorreoAdmin($saved);
        } catch (\Throwable $th) {
          // Silenciar si SMTP no está configurado
        }
      } catch (\Throwable $th) {
        \Log::error('Error al guardar contacto de WhatsApp en BD: ' . $th->getMessage());
      }

      // Obtener WhatsApp configurado en Datos Generales del panel de admin
      $whatsappNumber = '51908931873';
      try {
        $general = General::first();
        if ($general && !empty($general->whatsapp)) {
          $whatsappNumber = preg_replace('/[^0-9]/', '', $general->whatsapp);
        }
      } catch (\Throwable $th) {
        // Fallback al número por defecto
      }

      // Construir mensaje estructurado
      $textoWsp = "👋 *Hola Dar Telecom*, deseo consultar sobre sus servicios:\n";
      if (!empty($data['full_name'])) $textoWsp .= "\n👤 *Nombre:* " . $data['full_name'];
      if (!empty($data['company'])) $textoWsp .= "\n🏢 *Empresa:* " . $data['company'];
      if (!empty($data['email'])) $textoWsp .= "\n✉️ *Correo:* " . $data['email'];
      if (!empty($data['phone'])) $textoWsp .= "\n📱 *Teléfono:* " . $data['phone'];
      if (!empty($data['city'])) $textoWsp .= "\n📍 *Ciudad/Región:* " . $data['city'];
      if (!empty($data['service_product'])) $textoWsp .= "\n🎯 *Interés:* " . $data['service_product'];
      if (!empty($data['message'])) $textoWsp .= "\n💬 *Mensaje:* " . $data['message'];

      $wspUrl = "https://api.whatsapp.com/send?phone=" . $whatsappNumber . "&text=" . urlencode($textoWsp);

      return response()->json([
        'status' => 'success',
        'whatsapp_url' => $wspUrl,
        'whatsapp_number' => $whatsappNumber,
        'message' => 'Redirigiendo a WhatsApp',
        'data' => $saved
      ]);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Ocurrió un error inesperado al procesar el contacto para WhatsApp.'], 500);
    }
  }

  public function guardarProducto(Request $request)
  {
    $data = $request->all();
    $data['full_name'] = $request->full_name;
    $data['service_product'] = $request->service_product;
    $ipAddress = $request->ip();
    $ancho = $request->client_width;
    $latitud = $request->client_latitude;
    $longitud = $request->client_longitude;
    $sistema = $request->client_system;

    try {
      $reglasValidacion = [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      ];
      $mensajes = [
        'full_name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
      ];
      $request->validate($reglasValidacion, $mensajes);


      if (!is_null($ipAddress)) {
        $data['ip'] = $ipAddress;
      } else {
        $data['ip'] = 'Sin data';
      }

      if (!is_null($latitud)) {
        $data['client_latitude'] = $latitud;
      } else {
        $data['client_latitude'] = 'Sin data';
      }

      if (!is_null($longitud)) {
        $data['client_longitude'] = $longitud;
      } else {
        $data['client_longitude'] = 'Sin data';
      }

      if (!is_null($sistema)) {
        $data['client_system'] = $sistema;
      } else {
        $data['client_system'] = 'Sin data';
      }


      if ($ancho >= 1 && $ancho <= 767) {
        $data['device'] = 'mobile';
      } elseif ($ancho >= 768 && $ancho <= 1024) {
        $data['device'] = 'tablet';
      } elseif ($ancho >= 1025) {
        $data['device'] = 'desktop';
      } elseif (is_null($ancho)) {
        $data['device'] = 'Sin data';
      }


      $formlanding = Message::create($data);
      $this->envioCorreoAdmin($formlanding);
      $this->envioCorreoCliente($formlanding);

      return response()->json(['message' => 'Mensaje enviado con exito']);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    }
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img = $manager->read($file);

    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }
    $img->save($route . $nombreImagen);
  }

  private function envioCorreoAdmin($data)
  {
    $generales = General::first();
    $destinatarios = $generales ? $generales->getNotificationEmails() : ['ventas@dartelecom.pe'];
    $appUrl = env('APP_URL', url('/'));

    $clientName = is_array($data) ? ($data['full_name'] ?? 'Cliente') : ($data->full_name ?? 'Cliente');
    $clientCompany = is_array($data) ? ($data['company'] ?? '') : ($data->company ?? '');
    $subjectName = $clientCompany ? "{$clientName} ({$clientCompany})" : $clientName;

    try {
      $mail = EmailConfig::config("DarTelecom", "Nueva Solicitud de {$subjectName}");
      
      // Agregar todos los correos destinatarios configurados
      foreach ($destinatarios as $destinatario) {
        $mail->addAddress($destinatario);
      }

      $mail->isHTML(true);
      $mail->Body = view('mail.contact_admin', [
        'data' => is_array($data) ? $data : $data->toArray(),
        'general' => $generales,
        'appUrl' => $appUrl
      ])->render();
      $mail->send();
    } catch (\Throwable $th) {
      \Log::error('Error al enviar correo de notificación al administrador: ' . $th->getMessage());
    }
  }

  private function envioCorreoCliente($data)
  {
    $clientEmail = is_array($data) ? ($data['email'] ?? null) : ($data->email ?? null);
    if (empty($clientEmail)) {
      return;
    }

    $generales = General::first();
    $appUrl = env('APP_URL', url('/'));

    try {
      $mail = EmailConfig::config("DarTelecom Perú", "Hemos recibido tu consulta");
      $mail->addAddress($clientEmail);
      $mail->isHTML(true);
      $mail->Body = view('mail.contact_client', [
        'data' => is_array($data) ? $data : $data->toArray(),
        'general' => $generales,
        'appUrl' => $appUrl
      ])->render();
      $mail->send();
    } catch (\Throwable $th) {
      \Log::error('Error al enviar correo de confirmación al cliente: ' . $th->getMessage());
    }
  }

  public function procesarCarrito(Request $request)
  {
    $primeraVez = false;

    try {
      $codigoOrden = $this->codigoVentaAleatorio();
      $jsonMonto = json_decode($request->total, true);
      $montoT = $jsonMonto['total'];
      $subMonto = $jsonMonto['suma'];

      $precioEnvio = $montoT - $subMonto;
      $email = $request->email;

      $usuario = UserDetails::where('email', '=', $email)->get(); // obtenemos usuario para validarlo si no agregarlo

      //si tiene usuario registrad

      if (!$usuario->isNotEmpty()) {
        $usuario = UserDetails::create(['email' => $email]);
        $primeraVez = true;
      }

      $addres = AddressUser::create([
        'departamento_id' => (int) $request->departamento,
        'provincia_id' => (int) $request->provincia,
        'distrito_id' => (int) $request->distrito,
        'user_id' => $usuario[0]['id'],
      ]);
      $this->GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $request->carrito, $addres);

      $formToken = $this->generateFormTokenIzipay($montoT, $codigoOrden, $email);

      //
      return response()->json(['mensaje' => 'Orden generada correctamente', 'formToken' => $formToken, 'codigoOrden' => $codigoOrden, 'primeraVez' => $primeraVez]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['mensaje' => "Intente de nuevo mas tarde , estamos trabajando en una solucion , $th"], 400);
    }
  }
  private function GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $carrito, $addres)
  {
    $data['codigo_orden'] = $codigoOrden;
    $data['monto'] = $montoT;
    $data['precio_envio'] = $precioEnvio;
    $data['status_id'] = '1';
    $data['usuario_id'] = $usuario[0]['id'];
    $data['address_id'] = $addres['id'];

    $orden = Ordenes::create($data);

    //creamos detalle de orden
    foreach ($carrito as $key => $value) {
      DetalleOrden::create([
        'producto_id' => $value['id'],
        'cantidad' => $value['cantidad'],
        'orden_id' => $orden->id,
        'precio' => $value['precio'],
        'talla' => $value['talla'],
        'color' => $value['color']['valor'],
      ]);
    }
  }

  public function politicasDevolucion()

  {
    $politicDev = PolyticsCondition::first();
    return view('public.politicasdeenvio', compact('politicDev'));
  }

  public function TerminosyCondiciones()

  {
    $termsAndCondicitions = TermsAndCondition::first();
    return view('public.terminosycondiciones', compact('termsAndCondicitions'));
  }

  public function obtenerdata(Request $request)
  {

    try {
      $producto = Products::where('id', '=', $request->id)->first();
      return response()->json(['menssage' => 'Data obtenida', 'producto' => $producto]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['menssage' => "Ocurrio un error , $th"], 400);
    }
  }
}
