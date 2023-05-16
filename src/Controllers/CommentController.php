<?php

class CommentController {

    private $user, $images, $db, $view, $id_image, $image_name;

    function __construct() {
        $this->user = new User();
        $this->images = new Images();
        $this->view = new Views();
        $this->db = Database::getInstance();
    }

    public function mainAction($method = 'post') {
        $this->id_image = Input::get('id');
        $this->image_name = $this->images->getImage($this->id_image)->name; 
        if($method === 'get' && Input::exists($method)) {
            if(isset($_GET['id2'])) {
                $this->db->delete(Config::get('comments.table'), ['id', '=', Input::get('id2')]);
                Session::setFlash("Комментарий успешно удален");
                unset($_GET['id2']);
                Redirect::to('/comment?id=' . Input::get('id'));
            }
        } elseif(Input::exists()) {
            if(Token::check(Input::get('token'))) {
                $this->db->insert(Config::get('comments.table'), ['id_img' => $this->id_image, 'post' => htmlspecialchars($_POST['comment']), 'owner_id' => $this->user->data()->id, 'owner_username' => $this->user->data()->username]);
            }   
        }
        $comments = $this->db->get(Config::get('comments.table'), ['id_img', '=', $this->id_image])->results();
       
        if($this->user->isLoggenIn()) {
            $this->view->render('comment', array('id_image' => $this->id_image, 'image' => $this->image_name, 'comments' => $comments, 'username' => $this->user->data()->username, 'id_user' => $this->user->data()->id));
        } else {
            $this->view->render('comment_no_auth', array('image' => $this->image_name, 'comments' => $comments));
        }
    }
}