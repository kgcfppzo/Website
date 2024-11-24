<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $title = isset($_POST['title']) ? trim($_POST['title']) : null;
        $content = isset($_POST['content']) ? trim($_POST['content']) : null;
            
        if(isset($name) && isset($title) && isset($content))
            try {
                include './includes/testimony.php';
                $testimonyModel = new Testimony($db);
                $testimonyModel->create($name, $title, $content);
                header('Location: ./success.html');
            } catch (Exception $e) {
                echo "Caught Error: " . $e->getMessage();
                header('Location: ./error_page.html');
                // die();
            }
    }
?>
