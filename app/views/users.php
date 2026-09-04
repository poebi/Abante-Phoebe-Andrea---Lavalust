<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Users Directory'; ?></title>

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

        .users-card {
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

        .users-card::before {
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

        .users-card::after {
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

        .table-card {
            max-width: 1100px;
            margin-top: 25px;
            background: rgba(255, 255, 255, 0.45);
            border: 1px solid #eadfb7;
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(5px);
            box-shadow: 0 8px 24px rgba(200, 165, 60, 0.08);
        }

        .table-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 26px;
            background: linear-gradient(135deg, rgba(255, 250, 208, 0.85), rgba(255, 248, 225, 0.85));
            border-bottom: 1px solid #eee0a8;
        }

        .table-header-bar h2 {
            margin: 0;
            color: #947323;
            font-size: 20px;
            font-weight: 600;
        }

        .badge-count {
            background: rgba(255, 245, 200, 0.9);
            color: #70591d;
            border: 1px solid #e5d184;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        thead {
            background: rgba(255, 245, 200, 0.6);
            border-bottom: 1px solid #eee9d8;
        }

        th {
            padding: 16px 24px;
            font-weight: 600;
            color: #92701e;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.8px;
        }

        tbody tr {
            border-bottom: 1px solid #eee9d8;
            transition: background 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: rgba(255, 250, 218, 0.25);
        }

        tbody tr:hover {
            background: rgba(255, 250, 218, 0.55);
        }

        td {
            padding: 18px 24px;
            color: #5d5446;
            font-size: 15px;
        }

        .user-id {
            font-weight: 600;
            color: #92701e;
        }

        .user-name {
            font-weight: 600;
            color: #5d5446;
        }

        .username-tag {
            background: rgba(255, 245, 200, 0.8);
            color: #70591d;
            border: 1px solid #e5d184;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .email-link {
            color: #70591d;
            text-decoration: none;
            font-weight: 500;
        }

        .email-link:hover {
            color: #92701e;
            text-decoration: underline;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #817765;
            font-size: 15px;
        }

        @media (max-width: 650px) {
            .container {
                padding: 20px 4%;
            }
            .users-card {
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
            .table-header-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            th, td {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="users-card">
        <div class="content">

            <div class="fairy-line">
                <span></span>
                <span></span>
                <span></span>
                <div class="line"></div>
            </div>

            <h1>User Directory</h1>

            
        
            <nav>
                <a href="<?= site_url(''); ?>">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Profile</a>
                <a href="<?= site_url('users'); ?>">Users List</a>
            </nav>

            <div class="table-card">
                <div class="table-header-bar">
                    <h2>Registered Users</h2>
                    <div class="badge-count">
                        Total Users: <?= count($users); ?>
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
                                        <td class="user-id">#<?= htmlspecialchars($user['id']); ?></td>
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