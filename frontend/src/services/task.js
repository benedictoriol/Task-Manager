import axios from 'axios'

const API_URL = 'http://127.0.0.1:8000/api/tasks' // adjust if needed

export const fetchTasks = () => axios.get(API_URL)

export const deleteTask = (taskId) => axios.delete(`${API_URL}/${taskId}`)
