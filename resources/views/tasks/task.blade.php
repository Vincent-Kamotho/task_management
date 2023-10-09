<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Create Task</title>
</head>

<body>
   
    <div class="container mt-5">
        <div class="row">
            <div>
                @if(session()->has('success'))
                   <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-3 offset-md-10 mb-4">
                <a href="#addTaskModal" class="btn btn-success" data-toggle="modal">Add Task</a>
            </div>
        </div>
        <div class="card-list" id="sortable-list">
            @foreach ($tasks->sortBy('priority') as $task)
            <div class="card mb-3" id="task-{{$task->id}}">
                <div class="card-body">
                    <p class="card-text">{{$task->priority}}</p>
                    <div class="row">
                        <div class="col-md-9">
                            <h3>{{$task->name}}</h3>
                        </div>
                        <div class="col-md-3">
                            <a href="{{url('edit/'.$task->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{url('delete/'.$task->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action = "{{route('save_task')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input type="text" name="task" class="form-control @error('task') is-invalid @enderror" value="{{ old('task') }}" placeholder="Enter task name" required="required">
                                @error('task')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="number" name="priority" class="form-control @error('priority') is-invalid @enderror" value="{{ old('priority') }}" required="required">
                                @error('priority')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        

        $("#sortable-list").sortable({
        update: function(event, ui) {
            // Get the updated order of elements
            var order = $(this).sortable("toArray");

            // Update priorities based on the new order
            for (var i = 0; i < order.length; i++) {
                var taskId = order[i].split("-")[1]; // Extract task ID from element ID
                
                // Send an AJAX request to update the priority for the task
                $.ajax({
                    type: "POST",
                    url: "{{ route('update_task_priority') }}", // Replace with your update priority route
                    data: { taskId: taskId, newPriority: i + 1 },
                    dataType: "json",
                    success: function(data) {
                        // Handle success, if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error, if needed
                    }
                });
            }
        }
    });
    $("#sortable-list").disableSelection();
    </script>
    
</body>

</html>