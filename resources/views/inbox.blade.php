@extends('layouts.app')

@section('page-title', 'Inbox')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/inbox.css') }}">
@endsection

@section('content')
<div class="content-page">
  <div class="content">
   <div class="container">

       @if (session('notification'))
       <div class="alert alert-info alert-dismissable">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ session('notification') }}
       </div>
       @endif

      <div class="chat_container">
         <div class="col-sm-3 chat_sidebar">
            <div class="row">
                  <div id="custom-search-input">
                     <div class="input-group col-md-12">
                        <input type="text" class="search-query form-control" placeholder="Buscar contacto ..." />
                        <button class="" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                     </div>
                  </div>
                <div class="member_list">
                    <ul class="list-unstyled">
                        @foreach ($contacts as $contact)
                            <li class="left clearfix">
                                <a href="{{ url('/contact/'.$contact->id.'/messages') }}" data-load="messages">
                                    <span class="chat-img pull-left">
                                        <img src="https://d2gcv4sxt84gxu.cloudfront.net/assets/default-user-avatars-original-d5efadcf497ea7b3d86c6f8d148d66633a29ce78fa8391af628adf32d9989354.png" alt="User Avatar" class="img-circle">
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header_sec">
                                            @if ($contact->last_message_read)
                                                <span>{{ $contact->name }}</span>
                                            @else
                                                <strong>{{ $contact->name }}</strong>
                                            @endif
                                            {{--<strong class="pull-right">--}}
                                                {{--09:45AM--}}
                                            {{--</strong>--}}
                                        </div>
                                        <div class="contact_sec">
                                            @if ($contact->last_message_read)
                                                <span>(+52) {{ $contact->phone_formatted }}</span>
                                            @else
                                                <strong>(+52) {{ $contact->phone_formatted }}</strong>
                                            @endif
                                            {{--<span class="badge pull-right">3</span>--}}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
         </div>
     
         @include('inbox.message_section')
      </div>

   </div>
  </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#new_message').maxlength({ alwaysShow: true });
        $(document).on('click', '[data-load="messages"]', loadMessages);

        function loadMessages(event) {
            event.preventDefault();

            const messagesUrl = $(this).attr('href');
            $.get(messagesUrl, function (data) {
                $('#inboxMessages').replaceWith(data);
            });
        }
    </script>
@endsection
