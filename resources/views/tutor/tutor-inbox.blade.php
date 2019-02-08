@extends('layouts.master-layout')
@section('title')
    Inbox | {{Auth::user()->name}}
@endsection

@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <style>
        .tree_widget-sec > ul > li.active > a i {
            color: #8b91dd;
        }

        .content-box {
            float: left;
            width: 100%;
            margin-top: 1rem;
            border: 2px solid #e8ecec;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -ms-border-radius: 8px;
            -o-border-radius: 8px;
            border-radius: 8px;
            padding: 25px;
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        }

        .chat {
            margin-top: auto;
            margin-bottom: auto;
        }

        .card {
            height: 500px;
            border-radius: 15px !important;
            background-color: rgba(0, 0, 0, 0.4) !important;
        }

        .contacts_body {
            padding: 0.75rem 0 !important;
            overflow-y: auto;
            white-space: nowrap;
        }

        .msg_card_body {
            overflow-y: auto;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 0 !important;
        }

        .card-footer {
            border-radius: 0 0 15px 15px !important;
            border-top: 0 !important;
        }

        .container {
            align-content: center;
        }

        .search {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            padding: 10px !important;
        }

        .search:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .type_msg {
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            height: 60px !important;
            overflow-y: auto;
            min-height: unset !important;
        }

        .type_msg:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .attach_btn {
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .send_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .search_btn {
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
            border: 0 !important;
            color: white !important;
            cursor: pointer;
        }

        .contacts {
            list-style: none;
            padding: 0;
        }

        .contacts li {
            width: 100% !important;
            padding: 5px 10px;
            margin-bottom: 15px !important;
        }

        .active {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .user_img {
            height: 70px;
            width: 70px;
            border: 1.5px solid #f5f6fa;

        }

        .user_img_msg {
            height: 40px;
            width: 40px;
            border: 1.5px solid #f5f6fa;

        }

        .img_cont {
            position: relative;
            height: 70px;
            width: 70px;
        }

        .img_cont_msg {
            height: 40px;
            width: 40px;
        }

        .online_icon {
            position: absolute;
            height: 15px;
            width: 15px;
            background-color: #4cd137;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border: 1.5px solid white;
        }

        .offline_icon {
            position: absolute;
            height: 15px;
            width: 15px;
            background-color: #c23616;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border: 1.5px solid white;
        }

        .offline {
            background-color: #c23616 !important;
        }

        .user_info {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }

        .user_info span {
            font-size: 20px;
            color: white;
        }

        .user_info p {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
        }

        .video_cam {
            margin-left: 50px;
            margin-top: 5px;
        }

        .video_cam span {
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }

        .msg_cotainer {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }

        .msg_cotainer_send {
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 25px;
            background-color: #78e08f;
            padding: 10px;
            position: relative;
        }

        .msg_time {
            position: absolute;
            left: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_time_send {
            position: absolute;
            right: 0;
            bottom: -15px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
        }

        .msg_head {
            position: relative;
        }

        #action_menu_btn {
            position: absolute;
            right: 10px;
            top: 10px;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .action_menu {
            z-index: 1;
            position: absolute;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 15px;
            top: 30px;
            right: 15px;
            display: none;
        }

        .action_menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .action_menu ul li {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        .action_menu ul li i {
            padding-right: 10px;

        }

        .action_menu ul li:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 576px) {
            .contacts_card {
                margin-bottom: 15px !important;
            }
        }

    </style>
@endsection


@section('content')
    @include('includes.tutor-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.tutor-sidebar')
                    <div class="col-lg-9 column" id="chatApp">
                        <div class="padding-left content-box">
                            <div class="row justify-content-center h-100">
                                <div class="col-md-5 col-xl-5 chat">
                                    <div class="card mb-sm-3 mb-md-0 contacts_card">
                                        <div class="card-header">
                                            <div class="input-group">
                                                <span style="color: white">Conversations:</span>
                                            </div>
                                        </div>
                                        <div class="card-body contacts_body">
                                            <ul class="contacts">
                                                @forelse($conversations as$friend)
                                                    <li class="lk" style="cursor: pointer"
                                                        v-on:click="getMessages('{{$friend}}',$event)">
                                                        <div class="d-flex bd-highlight">
                                                            <div class="img_cont">
                                                                <img src="{{asset($friend->avatar)}}"
                                                                     class="rounded-circle user_img">
                                                                <span @if(in_array($friend->id,$onlines)) class="online_icon"
                                                                      @else
                                                                      class="offline_icon"@endif
                                                                ></span>
                                                            </div>
                                                            <div class="user_info">
                                                                <span>{{$friend->name}}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li><span>No Conversation found.</span></li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xl-7 chat">
                                    <div class="card" v-if="conversation_show">
                                        <div class="card-header msg_head">
                                            <div class="d-flex bd-highlight">
                                                <div class="img_cont">
                                                    <img :src="friend.avatar"
                                                         class="rounded-circle user_img">
                                                </div>
                                                <div class="user_info">
                                                    <span>@{{ friend.name }}</span>
                                                    <p>@{{ friend.total_message }} Messages</p>
                                                </div>
                                                <div class="video_cam">
                                                    <span v-on:click="video(friend.id)"><i
                                                                class="fas fa-video"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body msg_card_body">
                                            <div v-for="message in messages">
                                                <div v-if="auth.id !== message.user_id"
                                                     class="d-flex justify-content-start mb-4">
                                                    <div class="img_cont_msg">
                                                        <img :src="friend.avatar"
                                                             class="rounded-circle user_img_msg">
                                                    </div>
                                                    <div class="msg_cotainer">
                                                        @{{ message.message }}
                                                        <span class="msg_time">@{{ message.created_at  }}</span>
                                                    </div>
                                                </div>
                                                <div v-else class="d-flex justify-content-end mb-4">
                                                    <div class="msg_cotainer_send">
                                                        @{{ message.message }}
                                                        <span class="msg_time_send">@{{ message.created_at  }}</span>
                                                    </div>
                                                    <div class="img_cont_msg">
                                                        <img :src="auth.avatar"
                                                             class="rounded-circle user_img_msg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group">

                                                <textarea v-model="text" class="form-control type_msg"
                                                          placeholder="Type your message..."
                                                          v-on:keyup.enter="storeMessage"></textarea>
                                                <div class="input-group-append">
                                                    <span class="input-group-text send_btn"
                                                          v-on:click="storeMessage"><i
                                                                class="fas fa-location-arrow"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team" v-else><span> Please Select Conversation.</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script>
        let messageSubscribe = false;
        let app = new Vue({
            el: '#chatApp',
            data: {
                conversation_show: false,
                messages: [],
                text: '',
                auth: {
                    name: '{{Auth::user()->name}}',
                    id: Number('{{Auth::user()->id}}'),
                    avatar: '',
                },
                friend:
                    {
                        id: 0,
                        name: '',
                        avatar: 'default.png',
                        total_message: 0
                    }
            },
            created() {
                let self = this;
                let avatar = '{{Auth::user()->avatar}}'
                if (avatar.substr(0, 7) === 'uploads')
                    this.auth.avatar = '{{url('')}}' + '/' + avatar;
                else
                    this.auth.avatar = avatar;

                let pusher = new Pusher('2536485dc36d05e71007', {
                    cluster: 'ap2'
                });
                let channel = pusher.subscribe('message-' + self.auth.id);
                channel.bind('NewMessage', function (data) {
                    if (self.friend.id === data.message.user_id) {
                        self.messages.push(data.message)
                    } else {
                        notify(data.message.message)
                    }
                });
            },
            methods: {
                getMessages: function (friend, event) {
                    let clickedElement = event.currentTarget
                    $(clickedElement).siblings().removeClass('active');
                    $(clickedElement).addClass('active');
                    friend = JSON.parse(friend)
                    this.friend.id = friend.id;
                    this.friend.name = friend.name;
                    if (friend.avatar.substr(0, 7) === 'uploads')
                        this.friend.avatar = '{{url('')}}' + '/' + friend.avatar;
                    else
                        this.friend.avatar = friend.avatar;

                    this.conversation_show = false;
                    let self = this;
                    $.ajax({
                        url: '{{url('get-messages')}}' + '/' + friend.id,
                        type: 'get',
                        success: function (response) {
                            self.messages = response.messages;
                            self.friend.total_message = response.messages.length
                            self.conversation_show = true;
                        }
                    });
                },
                storeMessage: function () {
                    let self = this;
                    let message = this.text
                    this.text = ''
                    if (message === '') {
                        return false;
                    }

                    $.ajax({
                        url: '{{url('store-message')}}' + '/' + this.friend.id + '/' + message,
                        type: 'get',
                        success: function (response) {
                            self.messages.push(response.message)
                        }
                    });
                },
                video: function (id) {
                    videoCall(id)
                }
            }
        })
        $(document).ready(function () {
            $('#action_menu_btn').click(function () {
                $('.action_menu').toggle();
            });
        });

        function notify(message) {
            toast({
                type: 'success',
                title: message
            })
        }

        $('#tutor-nav-inbox').addClass('active')
    </script>
@endsection
