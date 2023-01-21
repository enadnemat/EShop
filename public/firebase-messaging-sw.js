importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCS_jnYg6wvN7U-PdKS5vKTd2S3WQtC4UU",
    projectId: "eshop-87b44",
    messagingSenderId: "687764140981",
    appId: "1:687764140981:web:7b384a3b9543b26e791ffc",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
