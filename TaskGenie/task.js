const taskInput = document.getElementById('taskInput');
const prioritySelect = document.getElementById('prioritySelect');
const deadlineInput = document.getElementById('deadlineInput');
const addTaskBtn = document.getElementById('addTaskBtn');
const categorySelect = document.getElementById('categorySelect');
const statusSelect = document.getElementById('statusSelect');
const clearFiltersBtn = document.getElementById('clearFiltersBtn');
const taskList = document.getElementById('taskList');
const taskProgressChart = document.getElementById('taskProgressChart').getContext('2d');

let tasks = [];

function renderTasks() {
  taskList.innerHTML = '';

  const filteredTasks = tasks.filter(task => {
    const categoryFilter = categorySelect.value === 'all' || task.category === categorySelect.value;
    const statusFilter = statusSelect.value === 'all' || task.status === statusSelect.value;
    return categoryFilter && statusFilter;
  });

  filteredTasks.forEach(task => {
    const listItem = document.createElement('li');
    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
    listItem.textContent = task.name;

    if (task.status === 'completed') {
      listItem.classList.add('completed');
    }
                       

  });
}

function renderTaskProgressChart() {
  const priorityLabels = ['Low Priority', 'Medium Priority', 'High Priority'];
  const priorityData = [0, 0, 0];

  tasks.forEach(task => {
    if (task.status === 'completed') {
      const priorityIndex = task.priority === 'low' ? 0 : task.priority === 'medium' ? 1 : 2;
      priorityData[priorityIndex]++;
    }
  });

  const data = {
    labels: priorityLabels,
    datasets: [
      {
        label: 'Task Completion Rate',
        data: priorityData,
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 206, 86, 0.2)'],
        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 206, 86, 1)'],
        borderWidth: 1,
      },
    ],
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  };

  const taskProgressChart = new Chart(taskProgressChart, config);
}

addTaskBtn.addEventListener('click', () => {
  if (taskInput.value.trim() !== '') {
    const newTask = {
      id: Date.now(),
      name: taskInput.value.trim(),
      priority: prioritySelect.value,
      deadline: deadlineInput.value,
      category: 'other',
      status: 'todo',
    };

    tasks.push(newTask);
    renderTasks();
    renderTaskProgressChart();

    taskInput.value = '';
    prioritySelect.value = 'low';
    deadlineInput.value = '';
  }
});

categorySelect.addEventListener('change', () => {
  renderTasks();
});

statusSelect.addEventListener('change', () => {
  renderTasks();
});

clearFiltersBtn.addEventListener('click', () => {
  categorySelect.value = 'all';
  statusSelect.value = 'all';
  renderTasks();
});

renderTasks();
renderTaskProgressChart();
