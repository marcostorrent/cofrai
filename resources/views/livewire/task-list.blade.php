<div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">
        Task List
    </h3>
    <ul class="divide-y divide-gray-200">
        @forelse ($tasks as $task)
            <li class="py-4 flex items-center justify-between space-x-3">
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{ $task->title }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $task->description }}
                    </p>
                </div>
                
            </li>
        @empty
            <p>No Tasks</p>
        @endforelse
    </ul>
</div>

