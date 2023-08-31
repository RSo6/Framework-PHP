<?php

namespace app\controllers\admin;

use app\models\admin\Slider;
/**
 * @property Slider $model
 */
class SliderController extends AppController
{

    public function indexAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->updateSlider();
            $_SESSION['success'] = 'Slider updated';

            redirect();
        }

        $gallery = $this->model->getSlides();

        $title = 'Slider controller';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'gallery'));
    }
}