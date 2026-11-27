import { TaskStore } from "./TaskStore";

export class IndexedDBTaskStore extends TaskStore {
    constructor() {
        super();

        this.dbName = "TaskManagerDB";
        this.dbVersion = 1;
        this.storeName = "tasks";
    }

    async openDB() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open(this.dbName, this.dbVersion);

            request.onupgradeneeded = (event) => {
                const db = event.target.result;

                if (!db.objectStoreNames.contains(this.storeName)) {
                    db.createObjectStore(this.storeName, {
                        keyPath: "id",
                        autoIncrement: true,
                    });
                }
            };

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    async createTask(data) {
        const db = await this.openDB();

        const now = new Date().toISOString();

        const task = {
            title: data.title,
            description: data.description ?? "",
            status: data.status ?? "Pending",
            priority: data.priority ?? "Medium",
            due_date_time: data.due_date_time ?? null,

            completed_at: data.status === "Completed" ? now : null,

            created_at: now,
            updated_at: now,
            deleted_at: null,
        };

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readwrite");

            const store = transaction.objectStore(this.storeName);

            const request = store.add(task);

            request.onsuccess = (event) => {
                task.id = event.target.result;

                resolve(task);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    async getTask(id) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readonly");

            const store = transaction.objectStore(this.storeName);

            const request = store.get(id);

            request.onsuccess = () => {
                resolve(request.result ?? null);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    async getTasks(filters = {}) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readonly");

            const store = transaction.objectStore(this.storeName);

            const request = store.getAll();

            request.onsuccess = () => {
                let tasks = request.result;

                // Exclude soft-deleted tasks
                tasks = tasks.filter((task) => {
                    return task.deleted_at === null;
                });

                // Search
                if (filters.search) {
                    const search = filters.search.toLowerCase();

                    tasks = tasks.filter((task) => {
                        const title = task.title?.toLowerCase() ?? "";

                        const description =
                            task.description?.toLowerCase() ?? "";

                        return (
                            title.includes(search) ||
                            description.includes(search)
                        );
                    });
                }

                // Status filter
                if (filters.status) {
                    tasks = tasks.filter((task) => {
                        return task.status === filters.status;
                    });
                }

                // Priority filter
                if (filters.priority) {
                    tasks = tasks.filter((task) => {
                        return task.priority === filters.priority;
                    });
                }

                // Sort
                const sort = filters.sort ?? "newest";

                switch (sort) {
                    case "oldest":
                        tasks.sort((a, b) => {
                            return (
                                new Date(a.created_at) - new Date(b.created_at)
                            );
                        });

                        break;

                    case "title_asc":
                        tasks.sort((a, b) => {
                            return a.title.localeCompare(b.title);
                        });

                        break;

                    case "title_desc":
                        tasks.sort((a, b) => {
                            return b.title.localeCompare(a.title);
                        });

                        break;

                    case "newest":
                    default:
                        tasks.sort((a, b) => {
                            return (
                                new Date(b.created_at) - new Date(a.created_at)
                            );
                        });

                        break;
                }

                resolve(tasks);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    async updateTask(id, data) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readwrite");

            const store = transaction.objectStore(this.storeName);

            const getRequest = store.get(id);

            getRequest.onsuccess = () => {
                const existingTask = getRequest.result;

                if (!existingTask) {
                    resolve(null);

                    return;
                }

                const now = new Date().toISOString();

                const updatedTask = {
                    ...existingTask,

                    title: data.title,
                    description: data.description ?? "",
                    status: data.status,
                    priority: data.priority,
                    due_date_time: data.due_date_time ?? null,

                    completed_at:
                        data.status === "Completed"
                            ? (existingTask.completed_at ?? now)
                            : null,

                    updated_at: now,
                };

                const putRequest = store.put(updatedTask);

                putRequest.onsuccess = () => {
                    resolve(updatedTask);
                };

                putRequest.onerror = () => {
                    reject(putRequest.error);
                };
            };

            getRequest.onerror = () => {
                reject(getRequest.error);
            };
        });
    }

    async deleteTask(id) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readwrite");

            const store = transaction.objectStore(this.storeName);

            const getRequest = store.get(id);

            getRequest.onsuccess = () => {
                const task = getRequest.result;

                if (!task) {
                    resolve(null);

                    return;
                }

                const now = new Date().toISOString();

                task.deleted_at = now;
                task.updated_at = now;

                const putRequest = store.put(task);

                putRequest.onsuccess = () => {
                    resolve({
                        message: "Task deleted successfully.",
                    });
                };

                putRequest.onerror = () => {
                    reject(putRequest.error);
                };
            };

            getRequest.onerror = () => {
                reject(getRequest.error);
            };
        });
    }

    async getDeletedTasks() {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readonly");

            const store = transaction.objectStore(this.storeName);

            const request = store.getAll();

            request.onsuccess = () => {
                const deletedTasks = request.result
                    .filter((task) => task.deleted_at !== null)
                    .sort((a, b) => {
                        return new Date(b.deleted_at) - new Date(a.deleted_at);
                    });

                resolve(deletedTasks);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    async restoreTask(id) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readwrite");

            const store = transaction.objectStore(this.storeName);

            const getRequest = store.get(id);

            getRequest.onsuccess = () => {
                const task = getRequest.result;

                if (!task) {
                    resolve(null);

                    return;
                }

                if (task.deleted_at === null) {
                    resolve(null);

                    return;
                }

                task.deleted_at = null;
                task.updated_at = new Date().toISOString();

                const putRequest = store.put(task);

                putRequest.onsuccess = () => {
                    resolve(task);
                };

                putRequest.onerror = () => {
                    reject(putRequest.error);
                };
            };

            getRequest.onerror = () => {
                reject(getRequest.error);
            };
        });
    }

    async permanentlyDeleteTask(id) {
        const db = await this.openDB();

        return new Promise((resolve, reject) => {
            const transaction = db.transaction(this.storeName, "readwrite");

            const store = transaction.objectStore(this.storeName);

            const getRequest = store.get(id);

            getRequest.onsuccess = () => {
                const task = getRequest.result;

                if (!task) {
                    resolve(null);

                    return;
                }

                const deleteRequest = store.delete(id);

                deleteRequest.onsuccess = () => {
                    resolve({
                        message: "Task permanently deleted.",
                    });
                };

                deleteRequest.onerror = () => {
                    reject(deleteRequest.error);
                };
            };

            getRequest.onerror = () => {
                reject(getRequest.error);
            };
        });
    }
}
