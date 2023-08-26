<?php

class Album_photos_video_model extends App_model
{
    public function get_album_photos($albumid)
    {
        $this -> db -> select('*');

        $this -> db -> from('social_album_master');

        $this -> db -> where('album_id', ''.$albumid.'');

        $this -> db -> where('status', 'Active');

        $this -> db -> order_by('album_id', 'ASC');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        if(isset($the_content[0])) {

            $this -> db -> select('*');

            $this -> db -> from('social_album_images');

            $this -> db -> where('album_id', ''.$albumid.'');

            $query = $this -> db -> get();

            $the_content['album_photos'] = $query->result_array();

        }

        return $the_content;
    }




    public function get_album_by_usercode($usercode)
    {
        $this -> db -> select('social_album_master.*');

        $this -> db -> select('social_album_images.image_path');

        $this -> db -> from('social_album_master');

        $this -> db -> join('social_album_images', 'social_album_images.album_id=social_album_master.album_id', 'left');

        $this -> db -> where('social_album_master.create_by', ''.$usercode.'');

        $this -> db -> where('social_album_master.status', 'Active');

        $this -> db -> group_by('social_album_master.album_id');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        if(isset($the_content[0])) {
            for($i = 0;$i < count($the_content);$i++) {
                $the_content[$i]['tot_album_img'] = $this->get_tot_photos_in_album($the_content[$i]['album_id']);
            }
        }

        return $the_content;


    }


    public function get_tot_photos_in_album($album_id)
    {
        $this -> db -> select('count(*) as tot_album_img');

        $this -> db -> from('social_album_images');

        $this -> db -> where('album_id', ''.$album_id.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content[0]['tot_album_img'];

    }





}
