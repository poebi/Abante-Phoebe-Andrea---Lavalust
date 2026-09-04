<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Student Hub'; ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #554936;
            background:
                radial-gradient(circle at 10% 15%, #fff3a8 0 3%, transparent 4%),
                radial-gradient(circle at 90% 20%, #f4d9ff 0 3%, transparent 4%),
                radial-gradient(circle at 15% 85%, #dff7df 0 4%, transparent 5%),
                radial-gradient(circle at 88% 85%, #ffdce5 0 3%, transparent 4%),
                linear-gradient(135deg, #fffdf0, #fff7c9, #fffbea);
            background-attachment: fixed;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: 70px 8%;
            display: flex;
            align-items: center;
        }

        .home-card {
            position: relative;
            width: 100%;
            min-height: calc(100vh - 140px);
            padding: 40px 5%;
            overflow: hidden;
            background: transparent;
            border: none;
            box-shadow: none;
            border-radius: 0;
        }

        .home-card::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            background: #fff2a6;
            border-radius: 50%;
            top: -100px;
            right: -70px;
            opacity: 0.35;
            filter: blur(8px);
            z-index: 0;
        }

        .home-card::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: #ead7ff;
            border-radius: 50%;
            bottom: -90px;
            left: -60px;
            opacity: 0.3;
            filter: blur(10px);
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 2;
            max-width: 1100px;
            margin: auto;
        }

        .fairy-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .fairy-line span {
            display: block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #e2c354;
            box-shadow: 0 0 8px #f5df82;
        }

        .fairy-line span:nth-child(2) {
            width: 5px;
            height: 5px;
            background: #cdb4e9;
        }

        .fairy-line span:nth-child(3) {
            width: 4px;
            height: 4px;
            background: #eab8c6;
        }

        .fairy-line .line {
            width: 48px;
            height: 3px;
            border-radius: 5px;
            background: linear-gradient(to right, #d8b84c, #ead7a0);
        }

        h1 {
            margin: 0 0 12px;
            color: #92701e;
            font-size: 48px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .subtitle {
            max-width: 700px;
            margin: 0;
            color: #817765;
            font-size: 18px;
            line-height: 1.8;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 32px 0;
        }

        nav a {
            text-decoration: none;
            color: #70591d;
            background: rgba(255, 245, 200, 0.8);
            border: 1px solid #e5d184;
            padding: 12px 24px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        @media (hover: hover) {
            nav a:hover {
                background: #ffefaa;
                border-color: #d6b94d;
                transform: translateY(-2px);
                box-shadow: 0 5px 12px rgba(200, 165, 60, 0.15);
            }
        }

        nav a:active {
            background: #ffefaa;
            transform: scale(0.98);
        }

        .welcome-box {
            max-width: 850px;
            padding: 28px;
            background: linear-gradient(135deg, rgba(255, 250, 208, 0.85), rgba(255, 248, 225, 0.85));
            border: 1px solid #eee0a8;
            border-left: 4px solid #d9bb55;
            border-radius: 16px;
            backdrop-filter: blur(5px);
        }

        .welcome-box h2 {
            margin: 0 0 10px;
            color: #947323;
            font-size: 22px;
            font-weight: 600;
        }

        .welcome {
            margin: 0;
            color: #5f5545;
            font-size: 16px;
            line-height: 1.7;
        }

        @media (max-width: 650px) {
            .container {
                padding: 20px 4%;
            }
            .home-card {
                min-height: auto;
                padding: 15px 0;
                overflow: visible;
            }
            h1 {
                font-size: 32px;
            }
            .subtitle {
                font-size: 15px;
            }
            nav {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }
            nav a {
                width: 100%;
                min-height: 48px;
                font-size: 15px;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="home-card">
        <div class="content">

            <div class="fairy-line">
                <span></span>
                <span></span>
                <span></span>
                <div class="line"></div>
            </div>

            <h1><?= $title ?? 'Student Information'; ?></h1>

            <p class="subtitle">
                Small progress is still progress.
            </p>

            <nav>
                <a href="<?= site_url(''); ?>">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Profile</a>
                <a href="<?= site_url('users'); ?>">Users List</a>
            </nav>

            <div class="welcome-box">
                <h2>Welcome</h2>
                <p class="welcome">
                    <?= $message ?? 'Welcome to my personal student information page'; ?>
                </p>
            </div>

        </div>
    </div>
</div>

</body>
</html>