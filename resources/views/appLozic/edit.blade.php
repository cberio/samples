@extends('layouts.master')

@section('contents')
    <div class="container">
        <form name="frm" id="frm" method="post" class="form-horizontal">
            {!! csrf_field() !!}
            {{ method_field('PATCH') }}

            <div class="page-header">
                <h1>유저 정보</h1>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>userId</span></div>
                    <div class="col-sm-10"><span>{{ $details->userId }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>userName</span></div>
                    <div class="col-sm-10"><span>{{ $details->userName }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>connected</span></div>
                    <div class="col-sm-10"><span>{{ $details->connected }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>status</span></div>
                    <div class="col-sm-10"><span>{{ $details->status }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>createdAtTime</span></div>
                    <div class="col-sm-10"><span>{{ $details->createdAtTime }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>unreadCount</span></div>
                    <div class="col-sm-10"><span>{{ $details->unreadCount }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>displayName</span></div>
                    <div class="col-sm-10">
                        <input type="text" name="display_name" class="form-control" placeholder="display_name" value="{{ $details->displayName }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>email</span></div>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $details->email }}" placeholder="email">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>phoneNumber</span></div>
                    <div class="col-sm-10"><span>{{ optional($details)->phoneNumber }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>deactivated</span></div>
                    <div class="col-sm-10"><span>{{ $details->deactivated }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>connectedClientCount</span></div>
                    <div class="col-sm-10"><span>{{ $details->connectedClientCount }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>active</span></div>
                    <div class="col-sm-10"><span>{{ $details->active }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>lastLoggedInAtTime</span></div>
                    <div class="col-sm-10"><span>{{ $details->lastLoggedInAtTime }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>roleKey</span></div>
                    <div class="col-sm-10"><span>{{ $details->roleKey }}</span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"><span>방 이름</span></div>
                    <div class="col-sm-3">
                        <input type="text" name="room_name" class="form-control" placeholder="방 이름">
                    </div>
                    <div class="col-sm-2"><span>userId</span></div>
                    <div class="col-sm-3">
                        <input type="text" name="target_user_id" class="form-control" placeholder="대상 id">
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-success" href="javascript:createRoom();">방 생성</a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="{{$details->userId}}" />
            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-success">수정</button>
                @if($details->active)
                    <button type="button" class="btn btn-danger">비활성화</button>
                @else
                    <button type="button" class="btn btn-success">활성화</button>
                @endif
                <a class="btn btn-success" href="{{ route('appLozic.index') }}">목록</a>
            </div>
        </form>

        <div class="page-header">
            <h1>연결 목록</h1>
        </div>

        @isset($rooms)
            <form name="roomFrm" class="form-horizontal">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2"><span>동기화시간</span></div>
                        <div class="col-sm-10"><span>{{ $rooms->generatedAt }}</span></div>
                    </div>
                </div>

                @foreach($rooms->response as $room)
                    <div class="well">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>id</span></div>
                                <div class="col-sm-10"><span>{{ $room->id }} / {{ $room->clientGroupId }}</span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>name</span></div>
                                <div class="col-sm-10"><span>{{ $room->name }}</span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>admin</span></div>
                                <div class="col-sm-10"><span>{{ $room->adminId }}</span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>groupUsers</span></div>
                                <div class="col-sm-10">
                                    @foreach($room->groupUsers as $user)
                                        @json($user)
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>내보내기</span></div>
                                <div class="col-sm-8">
                                    <div class="btn-group">
                                        @foreach($room->groupUsers as $user)
                                            @if($user->userId === $room->adminId)
                                            @else
                                                <button type="button" class="btn btn-danger"
                                                        onclick="removeUser('{{ $room->id  }}', '{{ $user->userId }}')">
                                                    {{ $user->userId }}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>type [1:비공개 2:공개]</span></div>
                                <div class="col-sm-10"><span>{{ $room->type }}</span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span>metadata</span></div>
                                <div class="col-sm-10">
                                    @json($room->metadata)
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-2"><span></span></div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="message-{{ $room->id }}" placeholder="메시지"/>
                                </div>
                                <div class="col-sm-2 btn-group">
                                    <button type="button" class="btn btn-primary" onclick="sendMessage('{{ $room->id }}')">전송</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="btn-group">
                                <a href="javascript:loadMessages('{{ $room->id }}');" class="btn">채팅 보기</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <ul id="group-{{ $room->id }}" class="list-group"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </form>
        @endisset
    </div>
@endsection

@section('scripts')
    <script>
        function sendMessage(roomId) {
            var message = $('#message-'+roomId).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("appLozic.messages.store") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: '{{ $details->userId }}',
                    group_id: roomId,
                    message: message
                }
            }).success(function () {
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
                element.append(
                    '<li class="list-group-item">'+ values.message +'</li>'
                );
            });
        }

        function createRoom() {
            var targetId = $("input[name=target_user_id]").val();
            var userId = '{{ $details->userId }}';

            console.log(targetId, userId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("appLozic.groups.store") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    room_name: $("input[name=room_name]").val(),
                    target_user_id: [userId, targetId]
                }
            }).success(function (response) {
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

            $.ajax({
                url: '{{ route('appLozic.groups.remove.user') }}',
                type: 'DELETE',
                dataType: 'json',
                data: {
                    group_id: roomId,
                    user_id: userId
                }
            }).success(function (response) {
                console.log(response);
            }).fail(function (response) {
                console.log(response);
            })
        }
    </script>
@endsection
