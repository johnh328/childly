require("./bootstrap");
import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import { routes } from "./routes";

const router = new VueRouter({
    routes,
    mode: "history",
});

import User from "./Helpers/User";
window.User = User;

import Swal from "sweetalert2";
window.Swal = Swal;

import Notification from "./Helpers/Notification";
window.Notification = Notification;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

window.Toast = Toast;

const app = new Vue({
    el: "#app",
    router,
});
