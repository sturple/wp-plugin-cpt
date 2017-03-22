<?php
// used to get choices called internally
function get_slideshow_choices(){
    $choices_array = array(''=>'-- Select Slideshow -- ');
    $my_wp_query = new WP_Query();
    $all_wp_pages = $my_wp_query->query(array('post_type'       => 'slideshow',
                                              'posts_per_page'  => 1000,
                                              'orderby'         => 'title',
                                              'order'           => 'asc'));
    
    foreach ($all_wp_pages as $accessory){ 
        $choices_array[$accessory->ID] =  $accessory->post_title;
    }
    return $choices_array;
}
// used to get slideshow fields in settings and in post types.
function get_slideshow_fields($group='') {
    $group = (strlen($group) > 0 ) ? $group.':': $group;
    $fields = [
        [
            'type' => 'radio',
            'field' => 'slide-or-image-radio',
            'label' => '',
            'choices' => [
                'image'     => 'Feature Image',
                'slideshow' => 'Slideshow' 
            ],
            'value' => 'image',
            'columns' => 2
        ],
        [
            'type' => 'select',
            'label' => __('Slideshow'),    
            'field' => 'slideshow-list',
            'choices' => get_slideshow_choices(),    
            'conditions' => [
                [
                  'field' => $group . 'slide-or-image-radio',
                  'value' => 'slideshow'
                ]
            ],
            'columns' => 4          
        ],   
        [
            'type' => 'file',           
            'field' => 'feature-image',
            'label' => 'Image',
            'options' => array('button' => 'Add Image'),
            'preview_size' =>'thumbnail',
            'conditions' => [
                [
                  'field' => $group . 'slide-or-image-radio',
                  'value' => 'image'
                ]
            ],
            'columns' => 4
        ]
    ];
    return $fields;
}
?>