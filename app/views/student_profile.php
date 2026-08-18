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
        }

        .container {
            width: 90%;
            max-width: 850px;
            margin: 65px auto;
        }

        .profile-card {
            position: relative;
            overflow: hidden;

            background: rgba(255, 255, 255, 0.94);
            padding: 48px;

            border-radius: 24px;
            border: 1px solid #eadb9b;

            box-shadow:
                0 15px 40px rgba(174, 145, 58, 0.12),
                0 0 30px rgba(255, 235, 140, 0.25);
        }

        .profile-card::before {
            content: "";
            position: absolute;

            width: 180px;
            height: 180px;

            top: -100px;
            right: -70px;

            background: #fff2a6;
            border-radius: 50%;

            opacity: 0.45;
            filter: blur(5px);
        }

        .profile-card::after {
            content: "";
            position: absolute;

            width: 120px;
            height: 120px;

            bottom: -70px;
            left: -50px;

            background: #ead7ff;
            border-radius: 50%;

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
            margin: 0 0 10px;

            color: #92701e;
            font-size: 36px;
            font-weight: 600;
        }

        .subtitle {
            margin: 0;

            color: #817765;
            font-size: 15px;
            line-height: 1.7;
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

            box-shadow:
                0 5px 12px rgba(200, 165, 60, 0.15);
        }

        .info {
            margin-top: 25px;
            border-top: 1px solid #eee3b9;
        }

        .row {
            display: flex;
            align-items: center;

            padding: 17px 8px;

            border-bottom: 1px solid #eee9d8;
        }

        .row:nth-child(2n) {
            background: rgba(255, 250, 218, 0.28);
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
        }

        .protected {
            margin-top: 28px;

            padding: 17px 20px;

            background:
                linear-gradient(
                    135deg,
                    #fff9d9,
                    #fffbea
                );

            border: 1px solid #eee0a8;
            border-left: 4px solid #d9bb55;

            border-radius: 14px;

            color: #756541;

            font-size: 14px;
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

            .profile-card {
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

            .row {
                display: block;
                padding: 16px 5px;
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
                Collection of my academic and personal
                information.
            </p>

            <nav>
                <a href="<?= site_url('student'); ?>">
                    Home
                </a>

                <a href="<?= site_url('student/profile'); ?>">
                Profile
                </a>
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

    </div>

</div>

</body>
</html>