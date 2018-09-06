@extends('layouts.master')

@section('title', 'QuickBlox')

@section('contents')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Chat-Sample <small>QuickBlox</small></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">사용자 생성</h3>
                </div>

                <form class="form-horizontal" method="post">
                    {!! csrf_field() !!}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="login" value="{{ $user->login }}">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="user_name" class="col-sm-2">name</label>
                            <div class="col-sm-10">
                                <input type="text" name="user_name" id="user_name" class="form-control" value="{{ $user->login }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2">password</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" id="password" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full_name" class="col-sm-2">full name</label>
                            <div class="col-sm-10">
                                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $user->full_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2">phone</label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="custom" class="col-sm-2">custom</label>
                            <div class="col-sm-10">
                                <code>{!! $user->custom_data !!}</code>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="col-sm-2">tags</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">
                                    @foreach(explode(',', $user->user_tags) as $tag)
                                        <option value="{{ $tag }}">{{ $tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('quickBlox.index') }}" class="btn btn-default">취소</a>
                        <button type="submit" class="btn btn-info pull-right">수정</button>
                    </div>
                </form>
            </div>
        </section>

        <section class="content-header">
            <h1>연결 목록</h1>
        </section>

        <section class="content">
            <div class="row">
                @foreach(array_chunk($dialogs->items, 2) as $items)
                    @foreach($items as $dialog)
                        <div class="col-sm-6">
                            <div class="box box-primary direct-chat direct-chat-primary">
                                <div class="box-header">
                                    <h3 class="box-title">{{ $dialog->_id }}</h3>
                                    <div class="box-tools pull-right">
                                        <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="{{ $dialog->unread_messages_count ?? 0 }} New Messages">{{ $dialog->unread_messages_count ?? 0 }}</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                                            <i class="fa fa-comments"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="box-body with-border">
                                    <div class="direct-chat-messages" id="dialog-{{ $dialog->_id }}">
                                    </div>

                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">xmpp_room_jid</span>
                                                    <span class="contacts-list-msg">{{ $dialog->xmpp_room_jid }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">name</span>
                                                    <span class="contacts-list-msg">{{ $dialog->name }}</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">owner_id</span>
                                                    <span class="contacts-list-msg">{{ $dialog->user_id }}</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">type</span>
                                                    @switch($dialog->type)
                                                        @case(1)
                                                        <span class="contacts-list-msg">오픈채팅</span>
                                                        @break
                                                        @case(2)
                                                        <span class="contacts-list-msg">초대</span>
                                                        @break
                                                        @case(3)
                                                        <span class="contacts-list-msg">1:1</span>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </li>

                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">last_message_date_sent</span>
                                                    <span class="contacts-list-msg">{{ $dialog->last_message_date_sent }}</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">created_at</span>
                                                    <span class="contacts-list-msg">{{ $dialog->created_at }}</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">updated_at</span>
                                                    <span class="contacts-list-msg">{{ $dialog->updated_at }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="overlay" id="overlay-{{ $dialog->_id}}" style="display: none">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>

                                <div class="box-footer">
                                    <div class="input-group">
                                        <input type="text" name="message-{{ $dialog->_id }}" id="message-{{ $dialog->_id }}" placeholder="Type Message ..." class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="sendMessage('{{ $dialog->_id }}')" class="btn btn-primary btn-flat">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var tags = $("#tags");
            var values = '{{ $user->user_tags }}'.split(',');

            tags.select2({
                allowClear: true,
                maximumSelectionLength: 10,
                minimumInputLength: 3,
                maximumInputLength: 15,
                lang: 'ko',
                tags: true,
                tokenSeparators: [',', ' ']
            });

            tags.val(values).trigger('change');
        });

        function sendMessage(dialogId) {
            var element = $("#message-"+dialogId);
            var overlay = $("#overlay-"+dialogId);
            var message = element.val();

            element.val('');
            overlay.show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: '{{ route("quickBlox.messages.store") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    user_name: '{{ $user->login }}',
                    dialog_id: dialogId,
                    message: message
                }
            });

            $.when(request).done(function (response) {
                loadMessages(dialogId);
            }).fail(function () {
                alert('failed');
            }).always(function () {
                overlay.hide();
            });
        }

        function loadMessages(dialogId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: '{{ route("quickBlox.messages.index") }}',
                type: 'GET',
                data: {
                    user_name: '{{ $user->login }}',
                    dialog_id: dialogId
                }
            });

            $.when(request).done(function (response) {
                var items = response.items;

                prependMessage(items, dialogId);
            }).fail(function () {
                alert('failed');
            });
        }

        function prependMessage(messages, dialogId) {
            var userId  = '{{ $user->id }}';
            var element = $("#dialog-"+dialogId);

            element.empty();

            messages.forEach(function (message) {
                var style = message.sender_id == userId ? 'right' : '';

                element.append(
                    '<div class="direct-chat-msg '+ style +'">' +
                    '    <div class="direct-chat-info clearfix">' +
                    '        <span class="direct-chat-name pull-left">'+ message.name +'</span>' +
                    '        <span class="direct-chat-timestamp pull-right">'+ message.created_at +'</span>' +
                    '    </div>' +
                    '    <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="Message User Image">' +
                    '    <div class="direct-chat-text">' +
                            message.message +
                    '    </div>' +
                    '</div>'
                );
            })
        }
    </script>

    <template id="mine">
        <div class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
            </div>
            <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="Message User Image">
            <div class="direct-chat-text">
                Is this template really for free? That's unbelievable!
            </div>
        </div>
    </template>
@endsection
