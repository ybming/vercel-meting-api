<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <title>Meting · 多平台音乐服务</title>
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        :root{
            --bg-0:#0a0a0f;
            --bg-1:#111118;
            --bg-2:#171722;
            --bg-card:rgba(255,255,255,.04);
            --bg-card-hover:rgba(255,255,255,.07);
            --border:rgba(255,255,255,.06);
            --text:#fff;
            --text-2:rgba(255,255,255,.7);
            --text-3:rgba(255,255,255,.45);
            --text-4:rgba(255,255,255,.28);
            --accent:#e94560;
            --accent-2:#ff6b9d;
            --accent-glow:rgba(233,69,96,.35);
            --radius-1:6px;
            --radius-2:10px;
            --radius-3:16px;
            --radius-full:999px;
            --transition:.25s cubic-bezier(.4,0,.2,1);
        }
        html{scroll-behavior:smooth}
        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','PingFang SC','Hiragino Sans GB','Microsoft YaHei',sans-serif;
            background:var(--bg-0);
            color:var(--text);
            min-height:100vh;
            -webkit-font-smoothing:antialiased;
            overflow-x:hidden;
            padding-bottom:88px;
        }

        /* ===== Background Decor ===== */
        body::before{
            content:'';position:fixed;inset:0;z-index:-2;pointer-events:none;
            background:
                radial-gradient(ellipse 80% 50% at 20% -10%,rgba(233,69,96,.18),transparent 60%),
                radial-gradient(ellipse 60% 40% at 100% 0%,rgba(99,102,241,.15),transparent 60%),
                radial-gradient(ellipse 50% 50% at 50% 100%,rgba(139,92,246,.12),transparent 60%),
                linear-gradient(180deg,var(--bg-0) 0%,var(--bg-1) 100%);
        }
        body::after{
            content:'';position:fixed;inset:0;z-index:-1;pointer-events:none;
            background-image:radial-gradient(rgba(255,255,255,.025) 1px,transparent 1px);
            background-size:24px 24px;
        }

        /* ===== Navbar ===== */
        .nav{
            position:sticky;top:0;z-index:100;
            backdrop-filter:blur(20px) saturate(160%);
            -webkit-backdrop-filter:blur(20px) saturate(160%);
            background:rgba(10,10,15,.7);
            border-bottom:1px solid var(--border);
        }
        .nav-inner{
            max-width:1200px;margin:0 auto;padding:14px 24px;
            display:flex;align-items:center;justify-content:space-between;
        }
        .nav-logo{
            display:flex;align-items:center;gap:10px;
            text-decoration:none;color:#fff;font-weight:800;font-size:18px;letter-spacing:-.5px;
        }
        .nav-logo-icon{
            width:32px;height:32px;border-radius:var(--radius-1);
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            display:flex;align-items:center;justify-content:center;
            font-size:16px;
            box-shadow:0 4px 14px var(--accent-glow);
        }
        .nav-logo span{background:linear-gradient(135deg,#fff,#c4c4d4);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
        .nav-links{display:flex;gap:6px;align-items:center}
        .nav-link{
            padding:8px 16px;border-radius:var(--radius-full);
            color:var(--text-2);text-decoration:none;font-size:13px;font-weight:500;
            transition:var(--transition);
        }
        .nav-link:hover{color:#fff;background:rgba(255,255,255,.06)}
        .nav-link.primary{
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            color:#fff;font-weight:600;
        }
        .nav-link.primary:hover{transform:translateY(-1px);box-shadow:0 6px 20px var(--accent-glow)}
        .nav-toggle{display:none;background:none;border:none;color:#fff;font-size:20px;cursor:pointer}

        /* ===== Container ===== */
        .container{max-width:1200px;margin:0 auto;padding:0 24px}

        /* ===== Hero ===== */
        .hero{padding:48px 0 32px}
        .hero-inner{
            display:grid;grid-template-columns:minmax(0,1fr) 280px;gap:40px;align-items:center;
        }
        .hero-badge{
            display:inline-flex;align-items:center;gap:8px;
            padding:6px 14px;border-radius:var(--radius-full);
            background:rgba(255,255,255,.05);border:1px solid var(--border);
            font-size:11px;font-weight:600;color:var(--text-2);
            margin-bottom:20px;letter-spacing:1px;text-transform:uppercase;
        }
        .hero-badge-dot{
            width:6px;height:6px;border-radius:50%;background:var(--accent);
            box-shadow:0 0 0 3px var(--accent-glow);
        }
        .hero h1{
            font-size:clamp(32px,5vw,56px);font-weight:800;line-height:1.05;letter-spacing:-1.5px;
            margin-bottom:18px;
            background:linear-gradient(135deg,#fff 0%,#c4c4d4 50%,var(--accent-2) 100%);
            -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;
        }
        .hero-desc{
            font-size:15px;color:var(--text-2);line-height:1.7;margin-bottom:28px;max-width:480px;
        }
        .hero-actions{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
        .btn{
            display:inline-flex;align-items:center;gap:8px;
            padding:12px 24px;border-radius:var(--radius-full);
            font-size:13px;font-weight:600;font-family:inherit;
            border:none;cursor:pointer;text-decoration:none;
            transition:var(--transition);
        }
        .btn-primary{
            background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#fff;
            box-shadow:0 4px 18px var(--accent-glow);
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 28px var(--accent-glow)}
        .btn-ghost{
            background:rgba(255,255,255,.06);color:#fff;border:1px solid var(--border);
        }
        .btn-ghost:hover{background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.15)}
        .hero-meta{display:flex;gap:24px;margin-top:32px}
        .hero-meta-item{text-align:left}
        .hero-meta-num{font-size:22px;font-weight:800;color:#fff;letter-spacing:-.5px}
        .hero-meta-label{font-size:11px;color:var(--text-3);font-weight:500;margin-top:2px;letter-spacing:.5px}

        /* Hero Cover */
        .hero-cover{
            position:relative;aspect-ratio:1;
            border-radius:var(--radius-3);overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,.5),0 0 80px rgba(233,69,96,.15);
            animation:floaty 6s ease-in-out infinite;
        }
        .hero-cover img{width:100%;height:100%;object-fit:cover;display:block}
        .hero-cover-overlay{
            position:absolute;inset:0;
            background:linear-gradient(180deg,transparent 40%,rgba(0,0,0,.7) 100%);
        }
        .hero-cover-play{
            position:absolute;bottom:20px;right:20px;
            width:52px;height:52px;border-radius:50%;
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;transition:var(--transition);
            box-shadow:0 8px 24px var(--accent-glow);
        }
        .hero-cover-play:hover{transform:scale(1.1)}
        .hero-cover-play::after{
            content:'▶';color:#fff;font-size:18px;margin-left:3px;
        }
        .hero-cover-info{
            position:absolute;bottom:20px;left:20px;right:80px;color:#fff;
        }
        .hero-cover-title{font-size:14px;font-weight:700;margin-bottom:2px}
        .hero-cover-sub{font-size:11px;color:rgba(255,255,255,.7);font-weight:500}
        /* Equalizer on cover */
        .eq{
            position:absolute;top:16px;left:16px;
            display:flex;gap:2px;align-items:flex-end;
            height:20px;padding:6px 10px;border-radius:var(--radius-full);
            background:rgba(0,0,0,.5);backdrop-filter:blur(10px);
        }
        .eq span{
            width:3px;background:var(--accent-2);border-radius:2px;
            animation:eq 1s ease-in-out infinite;
        }
        .eq span:nth-child(1){height:40%;animation-delay:0s}
        .eq span:nth-child(2){height:80%;animation-delay:.15s}
        .eq span:nth-child(3){height:60%;animation-delay:.3s}
        .eq span:nth-child(4){height:100%;animation-delay:.45s}
        .eq span:nth-child(5){height:50%;animation-delay:.6s}

        /* ===== Section ===== */
        .section{padding:24px 0}
        .section-head{
            display:flex;align-items:flex-end;justify-content:space-between;
            margin-bottom:24px;
        }
        .section-title{
            font-size:20px;font-weight:800;letter-spacing:-.5px;
            display:flex;align-items:center;gap:10px;
        }
        .section-title::before{
            content:'';width:4px;height:20px;border-radius:2px;
            background:linear-gradient(180deg,var(--accent),var(--accent-2));
        }
        .section-sub{font-size:13px;color:var(--text-3);margin-top:4px}
        .section-more{
            font-size:12px;color:var(--text-3);text-decoration:none;font-weight:500;
            padding:6px 12px;border-radius:var(--radius-full);
            transition:var(--transition);
        }
        .section-more:hover{color:#fff;background:rgba(255,255,255,.06)}

        /* ===== Playlist Grid ===== */
        .grid{
            display:grid;gap:18px;
            grid-template-columns:repeat(auto-fill,minmax(170px,1fr));
        }
        .card{
            position:relative;border-radius:var(--radius-2);overflow:hidden;
            background:var(--bg-card);border:1px solid var(--border);
            cursor:pointer;transition:var(--transition);
            animation:fadeUp .5s ease both;
        }
        .card:hover{background:var(--bg-card-hover);transform:translateY(-4px);border-color:rgba(255,255,255,.12)}
        .card-cover{
            position:relative;aspect-ratio:1;overflow:hidden;
        }
        .card-cover img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s ease}
        .card:hover .card-cover img{transform:scale(1.08)}
        .card-play{
            position:absolute;right:10px;bottom:10px;
            width:40px;height:40px;border-radius:50%;
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            display:flex;align-items:center;justify-content:center;
            opacity:0;transform:translateY(8px) scale(.9);
            transition:var(--transition);
            box-shadow:0 4px 16px var(--accent-glow);
        }
        .card:hover .card-play{opacity:1;transform:translateY(0) scale(1)}
        .card-play::after{content:'▶';color:#fff;font-size:14px;margin-left:2px}
        .card-body{padding:12px 14px 16px}
        .card-title{
            font-size:13px;font-weight:600;color:#fff;
            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
            margin-bottom:4px;
        }
        .card-sub{font-size:11px;color:var(--text-3);font-weight:500}
        .card-badge{
            position:absolute;top:10px;left:10px;
            padding:3px 8px;border-radius:var(--radius-full);
            font-size:10px;font-weight:700;letter-spacing:.5px;
            backdrop-filter:blur(10px);
        }
        .card-badge.netease{background:rgba(180,120,255,.85);color:#fff}
        .card-badge.tencent{background:rgba(255,160,50,.85);color:#fff}

        /* ===== API Section ===== */
        .api-section{padding:48px 0}
        .api-card{
            background:rgba(255,255,255,.03);
            border:1px solid var(--border);
            border-radius:var(--radius-3);
            overflow:hidden;
            backdrop-filter:blur(10px);
        }
        .api-head{
            display:flex;align-items:center;justify-content:space-between;
            padding:20px 24px;border-bottom:1px solid var(--border);
        }
        .api-head-left{display:flex;align-items:center;gap:12px}
        .api-head h3{font-size:15px;font-weight:700}
        .api-toggle{
            background:none;border:none;color:var(--text-2);
            font-size:12px;font-weight:600;cursor:pointer;
            padding:6px 14px;border-radius:var(--radius-full);
            display:flex;align-items:center;gap:6px;
            transition:var(--transition);
        }
        .api-toggle:hover{background:rgba(255,255,255,.06);color:#fff}
        .api-toggle svg{transition:transform .3s ease}
        .api-toggle.open svg{transform:rotate(180deg)}
        .api-body{max-height:0;overflow:hidden;transition:max-height .4s ease}
        .api-body.open{max-height:2000px}
        .api-body-inner{padding:24px}

        .api-param-grid{display:grid;gap:16px;margin-bottom:24px}
        .api-param{
            display:flex;align-items:flex-start;gap:14px;
            padding:14px 18px;border-radius:var(--radius-2);
            background:rgba(255,255,255,.02);border:1px solid var(--border);
        }
        .api-param-name{
            font-family:'SF Mono','Fira Code',monospace;font-size:13px;font-weight:700;
            color:var(--accent-2);min-width:70px
        }
        .api-param-desc{font-size:13px;color:var(--text-2);line-height:1.6;flex:1}
        .api-param-desc code{
            background:rgba(255,255,255,.08);color:var(--accent-2);
            padding:1px 6px;border-radius:4px;font-family:inherit;font-size:12px;
        }
        .api-param-req{font-size:10px;font-weight:700;color:var(--accent);padding:2px 8px;background:rgba(233,69,96,.12);border-radius:var(--radius-full)}
        .api-param-opt{font-size:10px;font-weight:600;color:var(--text-3);padding:2px 8px;background:rgba(255,255,255,.05);border-radius:var(--radius-full)}

        .api-code{
            position:relative;background:#0d0d14;border-radius:var(--radius-2);
            border:1px solid var(--border);padding:18px 20px;margin-bottom:16px;overflow-x:auto;
        }
        .api-code-label{font-size:11px;font-weight:700;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:1px;display:flex;align-items:center;gap:8px}
        .api-code-label .dot{width:8px;height:8px;border-radius:50%;background:var(--accent)}
        .api-code pre{
            font-family:'SF Mono','Fira Code','Cascadia Code',monospace;
            font-size:13px;line-height:1.7;color:#d4d4e0;white-space:pre;
            margin:0;
        }
        .api-code pre .k{color:#c792ea}
        .api-code pre .s{color:#a5d6a7}
        .api-code pre .n{color:#f78c6c}
        .api-copy{
            position:absolute;top:14px;right:14px;
            padding:5px 12px;background:rgba(255,255,255,.06);
            border:1px solid var(--border);border-radius:var(--radius-full);
            font-size:11px;font-weight:600;color:var(--text-2);
            cursor:pointer;transition:var(--transition);font-family:inherit;
        }
        .api-copy:hover{background:rgba(255,255,255,.1);color:#fff}
        .api-copy.copied{background:#22c55e;border-color:#22c55e;color:#fff}

        /* ===== Footer ===== */
        .site-footer{
            padding:40px 0;text-align:center;
            border-top:1px solid var(--border);margin-top:40px;
        }
        .site-footer p{font-size:12px;color:var(--text-3)}
        .site-footer a{color:var(--text-2);text-decoration:none;font-weight:500}
        .site-footer a:hover{color:var(--accent-2)}

        /* ===== Mini Player Bar ===== */
        .mini-player{
            position:fixed;bottom:0;left:0;right:0;z-index:200;
            background:rgba(15,15,22,.85);
            backdrop-filter:blur(24px) saturate(160%);
            -webkit-backdrop-filter:blur(24px) saturate(160%);
            border-top:1px solid var(--border);
            transform:translateY(100%);transition:transform .4s ease;
        }
        .mini-player.show{transform:translateY(0)}
        .mini-inner{
            max-width:1200px;margin:0 auto;padding:14px 24px;
            display:flex;align-items:center;gap:16px;
        }
        .mini-cover{
            width:48px;height:48px;border-radius:var(--radius-1);overflow:hidden;flex-shrink:0;
            box-shadow:0 4px 12px rgba(0,0,0,.4);
        }
        .mini-cover img{width:100%;height:100%;object-fit:cover}
        .mini-info{flex:1;min-width:0}
        .mini-title{font-size:13px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .mini-sub{font-size:11px;color:var(--text-3);margin-top:2px}
        .mini-controls{display:flex;gap:8px;align-items:center}
        .mini-btn{
            width:40px;height:40px;border-radius:50%;
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            border:none;color:#fff;font-size:14px;cursor:pointer;
            display:flex;align-items:center;justify-content:center;
            transition:var(--transition);
            box-shadow:0 4px 14px var(--accent-glow);
        }
        .mini-btn:hover{transform:scale(1.08)}
        .mini-btn:active{transform:scale(.95)}

        /* ===== Animations ===== */
        @keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
        @keyframes eq{0%,100%{transform:scaleY(.4)}50%{transform:scaleY(1)}}

        /* ===== Responsive ===== */
        @media(max-width:900px){
            .hero-inner{grid-template-columns:1fr;gap:32px}
            .hero-cover{width:240px;margin:0 auto;animation:none}
            .hero h1{font-size:36px}
            .nav-links{display:none}
        }
        @media(max-width:560px){
            .container{padding:0 16px}
            .hero{padding:32px 0 24px}
            .hero h1{font-size:28px;letter-spacing:-1px}
            .hero-meta{gap:18px}
            .hero-meta-num{font-size:18px}
            .hero-cover{width:200px}
            .grid{grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:14px}
            .card-body{padding:10px 12px 14px}
            .hero-actions{flex-direction:column;align-items:stretch}
            .btn{justify-content:center}
            .mini-inner{padding:10px 16px;gap:12px}
            .mini-cover{width:40px;height:40px}
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="nav">
    <div class="nav-inner">
        <a href="#" class="nav-logo">
            <div class="nav-logo-icon">🎵</div>
            <span>Meting</span>
        </a>
        <div class="nav-links">
            <a href="#playlists" class="nav-link">歌单发现</a>
            <a href="#api" class="nav-link">API 文档</a>
            <a href="docs/" class="nav-link primary">在线播放 →</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <div>
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    多平台音乐 · 网易云 / QQ音乐
                </div>
                <h1>让好音乐<br>触手可及</h1>
                <p class="hero-desc">
                    一个简洁优雅的跨平台音乐 API，支持网易云与 QQ 音乐的歌单、单曲、歌词、封面获取，
                    可直接嵌入 APlayer / MetingJS 播放器，部署于 Vercel Serverless。
                </p>
                <div class="hero-actions">
                    <a href="docs/" class="btn btn-primary">▶ 立即体验</a>
                    <a href="#api" class="btn btn-ghost">📖 查看 API</a>
                </div>
                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <div class="hero-meta-num" id="nowTime">--</div>
                        <div class="hero-meta-label">当前时间</div>
                    </div>
                    <div class="hero-meta-item">
                        <div class="hero-meta-num">2.0</div>
                        <div class="hero-meta-label">API 版本</div>
                    </div>
                    <div class="hero-meta-item">
                        <div class="hero-meta-num"><?php echo PHP_VERSION; ?></div>
                        <div class="hero-meta-label">PHP Runtime</div>
                    </div>
                </div>
            </div>

            <!-- Featured Cover -->
            <div class="hero-cover">
                <img src="<?php echo API_URI; ?>?server=netease&type=pic&id=2100968507" alt="Featured">
                <div class="hero-cover-overlay"></div>
                <div class="eq"><span></span><span></span><span></span><span></span><span></span></div>
                <div class="hero-cover-info">
                    <div class="hero-cover-title">云音乐飙升榜</div>
                    <div class="hero-cover-sub">每周更新 · 热歌速递</div>
                </div>
                <div class="hero-cover-play" onclick="playFeatured()"></div>
            </div>
        </div>
    </div>
</section>

<!-- Playlists -->
<section class="section" id="playlists">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-title">精选歌单</div>
                <div class="section-sub">点击卡片即可在底部播放器中播放</div>
            </div>
            <a href="docs/" class="section-more">浏览全部 →</a>
        </div>

        <div class="grid" id="playlistGrid">
            <!-- Cards injected by JS -->
        </div>
    </div>
</section>

<!-- API Section (collapsible) -->
<section class="api-section" id="api">
    <div class="container">
        <div class="api-card">
            <div class="api-head">
                <div class="api-head-left">
                    <div class="section-title">API 接口文档</div>
                </div>
                <button class="api-toggle" onclick="toggleApi(this)">
                    展开详情
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
            <div class="api-body" id="apiBody">
                <div class="api-body-inner">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;padding:14px 18px;background:rgba(255,255,255,.02);border-radius:var(--radius-2);border:1px solid var(--border)">
                        <span style="background:#22c55e;color:#fff;padding:4px 10px;border-radius:var(--radius-full);font-size:11px;font-weight:700">GET</span>
                        <code style="font-family:'SF Mono',monospace;font-size:13px;color:#fff"><?php echo API_URI; ?></code>
                    </div>

                    <div class="section-subtitle" style="margin-bottom:14px;font-size:13px;font-weight:700;color:#fff;display:flex;align-items:center;gap:8px">📋 请求参数</div>
                    <div class="api-param-grid">
                        <div class="api-param">
                            <div class="api-param-name">server</div>
                            <div class="api-param-desc">音乐平台：<code>netease</code>（网易云）/ <code>tencent</code>（QQ音乐）</div>
                            <div class="api-param-opt">可选 · 默认 netease</div>
                        </div>
                        <div class="api-param">
                            <div class="api-param-name">type</div>
                            <div class="api-param-desc">请求类型：<code>song</code> / <code>playlist</code> / <code>url</code> / <code>pic</code> / <code>lrc</code></div>
                            <div class="api-param-req">必填</div>
                        </div>
                        <div class="api-param">
                            <div class="api-param-name">id</div>
                            <div class="api-param-desc">资源 ID（歌单 ID / 歌曲 ID 等）</div>
                            <div class="api-param-req">必填</div>
                        </div>
                    </div>

                    <div class="section-subtitle" style="margin:28px 0 14px;font-size:13px;font-weight:700;color:#fff">🔢 类型支持矩阵</div>
                    <div style="overflow-x:auto;margin-bottom:24px">
                        <table style="width:100%;border-collapse:collapse;font-size:13px;min-width:420px">
                            <thead>
                                <tr style="border-bottom:1px solid var(--border)">
                                    <th style="padding:12px 14px;text-align:left;font-size:11px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.5px">type</th>
                                    <th style="padding:12px 14px;text-align:left;font-size:11px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.5px">说明</th>
                                    <th style="padding:12px 14px;text-align:center;font-size:11px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.5px">netease</th>
                                    <th style="padding:12px 14px;text-align:center;font-size:11px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.5px">tencent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid var(--border)"><td style="padding:12px 14px"><code style="color:var(--accent-2);background:rgba(255,255,255,.06);padding:2px 8px;border-radius:4px;font-size:12px">song</code></td><td style="padding:12px 14px;color:var(--text-2)">单曲信息</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td></tr>
                                <tr style="border-bottom:1px solid var(--border)"><td style="padding:12px 14px"><code style="color:var(--accent-2);background:rgba(255,255,255,.06);padding:2px 8px;border-radius:4px;font-size:12px">playlist</code></td><td style="padding:12px 14px;color:var(--text-2)">歌单</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td></tr>
                                <tr style="border-bottom:1px solid var(--border)"><td style="padding:12px 14px"><code style="color:var(--accent-2);background:rgba(255,255,255,.06);padding:2px 8px;border-radius:4px;font-size:12px">url</code></td><td style="padding:12px 14px;color:var(--text-2)">播放链接</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td></tr>
                                <tr style="border-bottom:1px solid var(--border)"><td style="padding:12px 14px"><code style="color:var(--accent-2);background:rgba(255,255,255,.06);padding:2px 8px;border-radius:4px;font-size:12px">lrc</code></td><td style="padding:12px 14px;color:var(--text-2)">歌词</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td></tr>
                                <tr><td style="padding:12px 14px"><code style="color:var(--accent-2);background:rgba(255,255,255,.06);padding:2px 8px;border-radius:4px;font-size:12px">pic</code></td><td style="padding:12px 14px;color:var(--text-2)">封面图片</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td><td style="padding:12px 14px;text-align:center;color:#22c55e;font-weight:700">✓</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section-subtitle" style="margin:28px 0 14px;font-size:13px;font-weight:700;color:#fff">📨 请求示例</div>
                    <div class="api-code">
                        <button class="api-copy" onclick="copyCode(this)">复制</button>
                        <div class="api-code-label"><span class="dot"></span>歌单 · JSON 响应</div>
<pre><?php echo API_URI; ?>?server=netease&type=playlist&id=2619366284</pre>
                    </div>
                    <div class="api-code">
                        <button class="api-copy" onclick="copyCode(this)">复制</button>
                        <div class="api-code-label"><span class="dot"></span>单曲 · 302 重定向到音频</div>
<pre><?php echo API_URI; ?>?server=netease&type=url&id=416892104</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="site-footer">
    <p>
        Powered by <a href="https://github.com/metowolf/Meting" target="_blank">Meting</a> ·
        Deployed on <a href="https://vercel.com" target="_blank">Vercel</a> ·
        <a href="https://github.com/ybming/vercel-meting-api" target="_blank">GitHub →</a>
    </p>
</footer>

<!-- Mini Player -->
<div class="mini-player" id="miniPlayer">
    <div class="mini-inner">
        <div class="mini-cover" id="miniCover">
            <img src="<?php echo API_URI; ?>?server=netease&type=pic&id=2100968507" alt="">
        </div>
        <div class="mini-info">
            <div class="mini-title" id="miniTitle">云音乐飙升榜</div>
            <div class="mini-sub" id="miniSub">精选热门 · 点击播放</div>
        </div>
        <div class="mini-controls">
            <button class="mini-btn" onclick="openDocs()" title="打开播放器">▶</button>
        </div>
    </div>
</div>

<script>
(function(){
    // 时间更新
    function updateTime(){
        document.getElementById('nowTime').textContent = new Date().toLocaleTimeString('zh-CN',{hour12:false});
    }
    updateTime();
    setInterval(updateTime,1000);

    // 精选歌单数据
    const playlists = [
        {server:'netease',type:'playlist',id:'2619366284',title:'云音乐飙升榜',sub:'网易云 · 官方榜',cover_id:'2100968507'},
        {server:'netease',type:'playlist',id:'440103454',title:'私人雷达',sub:'网易云 · 每日推荐',cover_id:'2063124907'},
        {server:'netease',type:'playlist',id:'3778678',title:'欧美流行精选',sub:'网易云 · 编辑精选',cover_id:'1901371098'},
        {server:'netease',type:'playlist',id:'180106',title:'日语 ACG 精选',sub:'网易云 · 二次元',cover_id:'1883586452'},
        {server:'netease',type:'playlist',id:'21845217',title:'华语经典老歌',sub:'网易云 · 怀旧经典',cover_id:'1455080114'},
        {server:'tencent',type:'playlist',id:'9697595502',title:'QQ音乐热歌榜',sub:'QQ音乐 · 热歌速递',cover_id:'0038ZG5W3EBBG9'},
        {server:'tencent',type:'playlist',id:'7326220405',title:'QQ音乐官方歌单',sub:'QQ音乐 · 编辑推荐',cover_id:'002Rnpvi058Qdm'},
        {server:'netease',type:'playlist',id:'6907557348',title:'纯音乐 & 氛围',sub:'网易云 · 放松必备',cover_id:'2013369464'},
    ];

    const apiUri = <?php echo json_encode(API_URI); ?>;
    const grid = document.getElementById('playlistGrid');

    playlists.forEach((p,i)=>{
        const coverUrl = apiUri + '?server=' + p.server + '&type=pic&id=' + p.cover_id;
        const card = document.createElement('div');
        card.className = 'card';
        card.style.animationDelay = (i*0.06) + 's';
        card.innerHTML =
            '<div class="card-cover">' +
                '<img src="'+coverUrl+'" alt="'+p.title+'" loading="lazy" onerror="this.style.background=\'linear-gradient(135deg,#2a2a3a,#1a1a28)\';this.src=\'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%232a2a3a%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 text-anchor=%22middle%22 fill=%22%23555%22>🎵</text></svg>\'">' +
                '<span class="card-badge '+p.server+'">'+(p.server==='netease'?'网易云':'QQ')+'</span>' +
                '<div class="card-play"></div>' +
            '</div>' +
            '<div class="card-body">' +
                '<div class="card-title">'+p.title+'</div>' +
                '<div class="card-sub">'+p.sub+'</div>' +
            '</div>';
        card.addEventListener('click',()=>{
            showMiniPlayer(p.title,p.sub,coverUrl);
            // 打开 docs 页并带上歌单参数
            window.open('docs/?server='+p.server+'&type='+p.type+'&id='+p.id,'_blank');
        });
        grid.appendChild(card);
    });

    // 迷你播放器
    const mini = document.getElementById('miniPlayer');
    setTimeout(()=>mini.classList.add('show'),800);

    window.showMiniPlayer = function(title,sub,cover){
        document.getElementById('miniTitle').textContent = title;
        document.getElementById('miniSub').textContent = sub;
        document.querySelector('#miniCover img').src = cover;
        mini.classList.add('show');
    };

    window.openDocs = function(){ window.location.href = 'docs/'; };
    window.playFeatured = function(){ window.open('docs/?server=netease&type=playlist&id=2619366284','_blank'); };
})();

function toggleApi(btn){
    const body = document.getElementById('apiBody');
    body.classList.toggle('open');
    btn.classList.toggle('open');
    btn.querySelector('svg').style.transform = body.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0)';
    btn.childNodes[0].textContent = body.classList.contains('open') ? '收起详情' : '展开详情';
}

function copyCode(btn){
    const pre = btn.parentElement.querySelector('pre');
    navigator.clipboard.writeText(pre.textContent).then(()=>{
        btn.textContent = '已复制 ✓';
        btn.classList.add('copied');
        setTimeout(()=>{btn.textContent='复制';btn.classList.remove('copied')},1500);
    });
}
</script>
</body>
</html>
