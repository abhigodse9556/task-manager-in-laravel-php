import { TaskStore } from "./TaskStore";

export class LaravelTaskStore extends TaskStore {
    constructor() {
        super();

        this.csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");
    }

    async request(url, options = {}) {
        options.headers = {
            Accept: "text/html",
            ...(options.headers ?? {}),
        };

        options.headers["X-CSRF-TOKEN"] = this.csrfToken;

        return fetch(url, options);
    }

    async getTasks(filters = {}) {
        const params = new URLSearchParams();

        Object.entries(filters).forEach(([key, value]) => {
            if (value !== null && value !== undefined && value !== "") {
                params.set(key, value);
            }
        });

        const queryString = params.toString();

        const url = queryString ? `/api/tasks?${queryString}` : "/api/tasks";

        const response = await this.request(url);

        return response.json();
    }

    async getTask(id) {
        const response = await this.request(`/api/tasks/${id}`);

        return response.json();
    }

    async createTask(data) {
        const response = await this.request("/api/tasks", {
            method: "POST",

            headers: {
                "Content-Type": "application/json",
            },

            body: JSON.stringify(data),
        });

        return response.json();
    }

    async updateTask(id, data) {
        const response = await this.request(`/api/tasks/${id}`, {
            method: "PUT",

            headers: {
                "Content-Type": "application/json",
            },

            body: JSON.stringify(data),
        });

        return response.json();
    }

    async deleteTask(id) {
        const response = await this.request(`/api/tasks/${id}`, {
            method: "DELETE",
        });

        return response.json();
    }

    async getDeletedTasks() {
        const response = await this.request("/api/tasks/bin");

        return response.json();
    }

    async restoreTask(id) {
        const response = await this.request(`/api/tasks/${id}/restore`, {
            method: "PATCH",
        });

        return response.json();
    }

    async permanentlyDeleteTask(id) {
        const response = await this.request(`/api/tasks/${id}/force-delete`, {
            method: "DELETE",
        });

        return response.json();
    }
}
