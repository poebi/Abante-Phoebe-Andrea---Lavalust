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
                radial-gradient(circle at 8% 15%, #fff3a8 0 3%, transparent 4%),
                radial-gradient(circle at 92% 18%, #ead7ff 0 3%, transparent 4%),
                radial-gradient(circle at 12% 88%, #dff7df 0 4%, transparent 5%),
                radial-gradient(circle at 90% 85%, #ffdce5 0 3%, transparent 4%),
                linear-gradient(135deg, #fffdf0, #fff7c9, #fffbea);

            background-attachment: fixed;
        }

        /* Full-screen layout */
        .container {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: 70px 8%;
            display: flex;
            align-items: center;
        }

        /* No large frame */
        .profile-card {
            position: relative;
            width: 100%;
            min-height: calc(100vh - 140px);
            padding: 40px 5%;
            overflow: hidden;

            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        /* Decorative yellow circle */
        .profile-card::before {
            content: "";
            position: absolute;

            width: 260px;
            height: 260px;

            top: -100px;
            right: -70px;

            background: #fff2a6;
            border-radius: 50%;

            opacity: 0.35;
            filter: blur(8px);

            z-index: 0;
        }

        /* Decorative purple circle */
        .profile-card::after {
            content: "";
            position: absolute;

            width: 200px;
            height: 200px;

            bottom: -90px;
            left: -60px;

            background: #ead7ff;
            border-radius: 50%;

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

        /* Fairy decoration */
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

        /* Heading */
        h1 {
            margin: 0 0 10px;

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

        /* Navigation */
        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;

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
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;

            transition: all 0.25s ease;
        }

        @media (hover: hover) {
            nav a:hover {
                background: #ffefaa;

                border-color: #d6b94d;

                transform: translateY(-2px);

                box-shadow:
                    0 5px 12px rgba(200, 165, 60, 0.15);
            }
        }

        nav a:active {
            background: #ffefaa;
            transform: scale(0.98);
        }

        /* Student information */
        .info {
            max-width: 950px;

            margin-top: 30px;

            border-top: 1px solid #eadfb7;

            background: rgba(255, 255, 255, 0.35);

            border-radius: 16px;

            overflow: hidden;

            backdrop-filter: blur(5px);
        }

        .row {
            display: flex;
            align-items: center;

            padding: 18px 22px;

            border-bottom: 1px solid #eee9d8;

            transition: background 0.2s ease;
        }

        .row:hover {
            background: rgba(255, 250, 218, 0.55);
        }

        .row:nth-child(2n) {
            background: rgba(255, 250, 218, 0.25);
        }

        .row:nth-child(2n):hover {
            background: rgba(255, 250, 218, 0.55);
        }

        .label {
            width: 180px;

            color: #92701e;

            font-size: 14px;
            font-weight: 600;
        }

        .value {
            flex: 1;

            color: #5d5446;

            font-size: 15px;

            line-height: 1.6;
        }

        /* Protected information message */
        .protected {
            max-width: 950px;

            margin-top: 28px;

            padding: 17px 20px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 249, 217, 0.85),
                    rgba(255, 251, 234, 0.85)
                );

            border: 1px solid #eee0a8;

            border-left: 4px solid #d9bb55;

            border-radius: 14px;

            color: #756541;

            font-size: 14px;

            line-height: 1.6;

            backdrop-filter: blur(5px);
        }

        /* Footer */
        .footer {
            margin-top: 32px;

            text-align: center;

            color: #aaa087;

            font-size: 13px;
        }

        /* Mobile */
        @media (max-width: 650px) {

            .container {
                padding: 20px 4%;
            }

            .profile-card {
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

            .row {
                display: block;

                padding: 16px 18px;
            }

            .label {
                width: 100%;

                margin-bottom: 6px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="profile-card">

        <div class="content">

            <div class="fairy-line">
                <span></span>
                <span></span>
                <span></span>
                <div class="line"></div>
            </div>

            <h1><?= $title; ?></h1>

            <p class="subtitle">
                A glimpse into my journey, skills, interests, and experiences as a student.
            </p>

            <nav>
                <a href="<?= site_url(''); ?>">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Profile</a>
                <a href="<?= site_url('users'); ?>">Users List</a>
            </nav>

            <div class="info">

                <div class="row">
                    <div class="label">Student ID</div>

                    <div class="value">
                        <?= $student['student_id']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Name</div>

                    <div class="value">
                        <?= $student['name']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Course</div>

                    <div class="value">
                        <?= $student['course']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Year Level</div>

                    <div class="value">
                        <?= $student['year']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Section</div>

                    <div class="value">
                        <?= $student['section']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Email</div>

                    <div class="value">
                        <?= $student['email']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label">Hobbies</div>

                    <div class="value">
                        <?= $student['hobbies']; ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>