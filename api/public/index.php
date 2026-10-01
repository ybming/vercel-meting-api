<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.png">
<title>Meting · 音乐</title>
<style>
/* ============ Reset ============ */
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html,body{height:100%;overflow:hidden}
body{
    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','PingFang SC','Hiragino Sans GB','Microsoft YaHei',sans-serif;
    -webkit-font-smoothing:antialiased;
    background:#0f0f14;color:#fff;
}
a{color:inherit;text-decoration:none}
button{font-family:inherit;cursor:pointer;border:none;background:none;color:inherit}
input,select{font-family:inherit}

/* ============ Layout ============ */
.app{display:grid;grid-template-columns:220px 1fr;height:100vh}

/* ============ Sidebar ============ */
.sidebar{
    background:#171721;height:100%;
    display:flex;flex-direction:column;
    border-right:1px solid rgba(255,255,255,.04);
    flex-shrink:0;
}
.sb-logo{
    display:flex;align-items:center;gap:10px;
    padding:20px 20px 16px;
    border-bottom:1px solid rgba(255,255,255,.04);
}
.sb-logo-icon{
    width:36px;height:36px;border-radius:8px;
    background:linear-gradient(135deg,#ff6b35,#ff3366);
    display:flex;align-items:center;justify-content:center;
    font-size:18px;
    box-shadow:0 4px 14px rgba(255,51,102,.4);
}
.sb-logo-text{font-size:17px;font-weight:800;letter-spacing:-.5px}
.sb-logo-text span{background:linear-gradient(135deg,#fff,#ffb3c6);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}

.sb-menu{flex:1;padding:12px 0;overflow-y:auto}
.sb-menu::-webkit-scrollbar{width:4px}
.sb-menu::-webkit-scrollbar-thumb{background:rgba(255,255,255,.08);border-radius:2px}
.sb-group{padding:0 12px;margin-bottom:8px}
.sb-group-title{
    font-size:11px;font-weight:700;color:rgba(255,255,255,.35);
    text-transform:uppercase;letter-spacing:1.5px;padding:14px 12px 8px;
}
.sb-item{
    display:flex;align-items:center;gap:12px;
    padding:10px 12px;border-radius:8px;
    font-size:13px;font-weight:500;color:rgba(255,255,255,.7);
    cursor:pointer;transition:.2s;
}
.sb-item:hover{background:rgba(255,255,255,.05);color:#fff}
.sb-item.active{background:linear-gradient(90deg,rgba(255,51,102,.18),rgba(255,107,53,.08));color:#fff}
.sb-item.active::before{
    content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);
    width:3px;height:16px;border-radius:0 2px 2px 0;
    background:linear-gradient(180deg,#ff6b35,#ff3366);
}
.sb-item{position:relative}
.sb-item-icon{font-size:16px;width:20px;text-align:center;flex-shrink:0}

.sb-platform{
    margin-top:auto;padding:14px;border-top:1px solid rgba(255,255,255,.04);
}
.sb-platform-title{font-size:11px;font-weight:700;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px}
.sb-platform-row{display:flex;gap:8px}
.sb-platform-btn{
    flex:1;padding:10px;border-radius:8px;
    background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);
    font-size:12px;font-weight:600;color:rgba(255,255,255,.6);
    transition:.2s;
}
.sb-platform-btn:hover{background:rgba(255,255,255,.08);color:#fff}
.sb-platform-btn.active{
    background:linear-gradient(135deg,#ff6b35,#ff3366);color:#fff;border-color:transparent;
    box-shadow:0 4px 14px rgba(255,51,102,.3);
}

/* ============ Main ============ */
.main{
    height:100%;overflow-y:auto;overflow-x:hidden;
    display:flex;flex-direction:column;
}
.main::-webkit-scrollbar{width:8px}
.main::-webkit-scrollbar-thumb{background:rgba(255,255,255,.08);border-radius:4px}
.main::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,.15)}

/* Top bar */
.topbar{
    position:sticky;top:0;z-index:10;
    padding:16px 32px;
    background:rgba(15,15,20,.85);
    backdrop-filter:blur(20px);
    display:flex;align-items:center;gap:16px;
    border-bottom:1px solid rgba(255,255,255,.04);
}
.topbar-nav{display:flex;gap:4px}
.topbar-btn{
    width:34px;height:34px;border-radius:50%;
    background:rgba(255,255,255,.05);
    display:flex;align-items:center;justify-content:center;
    font-size:14px;color:rgba(255,255,255,.7);transition:.2s;
}
.topbar-btn:hover{background:rgba(255,255,255,.1);color:#fff}
.topbar-search{
    flex:1;max-width:480px;
    display:flex;align-items:center;gap:10px;
    padding:0 14px;height:36px;border-radius:18px;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.04);
}
.topbar-search:focus-within{background:rgba(255,255,255,.09);border-color:rgba(255,107,53,.4)}
.topbar-search input{
    flex:1;background:none;border:none;outline:none;
    font-size:13px;color:#fff;
}
.topbar-search input::placeholder{color:rgba(255,255,255,.3)}
.topbar-search span{font-size:14px;color:rgba(255,255,255,.4)}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:12px;font-size:13px;color:rgba(255,255,255,.5)}

/* Content */
.content{padding:24px 32px 200px}

/* Hero banner */
.banner{
    position:relative;height:220px;border-radius:16px;overflow:hidden;
    margin-bottom:32px;
    background:linear-gradient(135deg,#2d1b3d,#1a1025);
}
.banner-bg{
    position:absolute;inset:0;
    background-size:cover;background-position:center;
    filter:blur(30px) brightness(.5);
    transform:scale(1.2);
}
.banner-overlay{position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.6),transparent 60%)}
.banner-inner{
    position:relative;height:100%;padding:32px 40px;
    display:flex;align-items:center;gap:32px;
}
.banner-cover{
    width:150px;height:150px;border-radius:14px;overflow:hidden;flex-shrink:0;
    box-shadow:0 20px 60px rgba(0,0,0,.5);
    animation:floaty 6s ease-in-out infinite;
}
.banner-cover img{width:100%;height:100%;object-fit:cover}
.banner-info{flex:1;min-width:0}
.banner-tag{
    display:inline-block;padding:4px 10px;border-radius:4px;
    background:linear-gradient(135deg,#ff6b35,#ff3366);
    font-size:10px;font-weight:700;letter-spacing:1px;margin-bottom:12px;
}
.banner-title{font-size:28px;font-weight:800;margin-bottom:6px;letter-spacing:-.5px}
.banner-desc{font-size:13px;color:rgba(255,255,255,.55);margin-bottom:18px}
.banner-play{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 22px;border-radius:22px;
    background:linear-gradient(135deg,#ff6b35,#ff3366);
    font-size:13px;font-weight:700;
    box-shadow:0 8px 24px rgba(255,51,102,.4);
    transition:.2s;
}
.banner-play:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(255,51,102,.55)}
.banner-play .play-icon{font-size:14px}

/* Section */
.sec{margin-bottom:32px}
.sec-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:18px}
.sec-title{font-size:20px;font-weight:800;letter-spacing:-.5px;display:flex;align-items:center;gap:10px}
.sec-title .sec-ic{font-size:22px}
.sec-more{font-size:12px;color:rgba(255,255,255,.4);cursor:pointer;padding:6px 12px;border-radius:14px;transition:.2s}
.sec-more:hover{color:#fff;background:rgba(255,255,255,.06)}

/* Playlist grid */
.pl-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px}
.pl-card{
    cursor:pointer;border-radius:12px;padding:12px;
    background:transparent;transition:.25s;
    animation:fadeUp .5s ease both;
    position:relative;
}
.pl-card:hover{background:rgba(255,255,255,.04);transform:translateY(-3px)}
.pl-cover{
    position:relative;width:100%;aspect-ratio:1;border-radius:10px;overflow:hidden;
    margin-bottom:12px;
}
.pl-cover img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s}
.pl-card:hover .pl-cover img{transform:scale(1.08)}
.pl-play{
    position:absolute;right:10px;bottom:10px;
    width:40px;height:40px;border-radius:50%;
    background:linear-gradient(135deg,#ff6b35,#ff3366);
    display:flex;align-items:center;justify-content:center;
    opacity:0;transform:translateY(6px) scale(.9);
    transition:.25s;box-shadow:0 6px 18px rgba(255,51,102,.4);
}
.pl-card:hover .pl-play{opacity:1;transform:translateY(0) scale(1)}
.pl-platform{
    position:absolute;top:8px;left:8px;
    padding:3px 8px;border-radius:10px;font-size:10px;font-weight:700;letter-spacing:.5px;
    backdrop-filter:blur(8px);
}
.pl-platform.netease{background:rgba(180,120,255,.85);color:#fff}
.pl-platform.tencent{background:rgba(255,160,50,.85);color:#fff}
.pl-title{font-size:13px;font-weight:600;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.pl-sub{font-size:11px;color:rgba(255,255,255,.4);font-weight:500}

/* Playlist detail */
.pl-detail{
    display:none;margin-bottom:32px;
    background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.05);
    border-radius:16px;overflow:hidden;
    animation:fadeUp .35s ease both;
}
.pl-detail.open{display:block}
.pl-detail-head{
    display:flex;align-items:center;gap:20px;
    padding:20px 24px;
    background:linear-gradient(135deg,rgba(255,107,53,.1),rgba(255,51,102,.05));
    border-bottom:1px solid rgba(255,255,255,.05);
}
.pl-detail-cover{width:80px;height:80px;border-radius:10px;overflow:hidden;flex-shrink:0;box-shadow:0 8px 24px rgba(0,0,0,.4)}
.pl-detail-cover img{width:100%;height:100%;object-fit:cover}
.pl-detail-info{flex:1;min-width:0}
.pl-detail-title{font-size:18px;font-weight:800;margin-bottom:4px}
.pl-detail-meta{font-size:12px;color:rgba(255,255,255,.45)}
.pl-detail-close{
    padding:8px 14px;border-radius:14px;font-size:12px;font-weight:600;
    background:rgba(255,255,255,.06);color:rgba(255,255,255,.7);
    transition:.2s;
}
.pl-detail-close:hover{background:rgba(255,255,255,.12);color:#fff}

.track-list{max-height:360px;overflow-y:auto}
.track-list::-webkit-scrollbar{width:4px}
.track-list::-webkit-scrollbar-thumb{background:rgba(255,255,255,.08);border-radius:2px}
.track-item{
    display:grid;grid-template-columns:40px 1fr auto auto;align-items:center;gap:12px;
    padding:10px 24px;cursor:pointer;
    transition:.15s;
}
.track-item:hover{background:rgba(255,255,255,.04)}
.track-item.playing{background:linear-gradient(90deg,rgba(255,107,53,.12),transparent)}
.track-item.playing .track-name{color:#ff6b35}
.track-idx{
    font-size:13px;font-weight:600;color:rgba(255,255,255,.35);
    width:24px;height:24px;display:flex;align-items:center;justify-content:center;
}
.track-item.playing .track-idx{color:#ff6b35;font-size:11px}
.track-idx.playing-icon{font-size:12px}
.track-info{min-width:0}
.track-name{font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.track-artist{font-size:11px;color:rgba(255,255,255,.4);margin-top:2px}
.track-action{
    width:32px;height:32px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    color:rgba(255,255,255,.4);font-size:14px;
    opacity:0;transition:.2s;
}
.track-item:hover .track-action{opacity:1}
.track-action:hover{background:rgba(255,255,255,.08);color:#fff}
.track-length{font-size:12px;color:rgba(255,255,255,.35);font-variant-numeric:tabular-nums}

/* Loading skeleton */
.loading-tracks{padding:20px 24px}
.skel-row{display:flex;gap:12px;padding:10px 0;align-items:center}
.skel-bar{height:12px;border-radius:6px;background:linear-gradient(90deg,rgba(255,255,255,.04),rgba(255,255,255,.1),rgba(255,255,255,.04));background-size:200% 100%;animation:skel 1.4s ease-in-out infinite}
.skel-1{width:24px}.skel-2{flex:1;max-width:200px}.skel-3{width:80px}

/* ============ Player Bar (bottom) ============ */
.player{
    position:fixed;bottom:0;left:220px;right:0;z-index:100;
    height:72px;
    background:#1a1a24;
    border-top:1px solid rgba(255,255,255,.06);
    display:grid;grid-template-columns:1fr auto 1fr;align-items:center;
    padding:0 24px;
    box-shadow:0 -4px 24px rgba(0,0,0,.4);
}

/* Left: current song */
.pl-left{display:flex;align-items:center;gap:14px;min-width:0}
.pl-cover{
    width:52px;height:52px;border-radius:8px;overflow:hidden;flex-shrink:0;
    box-shadow:0 4px 14px rgba(0,0,0,.4);
}
.pl-cover img{width:100%;height:100%;object-fit:cover}
.pl-info{min-width:0;max-width:200px}
.pl-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.pl-artist{font-size:11px;color:rgba(255,255,255,.4);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

/* Center: controls */
.pl-center{display:flex;flex-direction:column;align-items:center;gap:6px}
.pl-controls{display:flex;align-items:center;gap:14px}
.pl-ctrl-btn{
    width:32px;height:32px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    color:rgba(255,255,255,.7);font-size:15px;
    transition:.2s;
}
.pl-ctrl-btn:hover{color:#fff;background:rgba(255,255,255,.08)}
.pl-ctrl-btn.main{
    width:40px;height:40px;font-size:16px;
    background:linear-gradient(135deg,#ff6b35,#ff3366);color:#fff;
    box-shadow:0 4px 14px rgba(255,51,102,.35);
}
.pl-ctrl-btn.main:hover{transform:scale(1.06);box-shadow:0 6px 18px rgba(255,51,102,.5)}
.pl-ctrl-btn:active{transform:scale(.95)}

.pl-progress{display:flex;align-items:center;gap:10px;width:420px;max-width:50vw}
.pl-time{font-size:11px;color:rgba(255,255,255,.4);font-variant-numeric:tabular-nums;min-width:34px;text-align:center}
.pl-bar{
    flex:1;height:3px;border-radius:2px;background:rgba(255,255,255,.1);
    position:relative;cursor:pointer;transition:height .15s;
}
.pl-bar:hover{height:5px}
.pl-bar-fill{
    height:100%;border-radius:2px;
    background:linear-gradient(90deg,#ff6b35,#ff3366);
    position:relative;width:0%;transition:width .1s linear;
}
.pl-bar-fill::after{
    content:'';position:absolute;right:-5px;top:50%;transform:translateY(-50%);
    width:10px;height:10px;border-radius:50%;
    background:#fff;opacity:0;transition:.15s;
    box-shadow:0 2px 6px rgba(255,51,102,.4);
}
.pl-bar:hover .pl-bar-fill::after{opacity:1}

/* Right: extras */
.pl-right{display:flex;align-items:center;justify-content:flex-end;gap:10px}
.pl-vol{display:flex;align-items:center;gap:8px}
.pl-vol-btn{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);font-size:14px;transition:.2s}
.pl-vol-btn:hover{color:#fff;background:rgba(255,255,255,.08)}
.pl-vol-bar{width:80px;height:3px;border-radius:2px;background:rgba(255,255,255,.1);position:relative;cursor:pointer}
.pl-vol-fill{height:100%;border-radius:2px;background:rgba(255,255,255,.6);width:70%}
.pl-mode{
    width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);font-size:13px;transition:.2s;
}
.pl-mode:hover{color:#fff;background:rgba(255,255,255,.08)}
.pl-mode.active{color:#ff6b35}

/* No playing placeholder */
.player.idle .pl-cover img{opacity:.3;filter:grayscale(1)}
.player.idle .pl-name::after{content:'暂无播放';color:rgba(255,255,255,.3)}
.player.idle .pl-name{color:transparent}

/* ============ Animations ============ */
@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
@keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes skel{0%{background-position:200% 0}100%{background-position:-200% 0}}
@keyframes eq{0%,100%{transform:scaleY(.4)}50%{transform:scaleY(1)}}
@keyframes spin{to{transform:rotate(360deg)}}

/* ============ Responsive ============ */
@media(max-width:900px){
    .app{grid-template-columns:64px 1fr}
    .sb-logo-text,.sb-group-title,.sb-item span:not(.sb-item-icon),.sb-platform{display:none}
    .sb-item{justify-content:center;padding:12px}
    .sidebar{width:64px}
    .player{left:64px}
    .pl-progress{width:220px}
    .content{padding:20px 20px 200px}
    .banner-inner{flex-direction:column;text-align:center;padding:24px;gap:16px}
    .banner-overlay{background:linear-gradient(180deg,rgba(0,0,0,.6),rgba(0,0,0,.4))}
    .banner-cover{width:100px;height:100px}
    .banner-title{font-size:20px}
}
@media(max-width:560px){
    .pl-progress{display:none}
    .pl-vol-bar{display:none}
    .topbar-search{display:none}
    .pl-grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px}
    .player{padding:0 12px}
    .pl-controls{gap:8px}
}
</style>
</head>
<body>

<div class="app">
    <!-- ============ SIDEBAR ============ -->
    <aside class="sidebar">
        <div class="sb-logo">
            <div class="sb-logo-icon">🎵</div>
            <div class="sb-logo-text"><span>Meting</span></div>
        </div>
        <nav class="sb-menu" id="sbMenu">
            <div class="sb-group">
                <div class="sb-group-title">浏览</div>
                <div class="sb-item active" data-view="home"><span class="sb-item-icon">🏠</span><span>发现音乐</span></div>
                <div class="sb-item" data-view="banner"><span class="sb-item-icon">🔥</span><span>热门推荐</span></div>
                <div class="sb-item" data-view="recent"><span class="sb-item-icon">⏱️</span><span>最近播放</span></div>
            </div>
            <div class="sb-group">
                <div class="sb-group-title">歌单</div>
                <div id="sbPlaylists"></div>
            </div>
        </nav>
        <div class="sb-platform">
            <div class="sb-platform-title">数据源</div>
            <div class="sb-platform-row">
                <button class="sb-platform-btn active" data-server="netease">网易云</button>
                <button class="sb-platform-btn" data-server="tencent">QQ音乐</button>
            </div>
        </div>
    </aside>

    <!-- ============ MAIN ============ -->
    <main class="main">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-nav">
                <button class="topbar-btn" title="后退">‹</button>
                <button class="topbar-btn" title="前进">›</button>
            </div>
            <div class="topbar-search">
                <span>🔍</span>
                <input id="searchInput" placeholder="搜索歌曲、歌手或歌单..." onkeydown="if(event.key==='Enter')doSearch()">
            </div>
            <div class="topbar-right" id="clock"></div>
        </div>

        <div class="content">
            <!-- Hero Banner -->
            <div class="banner" id="banner">
                <div class="banner-bg" id="bannerBg"></div>
                <div class="banner-overlay"></div>
                <div class="banner-inner">
                    <div class="banner-cover"><img id="bannerCover" src="" alt=""></div>
                    <div class="banner-info">
                        <div class="banner-tag" id="bannerTag">FEATURED PLAYLIST</div>
                        <div class="banner-title" id="bannerTitle">加载中...</div>
                        <div class="banner-desc" id="bannerDesc"></div>
                        <button class="banner-play" onclick="playCurrentFeatured()">
                            <span class="play-icon">▶</span> 立即播放
                        </button>
                    </div>
                </div>
            </div>

            <!-- Playlist Detail (expands when clicked) -->
            <div class="pl-detail" id="plDetail">
                <div class="pl-detail-head">
                    <div class="pl-detail-cover"><img id="plDetailCover" src="" alt=""></div>
                    <div class="pl-detail-info">
                        <div class="pl-detail-title" id="plDetailTitle">歌单</div>
                        <div class="pl-detail-meta" id="plDetailMeta"></div>
                    </div>
                    <button class="pl-detail-close" onclick="closePlaylist()">✕ 关闭</button>
                </div>
                <div id="plDetailBody"></div>
            </div>

            <!-- Playlist Grid -->
            <section class="sec">
                <div class="sec-head">
                    <div class="sec-title"><span class="sec-ic">🎶</span><span id="gridTitle">精选歌单</span></div>
                    <div class="sec-more">更多 ›</div>
                </div>
                <div class="pl-grid" id="plGrid"></div>
            </section>
        </div>
    </main>
</div>

<!-- ============ PLAYER BAR ============ -->
<div class="player idle" id="player">
    <div class="pl-left">
        <div class="pl-cover"><img id="plCover" src="" alt=""></div>
        <div class="pl-info">
            <div class="pl-name" id="plName">暂无播放</div>
            <div class="pl-artist" id="plArtist">—</div>
        </div>
    </div>

    <div class="pl-center">
        <div class="pl-controls">
            <button class="pl-ctrl-btn" onclick="prevTrack()" title="上一首">⏮</button>
            <button class="pl-ctrl-btn main" id="plPlayBtn" onclick="togglePlay()" title="播放/暂停">▶</button>
            <button class="pl-ctrl-btn" onclick="nextTrack()" title="下一首">⏭</button>
        </div>
        <div class="pl-progress">
            <span class="pl-time" id="plCurTime">00:00</span>
            <div class="pl-bar" id="plBar">
                <div class="pl-bar-fill" id="plBarFill"></div>
            </div>
            <span class="pl-time" id="plTotalTime">00:00</span>
        </div>
    </div>

    <div class="pl-right">
        <div class="pl-mode" id="plModeBtn" onclick="cycleMode()" title="播放模式">🔁</div>
        <div class="pl-vol">
            <button class="pl-vol-btn" id="plVolBtn" onclick="toggleMute()" title="静音">🔊</button>
            <div class="pl-vol-bar" id="plVolBar">
                <div class="pl-vol-fill" id="plVolFill"></div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden audio -->
<audio id="audio" preload="metadata"></audio>

<script>
/* =========================================================
   METING PLAYER - Custom QQ-Music-style Player
   ========================================================= */
var API_URI = <?php echo json_encode(API_URI); ?>;

// ------- State -------
var state = {
    server: 'netease',
    playlists: [],        // [{server,type,id,title,sub,cover_id}]
    currentQueue: [],     // flat list of tracks for current playlist/song
    currentIdx: -1,
    audio: null,
    isPlaying: false,
    playMode: 0,          // 0=sequence, 1=random, 2=repeat-one
    prevVolume: 0.7,
    playingPlaylistKey: null,
};

// ------- Init -------
document.addEventListener('DOMContentLoaded', init);

function init(){
    state.audio = document.getElementById('audio');
    state.audio.volume = 0.7;

    bindAudioEvents();
    bindEvents();
    loadPlaylists();
    loadBanner();
    updateClock(); setInterval(updateClock,1000);

    // sidebar server switch
    document.querySelectorAll('.sb-platform-btn').forEach(function(b){
        b.addEventListener('click',function(){
            document.querySelectorAll('.sb-platform-btn').forEach(x=>x.classList.remove('active'));
            b.classList.add('active');
            state.server = b.dataset.server;
            loadPlaylists();
        });
    });
}

function bindEvents(){
    // Progress bar seek
    var bar = document.getElementById('plBar');
    bar.addEventListener('click',seekBar);
    document.getElementById('plVolBar').addEventListener('click',seekVol);

    // Sidebar menu
    document.querySelectorAll('#sbMenu .sb-item[data-view]').forEach(function(it){
        it.addEventListener('click',function(){
            document.querySelectorAll('#sbMenu .sb-item').forEach(x=>x.classList.remove('active'));
            it.classList.add('active');
            // scroll to section
            var view = it.dataset.view;
            if(view==='home'||view==='banner') document.querySelector('.content').scrollTo({top:0,behavior:'smooth'});
        });
    });
}

function bindAudioEvents(){
    var a = state.audio;
    a.addEventListener('play',function(){
        state.isPlaying = true;
        document.getElementById('plPlayBtn').textContent = '❚❚';
        document.getElementById('player').classList.remove('idle');
    });
    a.addEventListener('pause',function(){
        state.isPlaying = false;
        document.getElementById('plPlayBtn').textContent = '▶';
    });
    a.addEventListener('timeupdate',onTimeUpdate);
    a.addEventListener('loadedmetadata',function(){
        document.getElementById('plTotalTime').textContent = fmtTime(a.duration);
    });
    a.addEventListener('ended',onEnded);
    a.addEventListener('error',function(){
        // Try next if current fails
        if(state.currentIdx>=0){
            console.warn('audio error, trying next');
            nextTrack();
        }
    });
}

// ------- Playlists data -------
function loadPlaylists(){
    var netease = [
        {server:'netease',type:'playlist',id:'2619366284',title:'云音乐飙升榜',sub:'官方榜',cover_id:'2100968507'},
        {server:'netease',type:'playlist',id:'440103454',title:'私人雷达',sub:'每日推荐',cover_id:'2063124907'},
        {server:'netease',type:'playlist',id:'3778678',title:'欧美流行精选',sub:'编辑精选',cover_id:'1901371098'},
        {server:'netease',type:'playlist',id:'180106',title:'日语 ACG 精选',sub:'二次元',cover_id:'1883586452'},
        {server:'netease',type:'playlist',id:'21845217',title:'华语经典老歌',sub:'怀旧经典',cover_id:'1455080114'},
        {server:'netease',type:'playlist',id:'6907557348',title:'纯音乐 & 氛围',sub:'放松必备',cover_id:'2013369464'},
    ];
    var tencent = [
        {server:'tencent',type:'playlist',id:'9697595502',title:'QQ音乐热歌榜',sub:'热歌速递',cover_id:'0038ZG5W3EBBG9'},
        {server:'tencent',type:'playlist',id:'7326220405',title:'QQ音乐官方歌单',sub:'编辑推荐',cover_id:'002Rnpvi058Qdm'},
    ];
    state.playlists = (state.server==='tencent') ? tencent : netease;
    renderGrid();
    renderSidebar();
    updateGridTitle();
}

function updateGridTitle(){
    document.getElementById('gridTitle').textContent = (state.server==='tencent') ? 'QQ音乐 精选歌单' : '网易云 精选歌单';
}

function renderGrid(){
    var grid = document.getElementById('plGrid');
    grid.innerHTML = '';
    state.playlists.forEach(function(p,i){
        var url = API_URI + '?server=' + p.server + '&type=pic&id=' + p.cover_id;
        var card = document.createElement('div');
        card.className = 'pl-card';
        card.style.animationDelay = (i*0.06)+'s';
        card.innerHTML =
            '<div class="pl-cover">'+
                '<img src="'+url+'" alt="" loading="lazy">'+
                '<span class="pl-platform '+p.server+'">'+(p.server==='netease'?'网易云':'QQ')+'</span>'+
                '<div class="pl-play"></div>'+
            '</div>'+
            '<div class="pl-title">'+p.title+'</div>'+
            '<div class="pl-sub">'+p.sub+'</div>';
        card.addEventListener('click',function(){ openPlaylist(p); });
        grid.appendChild(card);
    });
}

function renderSidebar(){
    var box = document.getElementById('sbPlaylists');
    box.innerHTML = '';
    state.playlists.forEach(function(p){
        var item = document.createElement('div');
        item.className = 'sb-item';
        item.innerHTML = '<span class="sb-item-icon">🎵</span><span>'+p.title+'</span>';
        item.addEventListener('click',function(){
            document.querySelectorAll('#sbMenu .sb-item').forEach(x=>x.classList.remove('active'));
            openPlaylist(p);
        });
        box.appendChild(item);
    });
}

// ------- Banner -------
function loadBanner(){
    var p = state.playlists[0];
    var coverUrl = API_URI + '?server='+p.server+'&type=pic&id='+p.cover_id;
    document.getElementById('bannerCover').src = coverUrl;
    document.getElementById('bannerBg').style.backgroundImage = 'url('+coverUrl+')';
    document.getElementById('bannerTitle').textContent = p.title;
    document.getElementById('bannerDesc').textContent = p.sub + ' · ' + (p.server==='netease'?'网易云音乐':'QQ音乐');
    document.getElementById('banner').dataset.server = p.server;
    document.getElementById('banner').dataset.type = p.type;
    document.getElementById('banner').dataset.id = p.id;
}

function playCurrentFeatured(){
    var b = document.getElementById('banner');
    playPlaylist({server:b.dataset.server,type:b.dataset.type,id:b.dataset.id,title:document.getElementById('bannerTitle').textContent,sub:'',cover_id:getPlaylistCover(b.dataset.id)});
}

function getPlaylistCover(id){
    var p = state.playlists.find(function(x){return x.id===id});
    return p ? p.cover_id : id;
}

// ------- Playlist detail -------
function openPlaylist(p){
    var coverUrl = API_URI + '?server='+p.server+'&type=pic&id='+p.cover_id;
    document.getElementById('plDetailCover').src = coverUrl;
    document.getElementById('plDetailTitle').textContent = p.title;
    document.getElementById('plDetailMeta').textContent = p.sub + ' · 加载中...';
    document.getElementById('plDetail').classList.add('open');
    document.getElementById('plDetailBody').innerHTML =
        '<div class="loading-tracks">'+
            Array(8).fill(0).map(function(i){return '<div class="skel-row"><div class="skel-bar skel-1"></div><div class="skel-bar skel-2"></div></div>';}).join('')+
        '</div>';

    fetch(API_URI + '?server='+p.server+'&type=playlist&id='+p.id)
        .then(function(r){return r.json();})
        .then(function(data){
            document.getElementById('plDetailMeta').textContent = p.sub + ' · '+data.length+' 首';
            renderTracks(data, p);
            // Also prepare queue
            state.currentQueue = data.map(function(t,i){
                return {
                    idx: i,
                    name: t.name,
                    artist: t.artist,
                    url: API_URI + '?server='+p.server+'&type=url&id='+t.id,
                    server: p.server,
                    id: t.id,
                    pic: API_URI + '?server='+p.server+'&type=pic&id='+t.id,
                };
            });
            state.playingPlaylistKey = p.server+':'+p.id;
        })
        .catch(function(e){
            document.getElementById('plDetailBody').innerHTML = '<div style="padding:20px;color:rgba(255,255,255,.5)">加载失败</div>';
            console.error(e);
        });

    // scroll into view
    document.getElementById('plDetail').scrollIntoView({behavior:'smooth',block:'start'});
}

function renderTracks(tracks, playlist){
    var html = '<div class="track-list">';
    tracks.forEach(function(t,i){
        var dur = t.duration ? fmtTime(t.duration/1000) : '';
        var cls = (state.currentIdx===i && state.playingPlaylistKey===playlist.server+':'+playlist.id) ? ' playing' : '';
        html +=
            '<div class="track-item'+cls+'" data-idx="'+i+'" data-server="'+playlist.server+'" data-id="'+t.id+'">'+
                '<div class="track-idx">'+(cls.indexOf('playing')>-1?'♪':(i+1))+'</div>'+
                '<div class="track-info">'+
                    '<div class="track-name">'+escapeHtml(t.name)+'</div>'+
                    '<div class="track-artist">'+escapeHtml(t.artist)+'</div>'+
                '</div>'+
                '<div class="track-action" title="播放">▶</div>'+
                '<div class="track-length">'+dur+'</div>'+
            '</div>';
    });
    html += '</div>';
    document.getElementById('plDetailBody').innerHTML = html;

    // Bind
    document.querySelectorAll('.track-item').forEach(function(row){
        row.addEventListener('dblclick',function(){
            var idx = parseInt(row.dataset.idx);
            playAt(idx);
        });
        row.querySelector('.track-action').addEventListener('click',function(e){
            e.stopPropagation();
            var idx = parseInt(row.dataset.idx);
            playAt(idx);
        });
    });
}

function closePlaylist(){
    document.getElementById('plDetail').classList.remove('open');
}

// ------- Playback -------
function playPlaylist(p){
    openPlaylist(p);
}

function playAt(idx){
    if(!state.currentQueue.length) return;
    state.currentIdx = idx;
    var t = state.currentQueue[idx];

    // Update player UI
    document.getElementById('plCover').src = t.pic;
    document.getElementById('plName').textContent = t.name;
    document.getElementById('plArtist').textContent = t.artist;
    document.getElementById('player').classList.remove('idle');

    // Update list highlighting
    document.querySelectorAll('.track-item').forEach(function(r){
        r.classList.remove('playing');
        if(parseInt(r.dataset.idx)===idx) r.classList.add('playing');
    });

    // Load audio - add cache buster to prevent 302 cached
    state.audio.src = t.url + '&_=' + Date.now();
    state.audio.play().catch(function(err){
        console.warn('play failed:',err);
    });
}

function togglePlay(){
    if(state.currentIdx<0){
        // nothing loaded - load first of current grid
        if(state.playlists.length) playPlaylist(state.playlists[0]);
        return;
    }
    if(state.isPlaying) state.audio.pause();
    else state.audio.play();
}

function prevTrack(){
    if(!state.currentQueue.length) return;
    state.currentIdx = (state.currentIdx - 1 + state.currentQueue.length) % state.currentQueue.length;
    playAt(state.currentIdx);
}

function nextTrack(){
    if(!state.currentQueue.length) return;
    var mode = state.playMode;
    if(mode===1){ // random
        state.currentIdx = Math.floor(Math.random()*state.currentQueue.length);
    } else {
        state.currentIdx = (state.currentIdx + 1) % state.currentQueue.length;
    }
    playAt(state.currentIdx);
}

function onEnded(){
    if(state.playMode===2){ // repeat one
        state.audio.currentTime = 0;
        state.audio.play();
    } else {
        nextTrack();
    }
}

function onTimeUpdate(){
    var a = state.audio;
    if(!isFinite(a.duration)) return;
    var pct = (a.currentTime / a.duration) * 100;
    document.getElementById('plBarFill').style.width = pct + '%';
    document.getElementById('plCurTime').textContent = fmtTime(a.currentTime);
}

function seekBar(e){
    if(!isFinite(state.audio.duration)) return;
    var rect = e.currentTarget.getBoundingClientRect();
    var pct = (e.clientX - rect.left) / rect.width;
    state.audio.currentTime = pct * state.audio.duration;
}

function cycleMode(){
    state.playMode = (state.playMode + 1) % 3;
    var icons = ['🔁','🎲','🔂'];
    var titles = ['顺序播放','随机播放','单曲循环'];
    var btn = document.getElementById('plModeBtn');
    btn.textContent = icons[state.playMode];
    btn.title = titles[state.playMode];
    btn.classList.toggle('active', state.playMode!==0);
}

function seekVol(e){
    var rect = e.currentTarget.getBoundingClientRect();
    var pct = (e.clientX - rect.left) / rect.width;
    state.audio.volume = Math.max(0,Math.min(1,pct));
    document.getElementById('plVolFill').style.width = (pct*100)+'%';
}

function toggleMute(){
    var a = state.audio;
    if(a.volume>0){ state.prevVolume = a.volume; a.volume=0; document.getElementById('plVolBtn').textContent='🔇'; document.getElementById('plVolFill').style.width='0%'; }
    else { a.volume = state.prevVolume||0.7; document.getElementById('plVolBtn').textContent='🔊'; document.getElementById('plVolFill').style.width=((state.prevVolume||0.7)*100)+'%'; }
}

// ------- Utility -------
function fmtTime(s){
    if(!isFinite(s)||s<0) s=0;
    var m = Math.floor(s/60), sec = Math.floor(s%60);
    return (m<10?'0':'')+m+':'+(sec<10?'0':'')+sec;
}
function escapeHtml(s){
    if(!s) return '';
    return String(s).replace(/[&<>"'\x60]/g,function(c){
        var map = {'&':'\\x26','<':'\\x3c','>':'\\x3e','"':'\\x22',"'":"\\x27",'`':'\\x60'};
        return map[c] || c;
    });
}
function updateClock(){
    document.getElementById('clock').textContent = new Date().toLocaleTimeString('zh-CN',{hour12:false});
}
function doSearch(){
    var q = document.getElementById('searchInput').value.trim();
    if(!q) return;
    // Just load as search type into first server
    var server = state.server;
    fetch(API_URI+'?server='+server+'&type=song&id='+encodeURIComponent(q))
        .then(function(r){return r.json();})
        .then(function(data){
            if(!data.length){ alert('未找到: '+q); return; }
            state.currentQueue = data.map(function(t,i){
                return {
                    idx:i,name:t.name,artist:t.artist,
                    url: t.url || API_URI+'?server='+server+'&type=url&id='+t.id,
                    server:server,id:t.id,
                    pic: API_URI+'?server='+server+'&type=pic&id='+t.id,
                };
            });
            playAt(0);
        });
}
</script>
</body>
</html>
