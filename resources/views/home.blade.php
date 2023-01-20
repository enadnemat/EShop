@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <button class="btn btn-danger btn-flat" name="token" onclick="initFirebaseMessagingRegistration()">
                        Allow notification
                    </button>
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
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/9.16.0/firebase-analytics.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-analytics.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyCS_jnYg6wvN7U-PdKS5vKTd2S3WQtC4UU",
            authDomain: "eshop-87b44.firebaseapp.com",
            projectId: "eshop-87b44",
            storageBucket: "eshop-87b44.appspot.com",
            messagingSenderId: "687764140981",
            appId: "1:687764140981:web:7b384a3b9543b26e791ffc",
            measurementId: "G-2XV3SFFF84"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission()
                .then(function () {
                    var token = messaging.getToken()
                    console.log(token);
                })
                .then(function (token) {
                    axios.post("{{ route('store.token') }}", {
                        _method: "PATCH",
                        token
                    }).then(({data}) => {
                        console.log(data)
                    }).catch(({response: {data}}) => {
                        console.error(data)
                    })
                }).catch(function (err) {
                console.log(`Token Error :: ${err}`);
            });
        }

        messaging.onMessage(function (payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    </script>
@endsection
