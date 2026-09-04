<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi, It's Me</title>
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

        /* Balanced, High-Exposure Airy Canvas */
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
            max-width: 860px;
        }

        /* Luminous Double-Offset Cursive Frame */
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

        /* Inner Parchment with Harmonized Soft Gridlines */
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
            padding: 56px 46px;
            position: relative;
            overflow: hidden;
        }

        /* Corner Flourishes */
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

        .palette-swatches {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
        }

        .swatch-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            box-shadow: 0 3px 6px rgba(87, 85, 39, 0.15);
        }

        .cursive-flair {
            font-family: 'Caveat', cursive;
            font-size: 28px;
            color: var(--blossom);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .hero-title-group {
            margin-bottom: 28px;
        }

        .title-sub {
            font-size: 28px;
            font-weight: 700;
            color: var(--meadow-mauve);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .title-main {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 68px;
            font-weight: 700;
            color: var(--soldier-green);
            line-height: 1.05;
            margin-top: 2px;
            text-shadow: 2px 2px 0px rgba(236, 196, 195, 0.7);
        }

        .nav-dock {
            display: inline-flex;
            background: rgba(255, 255, 255, 0.9);
            padding: 6px;
            border-radius: 999px;
            gap: 8px;
            margin-bottom: 34px;
            border: 2px solid var(--warm-fog);
            box-shadow: 0 4px 14px rgba(185, 125, 123, 0.12);
        }

        .nav-dock a {
            text-decoration: none;
            color: var(--soldier-green);
            padding: 10px 26px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .nav-dock a.active, .nav-dock a:hover {
            background: linear-gradient(135deg, var(--blossom), var(--meadow-mauve));
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(185, 125, 123, 0.4);
            transform: translateY(-2px);
        }

        .quote-panel {
            background: rgba(255, 255, 255, 0.9);
            border: 2px dashed var(--meadow-mauve);
            border-radius: 35px 15px 40px 15px / 15px 35px 15px 35px;
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: inset 0 0 14px rgba(236, 196, 195, 0.25);
        }

        .quote-icon {
            width: 50px;
            height: 50px;
            background: var(--soldier-green);
            color: var(--berry-good);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(87, 85, 39, 0.25);
        }

        .quote-body h3 {
            font-family: 'Caveat', cursive;
            font-size: 24px;
            color: var(--blossom);
            margin-bottom: 2px;
        }

        .quote-body p {
            font-size: 16px;
            font-weight: 600;
            color: var(--soldier-green);
            line-height: 1.4;
        }

        @media (max-width: 600px) {
            .frame-inner { padding: 36px 20px; }
            .title-main { font-size: 48px; }
            .nav-dock { display: flex; flex-direction: column; border-radius: 24px; }
            .nav-dock a { text-align: center; }
            .quote-panel { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="frame-outer">
        <div class="frame-inner">
            
            <!-- Corner Accents -->
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

            <div class="palette-swatches">
                <span class="swatch-dot" style="background: var(--warm-fog);"></span>
                <span class="swatch-dot" style="background: var(--berry-good);"></span>
                <span class="swatch-dot" style="background: var(--blossom);"></span>
                <span class="swatch-dot" style="background: var(--meadow-mauve);"></span>
                <span class="swatch-dot" style="background: var(--soldier-green);"></span>
            </div>

            <div class="cursive-flair">✦ Welcome to my page ✦</div>

            <div class="hero-title-group">
                <p class="title-sub">Hi, It's Me,</p>
                <h1 class="title-main"><?= $name ?? 'Phoebe!'; ?></h1>
            </div>

            <nav class="nav-dock">
                <a href="<?= site_url(''); ?>" class="active">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Profile</a>
                <a href="<?= site_url('users'); ?>">Users List</a>
            </nav>

            <div class="quote-panel">
                <div class="quote-icon">✿</div>
                <div class="quote-body">
                    <h3>Daily Reminder</h3>
                    <p><?= $message ?? 'Small progress is still progress.'; ?></p>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>