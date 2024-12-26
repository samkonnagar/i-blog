<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/preview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/jquery-3.js"></script>
    <script src="js/ajax.js" defer></script>
</head>

<body>
    <?php 
    session_start();
    include_once 'comp/navbar.php';
      ?>
    <main>
    <?php include_once 'comp/preview_sec.php';  ?>
    </main>

    <footer>
        <p>&copy; 2024 Our Website. All Rights Reserved.</p>
    </footer>
</body>

</html>