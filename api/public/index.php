<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <title>Meting · 多平台音乐服务</title>
    <link rel="stylesheet" href="https://unpkg.com/aplayer/dist/APlayer.min.css">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        :root{
            --bg-0:#0a0a0f;--bg-1:#111118;--bg-2:#171722;
            --bg-card:rgba(255,255,255,.04);--bg-card-hover:rgba(255,255,255,.07);
            --border:rgba(255,255,255,.06);
            --text:#fff;--text-2:rgba(255,255,255,.7);--text-3:rgba(255,255,255,.45);--text-4:rgba(255,255,255,.28);
            --accent:#e94560;--accent-2:#ff6b9d;--accent-glow:rgba(233,69,96,.35);
            --radius-1:6px;--radius-2:10px;--radius-3:16px;--radius-full:999px;
            --transition:.25s cubic-bezier(.4,0,.2,1);
        }
        html{scroll-behavior:smooth}
        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','PingFang SC','Hiragino Sans GB','Microsoft YaHei',sans-serif;
            background:var(--bg-0);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased;
            overflow-x:hidden;padding-bottom:40px;
        }
        body::before{
            content:'';position:fixed;inset:0;z-index:-2;pointer-events:none;
            background:
                radial-gradient(ellipse 80% 50% at 20% -10%,rgba(233,69,96,.18),transparent 60%),
                radial-gradient(ellipse 60% 40% at 100% 0%,rgba(99,102,241,.15),transparent 60%),
                radial-gradient(ellipse 50% 50% at 50% 100%,rgba(139,92,246,.12),transparent 60%),
                linear-gradient(180deg,var(--bg-0) 0%,var(--bg-1) 100%);
        }

        /* ===== Nav ===== */
        .nav{position:sticky;top:0;z-index:100;backdrop-filter:blur(20px) saturate(160%);background:rgba(10,10,15,.7);border-bottom:1px solid var(--border)}
        .nav-inner{max-width:1200px;margin:0 auto;padding:14px 24px;display:flex;align-items:center;justify-content:space-between}
        .nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none;color:#fff;font-weight:800;font-size:18px}
        .nav-logo-icon{width:32px;height:32px;border-radius:var(--radius-1);background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 4px 14px var(--accent-glow)}
        .nav-logo span{background:linear-gradient(135deg,#fff,#c4c4d4);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
        .nav-right{display:flex;align-items:center;gap:10px}
        .nav-link{padding:8px 16px;border-radius:var(--radius-full);color:var(--text-2);text-decoration:none;font-size:13px;font-weight:500;transition:var(--transition)}
        .nav-link:hover{color:#fff;background:rgba(255,255,255,.06)}

        .container{max-width:1200px;margin:0 auto;padding:0 24px}

        /* ===== Hero ===== */
        .hero{padding:40px 0 24px}
        .hero-inner{display:grid;grid-template-columns:minmax(0,1fr) 1fr;gap:32px;align-items:center}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:var(--radius-full);background:rgba(255,255,255,.05);border:1px solid var(--border);font-size:11px;font-weight:600;color:var(--text-2);margin-bottom:18px;letter-spacing:1px;text-transform:uppercase}
        .hero-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}
        .hero h1{font-size:clamp(30px,4.5vw,52px);font-weight:800;line-height:1.05;letter-spacing:-1.5px;margin-bottom:14px;background:linear-gradient(135deg,#fff 0%,#c4c4d4 50%,var(--accent-2) 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
        .hero-desc{font-size:14px;color:var(--text-2);line-height:1.7;margin-bottom:22px;max-width:460px}
        .hero-meta{display:flex;gap:22px}
        .hero-meta-num{font-size:18px;font-weight:800;color:#fff;letter-spacing:-.5px}
        .hero-meta-label{font-size:11px;color:var(--text-3);font-weight:500;margin-top:2px;letter-spacing:.5px}

        /* Hero Player Card */
        .hero-player{
            position:relative;border-radius:var(--radius-3);overflow:hidden;
            background:rgba(255,255,255,.03);border:1px solid var(--border);
            backdrop-filter:blur(10px);
            box-shadow:0 20px 60px rgba(0,0,0,.4),0 0 60px rgba(233,69,96,.1);
        }
        .hero-player-head{
            display:flex;align-items:center;gap:14px;padding:18px 20px;border-bottom:1px solid var(--border);
        }
        .hero-player-cover{
            width:56px;height:56px;border-radius:var(--radius-2);overflow:hidden;flex-shrink:0;
            box-shadow:0 4px 14px rgba(0,0,0,.4);
        }
        .hero-player-cover img{width:100%;height:100%;object-fit:cover;display:block}
        .hero-player-meta{flex:1;min-width:0}
        .hero-player-label{font-size:10px;font-weight:700;color:var(--accent-2);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:4px}
        .hero-player-title{font-size:15px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .hero-player-sub{font-size:11px;color:var(--text-3);margin-top:2px}
        .player-host{padding:4px}

        /* ===== Player area ===== */
        .player-section{padding:16px 0}

        /* ===== Section ===== */
        .section{padding:16px 0}
        .section-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:20px}
        .section-title{font-size:18px;font-weight:800;letter-spacing:-.5px;display:flex;align-items:center;gap:10px}
        .section-title::before{content:'';width:4px;height:18px;border-radius:2px;background:linear-gradient(180deg,var(--accent),var(--accent-2))}
        .section-sub{font-size:12px;color:var(--text-3);margin-top:4px}

        /* ===== Playlist Grid ===== */
        .grid{display:grid;gap:16px;grid-template-columns:repeat(auto-fill,minmax(160px,1fr))}
        .card{
            position:relative;border-radius:var(--radius-2);overflow:hidden;
            background:var(--bg-card);border:1px solid var(--border);
            cursor:pointer;transition:var(--transition);
            animation:fadeUp .5s ease both;
        }
        .card:hover{background:var(--bg-card-hover);transform:translateY(-4px);border-color:rgba(255,255,255,.15)}
        .card.active{border-color:var(--accent);box-shadow:0 0 0 2px var(--accent-glow),0 8px 28px rgba(0,0,0,.3)}
        .card-cover{position:relative;aspect-ratio:1;overflow:hidden}
        .card-cover img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s ease}
        .card:hover .card-cover img{transform:scale(1.08)}
        .card-play{
            position:absolute;right:10px;bottom:10px;width:38px;height:38px;border-radius:50%;
            background:linear-gradient(135deg,var(--accent),var(--accent-2));
            display:flex;align-items:center;justify-content:center;
            opacity:0;transform:translateY(8px) scale(.9);transition:var(--transition);
            box-shadow:0 4px 16px var(--accent-glow);
        }
        .card:hover .card-play{opacity:1;transform:translateY(0) scale(1)}
        .card.active .card-play{opacity:1;transform:scale(1);background:#22c55e;box-shadow:0 4px 16px rgba(34,197,94,.4)}
        .card.active .card-play::after{content:'✓';color:#fff;font-size:14px;font-weight:700}
        .card-body{padding:11px 13px 14px}
        .card-title{font-size:13px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:3px}
        .card-sub{font-size:11px;color:var(--text-3);font-weight:500}
        .card-badge{position:absolute;top:10px;left:10px;padding:3px 8px;border-radius:var(--radius-full);font-size:10px;font-weight:700;letter-spacing:.5px;backdrop-filter:blur(10px)}
        .card-badge.netease{background:rgba(180,120,255,.85);color:#fff}
        .card-badge.tencent{background:rgba(255,160,50,.85);color:#fff}

        /* ===== Custom Loader ===== */
        .loader-card{
            background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:var(--radius-3);padding:20px;margin-bottom:16px;
            display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;
        }
        .loader-group label{display:block;font-size:11px;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px}
        .loader-group{flex:1;min-width:120px}
        .loader-group.id{flex:2;min-width:200px}
        .loader-group select,.loader-group input{
            width:100%;padding:10px 14px;border-radius:var(--radius-2);border:1px solid var(--border);
            background:rgba(255,255,255,.04);color:#fff;font-size:13px;font-family:inherit;transition:var(--transition);
            appearance:none;
            background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat:no-repeat;background-position:right 12px center;background-size:14px;
        }
        .loader-group input{background-image:none}
        .loader-group select:focus,.loader-group input:focus{outline:none;border-color:var(--accent);background-color:rgba(255,255,255,.06);box-shadow:0 0 0 3px var(--accent-glow)}
        .loader-btn{
            padding:10px 22px;border:none;border-radius:var(--radius-full);
            background:linear-gradient(135deg,var(--accent),var(--accent-2));color:#fff;
            font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;white-space:nowrap;
            transition:var(--transition);box-shadow:0 4px 18px var(--accent-glow);
        }
        .loader-btn:hover{transform:translateY(-1px);box-shadow:0 6px 24px var(--accent-glow)}
        .loader-btn:active{transform:scale(.97)}

        /* ===== Footer ===== */
        .site-footer{padding:40px 0 24px;text-align:center;border-top:1px solid var(--border);margin-top:32px}
        .site-footer p{font-size:12px;color:var(--text-3)}
        .site-footer a{color:var(--text-2);text-decoration:none;font-weight:500}
        .site-footer a:hover{color:var(--accent-2)}

        /* ===== APlayer Dark Theme Overrides ===== */
        .aplayer{background:transparent !important;color:#fff !important}
        .aplayer .aplayer-info .aplayer-music .aplayer-title{color:#fff !important}
        .aplayer .aplayer-info .aplayer-music .aplayer-artist{color:var(--text-3) !important}
        .aplayer .aplayer-info .aplayer-controller .aplayer-time{color:var(--text-3) !important}
        .aplayer .aplayer-info .aplayer-controller .aplayer-time .aplayer-icon path{fill:var(--text-3) !important}
        .aplayer .aplayer-icon path{fill:#fff !important}
        .aplayer .aplayer-list ol li{background:rgba(255,255,255,.02) !important;border-color:var(--border) !important;color:var(--text-2) !important}
        .aplayer .aplayer-list ol li:hover{background:rgba(255,255,255,.06) !important}
        .aplayer .aplayer-list ol li.aplayer-list-light{background:var(--accent-glow) !important;color:#fff !important}
        .aplayer .aplayer-list ol li .aplayer-list-index{color:var(--text-3) !important}
        .aplayer .aplayer-list ol li.aplayer-list-light .aplayer-list-index{color:var(--accent-2) !important}
        .aplayer-list{border-top:1px solid var(--border) !important;border-bottom:none !important}
        .aplayer .aplayer-info{border-top:1px solid var(--border) !important}
        .aplayer-bar-wrap .aplayer-bar{background:rgba(255,255,255,.1) !important}
        .aplayer-bar-wrap .aplayer-bar .aplayer-loaded{background:rgba(255,255,255,.25) !important}
        .aplayer-bar-wrap .aplayer-bar .aplayer-played{background:linear-gradient(90deg,var(--accent),var(--accent-2)) !important}
        .aplayer .aplayer-icon:hover path{fill:var(--accent-2) !important}
        .aplayer .aplayer-volume-wrap .aplayer-volume-bar-wrap .aplayer-volume-bar{background:linear-gradient(90deg,var(--accent),var(--accent-2)) !important}

        @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}

        @media(max-width:900px){
            .hero-inner{grid-template-columns:1fr;gap:24px}
            .hero h1{font-size:34px}
            .nav-links{display:none}
        }
        @media(max-width:560px){
            .container{padding:0 16px}
            .hero{padding:28px 0 16px}
            .hero h1{font-size:26px;letter-spacing:-1px}
            .hero-meta{gap:16px}
            .hero-player-head{padding:14px}
            .hero-player-cover{width:48px;height:48px}
            .grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px}
            .card-body{padding:9px 11px 12px}
            .loader-card{flex-direction:column;align-items:stretch}
            .loader-btn{width:100%}
            .nav-inner{padding:12px 16px}
        }
    </style>
</head>
<body>

<nav class="nav">
    <div class="nav-inner">
        <a href="#" class="nav-logo">
            <div class="nav-logo-icon">🎵</div>
            <span>Meting</span>
        </a>
        <div class="nav-right">
            <a href="#playlists" class="nav-link">歌单</a>
            <a href="#api" class="nav-link">API</a>
        </div>
    </div>
</nav>

<div class="container">

    <!-- Hero + Player -->
    <section class="hero">
        <div class="hero-inner">
            <div>
                <div class="hero-badge"><span class="hero-badge-dot"></span>多平台音乐 · 网易云 / QQ音乐</div>
                <h1>让好音乐<br>触手可及</h1>
                <p class="hero-desc">一个简洁优雅的跨平台音乐 API，支持歌单、单曲、歌词、封面获取。精选歌单已内置，点击即播。</p>
                <div class="hero-meta">
                    <div><div class="hero-meta-num" id="nowTime">--</div><div class="hero-meta-label">当前时间</div></div>
                    <div><div class="hero-meta-num">2.0</div><div class="hero-meta-label">API 版本</div></div>
                    <div><div class="hero-meta-num"><?php echo PHP_VERSION; ?></div><div class="hero-meta-label">PHP</div></div>
                </div>
            </div>

            <!-- Player Card -->
            <div class="hero-player">
                <div class="hero-player-head">
                    <div class="hero-player-cover"><img src="<?php echo API_URI; ?>?server=netease&type=pic&id=2100968507" id="curCover" alt=""></div>
                    <div class="hero-player-meta">
                        <div class="hero-player-label" id="curLabel">NETEASE · PLAYLIST</div>
                        <div class="hero-player-title" id="curTitle">云音乐飙升榜</div>
                        <div class="hero-player-sub" id="curSub">点击下方歌单卡片切换播放</div>
                    </div>
                </div>
                <div class="player-host" id="playerHost">
                    <meting-js server="netease" type="playlist" id="2619366284"></meting-js>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Loader -->
    <div class="loader-card">
        <div class="loader-group">
            <label>数据源</label>
            <select id="f-server">
                <option value="netease">netease（网易云）</option>
                <option value="tencent">tencent（QQ音乐）</option>
            </select>
        </div>
        <div class="loader-group">
            <label>类型</label>
            <select id="f-type">
                <option value="playlist">playlist（歌单）</option>
                <option value="song">song（单曲）</option>
                <option value="artist">artist（歌手）</option>
                <option value="search">search（搜索）</option>
            </select>
        </div>
        <div class="loader-group id">
            <label>ID / 关键词</label>
            <input id="f-id" type="text" placeholder="歌单ID / 歌曲ID / 关键词" value="2619366284">
        </div>
        <button class="loader-btn" onclick="loadIntoPlayer()">▶ 加载播放</button>
    </div>

    <!-- Playlists -->
    <section class="section" id="playlists">
        <div class="section-head">
            <div>
                <div class="section-title">精选歌单</div>
                <div class="section-sub">点击任意卡片在上方播放器中播放</div>
            </div>
        </div>
        <div class="grid" id="playlistGrid"></div>
    </section>

    <!-- API Section -->
    <section class="section" id="api">
        <div style="background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:var(--radius-3);padding:22px 26px">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
                <div class="section-title" style="font-size:16px">API 快速参考</div>
                <button onclick="toggleApi(this)" style="background:rgba(255,255,255,.06);border:1px solid var(--border);color:var(--text-2);padding:6px 14px;border-radius:var(--radius-full);font-size:12px;font-weight:600;cursor:pointer;font-family:inherit">展开 ▾</button>
            </div>
            <div id="apiBody" style="max-height:0;overflow:hidden;transition:max-height .4s ease">
                <div style="padding-bottom:10px">
                    <div style="margin-bottom:14px">
                        <code style="background:rgba(255,255,255,.08);color:var(--accent-2);padding:3px 10px;border-radius:var(--radius-full);font-size:11px;font-weight:700;margin-right:8px">GET</code>
                        <code style="font-family:'SF Mono',monospace;font-size:12px;color:#fff"><?php echo API_URI; ?>?server=netease&type=playlist&id=2619366284</code>
                    </div>
                    <div style="display:grid;gap:10px;font-size:12px;color:var(--text-2)">
                        <div><code style="color:var(--accent-2)">server</code> = netease / tencent</div>
                        <div><code style="color:var(--accent-2)">type</code> = song / playlist / url / pic / lrc</div>
                        <div><code style="color:var(--accent-2)">id</code> = 歌单ID / 歌曲ID</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <p>
            Powered by <a href="https://github.com/metowolf/Meting" target="_blank">Meting</a> ·
            Deployed on <a href="https://vercel.com" target="_blank">Vercel</a> ·
            <a href="https://github.com/ybming/vercel-meting-api" target="_blank">GitHub →</a>
        </p>
    </footer>
</div>

<script src="https://unpkg.com/aplayer/dist/APlayer.min.js"></script>
<script>window.meting_api = window.location.origin + '/?server=:server&type=:type&id=:id&auth=:auth&r=:r';</script>
<script src="https://unpkg.com/@xizeyoupan/meting@latest/dist/Meting.min.js"></script>
<script>
var currentAPlayer = null;
var currentCardId = null;

function destroyPlayer(){
    var host = document.getElementById('playerHost');
    host.innerHTML = '';
    // 清理可能残留的 APlayer 元素
    var list = document.querySelectorAll('.aplayer');
    list.forEach(function(el){ if(el.parentNode) el.parentNode.removeChild(el); });
    currentAPlayer = null;
}

function playInPlayer(server, type, id, opts){
    opts = opts || {};
    destroyPlayer();

    var host = document.getElementById('playerHost');
    var meting = document.createElement('meting-js');
    meting.setAttribute('server', server);
    meting.setAttribute('type', type);
    meting.setAttribute('id', id);
    if(opts.listFolded !== undefined) meting.setAttribute('list-folded', opts.listFolded);
    host.appendChild(meting);

    // 更新 Hero 信息
    var label = document.getElementById('curLabel');
    var title = document.getElementById('curTitle');
    var sub = document.getElementById('curSub');
    var cover = document.getElementById('curCover');
    var coverId = opts.coverId || id;
    label.textContent = server.toUpperCase() + ' · ' + type.toUpperCase();
    title.textContent = opts.title || (type === 'playlist' ? '歌单 ' + id : (type === 'song' ? '单曲 ' + id : '加载中'));
    sub.textContent = opts.sub || (server === 'netease' ? '网易云音乐' : 'QQ音乐');
    cover.src = '<?php echo API_URI; ?>?server=' + server + '&type=pic&id=' + coverId;

    // 卡片激活状态
    document.querySelectorAll('.card').forEach(function(c){ c.classList.remove('active'); });
    if(opts.cardId){
        var el = document.getElementById(opts.cardId);
        if(el) el.classList.add('active');
    }
    currentCardId = opts.cardId || null;
}

(function(){
    // 时间
    function updateTime(){ document.getElementById('nowTime').textContent = new Date().toLocaleTimeString('zh-CN',{hour12:false}); }
    updateTime(); setInterval(updateTime,1000);

    // 歌单数据
    var playlists = [
        {server:'netease',type:'playlist',id:'2619366284',title:'云音乐飙升榜',sub:'网易云 · 官方榜',cover_id:'2100968507'},
        {server:'netease',type:'playlist',id:'440103454',title:'私人雷达',sub:'网易云 · 每日推荐',cover_id:'2063124907'},
        {server:'netease',type:'playlist',id:'3778678',title:'欧美流行精选',sub:'网易云 · 编辑精选',cover_id:'1901371098'},
        {server:'netease',type:'playlist',id:'180106',title:'日语 ACG 精选',sub:'网易云 · 二次元',cover_id:'1883586452'},
        {server:'netease',type:'playlist',id:'21845217',title:'华语经典老歌',sub:'网易云 · 怀旧经典',cover_id:'1455080114'},
        {server:'tencent',type:'playlist',id:'9697595502',title:'QQ音乐热歌榜',sub:'QQ音乐 · 热歌速递',cover_id:'0038ZG5W3EBBG9'},
        {server:'tencent',type:'playlist',id:'7326220405',title:'QQ音乐官方歌单',sub:'QQ音乐 · 编辑推荐',cover_id:'002Rnpvi058Qdm'},
        {server:'netease',type:'playlist',id:'6907557348',title:'纯音乐 & 氛围',sub:'网易云 · 放松必备',cover_id:'2013369464'},
    ];

    var apiUri = <?php echo json_encode(API_URI); ?>;
    var grid = document.getElementById('playlistGrid');

    playlists.forEach(function(p,i){
        var coverUrl = apiUri + '?server=' + p.server + '&type=pic&id=' + p.cover_id;
        var cardId = 'card-' + i;
        var card = document.createElement('div');
        card.className = 'card';
        card.id = cardId;
        card.style.animationDelay = (i*0.05) + 's';
        card.innerHTML =
            '<div class="card-cover">' +
                '<img src="'+coverUrl+'" alt="'+p.title+'" loading="lazy">' +
                '<span class="card-badge '+p.server+'">'+(p.server==='netease'?'网易云':'QQ')+'</span>' +
                '<div class="card-play"></div>' +
            '</div>' +
            '<div class="card-body">' +
                '<div class="card-title">'+p.title+'</div>' +
                '<div class="card-sub">'+p.sub+'</div>' +
            '</div>';
        card.addEventListener('click',function(){
            playInPlayer(p.server,p.type,p.id,{title:p.title,sub:p.sub,coverId:p.cover_id,cardId:cardId});
        });
        grid.appendChild(card);
    });

    // 默认激活第一张
    setTimeout(function(){
        var firstCard = document.getElementById('card-0');
        if(firstCard) firstCard.classList.add('active');
    },1200);
})();

function loadIntoPlayer(){
    var server = document.getElementById('f-server').value;
    var type = document.getElementById('f-type').value;
    var id = document.getElementById('f-id').value.trim();
    if(!id){ alert('请输入 ID 或关键词'); return; }
    playInPlayer(server,type,id,{title:'自定义加载',sub:(server==='netease'?'网易云':'QQ音乐') + ' · ' + type,coverId:id});
}

function toggleApi(btn){
    var body = document.getElementById('apiBody');
    var open = body.classList.toggle && body.classList.toggle('open');
    // 使用 inline style 控制
    if(body.style.maxHeight && body.style.maxHeight !== '0px'){
        body.style.maxHeight = '0px';
        btn.textContent = '展开 ▾';
    } else {
        body.style.maxHeight = '400px';
        btn.textContent = '收起 ▴';
    }
}
</script>
</body>
</html>
