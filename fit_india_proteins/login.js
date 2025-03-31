// Sign up and Sign In Panel Logic
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// // Firebase Configuration
// import { initializeApp } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
// import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-auth.js";

// // Firebase Configuration
// const firebaseConfig = {
//     apiKey: "AIzaSyBXBTrlFjsA9S3Ty_Du2__F2KsHtBbjJpU",
//     authDomain: "pawsitiveclinic-7a2b9.firebaseapp.com",
//     projectId: "pawsitiveclinic-7a2b9",
//     storageBucket: "pawsitiveclinic-7a2b9.firebasestorage.app",
//     messagingSenderId: "571567514515",
//     appId: "1:571567514515:web:1eaf34337dc9e167cbfe66"
// };

// // Initialize Firebase
// const app = initializeApp(firebaseConfig);
// const auth = getAuth(app);

// Handle SignUp Form Submit
// const signUpForm = document.getElementById('signup-form');
// signUpForm.addEventListener("submit", function (event) {
//     event.preventDefault();  // Prevent the form from submitting the traditional way

//     const email = document.getElementById('SignUpEmail').value;
//     const password = document.getElementById('SignUpPassword').value;

//     createUserWithEmailAndPassword(auth, email, password)
//         .then((userCredential) => {
//             const user = userCredential.user;
//             alert("Account created successfully.");
//             // Optionally redirect to login page or dashboard
//             // window.location.href = "/login.html"; 
//         })
//         .catch((error) => {
//             const errorMessage = error.message;
//             alert(errorMessage);
//         });
// });

// // Handle Login Form Submit
// const loginForm = document.getElementById('login-form');
// loginForm.addEventListener("submit", function (event) {
//     event.preventDefault();  // Prevent the form from submitting the traditional way

//     const email = document.getElementById('LoginEmail').value;
//     const password = document.getElementById('LoginPassword').value;

//     signInWithEmailAndPassword(auth, email, password)
//         .then((userCredential) => {
//             const user = userCredential.user;
//             alert("Login successful.");
//             // Redirect to the dashboard or home page
//             window.location.href = "/index.html"; // Correct path
//         })
//         .catch((error) => {
//             const errorMessage = error.message;
//             alert(errorMessage);
//         });
// });

