<?php 

class Images {

	private $db;

	public function __construct() {
        $this->db = Database::getInstance();
	}

	public function getImage($id_image) {
		return $this->db->get(Config::get('images.table'), ['id', '=', $id_image])->first(); 
	}

	public function putImage($file, $id_user) { 
		// если была произведена отправка формы
	    if(is_array($file)) {
			// проверяем, можно ли загружать изображение
			$check = $this->checkImage($file);
			if($check == true ){
			// загружаем изображение на сервер и в базу
				$nameFile = $this->uploadImage($file, $id_user);
				Session::setFlash("Файл успешно загружен!");
			} else {
			// выводим сообщение об ошибке
				Session::setFlash($check, "danger");  
			}
		}
	}

	public function getAllImage() {
		$images = $this->db->get(Config::get('images.table'))->results();
		if(empty($images)) {
			Session::setFlash("Галерея пуста!", "danger");
			return false;
		} else {
			return $images;
		}
	}

	public function removeImage($id) {
		$uploaddir =  $_SERVER["DOCUMENT_ROOT"] . Config::get('images.path');
		$fileName = $this->db->get(Config::get('images.table'), ['id', '=', $id])->first();
		$this->db->delete(Config::get('images.table'), ['id', '=', $id]);
		if (file_exists($uploaddir . $fileName->name)) {
			unlink($uploaddir . $fileName->name);
		}
	}

	private function checkImage($file){
		// если имя пустое, значит файл не выбран
		if($file['name'] == '')
			return 'Вы не выбрали файл.';
		
		/* если размер файла 0, значит его не пропустили настройки 
		сервера из-за того, что он слишком большой */
		if(($file['size'] == 0) or ($file['size'] > Config::get('images.size')))
			return 'Файл слишком большой.';
		
		// разбиваем имя файла по точке и получаем массив
		$getMime = explode('.', $file['name']);
		// нас интересует последний элемент массива - расширение файла
		$mime = strtolower(end($getMime));
		// объявим массив допустимых расширений
		$types = explode(",", Config::get('images.ext'));
		// если расширение не входит в список допустимых 
		if(!in_array($mime, $types)) 
			return 'Недопустимый тип файла.';
		// Иначе проверка пройдена!
		return true;
	}
  
  	private function uploadImage($file, $id_user) {	
		$uploaddir =  $_SERVER["DOCUMENT_ROOT"] . Config::get('images.path');
		// формируем уникальное имя картинки: случайное число и name
		$nameFile = uniqid() . $file['name'];
		// Добавляем в базу 
		$this->db->insert(Config::get('images.table'), ['name' => $nameFile, 'owner' => $id_user]);
		// Заливаем файл
		move_uploaded_file( $file['tmp_name'],  $uploaddir . $nameFile);
		return $nameFile;
	}

}