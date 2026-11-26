<form method="GET"
    action="{{ route('tasks.index') }}"
    class="task-search-form">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search tasks...">

    <select name="status">
        <option value="">All Statuses</option>
        <option value="Pending"
            {{ request('status') === 'Pending' ? 'selected' : '' }}>
            Pending
        </option>
        <option value="In Progress"
            {{ request('status') === 'In Progress' ? 'selected' : '' }}>
            In Progress
        </option>
        <option value="Completed"
            {{ request('status') === 'Completed' ? 'selected' : '' }}>
            Completed
        </option>
    </select>

    <select name="priority">
        <option value="">All Priorities</option>
        <option value="Low"
            {{ request('priority') === 'Low' ? 'selected' : '' }}>
            Low
        </option>
        <option value="Medium"
            {{ request('priority') === 'Medium' ? 'selected' : '' }}>
            Medium
        </option>
        <option value="High"
            {{ request('priority') === 'High' ? 'selected' : '' }}>
            High
        </option>
    </select>

    <select name="sort">
        <option value="newest"
            {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>
            Newest
        </option>
        <option value="oldest"
            {{ request('sort') === 'oldest' ? 'selected' : '' }}>
            Oldest
        </option>
        <option value="title_asc"
            {{ request('sort') === 'title_asc' ? 'selected' : '' }}>
            Title A-Z
        </option>
        <option value="title_desc"
            {{ request('sort') === 'title_desc' ? 'selected' : '' }}>
            Title Z-A
        </option>
    </select>

    <button type="submit" class="button">
        Apply
    </button>

</form>