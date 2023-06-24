<?php

require 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="task.css">

    <!-- Web Icon-->
    <link rel="icon" type="image/png" href="images/webLogo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/9e94ea7c1c.js" crossorigin="anonymous"></script>

    <!-- Web Title -->
    <title>Task Manager</title>
</head>

<body>

<div class="modal fade" id="add_modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="add_Query.php">
            <div class="modal-header">
              <h3 class="modal-title">Add Your Task</h3>
            </div>
            <div class="modal-body">
            
            <div class="row mb-3">
                                <div class="mb-4">
                                  <input type="text" class="form-control" name="task" 	id="taskInput" placeholder="Enter a task" required/>
                                </div>
                                <div class="mb-4">
                                  <select class="form-select" id="prioritySelect" 						name="priority">
                                    <option value="">--select priority--</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <input type="date" class="form-control" id="deadlineInput" 					name="deadline" required/>
                                </div>

            </div>
            </div>
            <div style="clear:both;"></div>
            <div class="modal-footer">
              <button name="add" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Add</button>
              <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  
    <div class="main-container d-flex">

        <!-- START OF SIDEBAR-->
        <div class="sidebar" id="side_nav">
          <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
              <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">TaskGenie</span></h1>
          </div>
        
          <ul class="list-unstyled px-2">
            <li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-home"></i> Dashboard</a></li>
            <li class="active"><a href="task.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-list"></i> Tasks</a></li>
          </ul>
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2 mx-auto">
            <li class=""><a href="profile.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"> <i class="fal fa-user">
            </i> User Profile</a></li>
          </ul>
        </div>
       <!-- END OF SIDEBAR-->

        <div class="content d-flex flex-column" id="backgroundxc">
            <nav class="navbar navbar-expand-md">
                <div class="d-flex justify-content-between d-md-none d-block">
                    <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-bars"></i></button>
                    <a class="navbar-brand fs-4"><span class="bg-dark rounded px-2 py-0 text-white">TaskGenie</span></a>   
                </div> 
                <h1 class="mx-auto">Tasks</h1>
            </nav>

            
            <div class="page-content">
                <div id="addTask" style="background-color: transparent;">
                
                    <p>
                    <button class="btn btn-warning" id="modaleditt" data-toggle="modal" type="button" data-target="#add_modal">
                               <span class="glyphicon glyphicon-edit"></span>Add Task</button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                            <i class="fa fa-filter"></i> </button>
                    </p>
                    <div class="row">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <form action="" method="GET">  
                        <div class="card card-body">
                                      <!-- content categories starts -->
                           
                                      <div class="content-categories">
                            <div class="row mb-3">
                                <div class = "card-body">
                                    <h6> Filter Your View </h6>
                                    <hr>
                        
                                    
                                    <input type="checkbox" name="category[]" value="low" id="category1">
                                    <label for="category1">Low</label><br>
                                    
                                    <input type="checkbox" name="category[]" value="medium" id="category2">
                                    <label for="category2">Medium</label><br>
                                    
                                    <input type="checkbox" name="category[]" value="high" id="category3">
                                    <label for="category3">High</label><br>

                                    <input type="checkbox" name="category2[]" value="to-do" id="category1">
                                    <label for="category1">to-do</label><br>
                                    
                                    <input type="checkbox" name="category2[]" value="in-progress" id="category2">
                                    <label for="category2">in-pogress</label><br>
                                    
                                    <input type="checkbox" name="category2[]" value="completed" id="category3">
                                    <label for="category3">completed</label><br>
                                    
                                    
                            

                        </div>
                    </div>
                              <div class="col-md-4">
                              <div class="row-mb-3">
                              <div class="col-md-4">
                                <button class="btn btn-secondary w-100" id="filterOn">submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- content categories ends -->
                        </div>
                        </form>
                      </div>
                </div>
                   <!-- roowwwwww -->
                    <!-- TABLE START -->
                    <div class="container">
                      <div class="row">
                        <table>
                          <thead>
                            <tr>
                              <th id="one">Task</th>
                              <th id="two">Deadline</th>
                              <th id="three">Priority</th>
                              <th id="four">Status</th>
                              <th id="five">Edit</th>
                              <th id="six">Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
        if(isset($_GET['category']) || isset($_GET['category2']))
        {
            $categoryChecked = [];
            $categoryChecked2 = [];
            
            if(isset($_GET['category'])) {
                $categoryChecked = $_GET['category'];
            }
            
            if(isset($_GET['category2'])) {
                $categoryChecked2 = $_GET['category2'];
            }
            
            $priorityString = "'" . implode("', '", $categoryChecked) . "'";
            $priorityString2 = "'" . implode("', '", $categoryChecked2) . "'";
            $result = mysqli_query($conn, "SELECT * FROM task WHERE (priority IN ($priorityString) OR status IN ($priorityString2)) AND userid='".$_SESSION['user_id']."' ORDER BY dateline ASC");
            
                                    if(mysqli_num_rows($result)>0)
                                    {
       
                                        foreach($result as $list) {
                                            $taskID = $list['taskid'];
                                        ?>

                                            <tr>
                                            <td id='taskView'><?php echo $list["taskname"]; ?></td>
                                            <td><?php
                                            $orgDate = $list["dateline"];
                                            $newDate = date("d-m-Y", strtotime($orgDate));
                                            echo $newDate; ?></td>

                                            <td><?php echo $list["priority"]; ?></td>

                                            <td><button class="edit" id="modaleditt"data-toggle="modal" type="button"
                                            data-target="#status_modal<?php echo $list['taskid']?>">
                                            <?php echo $list["status"]; ?></button></td>
                                        
                                            
                                        
                                            
                                            <td><button class="edit" id="modaleditt"data-toggle="modal" type="button"
                                            data-target="#update_modal<?php echo $list['taskid']?>">
                                            <i class="fa-solid fa-pen-to-square"></i></button></td>

                                            <td> <a class="edit" href="delete_query.php?del_task=<?php echo $taskID?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                            
                                            </tr>
                                            <?php

                                                include 'status_modal.php';
                                                include 'update_modal.php';

                                        }
                                        
                                    }

                                    else
                                    {
                                        echo "No Task";
                                    }
                                }
                                else
                                {
                                    $result = mysqli_query($conn,"SELECT * FROM task WHERE userid='".$_SESSION['user_id']."' ORDER BY dateline ASC");

                                    if(mysqli_num_rows($result)>0)
                                    {
       
                                        foreach($result as $list) {
                                            $taskID = $list['taskid'];
                                        ?>

                                            <tr>
                                            <td id='taskView'><?php echo $list["taskname"]; ?></td>
                                            <td><?php
                                            $orgDate = $list["dateline"];
                                            $newDate = date("d-m-Y", strtotime($orgDate));
                                            echo $newDate; ?></td>

                                            <td><?php echo $list["priority"]; ?></td>

                                            <td><button class="edit" id="modaleditt"data-toggle="modal" type="button"
                                            data-target="#status_modal<?php echo $list['taskid']?>">
                                            <?php echo $list["status"]; ?></button></td>
                                        
                                            <td><button class="edit" id="modaleditt"data-toggle="modal" type="button"
                                            data-target="#update_modal<?php echo $list['taskid']?>">
                                            <i class="fa-solid fa-pen-to-square"></i></button></td>

                                            <td> <a class="edit" href="delete_query.php?del_task=<?php echo $taskID?>" role="button"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                            
                                            </tr>
                                            <?php

                                                include 'status_modal.php';
                                                include 'update_modal.php';
                                        }
                                    }

                                    else
                                    {
                                        echo "No Task";
                                    }
                                }
                                                        
    				                ?>
                          </tbody>
                          
                        </table>
                      </div>
                    </div>

                    


                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group" id="taskList"></ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <canvas id="taskProgressChart"></canvas>
                    </div>
                </div>
            </div>      

            <footer class="mt-auto"><i>
                <div class="text-center">Copyright &copy; 2023 TGNIE TaskGenie.<br>
                <a href="mailto:sakittekakST@yourlastname.com">sakittekakST@yourlastname.com<br></a>
                </div></i></footer>
        </div>


        <script>
          
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <script src="task.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>