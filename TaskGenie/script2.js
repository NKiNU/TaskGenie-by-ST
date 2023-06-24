// ---------------------------------------------SIDEBAR--------------------------------------------- //

$('.open-btn').on('click', function () {
    $('.sidebar').addClass('active');
});

$('.close-btn').on('click', function () {
    $('.sidebar').removeClass('active');
});

// ---------------------------------------------SIDEBAR--------------------------------------------- //



// ---------------------------------------------PROFILE PICTURE--------------------------------------------- //
const fileInput = document.getElementById("pic-upload");
const profilePic = document.getElementById("profile-pic");

fileInput.addEventListener("change", function() {
  const file = this.files[0];
  const reader = new FileReader();

  reader.addEventListener("load", function() {
    profilePic.src = reader.result;
  });

  reader.readAsDataURL(file);
});


let userInfo = {
	name: "ali abu",
	email: "",
	username: "",
	password: ""
};

let editForm;


function getUser() {
	// Dummy function for getting user information
	$("#name").text(userInfo.name);
	$("#email").text(userInfo.email);
	$("#username").text(userInfo.username);
	$("#edit-name").val(userInfo.name);
	$("#edit-email").val(userInfo.email);
	$("#edit-username").val(userInfo.username);
	$("#spinner").hide();
	$("#user-info").show();
}

// Show edit form and hide user info
function editUser() {
	// Show password prompt dialog
	$("#confirmPasswordModal").modal("show");
}

// Verify password and show edit form if correct
function confirmPassword() {
	let password = $("#current-password").val();
	if (password === userInfo.password) {
		// Hide password prompt dialog and show edit form
		$("#confirmPasswordModal").modal("hide");
		$("#user-info").hide();
		$("#edit-form").show();
	} else {
		alert("Incorrect password");
	}
}

// Hide edit form and show user info
function cancelEdit() {
	$("#edit-form").hide();
	$("#user-info").show();
}

// Save edited user information to server
function saveUser() {
	// Dummy function for saving user information
	let newName = $("#edit-name").val();
	let newEmail = $("#edit-email").val();
	let newUsername = $("#edit-username").val();
	let newPassword = $("#edit-password").val();
	let confirmNewPassword = $("#edit-confirm-password").val();

	if (newName === "" || newEmail === "" || newUsername === "" || newPassword === "" || confirmNewPassword === "") {
		alert("Please fill in all fields");
		return;
	}

	if (newPassword !== confirmNewPassword) {
		alert("Passwords do not match");
		return;
	}

	userInfo.name = newName;
	userInfo.email = newEmail;
	userInfo.username = newUsername;
	userInfo.password = newPassword;

	// update UI with new data
	getUser();
	// Add this code after the profile is saved successfully

	// Get the toast element
	var toast = document.querySelector('.toast');

	// Show the toast
	var toastElement = new bootstrap.Toast(toast);
	toastElement.show();


	$("#edit-form").hide();
	$("#user-info").show();
}

// Delete user account from server
function deleteUser() {
	if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
		// Dummy function for deleting user account
		location.href = "login.php";
	}
}

// ---------------------------------------------PROFILE PAGE--------------------------------------------- //



// // Initialize page
// $(function() {
// 	getUser();
// });

// function changeStatus(spanElement) {
//   const currentStatus = spanElement.innerText;
//   let newStatus;
//   switch (currentStatus) {
//     case 'Waiting':
//       newStatus = 'In Progress';
//       spanElement.classList.remove('waiting');
//       spanElement.classList.add('in-progress');
//       break;
//     case 'In Progress':
//       newStatus = 'Done';
//       spanElement.classList.remove('in-progress');
//       spanElement.classList.add('done');
//       break;
//     case 'Done':
//       newStatus = 'Waiting';
//       spanElement.classList.remove('done');
//       spanElement.classList.add('waiting');
//       break;
//   }
//   spanElement.innerText = newStatus;
// }

// // Add task
// const taskInput = document.getElementById('taskInput');
// const prioritySelect = document.getElementById('prioritySelect');
// const deadlineInput = document.getElementById('deadlineInput');
// const addTaskBtn = document.getElementById('addTaskBtn');
// const categorySelect = document.getElementById('categorySelect');
// const statusSelect = document.getElementById('statusSelect');
// const clearFiltersBtn = document.getElementById('clearFiltersBtn');
// const taskList = document.getElementById('taskList');
// const taskProgressChart = document.getElementById('taskProgressChart').getContext('2d');

// let tasks = [];

// function renderTasks() {
//   taskList.innerHTML = '';

//   const filteredTasks = tasks.filter(task => {
//     const categoryFilter = categorySelect.value === 'all' || task.category === categorySelect.value;
//     const statusFilter = statusSelect.value === 'all' || task.status === statusSelect.value;
//     return categoryFilter && statusFilter;
//   });

//   filteredTasks.forEach(task => {
//     const listItem = document.createElement('li');
//     listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
    
//     const taskNameSpan = document.createElement('span');
//     taskNameSpan.textContent = task.name;

//     const taskDateSpan = document.createElement('span');
//     taskDateSpan.textContent = task.deadline;

//     if (task.status === 'completed') {
//       listItem.classList.add('completed');
//     }

//     const deleteBtn = document.createElement('button');
//     deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm');
//     deleteBtn.textContent = 'Delete';
//     deleteBtn.addEventListener('click', () => {
//       tasks = tasks.filter(t => t.id !== task.id);
//       renderTasks();
//       renderTaskProgressChart();
//     });

//     const editBtn = document.createElement('button');
//     editBtn.classList.add('btn', 'btn-secondary', 'btn-sm', 'me-2');
//     editBtn.textContent = 'Edit';
//     editBtn.addEventListener('click', () => {
//   const newName = prompt('Enter a new name for the task:', task.name);
//   const newPriority = prompt('Enter a new priority for the task (low, medium, high):', task.priority);
//   const newDate = prompt('Enter a new deadline for the task (yyyy-mm-dd):', task.date);

//   if (newName !== null && newName.trim() !== '') {
//     task.name = newName.trim();
//     task.priority = newPriority.trim().toLowerCase();
//     task.date = newDate.trim();
//     renderTasks();
//     renderTaskProgressChart();
//   }
// });


//     const statusBtn = document.createElement('button');
//     statusBtn.classList.add('btn', 'btn-success', 'btn-sm');
//     statusBtn.textContent = task.status === 'completed' ? 'Mark In Progress' : 'Mark Completed';
//     statusBtn.addEventListener('click', () => {
//       task.status = task.status === 'completed' ? 'inprogress' : 'completed';
//       renderTasks();
//       renderTaskProgressChart();
//     });

//     listItem.appendChild(taskNameSpan);
//     listItem.appendChild(taskDateSpan);
//     listItem.appendChild(deleteBtn);
//     listItem.appendChild(editBtn);
//     listItem.appendChild(statusBtn);
//     taskList.appendChild(listItem);
//   });
// }
