@extends('layouts.master')

@section('title', 'AppLozic')

@section('contents')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Chat-Sample <small>AppLozic</small></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">사용자 수정</h3>
                </div>

                <form name="frm" id="frm" method="post" class="form-horizontal">
                    {!! csrf_field() !!}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="id" value="{{$details->userId}}" />

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2"><span>userId</span></label>
                            <div class="col-sm-10"><span>{{ $details->userId }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>userName</span></label>
                            <div class="col-sm-10"><span>{{ $details->userName }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>connected</span></label>
                            <div class="col-sm-10"><span>{{ $details->connected }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>status</span></label>
                            <div class="col-sm-10"><span>{{ $details->status }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>createdAtTime</span></label>
                            <div class="col-sm-10"><span>{{ $details->createdAtTime }}</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2"><span>unreadCount</span></label>
                            <div class="col-sm-10"><span>{{ $details->unreadCount }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>displayName</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="display_name" class="form-control" placeholder="display_name" value="{{ $details->displayName }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>email</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" value="{{ $details->email }}" placeholder="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>phoneNumber</span></label>
                            <div class="col-sm-10"><span>{{ optional($details)->phoneNumber }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>deactivated</span></label>
                            <div class="col-sm-10"><span>{{ $details->deactivated }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>connectedClientCount</span></label>
                            <div class="col-sm-10"><span>{{ $details->connectedClientCount }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>active</span></label>
                            <div class="col-sm-10"><span>{{ $details->active }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>lastLoggedInAtTime</span></label>
                            <div class="col-sm-10"><span>{{ $details->lastLoggedInAtTime }}</span></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"><span>roleKey</span></label>
                            <div class="col-sm-10"><span>{{ $details->roleKey }}</span></div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a class="btn btn-default pull-left" href="{{ route('appLozic.index') }}">목록</a>

                        <button type="submit" class="btn btn-success pull-right">수정</button>
                        @if($details->active)
                            <button type="button" class="btn btn-danger pull-right">비활성화</button>
                        @else
                            <button type="button" class="btn btn-success pull-right">활성화</button>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <section class="content-header">
            <h1>연결 목록</h1>
        </section>

        @isset($rooms)
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-primary">
                            <div class="box-footer">
                                <div class="input-group">
                                    <select class="form-control select2" name="occupants[]" id="occupants" title="users"></select>
                                    <span class="input-group-btn">
                                    <button type="button" onclick="createRoom()" class="btn btn-primary btn-flat">채팅생성</button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach(array_chunk($rooms->response, 2) as $rooms)
                        @foreach($rooms as $room)
                            <div class="col-sm-6">
                                <div class="box box-success direct-chat direct-chat-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">{{ $room->id }}</h3>
                                        <div class="box-tools pull-right">
                                            <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="0 New Messages">0</span>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" onclick="loadMessages('{{ $room->id }}')">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                                                <i class="fa fa-comments"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove" onclick="removeDialog('{{ $room->id }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="box-body with-border">
                                        <div class="direct-chat-messages" id="group-{{ $room->id }}">
                                        </div>

                                        <div class="direct-chat-contacts">
                                            <ul class="contacts-list">
                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">내보내기</span>
                                                        <span class="contacts-list-msg">
                                                            @foreach($room->groupUsers as $user)
                                                                @if($user->userId === $room->adminId)
                                                                    <span class="label label-success">{{ $user->userId }}</span>
                                                                @else
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                            onclick="removeUser('{{ $room->id  }}', '{{ $user->userId }}')">
                                                                        {{ $user->userId }}
                                                                    </button>
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">name</span>
                                                        <span class="contacts-list-msg">{{ $room->name }}</span>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">admin</span>
                                                        <span class="contacts-list-msg">{{ $room->adminId }}</span>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">groupUsers</span>
                                                        <span class="contacts-list-msg">
                                                            @foreach($room->groupUsers as $user)
                                                                @json($user)
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">type [1:비공개 2:공개]</span>
                                                        <span class="contacts-list-msg">{{ $room->type }}</span>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">metadata</span>
                                                        <span class="contacts-list-msg">@json($room->metadata)</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="overlay" id="overlay-{{ $room->id}}" style="display: none">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>

                                    <div class="box-footer">
                                        <div class="input-group">
                                            <input type="text" name="message-{{ $room->id }}" id="message-{{ $room->id }}" placeholder="Type Message ..." class="form-control">
                                            <span class="input-group-btn">
                                            <button type="button" onclick="sendMessage('{{ $room->id }}')" class="btn btn-primary btn-flat">Send</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
        @endisset
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var request = $.ajax({
                url: '{{ route("appLozic.index") }}',
                dataType: 'json',
            });

            $.when(request).done(function (response) {
                var data = response.users;
                users = $.map(data, function (user) {
                    user.text = user.userName;

                    return user;
                });

                $("#occupants").select2({
                    allowClear: true,
                    lang: 'ko',
                    tags: true,
                    tokenSeparators: [',', ' '],
                    data: users
                });
            }).fail(function () {
                alert('failed');
            });
        });

        function sendMessage(roomId) {
            var message = $('#message-'+roomId).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: '{{ route("appLozic.messages.store") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: '{{ $details->userId }}',
                    group_id: roomId,
                    message: message
                }
            });

            $.when(request).done(function (response) {
                console.log(response);
                loadMessages(roomId);
            }).fail(function (response) {
               alert('request failed');
               console.log(response);
            });
        }

        function loadMessages(roomId) {
            var request = $.ajax({
                url: '{{ route("appLozic.messages.index") }}',
                type: 'GET',
                data: {
                    group_id: roomId,
                    id: '{{ $details->userId }}'
                }
            });

            $.when(request).done(function (response) {
                var data = response.response;
                var messages = data.message;

                prependMessage(messages, roomId);
            }).fail(function () {
                alert('failed');
            });
        }

        function prependMessage(messages, roomId) {
            var element = $("#group-"+roomId);
            element.empty();

            messages.forEach(function (values) {
                var style = 'right';

                element.append(
                    '<div class="direct-chat-msg '+ style +'">' +
                    '    <div class="direct-chat-info clearfix">' +
                    '        <span class="direct-chat-name pull-left">'+ values.contactIds +'</span>' +
                    '        <span class="direct-chat-timestamp pull-right">'+ values.createdAtTime +'</span>' +
                    '    </div>' +
                    '    <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="Message User Image">' +
                    '    <div class="direct-chat-text">' +
                            values.message +
                    '    </div>' +
                    '</div>'
                );
            });
        }

        function createRoom() {
            var targetId = $("#occupants").val();
            var userId = '{{ $details->userId }}';

            console.log(targetId, userId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: '{{ route("appLozic.groups.store") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    room_name: userId+'_'+targetId,
                    target_user_id: [userId, targetId]
                }
            });

            $.when(request).done(function (response) {
                console.log(response);
            }).fail(function (response) {
                console.log(response);
            });
        }

        function removeUser(roomId, userId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: '{{ route('appLozic.groups.remove.user') }}',
                type: 'DELETE',
                dataType: 'json',
                data: {
                    group_id: roomId,
                    user_id: userId
                }
            });

            $.when(request).done(function (response) {
                console.log(response);
            }).fail(function (response) {
                console.log(response);
            })
        }
    </script>
@endsection
