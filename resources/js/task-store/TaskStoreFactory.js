import { LaravelTaskStore } from "./LaravelTaskStore";
import { IndexedDBTaskStore } from "./IndexedDBTaskStore";

export function createTaskStore() {
    const isAuthenticated = document.body.dataset.authenticated === "true";

    if (isAuthenticated) {
        return new LaravelTaskStore();
    }

    return new IndexedDBTaskStore();
}
