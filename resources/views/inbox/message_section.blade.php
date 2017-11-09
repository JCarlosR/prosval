<div class="col-sm-9 message_section">
    <div class="row">
        <div class="new_message_head">
            <div class="pull-left">
                <button>
                    <i class="fa fa-send" aria-hidden="true"></i> {{ $selected_contact->name }}
                </button>
            </div>
            <div class="pull-right">
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i> Opciones
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li><a href="{{ url('datos') }}">Ver datos de contacto</a></li>
                        <li><a href="{{ url('contact/'.$selected_contact->id.'/spam') }}">Marcar como spam</a></li>
                    </ul>
                </div>
            </div>
        </div><!--new_message_head-->

        <div class="chat_area">
            <ul class="list-unstyled">
                @foreach ($messages as $message)
                    @if ($message['admin_chat'])
                        <li class="left clearfix">
                           <span class="chat-img1 pull-left">
                           <img src="{{ asset('images/users/avatar-1.jpg') }}" alt="{{ $selected_contact->name }}" class="img-circle">
                           </span>
                            <div class="chat-body1 clearfix">
                                <p>{{ $message['content'] }}</p>
                                <div class="chat_time pull-right">{{ $message['date'] }}</div>
                            </div>
                        </li>
                    @else
                        <li class="left clearfix admin_chat">
                           <span class="chat-img1 pull-right">
                            <img src="https://d2gcv4sxt84gxu.cloudfront.net/assets/default-user-avatars-original-d5efadcf497ea7b3d86c6f8d148d66633a29ce78fa8391af628adf32d9989354.png" alt="Administrador" class="img-circle">
                           </span>
                            <div class="chat-body1 clearfix">
                                <p>{{ $message['content'] }}</p>
                                <div class="chat_time pull-left">{{ $message['date'] }}</div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div><!--chat_area-->
        <div class="message_write">
            <form action="" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="destination_phone" value="{{ $selected_contact->phone }}">
                <textarea name="new_message" id="new_message" class="form-control" maxlength="140" rows="2" placeholder="Escribe un mensaje aquí"></textarea>
                <div class="clearfix"></div>
                <div class="chat_bottom">
                    <button class="pull-right btn btn-success" type="submit">
                        Enviar <i class="fa fa-send"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>