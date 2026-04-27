@php
    $advocatedSections = config('advocated_content.sections', []);
    $contentPermissions = collect($advocatedSections)
        ->pluck('permission_prefix')
        ->map(fn ($permission) => $permission.'-list')
        ->values()
        ->all();
    $contentTreeActive = request()->routeIs('admin.advocated-content.*');
    $userTreeActive = request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*');
    $currentSection = request()->route('section');
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Advocated Studio</span>
    </a>

    <div class="sidebar">
        <div class="px-2 pb-3">
            <div class="adv-sidebar-banner">
                <span class="adv-sidebar-banner__eyebrow">Legal CMS</span>
                {{-- <strong>Manage every public-facing page for Advocated from one place.</strong> --}}
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gauge-high"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @canany(['user-list','role-list','permission-list'])
                    <li class="nav-item has-treeview {{ $userTreeActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $userTreeActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-gear"></i>
                            <p>
                                Access Control
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('user-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany($contentPermissions)
                    <li class="nav-header text-uppercase">Website Studio</li>

                    <li class="nav-item has-treeview {{ $contentTreeActive ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $contentTreeActive ? 'active' : '' }}">
                            <i class="nav-icon fas fa-swatchbook"></i>
                            <p>
                                Content Modules
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @foreach($advocatedSections as $sectionKey => $sectionMeta)
                                @can($sectionMeta['permission_prefix'].'-list')
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('admin.advocated-content.index', ['section' => $sectionKey]) }}"
                                            class="nav-link {{ $contentTreeActive && $currentSection === $sectionKey ? 'active' : '' }}"
                                        >
                                            <i class="nav-icon {{ $sectionMeta['icon'] }}"></i>
                                            <p>{{ $sectionMeta['label'] }}</p>
                                        </a>
                                    </li>
                                @endcan
                            @endforeach
                        </ul>
                    </li>
                @endcanany

                @can('gallery-list')
                    <li class="nav-item">
                        <a href="{{ route('admin.gallery-images.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-images.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Gallery Images</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>

<style>
    .adv-sidebar-banner{
        padding:1rem;
        border-radius:18px;
        background:
            linear-gradient(145deg, rgba(56,189,248,0.16), rgba(99,102,241,0.12)),
            rgba(255,255,255,0.03);
        border:1px solid rgba(125,211,252,0.2);
        color:#e0f2fe;
        box-shadow:0 18px 30px rgba(8,15,33,0.18);
    }

    .adv-sidebar-banner__eyebrow{
        display:inline-block;
        margin-bottom:0.5rem;
        padding:0.25rem 0.65rem;
        border-radius:999px;
        background:rgba(255,255,255,0.14);
        font-size:0.72rem;
        font-weight:800;
        letter-spacing:0.12em;
        text-transform:uppercase;
    }

    .nav-sidebar .nav-link{
        border-radius:14px;
        margin-bottom:0.2rem;
        color:#d5e5ff;
    }

    .nav-sidebar .nav-link.active{
        background:linear-gradient(90deg, rgba(56,189,248,0.22), rgba(37,99,235,0.34));
        box-shadow:0 10px 20px rgba(8,15,33,0.18);
    }

    .nav-sidebar .nav-treeview{
        padding-left:0.35rem;
    }

    .nav-sidebar .nav-icon{
        font-size:0.95rem;
    }

    .nav-header{
        color:#7dd3fc !important;
        font-size:0.72rem;
        letter-spacing:0.14em;
        font-weight:800;
    }
</style>
