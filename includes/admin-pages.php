<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Admin Menu
 */
function elite_heading_admin_menu() {
    add_menu_page(
        'Elite Heading',
        'Elite Heading',
        'manage_options',
        'elite-heading',
        'elite_heading_admin_page',
        'dashicons-editor-textcolor',
        58
    );
}
add_action( 'admin_menu', 'elite_heading_admin_menu' );

// ✅ Place the notice-hiding code here
add_action('admin_head', function () {
    $current_screen = get_current_screen();
    if ($current_screen && $current_screen->id === 'toplevel_page_elite-heading') {
        ?>
        <style>
            .update-nag,
            .notice,
            .error,
            .updated,
            .is-dismissible {
                display: none !important;
            }
        </style>
        <?php
    }
});
/**
 * Admin page output — two tabs
 */
function elite_heading_admin_page() {
    $tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'dashboard';
    ?>
    <div class="wrap elite-heading-dashboard">
        <h1 class="main-title"> <span class="main-h">  ✨ Elite Heading ✨</span></h1>

        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php echo $tab === 'dashboard' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=elite-heading&tab=dashboard' ) ); ?>">Dashboard</a>
            <a class="nav-tab <?php echo $tab === 'howto' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=elite-heading&tab=howto' ) ); ?>">How to use</a>
        </h2>

        <?php if ( $tab === 'dashboard' ) : ?>

           
        <div class="elite-dashboard-wrap">
    <div class="intro-box">
        <h2>Welcome to Elite Heading!</h2>
        <p>
            Create <strong>beautiful headings</strong> with <em>gradients</em>, 
            <em>typing animations</em> and <em>unique styles</em> in Elementor.
        </p>
    </div>

    <div class="cards-row">
        <!-- Card 1 -->
        <div class="card preset-1">
            <h3>Option 1</h3>
            <h2 >  <span class="elite-heading-title typing typing-full" data-text="Elite Heading"></span></h2>
        </div>

        <!-- Card 2 -->
        <div class="card preset-2">
            <h3>Option 2</h3>
            <h2>
                <span class="elite-heading-title typing typing-first" data-text="Elite"></span>
                <span class="elite-heading-title"> Heading</span>
            </h2>
        </div>

        <!-- Card 3 -->
        <div class="card preset-3">
            <h3>Option 3</h3>
            <h2>
                <span class="elite-heading-title">Elite </span>
                <span class="elite-heading-title typing typing-last" data-text="Heading"></span>
            </h2>
        </div>
    </div>

    <div class="get-started">
        <h2 class="get-started-title">🚀 Get Started</h2>
        <div class="steps-row">
            <div class="step-card">
                <div class="step-icon">📝</div>
                <h3>Edit Page</h3>
                <p>Open any page or post and click <strong>Edit with Elementor</strong>.</p>
            </div>
            <div class="step-card">
                <div class="step-icon">🔍</div>
                <h3>Find Widget</h3>
                <p>In Elementor’s panel, search for <strong>Elite Heading</strong>.</p>
            </div>
            <div class="step-card">
                <div class="step-icon">🎨</div>
                <h3>Customize</h3>
                <p>Drag it, choose gradient, animation & styling.</p>
            </div>
            <div class="step-card">
                <div class="step-icon">✅</div>
                <h3>Done!</h3>
                <p>Save & enjoy your new stylish heading.</p>
            </div>
        </div>
    </div>
</div>

<style>




    body{
         background: linear-gradient(135deg, #0a0f29, #0d1b3d, #000000);
        
    }
    /* Dark gradient background */
    .elite-dashboard-wrap {
        background: linear-gradient(135deg, #0a0f29, #0d1b3d, #000000);
        padding: 25px;
        border-radius: 12px;
        color: #fff;
    }

    .intro-box {
        background: rgba(255,255,255,0.05);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Card layout */
    .cards-row {
        display: flex;
        gap: 20px;
        margin-bottom: 35px;
        flex-wrap: wrap;
    }
    .card {
        flex: 1;
        min-width: 200px;
        background: rgba(255,255,255,0.08);
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.5);
        padding: 20px;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.8);
    }
    .card h3 {
        margin-bottom: 12px;
        font-size: 1.1em;
        color: #ffcc70;
        
    }

    .main-h{
         background: linear-gradient(130deg, #ff7a18, #ff5c7a, #ff4d8a);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 40px;
  font-weight: bolder;

    }

   
      .preset-1 .elite-heading-title {
  background: linear-gradient(90deg, #ff7a18, #ff5c7a, #ff4d8a);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.preset-2 .elite-heading-title {
  background: linear-gradient(90deg, #00bfa6, #00a0ff, #0066ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.preset-3 .elite-heading-title {
  background: linear-gradient(90deg, #7b2ff7, #e94057);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

 .elite-heading-title.typing::after {
  content: '|';
  display: inline-block;
  margin-left: 4px;
  font-weight: 900;
  height: 25px;
  background: white;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text; /* for non-webkit */
  animation: blink 1s steps(2, start) infinite;
  vertical-align: bottom;
}


    .elite-heading-title {
        font-size: 1.6em;
        font-weight: 700;
        color: #ffffff;
        white-space: nowrap;
    }

    /* Typing cursor */
    .typing::after {
        content: '|';
        animation: blink 1s steps(2, start) infinite;
        margin-left: 4px;
    }
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }

    /* Get Started */
    .get-started-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.8em;
        color: #00d4ff;
    }
    .steps-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .step-card {
        flex: 1 1 calc(25% - 20px);
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.6);
        padding: 20px;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .step-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.9);
    }
    .step-icon {
        font-size: 2em;
        margin-bottom: 10px;
    }
    .step-card h3 {
        margin-bottom: 8px;
        
    }
    .step-card p {
        color: #e0e0e0;
    }



/* Whole page wrapper for both tabs */
.wrap {
    background: linear-gradient(135deg, #0a0f29, #0d1b3d, #000000);
    padding: 25px;
    border-radius: 12px;
    color: #fff;
}

/* Tabs at top */
.nav-tab-wrapper {
    margin: 20px 0;
    border-bottom: none;
}
.nav-tab {
    background: rgba(255,255,255,0.05);
    color: #ccc;
    border: none;
    padding: 10px 18px;
    border-radius: 6px 6px 0 0;
    margin-right: 6px;
    font-weight: 600;
    transition: all 0.25s ease;
}
.nav-tab:hover {
    background: rgba(255,255,255,0.15);
    color: #fff;
}
.nav-tab-active {
    background: linear-gradient(90deg, #0072ff, #00c6ff);
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.6);
}

/* Keep "How to use" tab content readable */
.elite-dashboard-wrap,
.get-started,
.steps-row,
.cards-row,
.step-card,
.card,
.intro-box {
    background-color: transparent; /* remove double bg */
}

/* For "How to use" tab content */
.wrap h2, 
.wrap h3, 
.wrap p, 
.wrap li, 
.wrap ol {
    color: #f0f0f0;
}
.wrap strong {
    color: #00d4ff;
}

.howto-screenshots {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.screenshot-card {
    flex: 1 1 calc(25% - 20px); /* 4 cards per row */
    text-align: center;
    background: rgba(255,255,255,0.05);
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.screenshot-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.7);
}

.screenshot-card h4 {
    margin-bottom: 10px;
    color: #00d4ff;
    font-weight: 600;
}

.screenshot-card img {
    max-width: 100%;
    border-radius: 6px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.6);
}


</style>

<script>
document.addEventListener("DOMContentLoaded", function(){
    function loopTyping(el, text, speed, delayBeforeDelete){
        let i = 0;
        let isDeleting = false;

        function tick(){
            if(!isDeleting){
                el.textContent = text.substring(0, i+1);
                i++;
                if(i === text.length){
                    isDeleting = true;
                    setTimeout(tick, delayBeforeDelete);
                    return;
                }
            } else {
                el.textContent = text.substring(0, i-1);
                i--;
                if(i === 0){
                    isDeleting = false;
                }
            }
            setTimeout(tick, isDeleting ? speed/2 : speed);
        }
        tick();
    }

    // Full typing
    const fullEl = document.querySelector('.typing-full');
    if(fullEl){ loopTyping(fullEl, fullEl.dataset.text, 150, 1200); }

    // First word typing, rest static
    const firstEl = document.querySelector('.typing-first');
    if(firstEl){ loopTyping(firstEl, firstEl.dataset.text, 150, 1200); }

    // Last word typing, first static
    const lastEl = document.querySelector('.typing-last');
    if(lastEl){ loopTyping(lastEl, lastEl.dataset.text, 150, 1200); }
});
</script>


        <?php else : ?>

          <h2>How to use Elite Heading</h2>
<div class="howto-screenshots">
    <div class="screenshot-card">
        <h4>Step 1: Edit Page And In the Elementor widgets panel search for <strong>Elite Heading</strong></h4>
        <img src="<?php echo plugin_dir_url( dirname(__FILE__, 1) ) . 'screenshots/step1.png'; ?>" alt="Step 1">

    </div>
    <div class="screenshot-card">
        <h4>Step 2: Drag the widget into your layout. Set your heading text, font size, weight, alignment and pick one of the 5 gradient presets. Choose typing animation option (whole / first word / last word). Animation loops by default</h4>
<img src="<?php echo plugin_dir_url( dirname(__FILE__, 1) ) . 'screenshots/step2.png'; ?>" alt="Step 2">
    </div>
    <div class="screenshot-card">
        <h4>Step 3: Save and preview the page</h4>
<img src="<?php echo plugin_dir_url( dirname(__FILE__, 1) ) . 'screenshots/step3.png'; ?>" alt="Step 3">
    </div>
   
</div>


<style>


.screenshot-card h4 {
    margin-bottom: 8px;
    color: black;
    line-height: 42px;
    font-weight: 600;
    font-size: 34px;
}

.screenshot-card img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5);
    display: block;
    margin: 0 auto;
}

    </style>

        <?php endif; ?>
    </div>
    <?php
} // end function elite_heading_admin_page
