<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Users Directory'; ?></title>
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
            max-width: 1020px;
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

        .directory-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .title-group {
            display: flex;
            flex-direction: column;
        }

        .cursive-flair {
            font-family: 'Caveat', cursive;
            font-size: 26px;
            color: var(--blossom);
            margin-bottom: -4px;
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

        .table-card {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid var(--warm-fog);
            border-radius: 35px 20px 35px 20px / 20px 35px 20px 35px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(87, 85, 39, 0.05);
        }

        .table-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 28px;
            background: linear-gradient(135deg, var(--soldier-green), #686630);
            color: #FFFFFF;
            border-bottom: 2px solid var(--warm-fog);
        }

        .table-header-bar h2 {
            margin: 0;
            color: #FFFFFF;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .badge-count {
            background: var(--blossom);
            color: #FFFFFF;
            padding: 5px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(185, 125, 123, 0.35);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: rgba(221, 211, 201, 0.5);
            border-bottom: 2px solid var(--warm-fog);
        }

        th {
            padding: 16px 22px;
            font-weight: 800;
            color: var(--soldier-green);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.8px;
        }

        tbody tr {
            border-bottom: 1px solid rgba(221, 211, 201, 0.7);
            transition: background 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: rgba(236, 196, 195, 0.12);
        }

        tbody tr:hover {
            background: rgba(236, 196, 195, 0.35);
        }

        td {
            padding: 16px 22px;
            color: var(--soldier-green);
            font-size: 14px;
            font-weight: 600;
        }

        /* Clean Sans-Serif ID numbering pill */
        .user-id {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 800;
            color: var(--blossom);
            background: rgba(236, 196, 195, 0.4);
            border: 1px solid var(--berry-good);
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            letter-spacing: 0.3px;
        }

        .user-name {
            font-weight: 800;
            color: var(--soldier-green);
        }

        .username-tag {
            background: rgba(236, 196, 195, 0.6);
            color: var(--soldier-green);
            border: 1px solid var(--berry-good);
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .email-link {
            color: var(--blossom);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .email-link:hover {
            color: var(--soldier-green);
            text-decoration: underline;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--meadow-mauve);
            font-size: 15px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .frame-inner { padding: 32px 18px; }
            .title-main { font-size: 32px; }
            .directory-header { flex-direction: column; align-items: flex-start; }
            .nav-dock { width: 100%; justify-content: space-around; }
            .table-header-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            th, td {
                padding: 12px 14px;
            }
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

            <div class="directory-header">
                <div class="title-group">
            
                    <h1 class="title-main">Users Directory</h1>
                </div>
                <nav class="nav-dock">
                    <a href="<?= site_url(''); ?>">Home</a>
                    <a href="<?= site_url('student/profile'); ?>">Profile</a>
                    <a href="<?= site_url('users'); ?>" class="active">Users List</a>
                </nav>
            </div>

            <div class="table-card">
                <div class="table-header-bar">
                    <h2>Registered Users</h2>
                    <div class="badge-count">
                        Total: <?= count($users ?? []); ?>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><span class="user-id">#<?= htmlspecialchars($user['id']); ?></span></td>
                                        <td class="user-name"><?= htmlspecialchars($user['firstname']); ?></td>
                                        <td><?= htmlspecialchars($user['lastname']); ?></td>
                                        <td><a class="email-link" href="mailto:<?= htmlspecialchars($user['email']); ?>"><?= htmlspecialchars($user['email']); ?></a></td>
                                        <td><span class="username-tag">@<?= htmlspecialchars($user['username']); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-state">No users found in database.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>