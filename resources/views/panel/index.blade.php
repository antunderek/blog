@extends('layouts.panel')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User stats</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                My comments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Illuminate\Support\Facades\Auth::user()->comments->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comment fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (\App\Http\Helpers\PermissionHandler::isWriter())
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">My articles
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Illuminate\Support\Facades\Auth::user()->articles->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                    @if (
            \App\Http\Helpers\PermissionHandler::isUserEditor()
            || \App\Http\Helpers\PermissionHandler::isArticleEditor()
            || \App\Http\Helpers\PermissionHandler::isCommentEditor()
            || \App\Http\Helpers\PermissionHandler::isRoleEditor()
            )
                        <hr>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Website stats</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">


                        @if (\App\Http\Helpers\PermissionHandler::isUserEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Users</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\User::withTrashed()->count() }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (\App\Http\Helpers\PermissionHandler::isCommentEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Comments</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Comment::count() }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (\App\Http\Helpers\PermissionHandler::isArticleEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Articles
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ \App\Article::withTrashed()->count() }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (\App\Http\Helpers\PermissionHandler::isMediaEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Images
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ \App\Gallery::count() }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-images fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Avatars
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ \App\Avatar::count() }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-portrait fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (\App\Http\Helpers\PermissionHandler::isRoleEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Roles</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Role::count() }}</div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Default</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Role::where('id', \App\DefaultRole::get()->first()->pluck('role_id'))->pluck('role')[0] }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-key fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(\App\Http\Helpers\PermissionHandler::isMenuEditor())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Menus</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Menu::count() }}</div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Menu items</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\MenuItem::count() }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-bars fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                   @endif
                </div>
@endsection
