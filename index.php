<?php
include "php/config.php";
if (isset($_GET['u'])) {
    $u = mysqli_real_escape_string($conn, $_GET['u']);
    $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$u}'");
    if (mysqli_num_rows($sql) > 0) {
        $full_url = mysqli_fetch_assoc($sql);
        header("Location:" . $full_url['full_url']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <title>URL Shortner</title>
</head>

<body>
    <div class="wrapper">
        <form action="#">
            <input name="full-url" placeholder="Enter or paste long url" type="text" required />
            <i class="url-icon uil uil-link"></i>
            <button>Shorten</button>
        </form>

        <?php
        $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
        if (mysqli_num_rows($sql2) > 0) {;
        ?>
            <div class="statistics">
                <?php
                $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
                $res = mysqli_fetch_assoc($sql3);

                $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
                $total = 0;
                while ($count = mysqli_fetch_assoc($sql4)) {
                    $total = $count['clicks'] + $total;
                }
                ?>
                <span>Total Links: <span><?php echo end($res) ?></span> & Total Clicks: <span><?php echo $total ?></span></span>
                <a href="php/delete.php?delete=all">Clear All</a>
            </div>
            <div class="urls-area">
                <div class="title">
                    <li>Shorten URL</li>
                    <li>Original URL</li>
                    <li>Clicks</li>
                    <li>Action</li>
                </div>
                <?php
                while ($row = mysqli_fetch_assoc($sql2)) {
                ?>
                    <div class="data">
                        <li>
                            <a href="#" target="_blank">
                                <?php
                                    echo $row['shorten_url']
                                ?>
                            </a>
                        </li>
                        <li>
                            <?php
                            echo $row['full_url']
                            ?>
                        </li>
                        </li>
                        <li><?php echo $row['clicks'] ?></li>
                        <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="blur-effect">

    </div>
    <div class="popup-box">
        <div class="info-box">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum dignissimos quos explicabo perspiciatis officia atque excepturi id necessitatibus quis optio.
        </div>
        <form action="#">
            <label>Edit your shorten url</label>
            <input type="text" spellcheck="false" value="example.com/xyz">
            <i class="copy-icon uil uil-copy-alt"></i>
            <button>
                Save
            </button>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>