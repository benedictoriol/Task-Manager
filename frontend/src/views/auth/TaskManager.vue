<script setup>
import { ref, onMounted } from 'vue'
import { fetchTasks, deleteTask } from '@/services/task'

// reactive state
const tasks = ref([])

// fetch tasks from API
const handleFetchTasks = async () => {
  try {
    const response = await fetchTasks()
    tasks.value = response.data   // expects backend to return an array
  } catch (error) {
    console.error('Error fetching tasks:', error)
  }
}

// delete task
const handleDelete = async (taskId) => {
  try {
    await deleteTask(taskId)
    await handleFetchTasks()      // refresh list
  } catch (error) {
    console.error('Error deleting task:', error)
  }
}

// load tasks when component mounts
onMounted(() => {
  handleFetchTasks()
})
</script>

<template>
  <div class="min-h-screen bg-gray-900 text-white flex flex-col">
    
    <!-- HEADER -->
    <header class="w-full bg-gray-800 shadow-md py-4 px-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">TaskManager</h1>

      <div class="flex items-center gap-3">
        <span class="text-gray-300">
          Hello, <span class="font-semibold text-indigo-400">John Doe</span>
        </span>
        <button class="bg-indigo-600 hover:bg-indigo-500 px-4 py-1 rounded-full">
          Logout
        </button>
      </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex items-center justify-center px-4">
      <div class="w-full max-w-md bg-gray-800 rounded-2xl shadow-lg p-6 mt-8">

        <!-- CARD HEADER -->
        <h2 class="text-2xl font-bold text-center mb-6">
          Welcome back, John Doe ✨
        </h2>

        <!-- INPUT FIELD -->
        <div class="flex items-center gap-2 mb-6">
          <input
            type="text"
            placeholder="Add a task..."
            class="flex-1 px-4 py-2 rounded-full bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          />
          <button
            class="bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded-full font-bold transition"
          >
            +
          </button>
        </div>

        <!-- TASK LIST -->
        <div class="space-y-3">
          <div
            v-for="task in tasks"
            :key="task.id"
            class="flex items-center justify-between px-4 py-3 rounded-xl bg-gray-700 hover:bg-gray-600 transition"
          >
            <div class="flex items-center gap-3">
              <input type="checkbox" class="w-5 h-5 accent-indigo-500 rounded-full" />
              <span class="text-white">{{ task.task }}</span>
            </div>
            <button
              @click="handleDelete(task.id)"
              class="text-gray-400 hover:text-red-400"
            >
              ✕
            </button>
          </div>
        </div>

      </div>
    </main>

  </div>
</template>
