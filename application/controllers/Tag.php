<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tag extends App
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/Page_model', '', true);
        $this->load->model('user/Post_model', '', true);
        $this->load->model('user/Search_model');
        $this->load->model('Member_module');

    }

    public function tag_member_box($tab = null)
    {
        $data['tab'] = $tab;
        echo $this->load->view('user/tag_member_box', $data, true);
    }

    public function find_friend()
    {

        $filter_by = utf8_decode(urldecode($_GET['term']));
        $result    = $this->Search_model->find_friend($filter_by);
        $return    = [];
        for ($i = 0; $i < count($result); $i++) {

            $html = '<li style="padding:10px 15px !important;" class="sec-replace">

			<div class="author-thumb"> <img src="' . thumb($result[$i]['profile_img'], 100, 100) . '" style="width:40px;" alt="author"></div>

			<div class="notification-event"> <a href="#" id="tag_friend_sel" title="' . $result[$i]['name'] . '" uid="' . $result[$i]['usercode'] . '"><span class="h6 notification-friend">' . $result[$i]['name'] . '</span></a> </div>

			</li>';
            $arr = [
                'uid'  => $result[$i]['usercode'],
                'html' => $html,
            ];
            $return[] = $arr;
        }

        echo json_encode($return);
        exit;

    }

    public function taggedmembertist($post_id)
    {

        $result = $this->Post_model->getPostTaggedMember($post_id, 50);
        $html   = "<ul class='notification-list'>";
        for ($i = 0; $i < count($result); $i++) {
            $html .= '<li style="padding:10px 15px !important;" class="sec-replace">
			<div class="author-thumb"> <img src="' . thumb($result[$i]['profile_img'], 100, 100) . '" style="width:40px;" alt="author"></div>
			<div class="notification-event"> <a href="#" id="tag_friend_sel"><span class="h6 notification-friend">' . $result[$i]['name'] . '</span></a> </div>
			</li>';

        }
        echo '</ul>';
        echo $html;
    }
}
