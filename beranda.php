</head>

<body>
<?php session_start(); 
echo "<pre>";
// print_r($_SESSION);
echo "</pre>";

?>
<nav>
    <h1 style="font-size: large;">LOREM IPSUM DOLOR SIT AMET</h1>
    <style>
        th, td {
        border: 1px solid black;
        border-radius: 10px;
        }
    </style>
    <ul>

        <table>
            <tr>
            <th>Lorem Ipsum</th>
            <th>Lorem Ipsum</th>
            <th>Lorem Ipsum</th>
            </tr>
            <tr>
              <td>Lorem Ipsum</td>
              <td>Lorem Ipsum</td>
              <td>Lorem Ipsum</td>
            </tr>
            <tr>
              <td>Lorem Ipsum</td>
              <td>Lorem Ipsum</td>
              <td>Lorem Ipsum</td>
            </tr>
        </table>

        
        <?php if (isset($_SESSION['username'])) : ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else : ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</body>
</html>