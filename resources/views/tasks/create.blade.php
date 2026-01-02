<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Task</title>
    <style>
        body{
            background-color: linen;
        }
        .container{
            width: 400px;
            margin: 80px auto;
            background-color: #dcf0fdff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1{
            text-align: center;
            padding-bottom: 6px;
        }
        form{
            text-align: center;
        }
        label {
            font-size: 18px;
            font-weight: bold;
            margin-left: 0;
            margin-bottom: 6px;
            color: black;
        }

        input, textarea, select {
            width: 100%;          
            padding: 8px;
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #aaa;
            box-sizing: border-box;
        }

        button {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10%;
            background-color:blanchedalmond ;
        }
    </style>
</head>

<body>
    <h1>Add New Task</h1>

    @if($errors->any())
    <div style="color:red; margin-bottom:15px;">
        {{ $errors->first('title') }}
    </div>
    @endif

    <div class="container">
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <label>Title</label>
        <input type="text" name="title"><br><br>

        <label>Description</label>
        <textarea name="description"></textarea><br><br>

        <label>Priority</label>
        <select name="priority">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select><br><br>

        <button type="submit">Save Task</button>
    </form>
    </div>
</body>
</html>