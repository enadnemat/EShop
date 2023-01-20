importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBMgamRJJn2ti_mdtmJA_7COG_0pbskK3o",
    projectId: "eshop-a4b2d",
    messagingSenderId: "14661348960",
    appId: "1:14661348960:web:56475cea7f2e0dbc859d05",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({data: {title, body, icon}}) {
    return self.registration.showNotification(title, {body, icon});
});
