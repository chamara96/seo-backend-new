<?php

namespace Modules\Article\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::makeOnce('admin_sidebar', function ($menu) {
            // Separator: Module Management
            $all_modules = $menu->add('Modules', [
                'class' => 'nav-title',
            ])
            ->data('order', 80);

            // Articles Dropdown
            $articles_menu = $menu->add('<i class="nav-icon fas fa-file-alt"></i> Blog Post', [
                'class' => 'nav-item nav-dropdown',
            ])
            ->data([
                'order'         => 81,
                'activematches' => [
                    'admin/posts*',
                    'admin/categories*'
                ],
                'permission' => ['view_posts', 'view_categories', 'view_tags'],
            ]);
            $articles_menu->link->attr([
                'class' => 'nav-link nav-dropdown-toggle',
                'href'  => '#',
            ]);

            // Submenu: User Posts
            $articles_menu->add('<i class="nav-icon fa fa-clipboard"></i>User Posts', [
                'route' => 'backend.posts.index_user',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 82,
                'activematches' => 'admin/posts/index_user*',
                'permission'    => ['edit_posts'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: merchant Posts
            $articles_menu->add('<i class="nav-icon fa fa-clipboard"></i>merchant Posts', [
                'route' => 'backend.posts.index_merchant',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 83,
                'activematches' => 'admin/posts/index_merchant*',
                'permission'    => ['edit_posts'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
            // Submenu: Categories
            $articles_menu->add('<i class="nav-icon fas fa-sitemap"></i> Categories', [
                'route' => 'backend.categories.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 84,
                'activematches' => 'admin/categories*',
                'permission'    => ['edit_categories'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
