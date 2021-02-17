<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog settings</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">


    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('article.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <div class="sidebar-brand-text mx-3">Blog</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

    @if (\Illuminate\Support\Facades\Auth::check())
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Settings</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Personal preferences
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.show', \Illuminate\Support\Facades\Auth::user()) }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('panel.comments.user') }}">
                <i class="fas fa-fw fa-comment"></i>
                <span>Comments</span></a>
        </li>

        @if (\App\Http\Helpers\PermissionHandler::isWriter())
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticles"
                   aria-expanded="true" aria-controls="collapseArticles">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Articles</span>
                </a>
                <div id="collapseArticles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('panel.articles.user') }}">My articles</a>
                        <a class="collapse-item" href="{{ route('article.create') }}">Create new</a>
                    </div>
                </div>
            </li>
        @endif


    <!-- Divider -->
        <hr class="sidebar-divider">

        @if (
\App\Http\Helpers\PermissionHandler::isUserEditor()
|| \App\Http\Helpers\PermissionHandler::isArticleEditor()
|| \App\Http\Helpers\PermissionHandler::isCommentEditor()
|| \App\Http\Helpers\PermissionHandler::isRoleEditor()
)
        <!-- Heading -->
            <div class="sidebar-heading">
                Management tools
            </div>

            @if (\App\Http\Helpers\PermissionHandler::isUserEditor())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                       aria-expanded="true" aria-controls="collapseUsers">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Users</span>
                    </a>
                    <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('panel.users') }}">Users</a>
                            @if (\App\Http\Helpers\PermissionHandler::canCreateUsers())
                                <a class="collapse-item" href="{{ route('user.create') }}">Create new</a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif

            @if (\App\Http\Helpers\PermissionHandler::isCommentEditor())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel.comments') }}">
                        <i class="fas fa-fw fa-comments"></i>
                        <span>Comments</span></a>
                </li>
            @endif

            @if (\App\Http\Helpers\PermissionHandler::isArticleEditor())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAllArticles"
                       aria-expanded="true" aria-controls="collapseAllArticles">
                        <i class="fas fa-fw fa-newspaper"></i>
                        <span>Articles</span>
                    </a>
                    <div id="collapseAllArticles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('panel.articles') }}">All articles</a>
                            @if (\App\Http\Helpers\PermissionHandler::isWriter())
                                <a class="collapse-item" href="{{ route('panel.articles.user') }}">My articles</a>
                                <a class="collapse-item" href="{{ route('article.create') }}">Create new</a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
        @endif


        @if (\App\Http\Helpers\PermissionHandler::isRoleEditor())
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
                   aria-expanded="true" aria-controls="collapseRoles">
                    <i class="fas fa-fw fa-key"></i>
                    <span>Roles</span>
                </a>
                <div id="collapseRoles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('panel.roles') }}">Roles</a>
                        @if (\App\Http\Helpers\PermissionHandler::canCreateRoles())
                            <a class="collapse-item" href="{{ route('role.create') }}">Create new</a>
                        @endif
                        @if (\App\Http\Helpers\PermissionHandler::canEditRoles())
                            <a class="collapse-item" href="{{ route('role.default') }}">Default role</a>
                        @endif
                    </div>
                </div>
            </li>
        @endif


        @if(\App\Http\Helpers\PermissionHandler::isMenuEditor())
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenus"
                   aria-expanded="true" aria-controls="collapseMenus">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Menus</span>
                </a>
                <div id="collapseMenus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('panel.menu') }}">Menus</a>
                        @if (\App\Http\Helpers\PermissionHandler::canCreateMenus())
                            <a class="collapse-item" href="{{ route('menu.create') }}">Create new menu</a>
                        @endif
                        @if (\App\Http\Helpers\PermissionHandler::canEditMenus())
                            <a class="collapse-item" href="{{ route('panel.menuitem') }}">Menu items</a>
                        @endif
                    </div>
                </div>
            </li>
        @endif


        @if (\App\Http\Helpers\PermissionHandler::isMediaEditor())
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedia"
                   aria-expanded="true" aria-controls="collapseMedia">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Media</span>
                </a>
                <div id="collapseMedia" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('panel.gallery') }}">Images</a>
                        <a class="collapse-item" href="{{ route('panel.avatar') }}">Avatars</a>
                        @if (\App\Http\Helpers\PermissionHandler::canCreateMedia())
                            <a class="collapse-item" href="{{ route('gallery.create') }}">Upload new image</a>
                            <a class="collapse-item" href="{{ route('avatar.create') }}">Upload new avatar</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        @endif

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        @endif
    </ul>
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div style="display: flex; align-items: center">
                            @include('includes.nav.nav', $navMenus)
                        </div>

                        <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{ url(\App\Http\Helpers\FileHandler::getImage(\Illuminate\Support\Facades\Auth::user()->image->image_path, 'avatars/')) }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('user.show', \Illuminate\Support\Facades\Auth::user()) }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('panel.index') }}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    @endguest
                </ul>

            </nav>
            <!-- End of Topbar -->

            @yield('content')
@extends('layouts.paneltail')
