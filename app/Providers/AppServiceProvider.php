<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function(BuildingMenu $event){
            $user = auth()->user();

            if($user->isAdmin() || $user->isConselho() || $user->isExtrator()) {
                $event->menu->add('Atos Normativos');
                $event->menu->add([                                
                        'text'        => 'Publicar',
                        'url'         => 'admin/documentos/publicar',
                        'icon'        => 'angle-up'
                    ],
                    [
                        'text'        => 'Publicar em Lote',
                        'url'         => 'admin/documentos/publicar-lote',
                        'icon'        => 'angle-double-up'
                    ]                    
                );    
            }        
            if($user->isAdmin() || $user->isConselho()) {
                $event->menu->add(
                    [
                        'text'        => 'Últimos Documentos',
                        'url'         => 'admin/documentos',
                        'icon'        => 'search'
                    ]
                );
                $event->menu->add('Pendências');
                $event->menu->add(                                    
                    [
                        'text' => 'Pendências de Lote',
                        'url'  => 'admin/documentos/pendentes',
                        'icon' => 'exclamation-circle',
                    ],
                    [
                        'text' => 'Pesquisar Pendências',
                        'url'  => 'admin/documentos/pesquisar/status',
                        'icon' => 'search',
                    ]                                
                );                
            }                    
            if($user->isAdmin() || $user->isAcessor()) {
                $event->menu->add('Unidades');
                $event->menu->add(
                    [
                        'text'    => 'Conselhos',
                        'icon'    => 'university',
                        'url'     => 'admin/unidades',                
                    ]
                );
            }
            if($user->isAdmin()) {
                $event->menu->add(
                    [
                        'text'    => 'Acessorias',
                        'icon'    => 'unlock-alt',
                        'url'     => 'admin/unidades/acessorias',                                
                    ]
                );
            }
            $event->menu->add('Glossário');
            $event->menu->add(                                    
                [
                    'text' => 'Tipos de Documentos',
                    'url'  => 'admin/tiposdocumento',
                    'icon' => 'file',
                ],
                [
                    'text' => 'Assuntos',
                    'url'  => 'admin/assuntos',
                    'icon' => 'bookmark',
                ]                
            );
            $event->menu->add(               
                [
                    'text'    => 'Perfil',
                    'icon'    => 'address-card',
                    'url'     => 'admin/usuarios' 
                ]
            );
        });

    	if(env('REDIRECT_HTTPS'))
        {
            \URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
