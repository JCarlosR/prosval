@extends('layouts.chat')

@section('content')

<div class="content-page">

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                                <div class="card-box">

                                    <h4 class="header-title m-t-0 m-b-30">Team Members</h4>

                                    <div class="inbox-widget nicescroll" style="height: 315px;">
                                        <a href="#">
                                            <div class="inbox-item">
                                                <div class="inbox-item-img"><img src="images/users/avatar-1.jpg" class="img-circle" alt=""></div>
                                                <p class="inbox-item-author">Chadengle</p>
                                                <p class="inbox-item-text">044352345</p>
                                                <p class="inbox-item-date">13:40 PM</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="inbox-item">
                                                <div class="inbox-item-img"><img src="images/users/avatar-2.jpg" class="img-circle" alt=""></div>
                                                <p class="inbox-item-author">Tomaslau</p>
                                                <p class="inbox-item-text">044352345</p>
                                                <p class="inbox-item-date">13:34 PM</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="inbox-item">
                                                <div class="inbox-item-img"><img src="images/users/avatar-3.jpg" class="img-circle" alt=""></div>
                                                <p class="inbox-item-author">Stillnotdavid</p>
                                                <p class="inbox-item-text">044352345</p>
                                                <p class="inbox-item-date">13:17 PM</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="inbox-item">
                                                <div class="inbox-item-img"><img src="images/users/avatar-4.jpg" class="img-circle" alt=""></div>
                                                <p class="inbox-item-author">Kurafire</p>
                                                <p class="inbox-item-text">044352345</p>
                                                <p class="inbox-item-date">12:20 PM</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="inbox-item">
                                                <div class="inbox-item-img"><img src="images/users/avatar-5.jpg" class="img-circle" alt=""></div>
                                                <p class="inbox-item-author">Shahedk</p>
                                                <p class="inbox-item-text">044352345</p>
                                                <p class="inbox-item-date">10:15 AM</p>
                                            </div>
                                        </a>
                                    </div>
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
                                            <p>Esto esta muy tranca de hacer,  </p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="timeline-item ">
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="panel-body">  
                                            <p>consectetur adipisicing elit. Iusto </p>
                                            <p class="timeline-date text-muted"><small>08:25 am</small></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                    <!--/ meta -->
                    <form method="post" class="panel-body">
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

</div>
<!-- End content-page -->


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
@endsection
