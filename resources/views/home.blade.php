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

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyBMgamRJJn2ti_mdtmJA_7COG_0pbskK3o",
            authDomain: "eshop-a4b2d.firebaseapp.com",
            projectId: "eshop-a4b2d",
            storageBucket: "eshop-a4b2d.appspot.com",
            messagingSenderId: "14661348960",
            appId: "1:14661348960:web:56475cea7f2e0dbc859d05",
            measurementId: "G-6M85FSWDB6"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission()
                .then(function () {
                    return messaging.getToken()
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
