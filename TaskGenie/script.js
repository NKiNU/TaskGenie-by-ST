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

    const deleteBtn = document.createElement('button');
    deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm');
    deleteBtn.textContent = 'Delete';
    deleteBtn.addEventListener('click', () => {
      tasks = tasks.filter(t => t.id !== task.id);
      renderTasks();
      renderTaskProgressChart();
    });

    const editBtn = document.createElement('button');
    editBtn.classList.add('btn', 'btn-secondary', 'btn-sm', 'me-2');
    editBtn.textContent = 'Edit';
    editBtn.addEventListener('click', () => {
      const newName = prompt('Enter a new name for the task:', task.name);
      if (newName !== null && newName.trim() !== '') {
        task.name = newName.trim();
        renderTasks();
        renderTaskProgressChart();
      }
    });

    const statusBtn = document.createElement('button');
    statusBtn.classList.add('btn', 'btn-success', 'btn-sm');
    statusBtn.textContent = task.status === 'completed' ? 'Mark In Progress' : 'Mark Completed';
    statusBtn.addEventListener('click', () => {
      task.status = task.status === 'completed' ? 'inprogress' : 'completed';
      renderTasks();
      renderTaskProgressChart();
    });

    listItem.appendChild(deleteBtn);
    listItem.appendChild(editBtn);
    listItem.appendChild(statusBtn);
    taskList.appendChild(listItem);
  });
}

function renderTaskProgressChart() {
  const priorityLabels = ['Low Priority', 'Medium Priority', 'High Priority'];
  const priorityData = [4, 2, 1];


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

// Add a new task to the list
function addTask() {
  // Get the input value
  const taskName = document.getElementById('new-task').value.trim();
  if (taskName === '') {
    return;
  }

  // Create a new list item with a checkbox
  const listItem = document.createElement('li');
  listItem.classList.add('list-group-item');
  listItem.innerHTML = `
    <label class="checkbox-label">
      <input type="checkbox" onchange="toggleTask(this)">
      <span>${taskName}</span>
    </label>
  `;

  // Add the new item to the list
  document.getElementById('task-list').appendChild(listItem);

  // Clear the input field
  document.getElementById('new-task').value = '';
}

// Toggle the completed status of a task
function toggleTask(checkbox) {
  checkbox.parentNode.classList.toggle('completed');
  checkbox.checked = checkbox.parentNode.classList.contains('completed');
}

// Add a click event listener to the Add button
document.getElementById('add-button').addEventListener('click', addTask);


renderTasks();
renderTaskProgressChart();






