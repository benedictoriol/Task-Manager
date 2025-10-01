<script setup>
  
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl">
      <h2 class="text-3xl font-bold text-white text-center mb-2">Welcome</h2>
      <p class="text-gray-300 text-center mb-6">Login to continue</p>

      <form class="space-y-4">
        <input type="email" placeholder="Email" required
              class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <input type="password" placeholder="Password" required
              class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition">
          Login
        </button>

        <p class="text-center text-gray-300 text-sm">
          Don’t have an account?
          <router-link to="/register" class="text-indigo-400 hover:underline">
            Sign up
          </router-link>
        </p>
      </form>
    </div>
  </div>
</template>

