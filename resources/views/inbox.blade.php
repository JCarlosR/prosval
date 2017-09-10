@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-3">
                    <div class="card-box">
                        <form role="search" class="app-search">
                            <input type="text" placeholder="Buscar..."
                                   class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>

                        <ul class="list-group m-b-0 user-list">
                            <li class="list-group-item"> 
                                <a href="#" class="user-list-item">
                                    <div class="avatar">
                                        <img src="images/users/avatar-6.jpg" alt="">
                                    </div>
                                    <div>
		                                <div class="dropdown pull-right">
		                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
		                                    <i class="zmdi zmdi-more-vert"></i>
		                                </a>
		                                <ul class="dropdown-menu" role="menu">
		                                    <li><a href="#"><small>Spam</small></a></li>
		                                </ul>
		                            	</div>
                                        <span class="name">Vendedor</span><br>
                                        <span class="name"><small>401504</small></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <ul class="list-group m-b-1 user-list">
                            <li class="list-group-item"> 
                                <a href="#" class="user-list-item">
                                    <div class="avatar">
                                        <img src="images/users/avatar-1.jpg" alt="">
                                    </div>
                                    <div>
		                                <div class="dropdown pull-right">
		                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
		                                    <i class="zmdi zmdi-more-vert"></i>
		                                </a>
		                                <ul class="dropdown-menu" role="menu">
		                                    <li><a href="#"><small>Spam</small></a></li>
		                                </ul>
		                            	</div>
                                        <span class="name">Vendedor1</span><br>
                                        <span class="name"><small>401504</small></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <ul class="list-group m-b-1 user-list">
                            <li class="list-group-item"> 
                                <a href="#" class="user-list-item">
                                    <div class="avatar">
                                        <img src="images/users/avatar-2.jpg" alt="">
                                    </div>
                                    <div>
		                                <div class="dropdown pull-right">
		                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
		                                    <i class="zmdi zmdi-more-vert"></i>
		                                </a>
		                                <ul class="dropdown-menu" role="menu">
		                                    <li><a href="#"><small>Spam</small></a></li>
		                                </ul>
		                            	</div>
                                        <span class="name">Vendedor2</span><br>
                                        <span class="name"><small>401504</small></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="bg-picture card-box">

                    	<div class="timeline">
                            <article class="timeline-item alt">
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h4 class="text-danger">Vendedor 1</h4>
                                            <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                            <p>Esto esta muy tranca de hacer, ya me esta llegando al jimmo </p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="timeline-item ">
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="panel-body">  
                                            <p>consectetur adipisicing elit. Iusto, optio,dolorum ah ya veaamos </p>
                                            <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                    <!--/ meta -->
                    <form method="post" class="card-box">
                        <span class="input-icon icon-right">
                            <textarea rows="2" class="form-control" maxlength="140"placeholder="Escribir un mensaje aquí"></textarea>
                        </span>
                        <div class="p-t-10 pull-right">
                            <a class="btn btn-sm btn-primary waves-effect waves-light">Enviar</a>
                        </div>
                        <ul class="nav nav-pills profile-pills m-t-10">
                            <li>
                                <a href="#"><i class="fa fa-user"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-location-arrow"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class=" fa fa-camera"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-smile-o"></i></a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>



        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer">
        2016 - 2017 © Adminto.
    </footer>

</div>
<!-- End content-page -->


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
@endsection
