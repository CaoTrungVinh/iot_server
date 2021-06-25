importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    // apiKey: "AIzaSyBu9jnu8qw4y1u3ahF4auc50SxaQ6pilR4",
    // authDomain: "luanvaniot.firebaseapp.com",
    // projectId: "luanvaniot",
    // storageBucket: "luanvaniot.appspot.com",
    // messagingSenderId: "572906548859",
    // appId: "1:572906548859:web:def6f1e3e0d9ecb3ba7cde",
    // measurementId: "G-6N2XDGEJSX",
   'messagingSenderId': '572906548859'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: 'https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg' //your logo here
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});