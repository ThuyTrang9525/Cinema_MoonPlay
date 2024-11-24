<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Reset CSS */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  display: flex;
  background-color: #f8f9fa;
}

/* Sidebar */
.sidebar {
  width: 250px;
  background: #343a40;
  color: #fff;
  display: flex;
  flex-direction: column;
  padding: 20px;
}

.sidebar .logo {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 20px;
}

.sidebar .user {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.sidebar .user img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.sidebar .menu ul {
  list-style: none;
}

.sidebar .menu li {
  margin: 10px 0;
}

.sidebar .menu a {
  color: #fff;
  text-decoration: none;
}

/* Main Content */
.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.header {
  background: #fff;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ddd;
}

.header input {
  width: 300px;
  padding: 5px;
}

.header-icons a {
  margin: 0 10px;
}

.dashboard {
  padding: 20px;
}

.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cards {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin: 20px 0;
}

.card {
  background: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  text-align: center;
}

.charts {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.chart {
  background: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
}

    </style>
</head>
<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <aside class="bg-dark text-white p-3" id="sidebar">
      <div class="d-flex align-items-center mb-4">
        <img src="user-avatar.jpg" alt="User Avatar" class="rounded-circle me-3" width="50">
        <div>
          <h6>Charles Hall</h6>
          <p class="small mb-0">Designer</p>
        </div>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><i class="fas fa-chart-line me-2"></i> Dashboards</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><i class="fas fa-user me-2"></i> Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><i class="fas fa-table me-2"></i> Tables</a>
        </li>
      </ul>
    </aside>

    <!-- Page Content -->
    <div class="flex-grow-1">
      <!-- Header -->
      <header class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
        <div>
          <input type="text" class="form-control" placeholder="Search...">
        </div>
        <div class="d-flex align-items-center">
          <a href="#" class="text-dark me-3"><i class="fas fa-bell"></i></a>
          <a href="#" class="text-dark me-3"><i class="fas fa-cog"></i></a>
          <img src="user-avatar.jpg" alt="User Avatar" class="rounded-circle" width="40">
        </div>
      </header>

      <!-- Dashboard Content -->
      <main class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Analytics Dashboard</h2>
          <button class="btn btn-primary">New Project</button>
        </div>

        <!-- Cards Section -->
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Sales</h5>
              <p>2,382</p>
              <small class="text-danger"><i class="fas fa-arrow-down"></i> -3.65% Since last week</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Earnings</h5>
              <p>$21,300</p>
              <small class="text-success"><i class="fas fa-arrow-up"></i> +6.65% Since last week</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Visitors</h5>
              <p>14,212</p>
              <small class="text-success"><i class="fas fa-arrow-up"></i> +5.25% Since last week</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Orders</h5>
              <p>64</p>
              <small class="text-danger"><i class="fas fa-arrow-down"></i> -2.25% Since last week</small>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
          <div class="col-md-6">
            <div class="card p-3">
              <h5>Recent Movement</h5>
              <canvas id="lineChart"></canvas>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card p-3">
              <h5>Browser Usage</h5>
              <canvas id="pieChart"></canvas>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script >
    // Line Chart
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Revenue',
            data: [1000, 2000, 1500, 3000, 2500, 4000, 3500, 4500, 4000, 5000, 6000, 7000],
            borderColor: 'blue',
            fill: false
        }]
    }
});

// Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Chrome', 'Firefox', 'Edge', 'Safari'],
        datasets: [{
            data: [4306, 3801, 1200, 800],
            backgroundColor: ['#4285F4', '#FF5733', '#2ECC71', '#FFC300']
        }]
    }
});

  </script>
</body>
</html>
