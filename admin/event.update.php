<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include '../config.php';
    include '../includes/db.php';
    include '../includes/event.php';
    $eventModel = new Event($db);
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'];
        $event = $eventModel->get($id);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? trim($_POST['id']) : null;
        $title = isset($_POST['title']) ? trim($_POST['title']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;
        $datetime = isset($_POST['datetime']) ? trim($_POST['datetime']) : null;
        $location = isset($_POST['location']) ? trim($_POST['location']) : null;
        $lifecycle = isset($_POST['lifecycle']) ? trim($_POST['lifecycle']) : null;
        $link = isset($_POST['link']) ? trim($_POST['link']) : null;
        $image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : null;
        $image = $image_url;

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            include '../includes/create-file.php';
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $image = createFilePath('events/', $file, $allowedTypes);
        }
        if (!empty($title) || !empty($description) || !empty($datetime) || !empty($location) || !empty($image) || !empty($lifecycle)) {
            if(empty($link) && $lifecycle == 'live'){
                die();
            }
            $eventDateTime = DateTime::createFromFormat('Y-m-d\TH:i', $datetime);
            if ($eventDateTime) {
                $formattedDate = $eventDateTime->format('Y-m-d H:i:s');
            }
            try {
                $eventModel->update($id, $title, $description, $location, $formattedDate, $image, $link, $lifecycle);
                header('Location: ./dashboard.php');
            } catch (Exception $e) {
                die();
            }
        }
        
    }
} else {
    header('Location: ./login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="./admin.css">
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
</head>
<body>
<form action="event.update.php" method="post" enctype="multipart/form-data" class='event-form'>
    <?php if ($event['image_url']): ?>
        <img src="<?php echo htmlspecialchars($event['image_url'])  ?>" alt="" width="50px">
        <input type="text" name="image_url" value="<?php echo $event['image_url'] ?>" hidden>
    <?php endif; ?>
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($event['title'])  ?>">
    <input type="text" name="description" placeholder="Description" value="<?php echo htmlspecialchars($event['description'])  ?>">
    <input type="text" name="location" placeholder="Location" value="<?php echo htmlspecialchars($event['location'])  ?>">
    <input type="datetime-local" name="datetime" id="" value="<?php echo htmlspecialchars($event['datetime'])  ?>">
    <input type="text" value="<?php echo htmlspecialchars($event['link'])  ?>" name="link">
    <input type="file"  name="image" >
    <select name="lifecycle" id="" aria-placeholder="Select Lifecycle" required>
        <option value="">Select Lifefcycle</option>
         <option value="upcoming">Upcoming</option>
         <option value="live">Live</option>
         <option value="ended">Ended</option>
    </select>
    <input type="submit" value="Save">
</form>
</body>
</html>