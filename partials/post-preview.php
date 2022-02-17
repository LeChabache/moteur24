<?php
    // Post preview. Use within the loop.
    $defaults = [
        'wrap_in' => '',
    ];

    $categories = array_filter((array) get_the_terms(get_the_ID(), 'category'));

    $image = c27()->featured_image(get_the_ID(), 'large');

    if ( ! $image ) $image = c27()->get_setting('blog_default_post_image');

    if (is_array($image) && isset($image['sizes'])) {
        $image = $image['sizes']['large'];
    }
?>
<style>

@media (min-width: 768px){
 .blog-feed-thmb {
    display: block;
    width: 100%;
}
.sbf-container{
    width: 100%;
    box-shadow: none;
}
.sbf-thumb {
    width: 46%;
    display: inline-block;
    vertical-align: bottom;
}
.sbf-title{
    width: 58%;
    display: inline-block;
    position: absolute;
    text-align: left;
}
.sbf-container .listing-details {
    display: inline-block;
}
.sbf-title a h1{
    font-size: 24px;
    margin-top: -11px;
    margin-bottom: 17px;
}
.single-blog-feed {
    border-bottom: 3px solid #e7e7e7;    
    margin-bottom: 30px;
    padding-bottom: 30px;
}
.sbf-container .listing-details ul {
    display: inline-block;
    position: relative;
    top: 12px;
    right: -4px;
}
.sbf-container .listing-details>ul>li>a {
    background: #f35a02;
    padding: 5px 13px;
    border-radius: 30px;
}

.sbf-container .listing-details>ul>li>a:hover {
    background: #dedee1;
}
.listing-details .category-name {
    color: #ffffff;
    font-size: 13px;
    text-overflow: ellipsis;
    font-weight: 600;
    overflow: hidden;
}
.listing-details>span{
    margin-left: 20px;
}}

</style>

<div class="blog-feed-thmb">
    <div class="single-blog-feed grid-item">
        <div class="sbf-container">
            <div class="lf-head">
                <div class="lf-head-btn event-date">
                    <span class="e-month"><?php echo get_the_date('M') ?></span>
                    <span class="e-day"><?php echo get_the_date('d') ?></span>
                </div>
                <?php if (is_sticky()): ?>
                    <div class="lf-head-btn">
                        <i class="icon icon-pin-2"></i>
                    </div>
                <?php endif ?>
            </div>
            <div class="sbf-thumb">
                <a href="<?php the_permalink() ?>">
                    <div class="overlay"></div>
                    <?php if ($image): ?>
                        <div class="sbf-background" style="background-image: url('<?php echo esc_url( $image ) ?>')"></div>
                    <?php endif ?>
                </a>
            </div>
           <div class="sbf-title">
                <a href="<?php the_permalink() ?>" class="">
                <h1><?php the_title() ?></h1></a>
                <p><?php c27()->the_excerpt(170) ?></p>
            </div>
            <div class="listing-details">
                <span>Posted in:</span>
                <ul class="c27-listing-preview-category-list">
                    <?php if ( ! is_wp_error( $categories ) && count( $categories ) ):
                        $category_count = count( $categories );

                        $first_category = array_shift($categories);
                        $first_ctg = new MyListing\Src\Term( $first_category );
                        $category_names = array_map(function($category) {
                            return $category->name;
                        }, $categories);
                        $categories_string = join(', ', $category_names);
                        ?>

                        <li>
                            <a href="<?php echo esc_url( $first_ctg->get_link() ) ?>">
                                
                                <span class="category-name"><?php echo esc_html( $first_ctg->get_name() ) ?></span>
                            </a>
                        </li>

                        <?php if (count($categories)): ?>
                            <li data-toggle="tooltip" data-placement="top" data-original-title="<?php echo esc_attr( $categories_string ) ?>" data-html="true">
                                <div class="categories-dropdown dropdown c27-more-categories">
                                    <a href="#other-categories">
                                        <span class="cat-icon cat-more">+<?php echo $category_count - 1 ?></span>
                                    </a>
                                </div>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                </ul>
            </div>
            

        </div>
    </div>
</div>