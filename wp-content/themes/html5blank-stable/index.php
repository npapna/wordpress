<?php get_header(); ?>


<div id="fullpage">
    <div class="section" id="section0">
        <div class="secOneWrapper">
            <h1>Crypto page that can change the world</h1>

            <button class="btnReg">Contact Us</button>
        </div>

    </div>
    <div class="section" id="section1">

        <div class="row">
            <div class="col-md-8">
                <div class="blog-wrapper">
                    <h1><?php _e( 'Latest Posts', 'html5blank' ); ?></h1>
                    <hr>
                    <?php get_template_part('loop'); ?>

                    <?php get_template_part('pagination'); ?>

                </div>
            </div>

            <div class="col-md-4">

            </div>
        </div>

    </div>

</div>




<?php get_sidebar(); ?>

<?php get_footer(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#fullpage').fullpage({
            verticalCentered: true,
            menu: '#menu',
            sectionsColor: ['', '#fff', '']
        });
    });
</script>

<style>
    ul{
        list-style-type: none;
    }
    .myContent{
        height: 300px;
    }
    #section0{
        background: url("<?php echo get_template_directory_uri(); ?>/img/city1.jpg");
        background-size: cover;
    }
    #section0 h1{
        color:yellow
    }
    .secOneWrapper{
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.6);
        width: 50%;
        text-align: center;
        margin: 0 auto;
        position: relative;
        top: 25%;
    }
    .btnReg{
        background: transparent;
        border: 1px solid yellow;
        color: #fff;
        padding: 10px;
        cursor: pointer;
    }

    .blog-wrapper li{
        float: left;
        box-shadow: 1px 1px 18px #000;
        padding: 10px;
        width: 400px;
        margin: 5px;
        height: 200px;
    }
    ul li a{
        color:#000;
    }
    ul li h2:hover{
        color:yellow;
    }

</style>
