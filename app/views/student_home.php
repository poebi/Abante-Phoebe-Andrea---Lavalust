<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title; ?></title>

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
        }

        .container {
            width: 90%;
            max-width: 850px;
            margin: 65px auto;
        }

        .home-card {
            position: relative;
            overflow: hidden;

            background: rgba(255, 255, 255, 0.92);
            padding: 48px;

            border-radius: 24px;
            border: 1px solid #eadb9b;

            box-shadow:
                0 15px 40px rgba(174, 145, 58, 0.12),
                0 0 30px rgba(255, 235, 140, 0.25);
        }

        .home-card::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: #fff2a6;
            border-radius: 50%;
            top: -100px;
            right: -70px;
            opacity: 0.45;
            filter: blur(5px);
        }

        .home-card::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            background: #ead7ff;
            border-radius: 50%;
            bottom: -70px;
            left: -50px;
            opacity: 0.35;
            filter: blur(8px);
        }

        .content {
            position: relative;
            z-index: 2;
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
            background: linear-gradient(
                to right,
                #d8b84c,
                #ead7a0
            );
        }

        h1 {
            margin: 0 0 12px;
            color: #92701e;
            font-size: 38px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .subtitle {
            max-width: 650px;
            margin: 0;
            color: #817765;
            font-size: 16px;
            line-height: 1.8;
        }

        nav {
            display: flex;
            gap: 10px;
            margin: 32px 0;
        }

        nav a {
            text-decoration: none;
            color: #70591d;
            background: #fff5c8;
            border: 1px solid #e5d184;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        nav a:hover {
            background: #ffefaa;
            border-color: #d6b94d;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(200, 165, 60, 0.15);
        }

        .welcome-box {
            padding: 26px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 250, 208, 0.95),
                    rgba(255, 248, 225, 0.95)
                );

            border: 1px solid #eee0a8;
            border-left: 4px solid #d9bb55;
            border-radius: 16px;
        }

        .welcome-box h2 {
            margin: 0 0 10px;
            color: #947323;
            font-size: 20px;
            font-weight: 600;
        }

        .welcome {
            margin: 0;
            color: #5f5545;
            font-size: 16px;
            line-height: 1.7;
        }

        .description {
            margin: 12px 0 0;
            color: #827766;
            font-size: 14px;
            line-height: 1.7;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 28px;
        }

        .feature {
            padding: 22px 20px;
            background: #fffefa;
            border: 1px solid #eee5c5;
            border-radius: 15px;
            transition: 0.25s ease;
        }

        .feature:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(174, 145, 58, 0.10);
        }

        .feature::before {
            content: "";
            display: block;
            width: 30px;
            height: 3px;
            margin-bottom: 15px;
            border-radius: 5px;
            background: #d9bb55;
        }

        .feature:nth-child(2)::before {
            background: #c9b1e5;
        }

        .feature:nth-child(3)::before {
            background: #e8b8c5;
        }

        .feature h3 {
            margin: 0 0 8px;
            color: #816522;
            font-size: 16px;
            font-weight: 600;
        }

        .feature:nth-child(2) h3 {
            color: #765f8c;
        }

        .feature:nth-child(3) h3 {
            color: #956675;
        }

        .feature p {
            margin: 0;
            color: #857b6c;
            font-size: 13px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 32px;
            text-align: center;
            color: #aaa087;
            font-size: 13px;
        }

        @media (max-width: 650px) {

            .container {
                width: 94%;
                margin: 35px auto;
            }

            .home-card {
                padding: 32px 22px;
            }

            h1 {
                font-size: 30px;
            }

            nav {
                flex-direction: column;
            }

            nav a {
                text-align: center;
            }

            .features {
                grid-template-columns: 1fr;
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

            <h1><?= $title; ?></h1>

            <p class="subtitle">
                A small space that reflects my journey as a student,
                combining learning, creativity, and personal growth.
            </p>

            <nav>
                <a href="<?= site_url('student'); ?>">Home</a>

                <a href="<?= site_url('student/profile'); ?>">
                    Student Profile
                </a>
            </nav>

            <div class="welcome-box">

                <h2>Welcome</h2>

                <p class="welcome">
                    <?= $message; ?>
                </p>

                <p class="description">
                    This website demonstrates LavaLust routing,
                    controllers, views, data passing, navigation,
                    and middleware.
                </p>

            </div>

            <div class="features">

                <div class="feature">
                    <h3>Learning</h3>
                    <p>
                        Exploring web development and building
                        practical programming skills.
                    </p>
                </div>

                <div class="feature">
                    <h3>Creativity</h3>
                    <p>
                        Designing simple and meaningful digital
                        experiences.
                    </p>
                </div>

                <div class="feature">
                    <h3>Growth</h3>
                    <p>
                        Continuously improving through projects,
                        practice, and new challenges.
                    </p>
                </div>

            </div>

            <div class="footer">
                Student Information Page · LavaLust Web Application
            </div>

        </div>

    </div>

</div>

</body>
</html>