<?php $singleBuilding = new SingleBuilding(); ?>
<li class="page-loop__item wow animate__animated animate__fadeInUp" data-wow-duration="0.8s">
    <a href="#" class="favorites-link favorites-link__add" title="Добавить в Избранное" role="button">
    <span class="icon-heart">
        <span class="path1"></span>
        <span class="path2"></span>
    </span>
    </a>
    <a href="<?php echo $singleBuilding->get_post_link(); ?>" class="page-loop__item-link">
    <div class="page-loop__item-image">
        <?php if( $image_url = $singleBuilding->get_thumbnail_url() ) : ?>
            <img src="<?php echo $image_url; ?>" alt="">
        <?php endif; ?>
        <?php if( $badges = $singleBuilding->get_badges() ) : ?>
            <div class="page-loop__item-badges">
                <?php foreach( $badges as $badge ) : ?>
                <span class="badge">
                    <?php 
                    echo $badge->title;
                    if( $badge->value ) {
                        echo $badge->value;
                    } 
                    ?>
                </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="page-loop__item-info">
        <h3 class="page-title-h3"><?php $singleBuilding->the_title(); ?></h3>
        <p class="page-text"><?php //the_content();  ?></p>
        <?php if( $metro = $singleBuilding->get_metro_closeness() ) : ?>
            <div class="page-text to-metro">
                <span class="icon-metro icon-metro--red"></span>
                <span class="page-text"><?php echo $metro->title; ?>
                    <span> <?php echo $metro->closeness; ?> мин.</span>
                </span>
                <span class="icon-walk-icon"></span>
            </div>
        <?php endif; ?>
        <span class="page-text text-desc"><?php echo $singleBuilding->get_company_address(); ?> </span>
    </div>
    </a>
</li>