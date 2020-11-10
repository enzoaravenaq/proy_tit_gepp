import Vue from "vue";
import Router from "vue-router";

const routes = [
    {
        path: '/',
        component: () => import('./views/')
    }
]