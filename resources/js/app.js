import "./profile";
import "./tasks";

const toggleButton = document.getElementById("navbar-toggle");
const btnBar1 = document.getElementById("bar1");
const btnBar2 = document.getElementById("bar2");
const btnBar3 = document.getElementById("bar3");
const mobileMenu = document.getElementById("mobile-menu");

const onToggleButtonClick = () => {
    btnBar1.classList.toggle("bar-open-1");
    btnBar2.classList.toggle("bar-open-2");
    btnBar3.classList.toggle("bar-open-3");
    mobileMenu.classList.toggle("menu-open");
};

if (toggleButton) {
    toggleButton.addEventListener("click", onToggleButtonClick);
}

import { createTaskStore } from "./task-store/TaskStoreFactory";

const taskStore = createTaskStore();

console.log("Task store:", taskStore);
