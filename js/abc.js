// To-Do List Application
document.addEventListener('DOMContentLoaded', function() {
    // Selectors
    const inputField = document.querySelector('#task-input');
    const addButton = document.querySelector('#add-task');
    const taskList = document.querySelector('#task-list');

    // Event Listeners
    addButton.addEventListener('click', addTask);
    taskList.addEventListener('click', handleTask);

    // Functions
    function addTask() {
        const taskText = inputField.value.trim();
        if (taskText === '') {
            alert('Please enter a task.');
            return;
        }

        // Create task elements
        const taskItem = document.createElement('li');
        taskItem.classList.add('task-item');

        const taskContent = document.createElement('span');
        taskContent.classList.add('task-content');
        taskContent.textContent = taskText;

        const completeButton = document.createElement('button');
        completeButton.classList.add('complete-task');
        completeButton.textContent = 'Complete';

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('delete-task');
        deleteButton.textContent = 'Delete';

        // Append elements
        taskItem.appendChild(taskContent);
        taskItem.appendChild(completeButton);
        taskItem.appendChild(deleteButton);
        taskList.appendChild(taskItem);

        // Clear input
        inputField.value = '';
    }

    function handleTask(event) {
        const item = event.target;
        const taskItem = item.parentElement;

        if (item.classList.contains('complete-task')) {
            taskItem.classList.toggle('completed');
        } else if (item.classList.contains('delete-task')) {
            taskItem.remove();
        }
    }
});

// Additional features
function saveTasks() {
    const tasks = [];
    const taskItems = document.querySelectorAll('.task-item');
    taskItems.forEach(item => {
        tasks.push({
            content: item.querySelector('.task-content').textContent,
            completed: item.classList.contains('completed')
        });
    });
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function loadTasks() {
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.forEach(task => {
        const taskItem = document.createElement('li');
        taskItem.classList.add('task-item');
        if (task.completed) taskItem.classList.add('completed');

        const taskContent = document.createElement('span');
        taskContent.classList.add('task-content');
        taskContent.textContent = task.content;

        const completeButton = document.createElement('button');
        completeButton.classList.add('complete-task');
        completeButton.textContent = 'Complete';

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('delete-task');
        deleteButton.textContent = 'Delete';

        taskItem.appendChild(taskContent);
        taskItem.appendChild(completeButton);
        taskItem.appendChild(deleteButton);
        document.querySelector('#task-list').appendChild(taskItem);
    });
}

function clearCompletedTasks() {
    const completedTasks = document.querySelectorAll('.completed');
    completedTasks.forEach(task => task.remove());
}

// Event listeners for saving tasks
window.addEventListener('beforeunload', saveTasks);
window.addEventListener('load', loadTasks);

// Clear button
document.querySelector('#clear-completed').addEventListener('click', clearCompletedTasks);

// Example utility function to display a custom message
function showMessage(message, type) {
    const messageBox = document.createElement('div');
    messageBox.textContent = message;
    messageBox.className = `message ${type}`;
    document.body.appendChild(messageBox);
    setTimeout(() => messageBox.remove(), 3000);
}
