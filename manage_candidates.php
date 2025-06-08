<?php
session_start();
include('connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}



// Add new candidate
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_candidate'])) {
    $fullname = trim($_POST['fullname']);
    $about = trim($_POST['about']);
    $position = trim($_POST['position']);

    if (!empty($fullname)) {
        $stmt = $con->prepare("INSERT INTO candidates (fullname, about, votecount, position) VALUES (?, ?, 0, ?)");
        $stmt->bind_param("sss", $fullname, $about, $position);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_candidates.php");
    }
}

// Delete candidate
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $con->prepare("DELETE FROM candidates WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_candidates.php");
}

// Update candidate
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_candidate'])) {
    $id = intval($_POST['id']);
    $fullname = trim($_POST['fullname']);
    $about = trim($_POST['about']);
    $position = trim($_POST['position']);

    if (!empty($fullname)) {
        $stmt = $con->prepare("UPDATE candidates SET fullname = ?, about = ?, position = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullname, $about, $position, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_candidates.php");
    }
}

$candidates = $con->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Candidates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body class="bg-light">
<?php include('admin_sidebar.php'); ?>
<div class="container py-5">
    <h2 class="mb-4">Manage Candidates</h2>

    <!-- Add Candidate -->
    <div class="card mb-4">
        <div class="card-header">Add New Candidate</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">About</label>
                    <textarea name="about" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input type="text" name="position" class="form-control">
                </div>
                <button type="submit" name="add_candidate" class="btn btn-primary">Add Candidate</button>
            </form>
        </div>
    </div>

    <!-- Existing Candidates Table -->
    <div class="card">
        <div class="card-header">Candidates List</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>About</th>
                        <th>Vote Count</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $candidates->fetch_assoc()): ?>
                    <tr>
                        <form method="post">
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" class="form-control">
                            </td>
                            <td>
                                <textarea name="about" class="form-control"><?php echo htmlspecialchars($row['about']); ?></textarea>
                            </td>
                            <td><input type="text" value="<?php echo $row['votecount']; ?>" class="form-control" readonly></td>
                            <td>
                                <input type="text" name="position" value="<?php echo htmlspecialchars($row['position']); ?>" class="form-control">
                            </td>
                            <td>
                                <button type="submit" name="update_candidate" class="btn btn-success btn-sm">Update</button>
                                <a href="manage_candidates.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this candidate?')">Delete</a>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
