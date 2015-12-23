<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Show camera slider in your site with a widget and slider 
 * 
 * Intended for use on cms pages. Usage : 
 * on a CMS page add:
 * 
 * 		{{ widgets:area slug="NAME_OF_AREA" }} 
 * 
 * 'name_of_area' is the name of the widget area you created in the  admin 
 * control panel
 * 
 * @author		Alireza Youhan
 * @package		Pmaker slider manager
 */
class Widget_Pm_camera extends Widgets {

    public $title = array(
            'en' => 'Pmaker Camera',
    );
    public $description = array(
            'en' => 'PmakerSlider with Camera',
    );
    public $author = 'Alireza Youhan';
    public $website = '';
    public $version = '1.0';
    public $fields = array(
        array('field' => 'slider', 'lable' => 'Choose Slider'),
    );

    public function form($options) {
        
                        
            //prepare sliders options
            class_exists('Pmslider_m') OR $this->load->model('pmaker/pmslider_m');
            $no_slider[0] = "-- No Slider --";
            $pm_sliders = $this->pmslider_m->list_sliders();
            $slider_options = $no_slider + $pm_sliders;
          
                        
            return array(
                'slider_options' => $slider_options
            );
    }

    public function run($options) {
            
        //load library
        class_exists('Pmslider_m') OR $this->load->model('pmaker/pmslider_m');
        class_exists('Pmslide_m') OR $this->load->model('pmaker/pmslide_m');
        //get slider
        $slider = $this->pmslider_m->get_by('id',$options['slider']);
        
        //get slides
        $slides = $this->pmslide_m->get_slides($options['slider']);
        
        // add path to widget's assets
        // MODIFY THIS PATH IF YOU'D LIKE TO KEEP THE MODULE ELSEWHERE
        Asset::add_path('pmcamera', 'addons/shared_addons/modules/pmaker/widgets/pm_camera/assets/');

        
        Asset::css('pmcamera::camera.css', false, 'camera');
        Asset::js('pmcamera::camera.js', false, 'camera');
        Asset::js('pmcamera::jquery.mobile.customized.min.js', false, 'camera');

      
        return array(
            'options' =>$options,
            'slider'  => $slider,
            'slides'  => $slides
        );
    }

}
