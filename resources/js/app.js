import './bootstrap';
import "../sass/app.scss";
import './script'
import * as bootstrap from "bootstrap";

window.bootstrap = bootstrap;


const burgerButton = document.querySelector('.burgerButton');
const sidebar = document.querySelector('#sidebar');

burgerButton.addEventListener('click',function(){
    sidebar.classList.toggle('switch')
})