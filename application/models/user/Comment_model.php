<?php

class Comment_model extends App_model
{
    public function get_post($post_id)
    {

        $this->db->select('*');

        $this->db->from('social_post_master');

        $this->db->where('post_id', $post_id);

        $this->db->where('status', 'Active');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getCommentById($id)
    {

        $this->db->select('c.*');

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'left');

        $this->db->where('c.id', $id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function add_comment($result)
    {

        $data = [

            'post_id'    => (isset($result['post_id'])) ? $result['post_id'] : '0',

            'comment_id' => (isset($result['comment_id'])) ? $result['comment_id'] : '0',

            'text_dt'    => $result['text_dt'],

            'usercode'   => user_session('usercode'),

            'time_dt'    => time(),

        ];

        $id = $this->comman_fun->addItem($data, 'social_comments');

        $post_result = $this->Post_model->get_post($result['post_id']);

        //**Notification For Comment**//

        if ($result['type'] == 'comment') {

            if ($post_result[0]['added_by'] != user_session('usercode')) {

                $data = [

                    'type'       => 'comment',

                    'post_id'    => $result['post_id'],

                    'usercode'   => $post_result[0]['added_by'],

                    'usercode2'  => user_session('usercode'),

                    'comment_id' => $id,

                ];

                $this->Notification_module->add_notification($data);

            }

        }

        //**END Notification For Comment**//

        return $id;

    }

    public function edit_comment($comment_id, $result)
    {

        $data = [

            'text_dt' => $result['text_dt'],

        ];

        $this->comman_fun->update($data, 'social_comments', ['id' => $comment_id]);

        return $comment_id;

    }

    public function getPostComments($post_id, $start_from)
    {

        $this->db->select('c.*');

        $this->db->select('count(c2.id) as tot_reply'); //new

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'inner');

        $this->db->join('social_comments c2', 'c.id = c2.comment_id', 'left'); //new

        $this->db->where('c.post_id', $post_id);

        $this->db->group_by('c.id'); //new

        $this->db->order_by('c.id', 'DESC');

        $this->db->limit(3, $start_from);

        $query = $this->db->get();

        $the_content = $query->result_array();

        $the_content = array_reverse($the_content);

        return $the_content;

    }

    public function do_unlike_comment($comment_id)
    {

        $this->comman_fun->delete('social_likes', ['comment_id' => $comment_id, 'usercode' => user_session('usercode')]);

        return true;

    }

    public function do_like_comment($comment_id)
    {

        if ( ! $this->isMemberLikeComment($comment_id)) {

            $this->_do_like_comment($comment_id);

            //notification
            $cresult = $this->comman_fun->get_table_data('social_comments', ['id' => $comment_id]);

            if ( ! isset($cresult[0]['post_id']) or $cresult[0]['post_id'] == 0) {
                $cresult2 = $this->comman_fun->get_table_data('social_comments', ['id' => $cresult[0]['comment_id']]);

                $comment_post_id = $cresult2[0]['post_id'];
            } else {
                $comment_post_id = $cresult[0]['post_id'];
            }

            if ($cresult[0]['usercode'] != user_session('usercode')) {

                $notification_data = [

                    'type'       => 'comment_like',

                    'usercode'   => $cresult[0]['usercode'],

                    'usercode2'  => user_session('usercode'),

                    'post_id'    => $comment_post_id,

                    'comment_id' => $comment_id,

                ];

                $this->Notification_module->add_notification($notification_data);
            }

            return true;

        }

        return false;

    }

    private function _do_like_comment($comment_id)
    {

        $data = [

            'post_id'    => 0,

            'comment_id' => $comment_id,

            'usercode'   => user_session('usercode'),

            'time_dt'    => time(),

        ];

        $this->comman_fun->addItem($data, 'social_likes');

    }

    public function isMemberLikeComment($comment_id)
    {

        $this->db->select('id');

        $this->db->from('social_likes');

        $this->db->where('comment_id', $comment_id);

        $this->db->where('usercode', user_session('usercode'));

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (isset($the_content[0])) ? true : false;

    }

    public function countCommentTotalLikes($comment_id)
    {

        $this->db->select('COUNT(*) as tot');

        $this->db->from('social_likes');

        $this->db->where('comment_id', $comment_id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'];

    }

    public function countCommentLikes($comment_id)
    {

        $sQuery = 'SELECT

            (SELECT COUNT(*) FROM social_likes WHERE comment_id = ' . $this->db->escape($comment_id) . ') as total_likes,

            (SELECT COUNT(*) FROM social_likes WHERE comment_id = ' . $this->db->escape($comment_id) . ' AND usercode = "' . user_session('usercode') . '") as is_like

			';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function countTotalReplyByID($comment_id)
    {
        $this->db->select('count(c2.id) as tot_reply'); //new

        $this->db->from('social_comments c');

        $this->db->join('social_comments c2', 'c.id = c2.comment_id', 'left'); //new

        $this->db->where('c.id', $comment_id);

        $this->db->group_by('c.id'); //new

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function getReplyById($comment_id)
    {

        $this->db->select('c.*');

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'left');

        $this->db->where('c.id', $comment_id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function getAllReplyById($comment_id, $start_from)
    {

        $this->db->select('c.*');

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'left');

        $this->db->where('c.comment_id', $comment_id);

        $this->db->limit(3, $start_from);

        $this->db->order_by('c.id', 'DESC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        $the_content = array_reverse($the_content);

        return $the_content;

    }

    public function getPostCommentsPerticuler($post_id = null, $start_id = null)
    {

        $this->db->select('c.*');

        $this->db->select('count(c2.id) as tot_reply'); //new

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'inner');

        $this->db->join('social_comments c2', 'c.id = c2.comment_id', 'left'); //new

        $this->db->where('c.id >=', $start_id);

        $this->db->where('c.post_id', $post_id);

        $this->db->group_by('c.id'); //new

        $this->db->order_by('c.id', 'DESC');

        $this->db->limit(20, $start_from);

        $query = $this->db->get();

        $the_content = $query->result_array();

        $the_content = array_reverse($the_content);

        return $the_content;

    }

    public function getPostPerticulerCommentById($post_id = null, $id = null)
    {

        $this->db->select('c.*');

        $this->db->select('count(c2.id) as tot_reply'); //new

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'inner');

        $this->db->join('social_comments c2', 'c.id = c2.comment_id', 'left'); //new

        $this->db->where('c.id', $id);

        $this->db->where('c.post_id', $post_id);

        $this->db->group_by('c.id'); //new

        $query = $this->db->get();

        $the_content = $query->result_array();

        $the_content = array_reverse($the_content);

        return $the_content;

    }

    public function getPerticulerReplyById($comment_id = null, $start_id = null)
    {

        $this->db->select('c.*');

        $this->db->select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');

        $this->db->from('social_comments c');

        $this->db->join('membermaster u', 'c.usercode = u.usercode', 'left');

        $this->db->where('c.comment_id', $comment_id);

        $this->db->where('c.id >=', $start_id);

        $this->db->limit(20, $start_from);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

}
