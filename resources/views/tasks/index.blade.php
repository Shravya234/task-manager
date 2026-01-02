<!DOCTYPE html>
<html lang="en">
<head>
    <title>Task Manager</title>
    <style>
        body {
            background-color: #fbf4f4ff;
            font-family:Arial, sans-serif;
            padding: 15px;
        }

        h1 {
            font-style: italic;
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }

        .task-card {
            display: flex;
            align-items: center;
            background-color: #dcf0fdff;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .task-icon {
            width: 50px;
            height: 50px;
            background-color: #fad5d5ff;
            border-radius: 10px;
            margin-right: 12px;
        }

        .task-header {
            display: flex;
            align-items: center;
            gap: 12px; 
        }

        .task-content {
            flex: 1;   /*This pushes actions to the RIGHT */
        }

        .task-title {
            font-size: 16px;
            font-weight: bold;
            color: black;
            padding-bottom: 15px;
        }

        .task-date {
            font-size: 12px;
            color: #000000ff;
        }

        .pending {
            padding: 5px;
            color: #ff6b6b;
             font-weight: bold;
        }

        .completed {
            color: green;
            font-weight: bold;
        }

        .task-actions {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            gap: 35px;
        }

        .task-desc{
            color: black;
            font-size: 13px;
            padding-bottom: 10px;
        }

        .task-priority {
            font-size: 15px;
            font-weight: bold;
            padding-top: 5px;
            padding-right: 15px;
            border-radius: 6px;
            display: inline-block;
            color: white;
        }

        /* Priority colors */
        .task-priority.low {
            color:darkcyan;
        }

        .task-priority.medium {
            color: darkseagreen;
        }

        .task-priority.high {
            color: red;
        }
        
        a{
            color:green;
            font-weight:bold;
            text-decoration:none;
        }
        .edit-btn {
            color: #4da3ff;
            text-decoration: none;
            font-weight:bold ;
        }

        .delete-btn {
            color: #b80505ff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .add-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #ff5c5c;
            color: white;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            font-size: 30px;
            text-align: center;
            line-height: 55px;
            text-decoration: none;
        }
    </style> 
</head>
  <script>
    function toggleDesc(id) {
        let desc = document.getElementById('desc-' + id);
        if (desc.style.display === 'none') {
            desc.style.display = 'block';
        } else {
            desc.style.display = 'none';
        }
    }
</script>
<body>
<h1>My Tasks</h1>

@foreach($tasks as $task)
<div class="task-card" onclick="toggleDesc({{ $task->id }})">
    <div class="task-icon"></div>

    <div class="task-content">
        <div class="task-header">
            <span class="task-title">{{ $task->title }}</span>

            
        </div>
        
        <div id="desc-{{ $task->id }}" class="task-desc" style="display:none;">
            {{ $task->description }}
        </div>
        
        <div class="task-date">
            {{ $task->created_at->format('d M Y') }} ·
            <span class="{{ $task->status ? 'completed' : 'pending' }}">
                {{ $task->status ? 'Completed' : 'Pending' }}
            </span>
        </div>
    </div>

    <div class="task-actions" onclick="event.stopPropagation();">
    @if(!$task->status)
        <span class="task-priority {{ $task->priority }}">
            Priority:{{ ucfirst($task->priority) }}
        </span>
    @endif

    
    @if(!$task->status)
    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <a href="#"
           onclick="event.preventDefault(); this.closest('form').submit();">Complete</a>
    </form>
    @endif


    <a href="{{ route('tasks.edit', $task->id) }}" class="edit-btn">Edit</a>

    <a href="#" class="delete-btn"
        onclick="event.preventDefault();
        document.getElementById('delete-{{ $task->id }}').submit();">Delete</a>

    <form id="delete-{{ $task->id }}"
        action="{{ route('tasks.destroy', $task->id) }}"
        method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    </div>
</div>

@endforeach

<a href="{{ route('tasks.create') }}" class="add-btn">+</a>

</body>
</html>