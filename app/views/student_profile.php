<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Student Profile'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600;1,700&family=Caveat:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --warm-fog: #DDD3C9;
            --berry-good: #ECC4C3;
            --blossom: #B97D7B;
            --meadow-mauve: #928E5E;
            --soldier-green: #575527;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--soldier-green);
            background-color: #FAF6F2;
            background-image: 
                radial-gradient(at 0% 0%, rgba(236, 196, 195, 0.45) 0px, transparent 55%),
                radial-gradient(at 100% 0%, rgba(221, 211, 201, 0.55) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 196, 195, 0.35) 0px, transparent 55%),
                radial-gradient(at 0% 100%, rgba(146, 142, 94, 0.2) 0px, transparent 50%),
                repeating-linear-gradient(45deg, rgba(185, 125, 123, 0.04) 0, rgba(185, 125, 123, 0.04) 1.5px, transparent 0, transparent 20px);
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .container {
            width: 100%;
            max-width: 920px;
        }

        .frame-outer {
            background: #FFFFFF;
            border: 3.5px dashed var(--blossom);
            outline: 6px solid rgba(236, 196, 195, 0.55);
            outline-offset: 4px;
            border-radius: 65px 30px 75px 25px / 30px 70px 25px 65px;
            padding: 16px;
            box-shadow: 
                0 25px 50px rgba(185, 125, 123, 0.15),
                0 8px 24px rgba(87, 85, 39, 0.08);
            position: relative;
        }

        .frame-inner {
            background-color: #FFFDF9;
            background-image: 
                linear-gradient(rgba(185, 125, 123, 0.16) 1px, transparent 1px),
                linear-gradient(90deg, rgba(185, 125, 123, 0.16) 1px, transparent 1px),
                radial-gradient(circle at 0% 0%, rgba(236, 196, 195, 0.5) 0%, transparent 45%),
                radial-gradient(circle at 100% 100%, rgba(221, 211, 201, 0.45) 0%, transparent 45%);
            background-size: 24px 24px, 24px 24px, 100% 100%, 100% 100%;
            border: 2px solid var(--berry-good);
            border-radius: 55px 24px 65px 20px / 24px 60px 20px 55px;
            padding: 50px 42px;
            position: relative;
            overflow: hidden;
        }

        .corner-flourish {
            position: absolute;
            width: 50px;
            height: 50px;
            stroke: var(--blossom);
            fill: none;
            stroke-width: 2.5;
            opacity: 0.85;
            pointer-events: none;
        }
        .corner-tl { top: 12px; left: 12px; }
        .corner-tr { top: 12px; right: 12px; transform: scaleX(-1); }
        .corner-bl { bottom: 12px; left: 12px; transform: scaleY(-1); }
        .corner-br { bottom: 12px; right: 12px; transform: scale(-1, -1); }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .title-main {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 42px;
            font-weight: 700;
            color: var(--soldier-green);
            text-shadow: 2px 2px 0px rgba(236, 196, 195, 0.7);
        }

        .nav-dock {
            display: inline-flex;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 999px;
            gap: 6px;
            border: 2px solid var(--warm-fog);
            box-shadow: 0 4px 14px rgba(185, 125, 123, 0.12);
        }

        .nav-dock a {
            text-decoration: none;
            color: var(--soldier-green);
            padding: 8px 22px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .nav-dock a.active, .nav-dock a:hover {
            background: linear-gradient(135deg, var(--blossom), var(--meadow-mauve));
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(185, 125, 123, 0.4);
        }

        .profile-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 26px;
        }

        .profile-sidebar {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid var(--warm-fog);
            border-radius: 35px 20px 35px 20px / 20px 35px 20px 35px;
            padding: 32px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 6px 18px rgba(87, 85, 39, 0.05);
        }

        .avatar-ring {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blossom), var(--soldier-green));
            padding: 4px;
            margin-bottom: 16px;
            box-shadow: 0 8px 18px rgba(185, 125, 123, 0.35);
        }

        .avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #FFFFFF;
            color: var(--soldier-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 800;
        }

        .student-name {
            font-size: 22px;
            font-weight: 800;
            color: var(--soldier-green);
            margin-bottom: 6px;
        }

        /* Clean Sans-Serif ID Badge */
        .student-id {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--blossom);
            background: rgba(236, 196, 195, 0.35);
            border: 1px solid var(--berry-good);
            padding: 4px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            display: inline-block;
        }

        .course-tag {
            background: var(--soldier-green);
            color: var(--berry-good);
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 999px;
            letter-spacing: 0.5px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .info-tile {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid var(--warm-fog);
            border-radius: 25px 12px 25px 12px / 12px 25px 12px 25px;
            padding: 18px 22px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(87, 85, 39, 0.03);
        }

        .info-tile:hover {
            transform: translateY(-2px);
            border-color: var(--blossom);
            box-shadow: 0 6px 18px rgba(185, 125, 123, 0.2);
        }

        .tile-full {
            grid-column: span 2;
        }

        .tile-label {
            font-family: 'Caveat', cursive;
            font-size: 22px;
            font-weight: 700;
            color: var(--blossom);
            margin-bottom: 2px;
        }

        .tile-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--soldier-green);
        }

        @media (max-width: 768px) {
            .frame-inner { padding: 32px 18px; }
            .profile-layout { grid-template-columns: 1fr; }
            .info-grid { grid-template-columns: 1fr; }
            .tile-full { grid-column: span 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="frame-outer">
        <div class="frame-inner">

            <svg class="corner-flourish corner-tl" viewBox="0 0 40 40">
                <path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" />
                <circle cx="36" cy="4" r="2.5" fill="var(--blossom)" />
            </svg>
            <svg class="corner-flourish corner-tr" viewBox="0 0 40 40">
                <path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" />
                <circle cx="36" cy="4" r="2.5" fill="var(--blossom)" />
            </svg>
            <svg class="corner-flourish corner-bl" viewBox="0 0 40 40">
                <path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" />
                <circle cx="36" cy="4" r="2.5" fill="var(--blossom)" />
            </svg>
            <svg class="corner-flourish corner-br" viewBox="0 0 40 40">
                <path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" />
                <circle cx="36" cy="4" r="2.5" fill="var(--blossom)" />
            </svg>

            <div class="profile-header">
                <h1 class="title-main">Student Profile</h1>
                <nav class="nav-dock">
                    <a href="<?= site_url(''); ?>">Home</a>
                    <a href="<?= site_url('student/profile'); ?>" class="active">Profile</a>
                    <a href="<?= site_url('users'); ?>">Users List</a>
                </nav>
            </div>

            <div class="profile-layout">
                <div class="profile-sidebar">
                    <div class="avatar-ring">
                        <div class="avatar-inner">
                            <?= strtoupper(substr($student['name'] ?? 'P', 0, 1)); ?>
                        </div>
                    </div>
                    <div class="student-name"><?= htmlspecialchars($student['name'] ?? 'Student'); ?></div>
                    <div class="student-id">ID: <?= htmlspecialchars($student['student_id'] ?? 'N/A'); ?></div>
                    <span class="course-tag"><?= htmlspecialchars($student['course'] ?? 'Student'); ?></span>
                </div>

                <div class="info-grid">
                    <div class="info-tile">
                        <div class="tile-label">Year Level</div>
                        <div class="tile-value"><?= htmlspecialchars($student['year'] ?? 'N/A'); ?></div>
                    </div>

                    <div class="info-tile">
                        <div class="tile-label">Section</div>
                        <div class="tile-value"><?= htmlspecialchars($student['section'] ?? 'N/A'); ?></div>
                    </div>

                    <div class="info-tile tile-full">
                        <div class="tile-label">Email Address</div>
                        <div class="tile-value"><?= htmlspecialchars($student['email'] ?? 'N/A'); ?></div>
                    </div>

                    <div class="info-tile tile-full">
                        <div class="tile-label">Hobbies & Passions</div>
                        <div class="tile-value"><?= htmlspecialchars($student['hobbies'] ?? 'N/A'); ?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>