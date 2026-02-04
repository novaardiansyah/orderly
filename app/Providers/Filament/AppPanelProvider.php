<?php

namespace App\Providers\Filament;

use App\Http\Middleware\SetLocale;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
  public function panel(Panel $panel): Panel
  {
    return $panel
      ->default()
      ->brandName(config('app.name'))
      ->spa()
      ->id('app')
      ->path('app')
      ->login()
      ->colors([
        'primary' => Color::Blue,
      ])
      ->passwordReset()
      ->sidebarCollapsibleOnDesktop()
      ->maxContentWidth(Width::Full)
      ->topbar(false)
      ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
      ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
      ->pages([
        Dashboard::class,
      ])
      ->favicon(asset('favicon.png'))
      ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
      ->widgets([])
      ->middleware([
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
        DisableBladeIconComponents::class,
        DispatchServingFilamentEvent::class,
        SetLocale::class,
      ])
      ->authMiddleware([
        Authenticate::class,
      ])
      ->navigationGroups([
        'Settings' => NavigationGroup::make(fn() => __('general.navigation_groups.settings')),
        'Logs' => NavigationGroup::make(fn() => __('general.navigation_groups.logs')),
      ])
      ->userMenuItems([
        MenuItem::make()
          ->label(fn() => App::getLocale() === 'en' ? 'Bahasa Indonesia' : 'English')
          ->url(fn() => route('filament.app.pages.switch-language'))
          ->icon('heroicon-o-language'),
      ])
      ->renderHook(
        PanelsRenderHook::HEAD_END,
        fn(): HtmlString => new HtmlString('
          <style>
            *::-webkit-scrollbar { display: none; }
            * { -ms-overflow-style: none; scrollbar-width: none; }
          </style>
        ')
      );
  }
}
