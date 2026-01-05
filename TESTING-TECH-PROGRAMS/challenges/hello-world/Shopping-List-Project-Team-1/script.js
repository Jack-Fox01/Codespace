document.addEventListener('DOMContentLoaded', () => {
  const addTaskBtn = document.getElementById('addTaskBtn');
  const taskInput = document.getElementById('taskInput');
  const taskList = document.getElementById('taskList');

  let draggedTask = null;

  // Add task on button click
  addTaskBtn.addEventListener('click', () => {
    const taskText = taskInput.value.trim();
    if (!taskText) return;

    const li = createTask(taskText);
    taskList.appendChild(li);
    taskInput.value = '';
  });

  // Enter key adds task
  taskInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') addTaskBtn.click();
  });

  // Create task element
  function createTask(text) {
    const li = document.createElement('li');
    li.classList.add('task', 'added');
    li.setAttribute('draggable', true);

    // Left container: checkbox + text
    const left = document.createElement('div');
    left.classList.add('task-left');

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.addEventListener('change', () => {
      li.style.opacity = '0';
      setTimeout(() => li.remove(), 500);
    });

    const taskSpan = document.createElement('span');
    taskSpan.textContent = text;

    left.appendChild(checkbox);
    left.appendChild(taskSpan);
    li.appendChild(left);

    // Delete button
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = '×';
    deleteBtn.classList.add('btn', 'btn-sm', 'btn-danger');
    deleteBtn.addEventListener('click', () => li.remove());
    li.appendChild(deleteBtn);

    // Remove added class after animation
    li.addEventListener('animationend', () => li.classList.remove('added'));

    // Drag events
    li.addEventListener('dragstart', () => {
      draggedTask = li;
      li.classList.add('dragging');
    });
    li.addEventListener('dragend', () => {
      draggedTask = null;
      li.classList.remove('dragging');
    });

    return li;
  }

  // Drag-over logic
  taskList.addEventListener('dragover', (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(taskList, e.clientY);
    if (afterElement == null) {
      taskList.appendChild(draggedTask);
    } else {
      taskList.insertBefore(draggedTask, afterElement);
    }
  });

  function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.task:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
  }
});
