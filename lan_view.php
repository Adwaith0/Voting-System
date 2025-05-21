<?php
session_start();
include "connection.php";
include "header_voter.php";  // Include your voter header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureVote - Election Results</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .results-card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 150px;  /* Smaller chart height */
            width: 100%;
        }
        .party-bjp { background-color: rgba(255, 69, 0, 0.7); border-color: rgba(255, 69, 0, 1); }
        .party-congress { background-color: rgba(0, 87, 184, 0.7); border-color: rgba(0, 87, 184, 1); }
        .party-aap { background-color: rgba(0, 128, 0, 0.7); border-color: rgba(0, 128, 0, 1); }
        .party-nota { background-color: rgba(128, 128, 128, 0.7); border-color: rgba(128, 128, 128, 1); }
        .party-nirdliy { background-color: rgba(148, 0, 211, 0.7); border-color: rgba(148, 0, 211, 1); }
    </style>
</head>
<body>
    <!-- Header is included from header_voter.php -->

    <main class="container my-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card results-card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Election Results</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $query = "SELECT fullname, votecount FROM languages ORDER BY votecount DESC";
                        $result = mysqli_query($con, $query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            $total_votes = 0;
                            $parties = [];
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_votes += $row['votecount'];
                                $parties[] = $row;
                            }
                            
                            if ($total_votes > 0) {
                                echo '<div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Party</th>
                                                <th class="text-end">Votes</th>
                                                <th class="text-end">Percentage</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                
                                foreach ($parties as $party) {
                                    $percentage = round(($party['votecount'] / $total_votes) * 100, 1);
                                    $progress_class = '';
                                    
                                    if ($percentage > 40) $progress_class = 'bg-success';
                                    elseif ($percentage > 20) $progress_class = 'bg-info';
                                    else $progress_class = 'bg-warning';
                                    
                                    echo '<tr>
                                        <td><strong>' . htmlspecialchars($party['fullname']) . '</strong></td>
                                        <td class="text-end">' . number_format($party['votecount']) . '</td>
                                        <td class="text-end">' . $percentage . '%</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar ' . $progress_class . '" 
                                                     style="width: ' . $percentage . '%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                
                                echo '</tbody>
                                    </table>
                                    <div class="text-end mt-3">
                                        <span class="badge bg-secondary">Total votes: ' . number_format($total_votes) . '</span>
                                    </div>
                                </div>';
                            } else {
                                echo '<div class="alert alert-info">No votes have been cast yet.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-warning">No parties found in the system.</div>';
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Smaller Chart Section -->
                <div class="card results-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Results Overview</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart-container">
                            <canvas id="resultsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const parties = <?php echo json_encode(array_column($parties, 'fullname')); ?>;
        const votes = <?php echo json_encode(array_column($parties, 'votecount')); ?>;
        
        // Party colors mapping
        const partyColors = parties.map(party => {
            if (party.includes('BJP')) return 'party-bjp';
            if (party.includes('CONGRESS')) return 'party-congress';
            if (party.includes('AAP')) return 'party-aap';
            if (party.includes('NOTA')) return 'party-nota';
            if (party.includes('NIRDLIY')) return 'party-nirdliy';
            return '';
        });

        const ctx = document.getElementById('resultsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: parties,
                datasets: [{
                    label: 'Votes',
                    data: votes,
                    backgroundColor: parties.map(party => {
                        if (party.includes('BJP')) return 'rgba(255, 69, 0, 0.7)';
                        if (party.includes('CONGRESS')) return 'rgba(0, 87, 184, 0.7)';
                        if (party.includes('AAP')) return 'rgba(0, 128, 0, 0.7)';
                        if (party.includes('NOTA')) return 'rgba(128, 128, 128, 0.7)';
                        if (party.includes('NIRDLIY')) return 'rgba(148, 0, 211, 0.7)';
                        return 'rgba(54, 162, 235, 0.7)';
                    }),
                    borderColor: parties.map(party => {
                        if (party.includes('BJP')) return 'rgba(255, 69, 0, 1)';
                        if (party.includes('CONGRESS')) return 'rgba(0, 87, 184, 1)';
                        if (party.includes('AAP')) return 'rgba(0, 128, 0, 1)';
                        if (party.includes('NOTA')) return 'rgba(128, 128, 128, 1)';
                        if (party.includes('NIRDLIY')) return 'rgba(148, 0, 211, 1)';
                        return 'rgba(54, 162, 235, 1)';
                    }),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = <?php echo $total_votes; ?>;
                                const value = context.raw;
                                const percentage = Math.round((value / total) * 100);
                                return `${value} votes (${percentage}%)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
    </script>

    <?php include "footer.php"; ?>  <!-- Include your footer -->
</body>
</html>