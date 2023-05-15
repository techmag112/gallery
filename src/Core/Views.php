<?php

class Views {
    public function render(string $contentName, array $params = []) {
        if(is_array($params)) {
			// преобразуем элементы массива в переменные
			extract($params);
		}
        $templatePath = 'src/Templates/main_template.php';
        if (file_exists($templatePath)) {
           require $templatePath;
       }
    }
}