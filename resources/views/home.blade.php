@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('send.web-notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Message Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Message Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="mt-2 btn btn-success btn-block">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.6.2/firebase-app.js";
        import {
            getMessaging,
            onMessage,
            getToken
        } from "https://www.gstatic.com/firebasejs/9.6.2/firebase-messaging.js";
        const firebaseConfig = {
            apiKey: "AIzaSyCS_jnYg6wvN7U-PdKS5vKTd2S3WQtC4UU",
            authDomain: "eshop-87b44.firebaseapp.com",
            projectId: "eshop-87b44",
            storageBucket: "eshop-87b44.appspot.com",
            messagingSenderId: "687764140981",
            appId: "1:687764140981:web:7b384a3b9543b26e791ffc",
            measurementId: "G-2XV3SFFF84"
        };
        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging();
        getToken(messaging, {
            vapidKey: 'BARvy-m9iBj2a6yf_SSPfqUVmzSPQDkSt2tKXSVoA2al3iskPwXntl4e20qqK1yOI8a9ij5K_M5VR4zQ9_JGDbs'
        }).then((currentToken) => {
            if (currentToken) {
            } else {
                console.log('No registration token available. Request permission to generate one.');
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
        });
        onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });

        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("store.token") }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token stored.');
                        },
                        error: function (error) {
                            alert(error);
                        },
                    });
                }).catch(function (error) {
                alert(error);
            });
        }


    </script>
@endsection
