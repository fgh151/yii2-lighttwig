<?php

namespace fgh151\littletwig;

trait TwigTrait
{
    /**
     * @param string $template
     * @param array $options
     * @param array $extensions
     * @return string
     */
    public function renderTwig($template, $options = [], $extensions = [], $twigParams = [])
    {
        $loader = new \Twig_Loader_Filesystem(\Yii::getAlias('@app'));
        $twig = new \Twig_Environment(
            $loader,
            $twigParams
        );
        if(!empty($extensions)) {
            foreach ($extensions as $extension){
                $twig->addExtension(new $extension());
            }
        }

        return $this->renderContent($twig->render($template, $options));
    }
}
