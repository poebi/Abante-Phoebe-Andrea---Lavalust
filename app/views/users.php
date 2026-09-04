<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Directory | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .title-group h1 {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .title-group p {
            color: #94a3b8;
            font-size: 14px;
            margin-top: 4px;
        }

        .badge-count {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(96, 165, 250, 0.3);
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
        }

        .table-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        thead {
            background: #0f172a;
            border-bottom: 1px solid #334155;
        }

        th {
            padding: 16px 20px;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.8px;
        }

        tbody tr {
            border-bottom: 1px solid #334155;
            transition: background 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(51, 65, 85, 0.4);
        }

        td {
            padding: 16px 20px;
            color: #cbd5e1;
        }

        .user-id {
            font-weight: 600;
            color: #64748b;
        }

        .user-name {
            font-weight: 600;
            color: #f8fafc;
        }

        .username-tag {
            font-family: monospace;
            background: #0f172a;
            color: #38bdf8;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            border: 1px solid #1e293b;
        }

        .email-link {
            color: #94a3b8;
            text-decoration: none;
        }

        .email-link:hover {
            color: #60a5fa;
            text-decoration: underline;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 12px;
            }
            th, td {
                padding: 12px 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="title-group">
            <h1>Users</h1>
            
        </div>
        <div class="badge-count">
            Total Users: <?= count($users); ?>
        </div>
    </div>

    <div class="table-card">
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

</body>
</html>