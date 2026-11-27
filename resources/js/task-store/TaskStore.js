export class TaskStore {
    async getTasks(filters = {}) {
        throw new Error('getTasks() must be implemented');
    }

    async getTask(id) {
        throw new Error('getTask() must be implemented');
    }

    async createTask(data) {
        throw new Error('createTask() must be implemented');
    }

    async updateTask(id, data) {
        throw new Error('updateTask() must be implemented');
    }

    async deleteTask(id) {
        throw new Error('deleteTask() must be implemented');
    }

    async getDeletedTasks() {
        throw new Error('getDeletedTasks() must be implemented');
    }

    async restoreTask(id) {
        throw new Error('restoreTask() must be implemented');
    }

    async permanentlyDeleteTask(id) {
        throw new Error('permanentlyDeleteTask() must be implemented');
    }
}