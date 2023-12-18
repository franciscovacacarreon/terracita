<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'Mi Terracita | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Mi</b>Terracita',
    'logo_img' => 'images/restaurante/terracita_img.jpeg',
    'logo_img_class' => 'brand-image img-circle elevation-3 imagen-logo',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'images/restaurante/terracita_img.jpeg',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true, //Etiqueta de usuario activa
    'usermenu_header' => false, //Aparezca en el header
    'usermenu_header_class' => 'bg-primary', //Color de los submenu
    'usermenu_image' => false, //Imagen, metodo en el modelo user adminlte_image
    'usermenu_desc' => false,  //Rol del usuario, metodo en el modelo adminlte_desc
    'usermenu_profile_url' => false, //Perfil del usuario, metodo adminlte_profile_url

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null, //cambiar sidebar
    'layout_boxed' => null, //genera solo con un ancho de 1250
    'layout_fixed_sidebar' => true, // Solo baja el sidebar
    'layout_fixed_navbar' => true, //menu header fijo
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    //Personalizar el login
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    //Cuerpo de la plantilla (sidebar)
    'classes_body' => '',
    'classes_brand' => '', //cabecera e imagen del sidebar
    'classes_brand_text' => '', //Texto principal del sidebar
    'classes_content_wrapper' => '', //contenido de la pagina
    'classes_content_header' => '', //Header del contenidos
    'classes_content' => '', //content de la pagina
    'classes_sidebar' => 'sidebar-dark-primary elevation-4', //link activos primary
    'classes_sidebar_nav' => '', //Clase para personalizar el sidebar
    'classes_topnav' => 'navbar-ligth navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg', //Para que desaparezca el sidebar por completo
    'sidebar_collapse' => false, //Para que en un inicio el sidebar este cerrado
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300, //Tiempo de espera para desplazarce

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => true,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => false,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true, //topnav_user para que se coloque en el menu de usuario
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog', //directiva can para verificar si tiene permisos
        ],
        ['header' => 'Ventas'],
        [
            'text'    => 'Ventas',
            'icon'    => 'fas fa-fw fa-tag',
            'submenu' => [
                [
                    'text' => 'Nueva venta',
                    'url'  => 'admin/nota-venta-create',
                    'icon'  => 'fas fa-fw fa-dollar-sign',
                    'can'     => 'ventas',
                ],
                [
                    'text' => 'Ventas',
                    'url'  => 'admin/nota-venta',
                    'icon'    => 'fas fa-fw fa-list-ul',
                    'can'     => 'ventas',
                ],
                [
                    'text' => 'Métodos de pago',
                    'url'  => 'admin/tipo-pago',
                    'icon'    => 'fas fa-fw fa-credit-card',
                    'can'     => 'ventas',
                ],
            ],
        ],
        ['header' => 'Pedidos'],
        [
            'text'    => 'Pedidos',
            'icon'    => 'fas fa-fw fa-shopping-cart',
            'submenu' => [
                [
                    'text' => 'Pedidos',
                    'url'  => 'admin/pedido',
                    'icon'  => 'fas fa-fw fa-shopping-cart',
                    'can'     => 'pedidos',
                ],
                [
                    'text' => 'Mis pedidos',
                    'url'  => 'admin/mispedidos',
                    'icon'  => 'fas fa-fw fa-receipt',
                    'can'     => 'mispedidos',
                ],
            ],
        ],
        ['header' => 'Items menú'],
        [
            'text'    => 'Menú e item',
            'icon'    => 'fas fa-fw fa-utensils', //fas fa-fw por defecto en la plantilla
            'submenu' => [
                [
                    'text' => 'Catalogo menú',
                    'url'  => 'admin/menu',
                    'icon'    => 'fas fa-fw fa-book',
                    'can'     => 'items',
                ],
                [
                    'text' => 'Item menú',
                    'url'  => 'admin/item-menu',
                    'icon'    => 'fas fa-fw fa-utensil-spoon',
                    'can'     => 'items',
                ],
                [
                    'text' => 'Tipo item menú',
                    'url'  => 'admin/tipo-menu',
                    'icon'    => 'fas fa-fw fa-hamburger',
                    'can'     => 'items',
                ],
            ],
        ],
        ['header' => 'Personas y usuarios'],
        [
            'text'    => 'Personas',
            'icon'    => 'fas fa-fw fa-user-friends',
            'submenu' => [
                [
                    'text' => 'Clientes',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/cliente',
                    'can'     => 'items', //si puede ver items es cajero (no hay tiempo de un nuevo permiso :,v)
                ],
                [
                    'text' => 'Empleados',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'url'  => 'admin/empleado',
                    'can'     => 'usuarios',
                ],
                [
                    'text' => 'Repartidores',
                    'icon' => 'fas fa-fw fa-motorcycle',
                    'url'  => 'admin/repartidor',
                    'can'     => 'items',
                ],
            ],
        ],        
        [
            'text'    => 'Usuarios',
            'icon'    => 'fas fa-fw fa-users',
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/user',
                    'can'     => 'usuarios',
                ],
                [
                    'text' => 'Roles',
                    'icon' => 'fas fa-fw fa-lock',
                    'url'  => 'admin/rol',
                    'can'  => 'usuarios',
                ],
            ],
        ],
        ['header' => 'Vehiculos'],
        [
            'text'    => 'Vehículos',
            'icon'    => 'fas fa-fw fa-car',
            'submenu' => [
                [
                    'text' => 'Vehículos',
                    'icon' => 'fas fa-fw fa-car',
                    'url'  => 'admin/vehiculo',
                    'can'  => 'vehiculos',
                ],
                [
                    'text' => 'Tipo Vehículos',
                    'icon' => 'fas fa-fw fa-car-side',
                    'url'  => 'admin/tipo-vehiculo',
                    'can'  => 'vehiculos',
                ],
            ],
        ],
        ['header' => 'Correo'],
        [
            'text'    => 'Correo',
            'icon'    => 'fas fa-fw fa-envelope',
            'submenu' => [
                [
                    'text' => 'Enviar',
                    'icon' => 'fas fa-fw fa-paper-plane',
                    'url'  => 'admin/correo-enviar',
                ],
                [
                    'text' => 'Enviados',
                    'icon' => 'fas fa-fw fa-envelope',
                    'url'  => 'admin/correo-enviados',
                ],
                [
                    'text' => 'Recibidos',
                    'icon' => 'fas fa-fw fa-check-circle',
                    'url'  => 'admin/correo-recibidos',
                ],
            ],
        ],
        ['header' => 'Reportes'],
        [
            'text'    => 'Reportes',
            'icon'    => 'fas fa-fw fa-file-alt',
            'submenu' => [
                [
                    'text' => 'Reporte de ventas',
                    'icon' => 'fas fa-fw fa-file-alt',
                    'url'  => 'admin/reporte-venta',
                    'can'  => 'items',
                ],
                [
                    'text' => 'Reporte de pedidos',
                    'icon' => 'fas fa-fw fa-file-alt',
                    'url'  => 'admin/reporte-pedido',
                    'can'  => 'items',
                ],
            ],
        ],
        ['header' => 'Configuración'],
        [
            'text'    => 'Restaurante',
            'icon'    => 'fas fa-fw fa-cogs',
            'submenu' => [
                [
                    'text' => 'Restaurante',
                    'icon' => 'fas fa-fw fa-cogs',
                    'url'  => 'admin/restaurante',
                    'can'  => 'usuarios',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
