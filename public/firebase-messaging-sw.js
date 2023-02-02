importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');
firebase.initializeApp({
    apiKey: "AIzaSyCS_jnYg6wvN7U-PdKS5vKTd2S3WQtC4UU",
    authDomain: "eshop-87b44.firebaseapp.com",
    projectId: "eshop-87b44",
    storageBucket: "eshop-87b44.appspot.com",
    messagingSenderId: "687764140981",
    appId: "1:687764140981:web:7b384a3b9543b26e791ffc",
    measurementId: "G-2XV3SFFF84"
});
const messaging = firebase.messaging();
messaging.onBackgroundMessage(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {"body": payload.notification.body, "dir": 'rtl', "lang": 'ar', "renotify": false};
    self.registration.showNotification(notificationTitle, notificationOptions);
});
