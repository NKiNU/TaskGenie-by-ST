<?php

require 'db_conn.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  
    <!-- Required Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

    <!-- Icon CSS-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <!-- Local CSS-->
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="progress.css" />
    <link rel="stylesheet" href="calendar.css"/>


    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <!-- Web Icon-->
    <link rel="icon" type="image/png" href="images/webLogo.png">

    <!-- Web Title -->
    <title>TaskGenie</title>

</head>

<body>
<?php
// Start the session
session_start();

// Check if the login message is set in the session
if (isset($_SESSION['login_message'])) {
    $login_message = $_SESSION['login_message'];

    // Clear the login message from the session
    unset($_SESSION['login_message']);

    // Generate JavaScript code to display the alert
    echo "<script>alert('$login_message');</script>";
}


// Check if the session is active
if (isset($_SESSION['user_id'])) {
    // Session is active, continue with your code
} else {
    // Redirect to the login page
    header('Location: login.php');
    exit;
}
?>

  <?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskgenie";

$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
$query=$con->query ("SELECT
    date_list.date AS dateline,
    COALESCE(task_count.total, 0) AS total
FROM
    (
        SELECT CURDATE() - INTERVAL 1 DAY AS date
        UNION ALL
        SELECT CURDATE()
        UNION ALL
        SELECT CURDATE() + INTERVAL 1 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 2 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 3 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 4 DAY
    ) AS date_list
LEFT JOIN
    (
        SELECT
            DATE(dateline) AS date,
            COUNT(taskid) AS total
        FROM
            task
        WHERE
            userid='".$_SESSION['user_id']."'
            AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
        GROUP BY
            DATE(dateline)
    ) AS task_count ON date_list.date = task_count.date;
");


// Retrieve data from the database
      foreach($query as $data)
      {
        $date[] = $data['dateline'];
        $total[] = $data['total'];
       // $totalcomplete[]=$data['totalcomplete'];
      }    

      $querycomplete=$con->query ("SELECT
    date_list.date AS dateline,
    COALESCE(task_count.total, 0) AS totalcomplete
FROM
    (
        SELECT CURDATE() - INTERVAL 1 DAY AS date
        UNION ALL
        SELECT CURDATE()
        UNION ALL
        SELECT CURDATE() + INTERVAL 1 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 2 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 3 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 4 DAY
    ) AS date_list
LEFT JOIN
    (
        SELECT
            DATE(dateline) AS date,
            COUNT(taskname) AS total
        FROM
            task
        WHERE
            userid='".$_SESSION['user_id']."' AND status = 'completed'
            AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
        GROUP BY
            DATE(dateline)
    ) AS task_count ON date_list.date = task_count.date;


");


// Retrieve data from the database
      foreach($querycomplete as $data)
      {
        $totalcomplete[] = $data['totalcomplete'];
       // $totalcomplete[]=$data['totalcomplete'];
      }    




      $queryhigh =$con->query("SELECT
      COALESCE(SUM(total), 0) AS total_high
  FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."'
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'high'
      ) AS task_count;
      ");



      $querymed = $con->query("SELECT
      COALESCE(SUM(total), 0) AS total_med
  FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."'
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'medium'
      ) AS task_count;
      ");



      $querylow = $con->query("SELECT
      COALESCE(SUM(total), 0) AS total_low
  FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."'
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'low'
      ) AS task_count;
      ");

      //On-Going TASK

      $queryhighog =$con->query("SELECT
      COALESCE(SUM(total), 0) AS total_highog
      FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."' AND (status = 'to-do' OR status = 'in-progress')
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'high'
      ) AS task_count;
      ");



      $querymedog = $con->query("SELECT
      COALESCE(SUM(total), 0) AS total_medog
      FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."' AND (status = 'to-do' OR status = 'in-progress')
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'medium'
      ) AS task_count;
      ");



      $querylowog = $con->query("SELECT
                  COALESCE(SUM(total), 0) AS total_lowog
                  FROM
                  (
                      SELECT
                          COUNT(taskid) AS total
                      FROM
                          task
                      WHERE
                          userid='".$_SESSION['user_id']."' AND (status = 'to-do' OR status = 'in-progress')
                          AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
                          AND priority = 'low'
                  ) AS task_count;
                  ");



      
      $queryhighcomplete = $con->query("SELECT
                COALESCE(SUM(total), 0) AS total_hc
                FROM
                (
                    SELECT
                        COUNT(taskid) AS total
                    FROM
                        task
                    WHERE
                        userid='".$_SESSION['user_id']."' AND (status = 'completed')
                        AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
                        AND priority = 'high'
                ) AS task_count;");

      $querymedcomplete = $con->query("SELECT
              COALESCE(SUM(total), 0) AS total_mc
              FROM
              (
                  SELECT
                      COUNT(taskid) AS total
                  FROM
                      task
                  WHERE
                      userid='".$_SESSION['user_id']."' AND (status = 'completed')
                      AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
                      AND priority = 'medium'
              ) AS task_count;");


      $querylowcomplete = $con->query("SELECT
      COALESCE(SUM(total), 0) AS total_lc
      FROM
      (
          SELECT
              COUNT(taskid) AS total
          FROM
              task
          WHERE
              userid='".$_SESSION['user_id']."' AND (status = 'completed')
              AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
              AND priority = 'low'
      ) AS task_count;");

      //calculate the querymedcomplete/querymed?

$row = mysqli_fetch_assoc($queryhigh);
$high_priority_total = $row['total_high'];

$row = mysqli_fetch_assoc($querymed);
$medium_priority_total = $row['total_med'];

$row = mysqli_fetch_assoc($querylow);
$low_priority_total = $row['total_low'];

$row = mysqli_fetch_assoc($queryhighog);
$high_priority_to_do = $row['total_highog'];

$row = mysqli_fetch_assoc($querymedog);
$medium_priority_to_do = $row['total_medog'];

$row = mysqli_fetch_assoc($querylowog);
$low_priority_to_do = $row['total_lowog'];

$row = mysqli_fetch_assoc($queryhighcomplete);
$high_priority_completed = $row['total_hc'];

$row = mysqli_fetch_assoc($querymedcomplete);
$medium_priority_completed = $row['total_mc'];

$row = mysqli_fetch_assoc($querylowcomplete);
$low_priority_completed = $row['total_lc'];

//calculate the percentages
if ($medium_priority_to_do != 0) {
    $querymedpercent = intval(($medium_priority_completed / $medium_priority_total) * 100);
} else {
    $querymedpercent = 0;
}

if ($high_priority_to_do != 0) {
    $queryhighpercent = intval(($high_priority_completed / $high_priority_total) * 100);
} else {
    $queryhighpercent = 0;
}

if ($low_priority_to_do != 0) {
    $querylowpercent = intval(($low_priority_completed / $low_priority_total) * 100);
} else {
    $querylowpercent = 0;
}
if ($medium_priority_to_do == 0) {
  $querymedpercent = 100;
}

if ($high_priority_to_do == 0) {
  $queryhighpercent = 100;
}

if ($low_priority_to_do == 0) {
  $querylowpercent = 100;
}

?>
    <main class="d-flex">
        <!-- START OF SIDEBAR-->
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">TaskGenie</span></h1>
            </div>
          <ul class="list-unstyled px-2">
              <li class="active"><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-home"></i> Dashboard</a></li>
              <li class=""><a href="task.php " class="text-decoration-none px-3 py-2 d-block" style="margin: 1em; "><i class="fal fa-list"></i> Tasks</a></li>
          </ul>
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2">
              <li class=""><a href="profile.php" class="text-decoration-none px-3 py-2 d-block" style="margin: 1em;"><i class="fal fa-user">
              </i> User Profile</a></li>

              <li class="reminder-box" style="text-align: center;">
          <p>
            <a  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Reminder
              <span class="badge">3</span>
            </a>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <table>
                <tbody>
              <?php
              $result = mysqli_query($conn, "SELECT * FROM task WHERE dateline BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY) AND userid='".$_SESSION['user_id']."'");

            if(mysqli_num_rows($result)>0)
                                       {
       
                                        foreach($result as $list) {
                                            $taskID = $list['taskid'];
                                        ?>

                                            <tr>
                                            <td id='ReminderView'><?php echo $list["taskname"]; ?></td>
                                            <td id='ReminderDate'><?php
                                            $orgDate = $list["dateline"];
                                            $newDate = date("d-m-Y", strtotime($orgDate));
                                            echo $newDate; ?></td>
                                            <?php
                                        }
                                      }

                                      else{
                                        ?><h2>No Task</h2><?php

                                      }
                                      ?>
                                      </tbody>
              </table>
            </div>
          </div>
              
            </li>

          </ul>
        </div>
      <!-- END OF SIDEBAR-->

        <div class="content flex-column">
            <nav class="navbar navbar-expand-lg">
                <div class="d-flex justify-content-between d-md-none d-block">
                    <button class="btn px-2 py-2 open-btn me-2 ms-2"><i class="fal fa-bars"></i></button>
                    <a class="navbar-brand fs-4"><span class="bg-dark rounded px-2 py-0 text-white">TaskGenie</span></a>   
                </div> 
                <h1 class="mx-auto"> Dashboard</h1> 
            </nav>

            <!-- OVERALL TASK BY PRIORITY AND CALENDAR-->
            <div class="container-fluid text-center">
              <div class="row">
                <div class="col" style="">
                  
                    <h3>Overall Task and Completeness</h3>
                    <canvas id="myChart" style ="background: rgba( 255, 255, 255, 0.5 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 4px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );"></canvas>

                    <!-- PROGRESS CHART -->
            <div class="container-fluid text-center" id="progresschart" style= "margin-top:2em; margin-bottom:2em;" >
                <div class="row">

                  <div class="col">
                    <div class="wrapper1">
                        <div class="container1">
                          <p class="namecolumn1">High Priority</p>
                          <div class="background-circle"></div>
                          <div class="foreground-circle">
                  
                            <svg
                              xmlns="http://www.w3.org/2000/svg" version="1.1" width="85px" height="85px">
                              <circle cx="44" cy="47" r="69" stroke="#FF0000" stroke-width="15" fill="transparent" stroke-linecap="round" />
                            </svg>
                          </div>
                          <div class="text-inside-circle">
                            <p id="number-inside-circle"> <?php echo $queryhighpercent ?>  % </p>
                            <p class="remaining-text"> <?php echo $high_priority_to_do ?> task Remaining</p>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col">
                    <div class="wrapper2">
                        <div class="container1">
                          <p class="namecolumn2">Medium Priority</p>
                          <div class="background-circle"></div>
                          <div class="foreground-circle">
                            <!-- svg's width (180px) = 
                                foreground-circle's width (180px).
                              cx, cy, and r values should be half of the svg's width. -->
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              version="1.1"
                              width="85px"
                              height="85px"
                            >
                              <circle
                                cx="44"
                                cy="47"
                                r="69"
                                stroke="#FFFF00"
                                stroke-width="15"
                                fill="transparent"
                                stroke-linecap="round"
                              />
                            </svg>
                          </div>
                          <div class="text-inside-circle">
                            <p id="number-inside-circle1"><?php echo $querymedpercent ?> %</p>
                            <p class="remaining-text"> <?php echo $medium_priority_to_do ?> Task Remaining</p>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col">
                    <div class="wrapper3">
                        <div class="container1">
                          <p class="namecolumn2">Low Priority</p>
                          <div class="background-circle"></div>
                          <div class="foreground-circle">
                            <!-- svg's width (180px) = 
                                foreground-circle's width (180px).
                              cx, cy, and r values should be half of the svg's width. -->
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              version="1.1"
                              width="85px"
                              height="85px"
                            >
                              <circle
                                cx="44"
                                cy="47"
                                r="69"
                                stroke="#50c878"
                                stroke-width="15"
                                fill="transparent"
                                stroke-linecap="round"
                              />
                            </svg>
                          </div>
                          <div class="text-inside-circle">
                            <p id="number-inside-circle2"> <?php echo $querylowpercent ?> %</p>
                            <p class="remaining-text"><?php echo $low_priority_to_do ?> Task Remaining</p>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <!-- PROGRESS CHART-->


                </div>
                <div class="col">
                  <div class=" container-fluid " style ="position: relative">
                    <h3>Calendar</h3>
                    <div id="calendar"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- OVERALL TASK BY PRIORITY AND CALENDAR-->
            
            
            <hr class="my-2">
            <footer class="mb-auto"><i>
            <div class="text-center">Copyright &copy; 2023 TaskGenie To Do List<br>
            <a href="mailto:sakittekakST@yourlastname.com">yourfirstname@yourlastname.com<br></a>
            </div></i>
          </footer>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script src="calendarjs1.js"></script>
    <script src="progressjs.js"></script>
    

    <!-- CHART JS -->
    <script>
      $(document).ready(function() {
  // Define data for line chart

const ctx = document.getElementById('myChart');

// Generate date labels for the x-axis

const dateLabels = <?php echo json_encode($date); ?>;

new Chart(ctx, {
  type: 'line',
  data: {
    labels: dateLabels,
    datasets: [
      {
        label: 'Total Tasks',
        data: <?php echo json_encode($total); ?>,
        borderColor: 'blue',
        borderWidth: 1,
        fill: false,
      },
      {
        label: 'Completed Tasks',
        data: <?php echo json_encode($totalcomplete); ?>,
        borderColor: 'green',
        borderWidth: 1,
        fill: false,
      },
    ],
  },
  options: {
    scales: {
      y: {   
        precision: 1,   
        beginAtZero: true,
      },
    },
  },
});

});
  
    </script>
    <script type="text/javascript">var queryhighpercent = "<?= $queryhighpercent ?>";</script> 
    <script type="text/javascript">var querymedpercent = "<?= $querymedpercent ?>";</script>
    <script type="text/javascript">var querylowpercent = "<?= $querylowpercent ?>";</script> 
</body>
</html>
